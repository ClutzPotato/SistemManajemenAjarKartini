@extends('layouts.teacherdefault')

    @section('content')
                    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-light">Classes</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </div>

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

        <div class="row">
          <div class="col">
            <div class="card">
            <div class="card-header">
                <h5 class="m-0">Class List</h5>
              </div>
              <div class="card-body">
              <table id="example" class="table table-bordered mt-3">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Class Name</th>
                          <th>Class Major</th>
                          <th>Class Capacity</th>
                          <th>Subjects</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($classes as $class)
                      <tr>
                          <td>{{ $class->id }}</td>
                          <td>{{ $class->class_name }}</td>
                          <td>{{ $class->class_major }}</td>
                          <td>{{ $class->class_capacity }}</td>
                          <td>
                            @foreach ($class->subjects as $subject)
                              <span class="badge badge-info">{{ $subject->subject_name }}</span>
                            @endforeach
                          </td>
                          <td>
                            <span>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#attachSubjectsModal"
                                  data-id="{{ $class->id }}">
                                  Attach Subjects
                              </button>
                            </span>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>

              </div>

            </div>
        </div>

        <div class="row">
            <div class="card">
            <div class="card-header">
                <h5 class="m-0">Students List</h5>
              </div>
              
              <div class="card-body">
              <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#batchAssignModal">
    Batch Assign
</button>
              <table id="studenttable" class="table table-bordered mt-3">
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
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

              </div>

            </div>
        </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

 <!-- Include Modals -->
 @include('teacher.classesindexmodals')

<!-- jQuery -->
<script src="{{asset("/assets/dist/js/jquery-3.5.1.js")}}"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#studenttable').DataTable({
    });
});

$(document).ready(function() {
    $('#example').DataTable({
    });
});

$(document).ready(function() {
  $('#attachSubjectsModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); 

    var modal = $(this);
    modal.find('#attach_class_id').val(id);
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