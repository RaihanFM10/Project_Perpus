<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PerpusInd – Perpustakaan Digital Indonesia</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --red:      #DC2626;
            --red-dk:   #991B1B;
            --red-bg:   #FEF2F2;
            --gray-50:  #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-400: #9CA3AF;
            --gray-500: #6B7280;
            --gray-700: #374151;
            --gray-900: #111827;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #fff;
            color: var(--gray-900);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.6s ease both; }
        .d1 { animation-delay: .08s; }
        .d2 { animation-delay: .18s; }
        .d3 { animation-delay: .28s; }
        .d4 { animation-delay: .40s; }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .reveal.visible { opacity: 1; transform: none; }

        /* ── HEADER ── */
        header {
            position: sticky; top: 0; z-index: 50;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--gray-100);
        }
        .nav-inner {
            max-width: 1100px; margin: 0 auto;
            padding: 0 24px;
            height: 60px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .logo {
            display: flex; align-items: center; gap: 9px;
            text-decoration: none;
        }
        .logo-box {
            width: 34px; height: 34px;
            background: var(--red);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
        }
        .logo-box i { color: #fff; font-size: 14px; }
        .logo-name {
            font-weight: 800;
            font-size: 18px;
            letter-spacing: -0.02em;
            color: var(--gray-900);
        }
        .logo-name span { color: var(--red); }

        .nav-actions { display: flex; gap: 8px; }
        .btn-ghost {
            padding: 7px 18px;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            background: transparent;
            text-decoration: none;
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }
        .btn-ghost:hover { border-color: var(--red); background: var(--red-bg); color: var(--red); }
        .btn-solid {
            padding: 7px 18px;
            background: var(--red);
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s, transform .2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-solid:hover { background: var(--red-dk); transform: translateY(-1px); }

        /* ── HERO ── */
        .hero {
            max-width: 1100px; margin: 0 auto;
            padding: 80px 24px 72px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: center;
        }
        @media (max-width: 720px) {
            .hero { grid-template-columns: 1fr; }
            .hero-visual { display: none; }
        }

        .eyebrow {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--red-bg);
            border: 1px solid rgba(220,38,38,.2);
            border-radius: 999px;
            padding: 5px 14px;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--red);
            letter-spacing: .05em;
            text-transform: uppercase;
        }
        .dot-pulse {
            width: 6px; height: 6px;
            background: var(--red);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%,100% { box-shadow: 0 0 0 0 rgba(220,38,38,.4); }
            50%      { box-shadow: 0 0 0 6px rgba(220,38,38,0); }
        }

        .hero-title {
            font-size: clamp(2.2rem, 4vw, 3.2rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -.03em;
            margin: 18px 0 16px;
        }
        .hero-title em {
            font-style: normal;
            color: var(--red);
        }
        .hero-sub {
            font-size: 15px;
            color: var(--gray-500);
            line-height: 1.75;
            max-width: 420px;
            margin-bottom: 32px;
        }
        .hero-btns { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 40px; }
        .btn-primary {
            padding: 11px 28px;
            background: var(--red);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex; align-items: center; gap: 7px;
            transition: background .2s, transform .2s, box-shadow .2s;
            box-shadow: 0 3px 14px rgba(220,38,38,.3);
        }
        .btn-primary:hover { background: var(--red-dk); transform: translateY(-2px); box-shadow: 0 8px 22px rgba(220,38,38,.35); }
        .btn-secondary {
            padding: 11px 28px;
            background: #fff;
            color: var(--gray-700);
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex; align-items: center; gap: 7px;
            transition: border-color .2s, transform .2s;
        }
        .btn-secondary:hover { border-color: var(--gray-400); transform: translateY(-1px); }

        .stats {
            display: flex; gap: 0;
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            overflow: hidden;
            width: fit-content;
            background: #fff;
        }
        .stat {
            padding: 16px 28px;
            text-align: center;
            position: relative;
        }
        .stat + .stat::before {
            content: '';
            position: absolute; left: 0; top: 20%; bottom: 20%;
            width: 1px;
            background: var(--gray-200);
        }
        .stat-n { font-size: 1.6rem; font-weight: 800; color: var(--red); line-height: 1; }
        .stat-l { font-size: 11px; font-weight: 600; color: var(--gray-400); margin-top: 4px; text-transform: uppercase; letter-spacing: .04em; }

        /* Hero visual – flag card */
        .hero-visual {
            display: flex; align-items: center; justify-content: center;
        }
        .flag-card {
            width: 260px; height: 300px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,.1);
            display: flex; flex-direction: column;
            position: relative;
        }
        .flag-top { flex: 1; background: var(--red); }
        .flag-bot { flex: 1; background: #fff; border-top: 1px solid var(--gray-100); }
        .flag-center {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%,-50%);
            width: 80px; height: 80px;
            background: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 20px rgba(0,0,0,.12);
        }
        .flag-center i { font-size: 30px; color: var(--red); }

        /* ── DIVIDER ── */
        hr.div { border: none; height: 1px; background: var(--gray-100); }

        /* ── FEATURES ── */
        .section { padding: 80px 0; }
        .section-inner { max-width: 1100px; margin: 0 auto; padding: 0 24px; }
        .section-head { text-align: center; margin-bottom: 48px; }
        .section-kicker {
            font-size: 11px; font-weight: 700; color: var(--red);
            letter-spacing: .1em; text-transform: uppercase;
            margin-bottom: 10px;
        }
        .section-title {
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 800;
            letter-spacing: -.025em;
        }
        .section-sub { font-size: 14px; color: var(--gray-400); margin-top: 8px; }

        .feat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 18px; }
        .feat-card {
            background: var(--gray-50);
            border: 1px solid var(--gray-100);
            border-radius: 16px;
            padding: 28px 24px;
            transition: border-color .25s, transform .25s, box-shadow .25s;
        }
        .feat-card:hover {
            border-color: rgba(220,38,38,.25);
            transform: translateY(-4px);
            box-shadow: 0 12px 36px rgba(220,38,38,.07);
        }
        .feat-ico {
            width: 44px; height: 44px;
            background: var(--red-bg);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
        }
        .feat-ico i { color: var(--red); font-size: 17px; }
        .feat-card h3 { font-size: 15px; font-weight: 700; margin-bottom: 7px; }
        .feat-card p  { font-size: 13.5px; color: var(--gray-500); line-height: 1.7; }

        /* ── STEPS ── */
        .steps-section { background: var(--gray-50); }
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            position: relative;
        }
        @media (max-width: 680px) { .steps-grid { grid-template-columns: 1fr 1fr; } }
        .steps-grid::before {
            content: '';
            position: absolute;
            top: 22px; left: 12%; right: 12%;
            height: 1px;
            background: var(--gray-200);
        }
        .step { text-align: center; position: relative; }
        .step-n {
            width: 44px; height: 44px;
            background: var(--red);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 800; color: #fff;
            margin: 0 auto 14px;
            box-shadow: 0 4px 14px rgba(220,38,38,.3);
        }
        .step h4 { font-size: 14px; font-weight: 700; margin-bottom: 6px; }
        .step p  { font-size: 13px; color: var(--gray-400); line-height: 1.65; }

        /* ── BOOKS ── */
        .books-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 18px; }
        .book-card {
            background: #fff;
            border: 1px solid var(--gray-100);
            border-radius: 16px;
            overflow: hidden;
            transition: transform .3s, box-shadow .3s;
        }
        .book-card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(0,0,0,.08); }
        .book-cover {
            height: 180px;
            background: var(--red-bg);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        .book-cover img { width: 100%; height: 100%; object-fit: contain; transition: transform .35s; }
        .book-card:hover .book-cover img { transform: scale(1.05); }
        .book-body { padding: 16px 18px 18px; }
        .book-body h4 {
            font-size: 14px; font-weight: 700;
            margin-bottom: 3px; line-height: 1.4;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .book-author { font-size: 12px; color: var(--gray-400); margin-bottom: 12px; }
        .book-meta { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 6px; }
        .tag {
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px; font-weight: 600;
        }
        .tag-cat  { background: var(--red-bg); color: var(--red); }
        .tag-ok   { background: #F0FDF4; color: #16A34A; }
        .tag-out  { background: #FFF1F2; color: #E11D48; }
        .stars-row { display: flex; align-items: center; gap: 5px; margin-top: 10px; padding-top: 10px; border-top: 1px solid var(--gray-100); }
        .stars { color: #F59E0B; font-size: 11px; letter-spacing: 1px; }
        .stars span { color: var(--gray-200); }
        .stars-count { font-size: 11.5px; color: var(--gray-400); }

        /* ── CTA ── */
        .cta-section {
            background: var(--red);
            padding: 80px 0;
            text-align: center;
        }
        .cta-section h2 {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            color: #fff;
            letter-spacing: -.025em;
            line-height: 1.2;
            margin-bottom: 14px;
        }
        .cta-section p { font-size: 15px; color: rgba(255,255,255,.7); margin-bottom: 32px; }
        .btn-cta {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 34px;
            background: #fff;
            color: var(--red);
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            border: none; cursor: pointer;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 4px 18px rgba(0,0,0,.15);
        }
        .btn-cta:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,0,0,.2); }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid var(--gray-100);
            padding: 28px 24px;
            display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 8px;
        }
        footer p { font-size: 12.5px; color: var(--gray-400); }
        .footer-stripe { display: flex; height: 4px; }
        .footer-stripe .r { flex: 1; background: var(--red); }
        .footer-stripe .w { flex: 1; background: var(--gray-200); }
    </style>
</head>
<body>

<!-- HEADER -->
<header>
    <div class="nav-inner">
        <a href="/" class="logo">
            <div class="logo-box"><i class="fas fa-book-open"></i></div>
            <span class="logo-name">Perpus<span>Ind</span></span>
        </a>
        <div class="nav-actions">
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? url('/admin/dashboard') : url('/') }}" class="btn-solid">
                    <i class="fas fa-th-large" style="font-size:11px;"></i> Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button class="btn-ghost" type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-ghost">Masuk</a>
                <a href="{{ route('register') }}" class="btn-solid">Daftar Gratis <i class="fas fa-arrow-right" style="font-size:11px;"></i></a>
            @endauth
        </div>
    </div>
