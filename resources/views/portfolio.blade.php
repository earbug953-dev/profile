@extends('layouts.app')

@section('title', 'Omuruka Michael — Full Stack PHP & Laravel Developer')

@section('styles')
<style>
/* NAV */
nav {
  position: fixed; top: 0; left: 0; right: 0; z-index: 100;
  display: flex; align-items: center; justify-content: space-between;
  padding: 1.5rem 4rem;
  backdrop-filter: blur(12px);
  background: rgba(8,12,10,0.75);
  border-bottom: 1px solid var(--border);
  transition: background 0.3s;
}
.nav-logo { font-family: var(--mono); font-size: 0.8rem; color: var(--accent); letter-spacing: 0.1em; text-decoration: none; }
.nav-links { display: flex; gap: 2.5rem; list-style: none; }
.nav-links a { font-family: var(--mono); font-size: 0.72rem; color: var(--muted); text-decoration: none; letter-spacing: 0.12em; text-transform: uppercase; transition: color 0.3s; position: relative; }
.nav-links a::after { content: ''; position: absolute; bottom: -4px; left: 0; right: 0; height: 1px; background: var(--accent); transform: scaleX(0); transition: transform 0.3s; }
.nav-links a:hover { color: var(--accent); }
.nav-links a:hover::after { transform: scaleX(1); }
.nav-cta { font-family: var(--mono); font-size: 0.72rem; color: var(--bg); background: var(--accent); padding: 0.55rem 1.4rem; text-decoration: none; letter-spacing: 0.12em; text-transform: uppercase; transition: opacity 0.2s; }
.nav-cta:hover { opacity: 0.85; }

/* HERO */
.hero { min-height: 100vh; display: grid; grid-template-columns: 1fr 1fr; padding: 0 4rem; padding-top: 7rem; position: relative; overflow: hidden; }
.hero-grid-bg { position: absolute; inset: 0; background-image: linear-gradient(var(--border) 1px, transparent 1px), linear-gradient(90deg, var(--border) 1px, transparent 1px); background-size: 60px 60px; opacity: 0.35; mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black, transparent); }
.hero-left { display: flex; flex-direction: column; justify-content: center; padding-right: 4rem; position: relative; z-index: 1; }
.hero-tag { font-family: var(--mono); font-size: 0.72rem; color: var(--accent); letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.8rem; animation: fadeUp 0.8s ease both; }
.hero-tag::before { content: ''; display: inline-block; width: 32px; height: 1px; background: var(--accent); }
.avail-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent); display: inline-block; margin-right: 4px; animation: pulse 2s infinite; }
.hero-name { font-family: var(--display); font-size: clamp(3.5rem, 6vw, 5.5rem); font-weight: 900; line-height: 0.95; margin-bottom: 1.2rem; animation: fadeUp 0.8s 0.1s ease both; }
.hero-name .outline { color: transparent; -webkit-text-stroke: 1px var(--text); display: block; }
.hero-title { font-family: var(--mono); font-size: 0.85rem; color: var(--accent2); letter-spacing: 0.08em; margin-bottom: 2rem; animation: fadeUp 0.8s 0.2s ease both; }
.hero-desc { font-size: 1rem; line-height: 1.75; color: var(--muted); max-width: 420px; margin-bottom: 3rem; animation: fadeUp 0.8s 0.3s ease both; }
.hero-actions { display: flex; gap: 1.2rem; align-items: center; animation: fadeUp 0.8s 0.4s ease both; }
.btn { display: inline-block; font-family: var(--mono); font-size: 0.78rem; letter-spacing: 0.12em; text-transform: uppercase; text-decoration: none; padding: 0.9rem 2rem; transition: all 0.2s; border: none; cursor: pointer; }
.btn-primary { background: var(--accent); color: var(--bg); }
.btn-primary:hover { opacity: 0.9; transform: translateY(-2px); }
.btn-ghost { color: var(--text); border: 1px solid var(--border); background: transparent; }
.btn-ghost:hover { border-color: var(--accent); color: var(--accent); transform: translateY(-2px); }
.hero-right { display: flex; align-items: center; justify-content: center; position: relative; z-index: 1; animation: fadeIn 1.2s 0.5s ease both; }
.hero-card { width: 340px; background: var(--surface); border: 1px solid var(--border); padding: 2.5rem; position: relative; animation: float 4s ease-in-out infinite; }
.hero-card::before { content: ''; position: absolute; top: -1px; left: 24px; width: 80px; height: 3px; background: var(--accent); }
.hero-card-header { font-family: var(--mono); font-size: 0.68rem; color: var(--muted); letter-spacing: 0.15em; text-transform: uppercase; margin-bottom: 1.5rem; }
.stat-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem; }
.stat-num { font-family: var(--display); font-size: 2.2rem; font-weight: 700; color: var(--accent); line-height: 1; }
.stat-label { font-family: var(--mono); font-size: 0.65rem; color: var(--muted); letter-spacing: 0.1em; text-transform: uppercase; margin-top: 0.3rem; }
.tech-tags { display: flex; flex-wrap: wrap; gap: 0.5rem; }
.tag { font-family: var(--mono); font-size: 0.65rem; color: var(--accent); background: rgba(57,255,133,0.08); border: 1px solid rgba(57,255,133,0.2); padding: 0.3rem 0.7rem; letter-spacing: 0.08em; }
.hero-scroll { position: absolute; bottom: 3rem; left: 4rem; display: flex; align-items: center; gap: 1rem; font-family: var(--mono); font-size: 0.68rem; color: var(--muted); letter-spacing: 0.15em; text-transform: uppercase; z-index: 2; animation: fadeUp 1s 0.8s ease both; }
.scroll-line { width: 1px; height: 40px; background: linear-gradient(to bottom, var(--accent), transparent); animation: scrollPulse 2s infinite; }

