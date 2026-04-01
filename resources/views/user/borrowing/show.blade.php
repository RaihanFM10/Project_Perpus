<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Peminjaman | PerpusInd</title>
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
        .d5 { animation-delay: .33s; }

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
            .detail-grid { grid-template-columns: 1fr !important; }
            .hero-illus { display: none; }
            .hero-inner { padding: 22px; }
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

        /* ── SECTION HEADER ── */
        .sec-hd { margin-bottom: 16px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
        .sec-title { font-size: 16px; font-weight: 800; color: var(--gray-900); margin-bottom: 3px; }
        .sec-sub   { font-size: 12.5px; color: var(--gray-400); }
        .btn-back-riwayat { display: inline-flex; align-items: center; gap: 6px; padding: 8px 15px; border: 1.5px solid var(--gray-200); border-radius: 9px; font-size: 12.5px; font-weight: 600; color: var(--gray-500); background: #fff; transition: border-color .15s, color .15s; }
        .btn-back-riwayat:hover { border-color: var(--red); color: var(--red); }

        /* ── DETAIL GRID ── */
        .detail-grid { display: grid; grid-template-columns: 1fr 290px; gap: 16px; align-items: start; }

        /* ── CARD ── */
        .card { background: #fff; border-radius: 13px; border: 1.5px solid var(--gray-200); overflow: hidden; }
        .card-hd { padding: 14px 20px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; gap: 12px; }
        .card-hd-title { display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 700; }
        .th-ico { width: 30px; height: 30px; border-radius: 8px; background: var(--red-bg); display: flex; align-items: center; justify-content: center; }
        .th-ico i { color: var(--red); font-size: 12px; }

        /* Badges */
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

        /* Book showcase */
        .book-showcase { display: flex; align-items: center; gap: 16px; margin: 16px 20px; padding: 15px 18px; background: var(--red-bg); border: 1.5px solid var(--red-sf); border-radius: 12px; }
        .book-cover { width: 52px; height: 70px; border-radius: 7px; flex-shrink: 0; background: var(--red); display: flex; align-items: center; justify-content: center; }
        .book-cover i { color: rgba(255,255,255,.85); font-size: 18px; }
        .book-title-main { font-size: 14.5px; font-weight: 800; color: var(--gray-900); margin-bottom: 5px; line-height: 1.3; letter-spacing: -.01em; }
        .book-tx-id { display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 600; color: var(--gray-400); background: #fff; border: 1px solid var(--gray-200); padding: 2px 9px; border-radius: 7px; }

        /* Info rows */
        .info-section { padding: 0 20px 6px; }
        .info-row { display: flex; align-items: center; gap: 13px; padding: 12px 0; border-bottom: 1px solid var(--gray-100); }
        .info-row:last-child { border-bottom: none; }
        .info-ico { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 13px; }
        .ico-red    { background: var(--red-bg);    color: var(--red); }
        .ico-amber  { background: var(--amber-bg);  color: var(--amber); }
        .ico-green  { background: var(--green-bg);  color: var(--green); }
        .ico-sky    { background: var(--sky-bg);    color: var(--sky); }
        .ico-indigo { background: var(--indigo-bg); color: var(--indigo); }
        .info-lbl { font-size: 10px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .07em; margin-bottom: 2px; }
        .info-val { font-size: 13.5px; font-weight: 700; color: var(--gray-900); }
        .info-val-muted { font-size: 12.5px; color: var(--gray-400); font-style: italic; font-weight: 400; }

        .warn-chip { display: inline-flex; align-items: center; gap: 4px; font-size: 10.5px; font-weight: 700; padding: 2px 7px; border-radius: 6px; margin-left: 6px; }
        .warn-late { background: var(--rose-bg);  color: var(--rose); }
        .warn-soon { background: var(--amber-bg); color: var(--amber); }

        /* Status display */
        .status-display { padding: 22px 18px 18px; text-align: center; border-bottom: 1px solid var(--gray-100); }
        .status-ring { width: 68px; height: 68px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 24px; }
        .ring-pending  { background: var(--amber-bg); color: var(--amber); box-shadow: 0 0 0 6px rgba(217,119,6,.1); }
        .ring-approved { background: var(--green-bg); color: var(--green); box-shadow: 0 0 0 6px rgba(22,163,74,.1); }
        .ring-returned { background: var(--indigo-bg);color: var(--indigo);box-shadow: 0 0 0 6px rgba(79,70,229,.1); }
        .ring-rejected { background: var(--rose-bg);  color: var(--rose);  box-shadow: 0 0 0 6px rgba(225,29,72,.1); }
        .status-lbl  { font-size: 15px; font-weight: 800; color: var(--gray-900); margin-bottom: 5px; letter-spacing: -.01em; }
        .status-desc { font-size: 12px; color: var(--gray-400); line-height: 1.55; max-width: 210px; margin: 0 auto; }

        /* Timeline */
        .timeline { padding: 16px 18px 4px; }
        .tl-head { font-size: 10px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--gray-400); margin-bottom: 12px; }
        .tl-item { display: flex; gap: 11px; position: relative; padding-bottom: 13px; }
        .tl-item:last-child { padding-bottom: 0; }
        .tl-item:not(:last-child)::before { content: ''; position: absolute; left: 10px; top: 22px; bottom: 0; width: 1.5px; background: var(--gray-200); }
        .tl-dot { width: 22px; height: 22px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 8px; margin-top: 1px; }
        .tl-done   { background: var(--green-bg); color: var(--green); }
        .tl-active { background: var(--red-bg);   color: var(--red); }
        .tl-wait   { background: var(--gray-100); color: var(--gray-300); border: 1.5px dashed var(--gray-200); }
        .tl-reject { background: var(--rose-bg);  color: var(--rose); }
        .tl-event  { font-size: 12.5px; font-weight: 700; color: var(--gray-700); margin-bottom: 1px; }
        .tl-date   { font-size: 11px; color: var(--gray-400); }

        /* Action buttons */
        .btn-pdf-full { display: flex; align-items: center; justify-content: center; gap: 7px; margin: 14px 18px 10px; padding: 10px 16px; background: var(--sky-bg); color: var(--sky); border: 1.5px solid #bae6fd; border-radius: 9px; font-size: 12.5px; font-weight: 700; cursor: pointer; transition: all .15s; }
        .btn-pdf-full:hover { background: var(--sky); color: #fff; border-color: var(--sky); }
        .btn-back-full { display: flex; align-items: center; justify-content: center; gap: 7px; margin: 0 18px 16px; padding: 10px 16px; background: var(--red-bg); color: var(--red); border: 1.5px solid var(--red-sf); border-radius: 9px; font-size: 12.5px; font-weight: 700; transition: all .15s; text-decoration: none; }
        .btn-back-full:hover { background: var(--red); color: #fff; border-color: var(--red); }

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
        <a href="{{ route('user.borrowing.index') }}">Riwayat Peminjaman</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Detail Peminjaman</span>
    </div>

    {{-- HERO --}}
    <div class="hero au d1">
        <div class="hero-inner">
            <div>
                <div class="hero-badge"><i class="fas fa-file-lines" style="font-size:9px;"></i> Informasi Transaksi</div>
                <p class="hero-ph-label">Detail Transaksi</p>
                <h2 class="hero-title">Detail Peminjaman</h2>
                <p class="hero-sub">Informasi lengkap mengenai transaksi peminjaman buku Anda</p>
            </div>
            <div class="hero-illus">
                <div class="hero-icon-wrap"><i class="fas fa-file-lines"></i></div>
            </div>
        </div>
    </div>

    {{-- SECTION HEADER --}}
    <div class="sec-hd au d2">
        <div>
            <div class="sec-title">Informasi Peminjaman</div>
            <p class="sec-sub">Data lengkap transaksi peminjaman buku</p>
        </div>
        <a href="{{ route('user.borrowing.index') }}" class="btn-back-riwayat">
            <i class="fas fa-arrow-left" style="font-size:10px;"></i> Kembali ke Riwayat
        </a>
    </div>

    {{-- DETAIL GRID --}}
    <div class="detail-grid">

        {{-- LEFT: MAIN INFO --}}
        <div class="card au d3">
            <div class="card-hd">
                <div class="card-hd-title">
                    <div class="th-ico"><i class="fas fa-book"></i></div>
                    Data Buku &amp; Transaksi
                </div>
                @if($borrowing->status === 'pending')
                    <span class="badge badge-pending">Pending</span>
                @elseif($borrowing->status === 'approved')
                    <span class="badge badge-approved">Disetujui</span>
                @elseif($borrowing->status === 'returned')
                    <span class="badge badge-returned">Dikembalikan</span>
                @else
                    <span class="badge badge-rejected">Ditolak</span>
                @endif
            </div>

            <div class="book-showcase">
                <div class="book-cover"><i class="fas fa-book-open"></i></div>
                <div>
                    <div class="book-title-main">{{ $borrowing->book->judul ?? $borrowing->book->title ?? '-' }}</div>
                    <div class="book-tx-id">
                        <i class="fas fa-hashtag" style="font-size:8px;"></i>
                        ID Transaksi: #{{ str_pad($borrowing->id, 5, '0', STR_PAD_LEFT) }}
                    </div>
                </div>
            </div>

            <div class="info-section">
                <div class="info-row">
                    <div class="info-ico ico-sky"><i class="fas fa-user"></i></div>
                    <div>
                        <div class="info-lbl">Nama Peminjam</div>
                        <div class="info-val">{{ $borrowing->user->name ?? '-' }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-ico ico-red"><i class="fas fa-calendar-plus"></i></div>
                    <div>
                        <div class="info-lbl">Tanggal Pinjam</div>
                        <div class="info-val">{{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam ?? $borrowing->created_at)->translatedFormat('d F Y') }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-ico ico-amber"><i class="fas fa-calendar-xmark"></i></div>
                    <div>
                        <div class="info-lbl">Batas Pengembalian</div>
                        <div class="info-val">
                            @if($borrowing->due_date)
                                {{ \Carbon\Carbon::parse($borrowing->due_date)->translatedFormat('d F Y') }}
                                @php $daysLeft = \Carbon\Carbon::now()->diffInDays($borrowing->due_date, false); @endphp
                                @if($borrowing->status === 'approved')
                                    @if($daysLeft < 0)
                                        <span class="warn-chip warn-late"><i class="fas fa-circle-exclamation"></i> Terlambat {{ abs($daysLeft) }} hari</span>
                                    @elseif($daysLeft <= 3)
                                        <span class="warn-chip warn-soon"><i class="fas fa-triangle-exclamation"></i> {{ $daysLeft }} hari lagi</span>
                                    @endif
                                @endif
                            @else
                                <span class="info-val-muted">Tidak ditentukan</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-ico ico-green"><i class="fas fa-calendar-check"></i></div>
                    <div>
                        <div class="info-lbl">Tanggal Dikembalikan</div>
                        <div class="info-val">
                            @if($borrowing->returned_at)
                                {{ \Carbon\Carbon::parse($borrowing->returned_at)->translatedFormat('d F Y') }}
                            @else
                                <span class="info-val-muted">Belum dikembalikan</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-ico ico-indigo"><i class="fas fa-clock-rotate-left"></i></div>
                    <div>
                        <div class="info-lbl">Pengajuan Dibuat</div>
                        <div class="info-val">{{ $borrowing->created_at->translatedFormat('d F Y, H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT: STATUS + TIMELINE --}}
        <div style="display:flex; flex-direction:column; gap:14px;">
            <div class="card au d4">

                {{-- Status Display --}}
                <div class="status-display">
                    @if($borrowing->status === 'pending')
                        <div class="status-ring ring-pending"><i class="fas fa-hourglass-half"></i></div>
                        <div class="status-lbl">Menunggu Persetujuan</div>
                        <div class="status-desc">Permintaan peminjaman Anda sedang menunggu konfirmasi dari pustakawan.</div>
                    @elseif($borrowing->status === 'approved')
                        <div class="status-ring ring-approved"><i class="fas fa-book-open-reader"></i></div>
                        <div class="status-lbl">Sedang Dipinjam</div>
                        <div class="status-desc">Buku sedang dalam peminjaman Anda. Harap kembalikan tepat waktu.</div>
                    @elseif($borrowing->status === 'returned')
                        <div class="status-ring ring-returned"><i class="fas fa-circle-check"></i></div>
                        <div class="status-lbl">Selesai</div>
                        <div class="status-desc">Buku telah berhasil dikembalikan. Terima kasih!</div>
                    @else
                        <div class="status-ring ring-rejected"><i class="fas fa-circle-xmark"></i></div>
                        <div class="status-lbl">Ditolak</div>
                        <div class="status-desc">Permintaan peminjaman Anda tidak dapat diproses.</div>
                    @endif
                </div>

                {{-- Timeline --}}
                <div class="timeline">
                    <div class="tl-head"><i class="fas fa-timeline" style="margin-right:4px;"></i> Alur Status</div>

                    <div class="tl-item">
                        <div class="tl-dot tl-done"><i class="fas fa-check"></i></div>
                        <div>
                            <div class="tl-event">Pengajuan Dikirim</div>
                            <div class="tl-date">{{ $borrowing->created_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>

                    <div class="tl-item">
                        @if(in_array($borrowing->status, ['approved','returned']))
                            <div class="tl-dot tl-done"><i class="fas fa-check"></i></div>
                        @elseif($borrowing->status === 'rejected')
                            <div class="tl-dot tl-reject"><i class="fas fa-xmark"></i></div>
                        @else
                            <div class="tl-dot tl-active"><i class="fas fa-ellipsis"></i></div>
                        @endif
                        <div>
                            <div class="tl-event">
                                @if($borrowing->status === 'rejected') Ditolak
                                @elseif($borrowing->status === 'pending') Menunggu Persetujuan
                                @else Disetujui
                                @endif
                            </div>
                            <div class="tl-date">
                                @if($borrowing->status === 'pending') Sedang diproses...
                                @else {{ $borrowing->updated_at->format('d M Y, H:i') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="tl-item">
                        @if($borrowing->status === 'returned')
                            <div class="tl-dot tl-done"><i class="fas fa-check"></i></div>
                        @else
                            <div class="tl-dot tl-wait"><i class="fas fa-clock"></i></div>
                        @endif
                        <div>
                            <div class="tl-event">Buku Dikembalikan</div>
                            <div class="tl-date">
                                @if($borrowing->returned_at)
                                    {{ \Carbon\Carbon::parse($borrowing->returned_at)->format('d M Y, H:i') }}
                                @else
                                    Menunggu pengembalian
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn-pdf-full" onclick="exportDetailToPDF()">
                    <i class="fas fa-file-pdf"></i> Unduh Bukti PDF
                </button>
                <a href="{{ route('user.borrowing.index') }}" class="btn-back-full">
                    <i class="fas fa-arrow-left" style="font-size:10px;"></i> Kembali ke Riwayat
                </a>
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

function exportDetailToPDF() {
    var jsPDF = window.jspdf.jsPDF;
    var doc   = new jsPDF();
    var pw    = doc.internal.pageSize.getWidth();

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
        ['ID Transaksi',   document.querySelector('.book-tx-id') ? document.querySelector('.book-tx-id').innerText.replace('ID Transaksi:', '').trim() : '-'],
        ['Judul Buku',     document.querySelector('.book-title-main') ? document.querySelector('.book-title-main').innerText.trim() : '-'],
        ['Nama Peminjam',  '{{ $borrowing->user->name ?? "-" }}'],
        ['Tanggal Pinjam', '{{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam ?? $borrowing->created_at)->format("d M Y") }}'],
        ['Batas Kembali',  '{{ $borrowing->due_date ? \Carbon\Carbon::parse($borrowing->due_date)->format("d M Y") : "-" }}'],
        ['Dikembalikan',   '{{ $borrowing->returned_at ? \Carbon\Carbon::parse($borrowing->returned_at)->format("d M Y") : "Belum dikembalikan" }}'],
        ['Status',         '{{ ucfirst($borrowing->status) }}'],
    ];

    var boxX = 14, boxY = 48, boxW = pw - 28;
    var labelX = boxX + 8, colonX = labelX + 46, valueX = colonX + 6;
    var maxVW = pw - valueX - 14;
    var rowH = 14;
    var rendered = fields.map(function (f) {
        var lines = doc.splitTextToSize(f[1], maxVW);
        var h = Math.max(rowH, lines.length * 6 + 8);
        return { label: f[0], lines: lines, h: h };
    });
    var totalH = rendered.reduce(function (s, r) { return s + r.h; }, 10);

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

    var statusText = '{{ strtoupper($borrowing->status) }}';
    var sl = statusText.toLowerCase();
    var bc = (sl === 'returned' || sl === 'dikembalikan') ? [22, 163, 74] :
             (sl === 'rejected' || sl === 'ditolak')      ? [225, 29, 72] :
             (sl === 'pending')                            ? [217, 119, 6] : [22, 163, 74];
    var by = boxY + totalH + 11;
    doc.setFillColor(bc[0], bc[1], bc[2]);
    doc.roundedRect(pw / 2 - 32, by, 64, 10, 3, 3, 'F');
    doc.setFont('helvetica', 'bold'); doc.setFontSize(8.5); doc.setTextColor(255, 255, 255);
    doc.text(statusText, pw / 2, by + 7, { align: 'center' });

    var fy = doc.internal.pageSize.getHeight() - 14;
    doc.setDrawColor(200, 200, 200); doc.setLineWidth(0.3);
    doc.line(14, fy - 4, pw - 14, fy - 4);
    doc.setFontSize(7.5); doc.setFont('helvetica', 'italic'); doc.setTextColor(150, 150, 150);
    doc.text('Dokumen diterbitkan otomatis oleh sistem PerpusInd.', pw / 2, fy, { align: 'center' });
    doc.text('Dicetak: ' + new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }), pw / 2, fy + 5.5, { align: 'center' });

    doc.save('Detail_Peminjaman_{{ str_pad($borrowing->id, 5, "0", STR_PAD_LEFT) }}.pdf');
}
</script>
</body>
</html>
