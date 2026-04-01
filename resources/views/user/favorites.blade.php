<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Favorit | PerpusInd</title>
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
            --rose:      #E11D48;
            --rose-bg:   #FFE4E6;
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
        .hero-count { position: absolute; top: 14px; right: 14px; z-index: 2; background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.2); padding: 5px 12px; border-radius: 9px; font-size: 11.5px; font-weight: 600; color: rgba(255,255,255,.85); display: flex; align-items: center; gap: 6px; }
        .hero-badge { display: inline-flex; align-items: center; gap: 5px; background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.2); padding: 3px 11px; border-radius: 999px; font-size: 11px; font-weight: 600; color: rgba(255,255,255,.85); letter-spacing: .04em; margin-bottom: 10px; }
        .hero-ph-label { font-size: 11px; font-weight: 600; color: rgba(255,220,220,.75); letter-spacing: .07em; text-transform: uppercase; margin-bottom: 5px; }
        .hero-title { font-size: 22px; font-weight: 800; color: #fff; line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; }
        .hero-sub { font-size: 12.5px; color: rgba(255,220,220,.75); }
        .hero-illus { position: relative; z-index: 1; flex-shrink: 0; }
        .hero-icon-wrap { width: 78px; height: 78px; border-radius: 20px; background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.18); display: flex; align-items: center; justify-content: center; }
        .hero-icon-wrap i { font-size: 32px; color: rgba(255,220,220,.85); }

        /* ── SECTION HEADER ── */
        .sec-hd { margin-bottom: 18px; }
        .sec-title { font-size: 16px; font-weight: 800; color: var(--gray-900); display: flex; align-items: center; gap: 8px; margin-bottom: 3px; }
        .sec-count { display: inline-flex; align-items: center; gap: 4px; padding: 2px 9px; border-radius: 999px; background: var(--rose-bg); color: var(--rose); font-size: 11px; font-weight: 700; }
        .sec-sub { font-size: 12.5px; color: var(--gray-400); }

        /* ── EMPTY STATE ── */
        .empty-wrap { background: #fff; border-radius: 14px; border: 1.5px solid var(--gray-200); padding: 72px 40px; text-align: center; }
        .empty-icon-wrap { width: 72px; height: 72px; border-radius: 20px; background: var(--rose-bg); display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; }
        .empty-icon-wrap i { font-size: 30px; color: var(--rose); }
        .empty-title { font-size: 20px; font-weight: 800; color: var(--gray-900); margin-bottom: 7px; letter-spacing: -.02em; }
        .empty-sub { font-size: 13.5px; color: var(--gray-400); margin-bottom: 24px; line-height: 1.6; }
        .btn-explore { display: inline-flex; align-items: center; gap: 7px; padding: 10px 22px; background: var(--red); color: #fff; border: none; border-radius: 9px; font-size: 13px; font-weight: 700; cursor: pointer; text-decoration: none; transition: background .15s, transform .15s; }
        .btn-explore:hover { background: var(--red-dk); transform: translateY(-1px); }

        /* ── BOOKS GRID ── */
        .books-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
        @media (max-width: 1100px) { .books-grid { grid-template-columns: 1fr 1fr; } }

        /* ── BOOK CARD ── */
        .book-card { background: #fff; border-radius: 13px; border: 1.5px solid var(--gray-200); overflow: hidden; display: flex; flex-direction: column; transition: transform .2s, box-shadow .2s, border-color .2s; animation: fadeUp .5s ease both; }
        .book-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.08); border-color: #fda4af; }
        .book-card:hover .bc-cover-img { transform: scale(1.05); }

        .bc-cover { height: 180px; position: relative; overflow: hidden; background: #fff1f2; display: flex; align-items: center; justify-content: center; }
        .bc-cover-img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s ease; display: block; }
        .bc-cover-placeholder { font-size: 48px; color: #fda4af; }

        .stock-badge { position: absolute; top: 10px; right: 10px; display: flex; align-items: center; gap: 5px; padding: 3px 9px; border-radius: 999px; font-size: 10.5px; font-weight: 600; background: rgba(255,255,255,.92); border: 1px solid; white-space: nowrap; }
        .stock-badge.available { color: var(--green); border-color: rgba(22,163,74,.2); }
        .stock-badge.empty     { color: var(--red);   border-color: rgba(220,38,38,.2); }
        .pulse-dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
        .pulse-dot.green { background: var(--green); animation: pulse 1.5s infinite; }
        .pulse-dot.red   { background: var(--red); }

        .bc-cat-badge { position: absolute; bottom: 9px; left: 10px; padding: 2px 9px; border-radius: 999px; font-size: 10px; font-weight: 700; background: rgba(255,255,255,.9); color: var(--indigo); border: 1px solid rgba(79,70,229,.15); white-space: nowrap; }
        .bc-heart-badge { position: absolute; top: 10px; left: 10px; width: 26px; height: 26px; border-radius: 50%; background: rgba(255,255,255,.92); display: flex; align-items: center; justify-content: center; }
        .bc-heart-badge i { font-size: 11px; color: var(--rose); }

        .bc-body { padding: 16px; flex: 1; display: flex; flex-direction: column; }
        .bc-title { font-size: 14px; font-weight: 800; color: var(--gray-900); margin-bottom: 3px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.35; letter-spacing: -.01em; }
        .bc-author { font-size: 11.5px; color: var(--gray-400); font-weight: 500; margin-bottom: 9px; display: flex; align-items: center; gap: 5px; }
        .bc-author i { font-size: 10px; }
        .bc-meta { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .bc-meta span { font-size: 11px; color: var(--gray-400); display: flex; align-items: center; gap: 4px; }
        .bc-meta span i { font-size: 9px; }

        hr.bc-div { border: none; border-top: 1px solid var(--gray-100); margin: 12px 0; }

        .btn-remove { display: flex; align-items: center; justify-content: center; gap: 7px; width: 100%; padding: 9px 14px; background: var(--gray-50); color: var(--gray-500); border: 1.5px solid var(--gray-200); border-radius: 9px; font-size: 12.5px; font-weight: 700; cursor: pointer; transition: border-color .15s, background .15s, color .15s; margin-top: auto; }
        .btn-remove:hover { border-color: #fda4af; background: var(--rose-bg); color: var(--rose); }

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
        <span class="active">Buku Favorit</span>
    </div>

    {{-- HERO --}}
    <div class="hero au d1">
        @if(!$favorites->isEmpty())
        <div class="hero-count">
            <i class="fas fa-heart" style="color:rgba(255,180,180,.9); font-size:10px;"></i>
            {{ $favorites->count() }} buku favorit
        </div>
        @endif
        <div class="hero-inner">
            <div>
                <div class="hero-badge"><i class="fas fa-heart" style="font-size:9px;"></i> Koleksi Saya</div>
                <p class="hero-ph-label">Daftar Favorit</p>
                <h2 class="hero-title">Buku Favorit</h2>
                <p class="hero-sub">Koleksi buku favorit yang telah Anda simpan</p>
            </div>
            <div class="hero-illus">
                <div class="hero-icon-wrap">
                    <i class="fas fa-heart"></i>
                </div>
            </div>
        </div>
    </div>

    @if($favorites->isEmpty())

    {{-- EMPTY STATE --}}
    <div class="empty-wrap au d2">
        <div class="empty-icon-wrap">
            <i class="fas fa-heart-crack"></i>
        </div>
        <h3 class="empty-title">Belum Ada Buku Favorit</h3>
        <p class="empty-sub">Mulai tambahkan buku favoritmu dari katalog<br>perpustakaan digital kami</p>
        <a href="{{ route('user.books') }}" class="btn-explore">
            <i class="fas fa-book-open"></i> Jelajahi Katalog
        </a>
    </div>

    @else

    <div class="sec-hd au d2">
        <div class="sec-title">
            Favorit Saya
            <span class="sec-count"><i class="fas fa-heart" style="font-size:9px;"></i> {{ $favorites->count() }} buku</span>
        </div>
        <p class="sec-sub">Buku yang Anda tandai sebagai favorit</p>
    </div>

    <div class="books-grid">
        @foreach($favorites as $index => $fav)
        <div class="book-card" style="animation-delay:{{ min($index * 55, 500) }}ms">
            <div class="bc-cover">
                @if($fav->book->image)
                    <img class="bc-cover-img" src="{{ asset('storage/'.$fav->book->image) }}" alt="{{ $fav->book->judul }}">
                @else
                    <i class="fas fa-book-open bc-cover-placeholder"></i>
                @endif
                <div class="bc-heart-badge"><i class="fas fa-heart"></i></div>
                <div class="stock-badge {{ $fav->book->stok > 0 ? 'available' : 'empty' }}">
                    <span class="pulse-dot {{ $fav->book->stok > 0 ? 'green' : 'red' }}"></span>
                    {{ $fav->book->stok > 0 ? 'Tersedia' : 'Habis' }}
                </div>
                <div class="bc-cat-badge" data-kategori="{{ $fav->book->KategoriID }}">Umum</div>
            </div>
            <div class="bc-body">
                <h3 class="bc-title">{{ $fav->book->judul }}</h3>
                <p class="bc-author"><i class="fas fa-user-pen"></i> {{ $fav->book->penulis }}</p>
                <div class="bc-meta">
                    @if($fav->book->tahun)
                    <span><i class="fas fa-calendar"></i> {{ $fav->book->tahun }}</span>
                    @endif
                    <span><i class="fas fa-layer-group"></i> {{ $fav->book->stok }} stok</span>
                </div>
                <hr class="bc-div">
                <form method="POST" action="{{ route('user.favorite.destroy', $fav->book) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-remove">
                        <i class="fas fa-heart-crack"></i> Hapus dari Favorit
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
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

    var categoryMap = @json($categories->pluck('nama', 'id'));
    document.querySelectorAll('[data-kategori]').forEach(function (el) {
        var id = el.dataset.kategori;
        el.textContent = categoryMap[id] || 'Umum';
    });
})();
</script>
</body>
</html>
