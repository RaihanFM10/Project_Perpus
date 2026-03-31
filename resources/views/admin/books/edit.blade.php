<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku | Admin</title>
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
        .d4 { animation-delay: .26s; }

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
            .form-grid   { grid-template-columns: 1fr !important; }
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

        /* ── LAYOUT ── */
        .form-layout { display: grid; grid-template-columns: 1fr 240px; gap: 18px; align-items: start; }

        /* ── CARD ── */
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 16px; overflow: hidden; }
        .card-hd { padding: 16px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .card-hd-title { font-size: 14px; font-weight: 700; }
        .card-hd-sub { font-size: 12px; color: var(--gray-400); margin-top: 2px; }
        .card-body { padding: 22px; display: flex; flex-direction: column; gap: 18px; }
        .card-footer { padding: 16px 22px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; align-items: center; gap: 9px; flex-wrap: wrap; }

        /* ── FORM ── */
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-grid  { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        .form-label { font-size: 12px; font-weight: 700; color: var(--gray-700); display: flex; align-items: center; gap: 6px; text-transform: uppercase; letter-spacing: .04em; }
        .lbl-icon { width: 20px; height: 20px; border-radius: 5px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 10px; }
        .req { color: var(--red); font-size: 13px; }

        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 12px; pointer-events: none; transition: color .15s; }
        .input-wrap:focus-within .input-icon { color: var(--red); }

        .form-input,
        .form-select {
            width: 100%; padding: 10px 12px 10px 36px;
            border: 1.5px solid var(--gray-200); border-radius: 10px;
            font-size: 13.5px; font-family: inherit;
            color: var(--gray-900); background: #fff; outline: none;
            transition: border .18s, box-shadow .18s; appearance: none;
        }
        .form-input:focus,
        .form-select:focus { border-color: var(--red); box-shadow: 0 0 0 3px rgba(220,38,38,.07); }

        .form-textarea {
            width: 100%; padding: 10px 12px;
            border: 1.5px solid var(--gray-200); border-radius: 10px;
            font-size: 13.5px; font-family: inherit;
            color: var(--gray-900); background: #fff; outline: none;
            resize: none; line-height: 1.7;
            transition: border .18s, box-shadow .18s;
        }
        .form-textarea:focus { border-color: var(--red); box-shadow: 0 0 0 3px rgba(220,38,38,.07); }

        .select-wrap { position: relative; }
        .select-chevron { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 10px; pointer-events: none; }

        /* ISBN readonly */
        .isbn-display {
            display: flex; align-items: center; gap: 9px;
            padding: 10px 13px;
            background: var(--violet-bg); border: 1.5px solid rgba(124,58,237,.2);
            border-radius: 10px;
        }
        .isbn-display i { color: var(--violet); font-size: 12px; }
        .isbn-display code { font-family: 'Courier New', monospace; font-size: 13px; font-weight: 700; color: var(--violet); }
        .isbn-display .isbn-lock { margin-left: auto; font-size: 11px; color: var(--gray-300); }

        /* File upload */
        .file-drop {
            border: 1.5px dashed var(--gray-200); border-radius: 10px;
            padding: 14px 16px;
            display: flex; align-items: center; gap: 12px;
            background: var(--gray-50); cursor: pointer; position: relative;
            transition: border .18s, background .18s;
        }
        .file-drop:hover { border-color: var(--red); background: var(--red-bg); }
        .file-drop input[type="file"] { position: absolute; opacity: 0; width: 100%; height: 100%; cursor: pointer; left: 0; top: 0; }
        .file-drop-icon { width: 36px; height: 36px; border-radius: 9px; background: var(--amber-bg); display: flex; align-items: center; justify-content: center; flex-shrink: 0; pointer-events: none; }
        .file-drop-icon i { color: var(--amber); font-size: 14px; }
        .file-drop-text { pointer-events: none; }
        .file-drop-text strong { font-size: 13px; font-weight: 700; color: var(--gray-900); display: block; }
        .file-drop-text span { font-size: 11.5px; color: var(--gray-400); }

        .field-hint { font-size: 11.5px; color: var(--gray-400); display: flex; align-items: center; gap: 4px; margin-top: 1px; }
        .field-error { display: flex; align-items: center; gap: 4px; font-size: 12px; color: var(--red); font-weight: 600; margin-top: 1px; }

        /* ── COVER PREVIEW CARD ── */
        .cover-banner {
            background: var(--red);
            padding: 24px 18px 40px;
            text-align: center;
            position: relative; overflow: hidden;
        }
        .cover-banner-label { font-size: 10px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: rgba(255,255,255,.65); margin-bottom: 14px; }
        .cover-frame {
            width: 110px; height: 148px; border-radius: 9px; overflow: hidden;
            background: rgba(255,255,255,.15); border: 2px solid rgba(255,255,255,.25);
            display: inline-flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 24px rgba(0,0,0,.2);
            transition: transform .25s ease;
        }
        .cover-frame:hover { transform: scale(1.03); }
        .cover-frame img { width: 100%; height: 100%; object-fit: cover; }
        .cover-placeholder { display: flex; flex-direction: column; align-items: center; gap: 7px; }
        .cover-placeholder i { font-size: 26px; color: rgba(255,255,255,.45); }
        .cover-placeholder span { font-size: 10px; color: rgba(255,255,255,.4); font-weight: 600; text-transform: uppercase; letter-spacing: .04em; }

        .cover-body { padding: 0 16px 18px; margin-top: -18px; }
        .cover-info { background: #fff; border: 1px solid var(--gray-100); border-radius: 11px; padding: 12px 14px; box-shadow: 0 2px 8px rgba(0,0,0,.05); margin-bottom: 12px; }
        .cover-info-row { display: flex; align-items: center; gap: 8px; padding: 6px 0; border-bottom: 1px solid var(--gray-100); }
        .cover-info-row:last-child { border-bottom: none; padding-bottom: 0; }
        .cover-info-row:first-child { padding-top: 0; }
        .ci-icon { width: 24px; height: 24px; border-radius: 6px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 10px; }
        .ci-label { font-size: 9.5px; font-weight: 600; color: var(--gray-400); text-transform: uppercase; letter-spacing: .04em; }
        .ci-value { font-size: 12px; font-weight: 700; color: var(--gray-900); margin-top: 1px; word-break: break-word; }
        .cover-hint { font-size: 11px; color: var(--gray-400); text-align: center; line-height: 1.6; padding-top: 12px; border-top: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: center; gap: 4px; }

        /* ── BUTTONS ── */
        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 20px; border-radius: 9px; font-size: 13px; font-weight: 700; border: none; cursor: pointer; text-decoration: none; transition: transform .2s ease, box-shadow .2s ease; }
        .btn:hover { transform: translateY(-1px); }
        .btn-save { background: var(--red); color: #fff; box-shadow: 0 3px 14px rgba(220,38,38,.3); }
        .btn-save:hover { background: var(--red-dk); box-shadow: 0 6px 20px rgba(220,38,38,.4); }
        .btn-cancel { background: #fff; color: var(--gray-700); border: 1.5px solid var(--gray-200); }
        .btn-cancel:hover { background: var(--gray-50); }

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
        <a href="{{ route('admin.dashboard') }}" class="sb-link"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('admin.users') }}" class="sb-link"><i class="fas fa-users"></i> Manajemen User</a>
        <a href="{{ url('/admin/books') }}" class="sb-link active"><i class="fas fa-book"></i> Data Buku</a>
        <a href="{{ route('admin.categories.index') }}" class="sb-link"><i class="fas fa-tags"></i> Kategori Buku</a>
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
        <a href="{{ url('/admin/books') }}"><i class="fas fa-book"></i> Data Buku</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Edit Buku</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Admin Panel</div>
        <h1 class="ph-title">Edit <span>Buku</span></h1>
        <p class="ph-desc">Perbarui informasi buku dalam koleksi perpustakaan</p>
    </div>

    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-layout">

            {{-- LEFT: Form Card --}}
            <div class="card au d2">
                <div class="card-hd">
                    <div class="card-hd-icon" style="background:var(--amber-bg);">
                        <i class="fas fa-pen" style="color:var(--amber);"></i>
                    </div>
                    <div>
                        <div class="card-hd-title">Form Edit Buku</div>
                        <div class="card-hd-sub">ID: <span style="font-family:'Courier New',monospace;color:var(--red-dk);font-weight:700;">#{{ $book->id }}</span></div>
                    </div>
                </div>

                <div class="card-body">

                    {{-- ISBN --}}
                    <div class="form-group">
                        <label class="form-label">
                            <span class="lbl-icon" style="background:var(--violet-bg);"><i class="fas fa-barcode" style="color:var(--violet);"></i></span>
                            ISBN / Kode Buku
                        </label>
                        <div class="isbn-display">
                            <i class="fas fa-hashtag"></i>
                            <code>{{ $book->kode_buku }}</code>
                            <span class="isbn-lock"><i class="fas fa-lock"></i></span>
                        </div>
                        <div class="field-hint"><i class="fas fa-info-circle" style="color:var(--gray-300);"></i> ISBN tidak dapat diubah.</div>
                        <input type="hidden" name="kode_buku" value="{{ $book->kode_buku }}">
                    </div>

                    {{-- Judul --}}
                    <div class="form-group">
                        <label class="form-label" for="judul">
                            <span class="lbl-icon" style="background:var(--red-bg);"><i class="fas fa-book" style="color:var(--red);"></i></span>
                            Judul Buku <span class="req">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-heading input-icon"></i>
                            <input type="text" id="judul" name="judul" value="{{ old('judul', $book->judul) }}"
                                   class="form-input" required placeholder="Masukkan judul buku" oninput="updateMeta()">
                        </div>
                        @error('judul')<div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="form-group">
                        <label class="form-label" for="KategoriID">
                            <span class="lbl-icon" style="background:var(--sky-bg);"><i class="fas fa-tags" style="color:var(--sky);"></i></span>
                            Kategori Buku <span class="req">*</span>
                        </label>
                        <div class="select-wrap">
                            <i class="fas fa-layer-group input-icon"></i>
                            <select id="KategoriID" name="KategoriID" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('KategoriID', $book->KategoriID) == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down select-chevron"></i>
                        </div>
                        @error('KategoriID')<div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    {{-- Penulis --}}
                    <div class="form-group">
                        <label class="form-label" for="penulis">
                            <span class="lbl-icon" style="background:var(--amber-bg);"><i class="fas fa-user-edit" style="color:var(--amber);"></i></span>
                            Penulis <span class="req">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-pen input-icon"></i>
                            <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $book->penulis) }}"
                                   class="form-input" required placeholder="Nama penulis" oninput="updateMeta()">
                        </div>
                        @error('penulis')<div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    {{-- Penerbit --}}
                    <div class="form-group">
                        <label class="form-label" for="penerbit">
                            <span class="lbl-icon" style="background:var(--gray-100);"><i class="fas fa-building" style="color:var(--gray-500);"></i></span>
                            Penerbit <span class="req">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-industry input-icon"></i>
                            <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit', $book->penerbit) }}"
                                   class="form-input" required placeholder="Nama penerbit">
                        </div>
                        @error('penerbit')<div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    {{-- Tahun & Stok --}}
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="tahun">
                                <span class="lbl-icon" style="background:var(--amber-bg);"><i class="fas fa-calendar" style="color:var(--amber);"></i></span>
                                Tahun Terbit <span class="req">*</span>
                            </label>
                            <div class="input-wrap">
                                <i class="fas fa-calendar-alt input-icon"></i>
                                <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $book->tahun) }}"
                                       class="form-input" required placeholder="2023" oninput="updateMeta()">
                            </div>
                            @error('tahun')<div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="stok">
                                <span class="lbl-icon" style="background:var(--green-bg);"><i class="fas fa-layer-group" style="color:var(--green);"></i></span>
                                Stok <span class="req">*</span>
                            </label>
                            <div class="input-wrap">
                                <i class="fas fa-cubes input-icon"></i>
                                <input type="number" id="stok" name="stok" value="{{ old('stok', $book->stok) }}"
                                       class="form-input" min="0" required placeholder="0" oninput="updateMeta()">
                            </div>
                            @error('stok')<div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group">
                        <label class="form-label" for="deskripsi">
                            <span class="lbl-icon" style="background:var(--gray-100);"><i class="fas fa-align-left" style="color:var(--gray-500);"></i></span>
                            Deskripsi Buku
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="form-textarea"
                                  placeholder="Tulis deskripsi singkat tentang buku ini…">{{ old('deskripsi', $book->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    {{-- Cover Upload --}}
                    <div class="form-group">
                        <label class="form-label">
                            <span class="lbl-icon" style="background:var(--amber-bg);"><i class="fas fa-image" style="color:var(--amber);"></i></span>
                            Ganti Cover Buku
                        </label>
                        <div class="file-drop">
                            <div class="file-drop-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div class="file-drop-text">
                                <strong id="fileLabel">Pilih file atau drag & drop</strong>
                                <span>JPG, PNG, WEBP — Maks. 2MB</span>
                            </div>
                            <input type="file" name="image" accept="image/*" onchange="previewCover(event)">
                        </div>
                        <div class="field-hint"><i class="fas fa-info-circle" style="color:var(--gray-300);"></i> Kosongkan jika tidak ingin mengganti cover.</div>
                        @error('image')<div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    <a href="{{ url('/admin/books') }}" class="btn btn-cancel"><i class="fas fa-times"></i> Batal</a>
                </div>
            </div>

            {{-- RIGHT: Cover Preview --}}
            <div class="card au d3">
                <div class="cover-banner">
                    <div class="cover-banner-label">Preview Cover</div>
                    <div class="cover-frame">
                        @if($book->image)
                            <img id="coverImg" src="{{ asset('storage/' . $book->image) }}" alt="Cover">
                        @else
                            <div class="cover-placeholder" id="coverPlaceholder">
                                <i class="fas fa-book-open"></i>
                                <span>Belum ada cover</span>
                            </div>
                            <img id="coverImg" src="" alt="Cover" style="display:none;">
                        @endif
                    </div>
                </div>

                <div class="cover-body">
                    <div class="cover-info">
                        <div class="cover-info-row">
                            <div class="ci-icon" style="background:var(--red-bg);"><i class="fas fa-book" style="color:var(--red);"></i></div>
                            <div><div class="ci-label">Judul</div><div class="ci-value" id="metaJudul">{{ $book->judul }}</div></div>
                        </div>
                        <div class="cover-info-row">
                            <div class="ci-icon" style="background:var(--amber-bg);"><i class="fas fa-pen" style="color:var(--amber);"></i></div>
                            <div><div class="ci-label">Penulis</div><div class="ci-value" id="metaPenulis">{{ $book->penulis }}</div></div>
                        </div>
                        <div class="cover-info-row">
                            <div class="ci-icon" style="background:var(--green-bg);"><i class="fas fa-layer-group" style="color:var(--green);"></i></div>
                            <div><div class="ci-label">Stok</div><div class="ci-value" id="metaStok">{{ $book->stok }}</div></div>
                        </div>
                        <div class="cover-info-row">
                            <div class="ci-icon" style="background:var(--amber-bg);"><i class="fas fa-calendar" style="color:var(--amber);"></i></div>
                            <div><div class="ci-label">Tahun</div><div class="ci-value" id="metaTahun">{{ $book->tahun }}</div></div>
                        </div>
                    </div>
                    <div class="cover-hint">
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

    window.previewCover = function (e) {
        var file = e.target.files[0];
        if (!file) return;
        document.getElementById('fileLabel').textContent = file.name;
        var reader = new FileReader();
        reader.onload = function (ev) {
            var img = document.getElementById('coverImg');
            var ph  = document.getElementById('coverPlaceholder');
            img.src = ev.target.result;
            img.style.display = 'block';
            if (ph) ph.style.display = 'none';
        };
        reader.readAsDataURL(file);
    };

    function setText(id, val, fallback) {
        var el = document.getElementById(id);
        if (!el) return;
        el.textContent     = val || fallback;
        el.style.color     = val ? 'var(--gray-900)' : 'var(--gray-300)';
        el.style.fontStyle = val ? 'normal' : 'italic';
    }

    window.updateMeta = function () {
        setText('metaJudul',   document.getElementById('judul')   ? document.getElementById('judul').value.trim()   : '', 'Belum diisi');
        setText('metaPenulis', document.getElementById('penulis') ? document.getElementById('penulis').value.trim() : '', 'Belum diisi');
        setText('metaStok',    document.getElementById('stok')    ? document.getElementById('stok').value            : '', '—');
        setText('metaTahun',   document.getElementById('tahun')   ? document.getElementById('tahun').value           : '', '—');
    };
})();
</script>
</body>
</html>
