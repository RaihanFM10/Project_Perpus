<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman | PerpusInd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; }

:root {
    --red:       #E01E2C;
    --red-dk:    #B01824;
    --red-dp:    #7B0D14;
    --red-pl:    #FEF2F2;
    --red-sf:    #FEE2E2;
    --g50:       #F9FAFB;
    --g100:      #F3F4F6;
    --g200:      #E5E7EB;
    --g300:      #D1D5DB;
    --g400:      #9CA3AF;
    --g500:      #6B7280;
    --g700:      #374151;
    --g900:      #111827;
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
    --font:      'Poppins', sans-serif;
    --fdisp:     'Playfair Display', serif;
    --sb-w:      256px;
    --sh-sm:     0 1px 3px rgba(0,0,0,.06), 0 2px 8px rgba(0,0,0,.04);
    --sh-md:     0 6px 28px rgba(0,0,0,.1);
    --sh-red:    0 4px 16px rgba(224,30,44,.25);
}

html { scroll-behavior: smooth; }
body { font-family: var(--font); background: var(--g50); color: var(--g900); display: flex; min-height: 100vh; }
a    { text-decoration: none; color: inherit; }
button { font-family: var(--font); cursor: pointer; }

body::after {
    content: ''; position: fixed; inset: 0; pointer-events: none; z-index: 9999; opacity: .4;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.88' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.02'/%3E%3C/svg%3E");
}

@keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:none; } }
@keyframes pulse  { 0%,100%{opacity:1} 50%{opacity:.4} }
@keyframes spin   { to { transform:rotate(360deg); } }

.au { animation: fadeUp .6s cubic-bezier(.22,1,.36,1) both; }
.d1{animation-delay:.06s} .d2{animation-delay:.14s} .d3{animation-delay:.22s} .d4{animation-delay:.30s}

/* ─── SIDEBAR ─── */
.sidebar { width:var(--sb-w); background:#fff; border-right:1px solid var(--g200); display:flex; flex-direction:column; position:sticky; top:0; height:100vh; flex-shrink:0; z-index:100; transition:transform .3s cubic-bezier(.22,1,.36,1); }
.sidebar::before { content:''; position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg,var(--red-dp),var(--red-dk),var(--red)); }
.sb-brand { display:flex; align-items:center; gap:12px; padding:26px 20px 22px; border-bottom:1px solid var(--g100); }
.sb-mark  { width:42px; height:42px; border-radius:12px; flex-shrink:0; background:linear-gradient(145deg,var(--red-dp),var(--red)); display:flex; align-items:center; justify-content:center; box-shadow:var(--sh-red); position:relative; overflow:hidden; }
.sb-mark::before { content:''; position:absolute; top:-8px; right:-8px; width:20px; height:20px; border-radius:50%; background:rgba(255,255,255,.18); }
.sb-mark i { color:#fff; font-size:17px; }
.sb-title { font-size:15.5px; font-weight:800; color:var(--g900); letter-spacing:-.02em; }
.sb-title span { color:var(--red); }
.sb-sub   { font-size:10.5px; font-weight:600; color:var(--g400); letter-spacing:.05em; text-transform:uppercase; margin-top:1px; }
.sb-nav   { flex:1; padding:16px 12px; display:flex; flex-direction:column; gap:2px; overflow-y:auto; }
.sb-group-label { font-size:10px; font-weight:700; letter-spacing:.1em; color:var(--g400); text-transform:uppercase; padding:14px 12px 6px; }
.sb-link  { display:flex; align-items:center; gap:11px; padding:10px 14px; border-radius:10px; font-size:13.5px; font-weight:500; color:var(--g500); transition:background .16s,color .16s,transform .16s; position:relative; }
.sb-link .sb-icon { width:32px; height:32px; border-radius:9px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:14px; background:transparent; transition:background .16s; }
.sb-link:hover { background:var(--g50); color:var(--g900); transform:translateX(3px); }
.sb-link:hover .sb-icon { background:var(--g100); }
.sb-link.active { background:var(--red-pl); color:var(--red); font-weight:700; }
.sb-link.active .sb-icon { background:rgba(224,30,44,.12); color:var(--red); }
.sb-link.active::before { content:''; position:absolute; left:0; top:20%; bottom:20%; width:3px; border-radius:0 3px 3px 0; background:var(--red); }
.sb-footer { padding:14px 12px; border-top:1px solid var(--g100); }
.sb-user   { display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:10px; background:var(--g50); margin-bottom:10px; }
.sb-avatar { width:34px; height:34px; border-radius:50%; flex-shrink:0; background:linear-gradient(145deg,var(--red-dp),var(--red)); display:flex; align-items:center; justify-content:center; color:#fff; font-size:13px; font-weight:700; box-shadow:0 2px 8px rgba(224,30,44,.3); }
.sb-uname  { font-size:13px; font-weight:700; color:var(--g900); }
.sb-urole  { font-size:10.5px; color:var(--g400); font-weight:500; margin-top:1px; }
.sb-logout { width:100%; display:flex; align-items:center; gap:10px; padding:10px 14px; border:none; background:none; border-radius:10px; font-size:13.5px; font-weight:600; color:var(--red); transition:background .15s; }
.sb-logout:hover { background:var(--red-pl); }

/* ─── MOBILE ─── */
.mob-topbar { display:none; position:sticky; top:0; z-index:50; background:rgba(255,255,255,.92); backdrop-filter:blur(16px); border-bottom:1px solid var(--g200); padding:14px 20px; align-items:center; justify-content:space-between; }
.sb-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.35); z-index:99; backdrop-filter:blur(2px); }
.sb-overlay.show { display:block; }
.mob-logo-text { font-size:18px; font-weight:800; letter-spacing:-.02em; }
.mob-logo-text span { color:var(--red); }
.mob-ham { display:flex; flex-direction:column; gap:5px; background:transparent; border:none; cursor:pointer; padding:6px; }
.mob-ham span { width:22px; height:2px; background:var(--g700); border-radius:2px; transition:.3s; display:block; }

