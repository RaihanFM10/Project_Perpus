<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman | PerpusInd</title>
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
            --rose:      #E11D48;
            --rose-bg:   #FFE4E6;
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

        @media (max-width: 900px) { .borrow-grid { grid-template-columns: 1fr !important; } }
        @media (max-width: 768px) {
            .topbar { display: flex; }
            .sidebar { position: fixed; left: 0; top: 0; transform: translateX(-100%); transition: transform .3s ease; }
            .sidebar.open { transform: translateX(0); box-shadow: 4px 0 24px rgba(0,0,0,.1); }
            main { padding: 24px 18px; }
            body { flex-direction: column; }
            .hero-illus { display: none; }
            .hero-inner { padding: 22px; }
            .form-actions { flex-direction: column; }
            .rating-summary { flex-direction: column; gap: 14px; }
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
        .btn-back-cat { display: inline-flex; align-items: center; gap: 6px; padding: 8px 15px; border: 1.5px solid var(--gray-200); border-radius: 9px; font-size: 12.5px; font-weight: 600; color: var(--gray-500); background: #fff; transition: border-color .15s, color .15s; }
        .btn-back-cat:hover { border-color: var(--red); color: var(--red); }

        /* ── GRID ── */
        .borrow-grid { display: grid; grid-template-columns: 290px 1fr; gap: 16px; margin-bottom: 16px; }

        /* ── CARD ── */
        .card { background: #fff; border-radius: 13px; border: 1.5px solid var(--gray-200); overflow: hidden; }
        .card-hd { padding: 14px 20px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; gap: 9px; }
        .card-hd-ico { width: 30px; height: 30px; border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 12px; }
        .ico-red   { background: var(--red-bg);   color: var(--red); }
        .ico-amber { background: var(--amber-bg);  color: var(--amber); }
        .card-hd-title { font-size: 14px; font-weight: 700; flex: 1; }
        .card-hd-count { font-size: 11px; font-weight: 700; background: var(--red-bg); color: var(--red); padding: 2px 9px; border-radius: 999px; }

        /* ── BOOK DETAIL ── */
        .book-cover-wrap { margin: 14px 14px 0; border-radius: 11px; overflow: hidden; background: var(--red-bg); border: 1.5px solid var(--red-sf); height: 185px; display: flex; align-items: center; justify-content: center; }
        .book-cover-wrap img { width: 100%; height: 100%; object-fit: contain; }
        .book-cover-wrap i { font-size: 46px; color: var(--red-sf); }

        .book-meta { padding: 13px 14px 0; }
        .book-title-main { font-size: 14px; font-weight: 800; color: var(--gray-900); margin-bottom: 2px; line-height: 1.3; letter-spacing: -.01em; }
        .book-author { font-size: 12.5px; color: var(--gray-400); margin-bottom: 12px; }

        .meta-divider { height: 1px; background: var(--gray-100); margin: 10px 0; }
        .meta-row { display: flex; align-items: flex-start; gap: 9px; margin-bottom: 9px; }
        .meta-row:last-child { margin-bottom: 0; }
        .meta-ico { width: 26px; height: 26px; background: var(--red-bg); border-radius: 7px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
        .meta-ico i { color: var(--red); font-size: 9px; }
        .meta-lbl { font-size: 10px; color: var(--gray-400); margin-bottom: 1px; }
        .meta-val { font-size: 12px; font-weight: 600; color: var(--gray-700); }
        .meta-val.long { font-weight: 400; color: var(--gray-500); line-height: 1.5; font-size: 11.5px; }

        .stock-chip { margin: 12px 14px 14px; padding: 9px 13px; border-radius: 9px; display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700; }
        .stock-ok  { background: var(--green-bg); color: var(--green); border: 1px solid #bbf7d0; }
        .stock-no  { background: var(--rose-bg);  color: var(--rose);  border: 1px solid #fda4af; }
        .pulse-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
        .pulse-dot.anim { animation: pulse 1.5s infinite; }

        /* ── FORM ── */
        .form-body { padding: 20px; }

        .borrower-box { background: var(--red-bg); border: 1.5px solid var(--red-sf); border-radius: 11px; padding: 13px 15px; margin-bottom: 20px; display: flex; align-items: center; gap: 11px; }
        .borrower-avatar { width: 38px; height: 38px; background: var(--red); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #fff; font-size: 14px; flex-shrink: 0; }
        .borrower-lbl   { font-size: 10px; color: var(--red); font-weight: 700; letter-spacing: .05em; text-transform: uppercase; margin-bottom: 2px; }
        .borrower-name  { font-size: 13.5px; font-weight: 800; color: var(--red-dk); }
        .borrower-email { font-size: 11.5px; color: var(--gray-500); }

        .field-group { margin-bottom: 16px; }
        .field-label { display: block; font-size: 11.5px; font-weight: 700; color: var(--gray-700); margin-bottom: 6px; text-transform: uppercase; letter-spacing: .04em; }
        .field-label i { color: var(--red); margin-right: 4px; font-size: 10px; }
        .field-input { width: 100%; border: 1.5px solid var(--gray-200); border-radius: 10px; padding: 10px 13px; font-size: 13px; font-family: inherit; color: var(--gray-900); outline: none; background: #fff; transition: border-color .15s, box-shadow .15s; }
        .field-input:focus { border-color: var(--red); box-shadow: 0 0 0 3px rgba(220,38,38,.07); }

        .warning-box { background: var(--amber-bg); border: 1.5px solid #fde68a; border-radius: 11px; padding: 13px 15px; display: flex; gap: 11px; margin-bottom: 20px; }
        .warning-ico { width: 30px; height: 30px; background: #fef3c7; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
        .warning-title { font-size: 12.5px; font-weight: 700; color: #92400e; margin-bottom: 5px; }
        .warning-list { list-style: none; padding: 0; margin: 0; }
        .warning-list li { font-size: 12px; color: #a16207; margin-bottom: 3px; display: flex; align-items: center; gap: 6px; }
        .warning-list li::before { content: '•'; color: var(--amber); font-size: 14px; }

        .form-actions { display: flex; gap: 10px; }
        .btn-cancel { display: flex; align-items: center; justify-content: center; gap: 6px; padding: 10px 18px; background: #fff; border: 1.5px solid var(--gray-200); border-radius: 9px; font-size: 13px; font-weight: 700; color: var(--gray-500); cursor: pointer; transition: border-color .15s, color .15s; }
        .btn-cancel:hover { border-color: var(--gray-300); color: var(--gray-900); }
        .btn-confirm { flex: 1; display: flex; align-items: center; justify-content: center; gap: 7px; padding: 10px 18px; background: var(--red); border: none; border-radius: 9px; font-size: 13px; font-weight: 700; color: #fff; cursor: pointer; transition: background .15s, transform .15s; }
        .btn-confirm:hover { background: var(--red-dk); transform: translateY(-1px); }

        /* ── REVIEWS CARD ── */
        .rating-summary { display: flex; align-items: center; gap: 22px; padding: 18px 20px; background: var(--gray-50); border-bottom: 1px solid var(--gray-100); }
        .rating-big { text-align: center; flex-shrink: 0; }
        .rating-big-num { font-size: 38px; font-weight: 800; color: var(--gray-900); line-height: 1; margin-bottom: 5px; }
        .rating-big-stars { display: flex; gap: 3px; justify-content: center; margin-bottom: 4px; }
        .rating-big-stars i { font-size: 13px; color: #fbbf24; }
        .rating-big-count { font-size: 11px; color: var(--gray-400); }

        .rating-bars { flex: 1; }
        .bar-row { display: flex; align-items: center; gap: 9px; margin-bottom: 5px; }
        .bar-row:last-child { margin-bottom: 0; }
        .bar-label { font-size: 11px; color: var(--gray-500); width: 32px; text-align: right; flex-shrink: 0; }
        .bar-track { flex: 1; height: 5px; background: var(--gray-200); border-radius: 999px; overflow: hidden; }
        .bar-fill  { height: 100%; background: #fbbf24; border-radius: 999px; transition: width .6s ease; }
        .bar-count { font-size: 10.5px; color: var(--gray-400); width: 18px; flex-shrink: 0; }

        .reviews-body { padding: 16px 20px; }
        .review-item { padding: 14px 0; border-bottom: 1px solid var(--gray-100); }
        .review-item:last-child { border-bottom: none; padding-bottom: 0; }
        .review-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 7px; }
        .reviewer-info { display: flex; align-items: center; gap: 9px; }
        .reviewer-avatar { width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0; background: var(--red); display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff; font-size: 12px; }
        .reviewer-name { font-size: 12.5px; font-weight: 700; color: var(--gray-900); }
        .reviewer-date { font-size: 11px; color: var(--gray-400); }
        .review-stars { display: flex; gap: 2px; }
        .review-stars i { font-size: 10px; color: #fbbf24; }
        .review-stars i.empty { color: var(--gray-200); }
        .review-text { font-size: 12.5px; color: var(--gray-500); line-height: 1.6; padding-left: 43px; }

        .empty-reviews { text-align: center; padding: 44px 20px; }
        .empty-ico { width: 56px; height: 56px; border-radius: 16px; background: var(--amber-bg); margin: 0 auto 12px; display: flex; align-items: center; justify-content: center; }
        .empty-ico i { font-size: 22px; color: var(--amber); }
        .empty-ttl { font-size: 15px; font-weight: 800; color: var(--gray-700); margin-bottom: 4px; letter-spacing: -.01em; }
        .empty-sub { font-size: 12.5px; color: var(--gray-400); }

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
        <div class="sb-group">Akun</div>
        <a href="{{ url('/profile') }}" class="sb-link {{ request()->is('profile*') ? 'active' : '' }}"><i class="fas fa-user"></i> Profil Saya</a>
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
        <a href="{{ route('user.books') }}">Katalog Buku</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Form Peminjaman</span>
    </div>

    {{-- HERO --}}
    <div class="hero au d1">
        <div class="hero-inner">
            <div>
                <div class="hero-badge"><i class="fas fa-clipboard-list" style="font-size:9px;"></i> Katalog Buku</div>
                <p class="hero-ph-label">Form Peminjaman</p>
                <h2 class="hero-title">Pinjam Buku</h2>
                <p class="hero-sub">Lengkapi informasi di bawah untuk meminjam buku</p>
            </div>
            <div class="hero-illus">
                <div class="hero-icon-wrap"><i class="fas fa-clipboard-list"></i></div>
            </div>
        </div>
    </div>

    {{-- Section header --}}
    <div class="sec-hd au d2">
        <div>
            <div class="sec-title">Detail Peminjaman</div>
            <p class="sec-sub">Periksa detail buku dan isi form peminjaman</p>
        </div>
        <a href="{{ route('user.books') }}" class="btn-back-cat">
            <i class="fas fa-arrow-left" style="font-size:10px;"></i> Kembali ke Katalog
        </a>
    </div>

    {{-- BORROW GRID --}}
    <div class="borrow-grid">

        {{-- BOOK DETAIL CARD --}}
        <div class="card au d2">
            <div class="card-hd">
                <div class="card-hd-ico ico-red"><i class="fas fa-book"></i></div>
                <span class="card-hd-title">Detail Buku</span>
            </div>

            <div class="book-cover-wrap">
                @if($book->image)
                    <img src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->judul }}">
                @else
                    <i class="fas fa-book-open"></i>
                @endif
            </div>

            <div class="book-meta">
                <h4 class="book-title-main">{{ $book->judul }}</h4>
                <p class="book-author">{{ $book->penulis }}</p>
                <div class="meta-divider"></div>
                <div class="meta-row">
                    <div class="meta-ico"><i class="fas fa-barcode"></i></div>
                    <div><div class="meta-lbl">Kode Buku</div><div class="meta-val">{{ $book->kode_buku ?? '-' }}</div></div>
                </div>
                <div class="meta-row">
                    <div class="meta-ico"><i class="fas fa-tag"></i></div>
                    <div><div class="meta-lbl">Kategori</div><div class="meta-val">{{ $book->kategori->nama ?? $book->KategoriID ?? 'Umum' }}</div></div>
                </div>
                <div class="meta-row">
                    <div class="meta-ico"><i class="fas fa-building"></i></div>
                    <div><div class="meta-lbl">Penerbit</div><div class="meta-val">{{ $book->penerbit ?? '-' }}</div></div>
                </div>
                <div class="meta-row">
                    <div class="meta-ico"><i class="fas fa-calendar"></i></div>
                    <div><div class="meta-lbl">Tahun Terbit</div><div class="meta-val">{{ $book->tahun ?? '-' }}</div></div>
                </div>
                <div class="meta-row">
                    <div class="meta-ico"><i class="fas fa-layer-group"></i></div>
                    <div><div class="meta-lbl">Stok Tersedia</div><div class="meta-val">{{ $book->stok }} buku</div></div>
                </div>
                @if($book->deskripsi)
                <div class="meta-row">
                    <div class="meta-ico"><i class="fas fa-align-left"></i></div>
                    <div><div class="meta-lbl">Deskripsi</div><div class="meta-val long">{{ $book->deskripsi }}</div></div>
                </div>
                @endif
            </div>

            @if($book->stok > 0)
                <div class="stock-chip stock-ok"><span class="pulse-dot anim"></span> Tersedia untuk dipinjam</div>
            @else
                <div class="stock-chip stock-no"><span class="pulse-dot"></span> Stok habis</div>
            @endif
        </div>

        {{-- FORM CARD --}}
        <div class="card au d3">
            <div class="card-hd">
                <div class="card-hd-ico ico-red"><i class="fas fa-clipboard-list"></i></div>
                <span class="card-hd-title">Informasi Peminjaman</span>
            </div>

            <div class="form-body">
                <div class="borrower-box">
                    <div class="borrower-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div>
                        <div class="borrower-lbl">Peminjam</div>
                        <div class="borrower-name">{{ auth()->user()->name }}</div>
                        <div class="borrower-email">{{ auth()->user()->email }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('user.borrow.confirm', $book) }}">
                    @csrf

                    <div class="field-group">
                        <label class="field-label"><i class="fas fa-calendar-day"></i> Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" class="field-input">
                    </div>

                    <div class="field-group">
                        <label class="field-label"><i class="fas fa-calendar-check"></i> Tanggal Kembali</label>
                        <input type="date" name="due_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="field-input">
                    </div>

                    <div class="warning-box">
                        <div class="warning-ico">
                            <i class="fas fa-triangle-exclamation" style="color:var(--amber); font-size:13px;"></i>
                        </div>
                        <div>
                            <div class="warning-title">Perhatian!</div>
                            <ul class="warning-list">
                                <li>Pastikan mengembalikan buku tepat waktu</li>
                                <li>Keterlambatan akan dikenakan denda</li>
                                <li>Jaga kondisi buku dengan baik</li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('user.books') }}" class="btn-cancel">
                            <i class="fas fa-arrow-left" style="font-size:10px;"></i> Batal
                        </a>
                        <button type="submit" class="btn-confirm">
                            <i class="fas fa-book-reader"></i> Konfirmasi Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>{{-- end .borrow-grid --}}

    {{-- ULASAN PEMBACA --}}
    @php
        $ratings      = $book->ratings;
        $totalRatings = $ratings->count();
        $avgRating    = $totalRatings > 0 ? round($ratings->avg('rating'), 1) : 0;
        $avgRounded   = round($avgRating);
        $starCounts   = [];
        for ($s = 5; $s >= 1; $s--) {
            $starCounts[$s] = $ratings->where('rating', $s)->count();
        }
    @endphp

    <div class="card au d4" style="margin-bottom:0;">
        <div class="card-hd">
            <div class="card-hd-ico ico-amber"><i class="fas fa-star"></i></div>
            <span class="card-hd-title">Ulasan Pembaca</span>
            @if($totalRatings > 0)
                <span class="card-hd-count">{{ $totalRatings }} ulasan</span>
            @endif
        </div>

        @if($totalRatings > 0)
        <div class="rating-summary">
            <div class="rating-big">
                <div class="rating-big-num">{{ $avgRating }}</div>
                <div class="rating-big-stars">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star" style="{{ $i <= $avgRounded ? 'color:#fbbf24' : 'color:#e5e7eb' }}"></i>
                    @endfor
                </div>
                <div class="rating-big-count">dari {{ $totalRatings }} ulasan</div>
            </div>
            <div class="rating-bars">
                @for($s = 5; $s >= 1; $s--)
                    @php $pct = $totalRatings > 0 ? ($starCounts[$s] / $totalRatings * 100) : 0; @endphp
                    <div class="bar-row">
                        <div class="bar-label">{{ $s }} <i class="fas fa-star" style="font-size:9px; color:#fbbf24;"></i></div>
                        <div class="bar-track"><div class="bar-fill" style="width:{{ $pct }}%;"></div></div>
                        <div class="bar-count">{{ $starCounts[$s] }}</div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="reviews-body">
            @foreach($ratings as $idx => $rating)
            <div class="review-item" style="animation: fadeUp .4s ease both; animation-delay:{{ $idx * 60 }}ms;">
                <div class="review-top">
                    <div class="reviewer-info">
                        <div class="reviewer-avatar">{{ strtoupper(substr($rating->user->name, 0, 1)) }}</div>
                        <div>
                            <div class="reviewer-name">{{ $rating->user->name }}</div>
                            <div class="reviewer-date">{{ $rating->created_at?->format('d M Y') }}</div>
                        </div>
                    </div>
                    <div class="review-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $rating->rating ? '' : 'empty' }}"></i>
                        @endfor
                    </div>
                </div>
                @if($rating->ulasan)
                    <p class="review-text">{{ $rating->ulasan }}</p>
                @endif
            </div>
            @endforeach
        </div>

        @else
        <div class="empty-reviews">
            <div class="empty-ico"><i class="fas fa-star"></i></div>
            <div class="empty-ttl">Belum Ada Ulasan</div>
            <div class="empty-sub">Jadilah yang pertama memberi ulasan setelah membaca buku ini</div>
        </div>
        @endif
    </div>

    <div class="flag-stripe au d5"><div class="fr"></div><div class="fw"></div></div>

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
