@extends('layouts.admindefault')

@section('content')
   
              
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Class Database</h1>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">

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
        </div>
    </div>

    <!-- Card -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Table</h3>
          </div>
          <div class="card-body">
             <!-- Show Table from Database -->
             <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addClassModal">Add New Class</button>
             <br><br>
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
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editClassModal"
                                  data-id="{{ $class->id }}"
                                  data-name="{{ $class->class_name }}"
                                  data-major="{{ $class->class_major }}"
                                  data-capacity="{{ $class->class_capacity }}">
                                  Edit
                              </button>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#attachSubjectsModal"
                                  data-id="{{ $class->id }}">
                                  Attach Subjects
                              </button>
                              <form action="{{ route('classes.destroy', $class->id) }}" method="POST" onsubmit="return confirmDelete()">
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

    <!-- Card -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Class Major</h3>
          </div>
          <div class="card-body">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addClassMajorModal">Add New Class Major</button>
             <!-- Show Table from Database -->
             <table class="table table-bordered mt-3">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Class Major Name</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($classMajors as $class1)
                      <tr>
                          <td>{{ $class1->id }}</td>
                          <td>{{ $class1->class_major_name }}</td>
                          <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editClassMajorModal"
                                data-id="{{ $class1->id }}"
                                data-majorname="{{ $class1->class_major_name }}">
                                Edit
                            </button>
                            <form action="{{ route('classMajors.destroy', $class1->id) }}" method="POST" onsubmit="return confirmDelete()">
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
    @include('admin.classes.classes_modals')

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
  $('#editClassModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); 
    var name = button.data('name'); 
    var major = button.data('major'); 
    var capacity = button.data('capacity'); 

    var modal = $(this);
    modal.find('#edit_class_name').val(name);
    modal.find('#edit_class_major').val(major);
    modal.find('#edit_class_capacity').val(capacity);
    modal.find('#editClassForm').attr('action', '/admin/classes/' + id);
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
  $('#editClassMajorModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); 
    var majorname = button.data('majorname'); 

    var modal = $(this);
    modal.find('#edit_class_major_name').val(majorname);
    modal.find('#editClassMajorForm').attr('action', '/admin/classes/class_major/' + id);
  });
});

function confirmDelete() {
    return confirm('Are you sure you want to delete this data?');
}
//other script
</script>
@endsection

