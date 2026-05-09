<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin — @yield('title', 'Dashboard')</title>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
:root {
  --bg: #080c0a; --bg2: #0d1410; --surface: #111a14;
  --accent: #39ff85; --accent2: #00d4a3; --red: #ff4d6d;
  --text: #e8f0eb; --muted: #6b8573; --border: #1e2e22;
  --mono: 'JetBrains Mono', monospace; --body: 'DM Sans', sans-serif;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { display: flex; min-height: 100vh; background: var(--bg); color: var(--text); font-family: var(--body); }

/* SIDEBAR */
.sidebar { width: 240px; min-height: 100vh; background: var(--surface); border-right: 1px solid var(--border); display: flex; flex-direction: column; padding: 2rem 0; flex-shrink: 0; position: sticky; top: 0; height: 100vh; overflow-y: auto; }
.sidebar-logo { padding: 0 1.5rem 2rem; font-family: var(--mono); font-size: 0.85rem; color: var(--accent); letter-spacing: 0.1em; border-bottom: 1px solid var(--border); margin-bottom: 1.5rem; }
.sidebar-logo span { display: block; font-size: 0.6rem; color: var(--muted); margin-top: 0.3rem; letter-spacing: 0.15em; text-transform: uppercase; }
.sidebar-nav { flex: 1; }
.sidebar-section { font-family: var(--mono); font-size: 0.58rem; color: var(--muted); letter-spacing: 0.2em; text-transform: uppercase; padding: 0 1.5rem; margin: 1.2rem 0 0.5rem; }
.sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1.5rem; font-family: var(--mono); font-size: 0.75rem; color: var(--muted); text-decoration: none; letter-spacing: 0.06em; transition: all 0.2s; border-left: 2px solid transparent; }
.sidebar-link:hover, .sidebar-link.active { color: var(--accent); background: rgba(57,255,133,0.05); border-left-color: var(--accent); }
.sidebar-link .icon { font-size: 1rem; }
.badge { background: var(--accent); color: var(--bg); font-size: 0.6rem; padding: 0.15rem 0.45rem; border-radius: 20px; margin-left: auto; font-weight: 500; }
.sidebar-footer { padding: 1.5rem; border-top: 1px solid var(--border); }
.sidebar-footer a { font-family: var(--mono); font-size: 0.7rem; color: var(--muted); text-decoration: none; display: flex; align-items: center; gap: 0.5rem; }
.sidebar-footer a:hover { color: var(--accent); }

/* MAIN */
.main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
.topbar { padding: 1.25rem 2rem; background: var(--surface); border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
.topbar-title { font-family: var(--mono); font-size: 0.8rem; color: var(--text); }
.topbar-breadcrumb { font-family: var(--mono); font-size: 0.65rem; color: var(--muted); }
.content { flex: 1; padding: 2rem; overflow-y: auto; }

/* FLASH */
.flash { padding: 0.9rem 1.5rem; font-family: var(--mono); font-size: 0.75rem; letter-spacing: 0.04em; margin-bottom: 1.5rem; border-radius: 0; }
.flash.success { background: rgba(57,255,133,0.08); border-left: 3px solid var(--accent); color: var(--accent); }
.flash.error { background: rgba(255,77,109,0.08); border-left: 3px solid var(--red); color: var(--red); }

/* CARDS */
.stat-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1px; background: var(--border); margin-bottom: 2rem; }
.stat-card { background: var(--surface); padding: 1.5rem; }
.stat-card-num { font-family: 'DM Sans'; font-size: 2rem; font-weight: 700; color: var(--accent); }
.stat-card-label { font-family: var(--mono); font-size: 0.65rem; color: var(--muted); letter-spacing: 0.1em; text-transform: uppercase; margin-top: 0.3rem; }

/* TABLE */
.table-wrap { background: var(--surface); border: 1px solid var(--border); overflow-x: auto; }
.table-header { display: flex; justify-content: space-between; align-items: center; padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); }
.table-header-title { font-family: var(--mono); font-size: 0.75rem; color: var(--text); letter-spacing: 0.06em; }
table { width: 100%; border-collapse: collapse; }
th { font-family: var(--mono); font-size: 0.62rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.12em; padding: 0.85rem 1.5rem; text-align: left; border-bottom: 1px solid var(--border); }
td { padding: 1rem 1.5rem; font-size: 0.88rem; border-bottom: 1px solid var(--border); vertical-align: middle; }
tr:last-child td { border-bottom: none; }
tr:hover td { background: rgba(57,255,133,0.03); }

