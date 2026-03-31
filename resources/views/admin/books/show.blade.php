<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Buku | Admin</title>
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
        .d1 { animation-delay: .05s; }
        .d2 { animation-delay: .12s; }
        .d3 { animation-delay: .19s; }
        .d4 { animation-delay: .26s; }
        .d5 { animation-delay: .33s; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sb-w); background: #fff;
            border-right: 1px solid var(--gray-200);
            display: flex; flex-direction: column;
            position: sticky; top: 0; height: 100vh;
            flex-shrink: 0; z-index: 100;
        }
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

        /* ── TOPBAR (mobile) ── */
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
            .book-layout { grid-template-columns: 1fr !important; }
            .info-grid   { grid-template-columns: 1fr 1fr !important; }
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
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 16px; overflow: hidden; }

        .card-hd { padding: 16px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .card-hd-title { font-size: 14px; font-weight: 700; }
        .card-hd-sub { font-size: 12px; color: var(--gray-400); margin-top: 2px; }

        /* ── BOOK LAYOUT ── */
        .book-layout {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 32px;
            padding: 28px 24px;
        }

        /* Cover */
        .cover-col { display: flex; flex-direction: column; align-items: center; gap: 14px; }
        .cover-wrap {
            width: 160px; height: 220px;
            border-radius: 12px; overflow: hidden;
            background: var(--red-bg);
            border: 1px solid var(--gray-200);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 28px rgba(0,0,0,.08);
            transition: transform .25s ease;
        }
        .cover-wrap:hover { transform: scale(1.02); }
        .cover-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .cover-placeholder { display: flex; flex-direction: column; align-items: center; gap: 8px; }
        .cover-placeholder i { font-size: 32px; color: rgba(220,38,38,.3); }
        .cover-placeholder span { font-size: 10px; color: var(--gray-400); font-weight: 600; text-transform: uppercase; letter-spacing: .05em; }

        .stock-badge { display: inline-flex; align-items: center; gap: 5px; padding: 5px 13px; border-radius: 999px; font-size: 12px; font-weight: 700; }
        .stock-ok    { background: var(--green-bg); color: var(--green); }
        .stock-low   { background: var(--amber-bg); color: var(--amber); }
        .stock-empty { background: var(--red-sf);   color: var(--red); }

        .isbn-pill {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 11px; border-radius: 7px;
            background: var(--violet-bg); color: var(--violet);
            font-family: 'Courier New', monospace;
            font-size: 11px; font-weight: 700;
        }

        /* Info column */
        .book-info { display: flex; flex-direction: column; gap: 20px; }

        .book-label { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--gray-400); margin-bottom: 5px; }
        .book-title { font-size: 22px; font-weight: 800; color: var(--gray-900); line-height: 1.25; letter-spacing: -.02em; }

        .pills-row { display: flex; flex-wrap: wrap; gap: 7px; }
        .pill { display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 700; }
        .pill-sky   { background: var(--sky-bg);   color: var(--sky); }
        .pill-muted { background: var(--gray-100); color: var(--gray-500); }

        .desc-box { background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 12px; padding: 16px 18px; }
        .desc-label { display: flex; align-items: center; gap: 7px; font-size: 11px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .07em; margin-bottom: 9px; }
        .desc-label i { color: var(--red); font-size: 11px; }
        .desc-text { font-size: 13.5px; color: var(--gray-700); line-height: 1.75; }
        .desc-empty { font-size: 13px; color: var(--gray-300); font-style: italic; display: flex; align-items: center; gap: 6px; }

        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 9px; }
        .info-tile {
            display: flex; align-items: center; gap: 11px;
            padding: 13px 15px; border-radius: 11px;
            background: var(--gray-50); border: 1px solid var(--gray-100);
            transition: border-color .15s;
        }
        .info-tile:hover { border-color: var(--gray-200); }
        .info-tile-icon { width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 13px; }
        .info-tile-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--gray-400); margin-bottom: 2px; }
        .info-tile-value { font-size: 13.5px; font-weight: 800; color: var(--gray-900); }

        .timestamps { display: flex; gap: 8px; flex-wrap: wrap; }
        .ts-chip { display: flex; align-items: center; gap: 7px; padding: 7px 13px; border-radius: 9px; background: var(--gray-50); border: 1px solid var(--gray-100); font-size: 12px; }
        .ts-chip i { color: var(--gray-300); font-size: 10px; }
        .ts-chip strong { font-weight: 700; color: var(--gray-700); margin-right: 3px; }
        .ts-chip span { color: var(--gray-400); }

        /* Card footer */
        .card-footer { padding: 16px 22px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; align-items: center; gap: 9px; flex-wrap: wrap; }

        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 20px; border-radius: 9px; font-size: 13px; font-weight: 700; border: none; cursor: pointer; text-decoration: none; transition: transform .2s ease, box-shadow .2s ease; }
        .btn:hover { transform: translateY(-1px); }

        .btn-edit { background: var(--amber); color: #fff; box-shadow: 0 3px 12px rgba(217,119,6,.25); }
        .btn-edit:hover { background: #B45309; box-shadow: 0 6px 18px rgba(217,119,6,.35); }

        .btn-back { background: #fff; color: var(--gray-700); border: 1.5px solid var(--gray-200); }
        .btn-back:hover { background: var(--gray-50); }

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
        <a href="{{ route('admin.dashboard') }}" class="sb-link"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('admin.users') }}" class="sb-link"><i class="fas fa-users"></i> Manajemen User</a>
        <a href="{{ route('admin.books.index') }}" class="sb-link active"><i class="fas fa-book"></i> Data Buku</a>
        <a href="{{ route('admin.categories.index') }}" class="sb-link"><i class="fas fa-tags"></i> Kategori Buku</a>
        <div class="sb-group">Aktivitas</div>
        <a href="{{ route('admin.borrowings.index') }}" class="sb-link"><i class="fas fa-handshake"></i> Riwayat Peminjaman</a>
        <a href="{{ route('admin.ratings.index') }}" class="sb-link"><i class="fas fa-star"></i> Ulasan Buku</a>
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
    <button class="mob-ham" id="hamBtn" aria-label="Buka menu">
        <span></span><span></span><span></span>
    </button>
</div>

{{-- MAIN --}}
<main>

    <div class="breadcrumb">
        <a href="{{ route('admin.books.index') }}"><i class="fas fa-book"></i> Data Buku</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Detail Buku</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Admin Panel</div>
        <h1 class="ph-title">Detail <span>Buku</span></h1>
        <p class="ph-desc">Informasi lengkap tentang buku dalam koleksi</p>
    </div>

    <div class="card au d2">

        <div class="card-hd">
            <div class="card-hd-icon" style="background:var(--sky-bg);">
                <i class="fas fa-book-open" style="color:var(--sky);"></i>
            </div>
            <div>
                <div class="card-hd-title">Informasi Buku</div>
                <div class="card-hd-sub">ID: <span style="font-family:'Courier New',monospace;color:var(--red-dk);font-weight:700;">#{{ $book->id }}</span></div>
            </div>
        </div>

        <div class="book-layout">

            {{-- Cover Column --}}
            <div class="cover-col au d3">
                <div class="cover-wrap">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}">
                    @else
                        <div class="cover-placeholder">
                            <i class="fas fa-book"></i>
                            <span>No Cover</span>
                        </div>
                    @endif
                </div>

                @php $stok = $book->stok; @endphp
                @if($stok > 5)
                    <span class="stock-badge stock-ok"><i class="fas fa-check-circle" style="font-size:10px;"></i> {{ $stok }} Unit</span>
                @elseif($stok > 0)
                    <span class="stock-badge stock-low"><i class="fas fa-exclamation-triangle" style="font-size:10px;"></i> {{ $stok }} Unit</span>
                @else
                    <span class="stock-badge stock-empty"><i class="fas fa-times-circle" style="font-size:10px;"></i> Habis</span>
                @endif

                <span class="isbn-pill">
                    <i class="fas fa-barcode" style="font-size:9px;"></i>
                    {{ $book->kode_buku }}
                </span>
            </div>

            {{-- Info Column --}}
            <div class="book-info au d4">

                <div>
                    <div class="book-label">Judul Buku</div>
                    <div class="book-title">{{ $book->judul }}</div>
                </div>

                <div class="pills-row">
                    @if($book->category)
                        <span class="pill pill-sky"><i class="fas fa-tag" style="font-size:9px;"></i> {{ $book->category->nama }}</span>
                    @else
                        <span class="pill pill-muted"><i class="fas fa-exclamation-circle" style="font-size:9px;"></i> Tanpa Kategori</span>
                    @endif
                </div>

                <div class="desc-box">
                    <div class="desc-label"><i class="fas fa-align-left"></i> Deskripsi Buku</div>
                    @if($book->deskripsi)
                        <p class="desc-text">{{ $book->deskripsi }}</p>
                    @else
                        <div class="desc-empty"><i class="fas fa-info-circle"></i> Tidak ada deskripsi untuk buku ini.</div>
                    @endif
                </div>

                <div class="info-grid">
                    <div class="info-tile">
                        <div class="info-tile-icon" style="background:var(--amber-bg);"><i class="fas fa-user-edit" style="color:var(--amber);"></i></div>
                        <div>
                            <div class="info-tile-label">Penulis</div>
                            <div class="info-tile-value">{{ $book->penulis }}</div>
                        </div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-icon" style="background:var(--gray-100);"><i class="fas fa-building" style="color:var(--gray-500);"></i></div>
                        <div>
                            <div class="info-tile-label">Penerbit</div>
                            <div class="info-tile-value">{{ $book->penerbit }}</div>
                        </div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-icon" style="background:var(--amber-bg);"><i class="fas fa-calendar" style="color:var(--amber);"></i></div>
                        <div>
                            <div class="info-tile-label">Tahun Terbit</div>
                            <div class="info-tile-value">{{ $book->tahun }}</div>
                        </div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-icon" style="background:var(--green-bg);"><i class="fas fa-layer-group" style="color:var(--green);"></i></div>
                        <div>
                            <div class="info-tile-label">Stok Tersedia</div>
                            <div class="info-tile-value">{{ $book->stok }} Unit</div>
                        </div>
                    </div>
                </div>

                <div class="timestamps">
                    <div class="ts-chip">
                        <i class="fas fa-plus-circle"></i>
                        <div><strong>Ditambahkan</strong><span>{{ $book->created_at->format('d M Y') }}</span></div>
                    </div>
                    <div class="ts-chip">
                        <i class="fas fa-sync-alt"></i>
                        <div><strong>Diperbarui</strong><span>{{ $book->updated_at->format('d M Y') }}</span></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-edit">
                <i class="fas fa-pen"></i> Edit Buku
            </a>
            <a href="{{ route('admin.books.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
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
