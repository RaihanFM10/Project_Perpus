<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengembalian Buku | PerpusInd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

@media(max-width:1024px){ .return-grid{grid-template-columns:1fr;} }
@media(max-width:768px){
    .mob-topbar{display:flex;} .sidebar{position:fixed;left:0;top:0;transform:translateX(-100%);}
    .sidebar.open{transform:translateX(0);box-shadow:8px 0 40px rgba(0,0,0,.12);}
    main{padding:24px 18px;} body{flex-direction:column;}
    .hero-illus{display:none;} .hero-inner{padding:28px 24px;}
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
.hero-inner { position:relative; z-index:1; display:flex; align-items:center; justify-content:space-between; padding:30px 36px; }
.hero-badge { display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2); padding:4px 12px; border-radius:999px; font-size:11px; font-weight:600; color:rgba(255,255,255,.85); letter-spacing:.04em; margin-bottom:12px; }
.hero-ph-label { font-size:11.5px; font-weight:600; color:rgba(255,200,200,.75); letter-spacing:.08em; text-transform:uppercase; margin-bottom:6px; }
.hero-title { font-family:var(--fdisp); font-size:28px; font-weight:800; color:#fff; line-height:1.1; letter-spacing:-.02em; margin-bottom:6px; }
.hero-sub   { font-size:13px; color:rgba(255,220,220,.7); }
.hero-illus { position:relative; z-index:1; flex-shrink:0; }
.hero-icon-wrap { width:80px; height:80px; border-radius:22px; background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.18); display:flex; align-items:center; justify-content:center; backdrop-filter:blur(10px); box-shadow:0 8px 28px rgba(0,0,0,.15); }
.hero-icon-wrap i { font-size:34px; color:rgba(255,220,220,.85); }

