<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Peminjaman | PerpusInd</title>
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
            --green-mid: #86EFAC;
            --amber:     #D97706;
            --amber-bg:  #FEF3C7;
            --blue:      #2563EB;
            --blue-bg:   #EFF6FF;
            --blue-mid:  #BFDBFE;
            --sky:       #0284C7;
            --sky-bg:    #E0F2FE;
            --violet:    #7C3AED;
            --violet-bg: #F5F3FF;
            --orange:    #EA580C;
            --orange-bg: #FFF7ED;
            --indigo:    #4F46E5;
            --indigo-bg: #EEF2FF;
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
        .d3 { animation-delay: .19s; } .d4 { animation-delay: .26s; } .d5 { animation-delay: .33s; }

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
            .layout { grid-template-columns: 1fr !important; }
            .dates-grid { grid-template-columns: 1fr !important; }
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

        /* ── LAYOUT ── */
        .layout { display: grid; grid-template-columns: 1fr 280px; gap: 18px; align-items: start; }

        /* ── CARD ── */
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; margin-bottom: 16px; }
        .card:last-child { margin-bottom: 0; }

        .card-hd { padding: 15px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; gap: 10px; }
        .card-hd-left { display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .card-hd-title { font-size: 14px; font-weight: 700; }
        .card-hd-sub   { font-size: 12px; color: var(--gray-400); margin-top: 1px; }
        .id-badge { display: inline-flex; align-items: center; gap: 4px; padding: 2px 9px; border-radius: 999px; background: var(--gray-100); color: var(--gray-500); font-size: 11px; font-weight: 700; font-family: monospace; }

        .card-body { padding: 20px 22px; }

        /* ── INFO ROWS ── */
        .info-row { display: flex; align-items: center; gap: 13px; padding: 13px 14px; border-radius: 11px; border: 1px solid var(--gray-100); margin-bottom: 10px; background: var(--gray-50); transition: box-shadow .15s; }
        .info-row:last-child { margin-bottom: 0; }
        .info-row:hover { box-shadow: 0 2px 8px rgba(0,0,0,.05); }

        .info-row-icon { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0; }

        .u-avatar-lg { width: 42px; height: 42px; border-radius: 50%; flex-shrink: 0; background: var(--red); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 17px; font-weight: 800; }

        .info-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--gray-400); margin-bottom: 3px; }
        .info-value { font-size: 13.5px; font-weight: 700; color: var(--gray-900); }
        .info-hint  { font-size: 11px; color: var(--gray-400); margin-top: 2px; }

        .dates-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .dates-grid .info-row { margin-bottom: 0; }

        /* ── ACTIONS ── */
        .actions-wrap { display: flex; flex-wrap: wrap; gap: 9px; }
        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 9px; font-size: 13px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; text-decoration: none; transition: background .12s, transform .12s; }
        .btn:hover { transform: translateY(-1px); }
        .btn-back    { background: var(--gray-100); color: var(--gray-700); border: 1.5px solid var(--gray-200); }
        .btn-back:hover { background: var(--gray-200); }
        .btn-edit    { background: var(--amber-bg); color: var(--amber); }
        .btn-edit:hover { background: #fde68a; }
        .btn-approve { background: var(--green-bg); color: var(--green); }
        .btn-approve:hover { background: var(--green-mid); }
        .btn-reject  { background: var(--red-sf); color: var(--red); }
        .btn-reject:hover { background: #fecaca; }

        /* ── STATUS DISPLAY ── */
        .status-display { border-radius: 12px; border: 2px solid; padding: 22px 18px; text-align: center; }
        .status-icon-circle { width: 52px; height: 52px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 20px; color: #fff; }
        .status-tag   { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; margin-bottom: 3px; }
        .status-label { font-size: 20px; font-weight: 800; letter-spacing: -.02em; }
        .status-hint  { font-size: 11.5px; margin-top: 5px; font-weight: 500; }

        /* ── TIMELINE ── */
        .timeline { display: flex; flex-direction: column; gap: 0; }
        .tl-item { display: flex; gap: 13px; position: relative; padding-bottom: 20px; }
        .tl-item:last-child { padding-bottom: 0; }
        .tl-item:not(:last-child)::before { content: ''; position: absolute; left: 14px; top: 32px; bottom: 0; width: 2px; background: var(--gray-200); border-radius: 2px; }
        .tl-dot { width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 11px; position: relative; z-index: 1; }
        .tl-title { font-size: 13px; font-weight: 700; color: var(--gray-900); padding-top: 4px; }
        .tl-time  { font-size: 11px; color: var(--gray-400); margin-top: 2px; }
        .tl-now   { font-size: 10.5px; font-weight: 700; color: var(--red); background: var(--red-bg); padding: 2px 8px; border-radius: 999px; display: inline-flex; align-items: center; gap: 4px; margin-top: 4px; }

        /* Flag stripe */
        .flag-stripe { display: flex; height: 4px; margin-top: 24px; }
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
        <span class="active">Detail Peminjaman</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Petugas Panel</div>
        <h1 class="ph-title">Detail <span>Peminjaman</span></h1>
        <p class="ph-desc">Informasi lengkap peminjaman buku</p>
    </div>

    <div class="layout">

        {{-- LEFT COLUMN --}}
        <div>

            {{-- Info Card --}}
            <div class="card au d2">
                <div class="card-hd">
                    <div class="card-hd-left">
                        <div class="card-hd-icon" style="background:var(--red-bg);">
                            <i class="fas fa-info-circle" style="color:var(--red);"></i>
                        </div>
                        <div>
                            <div class="card-hd-title">Informasi Peminjaman</div>
                            <div class="card-hd-sub">Detail lengkap transaksi</div>
                        </div>
                    </div>
                    <span class="id-badge"><i class="fas fa-hashtag" style="font-size:9px;"></i> {{ $borrowing->id }}</span>
                </div>
                <div class="card-body">

                    {{-- Peminjam --}}
                    <div class="info-row">
                        <div class="u-avatar-lg">{{ strtoupper(substr($borrowing->user->name ?? 'U', 0, 1)) }}</div>
                        <div>
                            <div class="info-label"><i class="fas fa-user" style="margin-right:3px;"></i> Nama Peminjam</div>
                            <div class="info-value">{{ $borrowing->user->name ?? '-' }}</div>
                            @if(isset($borrowing->user->email))
                                <div class="info-hint"><i class="fas fa-envelope" style="margin-right:3px;font-size:9px;"></i>{{ $borrowing->user->email }}</div>
                            @endif
                        </div>
                    </div>

                    {{-- Buku --}}
                    <div class="info-row">
                        <div class="info-row-icon" style="background:var(--violet-bg);">
                            <i class="fas fa-book" style="color:var(--violet);"></i>
                        </div>
                        <div>
                            <div class="info-label"><i class="fas fa-bookmark" style="margin-right:3px;"></i> Judul Buku</div>
                            <div class="info-value">{{ $borrowing->book->judul ?? '-' }}</div>
                            @if(isset($borrowing->book->kode_buku))
                                <div class="info-hint" style="font-family:monospace;letter-spacing:.04em;">{{ $borrowing->book->kode_buku }}</div>
                            @endif
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div class="dates-grid">
                        <div class="info-row">
                            <div class="info-row-icon" style="background:var(--green-bg);">
                                <i class="fas fa-calendar-plus" style="color:var(--green);"></i>
                            </div>
                            <div>
                                <div class="info-label">Tgl Pinjam</div>
                                <div class="info-value">{{ $borrowing->created_at->format('d M Y') }}</div>
                                <div class="info-hint">{{ $borrowing->created_at->format('H:i') }} WIB</div>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon" style="background:var(--orange-bg);">
                                <i class="fas fa-calendar-check" style="color:var(--orange);"></i>
                            </div>
                            <div>
                                <div class="info-label">Tgl Kembali</div>
                                @if($borrowing->returned_at)
                                    <div class="info-value">{{ \Carbon\Carbon::parse($borrowing->returned_at)->format('d M Y') }}</div>
                                    <div class="info-hint">{{ \Carbon\Carbon::parse($borrowing->returned_at)->format('H:i') }} WIB</div>
                                @else
                                    <div class="info-value" style="color:var(--gray-400);font-style:italic;font-size:12.5px;font-weight:500;">Belum dikembalikan</div>
                                    <div class="info-hint"><i class="fas fa-hourglass-half" style="margin-right:3px;"></i>Menunggu</div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Actions Card --}}
            <div class="card au d3">
                <div class="card-hd">
                    <div class="card-hd-left">
                        <div class="card-hd-icon" style="background:var(--amber-bg);">
                            <i class="fas fa-tasks" style="color:var(--amber);"></i>
                        </div>
                        <div class="card-hd-title">Aksi Peminjaman</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="actions-wrap">
                        <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('petugas.borrowings.edit', $borrowing) }}" class="btn btn-edit">
                            <i class="fas fa-pen"></i> Edit Peminjaman
                        </a>
                        @if($borrowing->status === 'pending')
                            <form method="POST" action="{{ route('petugas.borrowings.approve', $borrowing->id) }}" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-approve">
                                    <i class="fas fa-check-circle"></i> Approve
                                </button>
                            </form>
                            <form method="POST" action="{{ route('petugas.borrowings.reject', $borrowing->id) }}" style="display:inline"
                                  onsubmit="return confirm('Yakin ingin menolak peminjaman ini?')">
                                @csrf
                                <button type="submit" class="btn btn-reject">
                                    <i class="fas fa-times-circle"></i> Reject
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN --}}
        <div>

            {{-- Status Card --}}
            <div class="card au d2">
                <div class="card-hd">
                    <div class="card-hd-left">
                        <div class="card-hd-icon" style="background:var(--red-bg);">
                            <i class="fas fa-flag" style="color:var(--red);"></i>
                        </div>
                        <div class="card-hd-title">Status Peminjaman</div>
                    </div>
                </div>
                <div class="card-body">
                    @if($borrowing->status === 'approved')
                        <div class="status-display" style="background:var(--blue-bg);border-color:var(--blue-mid);color:var(--blue);">
                            <div class="status-icon-circle" style="background:var(--blue);box-shadow:0 4px 14px rgba(37,99,235,.25);">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="status-tag" style="color:var(--blue);">Status Aktif</div>
                            <div class="status-label" style="color:var(--blue);">Disetujui</div>
                            <div class="status-hint" style="color:#3b82f6;">Peminjaman telah disetujui</div>
                        </div>
                    @elseif($borrowing->status === 'rejected')
                        <div class="status-display" style="background:var(--red-sf);border-color:#fca5a5;color:var(--red);">
                            <div class="status-icon-circle" style="background:var(--red);box-shadow:0 4px 14px rgba(220,38,38,.25);">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="status-tag" style="color:var(--red);">Status</div>
                            <div class="status-label" style="color:var(--red);">Ditolak</div>
                            <div class="status-hint" style="color:var(--red);">Peminjaman ditolak</div>
                        </div>
                    @elseif($borrowing->status === 'returned')
                        <div class="status-display" style="background:var(--green-bg);border-color:var(--green-mid);color:var(--green);">
                            <div class="status-icon-circle" style="background:var(--green);box-shadow:0 4px 14px rgba(22,163,74,.25);">
                                <i class="fas fa-check-double"></i>
                            </div>
                            <div class="status-tag" style="color:var(--green);">Status Selesai</div>
                            <div class="status-label" style="color:var(--green);">Dikembalikan</div>
                            <div class="status-hint" style="color:var(--green);">Buku telah dikembalikan</div>
                        </div>
                    @else
                        <div class="status-display" style="background:var(--amber-bg);border-color:#fcd34d;color:var(--amber);">
                            <div class="status-icon-circle" style="background:var(--amber);box-shadow:0 4px 14px rgba(217,119,6,.25);">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <div class="status-tag" style="color:var(--amber);">Status</div>
                            <div class="status-label" style="color:var(--amber);">Pending</div>
                            <div class="status-hint" style="color:var(--amber);">Menunggu persetujuan</div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Timeline Card --}}
            <div class="card au d3">
                <div class="card-hd">
                    <div class="card-hd-left">
                        <div class="card-hd-icon" style="background:var(--indigo-bg);">
                            <i class="fas fa-clock" style="color:var(--indigo);"></i>
                        </div>
                        <div class="card-hd-title">Timeline</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="timeline">

                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--red-bg);">
                                <i class="fas fa-plus" style="color:var(--red);"></i>
                            </div>
                            <div>
                                <div class="tl-title">Peminjaman dibuat</div>
                                <div class="tl-time">{{ $borrowing->created_at->format('d M Y, H:i') }} WIB</div>
                            </div>
                        </div>

                        @if($borrowing->status === 'pending')
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--amber-bg);">
                                <i class="fas fa-hourglass-half" style="color:var(--amber);"></i>
                            </div>
                            <div>
                                <div class="tl-title">Menunggu Persetujuan</div>
                                <div class="tl-now"><i class="fas fa-circle" style="font-size:5px;"></i> Saat ini</div>
                            </div>
                        </div>
                        @endif

                        @if($borrowing->status === 'approved' || $borrowing->status === 'returned')
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--blue-bg);">
                                <i class="fas fa-check" style="color:var(--blue);"></i>
                            </div>
                            <div>
                                <div class="tl-title">Disetujui</div>
                                <div class="tl-time">—</div>
                                @if($borrowing->status === 'approved')
                                    <div class="tl-now"><i class="fas fa-circle" style="font-size:5px;"></i> Saat ini</div>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($borrowing->status === 'rejected')
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--red-sf);">
                                <i class="fas fa-times" style="color:var(--red);"></i>
                            </div>
                            <div>
                                <div class="tl-title">Ditolak</div>
                                <div class="tl-time">—</div>
                                <div class="tl-now"><i class="fas fa-circle" style="font-size:5px;"></i> Status akhir</div>
                            </div>
                        </div>
                        @endif

                        @if($borrowing->returned_at)
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--green-bg);">
                                <i class="fas fa-check-double" style="color:var(--green);"></i>
                            </div>
                            <div>
                                <div class="tl-title">Buku dikembalikan</div>
                                <div class="tl-time">{{ \Carbon\Carbon::parse($borrowing->returned_at)->format('d M Y, H:i') }} WIB</div>
                                <div class="tl-now" style="color:var(--green);background:var(--green-bg);"><i class="fas fa-flag-checkered" style="font-size:8px;"></i> Selesai</div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

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
</script>
</body>
</html>
