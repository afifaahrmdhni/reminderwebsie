@extends ('backend.master')

@section ('sidebar')
  @include('backend.sidebar')
@endsection

@section ('navbar')
  @include('backend.navbar')
@endsection

@section ('content')

<style>
  .reminder-card {
    padding:16px;
    border:1px solid #e5e7eb;
    border-radius:12px;
    background:#fff;
    cursor:pointer;
    transition: all 0.25s ease-in-out;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    min-height: 200px;
  }
  .reminder-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.25);
  }
  .description-text {
    word-wrap: break-word; 
    overflow-wrap: break-word;
  }
</style>

<div class="container" style="padding-top: 16px;">

    {{-- ALERT BOOTSTRAP --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="fa-solid fa-circle-xmark me-2"></i> {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif
  {{-- END ALERT --}}

  {{-- HEADER --}}
  <div class="d-flex align-items-center justify-content-between mb-4 px-3"
       style="background-color: #e5e7eb; border-radius: 12px; padding:12px 16px;">
    <h3 class="h3 mb-0">Active Reminders</h3>

    <div class="d-flex align-items-center gap-2">
      <form method="GET" action="{{ route('reminders-admin.index') }}" class="d-flex align-items-center gap-2">
        <select class="form-select form-select-sm" name="status" onchange="this.form.submit()" style="width: 140px; height:38px;">
            <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All</option>
            <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="upcoming" {{ $status == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
            <option value="urgent" {{ $status == 'urgent' ? 'selected' : '' }}>Urgent</option>
            <option value="expired" {{ $status == 'expired' ? 'selected' : '' }}>Expired</option>
        </select>
      </form>
      @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Super User' || auth()->user()->role === 'Multi User')
      <button class="btn btn-primary d-flex align-items-center"
              data-bs-toggle="modal" data-bs-target="#createReminderModal">
        <i class="fa-solid fa-plus me-1"></i> Tambah Reminder
      </button>
      @endif
    </div>
  </div>

  {{-- Modal Create --}}
  @include('reminders-admin.create')

  {{-- LIST REMINDERS --}}
  <div class="row g-3" id="reminderContainer">
    @forelse ($reminders as $reminder)
      @php
        $today = \Carbon\Carbon::today();
        $due   = $reminder->due_date ? \Carbon\Carbon::parse($reminder->due_date) : null;
        $daysLeft = $due ? $today->diffInDays($due, false) : null;

        if (is_null($due)) {
            $status = 'nodate';
        } elseif ($daysLeft > 14) {
            $status = 'active';
        } elseif ($daysLeft > 7) {
            $status = 'upcoming';
        } elseif ($daysLeft >= 0) {
            $status = 'urgent';
        } else {
            $status = 'expired';
        }
      @endphp

      {{-- Card Reminder --}}
      <div class="col-12 col-sm-6 col-lg-3 d-flex reminder-item" data-status="{{ $status }}">
        <div class="reminder-card d-flex flex-column w-100"
             data-bs-toggle="modal" data-bs-target="#reminderModal{{ $reminder->id }}">

          <div class="d-flex align-items-center gap-3 mb-2">
            <div style="font-size:28px;">📌</div>
            <div>
              <div style="font-size:16px; font-weight:600; color:#111827;">
                {{ $reminder->title }}
              </div>
              <div style="font-size:14px; color:#6b7280;">
                {{ $reminder->category->name ?? 'No Category' }}
              </div>
            </div>
          </div>

          <div class="flex-grow-1">
            <div style="font-size:14px; color:#374151;">
              📅 {{ $reminder->due_date ? \Carbon\Carbon::parse($reminder->due_date)->format('M d, Y') : '-' }}
            </div>

            <p style="padding-top:8px; font-size:14px; color:#374151; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; text-overflow:ellipsis;">
              {{ $reminder->description ?? '-' }}
            </p>
          </div>

          <div class="d-flex align-items-center justify-content-end mb-2">
            @if (is_null($due))
              <span class="badge bg-secondary fs-6">No Due Date</span>
            @elseif ($daysLeft > 14)
              <span class="badge bg-success fs-6">Active</span>
            @elseif ($daysLeft > 7)
              <span class="badge bg-warning text-dark fs-6">Upcoming</span>
            @elseif ($daysLeft >= 0)
              <span class="badge bg-danger fs-6">Urgent</span>
            @else
              <span class="badge bg-dark fs-6">Expired</span>
            @endif
          </div>
        </div>
      </div>

      {{-- Modal Detail --}}
      <div class="modal fade" id="reminderModal{{ $reminder->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content rounded-3 shadow">
            
            {{-- HEADER --}}
            <div class="modal-header bg-light d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center gap-3">
                <div style="font-size:40px;">📌</div>
                <div>
                  <h2 class="modal-title fw-bold mb-0" style="font-size:1.5rem;">
                    {{ $reminder->title }}
                  </h2>
                  <small class="text-muted" style="font-size:1rem;">
                    {{ $reminder->category->name ?? 'No Category' }}
                  </small>
                </div>
              </div>
              <div>
                @if (is_null($due))
                  <span class="badge bg-secondary fs-4">No Date</span>
                @elseif ($daysLeft > 14)
                  <span class="badge bg-success fs-4">Active</span>
                @elseif ($daysLeft > 7)
                  <span class="badge bg-warning text-dark fs-4">Upcoming</span>
                @elseif ($daysLeft >= 0)
                  <span class="badge bg-danger fs-4">Urgent</span>
                @else
                  <span class="badge bg-dark fs-4">Expired</span>
                @endif
              </div>
            </div>

              {{-- BODY --}}
              <div class="modal-body" style="max-width: 500px; word-wrap: break-word; white-space: normal;">
                <p class="mb-2">
                  <b>📅 Expired:</b> 
                  {{ $reminder->due_date?->format('F d, Y') ?? '-' }}
                </p>

                <div class="mb-2">
                  <b>Description:</b>
                  <p class="text-muted description-text mb-0">
                    {{ $reminder->description ?? '-' }}
                  </p>
                </div>

                <div class="mb-2">
                  <b>Emails:</b>
                  <p class="text-muted mb-0">
                    {{ $reminder->recipient_emails ? implode(', ', $reminder->recipient_emails) : '-' }}
                  </p>
                </div>

                <div class="mb-2">
                  <b>Phones:</b>
                  <p class="text-muted mb-0">
                    {{ $reminder->recipient_phones ? implode(', ', $reminder->recipient_phones) : '-' }}
                  </p>
                </div>
              </div>

              {{-- FOOTER --}}
              
              <div class="modal-footer d-flex justify-content-between">
                @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Super User')
                <div>
                  <button class="btn btn-warning text-white" 
                          data-bs-toggle="modal" 
                          data-bs-target="#editReminderModal{{ $reminder->id }}">
                    Edit
                  </button>
                  <button class="btn btn-danger" 
                          data-bs-toggle="modal" 
                          data-bs-target="#deleteReminderModal{{ $reminder->id }}">
                    Delete
                  </button>
                </div>
                 @endif
             
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div>

            </div>
          </div>
        </div>

      {{-- Modal Edit --}}
      @include('reminders-admin.edit', ['reminder' => $reminder, 'categories' => $categories])

      

      {{-- Modal Delete --}}
      <div class="modal fade" id="deleteReminderModal{{ $reminder->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title">Confirm Delete</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              Yakin mau hapus <b>{{ $reminder->title }}</b>?
            </div>
            <div class="modal-footer">
              <form action="{{ route('reminders-admin.destroy', $reminder->id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    @empty
      <p class="text-center text-muted py-4">Belum ada reminder.</p>
    @endforelse
  </div>
</div>
<script>
  setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => {
      let alert = new bootstrap.Alert(el);
      alert.close();
    });
  }, 10000); // ilang otomatis setelah 10 detik
</script>
@endsection

