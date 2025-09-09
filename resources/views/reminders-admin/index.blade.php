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
  }
  .reminder-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.25);
  }
  .modal-content {
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    border: none;
  }
  .modal-header {
    border-bottom: none;
    background: #2563eb;
    color: white;
    border-top-left-radius: 14px;
    border-top-right-radius: 14px;
  }
  .modal-header h5, .modal-header div {
    color: white !important;
  }
  .modal-footer {
    border-top: none;
  }
</style>

<div class="container" style="padding-top: 16px;">
  <div class="row g-3" style="background-color: #e5e7eb; border-radius: 12px;">

    <div class="d-flex justify-content-between align-items-center">
      <h2 class="h2" style="padding-left: 15px;">Active Reminders</h2>
      <span class="btn btn-primary" style="margin-right: 15px;" data-bs-toggle="modal" data-bs-target="#createReminderModal">
        <i class="fa-solid fa-plus" style="margin-right:2px"></i>
        Tambah Reminder
      </span>
      {{-- include modal create --}}
      @include('reminders-admin.create')
    </div>

    {{-- Looping Reminders --}}
    @forelse ($reminders as $reminder)
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="reminder-card" data-bs-toggle="modal" data-bs-target="#reminderModal{{ $reminder->id }}">
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
          <div style="font-size:14px; color:#374151;">
            📅 {{ $reminder->due_date ? \Carbon\Carbon::parse($reminder->due_date)->format('M d, Y') : '-' }}
          </div>
          <p style="font-size:14px; color:#4b5563; margin-top:6px;">
            {{ $reminder->description ?? '-' }}
          </p>
          <div class="d-flex align-items-center justify-content-between mt-2">
            {{-- Badge dinamis --}}
            @php
              $today = \Carbon\Carbon::today();
              $due   = $reminder->due_date ? \Carbon\Carbon::parse($reminder->due_date) : null;
              $daysLeft = $due ? $today->diffInDays($due, false) : null;
            @endphp

            @if (is_null($due))
              <span class="badge bg-secondary">No Due Date</span>
            @elseif ($daysLeft > 14)
              <span class="badge bg-success">Active</span>
            @elseif ($daysLeft > 7)
              <span class="badge bg-warning text-dark">Expiring Soon</span>
            @elseif ($daysLeft >= 0)
              <span class="badge bg-danger">Critical</span>
            @else
              <span class="badge bg-dark">Expired</span>
            @endif

            <div style="font-size:18px; color:#2563eb;">✉️ 💬</div>
          </div>
        </div>
      </div>

      {{-- Modal Detail --}}
      <div class="modal fade" id="reminderModal{{ $reminder->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header">
              <div class="d-flex align-items-center gap-3">
                <div style="font-size:28px;">📌</div>
                <div>
                  <h5 class="modal-title fw-bold mb-0">{{ $reminder->title }}</h5>
                  <span class="badge bg-light text-dark mt-1">
                    {{ $reminder->category->name ?? 'No Category' }}
                  </span>
                </div>
              </div>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p><b>Expires:</b>
                {{ $reminder->due_date ? \Carbon\Carbon::parse($reminder->due_date)->format('F d, Y') : '-' }}
              </p>
              <p>{{ $reminder->description ?? 'No description' }}</p>
              <p><b>Emails:</b> {{ $reminder->recipient_emails ? implode(', ', $reminder->recipient_emails) : '-' }}</p>
              <p><b>Phones:</b> {{ $reminder->recipient_phones ? implode(', ', $reminder->recipient_phones) : '-' }}</p>

              {{-- Badge dinamis di modal --}}
              @php
                $today = \Carbon\Carbon::today();
                $due   = $reminder->due_date ? \Carbon\Carbon::parse($reminder->due_date) : null;
                $daysLeft = $due ? $today->diffInDays($due, false) : null;
              @endphp

              @if (is_null($due))
                <span class="badge bg-secondary">No Due Date</span>
              @elseif ($daysLeft > 14)
                <span class="badge bg-success">Active</span>
              @elseif ($daysLeft > 7)
                <span class="badge bg-warning text-dark">Expiring Soon</span>
              @elseif ($daysLeft >= 0)
                <span class="badge bg-danger">Critical</span>
              @else
                <span class="badge bg-dark">Expired</span>
              @endif
            </div>
            <div class="modal-footer justify-content-between">
              <div>
                {{-- Tombol Edit --}}
                <button type="button" class="btn btn-sm btn-warning text-white"
                        data-bs-toggle="modal"
                        data-bs-target="#editReminderModal{{ $reminder->id }}">
                  Edit
                </button>

                {{-- Tombol Delete --}}
                <form action="{{ route('reminders-admin.destroy', $reminder->id) }}"
                      method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus reminder ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">
                    Delete
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Modal Edit --}}
      @include('reminders-admin.edit', ['reminder' => $reminder, 'categories' => $categories])

    @empty
      <p class="text-center text-muted py-4">Belum ada reminder.</p>
    @endforelse

  </div>
</div>

@endsection
