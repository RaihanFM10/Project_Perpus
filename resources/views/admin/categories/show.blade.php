<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kategori | Admin</title>
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
            .stats-strip { grid-template-columns: 1fr 1fr !important; }
            .ir-label { width: 120px !important; }
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
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 16px; overflow: hidden; max-width: 600px; }

        /* Banner */
        .card-banner {
            background: var(--red);
            padding: 24px 24px;
            display: flex; align-items: center; gap: 18px;
            position: relative; overflow: hidden;
        }
        .banner-icon-box {
            width: 54px; height: 54px; border-radius: 14px; flex-shrink: 0;
            background: rgba(255,255,255,.2); border: 2px solid rgba(255,255,255,.3);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 16px rgba(0,0,0,.15); position: relative; z-index: 1;
        }
        .banner-icon-box i { font-size: 22px; color: #fff; }
        .banner-text { position: relative; z-index: 1; min-width: 0; }
        .banner-eyebrow { font-size: 10px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: rgba(255,255,255,.6); margin-bottom: 4px; }
        .banner-name { font-size: 19px; font-weight: 800; color: #fff; line-height: 1.2; word-break: break-word; margin-bottom: 7px; }
        .banner-slug {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 11px; border-radius: 999px;
            background: rgba(255,255,255,.18); border: 1px solid rgba(255,255,255,.28);
            font-family: 'Courier New', monospace;
            font-size: 11px; font-weight: 700; color: rgba(255,255,255,.9); letter-spacing: .03em;
        }

        /* Stats strip */
        .stats-strip { display: grid; grid-template-columns: repeat(2, 1fr); border-bottom: 1px solid var(--gray-100); }
        .stat-cell { padding: 13px 16px; display: flex; align-items: center; gap: 10px; border-right: 1px solid var(--gray-100); }
        .stat-cell:last-child { border-right: none; }
        .stat-cell-icon { width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 12px; }
        .stat-cell-val { font-size: 14px; font-weight: 800; color: var(--gray-900); line-height: 1.1; }
        .stat-cell-lbl { font-size: 10px; font-weight: 600; color: var(--gray-400); text-transform: uppercase; letter-spacing: .04em; margin-top: 2px; }

        /* Info rows */
        .info-row { display: flex; align-items: center; border-bottom: 1px solid var(--gray-100); transition: background .12s; }
        .info-row:last-of-type { border-bottom: none; }
        .info-row:hover { background: var(--red-bg); }

        .ir-icon { width: 48px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; padding: 14px 0; }
        .ir-icon-box { width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 12px; }
        .ir-label { width: 136px; flex-shrink: 0; font-size: 10.5px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .05em; padding: 14px 12px 14px 0; border-right: 1px solid var(--gray-100); }
        .ir-value { flex: 1; padding: 14px 18px; font-size: 13px; font-weight: 600; color: var(--gray-900); display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }

        .slug-pill {
            display: inline-flex; align-items: center; gap: 5px;
            font-family: 'Courier New', monospace; font-size: 12px; font-weight: 700;
            background: var(--violet-bg); color: var(--violet);
            border: 1px solid rgba(124,58,237,.18); padding: 3px 10px; border-radius: 7px;
        }
        .time-chip {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 11px; font-weight: 600; color: var(--gray-400);
            background: var(--gray-100); border: 1px solid var(--gray-200);
            padding: 3px 8px; border-radius: 6px;
        }

        /* Footer */
        .card-footer { padding: 16px 22px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; align-items: center; gap: 9px; flex-wrap: wrap; }

        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 20px; border-radius: 9px; font-size: 13px; font-weight: 700; border: none; cursor: pointer; text-decoration: none; transition: transform .2s ease, box-shadow .2s ease; }
        .btn:hover { transform: translateY(-1px); }
        .btn-edit { background: var(--amber); color: #fff; box-shadow: 0 3px 12px rgba(217,119,6,.3); }
        .btn-edit:hover { background: #B45309; box-shadow: 0 6px 18px rgba(217,119,6,.4); }
        .btn-back { background: #fff; color: var(--gray-700); border: 1.5px solid var(--gray-200); }
        .btn-back:hover { background: var(--gray-50); }

        /* Flag stripe */
        .flag-stripe { display: flex; height: 4px; margin-top: 24px; max-width: 600px; }
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
        <a href="{{ url('/admin/books') }}" class="sb-link"><i class="fas fa-book"></i> Data Buku</a>
        <a href="{{ route('admin.categories.index') }}" class="sb-link active"><i class="fas fa-tags"></i> Kategori Buku</a>
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
    <button class="mob-ham" id="hamBtn" aria-label="Buka menu"><span></span><span></span><span></span></button>
</div>

{{-- MAIN --}}
<main>

    <div class="breadcrumb">
        <a href="{{ route('admin.categories.index') }}"><i class="fas fa-tags"></i> Kategori Buku</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Detail Kategori</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Admin Panel</div>
        <h1 class="ph-title">Detail <span>Kategori</span></h1>
        <p class="ph-desc">Informasi lengkap kategori buku perpustakaan</p>
    </div>

    <div class="card au d2">

        {{-- Banner --}}
        <div class="card-banner">
            <div class="banner-icon-box"><i class="fas fa-tag"></i></div>
            <div class="banner-text">
                <div class="banner-eyebrow">Kategori Buku</div>
                <div class="banner-name">{{ $category->nama }}</div>
                <div class="banner-slug">
                    <i class="fas fa-link" style="font-size:9px;"></i>
                    {{ $category->slug }}
                </div>
            </div>
        </div>

        {{-- Stats strip --}}
        <div class="stats-strip">
            <div class="stat-cell">
                <div class="stat-cell-icon" style="background:var(--red-bg);">
                    <i class="fas fa-hashtag" style="color:var(--red);"></i>
                </div>
                <div>
                    <div class="stat-cell-val" style="font-family:'Courier New',monospace;color:var(--red-dk);font-size:13px;">#{{ $category->id }}</div>
                    <div class="stat-cell-lbl">ID Kategori</div>
                </div>
            </div>
            <div class="stat-cell">
                <div class="stat-cell-icon" style="background:var(--green-bg);">
                    <i class="fas fa-check-circle" style="color:var(--green);"></i>
                </div>
                <div>
                    <div class="stat-cell-val" style="color:var(--green);font-size:13px;">Aktif</div>
                    <div class="stat-cell-lbl">Status</div>
                </div>
            </div>
        </div>

        {{-- Info rows --}}
        <div class="info-row">
            <div class="ir-icon"><div class="ir-icon-box" style="background:var(--red-bg);"><i class="fas fa-tag" style="color:var(--red);"></i></div></div>
            <div class="ir-label">Nama</div>
            <div class="ir-value">{{ $category->nama }}</div>
        </div>

        <div class="info-row">
            <div class="ir-icon"><div class="ir-icon-box" style="background:var(--violet-bg);"><i class="fas fa-link" style="color:var(--violet);"></i></div></div>
            <div class="ir-label">Slug</div>
            <div class="ir-value">
                <span class="slug-pill"><i class="fas fa-link" style="font-size:9px;"></i>{{ $category->slug }}</span>
            </div>
        </div>

        <div class="info-row">
            <div class="ir-icon"><div class="ir-icon-box" style="background:var(--green-bg);"><i class="fas fa-calendar-plus" style="color:var(--green);"></i></div></div>
            <div class="ir-label">Dibuat</div>
            <div class="ir-value">
                {{ $category->created_at->format('d M Y') }}
                <span class="time-chip"><i class="fas fa-clock" style="font-size:9px;"></i>{{ $category->created_at->format('H:i') }} WIB</span>
            </div>
        </div>

        <div class="info-row">
            <div class="ir-icon"><div class="ir-icon-box" style="background:var(--amber-bg);"><i class="fas fa-sync-alt" style="color:var(--amber);"></i></div></div>
            <div class="ir-label">Diperbarui</div>
            <div class="ir-value">
                {{ $category->updated_at->format('d M Y') }}
                <span class="time-chip"><i class="fas fa-clock" style="font-size:9px;"></i>{{ $category->updated_at->format('H:i') }} WIB</span>
            </div>
        </div>

        {{-- Footer --}}
        <div class="card-footer">
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-edit">
                <i class="fas fa-pen"></i> Edit Kategori
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-back">
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
