<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | PerpusInd</title>
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
        .au { animation: fadeUp .5s ease both; }
        .d1 { animation-delay: .05s; } .d2 { animation-delay: .10s; }
        .d3 { animation-delay: .15s; } .d4 { animation-delay: .20s; }
        .d5 { animation-delay: .25s; } .d6 { animation-delay: .30s; }

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
            .stats-grid { grid-template-columns: 1fr 1fr !important; }
            .qc-grid { grid-template-columns: 1fr !important; }
            .hero-illus { display: none; }
            .hero-inner { padding: 24px; }
        }

        /* ── MAIN ── */
        main { flex: 1; padding: 32px 36px; overflow-x: hidden; min-width: 0; }

        /* ── HERO ── */
        .hero { border-radius: 16px; overflow: hidden; position: relative; margin-bottom: 24px; background: var(--red); }
        .hero-inner { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; padding: 28px 32px; }

        .hero-date-badge { position: absolute; top: 16px; right: 16px; z-index: 2; background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.2); padding: 6px 12px; border-radius: 9px; font-size: 11.5px; font-weight: 600; color: rgba(255,255,255,.85); display: flex; align-items: center; gap: 6px; }

        .hero-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.2); padding: 4px 11px; border-radius: 999px; font-size: 11px; font-weight: 600; color: rgba(255,255,255,.85); letter-spacing: .04em; margin-bottom: 12px; }
        .hero-greeting { font-size: 11.5px; font-weight: 600; color: rgba(255,220,220,.8); letter-spacing: .06em; text-transform: uppercase; margin-bottom: 6px; }
        .hero-name { font-size: 26px; font-weight: 800; color: #fff; line-height: 1.15; letter-spacing: -.02em; margin-bottom: 8px; }
        .hero-sub { font-size: 13px; color: rgba(255,220,220,.75); max-width: 360px; line-height: 1.6; }

        .hero-illus { position: relative; z-index: 1; flex-shrink: 0; }
        .hero-icon-wrap { width: 88px; height: 88px; border-radius: 22px; background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.18); display: flex; align-items: center; justify-content: center; }
        .hero-icon-wrap i { font-size: 38px; color: rgba(255,220,220,.85); }

        /* ── STATS ── */
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px; }

        .sc { background: #fff; border: 1px solid var(--gray-200); border-radius: 12px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; transition: box-shadow .2s, transform .2s; }
        .sc:hover { box-shadow: 0 4px 16px rgba(0,0,0,.07); transform: translateY(-2px); }
        .sc-ico { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 17px; flex-shrink: 0; }
        .sc-val  { font-size: 26px; font-weight: 800; line-height: 1; }
        .sc-lbl  { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--gray-400); margin-top: 3px; }

        /* ── SECTION HEADER ── */
        .sec-hd { margin-bottom: 16px; }
        .sec-title { font-size: 16px; font-weight: 800; color: var(--gray-900); display: flex; align-items: center; gap: 8px; margin-bottom: 3px; }
        .sec-title span { color: var(--red); }
        .sec-sub { font-size: 12.5px; color: var(--gray-400); }

        /* ── QUICK CARDS ── */
        .qc-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }

        .qc { background: #fff; border: 1.5px solid var(--gray-200); border-radius: 12px; padding: 22px; display: flex; flex-direction: column; transition: transform .2s, box-shadow .2s, border-color .2s; }
        .qc:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.08); border-color: var(--red); }
        .qc:hover .qc-arr { background: var(--red); color: #fff; }

        .qc-ico { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; color: #fff; margin-bottom: 16px; flex-shrink: 0; }
        .qc-title { font-size: 14px; font-weight: 800; color: var(--gray-900); margin-bottom: 6px; letter-spacing: -.01em; }
        .qc-desc  { font-size: 12.5px; color: var(--gray-500); line-height: 1.6; flex: 1; margin-bottom: 16px; }
        .qc-bottom { display: flex; align-items: center; justify-content: space-between; }
        .qc-lbl { font-size: 11.5px; font-weight: 700; color: var(--gray-400); display: flex; align-items: center; gap: 5px; }
        .qc-arr { width: 30px; height: 30px; border-radius: 8px; background: var(--gray-100); color: var(--gray-500); display: flex; align-items: center; justify-content: center; font-size: 11px; transition: background .15s, color .15s; }

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

    {{-- HERO --}}
    <div class="hero au d1">
        <div class="hero-date-badge">
            <i class="fas fa-calendar-days"></i>
            <span id="heroDateTxt">—</span>
        </div>
        <div class="hero-inner">
            <div>
                <div class="hero-badge">Anggota Aktif</div>
                <p class="hero-greeting">Selamat Datang Kembali 👋</p>
                <h2 class="hero-name">{{ auth()->user()->name ?? 'Pengguna' }}</h2>
                <p class="hero-sub">Kelola aktivitas perpustakaan Anda dengan mudah dan efisien dari satu tempat.</p>
            </div>
            <div class="hero-illus">
                <div class="hero-icon-wrap">
                    <i class="fas fa-book-open"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- STATS --}}
    <div class="stats-grid">
        <div class="sc au d2">
            <div class="sc-ico" style="background:var(--sky-bg);">
                <i class="fas fa-book" style="color:var(--sky);"></i>
            </div>
            <div>
                <div class="sc-val" style="color:var(--sky);">{{ $totalBooks }}</div>
                <div class="sc-lbl">Total Buku</div>
            </div>
        </div>
        <div class="sc au d3">
            <div class="sc-ico" style="background:var(--green-bg);">
                <i class="fas fa-book-reader" style="color:var(--green);"></i>
            </div>
            <div>
                <div class="sc-val" style="color:var(--green);">{{ $borrowedBooks }}</div>
                <div class="sc-lbl">Sedang Dipinjam</div>
            </div>
        </div>
        <div class="sc au d4">
            <div class="sc-ico" style="background:var(--rose-bg);">
                <i class="fas fa-heart" style="color:var(--rose);"></i>
            </div>
            <div>
                <div class="sc-val" style="color:var(--rose);">{{ $favorites }}</div>
                <div class="sc-lbl">Buku Favorit</div>
            </div>
        </div>
    </div>

    {{-- QUICK ACTIONS --}}
    <div class="sec-hd au d4">
        <div class="sec-title">Akses <span>Cepat</span></div>
        <p class="sec-sub">Navigasi utama sistem perpustakaan digital</p>
    </div>

    <div class="qc-grid">

        <a href="{{ route('user.books') }}" class="qc au d4">
            <div class="qc-ico" style="background:var(--sky);">
                <i class="fas fa-book"></i>
            </div>
            <div class="qc-title">Katalog Buku</div>
            <div class="qc-desc">Telusuri koleksi lengkap perpustakaan dan pinjam buku yang Anda inginkan.</div>
            <div class="qc-bottom">
                <span class="qc-lbl" style="color:var(--sky);"><i class="fas fa-layer-group"></i> {{ $totalBooks }} buku</span>
                <div class="qc-arr"><i class="fas fa-arrow-right"></i></div>
            </div>
        </a>

        <a href="{{ route('user.favorites') }}" class="qc au d5">
            <div class="qc-ico" style="background:var(--rose);">
                <i class="fas fa-heart"></i>
            </div>
            <div class="qc-title">Buku Favorit</div>
            <div class="qc-desc">Kelola daftar buku yang Anda tandai dan simpan sebagai favorit.</div>
            <div class="qc-bottom">
                <span class="qc-lbl" style="color:var(--rose);"><i class="fas fa-heart"></i> {{ $favorites }} tersimpan</span>
                <div class="qc-arr"><i class="fas fa-arrow-right"></i></div>
            </div>
        </a>

        <a href="{{ route('user.borrowing.index') }}" class="qc au d6">
            <div class="qc-ico" style="background:var(--green);">
                <i class="fas fa-clock-rotate-left"></i>
            </div>
            <div class="qc-title">Riwayat Peminjaman</div>
            <div class="qc-desc">Pantau status, histori, dan tanggal pengembalian buku Anda.</div>
            <div class="qc-bottom">
                <span class="qc-lbl" style="color:var(--green);"><i class="fas fa-clock-rotate-left"></i> {{ $borrowedBooks }} aktif</span>
                <div class="qc-arr"><i class="fas fa-arrow-right"></i></div>
            </div>
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

    function updateDate() {
        var el = document.getElementById('heroDateTxt');
        if (!el) return;
        var d = new Date();
        var days   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        var months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        el.textContent = days[d.getDay()] + ', ' + d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
    }
    updateDate();
    setInterval(updateDate, 60000);
})();
</script>
</body>
</html>
