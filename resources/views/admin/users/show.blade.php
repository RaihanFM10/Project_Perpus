<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail User | Admin</title>
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
        @keyframes slideIn  { from { opacity: 0; transform: translateX(-10px); } to { opacity: 1; transform: none; } }
        .au { animation: fadeUp .5s ease both; }
        .d1 { animation-delay: .05s; } .d2 { animation-delay: .12s; }
        .d3 { animation-delay: .19s; } .d4 { animation-delay: .26s; }
        .d5 { animation-delay: .33s; }

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
            .detail-grid { grid-template-columns: 1fr !important; }
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

        /* ── DETAIL GRID ── */
        .detail-grid { display: grid; grid-template-columns: 280px 1fr; gap: 18px; align-items: start; }

        /* ── PROFILE CARD (left) ── */
        .profile-card { background: #fff; border: 1px solid var(--gray-200); border-radius: 16px; overflow: hidden; }
        .profile-banner { background: var(--red); padding: 24px 18px 44px; text-align: center; position: relative; overflow: hidden; }
        .big-avatar {
            width: 68px; height: 68px; border-radius: 50%;
            background: rgba(255,255,255,.2); border: 3px solid rgba(255,255,255,.45);
            display: inline-flex; align-items: center; justify-content: center;
            color: #fff; font-size: 26px; font-weight: 800;
            margin-bottom: 11px; box-shadow: 0 6px 20px rgba(0,0,0,.18);
        }
        .pc-name  { font-size: 15px; font-weight: 800; color: #fff; }
        .pc-email { font-size: 11.5px; color: rgba(255,255,255,.75); margin-top: 3px; }

        .profile-body { padding: 0 18px 18px; margin-top: -20px; }
        .role-chip {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 13px; border-radius: 999px;
            font-size: 11.5px; font-weight: 700;
            background: #fff; border: 1.5px solid var(--gray-200);
            box-shadow: 0 2px 8px rgba(0,0,0,.07);
            margin-bottom: 16px;
        }
        .rc-admin   { color: var(--red);    border-color: rgba(220,38,38,.25); }
        .rc-petugas { color: var(--green);  border-color: rgba(22,163,74,.25); }
        .rc-user    { color: var(--violet); border-color: rgba(124,58,237,.25); }

        .pc-divider { height: 1px; background: var(--gray-100); margin-bottom: 14px; }

        .qs-item { display: flex; align-items: center; gap: 9px; padding: 10px 12px; border-radius: 10px; background: var(--gray-50); border: 1px solid var(--gray-100); margin-bottom: 7px; transition: transform .15s; }
        .qs-item:last-child { margin-bottom: 0; }
        .qs-item:hover { transform: translateY(-1px); }
        .qs-ico { width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 12px; }
        .qs-lbl { font-size: 10px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .04em; margin-bottom: 1px; }
        .qs-val { font-size: 12.5px; font-weight: 700; color: var(--gray-900); }

        /* ── INFO CARD (right) ── */
        .info-card { background: #fff; border: 1px solid var(--gray-200); border-radius: 16px; overflow: hidden; }
        .info-card-hd { padding: 16px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; }
        .ic-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; background: var(--red-bg); display: flex; align-items: center; justify-content: center; font-size: 14px; color: var(--red); }
        .ic-hd-title { font-size: 14px; font-weight: 700; }
        .ic-hd-sub { font-size: 12px; color: var(--gray-400); margin-top: 2px; }

        .info-row { display: flex; align-items: center; gap: 12px; padding: 14px 22px; border-bottom: 1px solid var(--gray-50); transition: background .12s; animation: slideIn .4s ease both; }
        .info-row:last-of-type { border-bottom: none; }
        .info-row:hover { background: var(--red-bg); }

        .ir-ico { width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 13px; }
        .ir-label { flex: 0 0 140px; font-size: 11px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .05em; }
        .ir-value { flex: 1; font-size: 13px; font-weight: 700; color: var(--gray-900); text-align: right; }
        .ir-value.muted { font-weight: 500; color: var(--gray-500); }

        .id-pill { font-family: 'Courier New', monospace; font-size: 12px; font-weight: 700; background: var(--gray-50); border: 1px solid var(--gray-200); padding: 3px 9px; border-radius: 6px; color: var(--red-dk); }

        .role-badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; }
        .rb-admin   { background: var(--red-bg);    color: var(--red);    border: 1px solid rgba(220,38,38,.18); }
        .rb-petugas { background: var(--green-bg);  color: var(--green);  border: 1px solid rgba(22,163,74,.2); }
        .rb-user    { background: var(--violet-bg); color: var(--violet); border: 1px solid rgba(124,58,237,.18); }

        /* Footer */
        .card-footer { padding: 16px 22px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; align-items: center; gap: 9px; flex-wrap: wrap; }

        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 9px; font-size: 13px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; text-decoration: none; transition: transform .2s ease; }
        .btn:hover { transform: translateY(-1px); }
        .btn-edit   { background: var(--amber-bg); color: var(--amber); }
        .btn-edit:hover { background: #FDE68A; }
        .btn-delete { background: var(--red-bg); color: var(--red); }
        .btn-delete:hover { background: var(--red-sf); }
        .btn-back { background: #fff; color: var(--gray-700); border: 1.5px solid var(--gray-200); margin-left: auto; }
        .btn-back:hover { background: var(--gray-50); }
        .btn-locked { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 9px; font-size: 13px; font-weight: 700; background: var(--gray-100); color: var(--gray-400); border: 1.5px solid var(--gray-200); cursor: not-allowed; }

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
            <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="sb-uname">{{ auth()->user()->name }}</div>
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
        <a href="{{ route('admin.users') }}"><i class="fas fa-users"></i> Manajemen User</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Detail User</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Admin Panel</div>
        <h1 class="ph-title">Detail <span>User</span></h1>
        <p class="ph-desc">Informasi lengkap akun pengguna terdaftar</p>
    </div>

    <div class="detail-grid">

        {{-- LEFT: Profile Card --}}
        <div class="profile-card au d2">
            <div class="profile-banner">
                <div class="big-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                <div class="pc-name">{{ $user->name }}</div>
                <div class="pc-email">{{ $user->email }}</div>
            </div>

            <div class="profile-body">
                <div style="display:flex;justify-content:center;margin-bottom:14px;">
                    @if($user->role === 'admin')
                        <span class="role-chip rc-admin"><i class="fas fa-shield-alt" style="font-size:10px;"></i> Admin</span>
                    @elseif($user->role === 'petugas')
                        <span class="role-chip rc-petugas"><i class="fas fa-user-check" style="font-size:10px;"></i> Petugas</span>
                    @else
                        <span class="role-chip rc-user"><i class="fas fa-user" style="font-size:10px;"></i> {{ ucfirst($user->role) }}</span>
                    @endif
                </div>

                <div class="pc-divider"></div>

                <div class="qs-item">
                    <div class="qs-ico" style="background:var(--red-bg);"><i class="fas fa-hashtag" style="color:var(--red);"></i></div>
                    <div>
                        <div class="qs-lbl">User ID</div>
                        <div class="qs-val" style="font-family:'Courier New',monospace;color:var(--red-dk);">#{{ $user->id }}</div>
                    </div>
                </div>

                <div class="qs-item">
                    <div class="qs-ico" style="background:var(--green-bg);"><i class="fas fa-calendar-plus" style="color:var(--green);"></i></div>
                    <div>
                        <div class="qs-lbl">Bergabung</div>
                        <div class="qs-val">{{ $user->created_at->format('d M Y') }}</div>
                    </div>
                </div>

                <div class="qs-item">
                    <div class="qs-ico" style="background:var(--sky-bg);"><i class="fas fa-shield-alt" style="color:var(--sky);"></i></div>
                    <div>
                        <div class="qs-lbl">Akses</div>
                        <div class="qs-val">
                            @if($user->role === 'admin') Administrator
                            @elseif($user->role === 'petugas') Petugas Perpustakaan
                            @else Pengguna Umum
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT: Info Card --}}
        <div class="info-card au d3">
            <div class="info-card-hd">
                <div class="ic-hd-icon"><i class="fas fa-id-card"></i></div>
                <div>
                    <div class="ic-hd-title">Informasi Akun</div>
                    <div class="ic-hd-sub">Data lengkap pengguna sistem perpustakaan</div>
                </div>
            </div>

            <div class="info-row">
                <div class="ir-ico" style="background:var(--red-bg);"><i class="fas fa-hashtag" style="color:var(--red);"></i></div>
                <div class="ir-label">User ID</div>
                <div class="ir-value"><span class="id-pill">#{{ $user->id }}</span></div>
            </div>

            <div class="info-row">
                <div class="ir-ico" style="background:var(--green-bg);"><i class="fas fa-user" style="color:var(--green);"></i></div>
                <div class="ir-label">Nama Lengkap</div>
                <div class="ir-value">{{ $user->name }}</div>
            </div>

            <div class="info-row">
                <div class="ir-ico" style="background:var(--sky-bg);"><i class="fas fa-envelope" style="color:var(--sky);"></i></div>
                <div class="ir-label">Email</div>
                <div class="ir-value muted">{{ $user->email }}</div>
            </div>

            <div class="info-row">
                <div class="ir-ico" style="background:var(--violet-bg);"><i class="fas fa-shield-alt" style="color:var(--violet);"></i></div>
                <div class="ir-label">Role</div>
                <div class="ir-value">
                    @if($user->role === 'admin')
                        <span class="role-badge rb-admin"><i class="fas fa-shield-alt" style="font-size:9px;"></i> Admin</span>
                    @elseif($user->role === 'petugas')
                        <span class="role-badge rb-petugas"><i class="fas fa-user-check" style="font-size:9px;"></i> Petugas</span>
                    @else
                        <span class="role-badge rb-user"><i class="fas fa-user" style="font-size:9px;"></i> {{ ucfirst($user->role) }}</span>
                    @endif
                </div>
            </div>

            <div class="info-row">
                <div class="ir-ico" style="background:var(--amber-bg);"><i class="fas fa-calendar-plus" style="color:var(--amber);"></i></div>
                <div class="ir-label">Tanggal Dibuat</div>
                <div class="ir-value muted">{{ $user->created_at->format('d M Y, H:i') }} WIB</div>
            </div>

            <div class="card-footer">
                @if($user->role === 'petugas')
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit">
                        <i class="fas fa-pen"></i> Edit Akun
                    </a>
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline"
                          onsubmit="return confirm('Yakin ingin menghapus akun {{ $user->name }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-delete"><i class="fas fa-trash-alt"></i> Hapus</button>
                    </form>
                @elseif($user->role === 'admin')
                    <span class="btn-locked"><i class="fas fa-lock"></i> Terkunci</span>
                @endif
                <a href="{{ route('admin.users') }}" class="btn btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
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

    document.querySelectorAll('.info-row').forEach(function (row, i) {
        row.style.animationDelay = (0.05 + i * 0.07) + 's';
    });
})();
</script>
</body>
</html>
