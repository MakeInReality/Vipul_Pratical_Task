
<!doctype html>
<html lang="en">
  @include('head')
  <body>
    <?php   $id  =  isset($Role->id) ? $Role->id : 0;?>
    
    @include('header')

    <div class="container-fluid">
    
        @include('sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        
          <div class="py-4 text-left">
            <h3>@if($action == 0) Create @else Edit @endif Role</h3>
            <hr>
          </div>
    
          <div class="row">
            <div class="col-md-8">
    
              <form id="roleForm">
            
                <div class="row">
    
                  <input type="hidden" name="id" id="id" value="{{ isset($Role->id) ? $Role->id : old('id') }}">
                  <div class="col-md-12 mb-3">
                    <label for="firstName">Role Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ isset($Role->name) ? $Role->name : old('name') }}">
                    <span class="text-danger" id="name_error"></span>
                 
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="lastName">Role Description</label>
                    <textarea class="form-control" rows="5" cols="5" name="description" id="description">{{ isset($Role->description) ? $Role->description : old('description') }}</textarea>
                    <span class="text-danger" id="description_error"></span>
                  </div>
                </div>
    
                <button class="btn btn-primary btn-lg btn-block" id="btnSubmit" type="submit">Save</button>
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
 
         $('#roleForm').validate({ 
             rules: {
             name: {
                 required: true,
             },
             description: {
                 required: true,                
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
             var name = $('#name').val();
             var description = $('#description').val();
 
             var url = (id!=0) ? '{{ route('role.update',$id) }}' : '{{ route('role.store') }}';
 
 
             $.ajax({
             url:url,
             method:'POST',
             data: {name:name,description:description},
             success:function(response){
                 if(response.success){
                         window.location.href = '{{route("role.index")}}';
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

