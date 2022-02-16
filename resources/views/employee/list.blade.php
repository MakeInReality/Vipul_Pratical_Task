
<!doctype html>
<html lang="en">
  @include('head')
  <body>
    
    @include('header')

    <div class="container-fluid">
    
        @include('sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
        
            <div class="row">
                <div class="col-10"> <h2 class="mb-4">Employee</h2></div>
                <div class="col-2"><a href="{{route("employee.create")}}" class="btn btn-primary btn-sm btn-block">Add Employee </a></div>
            </div>
     
            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Employee Photo</th>
                        <th>Employee Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
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
          ajax: "{{ route('employee.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              { data: 'profile_pic', name: 'profile_pic',
                    render: function( data, type, full, meta ) {
                        return "<img src=\"{{asset('/storage/employee/')}}/" +full.id+ "/" + data + "\" height=\"30\"/>";
                    }
                },

              {data: 'name', name: 'name'},
              {data: 'role.name', name: 'role.name'},
              {data: 'email', name: 'email'},
              {data: 'phone_number', name: 'phone_number'},
              {data: 'gender', name: 'gender'},
              {
                mRender: function (data, type, row) {
                    return '<a href="<?= url('/employee/edit') ?>/'+row.id+'" class="edit btn btn-success btn-sm">Edit</a> <a href="<?= url('/employee/delete') ?>/'+row.id+'" class="delete btn btn-danger btn-sm">Delete</a>'
  
              }
          }
          ]
      });
      
    });
  </script>
  
</html>

