<!-- Modal -->
<div class="modal fade" id="createReminderModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('reminders-admin.store') }}" method="POST">
        @csrf
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Create Reminder</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-select" required>
              <option value="">Select Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label>Due Date</label>
            <input type="date" name="due_date" class="form-control">
          </div>
          <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label>Recipient Emails (comma separated)</label>
            <input type="text" name="recipient_emails" class="form-control">
          </div>
          <div class="mb-3">
            <label>Recipient Phones (comma separated)</label>
            <input type="text" name="recipient_phones" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal End -->