</header>

<!-- HERO -->
<div style="max-width:1100px;margin:0 auto;padding:0 24px;">
    <div class="hero" style="padding-left:0;padding-right:0;">
        <div>
            <div class="eyebrow fade-up d1"><span class="dot-pulse"></span> Perpustakaan Digital Indonesia</div>
            <h1 class="hero-title fade-up d2">
                Temukan Ilmu<br>Tanpa Batas,<br><em>Kapan Saja</em>
            </h1>
            <p class="hero-sub fade-up d3">
                Sistem perpustakaan digital yang memudahkan pencarian, peminjaman,
                dan pengelolaan koleksi buku secara online — gratis untuk semua.
            </p>
            <div class="hero-btns fade-up d4">
                <a href="/register" class="btn-primary">Mulai Sekarang <i class="fas fa-arrow-right" style="font-size:12px;"></i></a>
                <a href="/login"    class="btn-secondary"><i class="fas fa-search" style="font-size:12px;color:var(--gray-400);"></i> Cari Buku</a>
            </div>
            <div class="stats fade-up d4">
                <div class="stat">
                    <div class="stat-n">{{ $totalBooks }}+</div>
                    <div class="stat-l">Buku</div>
                </div>
                <div class="stat">
                    <div class="stat-n">{{ $totalUsers }}+</div>
                    <div class="stat-l">Anggota</div>
                </div>
                <div class="stat">
                    <div class="stat-n">{{ $avgRating }}/5</div>
                    <div class="stat-l">Rating</div>
                </div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="flag-card">
                <div class="flag-top"></div>
                <div class="flag-bot"></div>
                <div class="flag-center"><i class="fas fa-book-open"></i></div>
            </div>
        </div>
    </div>