@media(max-width:768px){
    .mob-topbar{display:flex;} .sidebar{position:fixed;left:0;top:0;transform:translateX(-100%);}
    .sidebar.open{transform:translateX(0);box-shadow:8px 0 40px rgba(0,0,0,.12);}
    main{padding:24px 18px;} body{flex-direction:column;}
    .hero-illus{display:none;} .hero-inner{padding:28px 24px;}
    .filter-bar{flex-wrap:wrap;}
    .stat-row{grid-template-columns:1fr 1fr;}
}

/* ─── MAIN ─── */
main { flex:1; padding:36px 40px; overflow-x:hidden; min-width:0; }

/* Breadcrumb */
.breadcrumb { display:flex; align-items:center; gap:6px; font-size:12.5px; color:var(--g400); font-weight:500; margin-bottom:20px; }
.breadcrumb a { color:var(--g400); display:flex; align-items:center; gap:5px; transition:color .15s; }
.breadcrumb a:hover { color:var(--red); }
.breadcrumb .sep { font-size:9px; color:var(--g300); }
.breadcrumb .cur { color:var(--g700); font-weight:600; }

/* ─── HERO ─── */
.hero {
    border-radius:24px; overflow:hidden; position:relative;
    margin-bottom:24px;
    background:linear-gradient(135deg, var(--red-dp) 0%, var(--red-dk) 45%, var(--red) 100%);
    box-shadow:0 8px 32px rgba(224,30,44,.3);
}
.hero::before {
    content:''; position:absolute; inset:0; pointer-events:none; z-index:0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.06'/%3E%3C/svg%3E");
}
.hero-deco { position:absolute; border-radius:50%; pointer-events:none; }
.hero-deco-1 { width:240px; height:240px; top:-70px; right:-60px; background:radial-gradient(circle,rgba(255,255,255,.12) 0%,transparent 70%); }
.hero-deco-2 { width:160px; height:160px; bottom:-50px; left:28%; background:radial-gradient(circle,rgba(255,255,255,.08) 0%,transparent 70%); }
.hero-inner {
    position:relative; z-index:1;
    display:flex; align-items:center; justify-content:space-between;
    padding:30px 36px;
}
.hero-badge {
    display:inline-flex; align-items:center; gap:6px;
    background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2);
    padding:4px 12px; border-radius:999px;
    font-size:11px; font-weight:600; color:rgba(255,255,255,.85);
    letter-spacing:.04em; margin-bottom:12px;
}
.hero-ph-label { font-size:11.5px; font-weight:600; color:rgba(255,200,200,.75); letter-spacing:.08em; text-transform:uppercase; margin-bottom:6px; }
.hero-title { font-family:var(--fdisp); font-size:28px; font-weight:800; color:#fff; line-height:1.1; letter-spacing:-.02em; margin-bottom:6px; }
.hero-sub   { font-size:13px; color:rgba(255,220,220,.7); }
.hero-illus { position:relative; z-index:1; flex-shrink:0; }
.hero-icon-wrap {
    width:80px; height:80px; border-radius:22px;
    background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.18);
    display:flex; align-items:center; justify-content:center;
    backdrop-filter:blur(10px); box-shadow:0 8px 28px rgba(0,0,0,.15);
}
.hero-icon-wrap i { font-size:34px; color:rgba(255,220,220,.85); }

