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
    .badge-blue {
      background:#2563eb;
      color:#fff;
      font-weight:600;
      padding:3px 10px;
      border-radius:6px;
    }
  </style>
  <div class="container" style="padding-top: 16px;">
    <div class="row g-3">
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
            <span class="badge-blue">Urgent</span>
            <div style="font-size:18px; color:#2563eb;">✉️ 💬</div>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="reminder-card" data-bs-toggle="modal" data-bs-target="#modal2">
          <div class="d-flex align-items-center gap-3 mb-2">
            <div style="font-size:28px;">💻</div>
            <div>
              <div style="font-size:16px; font-weight:600; color:#111827;">Software License</div>
              <div style="font-size:14px; color:#6b7280;">License</div>
            </div>
          </div>
          <div style="font-size:14px; color:#374151;">📅 Oct 18, 2025</div>
          <p style="font-size:14px; color:#4b5563; margin-top:6px;">Renewal required for critical enterprise software.</p>
          <div class="d-flex align-items-center justify-content-between mt-2">
            <span class="badge-blue">Pending</span>
            <div style="font-size:18px; color:#2563eb;">✉️ 💬</div>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="reminder-card" data-bs-toggle="modal" data-bs-target="#modal3">
          <div class="d-flex align-items-center gap-3 mb-2">
            <div style="font-size:28px;">🌐</div>
            <div>
              <div style="font-size:16px; font-weight:600; color:#111827;">Domain Renewal</div>
              <div style="font-size:14px; color:#6b7280;">Domain</div>
            </div>
          </div>
          <div style="font-size:14px; color:#374151;">📅 Nov 12, 2025</div>
          <p style="font-size:14px; color:#4b5563; margin-top:6px;">Company domain registration renewal deadline.</p>
          <div class="d-flex align-items-center justify-content-between mt-2">
            <span class="badge-blue">Reminder</span>
            <div style="font-size:18px; color:#2563eb;">✉️ 💬</div>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="reminder-card" data-bs-toggle="modal" data-bs-target="#modal4">
          <div class="d-flex align-items-center gap-3 mb-2">
            <div style="font-size:28px;">🔐</div>
            <div>
              <div style="font-size:16px; font-weight:600; color:#111827;">SSL Certificate</div>
              <div style="font-size:14px; color:#6b7280;">Security</div>
            </div>
          </div>
          <div style="font-size:14px; color:#374151;">📅 Dec 1, 2025</div>
          <p style="font-size:14px; color:#4b5563; margin-top:6px;">SSL certificate for company website will expire.</p>
          <div class="d-flex align-items-center justify-content-between mt-2">
            <span class="badge-blue">Critical</span>
            <div style="font-size:18px; color:#2563eb;">✉️ 💬</div>
          </div>
        </div>
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

<!-- Modal 2 -->
<div class="modal fade" id="modal2" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-2">
      <div class="modal-header">
        <div class="d-flex align-items-center gap-3">
          <div style="font-size:28px;">💻</div>
          <div>
            <h5 class="modal-title fw-bold mb-0">Software License</h5>
            <span class="badge bg-light text-dark mt-1">License</span>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><b>Expires:</b> October 18, 2025</p>
        <p>Renewal required for critical enterprise software.</p>
        <p><b>Notifications:</b> ✉️ 💬 Email & WhatsApp</p>
        <p><b>Recipient:</b> license@company.com</p>
        <span class="badge bg-warning text-dark">Pending</span>
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

<!-- Modal 3 -->
<div class="modal fade" id="modal3" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-2">
      <div class="modal-header">
        <div class="d-flex align-items-center gap-3">
          <div style="font-size:28px;">🌐</div>
          <div>
            <h5 class="modal-title fw-bold mb-0">Domain Renewal</h5>
            <span class="badge bg-light text-dark mt-1">Domain</span>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><b>Expires:</b> November 12, 2025</p>
        <p>Company domain registration renewal deadline.</p>
        <p><b>Notifications:</b> ✉️ 💬 Email & WhatsApp</p>
        <p><b>Recipient:</b> admin@company.com</p>
        <span class="badge bg-info text-dark">Reminder</span>
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

<!-- Modal 4 -->
<div class="modal fade" id="modal4" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-2">
      <div class="modal-header">
        <div class="d-flex align-items-center gap-3">
          <div style="font-size:28px;">🔐</div>
          <div>
            <h5 class="modal-title fw-bold mb-0">SSL Certificate</h5>
            <span class="badge bg-light text-dark mt-1">Security</span>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><b>Expires:</b> December 1, 2025</p>
        <p>SSL certificate for company website will expire.</p>
        <p><b>Notifications:</b> ✉️ 💬 Email & WhatsApp</p>
        <p><b>Recipient:</b> security@company.com</p>
        <span class="badge bg-danger">Critical</span>
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

@endsection