<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Akun | Admin</title>
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
        .d1 { animation-delay: .05s; } .d2 { animation-delay: .12s; }
        .d3 { animation-delay: .19s; } .d4 { animation-delay: .26s; }

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
            .form-layout { grid-template-columns: 1fr !important; }
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

        /* ── FORM LAYOUT ── */
        .form-layout { display: grid; grid-template-columns: 1fr 268px; gap: 18px; align-items: start; }

        /* ── CARD ── */
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; }
        .card-hd { padding: 16px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .card-hd-title { font-size: 14px; font-weight: 700; }
        .card-hd-sub { font-size: 12px; color: var(--gray-400); margin-top: 2px; }
        .card-body { padding: 22px; display: flex; flex-direction: column; gap: 18px; }
        .card-footer { padding: 16px 22px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; align-items: center; gap: 9px; flex-wrap: wrap; }

        /* ── FORM FIELDS ── */
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-label { font-size: 11.5px; font-weight: 700; color: var(--gray-700); display: flex; align-items: center; gap: 6px; text-transform: uppercase; letter-spacing: .04em; }
        .lbl-icon { width: 20px; height: 20px; border-radius: 5px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 10px; }
        .req { color: var(--red); font-size: 13px; line-height: 1; }

        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 12px; pointer-events: none; transition: color .15s; }
        .input-wrap:focus-within .input-icon { color: var(--red); }

        .form-input,
        .form-select {
            width: 100%; padding: 10px 12px 10px 36px;
            border: 1.5px solid var(--gray-200); border-radius: 10px;
            font-size: 13px; font-family: inherit;
            color: var(--gray-900); background: #fff; outline: none;
            appearance: none;
            transition: border .15s, box-shadow .15s;
        }
        .form-input:focus,
        .form-select:focus { border-color: var(--red); box-shadow: 0 0 0 3px rgba(220,38,38,.1); }

        .select-wrap { position: relative; }
        .select-chevron { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 10px; pointer-events: none; }

        .pw-toggle { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--gray-400); cursor: pointer; font-size: 12px; padding: 2px; transition: color .15s; }
        .pw-toggle:hover { color: var(--red); }

        .field-hint  { font-size: 11px; color: var(--gray-400); display: flex; align-items: center; gap: 5px; }
        .field-error { display: flex; align-items: center; gap: 5px; font-size: 11.5px; color: var(--red); font-weight: 600; }

        /* ── BUTTONS ── */
        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 9px; font-size: 13px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; text-decoration: none; transition: transform .2s ease; }
        .btn:hover { transform: translateY(-1px); }
        .btn-save { background: var(--red); color: #fff; box-shadow: 0 3px 12px rgba(220,38,38,.3); }
        .btn-save:hover { background: var(--red-dk); }
        .btn-cancel { background: #fff; color: var(--gray-700); border: 1.5px solid var(--gray-200); }
        .btn-cancel:hover { background: var(--gray-50); }

        /* ── PREVIEW CARD (right) ── */
        .preview-banner { background: var(--red); padding: 24px 18px 44px; text-align: center; position: relative; overflow: hidden; }
        .preview-avatar {
            width: 64px; height: 64px; border-radius: 50%;
            background: rgba(255,255,255,.2); border: 3px solid rgba(255,255,255,.45);
            display: inline-flex; align-items: center; justify-content: center;
            color: #fff; font-size: 24px; font-weight: 800;
            margin-bottom: 10px; box-shadow: 0 5px 18px rgba(0,0,0,.18);
        }
        .preview-name  { font-size: 14px; font-weight: 800; color: #fff; word-break: break-word; }
        .preview-email { font-size: 11px; color: rgba(255,255,255,.75); margin-top: 3px; word-break: break-all; }

        .preview-body { padding: 0 16px 18px; margin-top: -20px; }
        .role-chip { display: inline-flex; align-items: center; gap: 5px; padding: 5px 13px; border-radius: 999px; font-size: 11.5px; font-weight: 700; background: #fff; border: 1.5px solid var(--gray-200); box-shadow: 0 2px 8px rgba(0,0,0,.07); margin-bottom: 14px; }
        .rc-petugas { color: var(--green); border-color: rgba(22,163,74,.25); }

        .mini-info { display: flex; align-items: center; gap: 8px; padding: 8px 11px; background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 9px; margin-bottom: 7px; }
        .mini-info:last-of-type { margin-bottom: 14px; }
        .mini-ico { width: 26px; height: 26px; border-radius: 6px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 10px; }
        .mini-lbl { font-size: 9.5px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .04em; margin-bottom: 1px; }
        .mini-val { font-size: 12px; font-weight: 700; color: var(--gray-900); }

        .preview-hint { font-size: 11px; color: var(--gray-400); text-align: center; padding-top: 12px; border-top: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: center; gap: 5px; }

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
        <span class="active">Tambah Akun</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Admin Panel</div>
        <h1 class="ph-title">Tambah <span>Akun</span></h1>
        <p class="ph-desc">Buat akun pengguna baru untuk sistem perpustakaan</p>
    </div>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="form-layout">

            {{-- LEFT: Form Card --}}
            <div class="card au d2">
                <div class="card-hd">
                    <div class="card-hd-icon" style="background:var(--green-bg);">
                        <i class="fas fa-user-plus" style="color:var(--green);"></i>
                    </div>
                    <div>
                        <div class="card-hd-title">Form Tambah Akun</div>
                        <div class="card-hd-sub">Isi semua field yang diperlukan</div>
                    </div>
                </div>

                <div class="card-body">

                    {{-- Nama --}}
                    <div class="form-group">
                        <label class="form-label" for="name">
                            <span class="lbl-icon" style="background:var(--green-bg);"><i class="fas fa-user" style="color:var(--green);"></i></span>
                            Nama Lengkap <span class="req">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-id-card input-icon"></i>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name') }}"
                                   class="form-input" required
                                   placeholder="Masukkan nama lengkap"
                                   oninput="updatePreview()"
                                   autofocus>
                        </div>
                        @error('name')
                            <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label class="form-label" for="email">
                            <span class="lbl-icon" style="background:var(--sky-bg);"><i class="fas fa-envelope" style="color:var(--sky);"></i></span>
                            Alamat Email <span class="req">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-at input-icon"></i>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email') }}"
                                   class="form-input" required
                                   placeholder="contoh@email.com"
                                   oninput="updatePreviewEmail()">
                        </div>
                        @error('email')
                            <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="form-group">
                        <label class="form-label" for="role">
                            <span class="lbl-icon" style="background:var(--violet-bg);"><i class="fas fa-shield-alt" style="color:var(--violet);"></i></span>
                            Role Pengguna <span class="req">*</span>
                        </label>
                        <div class="select-wrap">
                            <i class="fas fa-user-check input-icon"></i>
                            <select id="role" name="role" class="form-select" required>
                                <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas — Staff Perpustakaan</option>
                            </select>
                            <i class="fas fa-chevron-down select-chevron"></i>
                        </div>
                        <div class="field-hint"><i class="fas fa-info-circle" style="color:var(--gray-300);"></i> Role menentukan hak akses pengguna di sistem.</div>
                    </div>

                    {{-- Password --}}
                    <div class="form-group">
                        <label class="form-label" for="password">
                            <span class="lbl-icon" style="background:var(--amber-bg);"><i class="fas fa-lock" style="color:var(--amber);"></i></span>
                            Password <span class="req">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-key input-icon"></i>
                            <input type="password" id="password" name="password"
                                   class="form-input" required
                                   placeholder="Minimal 8 karakter"
                                   style="padding-right:38px;">
                            <button type="button" class="pw-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="pwIcon"></i>
                            </button>
                        </div>
                        <div class="field-hint"><i class="fas fa-info-circle" style="color:var(--gray-300);"></i> Password harus minimal 8 karakter.</div>
                        @error('password')
                            <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> Simpan Akun</button>
                    <a href="{{ route('admin.users') }}" class="btn btn-cancel"><i class="fas fa-times"></i> Batal</a>
                </div>
            </div>

            {{-- RIGHT: Preview Card --}}
            <div class="card au d3">
                <div class="preview-banner">
                    <div class="preview-avatar" id="previewAvatar">?</div>
                    <div class="preview-name" id="previewName" style="opacity:.6;font-style:italic;font-weight:500;">Nama belum diisi</div>
                    <div class="preview-email" id="previewEmail">—</div>
                </div>

                <div class="preview-body">
                    <div style="display:flex;justify-content:center;margin-bottom:12px;">
                        <span class="role-chip rc-petugas"><i class="fas fa-user-check" style="font-size:10px;"></i> Petugas</span>
                    </div>

                    <div class="mini-info">
                        <div class="mini-ico" style="background:var(--green-bg);"><i class="fas fa-user-plus" style="color:var(--green);"></i></div>
                        <div>
                            <div class="mini-lbl">Status</div>
                            <div class="mini-val" style="color:var(--green);">Akun Baru</div>
                        </div>
                    </div>
                    <div class="mini-info">
                        <div class="mini-ico" style="background:var(--violet-bg);"><i class="fas fa-shield-alt" style="color:var(--violet);"></i></div>
                        <div>
                            <div class="mini-lbl">Role</div>
                            <div class="mini-val">Petugas</div>
                        </div>
                    </div>

                    <div class="preview-hint">
                        <i class="fas fa-eye" style="font-size:10px;color:var(--gray-300);"></i>
                        Preview terupdate saat Anda mengetik
                    </div>
                </div>
            </div>
        </div>
    </form>
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

    window.updatePreview = function () {
        var val    = document.getElementById('name').value.trim();
        var nameEl = document.getElementById('previewName');
        var avEl   = document.getElementById('previewAvatar');
        if (val) {
            nameEl.textContent   = val;
            nameEl.style.opacity     = '1';
            nameEl.style.fontStyle   = 'normal';
            nameEl.style.fontWeight  = '800';
            avEl.textContent = val.charAt(0).toUpperCase();
        } else {
            nameEl.textContent   = 'Nama belum diisi';
            nameEl.style.opacity     = '.6';
            nameEl.style.fontStyle   = 'italic';
            nameEl.style.fontWeight  = '500';
            avEl.textContent = '?';
        }
    };

    window.updatePreviewEmail = function () {
        var val = document.getElementById('email').value.trim();
        document.getElementById('previewEmail').textContent = val || '—';
    };

    window.togglePassword = function () {
        var inp  = document.getElementById('password');
        var icon = document.getElementById('pwIcon');
        if (inp.type === 'password') {
            inp.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            inp.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    };

    document.querySelectorAll('.form-input, .form-select').forEach(function (inp) {
        inp.addEventListener('focus',  function () { var ic = this.parentElement.querySelector('.input-icon'); if (ic) ic.style.color = 'var(--red)'; });
        inp.addEventListener('blur',   function () { var ic = this.parentElement.querySelector('.input-icon'); if (ic) ic.style.color = ''; });
    });
})();
</script>
</body>
</html>
