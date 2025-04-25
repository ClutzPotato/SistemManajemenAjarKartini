    <!-- Modal for Adding Subject -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addSubjectModalLabel">Add New Subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('subjects.store') }}">
              @csrf
              <div class="form-group">
                <label for="subject_name" class="col-form-label">Class subject Name:</label>
                <input type="text" class="form-control" id="subject_name" name="subject_name" required>
              </div>
              <div class="form-group">
            <label for="subject_description">Subject Description</label>
            <textarea class="form-control" id="subject_description" name="subject_description" rows="5" required></textarea>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Class subject</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

<!-- Single Edit Subject Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="editSubjectForm" method="POST" action="">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="edit_subject_name" class="form-label">Class subject Name</label>
                <input type="text" class="form-control" id="edit_subject_name" name="subject_name" required>
            </div>
            <div class="form-group">
            <label for="subject_description">Subject Description</label>
            <textarea class="form-control" id="subject_description" name="subject_description" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
        </div>
    </div>
    </div>
