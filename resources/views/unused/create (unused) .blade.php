@extends('layouts.admindefault')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Table Card -->
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Create New Class') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('classes.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="class_name" class="form-label">Class Name</label>
                                <input type="text" class="form-control" id="class_name" name="class_name" required>
                            </div>

                            <div class="mb-3">
                            <label for="class_major" class="form-label">Class Major</label>
                                <select class="form-control" id="class_major" name="class_major" required>
                                    @foreach ($classMajors as $major)
                                        <option value="{{ $major->class_major_name }}">{{ $major->class_major_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="class_capacity" class="form-label">Class Capacity</label>
                                <input type="number" class="form-control" id="class_capacity" name="class_capacity" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Class</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
