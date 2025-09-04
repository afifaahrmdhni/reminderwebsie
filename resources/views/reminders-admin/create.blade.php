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
            <input type="text" class="form-control" name="name" placeholder="e.g., WebApp Domain" required>
          </div>

          {{-- Category & Expiration --}}
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Category</label>
              <select class="form-select" name="category" required>
                <option value="">Select a category</option>
                <option value="domain">Domain</option>
                <option value="license">License</option>
                <option value="server">Server</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Expiration Date</label>
              <input type="date" class="form-control" name="expiration_date" required>
            </div>
          </div>

          {{-- Description --}}
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3" placeholder="Describe the item or service..."></textarea>
          </div>

          {{-- Recipient Email(s) --}}
        <div class="mb-3">
        <label class="form-label">Recipient Email(s)</label>
        <input type="text" name="recipient_emails" class="form-control"
                placeholder="email1@domain.com, email2@domain.com">
        </div>

        <div class="mb-3">
        <label class="form-label">Recipient Phone(s)</label>
        <input type="text" name="recipient_phones" class="form-control"
                placeholder="+628111111, +628222222">
        </div>

          {{-- Notification Type --}}
          {{-- <div class="mb-3">
            <label class="form-label">Notification Type</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="notification_type" value="email" checked>
              <label class="form-check-label">Email</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="notification_type" value="whatsapp">
              <label class="form-check-label">WhatsApp</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="notification_type" value="both">
              <label class="form-check-label">Both</label>
            </div>
          </div> --}}
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