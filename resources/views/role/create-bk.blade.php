<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Add Role</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


  </head>

  <body class="bg-light" style="  max-width:40%;margin: auto;">
    <?php 
       $id  =  isset($Role->id) ? $Role->id : 0;
    ?>

    <div class="container">
      <div class="py-5 text-left">
        <h3>@if($action == 0) Create @else Edit @endif Role</h3>
      </div>

      <div class="row">
        <div class="col-md-12">

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

    </div>

  </body>
  <script src="{{asset('/assets/dist/js/jquery.validate.js')}}"></script>

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
