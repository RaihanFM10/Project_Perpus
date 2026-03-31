<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Buku | PerpusInd</title>
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
        .d1 { animation-delay: .05s; } .d2 { animation-delay: .12s; } .d3 { animation-delay: .19s; }
        .hidden { display: none !important; }

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
            .books-grid { grid-template-columns: 1fr 1fr !important; }
            .hero-illus { display: none; }
            .hero-inner { padding: 22px; }
            .sec-hd { flex-direction: column; align-items: flex-start; }
        }
        @media (max-width: 520px) { .books-grid { grid-template-columns: 1fr !important; } }

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
        .sec-hd { margin-bottom: 18px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
        .sec-title { font-size: 16px; font-weight: 800; color: var(--gray-900); display: flex; align-items: center; gap: 8px; margin-bottom: 3px; }
        .sec-count { display: inline-flex; align-items: center; gap: 4px; padding: 2px 9px; border-radius: 999px; background: var(--red-bg); color: var(--red); font-size: 11px; font-weight: 700; }
        .sec-sub { font-size: 12.5px; color: var(--gray-400); }

        .search-wrap { position: relative; }
        .search-wrap i { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 12px; pointer-events: none; }
        .search-wrap input { padding: 8px 13px 8px 32px; border: 1.5px solid var(--gray-200); border-radius: 9px; font-size: 13px; font-family: inherit; color: var(--gray-900); background: #fff; outline: none; width: 210px; transition: border .15s, box-shadow .15s; }
        .search-wrap input:focus { border-color: var(--red); box-shadow: 0 0 0 3px rgba(220,38,38,.07); }
        .search-wrap:focus-within i { color: var(--red); }

        /* ── BOOKS GRID ── */
        .books-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
        @media (max-width: 1100px) { .books-grid { grid-template-columns: 1fr 1fr; } }

        /* ── BOOK CARD ── */
        .book-card { background: #fff; border-radius: 13px; border: 1.5px solid var(--gray-200); overflow: hidden; display: flex; flex-direction: column; transition: transform .2s, box-shadow .2s, border-color .2s; animation: fadeUp .5s ease both; }
        .book-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.08); border-color: var(--red); }
        .book-card:hover .bc-cover-img { transform: scale(1.05); }

        .bc-cover { height: 180px; position: relative; overflow: hidden; background: var(--gray-100); display: flex; align-items: center; justify-content: center; }
        .bc-cover-img { width: 100%; height: 100%; object-fit: contain; transition: transform .3s ease; display: block; }
        .bc-cover-placeholder { font-size: 48px; color: var(--gray-300); }

        .stock-badge { position: absolute; top: 10px; right: 10px; display: flex; align-items: center; gap: 5px; padding: 3px 9px; border-radius: 999px; font-size: 10.5px; font-weight: 600; background: rgba(255,255,255,.92); border: 1px solid; white-space: nowrap; }
        .stock-badge.available { color: var(--green); border-color: rgba(22,163,74,.2); }
        .stock-badge.empty     { color: var(--red);   border-color: rgba(220,38,38,.2); }
        .pulse-dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
        .pulse-dot.green { background: var(--green); animation: pulse 1.5s infinite; }
        .pulse-dot.red   { background: var(--red); }

        .bc-cat-badge { position: absolute; bottom: 9px; left: 10px; padding: 2px 9px; border-radius: 999px; font-size: 10px; font-weight: 700; background: rgba(255,255,255,.9); color: var(--indigo); border: 1px solid rgba(79,70,229,.15); white-space: nowrap; }

        .bc-body { padding: 15px; flex: 1; display: flex; flex-direction: column; }
        .bc-title { font-size: 14px; font-weight: 800; color: var(--gray-900); margin-bottom: 3px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.35; letter-spacing: -.01em; }
        .bc-author { font-size: 11.5px; color: var(--gray-400); font-weight: 500; margin-bottom: 9px; display: flex; align-items: center; gap: 5px; }
        .bc-author i { font-size: 10px; }

        .bc-rating { display: flex; align-items: center; gap: 5px; margin-bottom: 12px; }
        .bc-stars { display: flex; gap: 2px; }
        .bc-stars i { font-size: 10px; }
        .bc-avg  { font-size: 11.5px; font-weight: 800; color: var(--gray-700); }
        .bc-cnt  { font-size: 11px; color: var(--gray-400); }

        hr.bc-div { border: none; border-top: 1px solid var(--gray-100); margin: 11px 0; }

        /* ── ACTION BUTTONS ── */
        .btn-pinjam { display: flex; align-items: center; justify-content: center; gap: 7px; width: 100%; padding: 9px 14px; background: var(--red); color: #fff; border: none; border-radius: 9px; font-size: 12.5px; font-weight: 700; cursor: pointer; text-decoration: none; transition: background .15s, transform .15s; }
        .btn-pinjam:hover { background: var(--red-dk); transform: translateY(-1px); }

        .btn-kembali { display: flex; align-items: center; justify-content: center; gap: 7px; width: 100%; padding: 9px 14px; background: var(--amber); color: #fff; border: none; border-radius: 9px; font-size: 12.5px; font-weight: 700; cursor: pointer; text-decoration: none; transition: background .15s, transform .15s; }
        .btn-kembali:hover { background: #b45309; transform: translateY(-1px); }

        .btn-waiting { display: flex; align-items: center; justify-content: center; gap: 7px; width: 100%; padding: 9px 14px; background: var(--amber-bg); color: var(--amber); border: 1.5px solid #fde68a; border-radius: 9px; font-size: 12.5px; font-weight: 700; cursor: not-allowed; }

        .btn-disabled-act { display: flex; align-items: center; justify-content: center; gap: 7px; width: 100%; padding: 9px 14px; background: var(--gray-100); color: var(--gray-400); border: 1.5px solid var(--gray-200); border-radius: 9px; font-size: 12.5px; font-weight: 700; cursor: not-allowed; }

        /* Secondary buttons */
        .bc-sec { display: grid; grid-template-columns: 1fr 1fr; gap: 7px; margin-top: 8px; }

        .btn-fav { display: flex; align-items: center; justify-content: center; gap: 5px; padding: 8px 10px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; border: 1.5px solid var(--gray-200); background: #fff; color: var(--gray-500); transition: border-color .15s, background .15s, color .15s; width: 100%; }
        .btn-fav:hover, .btn-fav.active { border-color: #fda4af; background: var(--rose-bg); color: var(--rose); }

        .btn-rate { display: flex; align-items: center; justify-content: center; gap: 5px; padding: 8px 10px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; border: 1.5px solid var(--gray-200); background: #fff; color: var(--gray-500); transition: border-color .15s, background .15s, color .15s; width: 100%; }
        .btn-rate:hover { border-color: #fcd34d; background: var(--amber-bg); color: var(--amber); }

        .btn-rate-off { display: flex; align-items: center; justify-content: center; gap: 5px; padding: 8px 10px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: not-allowed; border: 1.5px solid var(--gray-200); background: var(--gray-50); color: var(--gray-300); width: 100%; }

        /* Rating dropdown */
        .rating-dropdown { position: absolute; bottom: calc(100% + 8px); left: 0; right: 0; background: #fff; border-radius: 12px; border: 1.5px solid var(--gray-200); box-shadow: 0 12px 32px rgba(0,0,0,.1); padding: 16px; z-index: 50; }
        .rating-dropdown-title { font-size: 12.5px; font-weight: 700; color: var(--gray-900); text-align: center; margin-bottom: 12px; }
        .star-row { display: flex; justify-content: center; gap: 7px; margin-bottom: 12px; }
        .star-row i { font-size: 24px; cursor: pointer; transition: transform .15s, color .15s; color: var(--gray-200); }
        .star-row i:hover { transform: scale(1.15); }
        .rating-textarea { width: 100%; border: 1.5px solid var(--gray-200); border-radius: 9px; padding: 8px 11px; font-size: 12px; font-family: inherit; resize: none; margin-bottom: 9px; outline: none; transition: border-color .15s; color: var(--gray-900); }
        .rating-textarea:focus { border-color: var(--red); box-shadow: 0 0 0 3px rgba(220,38,38,.07); }
        .btn-submit-rate { width: 100%; padding: 9px; background: var(--red); color: #fff; border: none; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; transition: background .15s; }
        .btn-submit-rate:hover { background: var(--red-dk); }

        /* Empty state */
        .empty-state { padding: 60px 20px; text-align: center; grid-column: 1/-1; }
        .empty-icon { width: 56px; height: 56px; border-radius: 16px; margin: 0 auto 14px; background: var(--gray-100); display: flex; align-items: center; justify-content: center; }
        .empty-icon i { font-size: 22px; color: var(--gray-300); }
        .empty-state p { color: var(--gray-400); font-size: 13.5px; font-weight: 500; }

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
        <span class="active">Katalog Buku</span>
    </div>

    {{-- HERO --}}
    <div class="hero au d1">
        <div class="hero-inner">
            <div>
                <div class="hero-badge"><i class="fas fa-circle-check" style="font-size:9px;"></i> Perpustakaan Digital</div>
                <p class="hero-ph-label">Koleksi Buku</p>
                <h2 class="hero-title">Katalog Buku</h2>
                <p class="hero-sub">Telusuri dan pinjam buku dari koleksi perpustakaan kami</p>
            </div>
            <div class="hero-illus">
                <div class="hero-icon-wrap"><i class="fas fa-book-open"></i></div>
            </div>
        </div>
    </div>

    {{-- Section header --}}
    <div class="sec-hd au d2">
        <div>
            <div class="sec-title">
                Semua Koleksi
                <span class="sec-count"><i class="fas fa-layer-group" style="font-size:9px;"></i> {{ count($books) }} buku</span>
            </div>
            <p class="sec-sub">Pilih buku yang ingin Anda pinjam</p>
        </div>
        <div class="search-wrap">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari judul atau penulis…" oninput="filterBooks(this.value)">
        </div>
    </div>

    {{-- BOOKS GRID --}}
    <div class="books-grid" id="booksGrid">

        @forelse($books as $index => $book)
        <div class="book-card" style="animation-delay:{{ min($index * 55, 500) }}ms"
             data-title="{{ strtolower($book->judul) }}" data-author="{{ strtolower($book->penulis) }}">

            {{-- Cover --}}
            <div class="bc-cover">
                @if($book->image)
                    <img class="bc-cover-img" src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->judul }}">
                @else
                    <i class="fas fa-book-open bc-cover-placeholder"></i>
                @endif
                <div class="stock-badge {{ $book->stok > 0 ? 'available' : 'empty' }}">
                    <span class="pulse-dot {{ $book->stok > 0 ? 'green' : 'red' }}"></span>
                    {{ $book->stok > 0 ? 'Tersedia' : 'Habis' }}
                </div>
                <div class="bc-cat-badge">{{ $book->kategori->nama ?? 'Umum' }}</div>
            </div>

            {{-- Body --}}
            <div class="bc-body">
                <h3 class="bc-title">{{ $book->judul }}</h3>
                <p class="bc-author"><i class="fas fa-user-pen"></i> {{ $book->penulis }}</p>

                <div class="bc-rating">
                    <div class="bc-stars">
                        @php $avg = round($book->averageRating()); @endphp
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star" style="color:{{ $i <= $avg ? '#F59E0B' : '#E5E7EB' }};"></i>
                        @endfor
                    </div>
                    <span class="bc-avg">{{ number_format($book->averageRating(), 1) }}</span>
                    <span class="bc-cnt">({{ $book->ratingCount() }})</span>
                </div>

                <div style="flex:1;"></div>
                <hr class="bc-div">

                {{-- Primary action --}}
                @if($activeBorrowing)
                    @if($activeBorrowing->book_id === $book->id)
                        @if($activeBorrowing->status === 'pending')
                            <div class="btn-waiting"><i class="fas fa-hourglass-half"></i> Menunggu Persetujuan</div>
                        @elseif($activeBorrowing->status === 'rejected')
                            <a href="{{ route('user.borrow.create', $book) }}" class="btn-pinjam"><i class="fas fa-book-reader"></i> Pinjam Buku Lagi</a>
                        @elseif(in_array($activeBorrowing->status, ['approved','dipinjam']))
                            <a href="{{ route('user.borrow.return.page', $activeBorrowing->id) }}" class="btn-kembali"><i class="fas fa-undo"></i> Kembalikan Buku</a>
                        @endif
                    @else
                        <div class="btn-disabled-act" title="Selesaikan peminjaman sebelumnya"><i class="fas fa-lock"></i> Pinjam Buku</div>
                    @endif
                @else
                    @if($book->stok > 0)
                        <a href="{{ route('user.borrow.create', $book) }}" class="btn-pinjam"><i class="fas fa-book-reader"></i> Pinjam Buku</a>
                    @else
                        <div class="btn-disabled-act"><i class="fas fa-ban"></i> Stok Habis</div>
                    @endif
                @endif

                {{-- Secondary: Favorite + Rating --}}
                <div class="bc-sec">

                    @php
                        $isFavorite = \App\Models\Favorite::where('book_id', $book->id)->where('user_id', auth()->id())->exists();
                    @endphp
                    <form method="POST"
                        action="{{ $isFavorite ? route('user.favorite.destroy', $book) : route('user.favorite.store', $book) }}"
                        onsubmit="handleFavorite(this)"
                        data-favorited="{{ $isFavorite ? '1' : '0' }}">
                        @csrf
                        @if($isFavorite) @method('DELETE') @endif
                        <button type="submit" class="btn-fav {{ $isFavorite ? 'active' : '' }}" style="width:100%;">
                            <i class="{{ $isFavorite ? 'fas fa-heart' : 'far fa-heart' }}" style="color:var(--rose);"></i>
                            {{ $isFavorite ? 'Batal' : 'Favorit' }}
                        </button>
                    </form>

                    @php
                        $hasRated    = \App\Models\Rating::where('book_id', $book->id)->where('user_id', auth()->id())->exists();
                        $hasReturned = \App\Models\Borrowing::where('book_id', $book->id)->where('user_id', auth()->id())->where('status', 'returned')->exists();
                    @endphp
                    <div style="position:relative;">
                        @if(!$hasReturned)
                            <div class="btn-rate-off" style="width:100%;"><i class="fas fa-lock" style="font-size:10px;"></i> Rating</div>
                        @elseif($hasRated)
                            <div class="btn-rate-off" style="width:100%; color:var(--amber);"><i class="fas fa-star" style="color:#F59E0B;"></i> Rated</div>
                        @else
                            <button onclick="toggleRating(event, {{ $book->id }})" id="rating-btn-{{ $book->id }}" class="btn-rate" style="width:100%;">
                                <i class="far fa-star" style="color:#F59E0B;"></i> Rating
                            </button>
                            <div id="rating-{{ $book->id }}" class="rating-dropdown hidden">
                                <p class="rating-dropdown-title">Beri Rating &amp; Ulasan</p>
                                <div class="star-row">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star"
                                            id="star-{{ $book->id }}-{{ $i }}"
                                            onmouseover="hoverStars({{ $book->id }}, {{ $i }})"
                                            onmouseout="resetStars({{ $book->id }})"
                                            onclick="selectRating({{ $book->id }}, {{ $i }})"></i>
                                    @endfor
                                </div>
                                <textarea id="review-{{ $book->id }}" class="rating-textarea" rows="3" placeholder="Tulis pengalaman membaca buku ini..."></textarea>
                                <button onclick="submitRatingWithReview({{ $book->id }})" class="btn-submit-rate">
                                    <i class="fas fa-paper-plane" style="margin-right:4px;"></i> Kirim Ulasan
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-inbox"></i></div>
            <p>Belum ada buku di katalog</p>
        </div>
        @endforelse
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

function filterBooks(q) {
    q = q.toLowerCase().trim();
    document.querySelectorAll('#booksGrid .book-card').forEach(function (card) {
        var title  = card.dataset.title  || '';
        var author = card.dataset.author || '';
        card.style.display = (q === '' || title.includes(q) || author.includes(q)) ? '' : 'none';
    });
}

function toggleRating(e, bookId) {
    e.preventDefault(); e.stopPropagation();
    var dropdown = document.getElementById('rating-' + bookId);
    document.querySelectorAll('[id^="rating-"]:not([id^="rating-btn"])').forEach(function (el) {
        if (el !== dropdown) el.classList.add('hidden');
    });
    dropdown.classList.toggle('hidden');
}

function hoverStars(bookId, rating) {
    for (var i = 1; i <= 5; i++) {
        var star = document.getElementById('star-' + bookId + '-' + i);
        if (star) star.style.color = i <= rating ? '#F59E0B' : '#E5E7EB';
    }
}

var selectedRatings = {};

function resetStars(bookId) {
    var selected = selectedRatings[bookId] || 0;
    for (var i = 1; i <= 5; i++) {
        var star = document.getElementById('star-' + bookId + '-' + i);
        if (star) star.style.color = i <= selected ? '#F59E0B' : '#E5E7EB';
    }
}

function selectRating(bookId, rating) {
    selectedRatings[bookId] = rating;
    resetStars(bookId);
}

function submitRatingWithReview(bookId) {
    var rating = selectedRatings[bookId];
    var ulasan = document.getElementById('review-' + bookId).value;
    if (!rating) { alert('Pilih bintang rating terlebih dahulu.'); return; }
    fetch('/user/rating/' + bookId, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ rating: rating, ulasan: ulasan })
    })
    .then(function (res) { return res.json(); })
    .then(function (data) { if (data.success) location.reload(); });
}

document.addEventListener('click', function (e) {
    if (!e.target.closest('[onclick]') && !e.target.closest('[id^="rating-"]')) {
        document.querySelectorAll('[id^="rating-"]:not([id^="rating-btn"])').forEach(function (el) {
            el.classList.add('hidden');
        });
    }
});

function handleFavorite(form) {
    var btn   = form.querySelector('button');
    var icon  = btn.querySelector('i');
    var isFav = form.dataset.favorited === '1';
    if (!isFav) {
        btn.classList.add('active');
        icon.className = 'fas fa-heart';
        icon.style.color = 'var(--rose)';
        btn.lastChild.textContent = ' Batal';
    } else {
        btn.classList.remove('active');
        icon.className = 'far fa-heart';
        btn.lastChild.textContent = ' Favorit';
    }
}
</script>
</body>
</html>
