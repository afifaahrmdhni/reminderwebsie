<!-- Modal -->
<div class="modal fade" id="createReminderModal" tabindex="-1" aria-labelledby="createReminderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createReminderModalLabel">Create Reminder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('reminders-admin.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          {{-- Name / Type --}}
          <div class="mb-3">
            <label class="form-label">Name / Type</label>
            <input type="text" class="form-control" name="title" placeholder="e.g., WebApp Domain" required>
          </div>

          {{-- Category & Expiration --}}
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Category</label>
              <select class="form-select" name="category_id" required>
                <option value="">Select a category</option>
                @foreach ($categories as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Expiration Date</label>
              <input type="date" class="form-control" name="due_date" required>
            </div>
          </div>

          {{-- Description --}}
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3" placeholder="Describe the item or service..."></textarea>
          </div>

          {{-- Recipient Email(s) --}}
          <label for="recipientEmail">Recipient Email(s)</label>
<input type="text" id="recipientEmail" class="form-control" autocomplete="off" name="recipient_email[]">
<div id="emailList" class="dropdown-menu" style="display:block; position:absolute; display:none"></div>
{{-- Recipient phone --}}
  <label for="recipientPhone">Recipient Phone(s)</label>
  <input type="text" id="recipientPhone" name="recipient_phone[]" class="form-control">
      </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Reminder</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal End -->