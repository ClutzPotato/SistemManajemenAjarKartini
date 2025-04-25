@extends('layouts.admindefault')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Database</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



<div class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                             @endforeach
                        </ul>
            </div>
        @endif
        <!-- Other content -->
    


<!-- Card -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUserModal">Add New User</button>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addBatchStudentModal">Add Batch Student</button>
              <br>
              <br>  
              <!-- Show Table from Database -->
                <table id="example" class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->password }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <span>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-password="{{ $user->password }}"
                                            data-role="{{ $user->role }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Include Modals -->
@include('admin.user.user_modals')

<!-- Include Students Partial for Initial Load -->


<!-- jQuery -->
<script src="{{asset("/assets/dist/js/jquery-3.5.1.js")}}"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTable({
    });
});
$(document).ready(function() {
  $('#editUserModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); 
    var name = button.data('name'); 
    var email = button.data('email'); 
   var password = button.data('password');
    var role = button.data('role'); 

    var modal = $(this);
    modal.find('#name').val(name);
    modal.find('#email').val(email);
 modal.find('#password').val(password);
    modal.find('#role').val(role);
    modal.find('#editUserForm').attr('action', '/admin/users/' + id);
  });
});

$(document).ready(function() {
    // Handle pagination links click
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        
        var url = $(this).attr('href');
        
        $.ajax({
            url: url,
            success: function(data) {
                $('#student-list').html(data);
            }
        });
    });
});


function confirmDelete() {
    return confirm('Are you sure you want to delete this data?');
}
//other script
</script>
@endsection

