<div class="modal fade" id="editReminderModal{{ $reminder->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-white">Edit Reminder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('reminders-admin.update', $reminder->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Name / Type</label>
            <input type="text" class="form-control" name="title" value="{{ $reminder->title }}" required>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Category</label>
              <select class="form-select" name="category_id" required>
                <option value="">Select a category</option>
                @foreach ($categories as $cat)
                  <option value="{{ $cat->id }}" {{ $cat->id == $reminder->category_id ? 'selected' : '' }}>
                    {{ $cat->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Expiration Date</label>
              <input type="date" class="form-control" name="due_date"
                     value="{{ $reminder->due_date ? \Carbon\Carbon::parse($reminder->due_date)->format('Y-m-d') : '' }}">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{ $reminder->description }}</textarea>
          </div>

          <div class="mb-3">
              <label class="form-label">Recipient Email(s)</label>
              <input type="text" name="recipient_emails" class="form-control"
                    placeholder="contoh: lama@gmail.com, baru@gmail.com"
                    value="{{ old('recipient_emails', implode(', ', $reminder->recipient_emails ?? [])) }}">
          </div>

          <div class="mb-3">
              <label class="form-label">Recipient Phone(s)</label>
              <input type="text" name="recipient_phones" class="form-control"
                    placeholder="contoh: 08123456789, 08987654321"
                    value="{{ old('recipient_phones', implode(', ', $reminder->recipient_phones ?? [])) }}"> {{-- ⬅️ UPDATE --}}
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-warning text-white">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Edit Reminder -->
