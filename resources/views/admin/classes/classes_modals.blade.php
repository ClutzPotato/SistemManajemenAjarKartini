    <!-- Modal for Adding Class -->
    <div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addClassModalLabel">Add New Class Major</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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

      <!-- Single Edit Class Modal -->
      <div class="modal fade" id="editClassModal" tabindex="-1" role="dialog" aria-labelledby="editClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editClassModalLabel">Edit Class</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="editClassForm" method="POST" action="">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="edit_class_name" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="edit_class_name" name="class_name" required>
            </div>
            <div class="mb-3">
                <label for="edit_class_major" class="form-label">Class Major</label>
                <select class="form-control" id="edit_class_major" name="class_major" required>
                @foreach ($classMajors as $major)
                    <option value="{{ $major->class_major_name }}">{{ $major->class_major_name }}</option>
                @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="edit_class_capacity" class="form-label">Class Capacity</label>
                <input type="number" class="form-control" id="edit_class_capacity" name="class_capacity" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
        </div>
    </div>
    </div>
    
<!-- Single Edit Class Modal -->
    <div class="modal fade" id="editClassModal" tabindex="-1" role="dialog" aria-labelledby="editClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editClassModalLabel">Edit Class</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="editClassForm" method="POST" action="">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="edit_class_name" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="edit_class_name" name="class_name" required>
            </div>
            <div class="mb-3">
                <label for="edit_class_major" class="form-label">Class Major</label>
                <select class="form-control" id="edit_class_major" name="class_major" required>
                @foreach ($classMajors as $major)
                    <option value="{{ $major->class_major_name }}">{{ $major->class_major_name }}</option>
                @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="edit_class_capacity" class="form-label">Class Capacity</label>
                <input type="number" class="form-control" id="edit_class_capacity" name="class_capacity" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal for Adding Class Major -->
    <div class="modal fade" id="addClassMajorModal" tabindex="-1" role="dialog" aria-labelledby="addClassMajorModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addClassMajorModalLabel">Add New Class Major</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('classMajors.store') }}">
              @csrf
              <div class="form-group">
                <label for="class_major_name" class="col-form-label">Class Major Name:</label>
                <input type="text" class="form-control" id="class_major_name" name="class_major_name" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Class Major</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

<!-- Single Edit Class Modal -->
<div class="modal fade" id="editClassMajorModal" tabindex="-1" role="dialog" aria-labelledby="editClassMajorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editClassMajorModalLabel">Edit Class</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="editClassMajorForm" method="POST" action="">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="edit_class_major_name" class="form-label">Class Major Name</label>
                <input type="text" class="form-control" id="edit_class_major_name" name="class_major_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
        </div>
    </div>
    </div>

  <!-- Attach Subjects Modal -->
<div class="modal fade" id="attachSubjectsModal" tabindex="-1" role="dialog" aria-labelledby="attachSubjectsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="attachSubjectsForm" method="POST" action="{{ route('classes.attachSubjects') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="attachSubjectsModalLabel">Attach Subjects to Class</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="class_id" id="attach_class_id">
          <div class="form-group">
            <label>Select Subjects</label>
            <div>
              @foreach($subjectsbatch as $subject)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="subjects[]" value="{{ $subject->id }}" id="subject{{ $subject->id }}">
                  <label class="form-check-label" for="subject{{ $subject->id }}">
                    {{ $subject->subject_name }}
                  </label>
                </div>
              @endforeach
            </div>
            <div class="pagination-links">
                            {{ $subjectsbatch->links() }}
                </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Attach Subjects</button>
        </div>
      </form>
    </div>
  </div>
</div>
