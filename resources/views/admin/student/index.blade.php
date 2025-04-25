@extends('layouts.admindefault')

    @section('content')
                        
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Students Database</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
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
    <!-- Card -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Students</h3>
          </div>
          <div class="card-body">
          <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#batchAssignModal">
    Batch Assign
</button>
<br>
            <!-- Show Table from Database -->
            <table id="example" class="table table-bordered mt-3">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User Name</th>
                  <th>Class Name</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($students as $student)
                <tr>
                  <td>{{ $student->id }}</td>
                <td>{{ $student->user->name }}</td>
                <td>          
                @if ($student->classModel)
                {{ $student->classModel->class_name }}
                @else
                No class assigned
                 @endif
                 </td>  
                  <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editStudentModal"
                      data-id="{{ $student->id }}"
                      data-userid="{{ $student->user_id }}"
                      data-classid="{{ $student->class_id }}">
                      Assign Class
                    </button>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirmDelete()">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Include Modals -->
    @include('admin.student.student_modals')
    </div>
</div>

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
  $('#editStudentModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var studentId = button.data('id');
    var currentClassId = button.data('classid'); 

    var modal = $(this);
    modal.find('#studentId').val(studentId);
    modal.find('#classId').val(currentClassId);
    modal.find('#assignClassForm').attr('action','/admin/student/' + studentId);
  });
});

function confirmDelete() {
    return confirm('Are you sure you want to delete this data?');
}
//other script
</script>
@endsection

