@extends ('backend.master')
@section ('sidebar')
@include('backend.sidebar')
@endsection

@section ('navbar')
@include('backend.navbar')
@endsection

@section ('content')

  <style>
    /* Card Styling */
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
      box-shadow: 0 6px 16px rgba(37, 99, 235, 0.25); /* biru glow */
    }
    /* Modal Custom */
    .modal-content {
      border-radius: 14px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
      border: none;
    }
    .modal-header {
      border-bottom: none;
      background: #2563eb; /* biru Windster */
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
    /* Badge */
    .badge-condition {
      background:#ffd712;
      color:#000000;
      font-weight:600;
      padding:3px 10px;
      border-radius:6px;
    }
  </style>

  <div class="container" style="padding-top: 16px;">
    <div class="row g-3" style="background-color: #e5e7eb; border-radius: 12px;">
      <div class="d-flex justify-content-between align-items-center">
      <h2 class="h2" style="padding-left: 15px;">Active Reminder</h2>
      <span class="btn btn-primary" style="margin-right: 15px;" data-bs-toggle="modal" data-bs-target="#createReminderModal">
        <i class="fa-solid fa-plus" style="margin-right:  2px"></i>
        Add Reminder</span>

        {{-- include modal --}}
        @include('reminders-admin.create')

      </div>
      <div>
            <!-- Card 1 -->
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="reminder-card" data-bs-toggle="modal" data-bs-target="#modal1">
              <div class="d-flex align-items-center gap-3 mb-2">
                <div style="font-size:28px;">🔧</div>
                <div>
                  <div style="font-size:16px; font-weight:600; color:#111827;">Server Maintenance</div>
                  <div style="font-size:14px; color:#6b7280;">Maintenance</div>
                </div>
              </div>
              <div style="font-size:14px; color:#374151;">📅 Sep 5, 2025</div>
              <p style="font-size:14px; color:#4b5563; margin-top:6px;">Annual maintenance and support for on-premise servers.</p>
              <div class="d-flex align-items-center justify-content-between mt-2">
                <span class="badge-condition">Urgent</span>
                <div style="font-size:18px; color:#2563eb;">✉️ 💬</div>
              </div>
            </div>
          </div>

    <!-- Modal 1 -->
    <div class="modal fade" id="modal1" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header">
            <div class="d-flex align-items-center gap-3">
              <div style="font-size:28px;">🔧</div>
              <div>
                <h5 class="modal-title fw-bold mb-0">Server Maintenance</h5>
                <span class="badge bg-light text-dark mt-1">Maintenance</span>
              </div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p><b>Expires:</b> September 5, 2025</p>
            <p>Annual maintenance and support for on-premise servers.</p>
            <p><b>Notifications:</b> ✉️ 💬 Email & WhatsApp</p>
            <p><b>Recipient:</b> it-ops@company.com</p>
            <span class="badge bg-danger">Urgent</span>
          </div>
          <div class="modal-footer justify-content-between">
            <div>
              <button class="btn btn-sm btn-outline-primary">✏️ Edit</button>
              <button class="btn btn-sm btn-outline-danger">🗑️ Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
      

@endsection