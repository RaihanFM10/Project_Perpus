<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Peminjaman | PerpusInd</title>
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
.d1{animation-delay:.06s} .d2{animation-delay:.14s} .d3{animation-delay:.22s} .d4{animation-delay:.30s} .d5{animation-delay:.38s}

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
    .detail-grid{grid-template-columns:1fr;}
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

/* ─── DETAIL GRID ─── */
.detail-grid {
    display:grid;
    grid-template-columns:1fr 300px;
    gap:18px;
    align-items:start;
}

/* ─── CARD BASE ─── */
.card {
    background:#fff; border-radius:20px; border:1.5px solid var(--g200);
    overflow:hidden; box-shadow:var(--sh-sm);
}

.card-hd {
    padding:18px 24px; border-bottom:1px solid var(--g100);
    display:flex; align-items:center; justify-content:space-between; gap:12px;
}
.card-hd-title { font-family:var(--fdisp); font-size:16px; font-weight:800; color:var(--g900); display:flex; align-items:center; gap:8px; }
.card-hd-title .th-ico { width:32px; height:32px; border-radius:9px; background:var(--red-pl); display:flex; align-items:center; justify-content:center; }
.card-hd-title .th-ico i { color:var(--red); font-size:13px; }

/* ─── BADGES ─── */
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