/* SECTIONS */
section { padding: 7rem 4rem; position: relative; }
.section-label { font-family: var(--mono); font-size: 0.68rem; color: var(--accent); letter-spacing: 0.25em; text-transform: uppercase; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.8rem; }
.section-label::after { content: ''; flex: 1; max-width: 60px; height: 1px; background: var(--accent); opacity: 0.4; }
.section-heading { font-family: var(--display); font-size: clamp(2.2rem, 4vw, 3.5rem); font-weight: 700; line-height: 1.1; margin-bottom: 1.5rem; }
.bg2 { background: var(--bg2); }

/* SERVICES */
.services-intro { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: end; margin-bottom: 4rem; }
.services-desc { font-size: 1rem; line-height: 1.8; color: var(--muted); }
.services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: var(--border); border: 1px solid var(--border); }
.service-card { background: var(--surface); padding: 2.5rem; transition: background 0.3s; position: relative; overflow: hidden; }
.service-card::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: var(--accent); transform: scaleX(0); transition: transform 0.4s; transform-origin: left; }
.service-card:hover { background: #131f16; }
.service-card:hover::after { transform: scaleX(1); }
.service-num { font-family: var(--mono); font-size: 0.65rem; color: var(--muted); letter-spacing: 0.15em; margin-bottom: 1.5rem; }
.service-icon { font-size: 1.8rem; margin-bottom: 1.2rem; }
.service-title { font-family: var(--display); font-size: 1.3rem; font-weight: 700; margin-bottom: 0.8rem; }
.service-desc { font-size: 0.88rem; line-height: 1.7; color: var(--muted); }

/* SKILLS */
.skills-layout { display: grid; grid-template-columns: 1fr 1.4fr; gap: 6rem; align-items: start; }
.skill-item { padding: 1.5rem 0; border-bottom: 1px solid var(--border); }
.skill-item:first-child { border-top: 1px solid var(--border); }
.skill-meta { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.8rem; }
.skill-name { font-family: var(--mono); font-size: 0.8rem; letter-spacing: 0.08em; }
.skill-pct { font-family: var(--mono); font-size: 0.72rem; color: var(--accent); }
.skill-bar { height: 2px; background: var(--border); position: relative; overflow: hidden; }
.skill-fill { position: absolute; left: 0; top: 0; bottom: 0; background: linear-gradient(90deg, var(--accent), var(--accent2)); }
.tools-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: var(--border); }
.tool-item { background: var(--surface); padding: 1.5rem; text-align: center; transition: background 0.3s; }
.tool-item:hover { background: #131f16; }
.tool-icon { font-size: 1.6rem; margin-bottom: 0.5rem; }
.tool-name { font-family: var(--mono); font-size: 0.68rem; color: var(--muted); letter-spacing: 0.1em; text-transform: uppercase; }

/* PROJECTS */
.projects-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 3.5rem; }
.projects-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1px; background: var(--border); }
.project-card { background: var(--surface); padding: 3rem; position: relative; overflow: hidden; transition: background 0.3s; }
.project-card:hover { background: #131f16; }
.project-card.featured { grid-column: span 2; display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; }
.project-meta { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
.project-num { font-family: var(--mono); font-size: 0.65rem; color: var(--muted); letter-spacing: 0.15em; }
.project-type-badge { font-family: var(--mono); font-size: 0.65rem; color: var(--accent); background: rgba(57,255,133,0.08); border: 1px solid rgba(57,255,133,0.2); padding: 0.2rem 0.6rem; }
.project-title { font-family: var(--display); font-size: 1.5rem; font-weight: 700; margin-bottom: 0.8rem; }
.project-desc { font-size: 0.88rem; line-height: 1.7; color: var(--muted); margin-bottom: 1.5rem; }
.project-stack { display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 1.5rem; }
.project-links { display: flex; gap: 1.5rem; }
.project-link { font-family: var(--mono); font-size: 0.72rem; color: var(--accent); text-decoration: none; letter-spacing: 0.1em; display: inline-flex; align-items: center; gap: 0.4rem; transition: gap 0.3s; }
.project-link:hover { gap: 0.8rem; }
.project-img { width: 100%; height: 100%; min-height: 200px; object-fit: cover; display: block; }
.project-img-placeholder { background: var(--bg); border: 1px solid var(--border); min-height: 200px; display: flex; align-items: center; justify-content: center; }
.empty-projects { grid-column: span 2; background: var(--surface); padding: 5rem; text-align: center; border: 1px solid var(--border); }
.empty-projects p { font-family: var(--mono); color: var(--muted); font-size: 0.85rem; }
.terminal-window { background: #0a0f0c; border: 1px solid var(--border); width: 100%; height: 100%; min-height: 180px; padding: 1.2rem; font-family: var(--mono); font-size: 0.72rem; }
.terminal-bar { display: flex; gap: 0.4rem; margin-bottom: 1rem; }
.dot { width: 8px; height: 8px; border-radius: 50%; }
.dot.r { background: #ff5f57; } .dot.y { background: #febc2e; } .dot.g { background: #28c840; }
.terminal-line { color: var(--muted); line-height: 1.8; }
.kw { color: var(--accent); }
.cmd { color: var(--accent2); }
.terminal-cursor { display: inline-block; width: 8px; height: 14px; background: var(--accent); vertical-align: middle; animation: blink 1s infinite; }

/* PROCESS */
.process-steps { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1px; background: var(--border); margin-top: 3.5rem; }
.process-step { background: var(--surface); padding: 2.5rem 2rem; }
.step-num { font-family: var(--display); font-size: 4rem; font-weight: 900; color: transparent; -webkit-text-stroke: 1px var(--border); line-height: 1; margin-bottom: 1rem; }
.step-title { font-family: var(--display); font-size: 1.1rem; font-weight: 700; margin-bottom: 0.7rem; }
.step-desc { font-size: 0.85rem; line-height: 1.7; color: var(--muted); }

/* CONTACT */
.contact-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: start; margin-top: 3.5rem; }
.contact-heading { font-family: var(--display); font-size: clamp(2rem, 4vw, 3rem); font-weight: 700; line-height: 1.15; margin-bottom: 1.5rem; }
.contact-heading em { color: var(--accent); font-style: italic; }
.contact-desc { font-size: 0.95rem; line-height: 1.8; color: var(--muted); margin-bottom: 2.5rem; }
.contact-item { display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--border); font-family: var(--mono); font-size: 0.78rem; }
.contact-item:last-child { border-bottom: none; }
.contact-icon { color: var(--accent); }
.contact-label { color: var(--muted); min-width: 80px; font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase; }
.contact-val { color: var(--text); }
.form-group { margin-bottom: 1.5rem; }
.form-label { display: block; font-family: var(--mono); font-size: 0.65rem; color: var(--muted); letter-spacing: 0.15em; text-transform: uppercase; margin-bottom: 0.6rem; }
.form-input, .form-textarea { width: 100%; background: var(--surface); border: 1px solid var(--border); color: var(--text); font-family: var(--body); font-size: 0.92rem; padding: 0.9rem 1.2rem; outline: none; transition: border-color 0.3s; resize: none; }
.form-input:focus, .form-textarea:focus { border-color: var(--accent); }
.form-input.error, .form-textarea.error { border-color: var(--red); }
.form-error { font-family: var(--mono); font-size: 0.68rem; color: var(--red); margin-top: 0.4rem; display: block; }
.form-textarea { min-height: 140px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

/* FOOTER */
footer { padding: 2.5rem 4rem; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
.footer-copy { font-family: var(--mono); font-size: 0.68rem; color: var(--muted); letter-spacing: 0.08em; }
.footer-socials { display: flex; gap: 1.5rem; }
.footer-socials a { font-family: var(--mono); font-size: 0.68rem; color: var(--muted); text-decoration: none; letter-spacing: 0.1em; text-transform: uppercase; transition: color 0.3s; }
.footer-socials a:hover { color: var(--accent); }

/* REVEAL */
.reveal { opacity: 0; transform: translateY(32px); transition: opacity 0.7s ease, transform 0.7s ease; }
.reveal.visible { opacity: 1; transform: none; }
.reveal-delay-1 { transition-delay: 0.1s; }
.reveal-delay-2 { transition-delay: 0.2s; }
.reveal-delay-3 { transition-delay: 0.3s; }

/* ANIMATIONS */
@keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
@keyframes scrollPulse { 0%, 100% { opacity: 0.4; } 50% { opacity: 1; } }
@keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
@keyframes pulse { 0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(57,255,133,0.4); } 50% { box-shadow: 0 0 0 6px rgba(57,255,133,0); } }

@media (max-width: 900px) {
  nav { padding: 1.2rem 2rem; }
  .nav-links { display: none; }
  section { padding: 5rem 2rem; }
  .hero { grid-template-columns: 1fr; padding: 0 2rem; padding-top: 7rem; }
  .hero-right { display: none; }
  .services-intro { grid-template-columns: 1fr; gap: 1.5rem; }
  .services-grid { grid-template-columns: 1fr; }
  .skills-layout { grid-template-columns: 1fr; gap: 3rem; }
  .tools-grid { grid-template-columns: repeat(2, 1fr); }
  .projects-grid { grid-template-columns: 1fr; }
  .project-card.featured { grid-column: span 1; grid-template-columns: 1fr; }
  .process-steps { grid-template-columns: 1fr 1fr; }
  .contact-layout { grid-template-columns: 1fr; gap: 3rem; }
  .projects-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
  footer { flex-direction: column; gap: 1rem; text-align: center; }
  .hero-scroll { display: none; }
}
</style>
@endsection

@section('body')

{{-- NAV --}}
<nav id="main-nav">
  <a href="{{ route('home') }}" class="nav-logo">OM_DEV</a>
  <ul class="nav-links">
    <li><a href="#services">Services</a></li>
    <li><a href="#skills">Skills</a></li>
    <li><a href="#projects">Projects</a></li>
    <li><a href="#process">Process</a></li>
  </ul>
  <a href="#contact" class="nav-cta">Hire Me</a>
</nav>

{{-- HERO --}}
<section class="hero" id="home">
  <div class="hero-grid-bg"></div>
  <div class="hero-left">
    <div class="hero-tag">
      <span class="avail-dot"></span>Available for freelance
    </div>
    <h1 class="hero-name">
      Omuruka<br>
      <span class="outline">Michael</span>
    </h1>
    <div class="hero-title">// Full Stack Developer · PHP · Laravel</div>
    <p class="hero-desc">
      I build robust, scalable web applications that power real businesses.
      From elegant APIs to dynamic frontends — clean code, on time, every time.
    </p>
    <div class="hero-actions">
      <a href="#projects" class="btn btn-primary">View My Work</a>
      <a href="#contact" class="btn btn-ghost">Let's Talk</a>
    </div>
  </div>
  <div class="hero-right">
    <div class="hero-card">
      <div class="hero-card-header">// Quick Stats</div>
      <div class="stat-grid">
        <div><div class="stat-num">3+</div><div class="stat-label">Years Coding</div></div>
        <div><div class="stat-num">{{ $projects->count() ?: '20' }}+</div><div class="stat-label">Projects Built</div></div>
        <div><div class="stat-num">100%</div><div class="stat-label">On-time Delivery</div></div>
        <div><div class="stat-num">∞</div><div class="stat-label">Coffee Consumed</div></div>
      </div>
      <div class="tech-tags">
        <span class="tag">PHP 8</span>
        <span class="tag">Laravel</span>
        <span class="tag">MySQL</span>
        <span class="tag">Vue.js</span>
        <span class="tag">REST API</span>
        <span class="tag">Docker</span>
      </div>
    </div>
  </div>
  <div class="hero-scroll">
    <div class="scroll-line"></div>Scroll to explore
  </div>
</section>

{{-- SERVICES --}}
<section class="bg2" id="services">
  <div class="services-intro">
    <div>
      <div class="section-label reveal">What I Do</div>
      <h2 class="section-heading reveal reveal-delay-1">Services Built<br>to Grow Your Business</h2>
    </div>
    <p class="services-desc reveal reveal-delay-2">
      Every project starts with a conversation. I dig into your goals, constraints,
      and vision — then architect a solution that actually solves the problem.
    </p>
  </div>
  <div class="services-grid">
    @php
    $services = [
      ['01','⚙️','Backend Development','Custom PHP & Laravel applications with clean architecture, secure authentication, and databases that scale effortlessly.'],
      ['02','🔌','REST API Development','Well-documented, versioned APIs that connect your apps, mobile platforms, and third-party services without friction.'],
      ['03','🛒','E-Commerce Solutions','Full-featured stores with payment gateways, inventory management, order tracking, and custom admin dashboards.'],
      ['04','🖥️','Full Stack Web Apps','End-to-end applications from database schema to pixel-perfect UI — one developer, full accountability.'],
      ['05','🛡️','Maintenance & Support','Ongoing support, performance optimization, security audits, and upgrades to keep your app fast and safe.'],
      ['06','☁️','Deployment & DevOps','Server config, CI/CD pipelines, Docker, and cloud deployments on AWS, DigitalOcean, or your preferred host.'],
    ];
    @endphp
    @foreach($services as $i => $s)
    <div class="service-card reveal {{ $i > 0 ? 'reveal-delay-'.min($i,3) : '' }}">
      <div class="service-num">{{ $s[0] }}</div>
      <div class="service-icon">{{ $s[1] }}</div>
      <div class="service-title">{{ $s[2] }}</div>
      <p class="service-desc">{{ $s[3] }}</p>
    </div>
    @endforeach
  </div>
</section>

{{-- SKILLS --}}
<section id="skills">
  <div class="section-label reveal">Expertise</div>
  <h2 class="section-heading reveal reveal-delay-1">Tools of the Trade</h2>
  <div class="skills-layout" style="margin-top:3.5rem;">
    <div>
      @php
      $skills = [
        ['PHP / Laravel', 95],
        ['MySQL / PostgreSQL', 88],
        ['REST API Design', 92],
        ['JavaScript / Vue.js', 80],
        ['HTML / CSS / Tailwind', 85],
        ['Git / Docker / Linux', 82],
      ];
      @endphp
      @foreach($skills as $i => $sk)
      <div class="skill-item reveal {{ $i > 0 ? 'reveal-delay-'.min($i,3) : '' }}">
        <div class="skill-meta">
          <span class="skill-name">{{ $sk[0] }}</span>
          <span class="skill-pct">{{ $sk[1] }}%</span>
        </div>
        <div class="skill-bar">
          <div class="skill-fill" style="width:{{ $sk[1] }}%"></div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="tools-grid">
      @php
      $tools = [['🐘','PHP 8'],['🎯','Laravel'],['🗄️','MySQL'],['📦','Docker'],['🟢','Vue.js'],['🔑','Redis'],['☁️','AWS'],['🔀','Git'],['🎨','Tailwind']];
      @endphp
      @foreach($tools as $i => $t)
      <div class="tool-item reveal {{ $i > 0 ? 'reveal-delay-'.min($i,3) : '' }}">
        <div class="tool-icon">{{ $t[0] }}</div>
        <div class="tool-name">{{ $t[1] }}</div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- PROJECTS --}}
<section class="bg2" id="projects">
  <div class="projects-header">
    <div>
      <div class="section-label reveal">Portfolio</div>
      <h2 class="section-heading reveal reveal-delay-1">Selected Work</h2>
    </div>
  </div>

  <div class="projects-grid">
    @if($projects->isEmpty())
      <div class="empty-projects">
        <p>// Projects coming soon — check back later.</p>
      </div>
    @else
      @foreach($projects as $index => $project)
        @if($loop->first && $project->featured)
          {{-- FEATURED --}}
          <div class="project-card featured reveal">
            <div>
              <div class="project-meta">
                <span class="project-num">{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</span>
                <span class="project-type-badge">{{ $project->type }}</span>
              </div>
              <h3 class="project-title">{{ $project->title }}</h3>
              <p class="project-desc">{{ $project->description }}</p>
              <div class="project-stack">
                @foreach($project->tech_stack as $tech)
                  <span class="tag">{{ $tech }}</span>
                @endforeach
              </div>
              <div class="project-links">
                @if($project->project_url)
                  <a href="{{ $project->project_url }}" target="_blank" class="project-link">Live Demo →</a>
                @endif
                @if($project->github_url)
                  <a href="{{ $project->github_url }}" target="_blank" class="project-link">GitHub →</a>
                @endif
              </div>
            </div>
            <div class="project-img-placeholder">
              @if($project->image)
                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="project-img">
              @else
                <div class="terminal-window">
                  <div class="terminal-bar">
                    <div class="dot r"></div><div class="dot y"></div><div class="dot g"></div>
                  </div>
                  <div class="terminal-line"><span class="kw">$</span> php artisan serve</div>
                  <div class="terminal-line" style="color:#39ff85">✔ Server started</div>
                  <div class="terminal-line"><span class="kw">$</span> php artisan migrate</div>
                  <div class="terminal-line" style="color:#39ff85">✔ Database ready</div>
                  <div class="terminal-line"><span class="cmd">Running:</span> {{ $project->title }} <span class="terminal-cursor"></span></div>
                </div>
              @endif
            </div>
          </div>
        @else
          <div class="project-card reveal {{ $loop->index % 2 !== 0 ? 'reveal-delay-1' : '' }}">
            <div class="project-meta">
              <span class="project-num">{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</span>
              <span class="project-type-badge">{{ $project->type }}</span>
            </div>
            @if($project->image)
              <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="project-img" style="margin-bottom:1.5rem;max-height:160px;object-fit:cover;">
            @endif
            <h3 class="project-title">{{ $project->title }}</h3>
            <p class="project-desc">{{ $project->description }}</p>
            <div class="project-stack">
              @foreach($project->tech_stack as $tech)
                <span class="tag">{{ $tech }}</span>
              @endforeach
            </div>
            <div class="project-links">
              @if($project->project_url)
                <a href="{{ $project->project_url }}" target="_blank" class="project-link">Live Demo →</a>
              @endif
              @if($project->github_url)
                <a href="{{ $project->github_url }}" target="_blank" class="project-link">GitHub →</a>
              @endif
            </div>
          </div>
        @endif
      @endforeach
    @endif
  </div>
</section>

{{-- PROCESS --}}
<section id="process">
  <div class="section-label reveal">How I Work</div>
  <h2 class="section-heading reveal reveal-delay-1">My Process</h2>
  <div class="process-steps">
    @php
    $steps = [
      ['Discovery','We talk. I listen deeply. I map your goals, users, and constraints before touching a keyboard.'],
      ['Architecture','I design a solid technical blueprint — database schema, API structure, and system design.'],
      ['Development','Clean, tested, documented code. Weekly check-ins keep you in the loop with no surprises.'],
      ['Launch & Beyond','Smooth deployment, comprehensive handover docs, and ongoing support post-launch.'],
    ];
    @endphp
    @foreach($steps as $i => $step)
    <div class="process-step reveal {{ $i > 0 ? 'reveal-delay-'.min($i,3) : '' }}">
      <div class="step-num">0{{ $i + 1 }}</div>
      <div class="step-title">{{ $step[0] }}</div>
      <p class="step-desc">{{ $step[1] }}</p>
    </div>
    @endforeach
  </div>
</section>

{{-- CONTACT --}}
<section class="bg2" id="contact">
  <div class="section-label reveal">Get In Touch</div>

  @if(session('success'))
    <div class="flash success">✔ {{ session('success') }}</div>
  @endif

  <div class="contact-layout">
    <div class="contact-info reveal">
      <h2 class="contact-heading">Let's Build<br><em>Something Great</em><br>Together.</h2>
      <p class="contact-desc">
        Have a project in mind? Looking for a reliable developer who communicates
        well and delivers on time? Drop me a message and I'll reply within 24 hours.
      </p>
      <div>
        <div class="contact-item">
          <span class="contact-icon">✉</span>
          <span class="contact-label">Email</span>
          <span class="contact-val">omurukamichael@email.com</span>
        </div>
        <div class="contact-item">
          <span class="contact-icon">💼</span>
          <span class="contact-label">Upwork</span>
          <span class="contact-val">upwork.com/freelancers/omuruka</span>
        </div>
        <div class="contact-item">
          <span class="contact-icon">🐙</span>
          <span class="contact-label">GitHub</span>
          <span class="contact-val">github.com/omurukamichael</span>
        </div>
        <div class="contact-item">
          <span class="contact-icon">🕐</span>
          <span class="contact-label">Response</span>
          <span class="contact-val">Within 24 hours</span>
        </div>
      </div>
    </div>

    <div class="reveal reveal-delay-1">
      <form action="{{ route('contact') }}" method="POST">
        @csrf
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Name *</label>
            <input class="form-input @error('name') error @enderror" name="name" type="text" value="{{ old('name') }}" placeholder="John Doe" required>
            @error('name')<span class="form-error">{{ $message }}</span>@enderror
          </div>
          <div class="form-group">
            <label class="form-label">Email *</label>
            <input class="form-input @error('email') error @enderror" name="email" type="email" value="{{ old('email') }}" placeholder="you@company.com" required>
            @error('email')<span class="form-error">{{ $message }}</span>@enderror
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Project Type</label>
          <input class="form-input" name="project_type" type="text" value="{{ old('project_type') }}" placeholder="e.g. E-Commerce, API, SaaS...">
        </div>
        <div class="form-group">
          <label class="form-label">Budget Range</label>
          <input class="form-input" name="budget" type="text" value="{{ old('budget') }}" placeholder="e.g. $500 – $2,000">
        </div>
        <div class="form-group">
          <label class="form-label">Tell Me About Your Project *</label>
          <textarea class="form-textarea @error('message') error @enderror" name="message" placeholder="Describe your project, timeline, and requirements..." required>{{ old('message') }}</textarea>
          @error('message')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;font-size:0.8rem;padding:1rem;">
          Send Message →
        </button>
      </form>
    </div>
  </div>
</section>

{{-- FOOTER --}}
<footer>
  <div class="footer-copy">© {{ date('Y') }} Omuruka Michael. Built with ♥ and PHP.</div>
  <div class="footer-socials">
    <a href="#">GitHub</a>
    <a href="#">LinkedIn</a>
    <a href="#">Upwork</a>
    <a href="#">Twitter</a>
  </div>
</footer>

@endsection

@section('scripts')
<script>
window.addEventListener('scroll', () => {
  document.getElementById('main-nav').style.background =
    window.scrollY > 50 ? 'rgba(8,12,10,0.95)' : 'rgba(8,12,10,0.75)';
});
</script>
@endsection
