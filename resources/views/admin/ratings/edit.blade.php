<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Ulasan | Admin</title>
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

        /* SIDEBAR */
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

        /* MOBILE */
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

        /* MAIN */
        main { flex: 1; padding: 32px 36px; overflow-x: hidden; min-width: 0; }

        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--gray-400); margin-bottom: 16px; animation: fadeDown .4s ease both; }
        .breadcrumb a { color: var(--gray-400); font-weight: 500; transition: color .15s; }
        .breadcrumb a:hover { color: var(--red); }
        .breadcrumb .sep { font-size: 9px; color: var(--gray-300); }
        .breadcrumb .active { color: var(--gray-900); font-weight: 700; }

        .page-hd { margin-bottom: 24px; }
        .ph-sub-label { font-size: 11px; font-weight: 700; color: var(--gray-400); letter-spacing: .06em; text-transform: uppercase; margin-bottom: 5px; }
        .ph-title { font-size: 24px; font-weight: 800; letter-spacing: -.025em; }
        .ph-title span { color: var(--red); }
        .ph-desc { font-size: 13px; color: var(--gray-400); margin-top: 4px; }

        /* LAYOUT */
        .form-layout { display: grid; grid-template-columns: 1fr 250px; gap: 22px; align-items: start; }

        /* CARD */
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; }
        .card-hd { padding: 16px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .card-hd-title { font-size: 14px; font-weight: 700; }
        .card-hd-sub { font-size: 12px; color: var(--gray-400); margin-top: 2px; }
        .card-id-badge { display: inline-flex; align-items: center; gap: 3px; padding: 2px 9px; border-radius: 999px; background: var(--red-bg); color: var(--red); font-size: 11px; font-weight: 700; margin-left: 8px; }

        .card-body { padding: 22px; display: flex; flex-direction: column; gap: 18px; }
        .card-footer { padding: 16px 22px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; align-items: center; gap: 9px; }

        /* FORM */
        .form-group { display: flex; flex-direction: column; gap: 7px; }
        .form-label { font-size: 11.5px; font-weight: 700; color: var(--gray-700); letter-spacing: .04em; text-transform: uppercase; display: flex; align-items: center; gap: 5px; }
        .form-label i { color: var(--red); font-size: 10px; }
        .req { color: var(--red); }

        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 12px; pointer-events: none; }

        .form-input, .form-textarea {
            width: 100%; padding: 10px 13px 10px 36px;
            border: 1.5px solid var(--gray-200); border-radius: 10px;
            font-size: 13px; font-family: inherit; color: var(--gray-900);
            background: #fff; outline: none;
            transition: border .15s, box-shadow .15s;
        }
        .form-input:focus, .form-textarea:focus { border-color: var(--red); box-shadow: 0 0 0 3px rgba(220,38,38,.07); }
        .form-input.readonly { background: var(--gray-50); color: var(--gray-500); cursor: not-allowed; }
        .form-textarea { padding-left: 13px; resize: none; line-height: 1.65; }

        /* STAR SELECTOR */
        .star-selector { display: flex; gap: 7px; flex-wrap: wrap; }
        .star-option { display: none; }
        .star-option-label {
            display: flex; align-items: center; gap: 5px;
            padding: 8px 16px; border: 1.5px solid var(--gray-200); border-radius: 9px;
            font-size: 13px; font-weight: 600; cursor: pointer;
            color: var(--gray-400); background: var(--gray-50); user-select: none;
            transition: border .15s, background .15s, color .15s, transform .12s;
        }
        .star-option-label i { color: var(--gray-300); font-size: 12px; transition: color .15s; }
        .star-option-label:hover { border-color: #f59e0b; background: #fffbeb; color: #b45309; transform: translateY(-2px); }
        .star-option-label:hover i { color: #f59e0b; }
        .star-option:checked + .star-option-label { border-color: #f59e0b; background: var(--amber-bg); color: #92400e; }
        .star-option:checked + .star-option-label i { color: #f59e0b; }

        /* BUTTONS */
        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 9px; font-size: 13px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; text-decoration: none; transition: transform .15s, background .15s; }
        .btn:hover { transform: translateY(-1px); }
        .btn-save { background: var(--red); color: #fff; }
        .btn-save:hover { background: var(--red-dk); }
        .btn-cancel { background: var(--gray-100); color: var(--gray-700); border: 1.5px solid var(--gray-200); }
        .btn-cancel:hover { background: var(--gray-200); }

        /* SIDE PANEL */
        .side-body { padding: 22px 18px; display: flex; flex-direction: column; align-items: center; gap: 12px; }

        .avatar-frame {
            width: 80px; height: 80px; border-radius: 50%;
            background: var(--red);
            display: flex; align-items: center; justify-content: center;
            font-size: 30px; font-weight: 800; color: #fff;
            box-shadow: 0 4px 16px rgba(220,38,38,.2);
        }

        .side-name  { font-size: 13.5px; font-weight: 800; text-align: center; }
        .side-email { font-size: 11px; color: var(--gray-400); text-align: center; margin-top: -5px; }

        .rating-preview { width: 100%; padding: 12px 14px; border-radius: 11px; background: var(--amber-bg); border: 1px solid #fde68a; display: flex; flex-direction: column; align-items: center; gap: 5px; }
        .rp-stars { display: flex; gap: 3px; }
        .rp-stars i { color: #f59e0b; font-size: 15px; }
        .rp-stars i.empty { color: #fde68a; }
        .rp-label { font-size: 11.5px; font-weight: 700; color: #92400e; }

        .side-divider { width: 100%; border: none; border-top: 1px solid var(--gray-100); margin: 2px 0; }

        .side-meta { width: 100%; }
        .side-meta-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--gray-400); display: flex; align-items: center; gap: 4px; margin-bottom: 3px; }
        .side-meta-label i { color: var(--red); }
        .side-meta-value { font-size: 12.5px; font-weight: 600; color: var(--gray-900); line-height: 1.4; }

        .side-hint { font-size: 11px; color: var(--gray-400); text-align: center; line-height: 1.55; padding: 8px 10px; background: var(--gray-50); border-radius: 8px; border: 1px solid var(--gray-100); width: 100%; }

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
        <a href="{{ route('admin.ratings.index') }}"><i class="fas fa-star"></i> Ulasan Buku</a>
        <i class="fas fa-chevron-right sep"></i>
        <a href="{{ route('admin.ratings.show', $rating->id) }}">Detail Ulasan</a>
        <i class="fas fa-chevron-right sep"></i>
        <span class="active">Edit</span>
    </div>

    <div class="page-hd au d1">
        <div class="ph-sub-label">Admin Panel</div>
        <h1 class="ph-title">Edit <span>Ulasan</span></h1>
        <p class="ph-desc">Perbarui rating dan teks ulasan pengguna</p>
    </div>

    <form action="{{ route('admin.ratings.update', $rating->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-layout au d2">

            {{-- LEFT: Form --}}
            <div class="card">
                <div class="card-hd">
                    <div class="card-hd-icon" style="background:var(--amber-bg);">
                        <i class="fas fa-pen" style="color:var(--amber);"></i>
                    </div>
                    <div>
                        <div style="display:flex;align-items:center;">
                            <span class="card-hd-title">Form Edit Ulasan</span>
                            <span class="card-id-badge"><i class="fas fa-hashtag" style="font-size:9px;"></i> {{ $rating->id }}</span>
                        </div>
                        <div class="card-hd-sub">Ubah rating atau teks ulasan di bawah ini</div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-user"></i> User</label>
                        <div class="input-wrap">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" value="{{ $rating->user->name ?? '-' }}" class="form-input readonly" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-book"></i> Buku</label>
                        <div class="input-wrap">
                            <i class="fas fa-book input-icon"></i>
                            <input type="text" value="{{ $rating->book->judul ?? '-' }}" class="form-input readonly" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-star"></i> Rating <span class="req">*</span></label>
                        <div class="star-selector">
                            @for($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}"
                                       class="star-option"
                                       {{ $rating->rating == $i ? 'checked' : '' }} required>
                                <label for="star{{ $i }}" class="star-option-label">
                                    <i class="fas fa-star"></i> {{ $i }}
                                </label>
                            @endfor
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="ulasan"><i class="fas fa-align-left"></i> Teks Ulasan</label>
                        <textarea id="ulasan" name="ulasan" rows="5" class="form-textarea"
                                  placeholder="Tulis ulasan buku…">{{ old('ulasan', $rating->ulasan) }}</textarea>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    <a href="{{ route('admin.ratings.index') }}" class="btn btn-cancel"><i class="fas fa-times"></i> Batal</a>
                </div>
            </div>

            {{-- RIGHT: Info panel --}}
            <div class="card au d3">
                <div class="card-hd">
                    <div class="card-hd-icon" style="background:var(--red-bg);">
                        <i class="fas fa-user" style="color:var(--red);"></i>
                    </div>
                    <div><div class="card-hd-title">Info Pengguna</div></div>
                </div>

                <div class="side-body">
                    <div class="avatar-frame">
                        {{ strtoupper(substr($rating->user->name ?? 'U', 0, 1)) }}
                    </div>

                    <div class="side-name">{{ $rating->user->name ?? '-' }}</div>
                    @if(isset($rating->user->email))
                        <div class="side-email">{{ $rating->user->email }}</div>
                    @endif

                    <div class="rating-preview">
                        <div class="rp-stars" id="previewStars"></div>
                        <div class="rp-label" id="previewLabel">Pilih rating</div>
                    </div>

                    <hr class="side-divider">

                    <div class="side-meta">
                        <div class="side-meta-label"><i class="fas fa-book"></i> Buku</div>
                        <div class="side-meta-value">{{ $rating->book->judul ?? '-' }}</div>
                    </div>

                    <div class="side-meta">
                        <div class="side-meta-label"><i class="fas fa-calendar"></i> Tanggal</div>
                        <div class="side-meta-value">{{ $rating->created_at->format('d M Y') }}</div>
                    </div>

                    <div class="side-meta">
                        <div class="side-meta-label"><i class="fas fa-clock"></i> Jam</div>
                        <div class="side-meta-value">{{ $rating->created_at->format('H:i') }} WIB</div>
                    </div>
                    <p class="side-hint"><i class="fas fa-lock" style="color:var(--gray-300);margin-right:4px;"></i>Data user dan buku tidak dapat diubah melalui form ini.</p>
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

    // Live rating preview
    var labels = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Bagus', 'Sangat Bagus'];
    var previewStars = document.getElementById('previewStars');
    var previewLabel = document.getElementById('previewLabel');

    function updatePreview(val) {
        var html = '';
        for (var i = 1; i <= 5; i++) {
            html += '<i class="fas fa-star' + (i <= val ? '' : ' empty') + '"></i>';
        }
        previewStars.innerHTML = html;
        previewLabel.textContent = val + ' Bintang \u2014 ' + labels[val];
    }

    document.querySelectorAll('.star-option').forEach(function (el) {
        el.addEventListener('change', function () { updatePreview(parseInt(this.value)); });
    });

    var checked = document.querySelector('.star-option:checked');
    if (checked) {
        updatePreview(parseInt(checked.value));
    } else {
        previewStars.innerHTML = '<i class="fas fa-star empty"></i><i class="fas fa-star empty"></i><i class="fas fa-star empty"></i><i class="fas fa-star empty"></i><i class="fas fa-star empty"></i>';
        previewLabel.textContent = 'Pilih rating di form';
    }
})();
</script>
</body>
</html>
