<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel DataTables Example</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("/assets/dist/css/bootstrap.min.css")}}">
    <!-- DataTables CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/dataTables.bootstrap4.min.css') }}">
</head>
<body>

<div class="container">
    <h1>Laravel DataTables Example</h1>
    <table id="example" class="table table-striped table-bordered" style="width:100%">

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

<!-- jQuery -->
    <script src="{{asset("/assets/dist/js/jquery-3.5.1.js")}}"></script>
<!-- Bootstrap JS -->
    <script src="{{asset("/assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- DataTables JS --><!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>



<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>

</body>
</html>
