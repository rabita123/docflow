<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin — Users — PDFTash</title>
<meta name="robots" content="noindex, nofollow">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:system-ui,sans-serif;background:#0d0d14;color:#eeeef8;min-height:100vh;padding:32px 24px;}
h1{font-size:22px;font-weight:700;margin-bottom:6px;}
.sub{color:#8888a8;font-size:14px;margin-bottom:28px;}
.stats{display:flex;gap:16px;flex-wrap:wrap;margin-bottom:28px;}
.stat{background:#13131e;border:1px solid rgba(255,255,255,.07);border-radius:12px;padding:16px 22px;min-width:150px;}
.stat-num{font-size:28px;font-weight:700;color:#5b5cff;}
.stat-label{font-size:12px;color:#8888a8;margin-top:4px;}
.stat-num.pro{color:#00e5a0;}
table{width:100%;border-collapse:collapse;background:#13131e;border-radius:12px;overflow:hidden;border:1px solid rgba(255,255,255,.07);}
thead{background:#1a1a28;}
th{padding:12px 16px;text-align:left;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#8888a8;}
td{padding:12px 16px;font-size:13px;border-top:1px solid rgba(255,255,255,.05);}
tr:hover td{background:rgba(255,255,255,.02);}
.badge{display:inline-block;padding:2px 10px;border-radius:99px;font-size:11px;font-weight:700;}
.badge-pro{background:rgba(0,229,160,.15);color:#00e5a0;border:1px solid rgba(0,229,160,.3);}
.badge-free{background:rgba(255,255,255,.06);color:#8888a8;border:1px solid rgba(255,255,255,.1);}
.search{width:100%;max-width:360px;padding:10px 14px;background:#13131e;border:1px solid rgba(255,255,255,.12);border-radius:10px;color:#eeeef8;font-size:14px;outline:none;margin-bottom:16px;}
.search:focus{border-color:#5b5cff;}
.empty{text-align:center;padding:48px;color:#8888a8;}
</style>
</head>
<body>
<h1>PDFTash — Users</h1>
<div class="sub">Admin panel · <a href="/dashboard" style="color:#5b5cff;text-decoration:none;">← Back to Dashboard</a></div>

<div class="stats">
  <div class="stat">
    <div class="stat-num">{{ $total }}</div>
    <div class="stat-label">Total Users</div>
  </div>
  <div class="stat">
    <div class="stat-num pro">{{ $proCount }}</div>
    <div class="stat-label">Pro Users</div>
  </div>
  <div class="stat">
    <div class="stat-num" style="color:#8888a8;">{{ $freeCount }}</div>
    <div class="stat-label">Free Users</div>
  </div>
  <div class="stat">
    <div class="stat-num" style="color:#ffa500;">{{ $todayCount }}</div>
    <div class="stat-label">Joined Today</div>
  </div>
</div>

<input class="search" type="text" placeholder="Search by name or email..." id="search" oninput="filterTable()">

<table id="users-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Plan</th>
      <th>Auth</th>
      <th>Joined</th>
    </tr>
  </thead>
  <tbody>
    @forelse($users as $u)
    <tr>
      <td style="color:#8888a8;">{{ $u->id }}</td>
      <td style="font-weight:600;">{{ $u->name ?: '—' }}</td>
      <td style="color:#8888a8;">{{ $u->email }}</td>
      <td><span class="badge {{ $u->plan === 'pro' ? 'badge-pro' : 'badge-free' }}">{{ strtoupper($u->plan ?? 'free') }}</span></td>
      <td style="color:#8888a8;font-size:12px;">{{ $u->google_id ? '🔵 Google' : '🔑 Email' }}</td>
      <td style="color:#8888a8;font-size:12px;">{{ \Carbon\Carbon::parse($u->created_at)->format('d M Y, H:i') }}</td>
    </tr>
    @empty
    <tr><td colspan="6" class="empty">No users found.</td></tr>
    @endforelse
  </tbody>
</table>

<script>
function filterTable(){
    const q = document.getElementById('search').value.toLowerCase();
    document.querySelectorAll('#users-table tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>
</body>
</html>
