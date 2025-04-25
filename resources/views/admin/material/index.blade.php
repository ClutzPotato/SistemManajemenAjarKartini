@extends('layouts.admindefault')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Material Database</h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
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
                <!-- Other content -->


        <!-- Card -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Materials</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#addMaterialModal">Add New Material</button>
                        <!-- Show Table from Database -->
                        <br>
                        <br>
                        <table id="example" class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Subject Name</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materials as $material)
                                <tr>
                                    <td>{{ $material->id }}</td>
                                    <td>{{ $material->subject->subject_name }}</td>
                                    <td>{{ $material->title }}</td>
                                    <td>{{ $material->type }}</td>
                                    <td>{!! nl2br(e($material->description)) !!}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#editMaterialModal" data-id="{{ $material->id }}"
                                            data-subject_id="{{ $material->subject_id }}"
                                            data-title="{{ $material->title }}"
                                            data-type="{{ $material->type }}"
                                            data-description="{{ $material->description }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('material.destroy', $material->id) }}" method="POST"
                                            onsubmit="return confirmDelete()">
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
        @include('admin.material.material_modals')
    </div>
</div>
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
        $('#editMaterialModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id');
            var subject_id = button.data('subject_id');
            var title = button.data('title');
            var type = button.data('type');
            var description = button.data('description');

            var modal = $(this);
            modal.find('#subject_id').val(subject_id);
            modal.find('#material_title').val(title);
            modal.find('#material_type').val(type);
            modal.find('#material_description').val(description);
            modal.find('#editMaterialForm').attr('action','/admin/material/' + id);
        });
    });

    function confirmDelete() {
        return confirm('Are you sure you want to delete this data?');
    }
</script>
@endsection