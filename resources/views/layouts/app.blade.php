<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Omuruka Michael — Full Stack Developer')</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=JetBrains+Mono:wght@300;400;500&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
:root {
  --bg: #080c0a; --bg2: #0d1410; --surface: #111a14;
  --accent: #39ff85; --accent2: #00d4a3;
  --text: #e8f0eb; --muted: #6b8573; --border: #1e2e22;
  --mono: 'JetBrains Mono', monospace;
  --display: 'Playfair Display', serif;
  --body: 'DM Sans', sans-serif;
  --red: #ff4d6d;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { background: var(--bg); color: var(--text); font-family: var(--body); font-weight: 300; overflow-x: hidden; }
body::before {
  content: ''; position: fixed; inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  pointer-events: none; z-index: 9997; opacity: 0.35;
}
/* Flash messages */
.flash { padding: 1rem 2rem; font-family: var(--mono); font-size: 0.78rem; letter-spacing: 0.05em; }
.flash.success { background: rgba(57,255,133,0.1); border-left: 3px solid var(--accent); color: var(--accent); }
.flash.error   { background: rgba(255,77,109,0.1);  border-left: 3px solid var(--red);   color: var(--red); }
@yield('styles')
</style>
@yield('head')
</head>
<body>
@yield('body')
<script>
// Reveal on scroll
const reveals = document.querySelectorAll('.reveal');
const obs = new IntersectionObserver(entries =>
  entries.forEach(e => e.isIntersecting && e.target.classList.add('visible'))
, { threshold: 0.08 });
reveals.forEach(r => obs.observe(r));
</script>
@yield('scripts')
</body>
</html>
