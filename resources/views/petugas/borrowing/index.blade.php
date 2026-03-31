<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman | PerpusInd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
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
            --blue:      #2563EB;
            --blue-bg:   #EFF6FF;
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
            .stats-grid { grid-template-columns: 1fr 1fr !important; }
            .page-hd { flex-direction: column; align-items: flex-start; }
        }

        /* ── MAIN ── */
        main { flex: 1; padding: 32px 36px; overflow-x: hidden; min-width: 0; }

        .page-hd { display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 26px; }
        .ph-sub-label { font-size: 11px; font-weight: 700; color: var(--gray-400); letter-spacing: .06em; text-transform: uppercase; margin-bottom: 5px; }
        .ph-title { font-size: 24px; font-weight: 800; letter-spacing: -.025em; }
        .ph-title span { color: var(--red); }
        .ph-desc { font-size: 13px; color: var(--gray-400); margin-top: 4px; }

        .btn-pdf { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; background: var(--red); color: #fff; border: none; border-radius: 9px; font-size: 13px; font-weight: 700; cursor: pointer; transition: background .15s, transform .15s; white-space: nowrap; }
        .btn-pdf:hover { background: var(--red-dk); transform: translateY(-1px); }

        /* Alert */
        .alert-success { margin-bottom: 18px; padding: 11px 15px; background: var(--green-bg); border: 1px solid #bbf7d0; color: var(--green); border-radius: 10px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px; animation: fadeDown .4s ease both; }

        /* ── STATS ── */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 24px; }
        @media (max-width: 1100px) { .stats-grid { grid-template-columns: 1fr 1fr; } }

        .stat-card { background: #fff; border: 1px solid var(--gray-200); border-radius: 12px; padding: 16px 18px; display: flex; align-items: center; gap: 13px; transition: transform .2s ease, box-shadow .2s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(0,0,0,.07); }
        .stat-icon { width: 40px; height: 40px; border-radius: 11px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 16px; }
        .stat-val { font-size: 26px; font-weight: 800; line-height: 1; }
        .stat-lbl { font-size: 11.5px; color: var(--gray-400); margin-top: 3px; font-weight: 500; }

        /* ── CARD ── */
        .card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; }
        .card-hd { padding: 15px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .card-hd-left { display: flex; align-items: center; gap: 10px; }
        .card-hd-icon { width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .card-hd-title { font-size: 14px; font-weight: 700; }
        .card-count { display: inline-flex; align-items: center; gap: 4px; padding: 2px 9px; border-radius: 999px; background: var(--red-bg); color: var(--red); font-size: 11px; font-weight: 700; margin-left: 7px; }

        .search-wrap { position: relative; }
        .search-wrap i { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 12px; pointer-events: none; }
        .search-wrap input { padding: 8px 13px 8px 32px; border: 1.5px solid var(--gray-200); border-radius: 9px; font-size: 12.5px; font-family: inherit; color: var(--gray-900); background: var(--gray-50); outline: none; width: 220px; transition: border .15s, box-shadow .15s; }
        .search-wrap input:focus { border-color: var(--red); background: #fff; box-shadow: 0 0 0 3px rgba(220,38,38,.07); }

        /* ── TABLE ── */
        .tbl-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 900px; }
        thead tr { background: var(--gray-50); border-bottom: 1px solid var(--gray-100); }
        th { padding: 10px 15px; font-size: 10.5px; font-weight: 700; letter-spacing: .07em; text-transform: uppercase; color: var(--gray-400); text-align: left; white-space: nowrap; }
        th:last-child { text-align: center; }
        td { padding: 12px 15px; font-size: 13px; vertical-align: middle; border-bottom: 1px solid var(--gray-100); }
        tbody tr { transition: background .12s; }
        tbody tr:hover { background: #FFF8F8; }
        tbody tr:last-child td { border-bottom: none; }

        .row-num { font-size: 12px; font-weight: 700; color: var(--gray-300); }

        .user-cell { display: flex; align-items: center; gap: 8px; }
        .u-avatar { width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0; background: var(--red); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 11px; font-weight: 700; }
        .u-name { font-weight: 700; color: var(--gray-900); white-space: nowrap; max-width: 130px; overflow: hidden; text-overflow: ellipsis; }

        .book-title { font-weight: 600; color: var(--gray-700); max-width: 160px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block; }

        .date-cell { display: flex; align-items: center; gap: 5px; color: var(--gray-400); font-size: 12.5px; white-space: nowrap; }
        .date-cell i { color: var(--gray-300); font-size: 10px; }

        .return-ok      { display: flex; align-items: center; gap: 5px; color: var(--green); font-weight: 600; font-size: 12.5px; white-space: nowrap; }
        .return-pending { display: flex; align-items: center; gap: 5px; color: var(--gray-400); font-size: 12.5px; font-style: italic; white-space: nowrap; }

        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 9px; border-radius: 999px; font-size: 11px; font-weight: 600; white-space: nowrap; }
        .badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: currentColor; opacity: .7; }
        .badge-pending  { background: var(--amber-bg); color: var(--amber); }
        .badge-approved { background: var(--blue-bg);  color: var(--blue); }
        .badge-returned { background: var(--green-bg); color: var(--green); }
        .badge-rejected { background: var(--red-sf);   color: var(--red); }

        .action-cell { display: flex; align-items: center; justify-content: center; gap: 4px; flex-wrap: wrap; }
        .btn-act { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 7px; font-size: 11.5px; font-weight: 700; border: none; cursor: pointer; font-family: inherit; text-decoration: none; white-space: nowrap; transition: background .12s, transform .12s; }
        .btn-act:hover { transform: translateY(-1px); }
        .btn-approve { background: var(--green-bg); color: var(--green); }
        .btn-approve:hover { background: #bbf7d0; }
        .btn-reject  { background: var(--red-sf);  color: var(--red); }
        .btn-reject:hover  { background: #fecaca; }
        .btn-detail  { background: var(--sky-bg);  color: var(--sky); }
        .btn-detail:hover  { background: #bae6fd; }
        .btn-edit    { background: var(--amber-bg); color: var(--amber); }
        .btn-edit:hover    { background: #fde68a; }
        .btn-delete  { background: var(--gray-100); color: var(--gray-500); border: 1px solid var(--gray-200); }
        .btn-delete:hover  { background: var(--gray-200); color: var(--gray-700); }

        .empty-state { padding: 60px 20px; text-align: center; }
        .empty-icon { width: 56px; height: 56px; border-radius: 16px; margin: 0 auto 14px; background: var(--gray-100); display: flex; align-items: center; justify-content: center; }
        .empty-icon i { font-size: 22px; color: var(--gray-300); }
        .empty-state p    { color: var(--gray-400); font-size: 13px; font-weight: 500; }
        .empty-state span { font-size: 12px; color: var(--gray-300); }

        .card-footer { padding: 13px 22px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; font-size: 12.5px; color: var(--gray-400); font-weight: 500; }
        .pager { display: flex; gap: 4px; }
        .pager-btn { width: 30px; height: 30px; border: 1.5px solid var(--gray-200); border-radius: 7px; background: none; font-size: 12px; font-family: inherit; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background .12s, border .12s, color .12s; color: var(--gray-500); }
        .pager-btn:hover:not(:disabled) { border-color: var(--red); color: var(--red); background: var(--red-bg); }
        .pager-btn.active { background: var(--red); border-color: var(--red); color: #fff; }
        .pager-btn:disabled { opacity: .35; cursor: not-allowed; }

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

    <div class="page-hd au d1">
        <div>
            <div class="ph-sub-label">Petugas Panel</div>
            <h1 class="ph-title">Riwayat <span>Peminjaman</span></h1>
            <p class="ph-desc">Kelola dan pantau semua peminjaman buku</p>
        </div>
        <button onclick="exportPDF()" class="btn-pdf">
            <i class="fas fa-file-pdf"></i> Export PDF
        </button>
    </div>

    @if(session('success'))
    <div class="alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    {{-- STATS --}}
    <div class="stats-grid au d2">
        <div class="stat-card">
            <div class="stat-icon" style="background:var(--blue-bg);"><i class="fas fa-list" style="color:var(--blue);"></i></div>
            <div>
                <div class="stat-val" style="color:var(--blue);">{{ $borrowings->count() }}</div>
                <div class="stat-lbl">Total Peminjaman</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:var(--amber-bg);"><i class="fas fa-hourglass-half" style="color:var(--amber);"></i></div>
            <div>
                <div class="stat-val" style="color:var(--amber);">{{ $borrowings->where('status','pending')->count() }}</div>
                <div class="stat-lbl">Menunggu</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:var(--green-bg);"><i class="fas fa-check-circle" style="color:var(--green);"></i></div>
            <div>
                <div class="stat-val" style="color:var(--green);">{{ $borrowings->where('status','returned')->count() }}</div>
                <div class="stat-lbl">Dikembalikan</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:var(--red-sf);"><i class="fas fa-times-circle" style="color:var(--red);"></i></div>
            <div>
                <div class="stat-val" style="color:var(--red);">{{ $borrowings->where('status','rejected')->count() }}</div>
                <div class="stat-lbl">Ditolak</div>
            </div>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="card au d3">
        <div class="card-hd">
            <div class="card-hd-left">
                <div class="card-hd-icon" style="background:var(--red-bg);">
                    <i class="fas fa-handshake" style="color:var(--red);"></i>
                </div>
                <div>
                    <span class="card-hd-title">Daftar Peminjaman</span>
                    <span class="card-count"><i class="fas fa-layer-group" style="font-size:9px;"></i> {{ $borrowings->count() }} data</span>
                </div>
            </div>
            <div class="search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari nama atau buku…" oninput="filterTable(this.value)">
            </div>
        </div>

        <div class="tbl-wrap">
            <table id="mainTable">
                <thead>
                    <tr>
                        <th style="width:44px">#</th>
                        <th>User</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Pengembalian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $i => $borrow)
                    <tr>
                        <td><span class="row-num">{{ $i + 1 }}</span></td>
                        <td>
                            <div class="user-cell">
                                <div class="u-avatar">{{ strtoupper(substr($borrow->user->name ?? 'U', 0, 1)) }}</div>
                                <span class="u-name">{{ $borrow->user->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td><span class="book-title">{{ $borrow->book->judul ?? '-' }}</span></td>
                        <td>
                            <div class="date-cell">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $borrow->created_at->format('d M Y') }}
                            </div>
                        </td>
                        <td>
                            @if($borrow->returned_at)
                                <div class="return-ok"><i class="fas fa-check-circle"></i> {{ \Carbon\Carbon::parse($borrow->returned_at)->format('d M Y') }}</div>
                            @else
                                <div class="return-pending"><i class="fas fa-clock"></i> Belum dikembalikan</div>
                            @endif
                        </td>
                        <td>
                            @if($borrow->status === 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @elseif($borrow->status === 'approved')
                                <span class="badge badge-approved">Disetujui</span>
                            @elseif($borrow->status === 'returned')
                                <span class="badge badge-returned">Dikembalikan</span>
                            @else
                                <span class="badge badge-rejected">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-cell">
                                @if($borrow->status === 'pending')
                                    <form method="POST" action="{{ route('petugas.borrowings.approve', $borrow) }}" style="display:inline">
                                        @csrf
                                        <button type="submit" class="btn-act btn-approve"><i class="fas fa-check"></i> Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('petugas.borrowings.reject', $borrow) }}" style="display:inline">
                                        @csrf
                                        <button type="submit" class="btn-act btn-reject"><i class="fas fa-times"></i> Reject</button>
                                    </form>
                                @endif
                                <a href="{{ route('petugas.borrowings.show', $borrow->id) }}" class="btn-act btn-detail"><i class="fas fa-eye"></i> Detail</a>
                                <a href="{{ route('petugas.borrowings.edit', $borrow->id) }}" class="btn-act btn-edit"><i class="fas fa-pen"></i> Edit</a>
                                <form method="POST" action="{{ route('petugas.borrowings.destroy', $borrow) }}" style="display:inline" onsubmit="return confirm('Hapus data peminjaman ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-act btn-delete"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                                <p>Belum ada data peminjaman</p>
                                <span>Data peminjaman akan muncul setelah pengguna melakukan peminjaman</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <span id="pagerInfo">Menampilkan data</span>
            <div class="pager" id="pagerBtns"></div>
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

// ── PAGINATION ──
const PER_PAGE = 10;
let currentPage = 1;
let allRows = [];

document.addEventListener('DOMContentLoaded', () => {
    allRows = Array.from(document.querySelectorAll('#mainTable tbody tr'));
    renderPage();
});

function renderPage() {
    const q = (document.getElementById('searchInput')?.value || '').toLowerCase();
    const filtered = allRows.filter(r => q === '' || r.textContent.toLowerCase().includes(q));
    const total = filtered.length;
    const totalPages = Math.max(1, Math.ceil(total / PER_PAGE));
    if (currentPage > totalPages) currentPage = totalPages;
    const start = (currentPage - 1) * PER_PAGE;
    const end = Math.min(start + PER_PAGE, total);

    allRows.forEach(r => r.style.display = 'none');
    filtered.forEach((r, i) => { r.style.display = (i >= start && i < end) ? '' : 'none'; });

    document.getElementById('pagerInfo').innerHTML =
        total === 0 ? 'Tidak ada data' :
        'Menampilkan <strong style="color:var(--gray-900)">' + (start+1) + '–' + end + '</strong> dari <strong style="color:var(--gray-900)">' + total + '</strong> data';

    buildPager(totalPages);
}

function buildPager(total) {
    const wrap = document.getElementById('pagerBtns');
    wrap.innerHTML = '';
    const mkBtn = (html, enabled, onClick, extraClass) => {
        const b = document.createElement('button');
        b.className = 'pager-btn' + (extraClass ? ' ' + extraClass : '');
        b.innerHTML = html;
        b.disabled = !enabled;
        if (enabled) b.addEventListener('click', () => { onClick(); renderPage(); });
        return b;
    };
    wrap.appendChild(mkBtn('<i class="fas fa-chevron-left"></i>', currentPage > 1, () => currentPage--));
    for (let p = 1; p <= total; p++) {
        if (total > 7 && Math.abs(p - currentPage) > 1 && p !== 1 && p !== total) {
            if (p === 2 || p === total - 1) {
                const d = document.createElement('span');
                d.textContent = '…';
                d.style.cssText = 'display:flex;align-items:center;padding:0 4px;color:var(--gray-400);font-size:13px';
                wrap.appendChild(d);
            }
            continue;
        }
        wrap.appendChild(mkBtn(p, true, (pg => () => currentPage = pg)(p), p === currentPage ? 'active' : ''));
    }
    wrap.appendChild(mkBtn('<i class="fas fa-chevron-right"></i>', currentPage < total, () => currentPage++));
}

function filterTable(val) { currentPage = 1; renderPage(); }

// ── EXPORT PDF ──
function exportPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({ orientation: "landscape" });
    const pageWidth = doc.internal.pageSize.getWidth();

    doc.setFillColor(153, 27, 27);
    doc.rect(0, 0, pageWidth, 28, "F");
    doc.setFont("helvetica", "bold");
    doc.setFontSize(16);
    doc.setTextColor(255, 255, 255);
    doc.text("LAPORAN PEMINJAMAN BUKU", pageWidth / 2, 13, { align: "center" });
    doc.setFont("helvetica", "normal");
    doc.setFontSize(9);
    doc.setTextColor(255, 200, 200);
    doc.text("PerpusInd – Perpustakaan Digital", pageWidth / 2, 22, { align: "center" });

    doc.setFontSize(8);
    doc.setTextColor(100, 100, 100);
    const tglEkspor = new Date().toLocaleDateString("id-ID", { day: "numeric", month: "long", year: "numeric" });
    doc.text("Diekspor pada: " + tglEkspor, 14, 36);
    doc.setFont("helvetica", "bold");
    doc.setTextColor(153, 27, 27);
    doc.text("Total Data: " + allRows.length + " peminjaman", pageWidth - 14, 36, { align: "right" });

    allRows.forEach(r => r.style.display = "");
    const originalTable = document.getElementById("mainTable");
    const cloneTable = originalTable.cloneNode(true);
    cloneTable.id = "mainTableExport";
    cloneTable.style.display = "none";
    document.body.appendChild(cloneTable);

    const headers = cloneTable.querySelectorAll("thead th");
    let aksiIndex = -1;
    headers.forEach((th, i) => {
        if (["aksi","action","opsi"].includes(th.innerText.trim().toLowerCase())) aksiIndex = i;
    });
    if (aksiIndex !== -1) {
        cloneTable.querySelectorAll("tr").forEach(tr => {
            const cells = tr.querySelectorAll("th, td");
            if (cells[aksiIndex]) cells[aksiIndex].remove();
        });
    }

    doc.autoTable({
        html: "#mainTableExport",
        startY: 42,
        theme: "grid",
        headStyles: { fillColor: [153,27,27], textColor:[255,255,255], fontStyle:"bold", fontSize:9, halign:"center", valign:"middle", cellPadding:4 },
        bodyStyles: { fontSize:8.5, textColor:[30,30,30], valign:"middle", cellPadding:3 },
        alternateRowStyles: { fillColor:[254,242,242] },
        columnStyles: { 0: { halign:"center", cellWidth:12 } },
        didDrawCell: function(data) {
            if (data.column.index === 5 && data.section === "body") {
                const status = data.cell.text[0]?.toLowerCase() || "";
                let color;
                if (status.includes("kembali")) color = [22,163,74];
                else if (status.includes("tolak")) color = [220,38,38];
                else if (status.includes("setuju")) color = [37,99,235];
                else color = [215,119,6];
                const { x, y, width, height } = data.cell;
                const bW = width-6, bH = height-4, bX = x+3, bY = y+2;
                doc.setFillColor(...color);
                doc.roundedRect(bX, bY, bW, bH, 2, 2, "F");
                doc.setFont("helvetica","bold");
                doc.setFontSize(7.5);
                doc.setTextColor(255,255,255);
                doc.text(data.cell.text[0]||"", bX+bW/2, bY+bH/2+1, { align:"center" });
            }
        },
        didDrawPage: function(data) {
            const footerY = doc.internal.pageSize.getHeight() - 10;
            doc.setDrawColor(200,200,200);
            doc.setLineWidth(0.3);
            doc.line(14, footerY-4, pageWidth-14, footerY-4);
            doc.setFont("helvetica","italic");
            doc.setFontSize(7.5);
            doc.setTextColor(150,150,150);
            doc.text("Dokumen diterbitkan otomatis oleh sistem PerpusInd.", 14, footerY);
            doc.text("Halaman " + data.pageNumber, pageWidth-14, footerY, { align:"right" });
        },
    });

    cloneTable.remove();
    doc.save("laporan-peminjaman.pdf");
    renderPage();
}
</script>
</body>
</html>
