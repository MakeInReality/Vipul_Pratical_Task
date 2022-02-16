<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8|7 Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
    
<div class="container mt-5">
   
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