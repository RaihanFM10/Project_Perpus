<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Ulasan | Admin</title>
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
        .d1 { animation-delay: .05s; } .d2 { animation-delay: .12s; } .d3 { animation-delay: .19s; }

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
        }

        /* ── MAIN ── */
        main { flex: 1; padding: 32px 36px; overflow-x: hidden; min-width: 0; }

        .page-hd { margin-bottom: 24px; }
        .ph-sub-label { font-size: 11px; font-weight: 700; color: var(--gray-400); letter-spacing: .06em; text-transform: uppercase; margin-bottom: 5px; }
        .ph-title { font-size: 24px; font-weight: 800; letter-spacing: -.025em; }
        .ph-title span { color: var(--red); }
        .ph-desc { font-size: 13px; color: var(--gray-400); margin-top: 4px; }

        /* Alert */
        .alert-success { margin-bottom: 18px; padding: 11px 15px; background: var(--green-bg); border: 1px solid #bbf7d0; color: var(--green); border-radius: 10px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px; animation: fadeDown .3s ease both; }

        /* ── CARD ── */
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; }
        .card-hd { padding: 14px 20px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .card-hd-left { display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 13px; }
        .card-hd-title { font-size: 13.5px; font-weight: 700; }
        .card-count { display: inline-flex; align-items: center; gap: 4px; padding: 2px 9px; border-radius: 999px; background: var(--amber-bg); color: var(--amber); font-size: 11px; font-weight: 700; margin-left: 6px; }

        .search-wrap { position: relative; }
        .search-wrap i { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 11px; pointer-events: none; transition: color .15s; }
        .search-wrap input { padding: 8px 13px 8px 32px; border: 1.5px solid var(--gray-200); border-radius: 9px; font-size: 12.5px; font-family: inherit; color: var(--gray-900); background: var(--gray-50); outline: none; width: 220px; transition: border .15s, box-shadow .15s; }
        .search-wrap input:focus { border-color: var(--red); background: #fff; box-shadow: 0 0 0 3px rgba(220,38,38,.08); }
        .search-wrap:focus-within i { color: var(--red); }

        /* ── TABLE ── */
        .tbl-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: var(--gray-50); border-bottom: 1px solid var(--gray-100); }
        th { padding: 10px 16px; font-size: 10px; font-weight: 700; letter-spacing: .07em; text-transform: uppercase; color: var(--gray-400); text-align: left; white-space: nowrap; }
        th:last-child { text-align: center; }
        td { padding: 12px 16px; font-size: 13px; vertical-align: middle; border-bottom: 1px solid var(--gray-50); }
        tbody tr { transition: background .12s; }
        tbody tr:hover { background: var(--red-bg); }
        tbody tr:last-child td { border-bottom: none; }

        .row-num { font-size: 11.5px; font-weight: 700; color: var(--gray-300); }

        /* User cell */
        .user-cell { display: flex; align-items: center; gap: 8px; }
        .u-avatar { width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0; background: var(--red); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 11px; font-weight: 700; }
        .u-name { font-weight: 700; color: var(--gray-900); white-space: nowrap; max-width: 120px; overflow: hidden; text-overflow: ellipsis; }

        .book-title { font-weight: 600; color: var(--gray-700); max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block; }

        /* Star badge */
        .star-badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 999px; font-size: 11.5px; font-weight: 700; white-space: nowrap; }
        .star-5 { background: var(--amber-bg); color: var(--amber); }
        .star-4 { background: #fefce8; color: #a16207; }
        .star-3 { background: var(--green-bg); color: var(--green); }
        .star-2 { background: #fff7ed; color: #9a3412; }
        .star-1 { background: var(--red-sf); color: var(--red); }
        .stars-visual { display: flex; gap: 1px; margin-top: 3px; }
        .stars-visual i { font-size: 9px; }
        .sf { color: #f59e0b; }
        .se { color: var(--gray-200); }

        .review-text { color: var(--gray-400); max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-style: italic; font-size: 12px; }
        .date-cell { color: var(--gray-400); font-size: 12px; white-space: nowrap; display: flex; align-items: center; gap: 4px; }
        .date-cell i { color: var(--gray-300); font-size: 9px; }

        /* Action buttons */
        .action-cell { display: flex; align-items: center; justify-content: center; gap: 4px; }
        .btn-act { width: 28px; height: 28px; border-radius: 7px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; border: none; cursor: pointer; font-family: inherit; text-decoration: none; transition: transform .12s; }
        .btn-act:hover { transform: translateY(-1px); }
        .btn-detail { background: var(--sky-bg);   color: var(--sky); }
        .btn-detail:hover { background: #bae6fd; }
        .btn-edit   { background: var(--amber-bg); color: var(--amber); }
        .btn-edit:hover   { background: #fde68a; }
        .btn-delete { background: var(--red-sf);   color: var(--red); }
        .btn-delete:hover { background: #fecaca; }

        /* Empty state */
        .empty-state { padding: 56px 20px; text-align: center; }
        .empty-icon { width: 56px; height: 56px; border-radius: 16px; margin: 0 auto 14px; background: var(--gray-100); display: flex; align-items: center; justify-content: center; }
        .empty-icon i { font-size: 22px; color: var(--gray-300); }
        .empty-state p    { color: var(--gray-400); font-size: 13px; font-weight: 500; }
        .empty-state span { font-size: 12px; color: var(--gray-300); }

        /* Card footer */
        .card-footer { padding: 13px 20px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; font-size: 12.5px; color: var(--gray-400); font-weight: 500; }

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

    <div class="page-hd au d1">
        <div class="ph-sub-label">Admin Panel</div>
        <h1 class="ph-title">Ulasan <span>Buku</span></h1>
        <p class="ph-desc">Kelola ulasan dan rating dari pengguna perpustakaan</p>
    </div>

    @if(session('success'))
    <div class="alert-success au"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <div class="card au d2">
        <div class="card-hd">
            <div class="card-hd-left">
                <div class="card-hd-icon" style="background:var(--amber-bg);">
                    <i class="fas fa-star" style="color:var(--amber);"></i>
                </div>
                <div>
                    <span class="card-hd-title">Daftar Ulasan</span>
                    <span class="card-count">
                        <i class="fas fa-layer-group" style="font-size:9px;"></i>
                        {{ $ratings->total() }} ulasan
                    </span>
                </div>
            </div>
            <div class="search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari user atau judul buku…" oninput="filterTable(this.value)">
            </div>
        </div>

        <div class="tbl-wrap">
            <table id="mainTable">
                <thead>
                    <tr>
                        <th style="width:44px">No</th>
                        <th>User</th>
                        <th>Buku</th>
                        <th>Rating</th>
                        <th>Ulasan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ratings as $index => $rating)
                    <tr>
                        <td><span class="row-num">{{ $ratings->firstItem() + $index }}</span></td>

                        <td>
                            <div class="user-cell">
                                <div class="u-avatar">{{ strtoupper(substr($rating->user->name ?? 'U', 0, 1)) }}</div>
                                <span class="u-name">{{ $rating->user->name ?? '-' }}</span>
                            </div>
                        </td>

                        <td><span class="book-title">{{ $rating->book->judul ?? '-' }}</span></td>

                        <td>
                            @php $r = (int) $rating->rating; @endphp
                            <div style="display:flex;flex-direction:column;gap:3px;">
                                <span class="star-badge star-{{ $r }}">
                                    <i class="fas fa-star" style="font-size:9px;"></i> {{ $rating->rating }}
                                </span>
                                <div class="stars-visual">
                                    @for($s = 1; $s <= 5; $s++)
                                        <i class="fas fa-star {{ $s <= $r ? 'sf' : 'se' }}"></i>
                                    @endfor
                                </div>
                            </div>
                        </td>

                        <td>
                            @if($rating->ulasan)
                                <span class="review-text">{{ Str::limit($rating->ulasan, 50) }}</span>
                            @else
                                <span style="color:var(--gray-300);font-size:11.5px;font-style:italic;">Tidak ada</span>
                            @endif
                        </td>

                        <td>
                            <div class="date-cell">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $rating->created_at->format('d M Y') }}
                            </div>
                        </td>

                        <td>
                            <div class="action-cell">
                                <a href="{{ route('admin.ratings.show', $rating->id) }}" class="btn-act btn-detail" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.ratings.edit', $rating->id) }}" class="btn-act btn-edit" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.ratings.destroy', $rating->id) }}" style="display:inline;"
                                      onsubmit="return confirm('Hapus ulasan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-act btn-delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-star"></i></div>
                                <p>Belum ada ulasan</p>
                                <span>Ulasan akan muncul setelah pengguna memberikan rating buku</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <span>Menampilkan <strong style="color:var(--gray-900);">{{ $ratings->count() }}</strong> dari <strong style="color:var(--gray-900);">{{ $ratings->total() }}</strong> ulasan</span>
            <div>{{ $ratings->links() }}</div>
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

function filterTable(val) {
    var rows = document.querySelectorAll('#mainTable tbody tr');
    var q = val.toLowerCase();
    rows.forEach(function (r) { r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none'; });
}
</script>
</body>
</html>
