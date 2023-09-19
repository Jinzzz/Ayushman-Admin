@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0 card-title">Create Staff</h3>
            </div>
            <div class="col-lg-12" style="background-color:#fff;">
               @if ($errors->any())
               <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               <form action="{{ route('staffs.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Staff Type*</label>
                           <select class="form-control" name="staff_type" id="staff_type" onchange="toggleBookingFeeField()">
                              <option value="">Select Staff Type</option>
                              @foreach($stafftype as $masterId => $masterValue)
                              <option value="{{ $masterId }}" {{ old('staff_type') == $masterId ? 'selected' : '' }}>
                              {{ $masterValue }}
                              </option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Employment Type*</label>
                           <select class="form-control" name="employment_type" id="employment_type">
                              <option value="">Select Employment Type</option>
                              @foreach($employmentType as $masterId => $masterValue)
                              <option value="{{ $masterId }}" {{ old('employment_type') == $masterId ? 'selected' : '' }}>
                              {{ $masterValue }}
                              </option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                 
                  <!-- End Username, Password, and Confirm Password Fields -->
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Staff Name*</label>
                           <input type="text" class="form-control" required name="staff_name" value="{{ old('staff_name') }}" placeholder="Staff Name">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="patient_gender" class="form-label">Gender*</label>
                           <select class="form-control" name="gender" id="gender">
                              <option value="">Choose Gender</option>
                              @foreach($gender as $id => $gender)
                              <option value="{{ $id }}" {{ old('gender') == $id ? 'selected' : '' }}>
                              {{ $gender }}
                              </option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label branch" id="branchLabel">Branch*</label>
                           <select class="form-control" name="branch_id" id="branch_field">
                              <option value="">Choose Branch</option>
                              @foreach($branch as $id => $branchName)
                              <option value="{{ $id }}"{{ old('branch_id') == $id ? 'selected' : '' }}>
                              {{ $branchName }}
                              </option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Date Of Birth*</label>
                           <input type="date" class="form-control" required name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Date Of Birth">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Email</label>
                           <input type="email" class="form-control" name="staff_email" value="{{ old('staff_email') }}" placeholder="Staff Email">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Contact Number*</label>
                           <input type="text" class="form-control" required name="staff_contact_number" value="{{old('staff_contact_number')}}" placeholder="Contact Number" pattern="[0-9]+" title="Please enter digits only" oninput="validateInput(this)">
                           <p class="error-message" style="color: green; display: none;">Please enter digits only.</p>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Address*</label>
                           <textarea class="form-control" required name="staff_address" placeholder="Address">{{ old('staff_address') }}</textarea>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Qualification</label>
                           <input type="text" class="form-control" required name="staff_qualification" placeholder="Qualification">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">Specialization</label>
                        <input type="text" class="form-control" required name="staff_specialization" placeholder="Specialization">
                     </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">Work Experience</label>
                        <input type="text" class="form-control" name="staff_work_experience" value="{{ old('staff_work_experience') }}" placeholder="Work Experience" pattern="[0-9]+" title="Please enter digits only">
                        <p class="error-message" style="color: green; display: none;">Please enter digits only.</p>
                     </div>
                  </div>
                  </div>
                  <div class="row">
                    
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Commission Type</label>
                           <select class="form-control" name="staff_commission_type" id="staff_commission_type">
                              <option value="">Select Commission Type</option>
                              <option value="percentage">Percentage</option>
                              <option value="fixed">Fixed</option>
                           </select>
                        </div>
                     </div>
                       <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">Staff Commission*</label>
                        <input type="text" class="form-control" required name="staff_commission" value="{{ old('staff_commission') }}" placeholder="Staff Commission">
                     </div>
                  </div>
                  </div>
               <div class ="row">
                
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">Salary Type*</label>
                        <select class="form-control" name="salary_type" id="salary_type">
                           <option value="">Select Salary Type</option>
                           @foreach($salaryType as $id => $type)
                           <option value="{{ $id }}"{{ old('salary_type') == $id ? 'selected' : '' }}>
                           {{ $type }}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                       <label class="form-label">Salary Amount*</label>
                       <input type="text" class="form-control"  name="salary_amount" value="{{ old('salary_amount') }}" placeholder="Salary Amount">
                     </div>
                  </div>
              </div>

                  <!-- ... -->
                  <!-- Show Booking Fee Field for Doctors -->
                  <div class="row" id="booking_fee_field" style="display: none;">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Booking Fee*</label>
                           <input type="text" class="form-control"  name="staff_booking_fee" value="{{ old('staff_booking_fee') }}" placeholder="Booking Fee">
                        </div>
                     </div>
                  </div>
                 
                    
                    <!-- Checkbox for "Is Login" -->
                  <div class="form-group">
                     <label class="custom-control custom-checkbox">
                     <input type="checkbox" class="custom-control-input" name="is_login" id="is_login" onchange="toggleLoginFields()">
                     <span class="custom-control-label">Has Login</span>
                     </label>
                  </div>
                  <!-- Username, Password, and Confirm Password Fields -->
                  <div id="login_fields" style="display: none;">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="form-label">Username*</label>
                              <input type="text" class="form-control"  name="staff_username" value="{{ old('staff_username') }}" placeholder="Staff Username">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="form-label">Password*</label>
                              <div class="input-group">
                                 <input type="password" class="form-control"  name="password" id="password" value="{{old('password')}}" placeholder="Password">
                                 <div class="input-group-append">
                                    <span class="input-group-text">
                                      <i class="fa fa-eye-slash password-eye-slash" id="eye"
                                            onclick="togglePassword()"
                                            style="position: absolute; top: 18px; right:15px; color:#000"></i>
                                    </span>
                                </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="form-label">Confirm Password*</label>
                              <div class="input-group">
                                 <input type="password" class="form-control"  name="confirm_password" value="{{old('confirm_password')}}" placeholder="Confirm Password" id="confirmPassword" onkeyup="validatePassword()">
                                 <div class="input-group-append">
                                    <span class="input-group-text">
                                     <i class="fa fa-eye-slash password-eye-slash" id="confirmEye"
                                           onclick="toggleConfirmPassword()"
                                           style="position: absolute; top: 18px; right:15px; color:#000"></i>
                                   </span>
                               </div>
                              </div>
                              <small id="password_error" class="text-secondary"  style="color: green; display: none;">Passwords do not match.</small>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- End Show Booking Fee Field for Doctors -->
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-label">Status</div>
                           <label class="custom-switch">
                              <input type="hidden" name="is_active" value="0"> <!-- Hidden field for false value -->
                              <input type="checkbox" id="is_active" name="is_active" onchange="toggleStatus(this)" class="custom-switch-input" checked>
                              <span id="statusLabel" class="custom-switch-indicator"></span>
                              <span id="statusText" class="custom-switch-description">Active</span>
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="form-group text-center">
                     <button type="submit" class="btn btn-raised btn-primary">
                     <i class="fa fa-check-square-o"></i> Add
                     </button>
                     <button type="reset" class="btn btn-raised btn-success">
                     Reset
                     </button>
                     <a class="btn btn-danger" href="{{ route('staffs.index')}}">Cancel</a>
                  

               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
