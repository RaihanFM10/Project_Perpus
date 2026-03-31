<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya | PerpusInd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
@keyframes shimmer { 0%{background-position:-200% 0} 100%{background-position:200% 0} }

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

@media(max-width:1024px){ .profile-grid{grid-template-columns:1fr;} .card-full{grid-column:auto;} }
@media(max-width:768px){
    .mob-topbar{display:flex;} .sidebar{position:fixed;left:0;top:0;transform:translateX(-100%);}
    .sidebar.open{transform:translateX(0);box-shadow:8px 0 40px rgba(0,0,0,.12);}
    main{padding:24px 18px;} body{flex-direction:column;}
    .hero-inner{padding:28px 24px; flex-direction:column; text-align:center; gap:16px;}
    .hero-avatar-lg { margin:0 auto; }
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
.hero-inner { position:relative; z-index:1; display:flex; align-items:center; gap:24px; padding:30px 36px; }

.hero-avatar-lg {
    width:80px; height:80px; border-radius:50%; flex-shrink:0;
    background:rgba(255,255,255,.15);
    border:2.5px solid rgba(255,220,220,.35);
    display:flex; align-items:center; justify-content:center;
    font-family:var(--fdisp); font-size:30px; font-weight:800; color:#fff;
    backdrop-filter:blur(10px);
    box-shadow:0 6px 24px rgba(0,0,0,.2);
}

.hero-info { flex:1; }
.hero-badge { display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2); padding:4px 12px; border-radius:999px; font-size:11px; font-weight:600; color:rgba(255,255,255,.85); letter-spacing:.04em; margin-bottom:10px; }
.hero-name { font-family:var(--fdisp); font-size:26px; font-weight:800; color:#fff; line-height:1.1; letter-spacing:-.02em; margin-bottom:5px; }
.hero-email { font-size:13px; color:rgba(255,220,220,.7); display:flex; align-items:center; gap:6px; }

/* ─── SECTION TITLE ─── */
.sec-hd { margin-bottom:18px; }
.sec-title { font-family:var(--fdisp); font-size:18px; font-weight:800; color:var(--g900); position:relative; padding-left:14px; }
.sec-title::before { content:''; position:absolute; left:0; top:10%; bottom:10%; width:4px; border-radius:2px; background:linear-gradient(to bottom,var(--red-dk),var(--red)); }
.sec-sub { font-size:13px; color:var(--g400); padding-left:14px; margin-top:3px; }

/* ─── PROFILE GRID ─── */
.profile-grid { display:grid; grid-template-columns:1fr 1fr; gap:18px; }
.card-full { grid-column:1 / -1; }

/* ─── CARD BASE ─── */
.card {
    background:#fff; border-radius:20px; border:1.5px solid var(--g200);
    overflow:hidden; box-shadow:var(--sh-sm);
    transition:box-shadow .22s,border-color .22s;
}
.card:hover { box-shadow:var(--sh-md); border-color:var(--red-sf); }

/* Card accent top stripe */
.card-red   { border-top:3.5px solid var(--red); }
.card-slate { border-top:3.5px solid #64748b; }
.card-rose  { border-top:3.5px solid var(--rose); }

.card-hd {
    padding:18px 24px; border-bottom:1px solid var(--g100);
    display:flex; align-items:center; gap:12px;
    background:var(--g50);
}
.card-hd-ico { width:38px; height:38px; border-radius:11px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:15px; }
.ico-red   { background:var(--red-pl);  color:var(--red); }
.ico-slate { background:var(--g100);    color:var(--g700); }
.ico-rose  { background:var(--rose-bg); color:var(--rose); }

.card-hd-title { font-family:var(--fdisp); font-size:15px; font-weight:800; color:var(--g900); margin-bottom:2px; }
.card-hd-sub   { font-size:11.5px; color:var(--g400); }

.card-body { padding:22px 24px; }

/* ─── ALERT ─── */
.alert-ok {
    display:flex; align-items:center; gap:10px;
    padding:11px 14px; border-radius:10px;
    background:var(--green-bg); border:1.5px solid #bbf7d0;
    font-size:13px; font-weight:600; color:#14532d;
    margin-bottom:18px;
}

/* ─── FORM ─── */
.field-group { margin-bottom:16px; }
.field-label { display:block; font-size:11.5px; font-weight:700; color:var(--g700); margin-bottom:6px; text-transform:uppercase; letter-spacing:.06em; }
.field-input {
    width:100%; padding:10px 14px;
    border:1.5px solid var(--g200); border-radius:10px;
    font-size:14px; font-family:var(--font); color:var(--g900);
    background:#fff; outline:none; transition:border-color .2s,box-shadow .2s;
}
.field-input:focus { border-color:var(--red); box-shadow:0 0 0 3px rgba(224,30,44,.1); }
.field-input::placeholder { color:var(--g400); }
.field-error { font-size:12px; color:var(--rose); margin-top:4px; }

/* ─── EMAIL NOTICE ─── */
.email-notice {
    display:flex; align-items:flex-start; gap:9px;
    background:var(--amber-bg); border:1.5px solid #fde68a;
    border-radius:10px; padding:11px 14px;
    font-size:12.5px; color:#92400e; margin-top:14px; line-height:1.5;
}
.email-notice i { color:var(--amber); flex-shrink:0; margin-top:1px; }

/* ─── BUTTONS ─── */
.btn-primary {
    display:inline-flex; align-items:center; gap:7px;
    padding:10px 20px;
    background:linear-gradient(135deg,var(--red-dp),var(--red));
    color:#fff; border:none; border-radius:10px;
    font-size:13px; font-weight:700;
    cursor:pointer; transition:all .2s;
    box-shadow:0 3px 12px rgba(224,30,44,.3);
}
.btn-primary:hover { transform:translateY(-2px); box-shadow:0 7px 20px rgba(224,30,44,.4); }

.btn-danger {
    display:inline-flex; align-items:center; gap:7px;
    padding:10px 20px;
    background:var(--rose); color:#fff;
    border:none; border-radius:10px;
    font-size:13px; font-weight:700;
    cursor:pointer; transition:all .2s;
    box-shadow:0 3px 12px rgba(225,29,72,.25);
}
.btn-danger:hover { background:#be123c; transform:translateY(-1px); box-shadow:0 7px 20px rgba(225,29,72,.35); }

.btn-outline {
    display:inline-flex; align-items:center; gap:7px;
    padding:9px 18px; background:#fff;
    color:var(--g500); border:1.5px solid var(--g200);
    border-radius:10px; font-size:13px; font-weight:700;
    cursor:pointer; transition:all .15s;
}
.btn-outline:hover { border-color:var(--red-sf); background:var(--red-pl); color:var(--red); }

/* ─── DANGER ZONE ─── */
.danger-box {
    background:var(--red-pl); border:1.5px solid var(--red-sf);
    border-radius:14px; padding:18px 20px;
    display:flex; align-items:flex-start; justify-content:space-between; gap:20px; flex-wrap:wrap;
}
.danger-box p { font-size:13px; color:var(--red-dp); line-height:1.7; flex:1; min-width:200px; }

/* ─── MODAL ─── */
.modal-overlay {
    position:fixed; inset:0; background:rgba(11,17,32,.6);
    backdrop-filter:blur(6px); z-index:1000;
    display:none; align-items:center; justify-content:center;
}
.modal-overlay.open { display:flex; }
.modal-box {
    background:#fff; border-radius:22px; padding:36px;
    max-width:440px; width:90%;
    box-shadow:0 24px 80px rgba(0,0,0,.2);
    animation:fadeUp .35s cubic-bezier(.22,1,.36,1) both;
    border-top:4px solid var(--rose);
}
.modal-ico { width:50px; height:50px; background:var(--rose-bg); border:1.5px solid #fda4af; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-bottom:16px; }
.modal-ico i { color:var(--rose); font-size:20px; }
.modal-title { font-family:var(--fdisp); font-size:20px; font-weight:800; color:var(--g900); margin-bottom:8px; }
.modal-desc  { font-size:13px; color:var(--g500); line-height:1.7; margin-bottom:22px; }

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
        <a href="{{ route('user.borrowing.index') }}" class="sb-link">
            <span class="sb-icon"><i class="fas fa-clock-rotate-left"></i></span> Riwayat Peminjaman
        </a>
        <div class="sb-group-label">Akun</div>
        <a href="{{ url('/profile') }}" class="sb-link active">
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
        <span class="cur">Profil Saya</span>
    </div>

    <!-- HERO / PROFILE BANNER -->
    <div class="hero au d1">
        <div class="hero-deco hero-deco-1"></div>
        <div class="hero-deco hero-deco-2"></div>
        <div class="hero-inner">
            <div class="hero-avatar-lg">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="hero-info">
                <div class="hero-badge">
                    <i class="fas fa-circle-check" style="font-size:9px;"></i> Anggota Aktif
                </div>
                <h2 class="hero-name">{{ auth()->user()->name ?? 'Pengguna' }}</h2>
                <p class="hero-email">
                    <i class="fas fa-envelope" style="font-size:11px; opacity:.7;"></i>
                    {{ auth()->user()->email ?? '' }}
                </p>
            </div>
        </div>
    </div>

    <!-- SECTION HEADER -->
    <div class="sec-hd au d2">
        <div class="sec-title">Pengaturan Akun</div>
        <p class="sec-sub">Kelola informasi profil dan keamanan akun Anda</p>
    </div>

    <!-- CARDS GRID -->
    <div class="profile-grid">

        <!-- ── 1. Informasi Profil ── -->
        <div class="card card-red au d2">
            <div class="card-hd">
                <div class="card-hd-ico ico-red"><i class="fas fa-user"></i></div>
                <div>
                    <div class="card-hd-title">Informasi Profil</div>
                    <div class="card-hd-sub">Perbarui nama dan alamat email</div>
                </div>
            </div>
            <div class="card-body">

                @if(session('status') === 'profile-updated')
                    <div class="alert-ok">
                        <i class="fas fa-circle-check"></i> Profil berhasil diperbarui.
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="field-group">
                        <label for="name" class="field-label">Nama Lengkap</label>
                        <input id="name" name="name" type="text" class="field-input"
                               value="{{ old('name', $user->name) }}" required autofocus>
                        @error('name') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field-group" style="margin-bottom:0;">
                        <label for="email" class="field-label">Alamat Email</label>
                        <input id="email" name="email" type="email" class="field-input"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div class="email-notice">
                            <i class="fas fa-triangle-exclamation"></i>
                            <span>Email belum diverifikasi.
                                <form method="POST" action="{{ route('verification.send') }}" style="display:inline; margin:0;">
                                    @csrf
                                    <button type="submit" style="background:none; border:none; color:var(--red); font-weight:700; cursor:pointer; font-family:var(--font); font-size:12.5px; padding:0;">
                                        Kirim ulang
                                    </button>
                                </form>
                            </span>
                        </div>
                    @endif

                    <div style="display:flex; justify-content:flex-end; margin-top:20px;">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-check" style="font-size:11px;"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ── 2. Ubah Password ── -->
        <div class="card card-slate au d3">
            <div class="card-hd">
                <div class="card-hd-ico ico-slate"><i class="fas fa-lock"></i></div>
                <div>
                    <div class="card-hd-title">Ubah Password</div>
                    <div class="card-hd-sub">Gunakan password yang kuat dan unik</div>
                </div>
            </div>
            <div class="card-body">

                @if(session('status') === 'password-updated')
                    <div class="alert-ok">
                        <i class="fas fa-circle-check"></i> Password berhasil diperbarui.
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="field-group">
                        <label for="current_password" class="field-label">Password Saat Ini</label>
                        <input id="current_password" name="current_password" type="password"
                               class="field-input" autocomplete="current-password" placeholder="••••••••">
                        @error('current_password', 'updatePassword')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="password" class="field-label">Password Baru</label>
                        <input id="password" name="password" type="password"
                               class="field-input" autocomplete="new-password" placeholder="••••••••">
                        @error('password', 'updatePassword')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field-group" style="margin-bottom:0;">
                        <label for="password_confirmation" class="field-label">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               class="field-input" autocomplete="new-password" placeholder="••••••••">
                        @error('password_confirmation', 'updatePassword')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display:flex; justify-content:flex-end; margin-top:20px;">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-shield-halved" style="font-size:11px;"></i> Simpan Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ── 3. Hapus Akun ── -->
        <div class="card card-rose card-full au d4">
            <div class="card-hd">
                <div class="card-hd-ico ico-rose"><i class="fas fa-trash-can"></i></div>
                <div>
                    <div class="card-hd-title" style="color:var(--rose);">Hapus Akun</div>
                    <div class="card-hd-sub">Tindakan ini permanen dan tidak dapat dibatalkan</div>
                </div>
            </div>
            <div class="card-body">
                <div class="danger-box">
                    <p>Setelah akun Anda dihapus, semua data dan resource terkait akan hilang secara permanen. Pastikan Anda telah mengunduh semua data penting sebelum melanjutkan.</p>
                    <button type="button" class="btn-danger"
                            onclick="document.getElementById('deleteModal').classList.add('open')">
                        <i class="fas fa-trash-can" style="font-size:11px;"></i>
                        Hapus Akun Saya
                    </button>
                </div>
            </div>
        </div>
    </div><!-- end .profile-grid -->
</main>


<!-- ─── DELETE MODAL ─── -->
<div id="deleteModal" class="modal-overlay" onclick="if(event.target===this)this.classList.remove('open')">
    <div class="modal-box">
        <div class="modal-ico">
            <i class="fas fa-triangle-exclamation"></i>
        </div>
        <div class="modal-title">Yakin ingin menghapus akun?</div>
        <p class="modal-desc">
            Setelah akun dihapus, semua data akan hilang secara permanen. Masukkan password Anda untuk mengonfirmasi tindakan ini.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <div class="field-group" style="margin-bottom:20px;">
                <label for="modal_password" class="field-label">Password</label>
                <input id="modal_password" name="password" type="password"
                       class="field-input" placeholder="Masukkan password Anda">
                @error('password', 'userDeletion')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div style="display:flex; gap:10px; justify-content:flex-end;">
                <button type="button" class="btn-outline"
                        onclick="document.getElementById('deleteModal').classList.remove('open')">
                    Batal
                </button>
                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash-can" style="font-size:11px;"></i>
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </div>
</div>


<script>
// ── SIDEBAR MOBILE ──────────────────────────────────
(function(){
    var sidebar=document.getElementById('sidebar'),overlay=document.getElementById('sbOverlay'),hamBtn=document.getElementById('hamBtn');
    function openSB(){sidebar.classList.add('open');overlay.classList.add('show');if(hamBtn)hamBtn.setAttribute('aria-expanded','true');var s=hamBtn?hamBtn.querySelectorAll('span'):[];if(s[0])s[0].style.transform='rotate(45deg) translate(5px,5px)';if(s[1])s[1].style.opacity='0';if(s[2])s[2].style.transform='rotate(-45deg) translate(5px,-5px)';}
    function closeSB(){sidebar.classList.remove('open');overlay.classList.remove('show');if(hamBtn)hamBtn.setAttribute('aria-expanded','false');var s=hamBtn?hamBtn.querySelectorAll('span'):[];s.forEach(function(x){x.style.transform='';x.style.opacity='';});}
    if(hamBtn)hamBtn.addEventListener('click',function(){sidebar.classList.contains('open')?closeSB():openSB();});
    if(overlay)overlay.addEventListener('click',closeSB);
})();
</script>
</body>
</html>
