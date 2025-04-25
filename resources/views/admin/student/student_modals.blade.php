<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editStudentModalLabel">Assign Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="assignClassForm" method="POST" action="">
        @csrf
        @method('PATCH')
        <div class="modal-body">
          <input type="hidden" id="studentId" name="student_id">
          <div class="form-group">
            <label for="classId">Select Class:</label>
            <select class="form-control" id="classId" name="class_id">
              @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- batch assign -->
<div class="modal fade" id="batchAssignModal" tabindex="-1" role="dialog" aria-labelledby="batchAssignModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="batchAssignModalLabel">Batch Assign</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="batchAssignForm" method="POST" action="{{ route('students.batch_assign') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="classId">Select Class:</label>
                        <select class="form-control" id="classId" name="class_id">
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Users:</label>
                        <div id="student-checkboxes">
                            @foreach($studentsbatch as $student)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="users[]" value="{{ $student->user_id }}">
                                    <label class="form-check-label">{{ $student->user->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="pagination-links">
                            {{ $studentsbatch->links() }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>
