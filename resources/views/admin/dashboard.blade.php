<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | PerpusInd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --red:      #DC2626;
            --red-dk:   #991B1B;
            --red-bg:   #FEF2F2;
            --gray-50:  #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-400: #9CA3AF;
            --gray-500: #6B7280;
            --gray-700: #374151;
            --gray-900: #111827;
            --green:    #16A34A;
            --green-bg: #DCFCE7;
            --amber:    #D97706;
            --amber-bg: #FEF3C7;
            --violet:   #7C3AED;
            --violet-bg:#F5F3FF;
            --sky:      #0284C7;
            --sky-bg:   #E0F2FE;
            --sb-w:     240px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
            display: flex;
            min-height: 100vh;
        }

        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; cursor: pointer; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: none; }
        }
        .au { animation: fadeUp .5s ease both; }
        .d1 { animation-delay: .05s; }
        .d2 { animation-delay: .12s; }
        .d3 { animation-delay: .19s; }
        .d4 { animation-delay: .26s; }
        .d5 { animation-delay: .33s; }
        .d6 { animation-delay: .40s; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sb-w);
            background: #fff;
            border-right: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            flex-shrink: 0;
            z-index: 100;
        }

        .sb-brand {
            display: flex; align-items: center; gap: 10px;
            padding: 20px 18px;
            border-bottom: 1px solid var(--gray-100);
        }
        .sb-logo-box {
            width: 34px; height: 34px;
            background: var(--red);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .sb-logo-box i { color: #fff; font-size: 14px; }
        .sb-title { font-size: 16px; font-weight: 800; letter-spacing: -.02em; }
        .sb-title span { color: var(--red); }
        .sb-sub { font-size: 10px; font-weight: 600; color: var(--gray-400); letter-spacing: .05em; text-transform: uppercase; margin-top: 1px; }

        .sb-nav { flex: 1; padding: 12px 10px; display: flex; flex-direction: column; gap: 2px; overflow-y: auto; }

        .sb-group {
            font-size: 10px; font-weight: 700; letter-spacing: .1em;
            color: var(--gray-400); text-transform: uppercase;
            padding: 12px 10px 5px;
        }

        .sb-link {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 9px;
            font-size: 13px; font-weight: 500;
            color: var(--gray-500);
            transition: background .15s, color .15s;
        }
        .sb-link i { width: 16px; text-align: center; font-size: 13px; }
        .sb-link:hover { background: var(--gray-100); color: var(--gray-900); }
        .sb-link.active { background: var(--red-bg); color: var(--red); font-weight: 700; }

        .sb-footer {
            padding: 12px 10px;
            border-top: 1px solid var(--gray-100);
        }
        .sb-user {
            display: flex; align-items: center; gap: 9px;
            padding: 9px 10px; border-radius: 9px;
            background: var(--gray-50); margin-bottom: 8px;
        }
        .sb-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--red);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 12px; font-weight: 700; flex-shrink: 0;
        }
        .sb-uname { font-size: 12.5px; font-weight: 700; }
        .sb-urole { font-size: 10.5px; color: var(--gray-400); }
        .sb-logout {
            width: 100%;
            display: flex; align-items: center; gap: 9px;
            padding: 9px 12px; border: none; background: none;
            border-radius: 9px; font-size: 13px; font-weight: 600;
            color: var(--red); transition: background .15s;
        }
        .sb-logout:hover { background: var(--red-bg); }

        /* ── TOPBAR (mobile) ── */
        .topbar {
            display: none;
            position: sticky; top: 0; z-index: 50;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--gray-100);
            padding: 13px 20px;
            align-items: center; justify-content: space-between;
        }
        .mob-title { font-size: 17px; font-weight: 800; letter-spacing: -.02em; }
        .mob-title span { color: var(--red); }
        .mob-ham {
            display: flex; flex-direction: column; gap: 5px;
            background: transparent; border: none; padding: 4px;
        }
        .mob-ham span { width: 20px; height: 2px; background: var(--gray-700); border-radius: 2px; transition: .25s; display: block; }

        .sb-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.3); z-index: 99;
        }
        .sb-overlay.show { display: block; }

        @media (max-width: 768px) {
            .topbar { display: flex; }
            .sidebar { position: fixed; left: 0; top: 0; transform: translateX(-100%); transition: transform .3s ease; }
            .sidebar.open { transform: translateX(0); box-shadow: 4px 0 24px rgba(0,0,0,.1); }
            main { padding: 24px 18px; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .quick-grid  { grid-template-columns: 1fr 1fr; }
            body { flex-direction: column; }
        }

        /* ── MAIN ── */
        main { flex: 1; padding: 32px 36px; overflow-x: hidden; min-width: 0; }

        /* ── PAGE HEADER ── */
        .page-hd {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 28px; flex-wrap: wrap; gap: 12px;
        }
        .ph-sub-label {
            font-size: 11px; font-weight: 700; color: var(--gray-400);
            letter-spacing: .06em; text-transform: uppercase;
            margin-bottom: 5px;
        }
        .ph-title { font-size: 24px; font-weight: 800; letter-spacing: -.025em; }
        .ph-title span { color: var(--red); }
        .ph-desc { font-size: 13.5px; color: var(--gray-400); margin-top: 4px; }
        .ph-date {
            display: flex; align-items: center; gap: 8px;
            background: #fff; border: 1px solid var(--gray-200);
            border-radius: 9px; padding: 9px 14px;
            font-size: 12.5px; font-weight: 600; color: var(--gray-700);
            flex-shrink: 0;
        }
        .ph-date i { color: var(--red); font-size: 12px; }

        /* ── STAT CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }
        @media (max-width: 1100px) { .stats-grid { grid-template-columns: 1fr 1fr; } }

        .sc {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            padding: 20px 22px;
            display: flex; flex-direction: column; gap: 14px;
            transition: transform .25s ease, box-shadow .25s ease;
            text-decoration: none;
        }
        .sc:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(0,0,0,.07); }

        .sc-top { display: flex; align-items: center; justify-content: space-between; }
        .sc-icon {
            width: 42px; height: 42px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
        }
        .sc-badge {
            font-size: 10px; font-weight: 700; letter-spacing: .06em;
            text-transform: uppercase; padding: 3px 9px; border-radius: 999px;
        }
        .sc-lbl { font-size: 12px; font-weight: 600; color: var(--gray-400); margin-bottom: 2px; }
        .sc-val { font-size: 32px; font-weight: 800; line-height: 1; }
        .sc-foot {
            display: flex; align-items: center; gap: 6px;
            font-size: 12px; color: var(--gray-400);
            padding-top: 12px; border-top: 1px solid var(--gray-100);
        }
        .sc-foot a { font-weight: 700; font-size: 12px; transition: opacity .15s; }
        .sc-foot a:hover { opacity: .7; }

        /* ── SECTION HEADER ── */
        .sec-hd { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; }
        .sec-title {
            font-size: 14.5px; font-weight: 700;
            display: flex; align-items: center; gap: 8px;
        }
        .sec-title::before {
            content: ''; width: 3px; height: 14px; border-radius: 2px;
            background: var(--red); flex-shrink: 0;
        }
        .sec-title i { color: var(--red); font-size: 12px; }
        .view-link {
            font-size: 12px; font-weight: 700; color: var(--red);
            display: flex; align-items: center; gap: 4px;
            transition: gap .15s;
        }
        .view-link:hover { gap: 7px; }

        /* ── QUICK ACCESS ── */
        .quick-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 28px;
        }
        @media (max-width: 900px) { .quick-grid { grid-template-columns: 1fr 1fr; } }

        .qc {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: 13px;
            padding: 15px 18px;
            display: flex; align-items: center; gap: 12px;
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s;
        }
        .qc:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,.06);
            border-color: rgba(220,38,38,.2);
        }
        .qc-ico {
            width: 38px; height: 38px; border-radius: 10px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
        }
        .qc-name { font-size: 13px; font-weight: 700; }
        .qc-desc { font-size: 11.5px; color: var(--gray-400); margin-top: 1px; }
        .qc-arr { margin-left: auto; color: var(--gray-300); font-size: 11px; flex-shrink: 0; transition: color .15s, transform .15s; }
        .qc:hover .qc-arr { color: var(--red); transform: translateX(2px); }

        /* ── FOOTER STRIPE ── */
        .flag-stripe { display: flex; height: 4px; }
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

        <a href="{{ route('admin.dashboard') }}" class="sb-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('admin.users') }}" class="sb-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Manajemen User
        </a>
        <a href="{{ url('/admin/books') }}" class="sb-link {{ request()->is('admin/books*') ? 'active' : '' }}">
            <i class="fas fa-book"></i> Data Buku
        </a>
        <a href="{{ route('admin.categories.index') }}" class="sb-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Kategori Buku
        </a>

        <div class="sb-group">Aktivitas</div>

        <a href="{{ route('admin.borrowings.index') }}" class="sb-link {{ request()->routeIs('admin.borrowings*') ? 'active' : '' }}">
            <i class="fas fa-handshake"></i> Riwayat Peminjaman
        </a>
        <a href="{{ route('admin.ratings.index') }}" class="sb-link {{ request()->routeIs('admin.ratings*') ? 'active' : '' }}">
            <i class="fas fa-star"></i> Ulasan Buku
        </a>
    </nav>

    <div class="sb-footer">
        <div class="sb-user">
            <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="sb-uname">{{ auth()->user()->name }}</div>
                <div class="sb-urole">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sb-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
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

    {{-- Page Header --}}
    <div class="page-hd au d1">
        <div>
            <div class="ph-sub-label">Admin Panel</div>
            <h1 class="ph-title">Selamat Datang, <span>{{ auth()->user()->name }}</span></h1>
            <p class="ph-desc">Berikut ringkasan aktivitas perpustakaan digital hari ini</p>
        </div>
        <div class="ph-date">
            <i class="fas fa-calendar-day"></i>
            <span id="todayDate">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="stats-grid">

        <div class="sc au d2">
            <div class="sc-top">
                <div class="sc-icon" style="background:var(--red-bg);"><i class="fas fa-users" style="color:var(--red);"></i></div>
                <span class="sc-badge" style="background:var(--red-bg);color:var(--red);">Total</span>
            </div>
            <div>
                <div class="sc-lbl">Total User</div>
                <div class="sc-val" style="color:var(--red);">{{ $totalUser }}</div>
            </div>
            <div class="sc-foot">
                <i class="fas fa-arrow-right" style="font-size:9px;color:var(--red);"></i>
                <a href="{{ route('admin.users') }}" style="color:var(--red);">Lihat semua user</a>
            </div>
        </div>

        <div class="sc au d3">
            <div class="sc-top">
                <div class="sc-icon" style="background:var(--green-bg);"><i class="fas fa-user-shield" style="color:var(--green);"></i></div>
                <span class="sc-badge" style="background:var(--green-bg);color:var(--green);">Staff</span>
            </div>
            <div>
                <div class="sc-lbl">Total Petugas</div>
                <div class="sc-val" style="color:var(--green);">{{ $totalPetugas }}</div>
            </div>
            <div class="sc-foot">
                <i class="fas fa-arrow-right" style="font-size:9px;color:var(--green);"></i>
                <a href="{{ route('admin.users') }}" style="color:var(--green);">Kelola petugas</a>
            </div>
        </div>

        <div class="sc au d4">
            <div class="sc-top">
                <div class="sc-icon" style="background:var(--violet-bg);"><i class="fas fa-book-reader" style="color:var(--violet);"></i></div>
                <span class="sc-badge" style="background:var(--violet-bg);color:var(--violet);">Active</span>
            </div>
            <div>
                <div class="sc-lbl">Total Peminjaman</div>
                <div class="sc-val" style="color:var(--violet);">{{ $totalBorrowing }}</div>
            </div>
            <div class="sc-foot">
                <i class="fas fa-arrow-right" style="font-size:9px;color:var(--violet);"></i>
                <a href="{{ route('admin.borrowings.index') }}" style="color:var(--violet);">Lihat peminjaman</a>
            </div>
        </div>

    </div>

    {{-- Quick Access --}}
    <div class="sec-hd au d5">
        <div class="sec-title"><i class="fas fa-bolt"></i> Akses Cepat</div>
    </div>

    <div class="quick-grid au d6">
        <a href="{{ url('/admin/books') }}" class="qc">
            <div class="qc-ico" style="background:var(--red-bg);"><i class="fas fa-book" style="color:var(--red);"></i></div>
            <div><div class="qc-name">Data Buku</div><div class="qc-desc">Kelola koleksi buku</div></div>
            <i class="fas fa-chevron-right qc-arr"></i>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="qc">
            <div class="qc-ico" style="background:var(--amber-bg);"><i class="fas fa-tags" style="color:var(--amber);"></i></div>
            <div><div class="qc-name">Kategori Buku</div><div class="qc-desc">Atur kategori koleksi</div></div>
            <i class="fas fa-chevron-right qc-arr"></i>
        </a>
        <a href="{{ route('admin.borrowings.index') }}" class="qc">
            <div class="qc-ico" style="background:var(--green-bg);"><i class="fas fa-handshake" style="color:var(--green);"></i></div>
            <div><div class="qc-name">Riwayat Peminjaman</div><div class="qc-desc">Pantau aktivitas pinjam</div></div>
            <i class="fas fa-chevron-right qc-arr"></i>
        </a>
        <a href="{{ route('admin.users') }}" class="qc">
            <div class="qc-ico" style="background:var(--violet-bg);"><i class="fas fa-users" style="color:var(--violet);"></i></div>
            <div><div class="qc-name">Manajemen User</div><div class="qc-desc">Kelola akun pengguna</div></div>
            <i class="fas fa-chevron-right qc-arr"></i>
        </a>
        <a href="{{ route('admin.books.create') }}" class="qc">
            <div class="qc-ico" style="background:var(--sky-bg);"><i class="fas fa-plus-circle" style="color:var(--sky);"></i></div>
            <div><div class="qc-name">Tambah Buku</div><div class="qc-desc">Input buku baru</div></div>
            <i class="fas fa-chevron-right qc-arr"></i>
        </a>
        <a href="{{ route('admin.users.create') }}" class="qc">
            <div class="qc-ico" style="background:var(--red-bg);"><i class="fas fa-user-plus" style="color:var(--red);"></i></div>
            <div><div class="qc-name">Tambah Akun</div><div class="qc-desc">Buat akun petugas baru</div></div>
            <i class="fas fa-chevron-right qc-arr"></i>
        </a>
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

    var dateEl = document.getElementById('todayDate');
    if (dateEl) {
        var days   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        var months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        var now    = new Date();
        dateEl.textContent = days[now.getDay()] + ', ' + now.getDate() + ' ' + months[now.getMonth()] + ' ' + now.getFullYear();
    }
})();
</script>
</body>
</html>
