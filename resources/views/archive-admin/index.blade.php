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
    height: 100%;
  }
  .reminder-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.25);
  }
  .reminder-title {
    font-size:16px;
    font-weight:600;
    color:#111827;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 180px;
  }
  .reminder-desc {
    font-size:14px;
    color:#4b5563;
    margin-top:6px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .modal-content {
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    border: none;
  }
  .modal-header {
    border-bottom: none;
    background: #7d7d7d;
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
  .badge-blue {
    background:#7d7d7d;
    color:#fff;
    font-weight:600;
    padding:3px 10px;
    border-radius:6px;
  }
</style>

<div class="container py-4">
  <h2 class="mb-3 h2">Archived Reminders</h2>

  <div class="row g-3">
    @forelse ($reminders as $reminder)
      <div class="col-12 col-sm-6 col-lg-3">
        {{-- Card --}}
        <div class="reminder-card" data-bs-toggle="modal" data-bs-target="#modal-{{ $reminder->id }}">
          <div class="d-flex align-items-center gap-3 mb-2">
            <div style="font-size:28px;">📦</div>
            <div>
              <div class="reminder-title">{{ $reminder->title }}</div>
              <div style="font-size:14px; color:#6b7280;">
                {{ $reminder->category->name ?? 'No Category' }}
              </div>
            </div>
          </div>
          <div style="font-size:14px; color:#374151;">
            📅 {{ $reminder->due_date?->format('M d, Y') ?? '-' }}
          </div>
          <p class="reminder-desc">
            {{ $reminder->description }}
          </p>
          <div class="d-flex align-items-center justify-content-between mt-2">
            <span class="badge-blue">Archived</span>
            <div style="font-size:18px; color:#2563eb;">✉️ 💬</div>
          </div>
        </div>
      </div>

      {{-- Modal Detail --}}
      <div class="modal fade" id="modal-{{ $reminder->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header">
              <div class="d-flex align-items-center gap-3">
                <div style="font-size:28px;">📦</div>
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
              <p><b>Expires:</b> {{ $reminder->due_date?->format('F d, Y') ?? '-' }}</p>
              <p>{{ $reminder->description }}</p>
              <p><b>Notifications:</b> ✉️ 💬 Email & WhatsApp</p>
              @if ($reminder->recipient_emails)
                <p><b>Recipients (Email):</b> {{ implode(', ', $reminder->recipient_emails) }}</p>
              @endif
              @if ($reminder->recipient_phones)
                <p><b>Recipients (Phone):</b> {{ implode(', ', $reminder->recipient_phones) }}</p>
              @endif
            </div>
            <div class="modal-footer justify-content-between">
              {{-- Reactivate --}}
              <form method="POST" action="{{ route('archive-admin.restore', $reminder->id) }}">
                @csrf
                <button class="btn btn-sm btn-outline-primary">Reactivate</button>
              </form>

              {{-- Trigger Delete Modal --}}
              <button type="button" class="btn btn-sm btn-outline-danger"
                data-bs-toggle="modal"
                data-bs-target="#deleteArchiveModal{{ $reminder->id }}">
                🗑️ Delete
              </button>
            </div>
          </div>
        </div>
      </div>

      {{-- Modal Delete --}}
      <div class="modal fade" id="deleteArchiveModal{{ $reminder->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title">Confirm Delete</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              Yakin mau hapus permanen reminder <b>{{ $reminder->title }}</b>?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form action="{{ route('archive-admin.forceDelete', $reminder->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    @empty
      <p class="text-center">Belum ada arsip reminder.</p>
    @endforelse
  </div>
</div>
@endsection
