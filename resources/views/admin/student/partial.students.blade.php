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