/* ─── SECTION TITLE ─── */
.sec-hd { margin-bottom:16px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
.sec-title { font-family:var(--fdisp); font-size:18px; font-weight:800; color:var(--g900); position:relative; padding-left:14px; }
.sec-title::before { content:''; position:absolute; left:0; top:10%; bottom:10%; width:4px; border-radius:2px; background:linear-gradient(to bottom,var(--red-dk),var(--red)); }
.sec-sub { font-size:13px; color:var(--g400); padding-left:14px; margin-top:3px; }

/* ─── RETURN GRID ─── */
.return-grid { display:grid; grid-template-columns:1fr 320px; gap:18px; align-items:start; }

/* ─── CARD BASE ─── */
.card { background:#fff; border-radius:20px; border:1.5px solid var(--g200); overflow:hidden; box-shadow:var(--sh-sm); transition:box-shadow .22s,border-color .22s; }
.card:hover { box-shadow:var(--sh-md); border-color:var(--red-sf); }

.card-hd { padding:18px 22px; border-bottom:1px solid var(--g100); display:flex; align-items:center; gap:12px; }
.card-hd-ico { width:38px; height:38px; border-radius:11px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:15px; }
.ico-red   { background:var(--red-pl);   color:var(--red); }
.ico-green { background:var(--green-bg); color:var(--green); }
.ico-amber { background:var(--amber-bg); color:var(--amber); }

.card-hd-main { flex:1; }
.card-hd-title { font-family:var(--fdisp); font-size:15px; font-weight:800; color:var(--g900); margin-bottom:2px; }
.card-hd-sub   { font-size:11.5px; color:var(--g400); }

/* ─── DETAIL ROWS ─── */
.detail-body { padding:8px 22px 20px; }

.detail-row {
    display:flex; align-items:center; justify-content:space-between;
    padding:13px 0; border-bottom:1px solid var(--g100);
}
.detail-row:last-child { border-bottom:none; }

.detail-lbl {
    display:flex; align-items:center; gap:9px;
    font-size:13px; color:var(--g500); font-weight:500;
}
.detail-lbl-ico {
    width:28px; height:28px; border-radius:8px;
    background:var(--red-pl); display:flex; align-items:center; justify-content:center;
    flex-shrink:0;
}
.detail-lbl-ico i { color:var(--red); font-size:10px; }

.detail-val {
    font-size:13.5px; font-weight:700; color:var(--g900);
    text-align:right; max-width:55%;
}

/* Status badge */
.status-chip {
    display:inline-flex; align-items:center; gap:6px;
    padding:5px 12px; border-radius:999px;
    font-size:11.5px; font-weight:700;
    background:var(--green-bg); color:var(--green);
    border:1px solid #bbf7d0;
}
.pulse-dot { width:6px; height:6px; border-radius:50%; background:currentColor; flex-shrink:0; }
.pulse-dot.anim { animation:pulse 1.5s infinite; }

/* ─── ACTION CARD ─── */
.action-body { padding:22px; }

.warning-note {
    display:flex; align-items:flex-start; gap:10px;
    background:var(--amber-bg); border:1.5px solid #fde68a;
    border-radius:12px; padding:13px 15px; margin-bottom:20px;
}
.warning-note-ico { width:28px; height:28px; background:#fef3c7; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.warning-note-ico i { color:var(--amber); font-size:12px; }
.warning-note p { font-size:12.5px; color:#92400e; margin:0; line-height:1.55; }

.btn-return {
    display:flex; align-items:center; justify-content:center; gap:9px;
    width:100%; padding:14px 20px;
    background:linear-gradient(135deg,var(--red-dp),var(--red));
    color:#fff; border:none; border-radius:12px;
    font-size:14px; font-weight:700;
    cursor:pointer; transition:all .2s;
    box-shadow:0 4px 16px rgba(224,30,44,.35);
    margin-bottom:10px;
}
.btn-return:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(224,30,44,.45); }

.btn-back-card {
    display:flex; align-items:center; justify-content:center; gap:7px;
    width:100%; padding:11px 16px; background:#fff;
    border:1.5px solid var(--g200); border-radius:10px;
    font-size:13px; font-weight:700; color:var(--g500);
    cursor:pointer; transition:all .15s;
}
.btn-back-card:hover { border-color:var(--red-sf); background:var(--red-pl); color:var(--red); }

/* ─── CHECKLIST ─── */
.checklist { margin-bottom:20px; }
.checklist-title { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:var(--g400); margin-bottom:10px; }
.check-item {
    display:flex; align-items:center; gap:10px;
    padding:9px 12px; border-radius:10px;
    background:var(--g50); border:1.5px solid var(--g200);
    margin-bottom:7px; cursor:pointer; transition:all .15s;
}
.check-item:last-child { margin-bottom:0; }
.check-item:hover { border-color:var(--green-bg); background:var(--green-bg); }
.check-item input[type=checkbox] { accent-color:var(--green); width:15px; height:15px; flex-shrink:0; }
.check-item label { font-size:12.5px; font-weight:600; color:var(--g700); cursor:pointer; }

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
        <a href="{{ route('user.books') }}" class="sb-link active">
            <span class="sb-icon"><i class="fas fa-book"></i></span> Katalog Buku
        </a>
        <a href="{{ route('user.favorites') }}" class="sb-link">
            <span class="sb-icon"><i class="fas fa-heart"></i></span> Buku Favorit
        </a>
        <a href="{{ route('user.borrowing.index') }}" class="sb-link">
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
        <a href="{{ route('user.books') }}">Katalog Buku</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="cur">Pengembalian Buku</span>
    </div>

    <!-- HERO -->
    <div class="hero au d1">
        <div class="hero-deco hero-deco-1"></div>
        <div class="hero-deco hero-deco-2"></div>
        <div class="hero-inner">
            <div>
                <div class="hero-badge"><i class="fas fa-rotate-left" style="font-size:9px;"></i> Proses Pengembalian</div>
                <p class="hero-ph-label">Kembalikan Buku</p>
                <h2 class="hero-title">Pengembalian <span style="font-style:italic;">Buku</span></h2>
                <p class="hero-sub">Pastikan buku dalam kondisi baik sebelum dikembalikan</p>
            </div>
            <div class="hero-illus">
                <div class="hero-icon-wrap">
                    <i class="fas fa-rotate-left"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION HEADER -->
    <div class="sec-hd au d2">
        <div>
            <div class="sec-title">Detail Pengembalian</div>
            <p class="sec-sub">Periksa informasi buku sebelum mengonfirmasi pengembalian</p>
        </div>
        <a href="{{ route('user.books') }}"
           style="display:inline-flex; align-items:center; gap:7px; padding:9px 16px; border:1.5px solid var(--g200); border-radius:10px; font-size:13px; font-weight:600; color:var(--g500); background:#fff; transition:border-color .15s,color .15s;"
           onmouseover="this.style.borderColor='var(--red)';this.style.color='var(--red)'"
           onmouseout="this.style.borderColor='var(--g200)';this.style.color='var(--g500)'">
            <i class="fas fa-arrow-left" style="font-size:11px;"></i> Kembali ke Katalog
        </a>
    </div>

    <!-- RETURN GRID -->
    <div class="return-grid">

        <!-- BOOK DETAIL CARD -->
        <div class="card au d3">
            <div class="card-hd">
                <div class="card-hd-ico ico-red"><i class="fas fa-book"></i></div>
                <div class="card-hd-main">
                    <div class="card-hd-title">Detail Buku</div>
                    <div class="card-hd-sub">Informasi buku yang akan dikembalikan</div>
                </div>
            </div>

            <div class="detail-body">

                <div class="detail-row">
                    <div class="detail-lbl">
                        <div class="detail-lbl-ico"><i class="fas fa-book-open"></i></div>
                        Judul Buku
                    </div>
                    <span class="detail-val">{{ $borrowing->book->judul }}</span>
                </div>

                <div class="detail-row">
                    <div class="detail-lbl">
                        <div class="detail-lbl-ico"><i class="fas fa-user-pen"></i></div>
                        Penulis
                    </div>
                    <span class="detail-val">{{ $borrowing->book->penulis }}</span>
                </div>

                <div class="detail-row">
                    <div class="detail-lbl">
                        <div class="detail-lbl-ico"><i class="fas fa-user"></i></div>
                        Peminjam
                    </div>
                    <span class="detail-val">{{ $borrowing->user->name ?? auth()->user()->name }}</span>
                </div>

                <div class="detail-row">
                    <div class="detail-lbl">
                        <div class="detail-lbl-ico"><i class="fas fa-calendar-plus"></i></div>
                        Tanggal Pinjam
                    </div>
                    <span class="detail-val">
                        {{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam)->translatedFormat('d F Y') }}
                    </span>
                </div>

                @if($borrowing->due_date)
                <div class="detail-row">
                    <div class="detail-lbl">
                        <div class="detail-lbl-ico"><i class="fas fa-calendar-xmark"></i></div>
                        Batas Kembali
                    </div>
                    @php $daysLeft = \Carbon\Carbon::now()->diffInDays($borrowing->due_date, false); @endphp
                    <span class="detail-val" style="{{ $daysLeft < 0 ? 'color:var(--rose)' : '' }}">
                        {{ \Carbon\Carbon::parse($borrowing->due_date)->translatedFormat('d F Y') }}
                        @if($daysLeft < 0)
                            <span style="display:block; font-size:11px; color:var(--rose); font-weight:600; margin-top:2px;">
                                <i class="fas fa-circle-exclamation"></i> Terlambat {{ abs($daysLeft) }} hari
                            </span>
                        @endif
                    </span>
                </div>
                @endif

                <div class="detail-row">
                    <div class="detail-lbl">
                        <div class="detail-lbl-ico"><i class="fas fa-circle-check"></i></div>
                        Status
                    </div>
                    <div class="status-chip">
                        <span class="pulse-dot anim"></span>
                        Sedang Dipinjam
                    </div>
                </div>

            </div>
        </div>


        <!-- ACTION CARD -->
        <div class="card au d4">
            <div class="card-hd">
                <div class="card-hd-ico ico-red"><i class="fas fa-rotate-left"></i></div>
                <div class="card-hd-main">
                    <div class="card-hd-title">Kembalikan Buku</div>
                    <div class="card-hd-sub">Konfirmasi pengembalian buku</div>
                </div>
            </div>

            <div class="action-body">

                <!-- Checklist kondisi buku -->
                <div class="checklist">
                    <div class="checklist-title"><i class="fas fa-clipboard-check" style="margin-right:4px;"></i> Kondisi Buku</div>
                    <div class="check-item">
                        <input type="checkbox" id="c1">
                        <label for="c1">Buku dalam kondisi baik</label>
                    </div>
                    <div class="check-item">
                        <input type="checkbox" id="c2">
                        <label for="c2">Halaman lengkap, tidak robek</label>
                    </div>
                    <div class="check-item">
                        <input type="checkbox" id="c3">
                        <label for="c3">Sampul buku tidak rusak</label>
                    </div>
                </div>

                <!-- Warning note -->
                <div class="warning-note">
                    <div class="warning-note-ico">
                        <i class="fas fa-triangle-exclamation"></i>
                    </div>
                    <p>Pastikan semua kondisi buku telah diperiksa sebelum melakukan pengembalian.</p>
                </div>

                <button onclick="returnBook({{ $borrowing->id }})" class="btn-return">
                    <i class="fas fa-check"></i>
                    Kembalikan Sekarang
                </button>

                <a href="{{ route('user.books') }}" class="btn-back-card">
                    <i class="fas fa-arrow-left" style="font-size:11px;"></i>
                    Kembali ke Katalog
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

// ── RETURN BOOK ──────────────────────────────────────
function returnBook(id) {
    Swal.fire({
        title: '<strong style="font-family:\'Playfair Display\',serif; font-size:20px;">Kembalikan Buku?</strong>',
        html: '<p style="font-size:14px; color:#6B7280;">Buku akan dikembalikan ke perpustakaan.<br>Pastikan kondisi buku sudah diperiksa.</p>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-check"></i> Ya, kembalikan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#E01E2C',
        cancelButtonColor: '#E5E7EB',
        customClass: {
            cancelButton: 'swal-cancel-custom',
            popup: 'swal-popup-custom'
        },
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch("{{ route('user.borrow.return', $borrowing->id) }}", {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: '<strong style="font-family:\'Playfair Display\',serif;">Berhasil!</strong>',
                html: '<p style="font-size:14px; color:#6B7280;">Buku berhasil dikembalikan. Terima kasih!</p>',
                timer: 2000,
                showConfirmButton: false,
                confirmButtonColor: '#E01E2C',
            });
            setTimeout(() => {
                window.location.href = "{{ route('user.books') }}";
            }, 2000);
        }
    });
}
</script>
</body>
</html>