<script>
   // Function to toggle the visibility of the Username, Password, and Confirm Password fields based on the "Is Login" checkbox
   function toggleLoginFields() {
       var isLoginCheckbox = document.getElementById('is_login');
       var loginFields = document.getElementById('login_fields');
   
       if (isLoginCheckbox.checked) {
           loginFields.style.display = 'block'; // Show the login fields
       } else {
           loginFields.style.display = 'none'; // Hide the login fields
       }
   }
   
   // Function to toggle the visibility of the Booking Fee field based on the selected Staff Type
   function toggleBookingFeeField() {
       var staffTypeSelect = document.getElementById('staff_type');
       var bookingFeeField = document.getElementById('booking_fee_field');
       var branchField = document.getElementById('branch_field');
       var branchLabel = document.getElementById('branchLabel');

   
       // Check if the selected staff type is doctor or therapist (IDs 20 and 21)
       if (staffTypeSelect.value === '20') {
           bookingFeeField.style.display = 'block'; // Show the Booking Fee field
       } else {
           bookingFeeField.style.display = 'none'; // Hide the Booking Fee field
       }
       //hide branch field if the selected staff type is an accountant:
       if(staffTypeSelect.value === '21') {
         branchField.style.display = 'none';// hide the Branch field
         branchLabel.style.display = 'none';
      }else{
         branchField.style.display = 'block'; // Show the Branch field
         branchLabel.style.display = 'block'; 
      }
   }

   
   
   // Call the toggleLoginFields and toggleBookingFeeField functions initially to set the initial state of the fields
   toggleLoginFields();
   toggleBookingFeeField();
// function for password eye icon:
   function togglePassword() {
            const passwordInput = document.querySelector("#password");

            if (passwordInput.getAttribute("type") == "text") {
                $("#eye").removeClass("fa-eye");
                $("#eye").addClass("fa-eye-slash");

            } else {
                $("#eye").removeClass("fa-eye-slash");
                $("#eye").addClass("fa-eye");

            }

            const type = passwordInput.getAttribute("type") === "text" ? "password" : "text"
            passwordInput.setAttribute("type", type)
        }

//function for confirmPassword eye icon:
    function toggleConfirmPassword() {
    const confirmPasswordInput = document.querySelector("#confirmPassword");

    if (confirmPasswordInput.getAttribute("type") == "text") {
        $("#confirmEye").removeClass("fa-eye");
        $("#confirmEye").addClass("fa-eye-slash");
    } else {
        $("#confirmEye").removeClass("fa-eye-slash");
        $("#confirmEye").addClass("fa-eye");
    }

    const type = confirmPasswordInput.getAttribute("type") === "text" ? "password" : "text";
    confirmPasswordInput.setAttribute("type", type);
}
//function to validate password: 
function validatePassword() {
        var passwordInput = document.getElementById("password");
        var confirmInput = document.getElementById("confirmPassword");
        var passwordError = document.getElementById("password_error");
        
        if (passwordInput.value !== confirmInput.value) {
            passwordError.style.display = "block";
        } else {
            passwordError.style.display = "none";
        }
    }
</script>