</div>

<hr class="div">

<!-- FEATURES -->
<section class="section">
    <div class="section-inner">
        <div class="section-head reveal">
            <p class="section-kicker">Fitur Unggulan</p>
            <h2 class="section-title">Semua yang Kamu Butuhkan</h2>
            <p class="section-sub">Akses dan kelola buku dengan mudah, cepat, dan menyenangkan</p>
        </div>
        <div class="feat-grid">
            <div class="feat-card reveal"><div class="feat-ico"><i class="fas fa-book"></i></div><h3>Koleksi Lengkap</h3><p>Ribuan koleksi buku digital dari berbagai kategori yang terus diperbarui.</p></div>
            <div class="feat-card reveal"><div class="feat-ico"><i class="fas fa-bolt"></i></div><h3>Peminjaman Instan</h3><p>Ajukan peminjaman kapan saja tanpa perlu datang langsung ke perpustakaan.</p></div>
            <div class="feat-card reveal"><div class="feat-ico"><i class="fas fa-star"></i></div><h3>Rating & Ulasan</h3><p>Beri penilaian untuk membantu sesama pembaca menemukan buku terbaik.</p></div>
            <div class="feat-card reveal"><div class="feat-ico"><i class="fas fa-search"></i></div><h3>Pencarian Cerdas</h3><p>Temukan buku berdasarkan judul, penulis, atau kategori dengan akurat.</p></div>
            <div class="feat-card reveal"><div class="feat-ico"><i class="fas fa-shield-alt"></i></div><h3>Akun Aman</h3><p>Daftar gratis dalam hitungan menit. Data kamu aman dan terlindungi.</p></div>
            <div class="feat-card reveal"><div class="feat-ico"><i class="fas fa-chart-bar"></i></div><h3>Pantau Riwayat</h3><p>Lacak semua riwayat peminjaman dan pengembalian dari dashboard.</p></div>
        </div>
    </div>
