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
              <input type="date" class="form-control" name="due_date">
            </div>
          </div>

          {{-- Description --}}
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3" placeholder="Describe the item or service..."></textarea>
          </div>


          {{-- Recipient Email(s) --}}
<div class="mb-3 position-relative">
    <label for="recipient_email">Recipient Email(s)</label>
    <div id="email-wrapper">
        <div class="position-relative mb-2">
            <input type="text" class="form-control recipient_email" name="recipient_email[]" placeholder="contoh: a@gmail.com" autocomplete="off">
            <div class="list-group position-absolute w-100 emailSuggestions" style="z-index:1000;"></div>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addEmail()">+ Tambah Email</button>
</div>

{{-- Recipient Phone(s) --}}
<div class="mb-3">
    <label for="recipient_phone">Recipient Phone(s)</label>
    <div id="phone-wrapper">
        <input type="text" class="form-control mb-2 recipient_phone" name="recipient_phone[]" placeholder="contoh: 08123456789">
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addPhone()">+ Tambah No HP</button>
</div>
          
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Reminder</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function addEmail() {
  const wrapper = document.getElementById('email-wrapper');
  const input = document.createElement('input');
  input.type = 'email';
  input.name = 'recipient_email[]';
  input.className = 'form-control mb-2';
  input.placeholder = 'contoh: b@gmail.com';
  wrapper.appendChild(input);
}

function addPhone() {
  const wrapper = document.getElementById('phone-wrapper');
  const input = document.createElement('input');
  input.type = 'text';
  input.name = 'recipient_phone[]';
  input.className = 'form-control mb-2';
  input.placeholder = 'contoh: 08234567890';
  wrapper.appendChild(input);
}
</script>
<!-- Modal End -->
