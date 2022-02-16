
<!doctype html>
<html lang="en">
  @include('head')
  <body>
    <?php   $id  =  isset($Employee->id) ? $Employee->id : 0;?>
    
    @include('header')

    <div class="container-fluid">
    
        @include('sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        
          <div class="py-4 text-left">
            <h3>@if($action == 0) Create @else Edit @endif Employee</h3>
            <hr>
          </div>
    
          <div class="row">
            <div class="col-md-12">
    
              <form id="employeeForm" enctype="multipart/form-data" onSubmit="return false;"  method="post">
  
                <div class="row">
    
                  <input type="hidden" name="id" id="id" value="{{ isset($Employee->id) ? $Employee->id : old('id') }}">
                  <div class="col-md-6 mb-3">
                    <label for="name">Employee Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Employee Name" value="{{ isset($Employee->name) ? $Employee->name : old('name') }}">
                    <span class="text-danger" id="name_error"></span>
                 
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="employeeRole">Employee Role</label>
                     <select name="role_id" class="form-control">
                       <option value="">Select Role</option>
                        <?php 
                              if(count($roles) > 0 ) {
                                foreach ($roles as $key => $getRole) { ?>
                                    <option value="{{ $getRole->id }}" {{ $getRole->id == $Employee->role_id ? 'selected' : '' }}>{{ $getRole->name }}</option>
                               <?php  }
                              }
                        ?>
                     </select>
                    <span class="text-danger" id="role_id_error"></span>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="name">Employee Photo</label>
                    <input type="file" class="form-control" id="profile_pic" name="profile_pic" placeholder="Employee Photo">
                    <span class="text-danger" id="profile_pic_error"></span>
                 
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="name">Employee Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Employee Email" value="{{ isset($Employee->email) ? $Employee->email : old('email') }}">
                    <span class="text-danger" id="email_error"></span>
                 
                  </div>

                  
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Employee Address</label>
                    <textarea class="form-control" rows="2" cols="2" name="address" id="address">{{ isset($Employee->address) ? $Employee->address : old('address') }}</textarea>
                    <span class="text-danger" id="address_error"></span>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="name">Employee Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Employee Phone Number" value="{{ isset($Employee->phone_number) ? $Employee->phone_number : old('phone_number') }}">
                    <span class="text-danger" id="phone_number_error"></span>
                  </div>


                 <div class="col-md-6 mb-3">
                  <label for="lastName">Employee Gender</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" {{ $Employee->gender == "Male" ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexRadioDefault1">
                     Male
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender"  value="Female" {{ $Employee->gender == "Female" ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexRadioDefault2">
                     Female
                    </label>
                  </div>
                    <span class="text-danger" id="phone_number_error"></span>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="lastName">Employee Status</label>
                     <select name="status" class="form-control">
                       <option value="">Select Status</option>
                       <option value="Active" {{ $Employee->status == "Active" ? 'selected' : '' }}>Active</option>
                       <option value="Inactive" {{ $Employee->status == "Inactive" ? 'selected' : '' }}>Inactive</option>

                     </select>
                    <span class="text-danger" id="address_error"></span>
                  </div>
                </div>
    
                <div>
                  <button class="col-md-2 mb-3 btn btn-primary btn-lg btn-block" id="btnSubmit" type="submit">Save</button></div>
                <br>
                <div class="alertMessage"></div>
              </form>
            </div>
          </div>
    
        </main>
   
    </div>
  </body>
  @include('footer_script')

  <script type="text/javascript">
    $(document).ready(function () {
 
         $('#employeeForm').validate({ 
             rules: {
             name: {
                 required: true,
             },
             role_id : {
                 required: true,                
             },
             email : {
                 required: true,
                 email: true                
             }, 
             phone_number : {
                 required: true
                              
             },
             address : {
                 required: true         
             },
             status : {
                 required: true            
             }   

                  
                               
         },
         submitHandler: function(form) {
             
             $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
             });
 
            // e.preventDefault();
             var id = $('#id').val();
             //var name = $('#name').val();
             //var description = $('#description').val();

             var url = (id!="") ? '{{ route('employee.update',$id) }}' : '{{ route('employee.store') }}';


             $.ajax({
             url:url,
             method:'POST',
             data:new FormData(document.getElementById("employeeForm")),
             dataType:'JSON',
             contentType: false,
             cache: false,
             processData: false,
             success:function(response){
                 if(response.success){
                         window.location.href = '{{route("employee.index")}}';
                 }else{
                     alert(response.message);
                 }
             },
             error:function(error){
        
                 var errors = $.parseJSON(error.responseText);
                     $.each(errors.errors, function (key, val) {
                         $("#" + key + "_error").text(val[0]);
                     });
                
             }
             });
          }  
             
         });
 
 });
   </script>

</html>

