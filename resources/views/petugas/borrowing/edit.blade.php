<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Peminjaman | PerpusInd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --red:       #DC2626;
            --red-dk:    #991B1B;
            --red-bg:    #FEF2F2;
            --red-sf:    #FEE2E2;
            --gray-50:   #F9FAFB;
            --gray-100:  #F3F4F6;
            --gray-200:  #E5E7EB;
            --gray-300:  #D1D5DB;
            --gray-400:  #9CA3AF;
            --gray-500:  #6B7280;
            --gray-700:  #374151;
            --gray-900:  #111827;
            --green:     #16A34A;
            --green-bg:  #DCFCE7;
            --amber:     #D97706;
            --amber-bg:  #FEF3C7;
            --blue:      #2563EB;
            --blue-bg:   #EFF6FF;
            --blue-mid:  #BFDBFE;
            --violet:    #7C3AED;
            --violet-bg: #F5F3FF;
            --sb-w:      240px;
        }

        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--gray-50); color: var(--gray-900); display: flex; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; cursor: pointer; }

        @keyframes fadeUp   { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: none; } }
        @keyframes fadeDown { from { opacity: 0; transform: translateY(-8px);  } to { opacity: 1; transform: none; } }
        .au { animation: fadeUp .5s ease both; }
        .d1 { animation-delay: .05s; } .d2 { animation-delay: .12s; }
        .d3 { animation-delay: .19s; } .d4 { animation-delay: .26s; }

        /* ── SIDEBAR ── */
        .sidebar { width: var(--sb-w); background: #fff; border-right: 1px solid var(--gray-200); display: flex; flex-direction: column; position: sticky; top: 0; height: 100vh; flex-shrink: 0; z-index: 100; }
        .sb-brand { display: flex; align-items: center; gap: 10px; padding: 20px 18px; border-bottom: 1px solid var(--gray-100); }
        .sb-logo-box { width: 34px; height: 34px; background: var(--red); border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .sb-logo-box i { color: #fff; font-size: 14px; }
        .sb-title { font-size: 16px; font-weight: 800; letter-spacing: -.02em; }
        .sb-title span { color: var(--red); }
        .sb-sub { font-size: 10px; font-weight: 600; color: var(--gray-400); letter-spacing: .05em; text-transform: uppercase; margin-top: 1px; }

        .sb-nav { flex: 1; padding: 12px 10px; display: flex; flex-direction: column; gap: 2px; overflow-y: auto; }
        .sb-group { font-size: 10px; font-weight: 700; letter-spacing: .1em; color: var(--gray-400); text-transform: uppercase; padding: 12px 10px 5px; }
        .sb-link { display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 9px; font-size: 13px; font-weight: 500; color: var(--gray-500); transition: background .15s, color .15s; }
        .sb-link i { width: 16px; text-align: center; font-size: 13px; }
        .sb-link:hover { background: var(--gray-100); color: var(--gray-900); }
        .sb-link.active { background: var(--red-bg); color: var(--red); font-weight: 700; }

        .sb-footer { padding: 12px 10px; border-top: 1px solid var(--gray-100); }
        .sb-user { display: flex; align-items: center; gap: 9px; padding: 9px 10px; border-radius: 9px; background: var(--gray-50); margin-bottom: 8px; }
        .sb-avatar { width: 32px; height: 32px; border-radius: 50%; background: var(--red); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 12px; font-weight: 700; flex-shrink: 0; }
        .sb-uname { font-size: 12.5px; font-weight: 700; }
        .sb-urole { font-size: 10.5px; color: var(--gray-400); }
        .sb-logout { width: 100%; display: flex; align-items: center; gap: 9px; padding: 9px 12px; border: none; background: none; border-radius: 9px; font-size: 13px; font-weight: 600; color: var(--red); transition: background .15s; }
        .sb-logout:hover { background: var(--red-bg); }

        /* ── TOPBAR ── */
        .topbar { display: none; position: sticky; top: 0; z-index: 50; background: rgba(255,255,255,.92); backdrop-filter: blur(12px); border-bottom: 1px solid var(--gray-100); padding: 13px 20px; align-items: center; justify-content: space-between; }
        .mob-title { font-size: 17px; font-weight: 800; letter-spacing: -.02em; }
        .mob-title span { color: var(--red); }
        .mob-ham { display: flex; flex-direction: column; gap: 5px; background: transparent; border: none; padding: 4px; }
        .mob-ham span { width: 20px; height: 2px; background: var(--gray-700); border-radius: 2px; transition: .25s; display: block; }
        .sb-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.3); z-index: 99; }
        .sb-overlay.show { display: block; }

        @media (max-width: 768px) {
            .topbar { display: flex; }
            .sidebar { position: fixed; left: 0; top: 0; transform: translateX(-100%); transition: transform .3s ease; }
            .sidebar.open { transform: translateX(0); box-shadow: 4px 0 24px rgba(0,0,0,.1); }
            main { padding: 24px 18px; }
            body { flex-direction: column; }
            .info-strip { grid-template-columns: 1fr !important; }
        }

        /* ── MAIN ── */
        main { flex: 1; padding: 32px 36px; overflow-x: hidden; min-width: 0; }

        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--gray-400); margin-bottom: 16px; animation: fadeDown .4s ease both; }
        .breadcrumb a { color: var(--gray-400); font-weight: 500; transition: color .15s; }
        .breadcrumb a:hover { color: var(--red); }
        .breadcrumb .sep { font-size: 9px; color: var(--gray-300); }
        .breadcrumb .active { color: var(--gray-900); font-weight: 700; }

        .page-hd { margin-bottom: 24px; }
        .ph-sub-label { font-size: 11px; font-weight: 700; color: var(--gray-400); letter-spacing: .06em; text-transform: uppercase; margin-bottom: 5px; }
        .ph-title { font-size: 24px; font-weight: 800; letter-spacing: -.025em; }
        .ph-title span { color: var(--red); }
        .ph-desc { font-size: 13px; color: var(--gray-400); margin-top: 4px; }

        /* ── CARD ── */
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; max-width: 640px; }

        .card-hd { padding: 15px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; gap: 10px; }
        .card-hd-left { display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .card-hd-title { font-size: 14px; font-weight: 700; }
        .card-hd-sub   { font-size: 12px; color: var(--gray-400); margin-top: 1px; }
        .id-badge { display: inline-flex; align-items: center; gap: 3px; padding: 2px 9px; border-radius: 999px; background: var(--gray-100); color: var(--gray-500); font-size: 11px; font-weight: 700; font-family: monospace; }

        .card-body   { padding: 22px; }
        .card-footer { padding: 15px 22px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; align-items: center; gap: 9px; }

        /* ── INFO STRIP ── */
        .info-strip { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding: 14px; margin-bottom: 20px; background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 12px; }
        .strip-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: var(--gray-400); margin-bottom: 7px; }
        .strip-val   { display: flex; align-items: center; gap: 8px; }
        .mini-avatar { width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0; background: var(--red); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 11px; font-weight: 700; }
        .mini-book   { width: 28px; height: 28px; border-radius: 8px; flex-shrink: 0; background: var(--violet-bg); display: flex; align-items: center; justify-content: center; font-size: 12px; color: var(--violet); }
        .strip-name  { font-size: 13px; font-weight: 700; color: var(--gray-900); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px; }

        /* ── STATUS PREVIEW ── */
        .status-preview { display: flex; align-items: center; gap: 8px; padding: 10px 13px; border-radius: 10px; border: 1px solid var(--gray-200); background: var(--gray-50); margin-bottom: 18px; transition: background .2s, border-color .2s; }
        .status-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; transition: background .2s; }
        .status-preview-label { font-size: 13px; font-weight: 600; transition: color .2s; }
        .status-preview-hint  { font-size: 11.5px; color: var(--gray-400); margin-left: auto; }

        /* ── FORM ── */
        .field { display: flex; flex-direction: column; gap: 7px; margin-bottom: 18px; }
        .field:last-child { margin-bottom: 0; }
        .field-label { font-size: 11.5px; font-weight: 700; color: var(--gray-700); letter-spacing: .04em; text-transform: uppercase; display: flex; align-items: center; gap: 5px; }
        .field-label i { color: var(--red); font-size: 10px; }
        .req { color: var(--red); }
        .field-hint { font-size: 11.5px; color: var(--gray-400); display: flex; align-items: center; gap: 5px; }
        .field-hint i { font-size: 10px; color: var(--gray-300); }

        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 12px; pointer-events: none; transition: color .15s; }
        .input-wrap:focus-within .input-icon { color: var(--red); }

        .form-select, .form-date {
            width: 100%; padding: 10px 13px 10px 36px;
            border: 1.5px solid var(--gray-200); border-radius: 10px;
            font-size: 13px; font-family: inherit; color: var(--gray-900);
            background: #fff; outline: none; appearance: none; -webkit-appearance: none;
            transition: border .15s, box-shadow .15s; cursor: pointer;
        }
        .form-select:focus, .form-date:focus { border-color: var(--red); box-shadow: 0 0 0 3px rgba(220,38,38,.07); }

        .select-wrap { position: relative; }
        .select-wrap .input-icon { z-index: 1; }
        .select-wrap::after { content: '\f078'; font-family: 'Font Awesome 6 Free'; font-weight: 900; font-size: 10px; color: var(--gray-400); position: absolute; right: 12px; top: 50%; transform: translateY(-50%); pointer-events: none; }

        /* ── BUTTONS ── */
        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 9px; font-size: 13px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; text-decoration: none; transition: background .12s, transform .12s; }
        .btn:hover { transform: translateY(-1px); }
        .btn-save { background: var(--red); color: #fff; flex: 1; justify-content: center; }
        .btn-save:hover { background: var(--red-dk); }
        .btn-cancel { background: var(--gray-100); color: var(--gray-700); border: 1.5px solid var(--gray-200); }
        .btn-cancel:hover { background: var(--gray-200); }

        /* ── ALERT INFO ── */
        .alert-info { display: flex; gap: 13px; padding: 14px 16px; background: var(--blue-bg); border: 1px solid var(--blue-mid); border-radius: 12px; margin-top: 16px; max-width: 640px; }
        .alert-info-icon  { color: var(--blue); font-size: 14px; flex-shrink: 0; margin-top: 1px; }
        .alert-info-title { font-size: 12.5px; font-weight: 700; color: #1e40af; margin-bottom: 5px; }
        .alert-info-list  { list-style: none; padding: 0; display: flex; flex-direction: column; gap: 4px; }
        .alert-info-list li { font-size: 12px; color: #1d4ed8; display: flex; align-items: flex-start; gap: 6px; font-weight: 500; }
        .alert-info-list li::before { content: '›'; font-weight: 900; flex-shrink: 0; }

        /* Flag stripe */
        .flag-stripe { display: flex; height: 4px; margin-top: 24px; max-width: 640px; }
        .flag-stripe .fr { flex: 1; background: var(--red); }
        .flag-stripe .fw { flex: 1; background: var(--gray-200); }
    </style>
</head>
<body>

<div class="sb-overlay" id="sbOverlay"></div>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">
    <div class="sb-brand">
        <div class="sb-logo-box"><i class="fas fa-book-open"></i></div>
        <div>
            <div class="sb-title">Perpus<span>Ind</span></div>
            <div class="sb-sub">Petugas Panel</div>
        </div>
    </div>
    <nav class="sb-nav">
        <div class="sb-group">Menu Utama</div>
        <a href="{{ route('petugas.dashboard') }}" class="sb-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ url('petugas/books') }}" class="sb-link {{ request()->is('petugas/books*') ? 'active' : '' }}"><i class="fas fa-book"></i> Kelola Buku</a>
        <div class="sb-group">Aktivitas</div>
        <a href="{{ route('petugas.borrowings.index') }}" class="sb-link {{ request()->routeIs('petugas.borrowings*') ? 'active' : '' }}"><i class="fas fa-handshake"></i> Riwayat Peminjaman</a>
    </nav>
    <div class="sb-footer">
        <div class="sb-user">
            <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}</div>
            <div>
                <div class="sb-uname">{{ auth()->user()->name ?? 'Petugas' }}</div>
                <div class="sb-urole">Petugas</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sb-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</aside>

{{-- MOBILE TOPBAR --}}
<div class="topbar" id="topbar">
    <div class="mob-title">Perpus<span>Ind</span></div>
    <button class="mob-ham" id="hamBtn" aria-label="Buka menu"><span></span><span></span><span></span></button>
</div>

{{-- MAIN --}}
<main>

    <div class="breadcrumb">
        <a href="{{ route('petugas.borrowings.index') }}"><i class="fas fa-handshake"></i> Riwayat Peminjaman</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Edit Peminjaman</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Petugas Panel</div>
        <h1 class="ph-title">Edit <span>Peminjaman</span></h1>
        <p class="ph-desc">Perbarui status dan informasi peminjaman buku</p>
    </div>

    {{-- FORM CARD --}}
    <div class="card au d2">
        <div class="card-hd">
            <div class="card-hd-left">
                <div class="card-hd-icon" style="background:var(--amber-bg);">
                    <i class="fas fa-pen" style="color:var(--amber);"></i>
                </div>
                <div>
                    <div class="card-hd-title">Form Edit Peminjaman</div>
                    <div class="card-hd-sub">Ubah status atau tanggal kembali</div>
                </div>
            </div>
            <span class="id-badge"><i class="fas fa-hashtag" style="font-size:9px;"></i> {{ $borrowing->id }}</span>
        </div>

        <div class="card-body">
            <form id="editForm" action="{{ route('petugas.borrowings.update', $borrowing->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Info strip --}}
                <div class="info-strip">
                    <div>
                        <div class="strip-label"><i class="fas fa-user" style="margin-right:3px;"></i> Peminjam</div>
                        <div class="strip-val">
                            <div class="mini-avatar">{{ strtoupper(substr($borrowing->user->name ?? 'U', 0, 1)) }}</div>
                            <span class="strip-name">{{ $borrowing->user->name ?? '-' }}</span>
                        </div>
                    </div>
                    <div>
                        <div class="strip-label"><i class="fas fa-book" style="margin-right:3px;"></i> Buku</div>
                        <div class="strip-val">
                            <div class="mini-book"><i class="fas fa-book"></i></div>
                            <span class="strip-name">{{ $borrowing->book->judul ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Status preview --}}
                <div class="status-preview" id="statusPreview">
                    <div class="status-dot" id="statusDot"></div>
                    <span class="status-preview-label" id="statusPreviewText">—</span>
                    <span class="status-preview-hint">Status saat ini</span>
                </div>

                {{-- Status --}}
                <div class="field">
                    <label class="field-label"><i class="fas fa-flag"></i> Status Peminjaman <span class="req">*</span></label>
                    <div class="select-wrap input-wrap">
                        <i class="fas fa-tag input-icon"></i>
                        <select name="status" class="form-select" id="statusSelect" onchange="updateStatusPreview(this.value)">
                            <option value="pending"  {{ $borrowing->status === 'pending'  ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $borrowing->status === 'approved' ? 'selected' : '' }}>Approved – Disetujui</option>
                            <option value="rejected" {{ $borrowing->status === 'rejected' ? 'selected' : '' }}>Rejected – Ditolak</option>
                            <option value="returned" {{ $borrowing->status === 'returned' ? 'selected' : '' }}>Returned – Dikembalikan</option>
                        </select>
                    </div>
                    <div class="field-hint"><i class="fas fa-lightbulb"></i> Pilih status yang sesuai dengan kondisi peminjaman saat ini</div>
                </div>

                {{-- Tanggal Kembali --}}
                <div class="field">
                    <label class="field-label"><i class="fas fa-calendar-check"></i> Tanggal Kembali</label>
                    <div class="input-wrap">
                        <i class="fas fa-calendar-alt input-icon"></i>
                        <input type="date" name="returned_at" class="form-date"
                               value="{{ $borrowing->returned_at ? \Carbon\Carbon::parse($borrowing->returned_at)->format('Y-m-d') : '' }}">
                    </div>
                    <div class="field-hint"><i class="fas fa-info-circle"></i> Kosongkan jika buku belum dikembalikan</div>
                </div>

            </form>
        </div>

        <div class="card-footer">
            <button type="submit" form="editForm" class="btn btn-save">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-cancel">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </div>

    {{-- Alert info --}}
    <div class="alert-info au d3">
        <i class="fas fa-info-circle alert-info-icon"></i>
        <div>
            <div class="alert-info-title">Informasi Penting</div>
            <ul class="alert-info-list">
                <li>Ubah status menjadi "Returned" saat buku sudah dikembalikan</li>
                <li>Isi tanggal kembali sesuai dengan waktu pengembalian aktual</li>
                <li>Status "Rejected" akan membatalkan peminjaman ini</li>
            </ul>
        </div>
    </div>
</main>

<script>
(function () {
    var sidebar = document.getElementById('sidebar');
    var overlay = document.getElementById('sbOverlay');
    var hamBtn  = document.getElementById('hamBtn');
    function open()  { sidebar.classList.add('open'); overlay.classList.add('show'); }
    function close() { sidebar.classList.remove('open'); overlay.classList.remove('show'); }
    if (hamBtn)  hamBtn.addEventListener('click', function () { sidebar.classList.contains('open') ? close() : open(); });
    if (overlay) overlay.addEventListener('click', close);
    document.querySelectorAll('.sb-link').forEach(function (el) {
        el.addEventListener('click', function () { if (window.innerWidth <= 768) close(); });
    });
})();

var statusConfig = {
    pending:  { label: 'Pending – Menunggu Persetujuan', dot: '#D97706', bg: '#FEF3C7', border: '#FCD34D' },
    approved: { label: 'Approved – Peminjaman Disetujui', dot: '#2563EB', bg: '#EFF6FF', border: '#BFDBFE' },
    rejected: { label: 'Rejected – Peminjaman Ditolak',  dot: '#DC2626', bg: '#FEE2E2', border: '#FCA5A5' },
    returned: { label: 'Returned – Buku Dikembalikan',   dot: '#16A34A', bg: '#DCFCE7', border: '#86EFAC' },
};

function updateStatusPreview(val) {
    var cfg = statusConfig[val];
    if (!cfg) return;
    var dot   = document.getElementById('statusDot');
    var text  = document.getElementById('statusPreviewText');
    var wrap  = document.getElementById('statusPreview');
    dot.style.background   = cfg.dot;
    dot.style.boxShadow    = '0 0 0 3px ' + cfg.dot + '33';
    text.textContent        = cfg.label;
    text.style.color        = cfg.dot;
    wrap.style.background   = cfg.bg;
    wrap.style.borderColor  = cfg.border;
}

document.addEventListener('DOMContentLoaded', function () {
    var sel = document.getElementById('statusSelect');
    if (sel) updateStatusPreview(sel.value);
});
</script>
</body>
</html>
