<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Mst_Manufacturer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MstManufacturerController extends Controller
{
    public function index()
    {
        try {
            $pageTitle = "Manufacturers";
            $manufacturers = Mst_Manufacturer::orderBy('created_at', 'desc')->get();
            return view('manufacturers.index', compact('pageTitle', 'manufacturers'));
        } catch (QueryException $e) {
            // Handle the exception, you can log it or display an error message
            return redirect()->route('home')->with('error', 'An error occurred while fetching manufacturers.');
        }
    }


    public function create()
    {
        try {
            $pageTitle = "Add Manufacturers";
            return view('Manufacturers.create', compact('pageTitle'));
        } catch (QueryException $e) {
            // Handle the exception, you can log it or display an error message
            return redirect()->route('home')->with('error', 'An error occurred while fetching Manufacturers.');
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'manufacturer' => ['required'],
                    'is_active' => ['required'],
                ],
                [
                    'manufacturer.required' => 'Manufacturer field is required',
                    'is_active.required' => 'Manufacturer status is required',
                ]
            );

            if (!$validator->fails()) {
                if (isset($request->hidden_id)) {
                    Mst_Manufacturer::where('manufacturer_id', $request->hidden_id)->update([
                        'name' => $request->manufacturer,
                        'is_active' => $request->is_active,
                        'updated_by' => Auth::id(),
                        'updated_at' => Carbon::now(),
                    ]);
                    $message = 'Qualifications updated successfully';
                } else {
                    $checkExists = Mst_Manufacturer::where('name',$request->manufacturer)->first();
                    if($checkExists){
                        return redirect()->route('manufacturer.index')->with('exists', 'This manufacturer is aready exists.');
                    }else{
                        Mst_Manufacturer::create([
                            'name' => $request->manufacturer,
                            'is_active' => $request->is_active,
                            'created_by' => Auth::id(),
                            'updated_by' => Auth::id(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        $message = 'manufacturers added successfully';
                    }
                    
                }
                return redirect()->route('manufacturer.index')->with('success', $message);
            } else {
                $messages = $validator->errors();

                return redirect()->route('manufacturers.create')->with('error', $messages);
            }
        } catch (QueryException $e) {
            return redirect()->route('manufacturers.create')->with('error', 'An error occurred while processing the request.');
        }
    }


    public function destroy($id)
    {
        try {
            $manufacturer = Mst_Manufacturer::findOrFail($id);
            $manufacturer->deleted_by = Auth::id();
            $manufacturer->save();
            $manufacturer->delete();
            return 1;
            return redirect()->route('manufacturer.index')->with('success', 'Deleted successfully');
        } catch (QueryException $e) {
            return redirect()->route('home')->with('error', 'An error occurred while fetching manufacturers.');
        }
    }

    public function edit($id)
    {
        $pageTitle = "Edit Manufacturers";
        $manufacturer = Mst_Manufacturer::findOrFail($id);
        return view('manufacturers.create', compact('pageTitle', 'manufacturer'));
    }

    public function changeStatus($id)
    {
        $manufacturer = Mst_Manufacturer::findOrFail($id);
    
        $manufacturer->is_active = !$manufacturer->is_active;
        $manufacturer->save();
    
        return redirect()->back()->with('success','Status changed successfully');
    }
}