/* BADGES */
.badge-pill { font-family: var(--mono); font-size: 0.62rem; padding: 0.2rem 0.6rem; letter-spacing: 0.06em; border: 1px solid; display: inline-block; }
.badge-green { color: var(--accent); border-color: rgba(57,255,133,0.3); background: rgba(57,255,133,0.06); }
.badge-red { color: var(--red); border-color: rgba(255,77,109,0.3); background: rgba(255,77,109,0.06); }
.badge-yellow { color: #febc2e; border-color: rgba(254,188,46,0.3); background: rgba(254,188,46,0.06); }

/* BUTTONS */
.btn { display: inline-flex; align-items: center; gap: 0.4rem; font-family: var(--mono); font-size: 0.72rem; letter-spacing: 0.08em; padding: 0.55rem 1.1rem; text-decoration: none; border: none; cursor: pointer; transition: all 0.2s; }
.btn-primary { background: var(--accent); color: var(--bg); }
.btn-primary:hover { opacity: 0.85; }
.btn-ghost { background: transparent; color: var(--muted); border: 1px solid var(--border); }
.btn-ghost:hover { border-color: var(--accent); color: var(--accent); }
.btn-danger { background: transparent; color: var(--red); border: 1px solid rgba(255,77,109,0.3); }
.btn-danger:hover { background: rgba(255,77,109,0.1); }
.btn-sm { padding: 0.35rem 0.75rem; font-size: 0.65rem; }

/* FORM STYLES */
.form-card { background: var(--surface); border: 1px solid var(--border); padding: 2rem; max-width: 760px; }
.form-group { margin-bottom: 1.5rem; }
.form-label { display: block; font-family: var(--mono); font-size: 0.65rem; color: var(--muted); letter-spacing: 0.15em; text-transform: uppercase; margin-bottom: 0.6rem; }
.form-input, .form-textarea, .form-select { width: 100%; background: var(--bg); border: 1px solid var(--border); color: var(--text); font-family: var(--body); font-size: 0.9rem; padding: 0.8rem 1rem; outline: none; transition: border-color 0.3s; }
.form-input:focus, .form-textarea:focus, .form-select:focus { border-color: var(--accent); }
.form-select option { background: var(--bg2); }
.form-textarea { min-height: 120px; resize: vertical; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.form-hint { font-family: var(--mono); font-size: 0.62rem; color: var(--muted); margin-top: 0.4rem; }
.form-error { font-family: var(--mono); font-size: 0.65rem; color: var(--red); margin-top: 0.4rem; display: block; }
.form-input.error { border-color: var(--red); }
.checkbox-row { display: flex; align-items: center; gap: 0.75rem; }
.checkbox-row input[type=checkbox] { accent-color: var(--accent); width: 16px; height: 16px; cursor: pointer; }
.checkbox-row label { font-family: var(--mono); font-size: 0.75rem; color: var(--text); cursor: pointer; }

/* ACTIONS */
.actions { display: flex; gap: 0.5rem; align-items: center; }

/* EMPTY STATE */
.empty-state { padding: 4rem; text-align: center; }
.empty-state p { font-family: var(--mono); color: var(--muted); font-size: 0.8rem; }

.project-thumb { width: 56px; height: 40px; object-fit: cover; border: 1px solid var(--border); }
.project-thumb-placeholder { width: 56px; height: 40px; background: var(--bg); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
</style>
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
  <div class="sidebar-logo">
    OM_DEV<span>Admin Panel</span>
  </div>
  <nav class="sidebar-nav">
    <div class="sidebar-section">Portfolio</div>
    <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.index') ? 'active' : '' }}">
      <span class="icon">📁</span> Projects
    </a>
    <a href="{{ route('admin.projects.create') }}" class="sidebar-link {{ request()->routeIs('admin.projects.create') ? 'active' : '' }}">
      <span class="icon">➕</span> Add Project
    </a>
    <div class="sidebar-section">Inbox</div>
    <a href="{{ route('admin.messages') }}" class="sidebar-link {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
      <span class="icon">✉</span> Messages
      @if(($unread ?? 0) > 0)
        <span class="badge">{{ $unread }}</span>
      @endif
    </a>
    <div class="sidebar-section">Site</div>
    <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
      <span class="icon">🌐</span> View Portfolio
    </a>
  </nav>
  <div class="sidebar-footer">
    <a href="{{ route('home') }}">← Back to Portfolio</a>
  </div>
</aside>

{{-- MAIN --}}
<div class="main">
  <div class="topbar">
    <div>
      <div class="topbar-title">@yield('title', 'Dashboard')</div>
      <div class="topbar-breadcrumb">Admin / @yield('breadcrumb', 'Dashboard')</div>
    </div>
    @yield('topbar-action')
  </div>

  <div class="content">
    @if(session('success'))
      <div class="flash success">✔ {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="flash error">✖ {{ session('error') }}</div>
    @endif

    @yield('content')
  </div>
</div>

@yield('scripts')
</body>
</html>