/* ─── BOOK SHOWCASE ─── */
.book-showcase {
    display:flex; align-items:center; gap:18px;
    margin:20px 24px;
    padding:18px 20px;
    background:var(--red-pl);
    border:1.5px solid var(--red-sf);
    border-radius:14px;
}
.book-cover {
    width:60px; height:80px; border-radius:8px; flex-shrink:0;
    background:linear-gradient(145deg,var(--red-dp),var(--red));
    display:flex; align-items:center; justify-content:center;
    box-shadow:0 6px 18px rgba(224,30,44,.35);
    position:relative;
}
.book-cover::after {
    content:''; position:absolute; left:7px; top:6px; bottom:6px;
    width:3px; background:rgba(255,255,255,.25); border-radius:2px;
}
.book-cover i { color:rgba(255,255,255,.9); font-size:20px; }
.book-title-main { font-family:var(--fdisp); font-size:16px; font-weight:800; color:var(--g900); margin-bottom:5px; line-height:1.3; }
.book-tx-id { display:inline-flex; align-items:center; gap:5px; font-size:11.5px; font-weight:600; color:var(--g400); background:#fff; border:1px solid var(--g200); padding:3px 10px; border-radius:8px; }

/* ─── INFO ROWS ─── */
.info-section { padding:0 24px 8px; }

.info-row {
    display:flex; align-items:center; gap:14px;
    padding:13px 0;
    border-bottom:1px solid var(--g100);
}
.info-row:last-child { border-bottom:none; }

.info-ico {
    width:38px; height:38px; border-radius:11px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center; font-size:14px;
}
.ico-red    { background:var(--red-pl);    color:var(--red); }
.ico-amber  { background:var(--amber-bg);  color:var(--amber); }
.ico-green  { background:var(--green-bg);  color:var(--green); }
.ico-sky    { background:var(--sky-bg);    color:var(--sky); }
.ico-indigo { background:var(--indigo-bg); color:var(--indigo); }

.info-lbl { font-size:10.5px; font-weight:700; color:var(--g400); text-transform:uppercase; letter-spacing:.07em; margin-bottom:2px; }
.info-val { font-size:14px; font-weight:700; color:var(--g900); }
.info-val-muted { font-size:13px; color:var(--g400); font-style:italic; font-weight:400; }

.warn-chip {
    display:inline-flex; align-items:center; gap:4px;
    font-size:11px; font-weight:700; padding:2px 8px; border-radius:6px;
    margin-left:6px;
}
.warn-late   { background:var(--rose-bg);   color:var(--rose); }
.warn-soon   { background:var(--amber-bg);  color:var(--amber); }

/* ─── STATUS CARD ─── */
.status-display {
    padding:26px 20px 20px;
    text-align:center;
    border-bottom:1px solid var(--g100);
}
.status-ring {
    width:76px; height:76px; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    margin:0 auto 14px; font-size:26px; position:relative;
}
.ring-pending  { background:var(--amber-bg); color:var(--amber); box-shadow:0 0 0 6px rgba(217,119,6,.1); }
.ring-approved { background:var(--green-bg); color:var(--green); box-shadow:0 0 0 6px rgba(22,163,74,.1); }
.ring-returned { background:var(--indigo-bg);color:var(--indigo);box-shadow:0 0 0 6px rgba(79,70,229,.1); }
.ring-rejected { background:var(--rose-bg);  color:var(--rose);  box-shadow:0 0 0 6px rgba(225,29,72,.1); }

.status-lbl { font-family:var(--fdisp); font-size:16px; font-weight:800; color:var(--g900); margin-bottom:5px; }
.status-desc { font-size:12px; color:var(--g400); line-height:1.55; max-width:220px; margin:0 auto; }

/* ─── TIMELINE ─── */
.timeline { padding:18px 20px 4px; }
.tl-head {
    font-size:10px; font-weight:700; letter-spacing:.1em;
    text-transform:uppercase; color:var(--g400); margin-bottom:14px;
}
.tl-item {
    display:flex; gap:12px;
    position:relative; padding-bottom:14px;
}
.tl-item:last-child { padding-bottom:0; }
.tl-item:not(:last-child)::before {
    content:''; position:absolute; left:11px; top:24px; bottom:0;
    width:1.5px; background:var(--g200);
}
.tl-dot {
    width:24px; height:24px; border-radius:50%; flex-shrink:0;
    display:flex; align-items:center; justify-content:center; font-size:9px; margin-top:1px;
}
.tl-done   { background:var(--green-bg); color:var(--green); }
.tl-active { background:var(--red-pl);   color:var(--red); }
.tl-wait   { background:var(--g100); color:var(--g300); border:1.5px dashed var(--g200); }
.tl-reject { background:var(--rose-bg);  color:var(--rose); }

.tl-event { font-size:13px; font-weight:700; color:var(--g700); margin-bottom:1px; }
.tl-date  { font-size:11.5px; color:var(--g400); }

/* ─── BACK BTN ─── */
.btn-back-full {
    display:flex; align-items:center; justify-content:center; gap:8px;
    margin:16px 20px 20px;
    padding:11px 18px;
    background:var(--red-pl); color:var(--red);
    border:1.5px solid var(--red-sf); border-radius:10px;
    font-size:13px; font-weight:700; transition:all .15s;
    cursor:pointer;
}
.btn-back-full:hover { background:var(--red); color:#fff; border-color:var(--red); }

/* ─── PDF BTN ─── */
.btn-pdf-full {
    display:flex; align-items:center; justify-content:center; gap:8px;
    margin:0 20px 14px;
    padding:11px 18px;
    background:var(--sky-bg); color:var(--sky);
    border:1.5px solid #bae6fd; border-radius:10px;
    font-size:13px; font-weight:700; transition:all .15s;
    cursor:pointer;
}
.btn-pdf-full:hover { background:var(--sky); color:#fff; border-color:var(--sky); }

/* ─── FLAG STRIPE ─── */
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
        <a href="{{ route('user.borrowing.index') }}">Riwayat Peminjaman</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="cur">Detail Peminjaman</span>
    </div>

    <!-- HERO -->
    <div class="hero au d1">
        <div class="hero-deco hero-deco-1"></div>
        <div class="hero-deco hero-deco-2"></div>
        <div class="hero-inner">
            <div>
                <div class="hero-badge"><i class="fas fa-file-lines" style="font-size:9px;"></i> Informasi Transaksi</div>
                <p class="hero-ph-label">Detail Transaksi</p>
                <h2 class="hero-title">Detail <span style="font-style:italic;">Peminjaman</span></h2>
                <p class="hero-sub">Informasi lengkap mengenai transaksi peminjaman buku Anda</p>
            </div>
            <div class="hero-illus">
                <div class="hero-icon-wrap">
                    <i class="fas fa-file-lines"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION HEADER -->
    <div class="sec-hd au d2">
        <div>
            <div class="sec-title">Informasi Peminjaman</div>
            <p class="sec-sub">Data lengkap transaksi peminjaman buku</p>
        </div>
        <a href="{{ route('user.borrowing.index') }}"
           style="display:inline-flex; align-items:center; gap:7px; padding:9px 16px; border:1.5px solid var(--g200); border-radius:10px; font-size:13px; font-weight:600; color:var(--g500); background:#fff; transition:border-color .15s,color .15s;"
           onmouseover="this.style.borderColor='var(--red)';this.style.color='var(--red)'"
           onmouseout="this.style.borderColor='var(--g200)';this.style.color='var(--g500)'">
            <i class="fas fa-arrow-left" style="font-size:11px;"></i> Kembali ke Riwayat
        </a>
    </div>

    <!-- DETAIL GRID -->
    <div class="detail-grid">

        <!-- LEFT: MAIN INFO -->
        <div class="card au d3">
            <div class="card-hd">
                <div class="card-hd-title">
                    <div class="th-ico"><i class="fas fa-book"></i></div>
                    Data Buku &amp; Transaksi
                </div>
                @if($borrowing->status === 'pending')
                    <span class="badge badge-pending">Pending</span>
                @elseif($borrowing->status === 'approved')
                    <span class="badge badge-approved">Disetujui</span>
                @elseif($borrowing->status === 'returned')
                    <span class="badge badge-returned">Dikembalikan</span>
                @else
                    <span class="badge badge-rejected">Ditolak</span>
                @endif
            </div>

            <!-- Book Showcase -->
            <div class="book-showcase">
                <div class="book-cover">
                    <i class="fas fa-book-open"></i>
                </div>
                <div>
                    <div class="book-title-main">{{ $borrowing->book->judul ?? $borrowing->book->title ?? '-' }}</div>
                    <div class="book-tx-id">
                        <i class="fas fa-hashtag" style="font-size:9px;"></i>
                        ID Transaksi: #{{ str_pad($borrowing->id, 5, '0', STR_PAD_LEFT) }}
                    </div>
                </div>
            </div>

            <!-- Info Rows -->
            <div class="info-section">
                <div class="info-row">
                    <div class="info-ico ico-sky"><i class="fas fa-user"></i></div>
                    <div>
                        <div class="info-lbl">Nama Peminjam</div>
                        <div class="info-val">{{ $borrowing->user->name ?? '-' }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-ico ico-red"><i class="fas fa-calendar-plus"></i></div>
                    <div>
                        <div class="info-lbl">Tanggal Pinjam</div>
                        <div class="info-val">
                            {{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam ?? $borrowing->created_at)->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-ico ico-amber"><i class="fas fa-calendar-xmark"></i></div>
                    <div>
                        <div class="info-lbl">Batas Pengembalian</div>
                        <div class="info-val">
                            @if($borrowing->due_date)
                                {{ \Carbon\Carbon::parse($borrowing->due_date)->translatedFormat('d F Y') }}
                                @php $daysLeft = \Carbon\Carbon::now()->diffInDays($borrowing->due_date, false); @endphp
                                @if($borrowing->status === 'approved')
                                    @if($daysLeft < 0)
                                        <span class="warn-chip warn-late">
                                            <i class="fas fa-circle-exclamation"></i> Terlambat {{ abs($daysLeft) }} hari
                                        </span>
                                    @elseif($daysLeft <= 3)
                                        <span class="warn-chip warn-soon">
                                            <i class="fas fa-triangle-exclamation"></i> {{ $daysLeft }} hari lagi
                                        </span>
                                    @endif
                                @endif
                            @else
                                <span class="info-val-muted">Tidak ditentukan</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-ico ico-green"><i class="fas fa-calendar-check"></i></div>
                    <div>
                        <div class="info-lbl">Tanggal Dikembalikan</div>
                        <div class="info-val">
                            @if($borrowing->returned_at)
                                {{ \Carbon\Carbon::parse($borrowing->returned_at)->translatedFormat('d F Y') }}
                            @else
                                <span class="info-val-muted">Belum dikembalikan</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-ico ico-indigo"><i class="fas fa-clock-rotate-left"></i></div>
                    <div>
                        <div class="info-lbl">Pengajuan Dibuat</div>
                        <div class="info-val">{{ $borrowing->created_at->translatedFormat('d F Y, H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT: STATUS + TIMELINE -->
        <div style="display:flex; flex-direction:column; gap:16px;">

            <!-- Status Card -->
            <div class="card au d4">
                <div class="status-display">
                    @if($borrowing->status === 'pending')
                        <div class="status-ring ring-pending"><i class="fas fa-hourglass-half"></i></div>
                        <div class="status-lbl">Menunggu Persetujuan</div>
                        <div class="status-desc">Permintaan peminjaman Anda sedang menunggu konfirmasi dari pustakawan.</div>
                    @elseif($borrowing->status === 'approved')
                        <div class="status-ring ring-approved"><i class="fas fa-book-open-reader"></i></div>
                        <div class="status-lbl">Sedang Dipinjam</div>
                        <div class="status-desc">Buku sedang dalam peminjaman Anda. Harap kembalikan tepat waktu.</div>
                    @elseif($borrowing->status === 'returned')
                        <div class="status-ring ring-returned"><i class="fas fa-circle-check"></i></div>
                        <div class="status-lbl">Selesai</div>
                        <div class="status-desc">Buku telah berhasil dikembalikan. Terima kasih!</div>
                    @else
                        <div class="status-ring ring-rejected"><i class="fas fa-circle-xmark"></i></div>
                        <div class="status-lbl">Ditolak</div>
                        <div class="status-desc">Permintaan peminjaman Anda tidak dapat diproses.</div>
                    @endif
                </div>

                <!-- Timeline -->
                <div class="timeline">
                    <div class="tl-head"><i class="fas fa-timeline" style="margin-right:5px;"></i> Alur Status</div>

                    <div class="tl-item">
                        <div class="tl-dot tl-done"><i class="fas fa-check"></i></div>
                        <div>
                            <div class="tl-event">Pengajuan Dikirim</div>
                            <div class="tl-date">{{ $borrowing->created_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>

                    <div class="tl-item">
                        @if(in_array($borrowing->status, ['approved','returned']))
                            <div class="tl-dot tl-done"><i class="fas fa-check"></i></div>
                        @elseif($borrowing->status === 'rejected')
                            <div class="tl-dot tl-reject"><i class="fas fa-xmark"></i></div>
                        @else
                            <div class="tl-dot tl-active"><i class="fas fa-ellipsis"></i></div>
                        @endif
                        <div>
                            <div class="tl-event">
                                @if($borrowing->status === 'rejected') Ditolak
                                @elseif($borrowing->status === 'pending') Menunggu Persetujuan
                                @else Disetujui
                                @endif
                            </div>
                            <div class="tl-date">
                                @if($borrowing->status === 'pending') Sedang diproses...
                                @else {{ $borrowing->updated_at->format('d M Y, H:i') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="tl-item">
                        @if($borrowing->status === 'returned')
                            <div class="tl-dot tl-done"><i class="fas fa-check"></i></div>
                        @else
                            <div class="tl-dot tl-wait"><i class="fas fa-clock"></i></div>
                        @endif
                        <div>
                            <div class="tl-event">Buku Dikembalikan</div>
                            <div class="tl-date">
                                @if($borrowing->returned_at)
                                    {{ \Carbon\Carbon::parse($borrowing->returned_at)->format('d M Y, H:i') }}
                                @else
                                    Menunggu pengembalian
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PDF Button -->
                <button class="btn-pdf-full" onclick="exportDetailToPDF()">
                    <i class="fas fa-file-pdf"></i> Unduh Bukti PDF
                </button>

                <!-- Back Button -->
                <a href="{{ route('user.borrowing.index') }}" class="btn-back-full">
                    <i class="fas fa-arrow-left" style="font-size:11px;"></i>
                    Kembali ke Riwayat
                </a>
            </div>
        </div>
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

// ── EXPORT PDF ──────────────────────────────────────
function exportDetailToPDF() {
    var jsPDF = window.jspdf.jsPDF;
    var doc   = new jsPDF();
    var pw    = doc.internal.pageSize.getWidth();

    // Header merah
    doc.setFillColor(123, 13, 20);
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

    // Data dari halaman
    var fields = [
        ['ID Transaksi',    document.querySelector('.book-tx-id')?.innerText?.replace('ID Transaksi:','').trim() || '-'],
        ['Judul Buku',      document.querySelector('.book-title-main')?.innerText?.trim() || '-'],
        ['Nama Peminjam',   '{{ $borrowing->user->name ?? "-" }}'],
        ['Tanggal Pinjam',  '{{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam ?? $borrowing->created_at)->format("d M Y") }}'],
        ['Batas Kembali',   '{{ $borrowing->due_date ? \Carbon\Carbon::parse($borrowing->due_date)->format("d M Y") : "-" }}'],
        ['Dikembalikan',    '{{ $borrowing->returned_at ? \Carbon\Carbon::parse($borrowing->returned_at)->format("d M Y") : "Belum dikembalikan" }}'],
        ['Status',          '{{ ucfirst($borrowing->status) }}'],
    ];

    var boxX=14, boxY=52, boxW=pw-28;
    var labelX=boxX+8, colonX=labelX+48, valueX=colonX+6, rowH=15;
    var maxVW=pw-valueX-16;

    var rendered = fields.map(function(f){
        var lines = doc.splitTextToSize(f[1], maxVW);
        var h = Math.max(rowH, lines.length*6+8);
        return {label:f[0], lines:lines, h:h};
    });
    var totalH = rendered.reduce(function(s,r){return s+r.h;}, 10);

    doc.setFillColor(254,242,242);
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
    var statusText = '{{ strtoupper($borrowing->status) }}';
    var sl = statusText.toLowerCase();
    var bc = sl==='returned'||sl==='dikembalikan' ? [22,163,74] :
             sl==='rejected'||sl==='ditolak'      ? [225,29,72] :
             sl==='pending'                        ? [217,119,6] : [22,163,74];
    var by = boxY + totalH + 12;
    doc.setFillColor(bc[0],bc[1],bc[2]);
    doc.roundedRect(pw/2-35, by, 70, 11, 3,3,'F');
    doc.setFont('helvetica','bold'); doc.setFontSize(9); doc.setTextColor(255,255,255);
    doc.text(statusText, pw/2, by+7.5, {align:'center'});

    // Footer
    var fy = doc.internal.pageSize.getHeight()-16;
    doc.setDrawColor(200,200,200); doc.setLineWidth(0.3);
    doc.line(14, fy-4, pw-14, fy-4);
    doc.setFontSize(8); doc.setFont('helvetica','italic'); doc.setTextColor(150,150,150);
    doc.text('Dokumen diterbitkan otomatis oleh sistem PerpusInd.', pw/2, fy, {align:'center'});
    doc.text('Dicetak: '+new Date().toLocaleDateString('id-ID',{day:'2-digit',month:'long',year:'numeric'}), pw/2, fy+6, {align:'center'});

    doc.save('Detail_Peminjaman_{{ str_pad($borrowing->id, 5, "0", STR_PAD_LEFT) }}.pdf');
}
</script>
</body>
</html>
