@extends('layouts.admindefault')

    @section('content')
                        
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Subject Database</h1>
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
            <h3 class="card-title">Subjects</h3>
          </div>
          <div class="card-body">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSubjectModal">Add New Subject</button>
            <br><br>
            <form method="GET" action="{{ route('subjects.index') }}" class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ request('search') }}">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <br>
            <!-- Show Table from Database -->
            <table id="example" class="table table-bordered mt-3">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Subject Name</th>
                  <th>Subject Description</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($subjects as $subject1)
                <tr>
                  <td>{{ $subject1->id }}</td>
                  <td>{{ $subject1->subject_name }}</td>
                  <td>{{ $subject1->subject_description }}</td>
                  <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editSubjectModal"
                      data-id="{{ $subject1->id }}"
                      data-subjectname="{{ $subject1->subject_name }}"
                      data-subjectdescription="{{ $subject1->subject_description }}">
                      Edit
                    </button>
                    <form action="{{ route('subjects.destroy', $subject1->id) }}" method="POST" onsubmit="return confirmDelete()">
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
    @include('admin.subject.subject_modals')
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
        searching: false
    });
});
$(document).ready(function() {
  $('#editSubjectModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); 
    var subjectname = button.data('subjectname'); 
    var subjectdesc = button.data('subjectdescription'); 

    var modal = $(this);
    modal.find('#edit_subject_name').val(subjectname);
    modal.find('#subject_description').val(subjectdesc);
    modal.find('#editSubjectForm').attr('action','/admin/subject/' + id);
  });
});

function confirmDelete() {
    return confirm('Are you sure you want to delete this data?');
}
//other script
</script>
@endsection

