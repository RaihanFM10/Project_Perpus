<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman | PerpusInd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
            --rose:      #E11D48;
            --rose-bg:   #FFE4E6;
            --sky:       #0284C7;
            --sky-bg:    #E0F2FE;
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
        @keyframes pulse    { 0%,100%{opacity:1} 50%{opacity:.4} }
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
            .stat-row { grid-template-columns: 1fr 1fr !important; }
            .hero-illus { display: none; }
            .hero-inner { padding: 22px; }
            .filter-bar { flex-wrap: wrap; }
        }

        /* ── MAIN ── */
        main { flex: 1; padding: 32px 36px; overflow-x: hidden; min-width: 0; }

        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--gray-400); margin-bottom: 16px; animation: fadeDown .4s ease both; }
        .breadcrumb a { color: var(--gray-400); font-weight: 500; display: flex; align-items: center; gap: 4px; transition: color .15s; }
        .breadcrumb a:hover { color: var(--red); }
        .breadcrumb .sep { font-size: 9px; color: var(--gray-300); }
        .breadcrumb .active { color: var(--gray-900); font-weight: 700; }

        /* ── HERO ── */
        .hero { border-radius: 14px; overflow: hidden; position: relative; margin-bottom: 24px; background: var(--red); }
        .hero-inner { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; padding: 26px 30px; }
        .hero-badge { display: inline-flex; align-items: center; gap: 5px; background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.2); padding: 3px 11px; border-radius: 999px; font-size: 11px; font-weight: 600; color: rgba(255,255,255,.85); letter-spacing: .04em; margin-bottom: 10px; }
        .hero-ph-label { font-size: 11px; font-weight: 600; color: rgba(255,220,220,.75); letter-spacing: .07em; text-transform: uppercase; margin-bottom: 5px; }
        .hero-title { font-size: 22px; font-weight: 800; color: #fff; line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; }
        .hero-sub { font-size: 12.5px; color: rgba(255,220,220,.75); }
        .hero-illus { position: relative; z-index: 1; flex-shrink: 0; }
        .hero-icon-wrap { width: 78px; height: 78px; border-radius: 20px; background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.18); display: flex; align-items: center; justify-content: center; }
        .hero-icon-wrap i { font-size: 32px; color: rgba(255,220,220,.85); }

        /* ── STAT ROW ── */
        .stat-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 24px; }
        .sc { background: #fff; border-radius: 12px; border: 1px solid var(--gray-200); padding: 16px 18px; display: flex; align-items: center; gap: 13px; transition: box-shadow .2s, transform .2s; }
        .sc:hover { box-shadow: 0 4px 16px rgba(0,0,0,.07); transform: translateY(-2px); }
        .sc-ico { width: 42px; height: 42px; border-radius: 11px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 16px; }
        .sc-val { font-size: 24px; font-weight: 800; line-height: 1; }
        .sc-lbl { font-size: 11px; font-weight: 600; color: var(--gray-400); margin-top: 3px; }

        /* ── SECTION HEADER ── */
        .sec-hd { margin-bottom: 14px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
        .sec-title { font-size: 16px; font-weight: 800; color: var(--gray-900); margin-bottom: 3px; }
        .sec-sub   { font-size: 12.5px; color: var(--gray-400); }
        .btn-back-catalog { display: inline-flex; align-items: center; gap: 6px; padding: 8px 15px; border: 1.5px solid var(--gray-200); border-radius: 9px; font-size: 12.5px; font-weight: 600; color: var(--gray-500); background: #fff; transition: border-color .15s, color .15s; }
        .btn-back-catalog:hover { border-color: var(--red); color: var(--red); }

        /* ── FILTER BAR ── */
        .filter-bar { background: #fff; border-radius: 11px; border: 1.5px solid var(--gray-200); padding: 12px 16px; margin-bottom: 16px; display: flex; align-items: center; gap: 9px; flex-wrap: wrap; }
        .filter-label { font-size: 11px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .07em; }
        .filter-div   { width: 1px; height: 18px; background: var(--gray-200); }
        .filter-btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 13px; border-radius: 7px; font-size: 12px; font-weight: 600; font-family: inherit; border: 1.5px solid var(--gray-200); background: #fff; color: var(--gray-500); cursor: pointer; transition: all .15s; }
        .filter-btn:hover { background: var(--gray-100); border-color: var(--gray-300); color: var(--gray-900); }
        .filter-btn.af-all      { background: var(--red-bg);    border-color: var(--red-sf);   color: var(--red); }
        .filter-btn.af-pending  { background: var(--amber-bg);  border-color: #fde68a;         color: var(--amber); }
        .filter-btn.af-approved { background: var(--green-bg);  border-color: #bbf7d0;         color: var(--green); }
        .filter-btn.af-returned { background: var(--indigo-bg); border-color: #c7d2fe;         color: var(--indigo); }
        .filter-btn.af-rejected { background: var(--rose-bg);   border-color: #fda4af;         color: var(--rose); }

        /* ── TABLE CARD ── */
        .table-card { background: #fff; border-radius: 13px; border: 1.5px solid var(--gray-200); overflow: hidden; }
        .table-hd { padding: 14px 20px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .table-hd-title { display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 700; color: var(--gray-900); }
        .th-ico { width: 30px; height: 30px; border-radius: 8px; background: var(--red-bg); display: flex; align-items: center; justify-content: center; }
        .th-ico i { color: var(--red); font-size: 12px; }
        .tbl-count { font-size: 11.5px; font-weight: 700; color: var(--gray-400); background: var(--gray-50); border: 1px solid var(--gray-200); border-radius: 7px; padding: 3px 10px; }

        .tbl-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; min-width: 660px; }
        thead th { background: var(--gray-50); padding: 10px 15px; text-align: left; font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--gray-400); border-bottom: 1px solid var(--gray-100); white-space: nowrap; }
        thead th:last-child { text-align: center; }
        tbody tr { border-bottom: 1px solid var(--gray-100); transition: background .12s; }
        tbody tr:hover { background: #FFF8F8; }
        tbody tr:last-child { border-bottom: none; }
        tbody td { padding: 12px 15px; vertical-align: middle; }

        .no-badge { display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 7px; background: var(--gray-100); font-size: 11px; font-weight: 700; color: var(--gray-500); }

        .user-cell { display: flex; align-items: center; gap: 9px; }
        .tbl-avatar { width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0; background: var(--red); display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff; font-size: 11px; }
        .tbl-user-name { font-size: 13px; font-weight: 700; }

        .book-cell { display: flex; align-items: center; gap: 7px; }
        .book-cell i { font-size: 12px; color: var(--gray-300); flex-shrink: 0; }
        .book-name { font-size: 13px; font-weight: 700; }

        .date-cell { display: flex; align-items: center; gap: 6px; font-size: 12.5px; color: var(--gray-500); }
        .date-cell i { font-size: 10px; }
        .return-ok   { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; color: var(--green); font-weight: 600; }
        .return-none { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; color: var(--gray-400); font-style: italic; }

        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 999px; font-size: 11.5px; font-weight: 700; }
        .badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
        .badge-pending  { background: var(--amber-bg); color: var(--amber); }
        .badge-pending::before  { background: var(--amber); animation: pulse 1.5s infinite; }
        .badge-approved { background: var(--green-bg);  color: var(--green); }
        .badge-approved::before { background: var(--green); }
        .badge-returned { background: var(--indigo-bg); color: var(--indigo); }
        .badge-returned::before { background: var(--indigo); }
        .badge-rejected { background: var(--rose-bg);   color: var(--rose); }
        .badge-rejected::before { background: var(--rose); }
        .badge-dipinjam { background: var(--sky-bg);    color: var(--sky); }
        .badge-dipinjam::before { background: var(--sky); animation: pulse 1.5s infinite; }

        .act-wrap { display: flex; align-items: center; gap: 5px; justify-content: center; }
        .btn-act { display: inline-flex; align-items: center; gap: 5px; padding: 6px 11px; border-radius: 7px; font-size: 11.5px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; transition: all .15s; text-decoration: none; white-space: nowrap; }
        .btn-detail-a { background: var(--indigo-bg); color: var(--indigo); }
        .btn-detail-a:hover { background: var(--indigo); color: #fff; }
        .btn-pdf-a    { background: var(--sky-bg);    color: var(--sky); }
        .btn-pdf-a:hover { background: var(--sky); color: #fff; }

        .empty-td { padding: 56px 20px; text-align: center; }
        .empty-ico { width: 56px; height: 56px; border-radius: 16px; background: var(--gray-100); margin: 0 auto 12px; display: flex; align-items: center; justify-content: center; }
        .empty-ico i { font-size: 22px; color: var(--gray-300); }
        .empty-ttl { font-size: 15px; font-weight: 800; color: var(--gray-700); margin-bottom: 4px; }
        .empty-sub { font-size: 12.5px; color: var(--gray-400); }

        .pg-wrap { padding: 13px 20px; border-top: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .pg-info { font-size: 12px; color: var(--gray-400); font-weight: 500; }

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
            <div class="sb-sub">Member Panel</div>
        </div>
    </div>
    <nav class="sb-nav">
        <div class="sb-group">Menu</div>
        <a href="{{ route('user.dashboard') }}" class="sb-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"><i class="fas fa-house-chimney"></i> Dashboard</a>
        <a href="{{ route('user.books') }}" class="sb-link {{ request()->routeIs('user.books*') ? 'active' : '' }}"><i class="fas fa-book"></i> Katalog Buku</a>
        <a href="{{ route('user.favorites') }}" class="sb-link {{ request()->routeIs('user.favorites*') ? 'active' : '' }}"><i class="fas fa-heart"></i> Buku Favorit</a>
        <a href="{{ route('user.borrowing.index') }}" class="sb-link {{ request()->routeIs('user.borrowing*') ? 'active' : '' }}"><i class="fas fa-clock-rotate-left"></i> Riwayat Peminjaman</a>
        {{-- <div class="sb-group">Akun</div>
        <a href="{{ url('/profile') }}" class="sb-link {{ request()->is('profile*') ? 'active' : '' }}"><i class="fas fa-user"></i> Profil Saya</a> --}}
    </nav>
    <div class="sb-footer">
        <div class="sb-user">
            <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
            <div>
                <div class="sb-uname">{{ auth()->user()->name ?? 'Pengguna' }}</div>
                <div class="sb-urole">Anggota Aktif</div>
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
        <a href="{{ route('user.dashboard') }}"><i class="fas fa-house-chimney"></i> Dashboard</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Riwayat Peminjaman</span>
    </div>

    {{-- HERO --}}
    <div class="hero au d1">
        <div class="hero-inner">
            <div>
                <div class="hero-badge"><i class="fas fa-clock-rotate-left" style="font-size:9px;"></i> Histori Aktivitas</div>
                <p class="hero-ph-label">Riwayat Saya</p>
                <h2 class="hero-title">Riwayat Peminjaman</h2>
                <p class="hero-sub">Pantau status dan histori semua buku yang pernah Anda pinjam</p>
            </div>
            <div class="hero-illus">
                <div class="hero-icon-wrap"><i class="fas fa-clock-rotate-left"></i></div>
            </div>
        </div>
    </div>

    {{-- STAT ROW --}}
    @php
        $total    = $borrowings->count();
        $pending  = $borrowings->where('status','pending')->count();
        $returned = $borrowings->where('status','returned')->count();
        $rejected = $borrowings->where('status','rejected')->count();
    @endphp
    <div class="stat-row au d2">
        <div class="sc">
            <div class="sc-ico" style="background:var(--red-bg);"><i class="fas fa-layer-group" style="color:var(--red);"></i></div>
            <div><div class="sc-val" style="color:var(--red);">{{ $total }}</div><div class="sc-lbl">Total</div></div>
        </div>
        <div class="sc">
            <div class="sc-ico" style="background:var(--amber-bg);"><i class="fas fa-hourglass-half" style="color:var(--amber);"></i></div>
            <div><div class="sc-val" style="color:var(--amber);">{{ $pending }}</div><div class="sc-lbl">Menunggu</div></div>
        </div>
        <div class="sc">
            <div class="sc-ico" style="background:var(--green-bg);"><i class="fas fa-check-circle" style="color:var(--green);"></i></div>
            <div><div class="sc-val" style="color:var(--green);">{{ $returned }}</div><div class="sc-lbl">Dikembalikan</div></div>
        </div>
        <div class="sc">
            <div class="sc-ico" style="background:var(--rose-bg);"><i class="fas fa-times-circle" style="color:var(--rose);"></i></div>
            <div><div class="sc-val" style="color:var(--rose);">{{ $rejected }}</div><div class="sc-lbl">Ditolak</div></div>
        </div>
    </div>

    {{-- SECTION HEADER --}}
    <div class="sec-hd au d3">
        <div>
            <div class="sec-title">Daftar Peminjaman</div>
            <p class="sec-sub">Semua transaksi peminjaman buku Anda tercatat di sini</p>
        </div>
        <a href="{{ route('user.books') }}" class="btn-back-catalog">
            <i class="fas fa-arrow-left" style="font-size:10px;"></i> Kembali ke Katalog
        </a>
    </div>

    {{-- FILTER BAR --}}
    <div class="filter-bar au d3">
        <span class="filter-label"><i class="fas fa-filter" style="margin-right:3px; font-size:9px;"></i> Filter:</span>
        <button class="filter-btn af-all" id="fb-all"      onclick="filterTable('all', this)"><i class="fas fa-circle" style="font-size:5px;"></i> Semua</button>
        <div class="filter-div"></div>
        <button class="filter-btn" id="fb-pending"  onclick="filterTable('pending', this)"><i class="fas fa-circle" style="font-size:5px; color:var(--amber);"></i> Pending</button>
        <button class="filter-btn" id="fb-approved" onclick="filterTable('approved', this)"><i class="fas fa-circle" style="font-size:5px; color:var(--green);"></i> Disetujui</button>
        <button class="filter-btn" id="fb-returned" onclick="filterTable('returned', this)"><i class="fas fa-circle" style="font-size:5px; color:var(--indigo);"></i> Dikembalikan</button>
        <button class="filter-btn" id="fb-rejected" onclick="filterTable('rejected', this)"><i class="fas fa-circle" style="font-size:5px; color:var(--rose);"></i> Ditolak</button>
    </div>

    {{-- TABLE CARD --}}
    <div class="table-card au d4">
        <div class="table-hd">
            <div class="table-hd-title">
                <div class="th-ico"><i class="fas fa-list"></i></div>
                Semua Peminjaman
            </div>
            <span class="tbl-count" id="rowCount">{{ $borrowings->count() }} entri</span>
        </div>

        <div class="tbl-wrap">
            <table id="mainTable">
                <thead>
                    <tr>
                        <th style="width:46px; text-align:center;">#</th>
                        <th>Pengguna</th>
                        <th>Buku</th>
                        <th>Tgl. Pinjam</th>
                        <th>Tgl. Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $i => $item)
                    <tr data-status="{{ $item->status }}">
                        <td style="text-align:center;"><span class="no-badge">{{ $i + 1 }}</span></td>
                        <td>
                            <div class="user-cell">
                                <div class="tbl-avatar">{{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}</div>
                                <span class="tbl-user-name">{{ $item->user->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="book-cell">
                                <i class="fas fa-book"></i>
                                <span class="book-name">{{ $item->book->judul ?? '-' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="date-cell"><i class="fas fa-calendar-alt"></i> {{ $item->created_at->format('d M Y') }}</div>
                        </td>
                        <td>
                            @if($item->returned_at)
                                <div class="return-ok"><i class="fas fa-check-circle"></i> {{ \Carbon\Carbon::parse($item->returned_at)->format('d M Y') }}</div>
                            @else
                                <div class="return-none"><i class="fas fa-clock"></i> Belum dikembalikan</div>
                            @endif
                        </td>
                        <td>
                            @if($item->status === 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @elseif($item->status === 'approved')
                                <span class="badge badge-approved">Disetujui</span>
                            @elseif($item->status === 'returned')
                                <span class="badge badge-returned">Dikembalikan</span>
                            @elseif($item->status === 'dipinjam')
                                <span class="badge badge-dipinjam">Dipinjam</span>
                            @else
                                <span class="badge badge-rejected">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <div class="act-wrap">
                                <a href="{{ route('user.borrowing.show', $item->id) }}" class="btn-act btn-detail-a"><i class="fas fa-eye"></i> Detail</a>
                                <button onclick="exportRowToPDF(this)" class="btn-act btn-pdf-a"><i class="fas fa-file-pdf"></i> PDF</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-td">
                                <div class="empty-ico"><i class="fas fa-inbox"></i></div>
                                <p class="empty-ttl">Belum ada riwayat peminjaman</p>
                                <p class="empty-sub">Pinjam buku dari katalog untuk memulai</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($borrowings->count() > 0)
        <div class="pg-wrap">
            <span class="pg-info" id="pgInfo">Menampilkan {{ $borrowings->count() }} data peminjaman</span>
        </div>
        @endif
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

var filterMap = { all: 'af-all', pending: 'af-pending', approved: 'af-approved', returned: 'af-returned', rejected: 'af-rejected' };

function filterTable(status, btn) {
    document.querySelectorAll('.filter-btn').forEach(function (b) { b.className = 'filter-btn'; });
    if (filterMap[status]) btn.classList.add(filterMap[status]);
    var rows = document.querySelectorAll('#mainTable tbody tr[data-status]');
    var count = 0;
    rows.forEach(function (row) {
        var show = (status === 'all' || row.dataset.status === status);
        row.style.display = show ? '' : 'none';
        if (show) count++;
    });
    document.getElementById('rowCount').textContent = count + ' entri';
    var pi = document.getElementById('pgInfo');
    if (pi) pi.textContent = 'Menampilkan ' + count + ' data peminjaman';
}

function exportRowToPDF(btn) {
    var jsPDF = window.jspdf.jsPDF;
    var row   = btn.closest('tr');
    var cells = row.querySelectorAll('td');
    var no         = cells[0].innerText.trim();
    var nama       = cells[1].innerText.trim();
    var buku       = cells[2].innerText.trim();
    var tglPinjam  = cells[3].innerText.trim();
    var tglKembali = cells[4].innerText.trim();
    var status     = cells[5].innerText.trim();

    var doc = new jsPDF();
    var pw  = doc.internal.pageSize.getWidth();

    doc.setFillColor(153, 27, 27);
    doc.rect(0, 0, pw, 38, 'F');
    doc.setFont('helvetica', 'bold');
    doc.setFontSize(16);
    doc.setTextColor(255, 255, 255);
    doc.text('BUKTI PEMINJAMAN BUKU', pw / 2, 16, { align: 'center' });
    doc.setFont('helvetica', 'normal');
    doc.setFontSize(9);
    doc.setTextColor(255, 200, 200);
    doc.text('PerpusInd \u2014 Perpustakaan Digital', pw / 2, 26, { align: 'center' });

    var fields = [
        ['No', no, false], ['Nama Pengguna', nama, false],
        ['Judul Buku', buku, true], ['Tanggal Pinjam', tglPinjam, false],
        ['Tanggal Kembali', tglKembali, false], ['Status', status, false]
    ];

    var boxX = 14, boxY = 48, boxW = pw - 28;
    var labelX = boxX + 8, colonX = labelX + 50, valueX = colonX + 6;
    var maxVW = pw - valueX - 14;
    var totalH = 10;
    var rendered = fields.map(function (f) {
        var lines = f[2] ? doc.splitTextToSize(f[1], maxVW) : [f[1]];
        var h = Math.max(14, lines.length * 6 + 8);
        totalH += h;
        return { label: f[0], lines: lines, h: h };
    });

    doc.setFillColor(254, 242, 242);
    doc.setDrawColor(220, 38, 38);
    doc.setLineWidth(0.4);
    doc.roundedRect(boxX, boxY, boxW, totalH, 4, 4, 'FD');

    var y = boxY + 13;
    rendered.forEach(function (r, i) {
        if (i % 2 === 0) { doc.setFillColor(254, 226, 226); doc.rect(boxX + 1, y - 7, boxW - 2, r.h, 'F'); }
        doc.setFont('helvetica', 'bold'); doc.setFontSize(9.5); doc.setTextColor(60, 20, 20);
        doc.text(r.label, labelX, y);
        doc.text(':', colonX, y);
        doc.setFont('helvetica', 'normal'); doc.setTextColor(30, 10, 10);
        doc.text(r.lines, valueX, y);
        y += r.h;
    });

    var by = boxY + totalH + 11;
    var sl = status.toLowerCase();
    var bc = sl.includes('kembali') ? [22, 163, 74] : sl.includes('tolak') ? [225, 29, 72] : sl.includes('pending') ? [217, 119, 6] : [153, 27, 27];
    doc.setFillColor(bc[0], bc[1], bc[2]);
    doc.roundedRect(pw / 2 - 32, by, 64, 10, 3, 3, 'F');
    doc.setFont('helvetica', 'bold'); doc.setFontSize(8.5); doc.setTextColor(255, 255, 255);
    doc.text(status.toUpperCase(), pw / 2, by + 7, { align: 'center' });

    var fy = doc.internal.pageSize.getHeight() - 14;
    doc.setDrawColor(200, 200, 200); doc.setLineWidth(0.3);
    doc.line(14, fy - 4, pw - 14, fy - 4);
    doc.setFontSize(7.5); doc.setFont('helvetica', 'italic'); doc.setTextColor(150, 150, 150);
    doc.text('Dokumen diterbitkan otomatis oleh sistem PerpusInd.', pw / 2, fy, { align: 'center' });
    doc.text('Dicetak: ' + new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }), pw / 2, fy + 5.5, { align: 'center' });

    doc.save('Peminjaman_' + no + '.pdf');
}
</script>
</body>
</html>
