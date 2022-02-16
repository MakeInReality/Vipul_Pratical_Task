
<!doctype html>
<html lang="en">
  @include('head')
  <body>
    
    @include('header')

    <div class="container-fluid">
    
        @include('sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        
            <div class="row">
                <div class="col-10"> <h2 class="mb-4">Role</h2></div>
                <div class="col-2"><a href="{{route("role.create")}}" class="btn btn-primary btn-sm btn-block">Add Role</a></div>
            </div>
            
            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        
        
        </main>
   
    </div>
  </body>
  @include('footer_script')

  <script type="text/javascript">
    $(function () {
      
      var table = $('.yajra-datatable').DataTable({
          processing: false,
          serverSide: false,
          ajax: "{{ route('role.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'description', name: 'description'},
              {
              mRender: function (data, type, row) {
  
                  return '<a href="<?= url('/role/edit') ?>/'+row.id+'" class="edit btn btn-success btn-sm">Edit</a> <a href="<?= url('/role/delete') ?>/'+row.id+'" class="delete btn btn-danger btn-sm">Delete</a>'
  
              }
          }
          ]
      });
      
    });
  </script>
  
</html>