/* ─── STAT ROW ─── */
.stat-row { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:24px; }
.sc {
    background:#fff; border-radius:16px; border:1.5px solid var(--g200);
    padding:18px 20px; box-shadow:var(--sh-sm);
    display:flex; align-items:center; gap:14px;
    transition:transform .22s,box-shadow .22s;
}
.sc:hover { transform:translateY(-3px); box-shadow:var(--sh-md); }
.sc-ico { width:44px; height:44px; border-radius:12px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:18px; }
.sc-val { font-family:var(--fdisp); font-size:26px; font-weight:800; line-height:1; }
.sc-lbl { font-size:11.5px; font-weight:600; color:var(--g400); margin-top:3px; }

/* ─── SECTION TITLE ─── */
.sec-hd { margin-bottom:16px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
.sec-title {
    font-family:var(--fdisp); font-size:18px; font-weight:800;
    color:var(--g900); display:flex; align-items:center; gap:10px;
    position:relative; padding-left:14px;
}
.sec-title::before {
    content:''; position:absolute; left:0; top:10%; bottom:10%;
    width:4px; border-radius:2px;
    background:linear-gradient(to bottom,var(--red-dk),var(--red));
}
.sec-sub { font-size:13px; color:var(--g400); padding-left:14px; margin-top:3px; }

/* ─── FILTER BAR ─── */
.filter-bar {
    background:#fff; border-radius:14px; border:1.5px solid var(--g200);
    padding:14px 18px; margin-bottom:18px;
    display:flex; align-items:center; gap:10px; flex-wrap:wrap;
    box-shadow:var(--sh-sm);
}
.filter-label { font-size:11.5px; font-weight:700; color:var(--g400); text-transform:uppercase; letter-spacing:.07em; }
.filter-div   { width:1px; height:20px; background:var(--g200); }

.filter-btn {
    display:inline-flex; align-items:center; gap:6px;
    padding:6px 14px; border-radius:8px;
    font-size:12.5px; font-weight:600; font-family:var(--font);
    border:1.5px solid var(--g200); background:#fff; color:var(--g500);
    cursor:pointer; transition:all .15s;
}
.filter-btn:hover { background:var(--g50); border-color:var(--g300); color:var(--g900); }
.filter-btn.af-all      { background:var(--red-pl);  border-color:var(--red-sf);  color:var(--red); }
.filter-btn.af-pending  { background:var(--amber-bg); border-color:#fde68a; color:var(--amber); }
.filter-btn.af-approved { background:var(--green-bg); border-color:#bbf7d0; color:var(--green); }
.filter-btn.af-returned { background:var(--indigo-bg);border-color:#c7d2fe; color:var(--indigo); }
.filter-btn.af-rejected { background:var(--rose-bg);  border-color:#fda4af; color:var(--rose); }

/* ─── TABLE CARD ─── */
.table-card {
    background:#fff; border-radius:20px; border:1.5px solid var(--g200);
    overflow:hidden; box-shadow:var(--sh-sm);
}
.table-hd {
    padding:18px 24px; border-bottom:1px solid var(--g100);
    display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;
}
.table-hd-title { font-family:var(--fdisp); font-size:16px; font-weight:800; color:var(--g900); display:flex; align-items:center; gap:8px; }
.table-hd-title .th-ico { width:32px; height:32px; border-radius:9px; background:var(--red-pl); display:flex; align-items:center; justify-content:center; }
.table-hd-title .th-ico i { color:var(--red); font-size:13px; }
.tbl-count { font-size:12px; font-weight:700; color:var(--g400); background:var(--g50); border:1px solid var(--g200); border-radius:8px; padding:4px 12px; }

.tbl-wrap { overflow-x:auto; }

table { width:100%; border-collapse:collapse; font-size:13.5px; min-width:680px; }

thead th {
    background:var(--g50); padding:11px 16px;
    text-align:left; font-size:10.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.08em; color:var(--g400);
    border-bottom:1px solid var(--g100); white-space:nowrap;
}

tbody tr { border-bottom:1px solid var(--g100); transition:background .12s; }
tbody tr:hover { background:#FFF8F8; }
tbody tr:last-child { border-bottom:none; }
tbody td { padding:14px 16px; vertical-align:middle; }

/* No col */
.no-badge { display:inline-flex; align-items:center; justify-content:center; width:26px; height:26px; border-radius:8px; background:var(--g100); font-size:11.5px; font-weight:700; color:var(--g500); }

/* User cell */
.user-cell { display:flex; align-items:center; gap:10px; }
.tbl-avatar { width:34px; height:34px; border-radius:50%; flex-shrink:0; background:linear-gradient(145deg,var(--red-dp),var(--red)); display:flex; align-items:center; justify-content:center; font-weight:700; color:#fff; font-size:12px; box-shadow:0 2px 6px rgba(224,30,44,.25); }
.tbl-user-name { font-size:13.5px; font-weight:700; color:var(--g900); }

/* Book */
.book-cell { display:flex; align-items:center; gap:8px; }
.book-cell i { font-size:13px; color:var(--g300); flex-shrink:0; }
.book-name { font-size:13.5px; font-weight:700; color:var(--g900); }

/* Dates */
.date-cell { display:flex; align-items:center; gap:6px; font-size:13px; color:var(--g500); }
.date-cell i { font-size:11px; color:var(--g400); }
.return-ok  { display:inline-flex; align-items:center; gap:6px; font-size:12.5px; color:var(--green); font-weight:600; }
.return-none{ display:inline-flex; align-items:center; gap:6px; font-size:12.5px; color:var(--g400); font-style:italic; }

/* Badges */
.badge { display:inline-flex; align-items:center; gap:5px; padding:4px 11px; border-radius:999px; font-size:11.5px; font-weight:700; }
.badge::before { content:''; width:5px; height:5px; border-radius:50%; flex-shrink:0; }
.badge-pending  { background:var(--amber-bg); color:var(--amber); }
.badge-pending::before  { background:var(--amber); animation:pulse 1.5s infinite; }
.badge-approved { background:var(--green-bg);  color:var(--green); }
.badge-approved::before { background:var(--green); }
.badge-returned { background:var(--indigo-bg); color:var(--indigo); }
.badge-returned::before { background:var(--indigo); }
.badge-rejected { background:var(--rose-bg);   color:var(--rose); }
.badge-rejected::before { background:var(--rose); }
.badge-dipinjam { background:var(--sky-bg);    color:var(--sky); }
.badge-dipinjam::before { background:var(--sky); animation:pulse 1.5s infinite; }

/* Action buttons */
.act-wrap { display:flex; align-items:center; gap:6px; justify-content:center; }
.btn-act {
    display:inline-flex; align-items:center; gap:5px;
    padding:7px 13px; border-radius:9px;
    font-size:12px; font-weight:700; font-family:var(--font);
    border:1.5px solid transparent; cursor:pointer; transition:all .15s; text-decoration:none; white-space:nowrap;
}
.btn-detail-a { background:var(--indigo-bg); color:var(--indigo); border-color:transparent; }
.btn-detail-a:hover { background:var(--indigo); color:#fff; }
.btn-pdf-a    { background:var(--sky-bg); color:var(--sky); border-color:transparent; }
.btn-pdf-a:hover { background:var(--sky); color:#fff; }

/* Empty state */
.empty-td { padding:60px 20px; text-align:center; }
.empty-ico { width:60px; height:60px; border-radius:18px; background:var(--g100); margin:0 auto 14px; display:flex; align-items:center; justify-content:center; }
.empty-ico i { font-size:24px; color:var(--g300); }
.empty-ttl { font-family:var(--fdisp); font-size:16px; font-weight:800; color:var(--g700); margin-bottom:5px; }
.empty-sub { font-size:13px; color:var(--g400); }

/* Pagination */
.pg-wrap { padding:16px 24px; border-top:1px solid var(--g100); display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; }
.pg-info { font-size:12.5px; color:var(--g400); font-weight:500; }

/* Flag stripe */
.flag-stripe { display:flex; height:4px; border-radius:4px; overflow:hidden; margin-top:32px; }
.flag-stripe .fr { flex:1; background:var(--red); }
.flag-stripe .fw { flex:1; background:var(--g200); }
</style>
</head>
<body>

<div class="sb-overlay" id="sbOverlay"></div>

<!-- ─── SIDEBAR ─── -->
<aside class="sidebar" id="sidebar">
    <div class="sb-brand">
        <div class="sb-mark"><i class="fas fa-book-open"></i></div>
        <div>
            <div class="sb-title">Perpus<span>Ind</span></div>
            <div class="sb-sub">Member Panel</div>
        </div>
    </div>
    <nav class="sb-nav">
        <div class="sb-group-label">Menu</div>
        <a href="{{ route('user.dashboard') }}" class="sb-link">
            <span class="sb-icon"><i class="fas fa-house-chimney"></i></span> Dashboard
        </a>
        <a href="{{ route('user.books') }}" class="sb-link">
            <span class="sb-icon"><i class="fas fa-book"></i></span> Katalog Buku
        </a>
        <a href="{{ route('user.favorites') }}" class="sb-link">
            <span class="sb-icon"><i class="fas fa-heart"></i></span> Buku Favorit
        </a>
        <a href="{{ route('user.borrowing.index') }}" class="sb-link active">
            <span class="sb-icon"><i class="fas fa-clock-rotate-left"></i></span> Riwayat Peminjaman
        </a>
        <div class="sb-group-label">Akun</div>
        <a href="{{ url('/profile') }}" class="sb-link">
            <span class="sb-icon"><i class="fas fa-user"></i></span> Profil Saya
        </a>
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

<!-- MOBILE TOPBAR -->
<div class="mob-topbar" id="mobTopbar">
    <div class="mob-logo-text">Perpus<span>Ind</span></div>
    <button class="mob-ham" id="hamBtn" aria-label="Buka menu" aria-expanded="false">
        <span></span><span></span><span></span>
    </button>
</div>

<!-- ─── MAIN ─── -->
<main>

    <!-- Breadcrumb -->
    <div class="breadcrumb au d1">
        <a href="{{ route('user.dashboard') }}"><i class="fas fa-house-chimney"></i> Dashboard</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="cur">Riwayat Peminjaman</span>
    </div>

    <!-- HERO -->
    <div class="hero au d1">
        <div class="hero-deco hero-deco-1"></div>
        <div class="hero-deco hero-deco-2"></div>
        <div class="hero-inner">
            <div>
                <div class="hero-badge"><i class="fas fa-clock-rotate-left" style="font-size:9px;"></i> Histori Aktivitas</div>
                <p class="hero-ph-label">Riwayat Saya</p>
                <h2 class="hero-title">Riwayat <span style="font-style:italic;">Peminjaman</span></h2>
                <p class="hero-sub">Pantau status dan histori semua buku yang pernah Anda pinjam</p>
            </div>
            <div class="hero-illus">
                <div class="hero-icon-wrap">
                    <i class="fas fa-clock-rotate-left"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- STAT ROW -->
    @php
        $total    = $borrowings->count();
        $pending  = $borrowings->where('status','pending')->count();
        $returned = $borrowings->where('status','returned')->count();
        $rejected = $borrowings->where('status','rejected')->count();
    @endphp
    <div class="stat-row au d2">
        <div class="sc">
            <div class="sc-ico" style="background:var(--red-pl);"><i class="fas fa-layer-group" style="color:var(--red);"></i></div>
            <div>
                <div class="sc-val" style="color:var(--red);">{{ $total }}</div>
                <div class="sc-lbl">Total Peminjaman</div>
            </div>
        </div>
        <div class="sc">
            <div class="sc-ico" style="background:var(--amber-bg);"><i class="fas fa-hourglass-half" style="color:var(--amber);"></i></div>
            <div>
                <div class="sc-val" style="color:var(--amber);">{{ $pending }}</div>
                <div class="sc-lbl">Menunggu</div>
            </div>
        </div>
        <div class="sc">
            <div class="sc-ico" style="background:var(--green-bg);"><i class="fas fa-check-circle" style="color:var(--green);"></i></div>
            <div>
                <div class="sc-val" style="color:var(--green);">{{ $returned }}</div>
                <div class="sc-lbl">Dikembalikan</div>
            </div>
        </div>
        <div class="sc">
            <div class="sc-ico" style="background:var(--rose-bg);"><i class="fas fa-times-circle" style="color:var(--rose);"></i></div>
            <div>
                <div class="sc-val" style="color:var(--rose);">{{ $rejected }}</div>
                <div class="sc-lbl">Ditolak</div>
            </div>
        </div>
    </div>

    <!-- SECTION TITLE + FILTER -->
    <div class="sec-hd au d3">
        <div>
            <div class="sec-title">Daftar Peminjaman</div>
            <p class="sec-sub">Semua transaksi peminjaman buku Anda tercatat di sini</p>
        </div>
        <a href="{{ route('user.books') }}" style="display:inline-flex; align-items:center; gap:7px; padding:9px 16px; border:1.5px solid var(--g200); border-radius:10px; font-size:13px; font-weight:600; color:var(--g500); background:#fff; transition:border-color .15s,color .15s;" onmouseover="this.style.borderColor='var(--red)';this.style.color='var(--red)'" onmouseout="this.style.borderColor='var(--g200)';this.style.color='var(--g500)'">
            <i class="fas fa-arrow-left" style="font-size:11px;"></i> Kembali ke Katalog
        </a>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-bar au d3">
        <span class="filter-label"><i class="fas fa-filter" style="margin-right:4px; font-size:10px;"></i> Filter:</span>
        <button class="filter-btn af-all" id="fb-all"      onclick="filterTable('all',this)">
            <i class="fas fa-circle" style="font-size:6px;"></i> Semua
        </button>
        <div class="filter-div"></div>
        <button class="filter-btn" id="fb-pending"  onclick="filterTable('pending',this)">
            <i class="fas fa-circle" style="font-size:6px; color:var(--amber);"></i> Pending
        </button>
        <button class="filter-btn" id="fb-approved" onclick="filterTable('approved',this)">
            <i class="fas fa-circle" style="font-size:6px; color:var(--green);"></i> Disetujui
        </button>
        <button class="filter-btn" id="fb-returned" onclick="filterTable('returned',this)">
            <i class="fas fa-circle" style="font-size:6px; color:var(--indigo);"></i> Dikembalikan
        </button>
        <button class="filter-btn" id="fb-rejected" onclick="filterTable('rejected',this)">
            <i class="fas fa-circle" style="font-size:6px; color:var(--rose);"></i> Ditolak
        </button>
    </div>

    <!-- TABLE CARD -->
    <div class="table-card au d4">
        <div class="table-hd">
            <div class="table-hd-title">
                <div class="th-ico"><i class="fas fa-list"></i></div>
                Semua Peminjaman
            </div>
            <span class="tbl-count" id="rowCount">{{ $borrowings->count() }} entri</span>
        </div>

        <div class="tbl-wrap">
            <table id="mainTable">
                <thead>
                    <tr>
                        <th style="width:50px; text-align:center;">#</th>
                        <th>Pengguna</th>
                        <th>Buku</th>
                        <th>Tgl. Pinjam</th>
                        <th>Tgl. Kembali</th>
                        <th>Status</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $i => $item)
                    <tr data-status="{{ $item->status }}">
                        <td style="text-align:center;">
                            <span class="no-badge">{{ $i + 1 }}</span>
                        </td>
                        <td>
                            <div class="user-cell">
                                <div class="tbl-avatar">{{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}</div>
                                <span class="tbl-user-name">{{ $item->user->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="book-cell">
                                <i class="fas fa-book"></i>
                                <span class="book-name">{{ $item->book->judul ?? '-' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="date-cell">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $item->created_at->format('d M Y') }}
                            </div>
                        </td>
                        <td>
                            @if($item->returned_at)
                                <div class="return-ok">
                                    <i class="fas fa-check-circle"></i>
                                    {{ \Carbon\Carbon::parse($item->returned_at)->format('d M Y') }}
                                </div>
                            @else
                                <div class="return-none">
                                    <i class="fas fa-clock"></i> Belum dikembalikan
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($item->status === 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @elseif($item->status === 'approved')
                                <span class="badge badge-approved">Disetujui</span>
                            @elseif($item->status === 'returned')
                                <span class="badge badge-returned">Dikembalikan</span>
                            @elseif($item->status === 'dipinjam')
                                <span class="badge badge-dipinjam">Dipinjam</span>
                            @else
                                <span class="badge badge-rejected">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <div class="act-wrap">
                                <a href="{{ route('user.borrowing.show', $item->id) }}" class="btn-act btn-detail-a">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <button onclick="exportRowToPDF(this)" class="btn-act btn-pdf-a">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-td">
                                <div class="empty-ico"><i class="fas fa-inbox"></i></div>
                                <p class="empty-ttl">Belum ada riwayat peminjaman</p>
                                <p class="empty-sub">Pinjam buku dari katalog untuk memulai</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($borrowings->count() > 0)
        <div class="pg-wrap">
            <span class="pg-info" id="pgInfo">Menampilkan {{ $borrowings->count() }} data peminjaman</span>
            {{-- {{ $borrowings->links() }} --}}
        </div>
        @endif
    </div>

    <div class="flag-stripe au" style="animation-delay:.36s;" aria-hidden="true">
        <div class="fr"></div><div class="fw"></div>
    </div>

</main>

<script>
// ── SIDEBAR MOBILE ──────────────────────────────────
(function(){
    var sidebar=document.getElementById('sidebar'),overlay=document.getElementById('sbOverlay'),hamBtn=document.getElementById('hamBtn');
    function openSB(){sidebar.classList.add('open');overlay.classList.add('show');if(hamBtn)hamBtn.setAttribute('aria-expanded','true');var s=hamBtn?hamBtn.querySelectorAll('span'):[];if(s[0])s[0].style.transform='rotate(45deg) translate(5px,5px)';if(s[1])s[1].style.opacity='0';if(s[2])s[2].style.transform='rotate(-45deg) translate(5px,-5px)';}
    function closeSB(){sidebar.classList.remove('open');overlay.classList.remove('show');if(hamBtn)hamBtn.setAttribute('aria-expanded','false');var s=hamBtn?hamBtn.querySelectorAll('span'):[];s.forEach(function(x){x.style.transform='';x.style.opacity='';});}
    if(hamBtn)hamBtn.addEventListener('click',function(){sidebar.classList.contains('open')?closeSB():openSB();});
    if(overlay)overlay.addEventListener('click',closeSB);
})();

// ── FILTER ──────────────────────────────────────────
var filterMap = {
    'all':      'af-all',
    'pending':  'af-pending',
    'approved': 'af-approved',
    'returned': 'af-returned',
    'rejected': 'af-rejected'
};

function filterTable(status, btn) {
    // Reset all filter buttons
    document.querySelectorAll('.filter-btn').forEach(function(b){
        b.className = 'filter-btn';
    });
    // Set active class
    var activeClass = filterMap[status] || '';
    if (activeClass) btn.classList.add(activeClass);

    var rows = document.querySelectorAll('#mainTable tbody tr[data-status]');
    var count = 0;
    rows.forEach(function(row){
        var show = (status === 'all' || row.dataset.status === status);
        row.style.display = show ? '' : 'none';
        if (show) count++;
    });
    document.getElementById('rowCount').textContent = count + ' entri';
    document.getElementById('pgInfo') && (document.getElementById('pgInfo').textContent = 'Menampilkan ' + count + ' data peminjaman');
}

// ── EXPORT PDF ───────────────────────────────────────
function exportRowToPDF(btn) {
    var jsPDF = window.jspdf.jsPDF;
    var row   = btn.closest('tr');
    var cells = row.querySelectorAll('td');

    var no         = cells[0].innerText.trim();
    var nama       = cells[1].innerText.trim();
    var buku       = cells[2].innerText.trim();
    var tglPinjam  = cells[3].innerText.trim();
    var tglKembali = cells[4].innerText.trim();
    var status     = cells[5].innerText.trim();

    var doc = new jsPDF();
    var pw  = doc.internal.pageSize.getWidth();

    // Header merah
    doc.setFillColor(176, 24, 36);
    doc.rect(0, 0, pw, 40, 'F');
    doc.setFillColor(224, 30, 44);
    doc.rect(0, 32, pw, 8, 'F');

    doc.setFont('helvetica','bold');
    doc.setFontSize(17);
    doc.setTextColor(255,255,255);
    doc.text('BUKTI PEMINJAMAN BUKU', pw/2, 17, {align:'center'});
    doc.setFontSize(9);
    doc.setFont('helvetica','normal');
    doc.text('PerpusInd — Perpustakaan Digital', pw/2, 27, {align:'center'});

    // Body
    var boxX=14, boxY=50, boxW=pw-28;
    var labelX=boxX+8, colonX=labelX+52, valueX=colonX+6, rowH=16;
    var fields=[
        ['No',no,false],['Nama Pengguna',nama,false],
        ['Judul Buku',buku,true],['Tanggal Pinjam',tglPinjam,false],
        ['Tanggal Kembali',tglKembali,false],['Status',status,false]
    ];

    var maxVW = pw - valueX - 16;
    var totalH = 10;
    var rendered = fields.map(function(f){
        var lines = f[2] ? doc.splitTextToSize(f[1], maxVW) : [f[1]];
        var h = Math.max(rowH, lines.length*6+8);
        totalH += h;
        return {label:f[0], lines:lines, h:h};
    });

    doc.setFillColor(253,242,242);
    doc.setDrawColor(224,30,44);
    doc.setLineWidth(0.4);
    doc.roundedRect(boxX, boxY, boxW, totalH, 4, 4, 'FD');

    var y = boxY + 14;
    rendered.forEach(function(r, i){
        if(i%2===0){ doc.setFillColor(254,226,226); doc.rect(boxX+1,y-8,boxW-2,r.h,'F'); }
        doc.setFont('helvetica','bold'); doc.setFontSize(10); doc.setTextColor(60,20,20);
        doc.text(r.label, labelX, y);
        doc.text(':', colonX, y);
        doc.setFont('helvetica','normal'); doc.setTextColor(30,10,10);
        doc.text(r.lines, valueX, y);
        y += r.h;
    });

    // Status badge
    var by = boxY + totalH + 12;
    var sl = status.toLowerCase();
    var bc = sl.includes('kembali')||sl.includes('selesai') ? [22,163,74] :
             sl.includes('tolak') ? [225,29,72] :
             sl.includes('pending') ? [217,119,6] : [176,24,36];
    doc.setFillColor(bc[0],bc[1],bc[2]);
    doc.roundedRect(pw/2-35, by, 70, 11, 3,3,'F');
    doc.setFont('helvetica','bold'); doc.setFontSize(9); doc.setTextColor(255,255,255);
    doc.text(status.toUpperCase(), pw/2, by+7.5, {align:'center'});

    // Footer
    var fy = doc.internal.pageSize.getHeight()-16;
    doc.setDrawColor(200,200,200); doc.setLineWidth(0.3);
    doc.line(14, fy-4, pw-14, fy-4);
    doc.setFontSize(8); doc.setFont('helvetica','italic'); doc.setTextColor(150,150,150);
    doc.text('Dokumen diterbitkan otomatis oleh sistem PerpusInd.', pw/2, fy, {align:'center'});
    doc.text('Dicetak: '+new Date().toLocaleDateString('id-ID',{day:'2-digit',month:'long',year:'numeric'}), pw/2, fy+6, {align:'center'});

    doc.save('Peminjaman_'+no+'.pdf');
}
</script>
</body>
</html>