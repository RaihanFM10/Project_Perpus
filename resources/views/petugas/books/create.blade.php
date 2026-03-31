<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku | PerpusInd</title>
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
            .form-layout { grid-template-columns: 1fr !important; }
            .grid-2 { grid-template-columns: 1fr !important; }
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
        .form-layout { display: grid; grid-template-columns: 1fr 210px; gap: 18px; align-items: start; max-width: 900px; }

        /* ── CARD ── */
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; }
        .card-hd { padding: 15px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .card-hd-title { font-size: 14px; font-weight: 700; }
        .card-hd-sub   { font-size: 11.5px; color: var(--gray-400); margin-top: 1px; }
        .card-body { padding: 22px; }
        .card-footer { padding: 15px 22px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; align-items: center; gap: 9px; }

        /* ── ALERT ── */
        .alert-error { display: flex; gap: 11px; padding: 13px 15px; background: var(--red-sf); border: 1px solid #fca5a5; border-radius: 10px; margin-bottom: 18px; }
        .alert-error i { color: var(--red); flex-shrink: 0; margin-top: 1px; }
        .alert-error ul { list-style: disc; padding-left: 15px; }
        .alert-error ul li { font-size: 12.5px; color: var(--red); font-weight: 500; }

        /* ── FORM FIELDS ── */
        .field { display: flex; flex-direction: column; gap: 7px; margin-bottom: 16px; }
        .field:last-child { margin-bottom: 0; }
        .field-label { font-size: 11.5px; font-weight: 700; color: var(--gray-700); letter-spacing: .04em; text-transform: uppercase; display: flex; align-items: center; gap: 5px; }
        .field-label i { color: var(--red); font-size: 10px; }
        .req { color: var(--red); }

        .input-wrap { position: relative; }
        .input-icon    { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 12px; pointer-events: none; transition: color .15s; }
        .textarea-icon { position: absolute; left: 12px; top: 13px; color: var(--gray-400); font-size: 12px; pointer-events: none; }
        .input-wrap:focus-within .input-icon,
        .input-wrap:focus-within .textarea-icon { color: var(--red); }

        .form-input, .form-select, .form-textarea {
            width: 100%; padding: 10px 13px 10px 36px;
            border: 1.5px solid var(--gray-200); border-radius: 10px;
            font-size: 13px; font-family: inherit; color: var(--gray-900);
            background: #fff; outline: none;
            transition: border .15s, box-shadow .15s;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--red); box-shadow: 0 0 0 3px rgba(220,38,38,.07);
        }
        .form-textarea { padding-left: 13px; resize: vertical; min-height: 88px; line-height: 1.65; }
        .form-select { appearance: none; -webkit-appearance: none; cursor: pointer; }

        .select-wrap { position: relative; }
        .select-wrap::after { content: '\f078'; font-family: 'Font Awesome 6 Free'; font-weight: 900; font-size: 10px; color: var(--gray-400); position: absolute; right: 12px; top: 50%; transform: translateY(-50%); pointer-events: none; }

        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        /* Upload area */
        .upload-area { border: 2px dashed var(--gray-200); border-radius: 10px; padding: 18px; text-align: center; cursor: pointer; transition: border-color .15s, background .15s; position: relative; background: var(--gray-50); }
        .upload-area:hover { border-color: var(--red); background: var(--red-bg); }
        .upload-area.has-file { border-color: var(--red); background: var(--red-bg); }
        .upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
        .upload-icon { font-size: 20px; color: var(--gray-400); margin-bottom: 7px; transition: color .15s; }
        .upload-area:hover .upload-icon, .upload-area.has-file .upload-icon { color: var(--red); }
        .upload-text { font-size: 12.5px; font-weight: 600; color: var(--gray-500); transition: color .15s; }
        .upload-area:hover .upload-text, .upload-area.has-file .upload-text { color: var(--red); }
        .upload-hint { font-size: 11px; color: var(--gray-400); margin-top: 3px; }

        /* ── BUTTONS ── */
        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 9px; font-size: 13px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; text-decoration: none; transition: background .12s, transform .12s; }
        .btn:hover { transform: translateY(-1px); }
        .btn-save { background: var(--red); color: #fff; flex: 1; justify-content: center; }
        .btn-save:hover { background: var(--red-dk); }
        .btn-cancel { background: var(--gray-100); color: var(--gray-700); border: 1.5px solid var(--gray-200); }
        .btn-cancel:hover { background: var(--gray-200); }

        /* ── PREVIEW CARD ── */
        .preview-card { position: sticky; top: 32px; }
        .preview-img-wrap { width: 100%; aspect-ratio: 3/4; border-radius: 11px; overflow: hidden; background: var(--gray-100); border: 1.5px dashed var(--gray-200); display: flex; flex-direction: column; align-items: center; justify-content: center; transition: border-color .15s; }
        .preview-img-wrap.has-img { border-style: solid; border-color: var(--gray-200); }
        .preview-img-wrap img { width: 100%; height: 100%; object-fit: cover; display: none; }
        .preview-placeholder { text-align: center; padding: 18px; }
        .preview-placeholder i { font-size: 32px; color: var(--gray-300); display: block; margin-bottom: 8px; }
        .preview-placeholder p { font-size: 11.5px; color: var(--gray-400); font-style: italic; }
        .preview-label { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--gray-400); text-align: center; margin-top: 11px; }

        /* Flag stripe */
        .flag-stripe { display: flex; height: 4px; margin-top: 24px; max-width: 900px; }
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
            <div class="sb-sub">Petugas Panel</div>
        </div>
    </div>
    <nav class="sb-nav">
        <div class="sb-group">Menu Utama</div>
        <a href="{{ route('petugas.dashboard') }}" class="sb-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ url('petugas/books') }}" class="sb-link {{ request()->is('petugas/books*') ? 'active' : '' }}"><i class="fas fa-book"></i> Kelola Buku</a>
        <div class="sb-group">Aktivitas</div>
        <a href="{{ route('petugas.borrowings.index') }}" class="sb-link {{ request()->routeIs('petugas.borrowings*') ? 'active' : '' }}"><i class="fas fa-handshake"></i> Riwayat Peminjaman</a>
    </nav>
    <div class="sb-footer">
        <div class="sb-user">
            <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}</div>
            <div>
                <div class="sb-uname">{{ auth()->user()->name ?? 'Petugas' }}</div>
                <div class="sb-urole">Petugas</div>
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
        <a href="{{ url('petugas/books') }}"><i class="fas fa-book"></i> Kelola Buku</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Tambah Buku</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Petugas Panel</div>
        <h1 class="ph-title">Tambah <span>Buku</span></h1>
        <p class="ph-desc">Tambahkan buku baru ke koleksi perpustakaan</p>
    </div>

    <div class="form-layout au d2">

        {{-- FORM CARD --}}
        <div class="card">
            <div class="card-hd">
                <div class="card-hd-icon" style="background:var(--green-bg);">
                    <i class="fas fa-plus-circle" style="color:var(--green);"></i>
                </div>
                <div>
                    <div class="card-hd-title">Form Tambah Buku</div>
                    <div class="card-hd-sub">Isi semua informasi buku dengan benar</div>
                </div>
            </div>

            <div class="card-body">
                <form id="tambahForm" method="POST" action="{{ route('petugas.books.store') }}" enctype="multipart/form-data">
                    @csrf

                    @if($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- ISBN --}}
                    <div class="field">
                        <label class="field-label"><i class="fas fa-barcode"></i> ISBN <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-barcode input-icon"></i>
                            <input type="text" name="kode_buku" value="{{ old('kode_buku') }}" class="form-input" placeholder="1234-XXX-XXX-XXX-XX" required>
                        </div>
                    </div>

                    {{-- Judul --}}
                    <div class="field">
                        <label class="field-label"><i class="fas fa-book"></i> Judul Buku <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-book input-icon"></i>
                            <input type="text" name="judul" value="{{ old('judul') }}" class="form-input" placeholder="Masukkan judul buku" required>
                        </div>
                    </div>

                    {{-- Penulis --}}
                    <div class="field">
                        <label class="field-label"><i class="fas fa-user-edit"></i> Penulis <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-user-edit input-icon"></i>
                            <input type="text" name="penulis" value="{{ old('penulis') }}" class="form-input" placeholder="Masukkan nama penulis" required>
                        </div>
                    </div>

                    {{-- Penerbit --}}
                    <div class="field">
                        <label class="field-label"><i class="fas fa-building"></i> Penerbit <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-building input-icon"></i>
                            <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="form-input" placeholder="Masukkan nama penerbit" required>
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div class="field">
                        <label class="field-label"><i class="fas fa-tags"></i> Kategori Buku <span class="req">*</span></label>
                        <div class="select-wrap input-wrap">
                            <i class="fas fa-tags input-icon"></i>
                            <select name="KategoriID" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('KategoriID') == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Tahun & Stok --}}
                    <div class="field grid-2">
                        <div>
                            <label class="field-label"><i class="fas fa-calendar"></i> Tahun Terbit <span class="req">*</span></label>
                            <div class="input-wrap">
                                <i class="fas fa-calendar input-icon"></i>
                                <input type="number" name="tahun" value="{{ old('tahun') }}" class="form-input" min="1900" max="{{ date('Y') }}" placeholder="{{ date('Y') }}" required>
                            </div>
                        </div>
                        <div>
                            <label class="field-label"><i class="fas fa-layer-group"></i> Stok <span class="req">*</span></label>
                            <div class="input-wrap">
                                <i class="fas fa-layer-group input-icon"></i>
                                <input type="number" name="stok" value="{{ old('stok') }}" class="form-input" min="0" placeholder="10" required>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="field">
                        <label class="field-label"><i class="fas fa-align-left"></i> Deskripsi Buku</label>
                        <div class="input-wrap">
                            <i class="fas fa-align-left textarea-icon"></i>
                            <textarea name="deskripsi" class="form-textarea" placeholder="Tulis deskripsi singkat buku…">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>

                    {{-- Cover --}}
                    <div class="field">
                        <label class="field-label"><i class="fas fa-image"></i> Cover Buku</label>
                        <div class="upload-area" id="uploadArea">
                            <input type="file" name="image" accept="image/*" onchange="previewCover(event)">
                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                            <div class="upload-text">Klik atau drag foto cover</div>
                            <div class="upload-hint">JPG, PNG · Maks 2MB</div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="card-footer">
                <button type="submit" form="tambahForm" class="btn btn-save">
                    <i class="fas fa-save"></i> Simpan Buku
                </button>
                <a href="{{ url('petugas/books') }}" class="btn btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </div>

        {{-- COVER PREVIEW --}}
        <div class="preview-card au d3">
            <div class="card">
                <div class="card-hd">
                    <div class="card-hd-icon" style="background:var(--gray-100);">
                        <i class="fas fa-image" style="color:var(--gray-400);"></i>
                    </div>
                    <div class="card-hd-title" style="font-size:13px;">Preview Cover</div>
                </div>
                <div class="card-body" style="padding:18px;">
                    <div class="preview-img-wrap" id="previewWrap">
                        <img id="previewImg" src="" alt="Preview Cover">
                        <div class="preview-placeholder" id="previewPlaceholder">
                            <i class="fas fa-book-open"></i>
                            <p>Belum ada cover</p>
                        </div>
                    </div>
                    <div class="preview-label">Pratinjau Cover</div>
                </div>
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
})();

function previewCover(event) {
    var file = event.target.files[0];
    if (!file) return;
    var reader = new FileReader();
    reader.onload = function (e) {
        var img         = document.getElementById('previewImg');
        var placeholder = document.getElementById('previewPlaceholder');
        var wrap        = document.getElementById('previewWrap');
        var area        = document.getElementById('uploadArea');
        img.src = e.target.result;
        img.style.display = 'block';
        placeholder.style.display = 'none';
        wrap.classList.add('has-img');
        area.classList.add('has-file');
        area.querySelector('.upload-text').textContent = file.name;
    };
    reader.readAsDataURL(file);
}
</script>
</body>
</html>
