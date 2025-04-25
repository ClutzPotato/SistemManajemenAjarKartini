
<!-- Modal for Adding Material -->
<div class="modal fade" id="addMaterialModal" tabindex="-1" role="dialog" aria-labelledby="addMaterialModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMaterialModalLabel">Add New Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('material.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="subject_id">Subject:</label>
                        <select class="form-control" id="subject_id" name="subject_id" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="material_title" class="col-form-label">Material Title:</label>
                        <input type="text" class="form-control" id="material_title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="material_type">Material Type:</label>
                        <select class="form-control" id="material_type" name="type" required>
                            <option value="normal">Normal</option>
                            <option value="assignment">Assignment</option>
                            <option value="quiz">Quiz</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="material_description">Material Description</label>
                        <textarea class="form-control" id="material_description" name="description" rows="5"
                            required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Material</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Single Edit Material Modal -->
<div class="modal fade" id="editMaterialModal" tabindex="-1" role="dialog" aria-labelledby="editMaterialModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMaterialModalLabel">Edit Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMaterialForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="subject_id">Subject:</label>
                        <select class="form-control" id="subject_id" name="subject_id" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="material_title" class="form-label">Material Title</label>
                        <input type="text" class="form-control" id="material_title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="material_type">Material Type:</label>
                        <select class="form-control" id="material_type" name="type" required>
                            <option value="normal">Normal</option>
                            <option value="assignment">Assignment</option>
                            <option value="quiz">Quiz</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="material_description">Material Description</label>
                        <textarea class="form-control" id="material_description" name="description" rows="5"
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>