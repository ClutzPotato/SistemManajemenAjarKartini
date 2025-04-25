<!-- Modal for Adding File Attachment -->
<div class="modal fade" id="addAttachmentModal" tabindex="-1" role="dialog" aria-labelledby="addAttachmentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAttachmentModalLabel">Add New File Attachment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('file_attachments.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="material_id">Material:</label>
                        <select class="form-control" id="material_id" name="material_id" required>
                            <option value="">Select Material</option>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}">{{ $material->subject->subject_name }} - {{ $material->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file_name" class="col-form-label">File Name: (Max File size: 2048kb)</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add File Attachment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

