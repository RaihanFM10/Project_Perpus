<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Peminjaman | Admin</title>
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
            --violet:    #7C3AED;
            --violet-bg: #F5F3FF;
            --sky:       #0284C7;
            --sky-bg:    #E0F2FE;
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

        @media (max-width: 900px) { .grid { grid-template-columns: 1fr !important; } }
        @media (max-width: 768px) {
            .topbar { display: flex; }
            .sidebar { position: fixed; left: 0; top: 0; transform: translateX(-100%); transition: transform .3s ease; }
            .sidebar.open { transform: translateX(0); box-shadow: 4px 0 24px rgba(0,0,0,.1); }
            main { padding: 24px 18px; }
            body { flex-direction: column; }
            .info-grid { grid-template-columns: 1fr !important; }
        }

        /* ── MAIN ── */
        main { flex: 1; padding: 32px 36px; overflow-x: hidden; min-width: 0; }

        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--gray-400); margin-bottom: 16px; animation: fadeDown .4s ease both; }
        .breadcrumb a { color: var(--gray-400); font-weight: 500; display: flex; align-items: center; gap: 4px; transition: color .15s; }
        .breadcrumb a:hover { color: var(--red); }
        .breadcrumb .sep { font-size: 9px; color: var(--gray-300); }
        .breadcrumb .active { color: var(--gray-900); font-weight: 700; }

        .page-hd { margin-bottom: 24px; }
        .ph-sub-label { font-size: 11px; font-weight: 700; color: var(--gray-400); letter-spacing: .06em; text-transform: uppercase; margin-bottom: 5px; }
        .ph-title { font-size: 24px; font-weight: 800; letter-spacing: -.025em; }
        .ph-title span { color: var(--red); }
        .ph-desc { font-size: 13px; color: var(--gray-400); margin-top: 4px; }

        /* ── GRID ── */
        .grid { display: grid; grid-template-columns: 1fr 290px; gap: 20px; align-items: start; }
        .left-col  { display: flex; flex-direction: column; gap: 16px; }
        .right-col { display: flex; flex-direction: column; gap: 16px; }

        /* ── CARD ── */
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; }
        .card-hd { padding: 15px 20px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .card-hd-title { font-size: 14px; font-weight: 700; }
        .card-hd-sub   { font-size: 11.5px; color: var(--gray-400); margin-top: 1px; }
        .card-body { padding: 18px 20px; }

        /* ── INFO ITEMS ── */
        .info-stack { display: flex; flex-direction: column; gap: 10px; }
        .info-grid  { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }

        .info-item { display: flex; align-items: center; gap: 13px; padding: 13px 15px; border-radius: 12px; border: 1px solid var(--gray-100); }

        .info-item-icon { width: 40px; height: 40px; border-radius: 11px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 15px; }
        .info-item-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 3px; }
        .info-item-value { font-size: 14px; font-weight: 800; color: var(--gray-900); line-height: 1.2; }
        .info-item-sub   { font-size: 11px; color: var(--gray-400); margin-top: 2px; }

        .u-avatar-lg { width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0; background: var(--red); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 15px; font-weight: 800; }

        /* ── STATUS DISPLAY ── */
        .status-display { display: flex; flex-direction: column; align-items: center; padding: 22px 16px; border-radius: 12px; border: 1.5px solid; text-align: center; }
        .status-circle { width: 54px; height: 54px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; color: #fff; margin-bottom: 12px; }
        .status-eyebrow { font-size: 10px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; margin-bottom: 3px; }
        .status-name    { font-size: 18px; font-weight: 800; }
        .status-desc    { font-size: 11.5px; margin-top: 5px; }

        .st-approved { background: var(--sky-bg);    border-color: #bae6fd; }
        .st-approved .status-circle  { background: var(--sky); }
        .st-approved .status-eyebrow, .st-approved .status-desc { color: #38bdf8; }
        .st-approved .status-name    { color: var(--sky); }

        .st-returned { background: var(--green-bg);  border-color: #86efac; }
        .st-returned .status-circle  { background: var(--green); }
        .st-returned .status-eyebrow, .st-returned .status-desc { color: #4ade80; }
        .st-returned .status-name    { color: var(--green); }

        .st-rejected { background: var(--red-sf);    border-color: #fca5a5; }
        .st-rejected .status-circle  { background: var(--red-dk); }
        .st-rejected .status-eyebrow, .st-rejected .status-desc { color: #f87171; }
        .st-rejected .status-name    { color: var(--red); }

        .st-pending  { background: var(--amber-bg);  border-color: #fcd34d; }
        .st-pending .status-circle   { background: var(--amber); }
        .st-pending .status-eyebrow, .st-pending .status-desc { color: #f59e0b; }
        .st-pending .status-name     { color: var(--amber); }

        /* ── TIMELINE ── */
        .timeline { display: flex; flex-direction: column; }
        .tl-item  { display: flex; gap: 12px; position: relative; }
        .tl-item:not(:last-child)::after { content: ''; position: absolute; left: 13px; top: 30px; bottom: -4px; width: 2px; background: var(--gray-100); }
        .tl-dot { width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 11px; position: relative; z-index: 1; margin-top: 2px; border: 2px solid var(--gray-200); }
        .tl-content { padding-bottom: 18px; padding-top: 3px; }
        .tl-title   { font-size: 13px; font-weight: 700; color: var(--gray-900); }
        .tl-time    { font-size: 11px; color: var(--gray-400); margin-top: 2px; display: flex; align-items: center; gap: 4px; }

        /* ── BUTTON ── */
        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 9px; font-size: 13px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; text-decoration: none; transition: background .15s, transform .15s; }
        .btn:hover { transform: translateY(-1px); }
        .btn-back { background: #fff; color: var(--gray-700); border: 1.5px solid var(--gray-200); }
        .btn-back:hover { background: var(--gray-100); }

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
            <div class="sb-sub">Admin Panel</div>
        </div>
    </div>
    <nav class="sb-nav">
        <div class="sb-group">Menu Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="sb-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('admin.users') }}" class="sb-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}"><i class="fas fa-users"></i> Manajemen User</a>
        <a href="{{ url('/admin/books') }}" class="sb-link {{ request()->is('admin/books*') ? 'active' : '' }}"><i class="fas fa-book"></i> Data Buku</a>
        <a href="{{ route('admin.categories.index') }}" class="sb-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}"><i class="fas fa-tags"></i> Kategori Buku</a>
        <div class="sb-group">Aktivitas</div>
        <a href="{{ route('admin.borrowings.index') }}" class="sb-link {{ request()->routeIs('admin.borrowings*') ? 'active' : '' }}"><i class="fas fa-handshake"></i> Riwayat Peminjaman</a>
        <a href="{{ route('admin.ratings.index') }}" class="sb-link {{ request()->routeIs('admin.ratings*') ? 'active' : '' }}"><i class="fas fa-star"></i> Ulasan Buku</a>
    </nav>
    <div class="sb-footer">
        <div class="sb-user">
            <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="sb-uname">{{ auth()->user()->name ?? 'Administrator' }}</div>
                <div class="sb-urole">Administrator</div>
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
        <a href="{{ route('admin.borrowings.index') }}"><i class="fas fa-handshake"></i> Riwayat Peminjaman</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Detail Peminjaman</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Admin Panel</div>
        <h1 class="ph-title">Detail <span>Peminjaman</span></h1>
        <p class="ph-desc">Informasi lengkap peminjaman buku</p>
    </div>

    <div class="grid">

        {{-- ── LEFT COL ── --}}
        <div class="left-col">

            {{-- Info Card --}}
            <div class="card au d2">
                <div class="card-hd">
                    <div class="card-hd-icon" style="background:var(--red-bg);">
                        <i class="fas fa-info-circle" style="color:var(--red);"></i>
                    </div>
                    <div>
                        <div class="card-hd-title">Informasi Peminjaman</div>
                        <div class="card-hd-sub">ID: <span style="font-family:'Courier New',monospace; color:var(--red-dk); font-weight:700;">#{{ $borrowing->id }}</span></div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="info-stack">

                        {{-- Peminjam --}}
                        <div class="info-item" style="background:var(--red-bg); border-color:var(--red-sf);">
                            <div class="u-avatar-lg">{{ strtoupper(substr($borrowing->user->name ?? 'U', 0, 1)) }}</div>
                            <div>
                                <div class="info-item-label" style="color:var(--red);"><i class="fas fa-user" style="margin-right:3px;"></i> Nama Peminjam</div>
                                <div class="info-item-value">{{ $borrowing->user->name ?? '-' }}</div>
                                <div class="info-item-sub">{{ $borrowing->user->email ?? '' }}</div>
                            </div>
                        </div>

                        {{-- Buku --}}
                        <div class="info-item" style="background:var(--violet-bg); border-color:rgba(124,58,237,.15);">
                            <div class="info-item-icon" style="background:rgba(124,58,237,.15);">
                                <i class="fas fa-book" style="color:var(--violet);"></i>
                            </div>
                            <div>
                                <div class="info-item-label" style="color:var(--violet);"><i class="fas fa-bookmark" style="margin-right:3px;"></i> Judul Buku</div>
                                <div class="info-item-value">{{ $borrowing->book->judul ?? '-' }}</div>
                            </div>
                        </div>

                        {{-- Tanggal grid --}}
                        <div class="info-grid">
                            {{-- Tanggal Pinjam --}}
                            <div class="info-item" style="background:var(--sky-bg); border-color:#bae6fd;">
                                <div class="info-item-icon" style="background:rgba(2,132,199,.15);">
                                    <i class="fas fa-calendar-plus" style="color:var(--sky);"></i>
                                </div>
                                <div>
                                    <div class="info-item-label" style="color:var(--sky);">Tgl Pinjam</div>
                                    <div class="info-item-value" style="font-size:13px;">{{ $borrowing->created_at->format('d M Y') }}</div>
                                    <div class="info-item-sub"><i class="fas fa-clock" style="font-size:9px;margin-right:2px;"></i>{{ $borrowing->created_at->format('H:i') }} WIB</div>
                                </div>
                            </div>

                            {{-- Tanggal Kembali --}}
                            <div class="info-item" style="background:var(--amber-bg); border-color:#fcd34d;">
                                <div class="info-item-icon" style="background:rgba(217,119,6,.15);">
                                    <i class="fas fa-calendar-check" style="color:var(--amber);"></i>
                                </div>
                                <div>
                                    <div class="info-item-label" style="color:var(--amber);">Tgl Kembali</div>
                                    @if($borrowing->returned_at)
                                        <div class="info-item-value" style="font-size:13px;">{{ \Carbon\Carbon::parse($borrowing->returned_at)->format('d M Y') }}</div>
                                        <div class="info-item-sub"><i class="fas fa-clock" style="font-size:9px;margin-right:2px;"></i>{{ \Carbon\Carbon::parse($borrowing->returned_at)->format('H:i') }} WIB</div>
                                    @else
                                        <div class="info-item-value" style="font-size:12.5px; color:var(--gray-400); font-style:italic; font-weight:500;">Belum kembali</div>
                                        <div class="info-item-sub"><i class="fas fa-hourglass-half" style="font-size:9px;margin-right:2px;"></i>Menunggu</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Actions Card --}}
            <div class="card au d3">
                <div class="card-hd">
                    <div class="card-hd-icon" style="background:var(--green-bg);">
                        <i class="fas fa-tasks" style="color:var(--green);"></i>
                    </div>
                    <div class="card-hd-title">Aksi</div>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.borrowings.index') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

        </div>

        {{-- ── RIGHT COL ── --}}
        <div class="right-col">

            {{-- Status Card --}}
            <div class="card au d2">
                <div class="card-hd">
                    <div class="card-hd-icon" style="background:var(--red-bg);">
                        <i class="fas fa-flag" style="color:var(--red);"></i>
                    </div>
                    <div class="card-hd-title">Status Peminjaman</div>
                </div>
                <div class="card-body">
                    @if($borrowing->status === 'approved')
                    <div class="status-display st-approved">
                        <div class="status-circle"><i class="fas fa-check"></i></div>
                        <div class="status-eyebrow">Status</div>
                        <div class="status-name">Disetujui</div>
                        <div class="status-desc">Peminjaman telah disetujui</div>
                    </div>

                    @elseif($borrowing->status === 'returned')
                    <div class="status-display st-returned">
                        <div class="status-circle"><i class="fas fa-check-double"></i></div>
                        <div class="status-eyebrow">Status</div>
                        <div class="status-name">Dikembalikan</div>
                        <div class="status-desc">Buku telah dikembalikan</div>
                    </div>

                    @elseif($borrowing->status === 'rejected')
                    <div class="status-display st-rejected">
                        <div class="status-circle"><i class="fas fa-times"></i></div>
                        <div class="status-eyebrow">Status</div>
                        <div class="status-name">Ditolak</div>
                        <div class="status-desc">Peminjaman ditolak admin</div>
                    </div>

                    @else
                    <div class="status-display st-pending">
                        <div class="status-circle"><i class="fas fa-hourglass-half"></i></div>
                        <div class="status-eyebrow">Status</div>
                        <div class="status-name">Pending</div>
                        <div class="status-desc">Menunggu persetujuan admin</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Timeline Card --}}
            <div class="card au d3">
                <div class="card-hd">
                    <div class="card-hd-icon" style="background:var(--violet-bg);">
                        <i class="fas fa-clock" style="color:var(--violet);"></i>
                    </div>
                    <div class="card-hd-title">Timeline</div>
                </div>
                <div class="card-body" style="padding-bottom:6px;">
                    <div class="timeline">

                        {{-- Dibuat --}}
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--red-bg); border-color:var(--red-sf);">
                                <i class="fas fa-plus" style="color:var(--red); font-size:9px;"></i>
                            </div>
                            <div class="tl-content">
                                <div class="tl-title">Peminjaman dibuat</div>
                                <div class="tl-time">
                                    <i class="fas fa-clock" style="font-size:9px;"></i>
                                    {{ $borrowing->created_at->format('d M Y, H:i') }} WIB
                                </div>
                            </div>
                        </div>

                        @if($borrowing->status === 'approved' || $borrowing->status === 'returned')
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--sky-bg); border-color:#bae6fd;">
                                <i class="fas fa-check" style="color:var(--sky); font-size:9px;"></i>
                            </div>
                            <div class="tl-content">
                                <div class="tl-title">Disetujui admin</div>
                                <div class="tl-time"><i class="fas fa-clock" style="font-size:9px;"></i> —</div>
                            </div>
                        </div>
                        @endif

                        @if($borrowing->status === 'rejected')
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--red-sf); border-color:#fca5a5;">
                                <i class="fas fa-times" style="color:var(--red); font-size:9px;"></i>
                            </div>
                            <div class="tl-content">
                                <div class="tl-title">Ditolak admin</div>
                                <div class="tl-time"><i class="fas fa-clock" style="font-size:9px;"></i> —</div>
                            </div>
                        </div>
                        @endif

                        @if($borrowing->returned_at)
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--green-bg); border-color:#86efac;">
                                <i class="fas fa-book" style="color:var(--green); font-size:9px;"></i>
                            </div>
                            <div class="tl-content" style="padding-bottom:4px;">
                                <div class="tl-title">Buku dikembalikan</div>
                                <div class="tl-time">
                                    <i class="fas fa-clock" style="font-size:9px;"></i>
                                    {{ \Carbon\Carbon::parse($borrowing->returned_at)->format('d M Y, H:i') }} WIB
                                </div>
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
