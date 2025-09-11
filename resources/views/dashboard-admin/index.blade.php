@extends ('backend.master')

@section ('navbar')
@include('backend.navbar')
@endsection

@section('sidebar')
@include('backend.sidebar')
@endsection

@section ('content')
<main class="p-6" id="dashboard-content">
  <!-- Metrics Cards -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Users -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-600">Total User Terdaftar</p>
          <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
        </div>
        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
          <i class="fas fa-users text-primary text-xl"></i>
        </div>
      </div>
    </div>

    <!-- Total Reminder Items -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-600">Total Item Reminder</p>
          <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalReminders }}</p>
        </div>
        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
          <i class="fas fa-clipboard-list text-secondary text-xl"></i>
        </div>
      </div>
    </div>

    <!-- Items Due Soon -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-600">Mendekati Jatuh Tempo</p>
          <p class="text-3xl font-bold text-gray-900 mt-2">{{ $duesoonReminders }}</p>
        </div>
        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
          <i class="fas fa-clock text-red-500 text-xl"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Urgent Reminders -->
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">⚠️ Urgent Reminders</h5>
      <a href="{{ route('reminders-admin.index', ['status' => 'urgent']) }}" class="text-decoration-none small text-primary">Lihat Selengkapnya</a>
    </div>
    <ul class="list-group list-group-flush">
      @foreach($urgentReminders->take(3) as $reminder)
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <strong>{{ $reminder->title }}</strong><br>
            <small class="text-muted">📅 {{ $reminder->due_date?->format('d M Y') }}</small>
          </div>
          <div class="small">
            <a href="#" data-bs-toggle="modal" data-bs-target="#reminderModal{{ $reminder->id }}" class="btn btn-danger">Detail</a>
          </div>
        </li>

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
                  @php
                    $due = $reminder->due_date;
                    $daysLeft = $due ? now()->diffInDays($due, false) : null;
                  @endphp
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
                  <b>📅 Expiration:</b> 
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
                    <button class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editReminderModal{{ $reminder->id }}">
                      Edit
                    </button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteReminderModal{{ $reminder->id }}">
                      Delete
                    </button>
                  </div>
                @endif
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div>

            </div>
          </div>
        </div>
      @endforeach
    </ul>
  </div>

  <!-- Reminder Terbaru -->
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">🆕 Reminder Terbaru</h5>
      <a href="{{ route('reminders-admin.index')}}" class="text-decoration-none small text-primary">Lihat Selengkapnya</a>
    </div>
    <ul class="list-group list-group-flush">
      @foreach($latestReminders->take(5) as $reminder)
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <strong>{{ $reminder->title }}</strong><br>
            <small class="text-muted">📅 {{ $reminder->due_date?->format('d M Y') }}</small>
          </div>
          <div class="small">
            <a href="#" data-bs-toggle="modal" data-bs-target="#reminderModal{{ $reminder->id }}" class="btn btn-primary">Detail</a>
          </div>
        </li>
      @endforeach
    </ul>
  </div>

  <!-- Reminder Expired -->
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">📦 Reminder Expired</h5>
      <a href="{{ route('reminders-admin.index') }}" class="text-decoration-none small text-primary">Lihat Selengkapnya</a>
    </div>
    <ul class="list-group list-group-flush">
      @foreach($expiredReminders->take(3) as $reminder)
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <strong>{{ $reminder->title }}</strong><br>
            <small class="text-muted">📅 {{ $reminder->due_date?->format('d M Y') }}</small>
          </div>
          <div class="btn btn-primary">Reactivate</div>
        </li>
      @endforeach
    </ul>
  </div>
</main>
@endsection
