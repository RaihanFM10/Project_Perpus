<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Ulasan | Admin</title>
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
            .review-layout { grid-template-columns: 1fr !important; }
            .info-grid { grid-template-columns: 1fr 1fr !important; }
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
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; }
        .card-hd { padding: 16px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .card-hd-title { font-size: 14px; font-weight: 700; }
        .card-hd-sub { font-size: 12px; color: var(--gray-400); margin-top: 2px; }

        /* ── REVIEW LAYOUT ── */
        .review-layout { display: grid; grid-template-columns: 200px 1fr; gap: 28px; padding: 24px 22px; }

        /* LEFT COL */
        .left-col { display: flex; flex-direction: column; align-items: center; gap: 12px; }

        .avatar-frame {
            width: 120px; height: 120px; border-radius: 50%;
            background: var(--red);
            display: flex; align-items: center; justify-content: center;
            font-size: 44px; font-weight: 800; color: #fff;
            border: 3px solid #fff; box-shadow: 0 4px 20px rgba(220,38,38,.2);
        }

        .user-name-c  { font-size: 13.5px; font-weight: 800; color: var(--gray-900); text-align: center; }
        .user-email-c { font-size: 11px; color: var(--gray-400); text-align: center; margin-top: -5px; }

        .rating-block { width: 100%; display: flex; flex-direction: column; align-items: center; gap: 7px; padding: 14px 10px; border-radius: 12px; background: var(--amber-bg); border: 1px solid rgba(217,119,6,.2); }
        .rating-big { font-size: 40px; font-weight: 800; color: var(--gray-900); line-height: 1; }
        .rating-big span { font-size: 16px; font-weight: 500; color: var(--gray-400); }
        .stars-big { display: flex; gap: 3px; }
        .stars-big i { font-size: 15px; }
        .sf { color: #f59e0b; }
        .se { color: var(--gray-200); }

        .rating-pill { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 999px; font-size: 11.5px; font-weight: 700; }
        .star-5 { background: var(--amber-bg); color: var(--amber); }
        .star-4 { background: #fefce8; color: #a16207; }
        .star-3 { background: var(--green-bg); color: var(--green); }
        .star-2 { background: #fff7ed; color: #9a3412; }
        .star-1 { background: var(--red-sf); color: var(--red); }

        /* RIGHT COL */
        .right-col { display: flex; flex-direction: column; gap: 18px; }

        .section-label { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--gray-400); margin-bottom: 6px; }

        .pills-row { display: flex; flex-wrap: wrap; gap: 8px; }
        .pill { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 8px; font-size: 12.5px; font-weight: 700; border: 1px solid; }
        .pill-red    { background: var(--red-bg);    color: var(--red-dk);  border-color: var(--red-sf); }
        .pill-violet { background: var(--violet-bg); color: var(--violet);  border-color: rgba(124,58,237,.2); }

        .review-box { background: var(--gray-50); border: 1px solid var(--gray-200); border-radius: 12px; padding: 14px 16px; }
        .review-box-label { display: flex; align-items: center; gap: 6px; font-size: 10.5px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .05em; margin-bottom: 9px; }
        .review-box-label i { color: var(--amber); }
        .review-text  { font-size: 13px; color: var(--gray-700); line-height: 1.7; }
        .review-empty { display: flex; align-items: center; gap: 6px; font-size: 12.5px; color: var(--gray-300); font-style: italic; }

        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 9px; }
        .info-tile { padding: 12px 14px; background: var(--gray-50); border: 1px solid var(--gray-200); border-radius: 10px; transition: box-shadow .15s; }
        .info-tile:hover { box-shadow: 0 2px 8px rgba(0,0,0,.06); }
        .info-tile-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--gray-400); margin-bottom: 4px; display: flex; align-items: center; gap: 5px; }
        .info-tile-value { font-size: 13.5px; font-weight: 800; color: var(--gray-900); }

        /* Footer */
        .card-footer { padding: 16px 22px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; align-items: center; gap: 9px; flex-wrap: wrap; }

        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 9px; font-size: 13px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; text-decoration: none; transition: transform .2s ease; }
        .btn:hover { transform: translateY(-1px); }
        .btn-edit   { background: var(--amber-bg); color: var(--amber); }
        .btn-edit:hover { background: #fde68a; }
        .btn-back   { background: #fff; color: var(--gray-700); border: 1.5px solid var(--gray-200); }
        .btn-back:hover { background: var(--gray-50); }
        .btn-delete { background: var(--red-sf); color: var(--red); border: 1.5px solid #fecaca; margin-left: auto; }
        .btn-delete:hover { background: #fecaca; }

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
        <a href="{{ route('admin.ratings.index') }}"><i class="fas fa-star"></i> Ulasan Buku</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Detail Ulasan</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Admin Panel</div>
        <h1 class="ph-title">Detail <span>Ulasan</span></h1>
        <p class="ph-desc">Informasi lengkap ulasan pengguna perpustakaan</p>
    </div>

    <div class="card au d2">

        <div class="card-hd">
            <div class="card-hd-icon" style="background:var(--amber-bg);">
                <i class="fas fa-star" style="color:var(--amber);"></i>
            </div>
            <div>
                <div class="card-hd-title">Informasi Ulasan</div>
                <div class="card-hd-sub">ID: <span style="font-family:'Courier New',monospace;color:var(--red-dk);font-weight:700;">#{{ $rating->id }}</span></div>
            </div>
        </div>

        <div class="review-layout">

            {{-- LEFT: Avatar + Rating --}}
            <div class="left-col">
                <div class="avatar-frame">
                    {{ strtoupper(substr($rating->user->name ?? 'U', 0, 1)) }}
                </div>
                <div class="user-name-c">{{ $rating->user->name ?? '-' }}</div>
                @if(isset($rating->user->email))
                    <div class="user-email-c">{{ $rating->user->email }}</div>
                @endif

                @php $r = (int) $rating->rating; @endphp
                <div class="rating-block">
                    <div class="rating-big">{{ $rating->rating }}<span>/5</span></div>
                    <div class="stars-big">
                        @for($s = 1; $s <= 5; $s++)
                            <i class="fas fa-star {{ $s <= $r ? 'sf' : 'se' }}"></i>
                        @endfor
                    </div>
                    <span class="rating-pill star-{{ $r }}">
                        <i class="fas fa-star" style="font-size:9px;"></i>
                        @if($r == 5) Luar Biasa
                        @elseif($r == 4) Sangat Bagus
                        @elseif($r == 3) Cukup Baik
                        @elseif($r == 2) Kurang Baik
                        @else Buruk
                        @endif
                    </span>
                </div>
            </div>

            {{-- RIGHT: Info --}}
            <div class="right-col">

                <div>
                    <div class="section-label">Buku yang Diulas</div>
                    <div class="pills-row">
                        <span class="pill pill-red"><i class="fas fa-book"></i> {{ $rating->book->judul ?? '-' }}</span>
                        @if(isset($rating->book->category))
                            <span class="pill pill-violet"><i class="fas fa-tag"></i> {{ $rating->book->category->nama }}</span>
                        @endif
                    </div>
                </div>

                <div class="review-box">
                    <div class="review-box-label"><i class="fas fa-align-left"></i> Teks Ulasan</div>
                    @if($rating->ulasan)
                        <p class="review-text">{{ $rating->ulasan }}</p>
                    @else
                        <div class="review-empty"><i class="fas fa-info-circle"></i> Pengguna tidak menulis ulasan</div>
                    @endif
                </div>

                <div class="info-grid">
                    <div class="info-tile">
                        <div class="info-tile-label"><i class="fas fa-calendar-plus" style="color:var(--green);"></i> Tanggal</div>
                        <div class="info-tile-value">{{ $rating->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-label"><i class="fas fa-clock" style="color:var(--amber);"></i> Jam</div>
                        <div class="info-tile-value">{{ $rating->created_at->format('H:i') }} WIB</div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-label"><i class="fas fa-user" style="color:var(--red);"></i> ID Pengguna</div>
                        <div class="info-tile-value" style="font-family:'Courier New',monospace;color:var(--red-dk);">#{{ $rating->user->id ?? '-' }}</div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-label"><i class="fas fa-book" style="color:var(--violet);"></i> ID Buku</div>
                        <div class="info-tile-value" style="font-family:'Courier New',monospace;color:var(--violet);">#{{ $rating->book->id ?? '-' }}</div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.ratings.edit', $rating->id) }}" class="btn btn-edit">
                <i class="fas fa-pen"></i> Edit Ulasan
            </a>
            <a href="{{ route('admin.ratings.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <form method="POST" action="{{ route('admin.ratings.destroy', $rating->id) }}"
                  onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')"
                  style="margin-left:auto;display:flex;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-delete">
                    <i class="fas fa-trash"></i> Hapus Ulasan
                </button>
            </form>
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