</section>

<hr class="div">

<!-- STEPS -->
<section class="section steps-section">
    <div class="section-inner">
        <div class="section-head reveal">
            <p class="section-kicker">Panduan</p>
            <h2 class="section-title">Cara Menggunakan PerpusInd</h2>
            <p class="section-sub">Mulai dalam 4 langkah mudah</p>
        </div>
        <div class="steps-grid">
            <div class="step reveal"><div class="step-n">1</div><h4>Daftar Akun</h4><p>Buat akun gratis dengan email kamu</p></div>
            <div class="step reveal"><div class="step-n">2</div><h4>Cari Buku</h4><p>Temukan buku dari ribuan koleksi</p></div>
            <div class="step reveal"><div class="step-n">3</div><h4>Ajukan Pinjam</h4><p>Pinjam online, konfirmasi cepat</p></div>
            <div class="step reveal"><div class="step-n">4</div><h4>Baca & Review</h4><p>Nikmati lalu bagikan ulasan</p></div>
        </div>
    </div>
</section>

<hr class="div">

<!-- BOOKS -->
<section class="section">
    <div class="section-inner">
        <div class="section-head reveal">
            <p class="section-kicker">Koleksi Terbaru</p>
            <h2 class="section-title">Buku Pilihan Kami</h2>
            <p class="section-sub">Jelajahi sebagian koleksi terbaik di perpustakaan digital kami</p>
        </div>
        <div class="books-grid">
            @foreach($books as $book)
            <div class="book-card reveal">
                <div class="book-cover">
                    @if($book->image)
                        <img src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->judul }}">
                    @else
                        <i class="fas fa-book-open" style="font-size:2.4rem;color:rgba(220,38,38,.3);"></i>
                    @endif
                </div>
                <div class="book-body">
                    <h4>{{ $book->judul }}</h4>
                    <p class="book-author">{{ $book->penulis }}</p>
                    <div class="book-meta">
                        <span class="tag tag-cat">{{ $book->kategori->nama ?? 'Umum' }}</span>
                        @if($book->stok > 0)
                            <span class="tag tag-ok">Tersedia</span>
                        @else
                            <span class="tag tag-out">Habis</span>
                        @endif
                    </div>
                    @php $avg = $book->ratings_avg_rating ?? 0; $rounded = round($avg); @endphp
                    <div class="stars-row">
                        <span class="stars">
                            @for($i=1;$i<=5;$i++)
                                @if($i<=$rounded)★@else<span>★</span>@endif
                            @endfor
                        </span>
                        <span class="stars-count">{{ number_format($avg,1) }} · {{ $book->ratings_count }} ulasan</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="reveal" style="text-align:center;margin-top:40px;">
            <a href="{{ route('login') }}" class="btn-primary" style="font-size:14px;padding:12px 32px;">
                <i class="fas fa-book-open" style="font-size:13px;"></i> Lihat Semua Koleksi
            </a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section reveal">
    <div style="max-width:560px;margin:0 auto;padding:0 24px;">
        <h2>Bergabunglah Bersama<br>Komunitas Pembaca</h2>
        <p>Akses ribuan koleksi buku digital Indonesia secara gratis, kapan saja dan di mana saja.</p>
        <a href="/register" class="btn-cta">Daftar Sekarang — Gratis <i class="fas fa-arrow-right" style="font-size:12px;"></i></a>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <a href="/" class="logo">
        <div class="logo-box" style="width:28px;height:28px;border-radius:8px;"><i class="fas fa-book-open" style="font-size:11px;"></i></div>
        <span class="logo-name" style="font-size:16px;">Perpus<span>Ind</span></span>
    </a>
    <p>© 2026 PerpusInd · Perpustakaan Digital Indonesia. Semua hak dilindungi.</p>
</footer>
<div class="footer-stripe"><div class="r"></div><div class="w"></div></div>

<script>
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
</script>
</body>
</html>
