<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Buku | PerpusInd</title>
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
            .detail-layout { grid-template-columns: 1fr !important; }
            .cover-wrap { width: 100%; max-width: 200px; margin: 0 auto; }
            .info-grid { grid-template-columns: 1fr !important; }
            .hd-actions { flex-wrap: wrap; }
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

        /* ── CARD ── */
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; max-width: 900px; }

        .card-hd { padding: 15px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .card-hd-left { display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .card-hd-title { font-size: 14px; font-weight: 700; }
        .card-hd-sub   { font-size: 11.5px; color: var(--gray-400); margin-top: 1px; }
        .id-badge { display: inline-flex; align-items: center; gap: 3px; padding: 2px 9px; border-radius: 999px; background: var(--gray-100); color: var(--gray-500); font-size: 11px; font-weight: 700; font-family: monospace; margin-left: 8px; }

        .card-body { padding: 24px; }

        /* Header actions */
        .hd-actions { display: flex; align-items: center; gap: 8px; }
        .btn-hd { display: inline-flex; align-items: center; gap: 6px; padding: 8px 15px; border-radius: 8px; font-size: 12.5px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; text-decoration: none; transition: background .12s, transform .12s; }
        .btn-hd:hover { transform: translateY(-1px); }
        .btn-edit { background: var(--amber-bg); color: var(--amber); }
        .btn-edit:hover { background: #fde68a; }
        .btn-back { background: var(--gray-100); color: var(--gray-700); border: 1.5px solid var(--gray-200); }
        .btn-back:hover { background: var(--gray-200); }

        /* ── DETAIL LAYOUT ── */
        .detail-layout { display: grid; grid-template-columns: 190px 1fr; gap: 28px; align-items: start; }

        .cover-wrap { width: 190px; aspect-ratio: 3/4; border-radius: 12px; overflow: hidden; background: var(--gray-100); border: 1.5px solid var(--gray-200); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .cover-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .cover-placeholder { text-align: center; padding: 20px; }
        .cover-placeholder i { font-size: 36px; color: var(--gray-300); display: block; margin-bottom: 8px; }
        .cover-placeholder p { font-size: 11.5px; color: var(--gray-400); font-style: italic; }

        .book-title { font-size: 20px; font-weight: 800; color: var(--gray-900); line-height: 1.3; margin-bottom: 14px; letter-spacing: -.02em; }

        /* Badge row */
        .badge-row { display: flex; flex-wrap: wrap; gap: 7px; margin-bottom: 20px; }
        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; }
        .badge i { font-size: 9px; }
        .badge-cat   { background: var(--sky-bg);    color: var(--sky);    border: 1px solid #bae6fd; }
        .badge-isbn  { background: var(--indigo-bg); color: var(--indigo); border: 1px solid #c7d2fe; font-family: 'Courier New', monospace; font-size: 11.5px; }
        .badge-nocat { background: var(--gray-100);  color: var(--gray-500); border: 1px solid var(--gray-200); }

        /* Description */
        .desc-label { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--gray-400); margin-bottom: 9px; display: flex; align-items: center; gap: 6px; }
        .desc-label i { color: var(--red); font-size: 10px; }
        .desc-box { background: var(--gray-50); border: 1.5px solid var(--gray-200); border-radius: 10px; padding: 14px 16px; font-size: 13px; line-height: 1.75; color: var(--gray-700); }
        .desc-empty { color: var(--gray-400); font-style: italic; }

        /* Info grid */
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 9px; margin-top: 18px; }
        .info-item { background: var(--gray-50); border: 1.5px solid var(--gray-200); border-radius: 10px; padding: 12px 14px; transition: border-color .15s; }
        .info-item:hover { border-color: var(--gray-300); }
        .info-item-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--gray-400); margin-bottom: 5px; display: flex; align-items: center; gap: 5px; }
        .info-item-label i { color: var(--red); font-size: 9px; }
        .info-item-value { font-size: 13.5px; font-weight: 700; color: var(--gray-900); }

        /* Stock pill */
        .stok-pill { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 999px; font-size: 12.5px; font-weight: 700; }
        .stok-ok  { background: var(--green-bg); color: var(--green); }
        .stok-low { background: var(--amber-bg); color: var(--amber); }
        .stok-out { background: var(--red-sf);   color: var(--red); }

        /* Flag stripe */
        .flag-stripe { display: flex; height: 4px; margin-top: 24px; max-width: 900px; }
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
        <a href="{{ url('petugas/books') }}"><i class="fas fa-book"></i> Kelola Buku</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Detail Buku</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Petugas Panel</div>
        <h1 class="ph-title">Detail <span>Buku</span></h1>
        <p class="ph-desc">Informasi lengkap koleksi perpustakaan</p>
    </div>

    <div class="card au d2">
        <div class="card-hd">
            <div class="card-hd-left">
                <div class="card-hd-icon" style="background:var(--sky-bg);">
                    <i class="fas fa-book-open" style="color:var(--sky);"></i>
                </div>
                <div>
                    <div style="display:flex; align-items:center;">
                        <span class="card-hd-title">Informasi Buku</span>
                        <span class="id-badge"><i class="fas fa-hashtag" style="font-size:9px;"></i> {{ $book->id }}</span>
                    </div>
                    <div class="card-hd-sub">Data lengkap koleksi perpustakaan</div>
                </div>
            </div>
            <div class="hd-actions">
                <a href="{{ route('petugas.books.edit', $book->id) }}" class="btn-hd btn-edit">
                    <i class="fas fa-pen"></i> Edit Buku
                </a>
                <a href="{{ url('petugas/books') }}" class="btn-hd btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="detail-layout">

                {{-- Cover --}}
                <div class="cover-wrap au d3">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}">
                    @else
                        <div class="cover-placeholder">
                            <i class="fas fa-book"></i>
                            <p>Tidak ada cover</p>
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="au d3">
                    <div class="book-title">{{ $book->judul }}</div>

                    <div class="badge-row">
                        @if($book->category)
                            <span class="badge badge-cat"><i class="fas fa-tag"></i> {{ $book->category->nama }}</span>
                        @else
                            <span class="badge badge-nocat"><i class="fas fa-exclamation-circle"></i> Tidak ada kategori</span>
                        @endif
                        <span class="badge badge-isbn"><i class="fas fa-barcode"></i> {{ $book->kode_buku }}</span>
                    </div>

                    <div class="desc-label"><i class="fas fa-align-left"></i> Deskripsi Buku</div>
                    <div class="desc-box">
                        @if($book->deskripsi)
                            {{ $book->deskripsi }}
                        @else
                            <span class="desc-empty">Tidak ada deskripsi buku.</span>
                        @endif
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-item-label"><i class="fas fa-user-edit"></i> Penulis</div>
                            <div class="info-item-value">{{ $book->penulis }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label"><i class="fas fa-building"></i> Penerbit</div>
                            <div class="info-item-value">{{ $book->penerbit }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label"><i class="fas fa-calendar"></i> Tahun Terbit</div>
                            <div class="info-item-value">{{ $book->tahun }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label"><i class="fas fa-layer-group"></i> Stok Tersedia</div>
                            <div class="info-item-value">
                                @php $stok = (int) $book->stok; @endphp
                                @if($stok > 5)
                                    <span class="stok-pill stok-ok"><i class="fas fa-check-circle" style="font-size:10px;"></i> {{ $stok }} Unit</span>
                                @elseif($stok > 0)
                                    <span class="stok-pill stok-low"><i class="fas fa-exclamation-triangle" style="font-size:10px;"></i> {{ $stok }} Unit</span>
                                @else
                                    <span class="stok-pill stok-out"><i class="fas fa-times-circle" style="font-size:10px;"></i> Habis</span>
                                @endif
                            </div>
                        </div>
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
