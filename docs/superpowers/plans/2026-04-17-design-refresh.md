# AFibRisk Design Refresh — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace the current Bootstrap/multi-background design with a modern "Dashboard Médico" identity (dark topbar, clinical blue accents, Inter typography, sidebar-based question navigation) and add Copy / PDF / CSV / Print exports on the results page.

**Architecture:** CodeIgniter 3 views + `style.css` rewrite (no framework) + new `export.js` module loaded only on the results page. Controller untouched except for a single line that persists raw inputs in the session so exports can access them. All scores, condicional field logic, and Tippy tooltip infrastructure preserved.

**Tech Stack:** PHP 7+ (CodeIgniter 3), vanilla JS (ES6), CSS custom properties, Inter font (Google Fonts), Tippy.js + Popper (existing), html2pdf.js 0.10.1 (new CDN), no build step.

**Testing note:** This codebase has no automated test harness (no PHPUnit, no Jest). Each task ends with a manual verification step describing what to check in a browser using XAMPP (`http://localhost/afibrisk/plataforma/`). Screenshot evidence is the acceptance criterion.

---

## File Structure

**Modify (rewrite):**
- `plataforma/application/views/header.php` — chrome, Inter font, Tippy/Popper, no Bootstrap
- `plataforma/application/views/footer.php` — jQuery + Tippy/Popper only
- `plataforma/application/views/home.php` — landing
- `plataforma/application/views/sobre.php` — about
- `plataforma/application/views/perguntas/home.php` — questions with sidebar nav
- `plataforma/application/views/resultado/home.php` — results with toolbar + cards + pdf template
- `plataforma/assets/css/style.css` — full rewrite with design tokens

**Modify (surgical):**
- `plataforma/application/controllers/Home.php:154` — add one line before `redirect('results')` to persist raw inputs

**Create:**
- `plataforma/assets/js/export.js` — Copy, CSV, PDF, Print helpers + toast system

---

## Task 1: Controller — persist inputs for exports

**Files:**
- Modify: `plataforma/application/controllers/Home.php:153-154`

- [ ] **Step 1: Read current code at the injection point**

Run: open `plataforma/application/controllers/Home.php` and confirm line 154 is `redirect('results');` inside `public function todasRespostas()`. The array `$dados` built in lines 51–97 uses the key pattern `pergunta_N`.

- [ ] **Step 2: Add session persistence for raw POST inputs**

Modify `plataforma/application/controllers/Home.php` — replace:

```php
		//18. ASAS
		$this->calculaASAS($dados);

		redirect('results');
	}
```

with:

```php
		//18. ASAS
		$this->calculaASAS($dados);

		// Persist raw inputs for exports (Copy, CSV, PDF) on the results page
		$this->session->set_userdata('respostas', $this->input->post());

		redirect('results');
	}
```

- [ ] **Step 3: Verify manually**

In a terminal: `grep -n "respostas" plataforma/application/controllers/Home.php` — expect one hit showing the new line.

Start XAMPP. Open `http://localhost/afibrisk/plataforma/questions`. Fill a couple of fields and submit. On the results page, open DevTools console and run:
```js
fetch('/afibrisk/plataforma/index.php', { credentials: 'include' })
```
Not conclusive without PHPSESSID inspection — instead run in the console on results: this step is validated indirectly when Task 8 renders `window.AFIBRISK_INPUTS` and you see the values. For now just confirm the page still loads and results still show.

- [ ] **Step 4: Commit**

```bash
git add plataforma/application/controllers/Home.php
git commit -m "Persist raw inputs in session for exports"
```

---

## Task 2: CSS foundation — design tokens + base styles

**Files:**
- Modify (rewrite): `plataforma/assets/css/style.css`

- [ ] **Step 1: Back up current style.css reference**

Run: `cp plataforma/assets/css/style.css plataforma/assets/css/style.css.old` (optional, for quick rollback during dev — will be removed before commit).

- [ ] **Step 2: Replace style.css entirely with the foundation**

Overwrite `plataforma/assets/css/style.css` with:

```css
/* ============================================================================
   AFibRisk — Design tokens
   ============================================================================ */
:root {
    --color-ink:          #0f172a;
    --color-ink-2:        #1e293b;
    --color-muted:        #64748b;
    --color-border:       #e2e8f0;
    --color-surface:      #ffffff;
    --color-surface-alt:  #f8fafc;
    --color-primary:      #2563eb;
    --color-primary-dark: #1d4ed8;
    --color-success:      #16a34a;
    --color-danger:       #dc2626;

    --font-sans: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
    --font-mono: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace;

    --space-1: 4px;
    --space-2: 8px;
    --space-3: 12px;
    --space-4: 16px;
    --space-6: 24px;
    --space-8: 32px;
    --space-12: 48px;

    --radius-sm: 6px;
    --radius:    10px;
    --radius-lg: 16px;

    --shadow-sm: 0 1px 2px rgba(15, 23, 42, 0.06);
    --shadow:    0 4px 12px rgba(15, 23, 42, 0.08);

    --topbar-h: 56px;
    --sidebar-w: 260px;
}

/* ============================================================================
   Reset + base
   ============================================================================ */
*, *::before, *::after { box-sizing: border-box; }
html, body { margin: 0; padding: 0; }
body {
    font-family: var(--font-sans);
    font-size: 15px;
    line-height: 1.5;
    color: var(--color-ink-2);
    background: var(--color-surface-alt);
    min-height: 100vh;
    -webkit-font-smoothing: antialiased;
}

h1, h2, h3, h4 { color: var(--color-ink); font-weight: 700; margin: 0 0 var(--space-4); line-height: 1.25; }
h1 { font-size: 32px; }
h2 { font-size: 22px; }
h3 { font-size: 18px; }
p  { margin: 0 0 var(--space-4); }
a  { color: var(--color-primary); text-decoration: none; }
a:hover { text-decoration: underline; }

/* ============================================================================
   Focus ring — accessibility baseline
   ============================================================================ */
:focus-visible {
    outline: 2px solid var(--color-primary);
    outline-offset: 2px;
    border-radius: 2px;
}

/* ============================================================================
   Utility
   ============================================================================ */
.sr-only {
    position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px;
    overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0;
}
.container-narrow {
    max-width: 720px; margin: 0 auto; padding: var(--space-8) var(--space-4);
}

/* ============================================================================
   Buttons
   ============================================================================ */
.btn {
    display: inline-flex; align-items: center; justify-content: center; gap: var(--space-2);
    padding: 10px 18px; border: 1px solid transparent; border-radius: var(--radius-sm);
    font-family: inherit; font-size: 14px; font-weight: 600;
    cursor: pointer; text-decoration: none; transition: background 120ms, border-color 120ms;
    background: transparent; color: var(--color-ink);
}
.btn:hover { text-decoration: none; }
.btn-primary { background: var(--color-primary); color: #fff; }
.btn-primary:hover { background: var(--color-primary-dark); color: #fff; }
.btn-secondary { background: var(--color-surface); color: var(--color-ink); border-color: var(--color-border); }
.btn-secondary:hover { background: var(--color-surface-alt); }
.btn-ghost { background: transparent; color: var(--color-muted); }
.btn-ghost:hover { color: var(--color-ink); background: var(--color-surface-alt); }
.btn[aria-disabled="true"] { opacity: 0.5; pointer-events: none; }

/* ============================================================================
   Topbar — shared across all pages
   ============================================================================ */
.topbar {
    position: sticky; top: 0; z-index: 20;
    height: var(--topbar-h);
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 var(--space-4);
    background: var(--color-ink); color: #e2e8f0;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.topbar .brand { display: inline-flex; align-items: center; gap: var(--space-2); font-weight: 700; color: #fff; font-size: 15px; letter-spacing: 0.01em; text-decoration: none; }
.topbar .brand:hover { text-decoration: none; }
.topbar .brand::before { content: ""; display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: var(--color-primary); }
.topbar nav { display: flex; gap: var(--space-2); align-items: center; }
.topbar nav a { color: #cbd5e1; font-size: 14px; font-weight: 500; padding: 6px 10px; border-radius: var(--radius-sm); }
.topbar nav a:hover { color: #fff; background: rgba(255,255,255,0.08); text-decoration: none; }
.topbar .hamburger {
    display: none; background: none; border: 0; color: #cbd5e1; font-size: 22px; cursor: pointer;
    padding: 4px 8px; border-radius: var(--radius-sm);
}
.topbar .hamburger:hover { background: rgba(255,255,255,0.08); color: #fff; }

/* ============================================================================
   Forms
   ============================================================================ */
label { display: block; font-size: 13px; font-weight: 600; color: var(--color-ink-2); margin-bottom: 6px; }
input[type="text"], input[type="number"] {
    display: block; width: 100%; max-width: 220px;
    padding: 8px 10px; font-family: inherit; font-size: 14px;
    color: var(--color-ink); background: var(--color-surface);
    border: 1px solid var(--color-border); border-radius: var(--radius-sm);
    outline: none; transition: border-color 120ms, box-shadow 120ms;
}
input[type="text"]:focus, input[type="number"]:focus {
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
}

/* Pill radios: Yes/No, alcohol, etc. */
.pill-group { display: inline-flex; flex-wrap: wrap; gap: 8px; }
.pill-group input[type="radio"] { position: absolute; opacity: 0; pointer-events: none; }
.pill-group label {
    display: inline-flex; align-items: center;
    padding: 6px 14px; margin: 0;
    background: var(--color-surface); color: var(--color-ink-2);
    border: 1px solid var(--color-border); border-radius: 999px;
    font-size: 13px; font-weight: 500; cursor: pointer;
    transition: background 120ms, border-color 120ms, color 120ms;
}
.pill-group label:hover { border-color: var(--color-muted); }
.pill-group input[type="radio"]:checked + label {
    background: var(--color-primary); color: #fff; border-color: var(--color-primary);
}
.pill-group input[type="radio"]:focus-visible + label {
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
}

/* Field row (label + control inline on desktop) */
.field { margin-bottom: var(--space-4); }
.field .hint { font-size: 12px; color: var(--color-muted); margin-top: 4px; }
.field-row { display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-4); }

/* ============================================================================
   Scrollbar (webkit)
   ============================================================================ */
::-webkit-scrollbar        { width: 10px; height: 10px; }
::-webkit-scrollbar-track  { background: var(--color-surface-alt); }
::-webkit-scrollbar-thumb  { background: #cbd5e1; border-radius: 999px; }
::-webkit-scrollbar-thumb:hover { background: var(--color-muted); }

/* ============================================================================
   Tippy tooltip theme override — matches new palette
   ============================================================================ */
.tippy-box[data-theme='customTooltipCssTema'] {
    background: #0f172a; color: #f8fafc;
    border: 1px solid #1e293b; border-radius: var(--radius-sm);
    font-weight: 500; font-size: 13px; line-height: 1.45;
    max-width: 420px !important;
}
.tippy-box[data-theme='customTooltipCssTema'] .tippy-content { padding: 10px 12px; }
```

Note: task 2 intentionally stops at this foundation. Page-specific styles (home, sobre, sidebar, results cards, drawer, print) are appended by their own tasks.

- [ ] **Step 3: Verify manually**

Open `http://localhost/afibrisk/plataforma/` — the page will look broken (old views still reference Bootstrap which is being removed in Task 3); that's expected at this stage. Open DevTools Elements tab and confirm the custom properties exist on `:root`. Network tab should still show `style.css` loading (status 200).

If you created the `.old` backup in step 1, delete it now: `rm plataforma/assets/css/style.css.old`.

- [ ] **Step 4: Commit**

```bash
git add plataforma/assets/css/style.css
git commit -m "Rewrite style.css foundation with design tokens and base styles"
```

---

## Task 3: Shared chrome — header.php and footer.php

**Files:**
- Modify (rewrite): `plataforma/application/views/header.php`
- Modify (rewrite): `plataforma/application/views/footer.php`

- [ ] **Step 1: Rewrite header.php**

Overwrite `plataforma/application/views/header.php` with:

```php
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="AFibRisk — Atrial Fibrillation risk assessment tool">

<title><?php print($titulo); ?></title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css') ?>">

<script src="<?php echo base_url('assets/js/fontawsome1935e00f36.js') ?>" crossorigin="anonymous"></script>
```

Key changes from the current header: Bootstrap 5 CSS/JS removed; Multicolore Pro + Roboto Condensed replaced by Inter + JetBrains Mono; FontAwesome kept (used by `.fa-info-circle` on the results page).

- [ ] **Step 2: Rewrite footer.php**

Overwrite `plataforma/application/views/footer.php` with:

```php
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
```

Key change: jQuery slim (no AJAX/events) swapped for full jQuery 3.6 — Tippy doesn't need jQuery at all, but existing code (`$('.show-reference').click` in the results view) does. Keeping it avoids rewriting that handler.

- [ ] **Step 3: Verify manually**

Refresh `http://localhost/afibrisk/plataforma/`. Open DevTools Network tab — confirm Inter font loads (woff2 requests to fonts.gstatic.com), Tippy loads, Bootstrap does NOT load. Console should have no 404s. The pages will still look unstyled for their bodies (views not yet rewritten) — that's expected.

- [ ] **Step 4: Commit**

```bash
git add plataforma/application/views/header.php plataforma/application/views/footer.php
git commit -m "Replace Bootstrap with Inter typography in shared chrome"
```

---

## Task 4: Landing page — home.php

**Files:**
- Modify (rewrite): `plataforma/application/views/home.php`
- Modify (append): `plataforma/assets/css/style.css`

- [ ] **Step 1: Append home-specific styles to style.css**

Append to `plataforma/assets/css/style.css`:

```css
/* ============================================================================
   Home page
   ============================================================================ */
.home-hero {
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    min-height: calc(100vh - var(--topbar-h));
    padding: var(--space-12) var(--space-4);
    text-align: center;
}
.home-hero .eyebrow {
    font-size: 12px; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--color-primary); margin-bottom: var(--space-4);
}
.home-hero h1 { font-size: 48px; margin-bottom: var(--space-4); }
.home-hero .lead {
    font-size: 18px; color: var(--color-muted); max-width: 520px; margin: 0 auto var(--space-8);
}
.home-hero .actions { display: inline-flex; gap: var(--space-3); }
@media (max-width: 640px) {
    .home-hero h1 { font-size: 34px; }
    .home-hero .lead { font-size: 16px; }
    .home-hero .actions { flex-direction: column; width: 100%; max-width: 320px; }
    .home-hero .actions .btn { width: 100%; }
}
```

- [ ] **Step 2: Rewrite home.php**

Overwrite `plataforma/application/views/home.php` with:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('header'); ?>
</head>
<body>
    <header class="topbar">
        <a href="<?php echo base_url(); ?>" class="brand">AFibRisk</a>
        <nav>
            <a href="<?php echo base_url('about'); ?>">About</a>
        </nav>
    </header>

    <main class="home-hero">
        <div class="eyebrow">Clinical Risk Assessment</div>
        <h1>AFibRisk</h1>
        <p class="lead">A research tool that aggregates 17 clinical scores for Atrial Fibrillation risk prediction from published literature.</p>
        <div class="actions">
            <a href="<?php echo base_url('questions'); ?>" class="btn btn-primary">Start assessment</a>
            <a href="<?php echo base_url('about'); ?>" class="btn btn-secondary">About</a>
        </div>
    </main>

    <?php $this->load->view('footer'); ?>
</body>
</html>
```

- [ ] **Step 3: Verify manually**

Reload `http://localhost/afibrisk/plataforma/`. Expected: dark topbar with "AFibRisk" + "About" link; centered hero with eyebrow, large title, muted lead text, and two buttons. Click "Start assessment" — should navigate to `/questions`. Resize window to 375px — actions stack vertically and become full-width. Take a screenshot.

- [ ] **Step 4: Commit**

```bash
git add plataforma/application/views/home.php plataforma/assets/css/style.css
git commit -m "Rewrite landing page with hero layout"
```

---

## Task 5: About page — sobre.php

**Files:**
- Modify (rewrite): `plataforma/application/views/sobre.php`
- Modify (append): `plataforma/assets/css/style.css`

- [ ] **Step 1: Append about-specific styles to style.css**

Append to `plataforma/assets/css/style.css`:

```css
/* ============================================================================
   About page
   ============================================================================ */
.about-section { margin-bottom: var(--space-8); }
.about-section h2 { font-size: 18px; margin-bottom: var(--space-3); }
.about-section p  { color: var(--color-ink-2); }
.about-credits p { margin-bottom: var(--space-1); color: var(--color-muted); font-size: 14px; }
.about-credits p:first-child { color: var(--color-ink); font-weight: 600; font-size: 15px; }
.disclaimer-card {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-left: 4px solid var(--color-danger);
    border-radius: var(--radius);
    padding: var(--space-6);
    box-shadow: var(--shadow-sm);
}
.disclaimer-card h2 { color: var(--color-danger); text-transform: uppercase; letter-spacing: 0.05em; font-size: 13px; }
.disclaimer-card p { font-size: 13px; color: var(--color-ink-2); margin-bottom: var(--space-3); }
.disclaimer-card p:last-child { margin-bottom: 0; }
```

- [ ] **Step 2: Rewrite sobre.php**

Overwrite `plataforma/application/views/sobre.php` with:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('header'); ?>
</head>
<body>
    <header class="topbar">
        <a href="<?php echo base_url(); ?>" class="brand">AFibRisk</a>
        <nav>
            <a href="<?php echo base_url(); ?>">Home</a>
        </nav>
    </header>

    <main class="container-narrow">
        <h1>About AFibRisk</h1>

        <section class="about-section about-credits">
            <p>Created by Joao Brainer C de Andrade, MD, PhD</p>
            <p>Universidade Federal de São Paulo, Brazil</p>
            <p>Department of Health Informatics</p>
            <p>Department of Neurology</p>
            <p><a href="mailto:joao.brainer@unifesp.br">joao.brainer@unifesp.br</a></p>
        </section>

        <section class="about-section">
            <p>Application developed by <a href="https://www.linkedin.com/in/danielsciarotta/" target="_blank" rel="noopener">Daniel Sciarotta Zaveri</a>.</p>
        </section>

        <section class="disclaimer-card">
            <h2>Disclaimer</h2>
            <p>This application is made available solely for personal non-commercial, teaching and educational use. This application is NOT a medical device and does not and should not be construed to provide health-related or medical advice, or clinical decision support, or to support or replace the diagnosis, or another kind of medical decision. This application does not create a physician–patient relationship between the above-mentioned institutions and any individual. You, the user, agree to use this application under all these terms and conditions. If you do not agree to all of these terms of use, do not use this site.</p>
            <p>Dr. Joao Andrade and the developers make no representations as to any matter whatsoever, including accuracy, fitness for a particular purpose or non-infringement.</p>
            <p>Dr. Joao Andrade and the developers are not liable to you or anyone else for any decision made or action taken based on reliance upon the information contained on or provided through this website. The use of the information shall be at your own risk.</p>
        </section>
    </main>

    <?php $this->load->view('footer'); ?>
</body>
</html>
```

- [ ] **Step 3: Verify manually**

Visit `http://localhost/afibrisk/plataforma/about`. Expected: topbar, narrow container with title "About AFibRisk", credits section, and a disclaimer card with a red left border. Text should be readable. Take a screenshot.

- [ ] **Step 4: Commit**

```bash
git add plataforma/application/views/sobre.php plataforma/assets/css/style.css
git commit -m "Rewrite about page with narrow container and disclaimer card"
```

---

## Task 6: Questions page — markup rewrite

**Files:**
- Modify (rewrite): `plataforma/application/views/perguntas/home.php`
- Modify (append): `plataforma/assets/css/style.css`

This task is the biggest of the plan. It produces the full new markup for the questions page with sidebar layout, sections, and pill radios — but NO JS behaviors yet (those come in Task 7). The form will be functional (can submit), just without scroll-spy, progress, drawer, or conditional fields.

- [ ] **Step 1: Append questions-page styles to style.css**

Append to `plataforma/assets/css/style.css`:

```css
/* ============================================================================
   Questions page layout
   ============================================================================ */
.questions-shell {
    display: grid;
    grid-template-columns: var(--sidebar-w) 1fr;
    min-height: calc(100vh - var(--topbar-h));
}

.sidebar {
    position: sticky; top: var(--topbar-h);
    height: calc(100vh - var(--topbar-h));
    padding: var(--space-6) var(--space-4);
    background: var(--color-surface);
    border-right: 1px solid var(--color-border);
    display: flex; flex-direction: column; gap: var(--space-4);
    overflow-y: auto;
}
.sidebar h2 {
    font-size: 11px; font-weight: 700; letter-spacing: 0.08em;
    text-transform: uppercase; color: var(--color-muted);
    margin-bottom: var(--space-2);
}
.sidebar ul { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 2px; }
.sidebar li a {
    display: flex; align-items: center; gap: var(--space-2);
    padding: 8px 10px; border-radius: var(--radius-sm);
    color: var(--color-ink-2); font-size: 14px; font-weight: 500;
    text-decoration: none;
}
.sidebar li a:hover { background: var(--color-surface-alt); text-decoration: none; }
.sidebar li a .marker {
    width: 18px; height: 18px; flex: 0 0 18px;
    display: inline-flex; align-items: center; justify-content: center;
    border: 1.5px solid var(--color-border); border-radius: 50%;
    color: var(--color-muted); font-size: 11px; font-weight: 700;
}
.sidebar li a.active { background: rgba(37, 99, 235, 0.08); color: var(--color-primary); }
.sidebar li a.active .marker { border-color: var(--color-primary); background: var(--color-primary); color: #fff; }
.sidebar li a.done .marker { border-color: var(--color-success); background: var(--color-success); color: #fff; }
.sidebar li a.done .marker::before { content: "✓"; }

.sidebar .progress { margin-top: auto; padding-top: var(--space-4); border-top: 1px solid var(--color-border); }
.sidebar .progress-label { display: flex; justify-content: space-between; font-size: 12px; color: var(--color-muted); margin-bottom: 6px; }
.sidebar .progress-bar { height: 6px; background: var(--color-border); border-radius: 999px; overflow: hidden; }
.sidebar .progress-fill { height: 100%; background: var(--color-primary); width: 0%; transition: width 180ms ease; }
.sidebar .btn-calculate-wrap { margin-top: var(--space-4); }
.sidebar .btn-calculate-wrap .btn { width: 100%; }

.questions-content { padding: var(--space-8) var(--space-6); max-width: 880px; }
.question-section { scroll-margin-top: calc(var(--topbar-h) + var(--space-4)); margin-bottom: var(--space-12); }
.question-section h2 { font-size: 22px; }
.question-section .section-hint { color: var(--color-muted); font-size: 14px; margin-bottom: var(--space-6); }
.question-section .field-row { margin-bottom: var(--space-4); }
.question-section .divider { height: 1px; background: var(--color-border); margin: var(--space-8) 0; }

.section-nav { display: flex; justify-content: space-between; gap: var(--space-3); margin-top: var(--space-6); }
.section-nav .btn[data-disabled="true"] { visibility: hidden; }

.tooltip-trigger {
    display: inline-block; margin-left: 6px;
    width: 16px; height: 16px; line-height: 16px; text-align: center;
    border-radius: 50%; border: 1px solid var(--color-border);
    color: var(--color-muted); font-size: 11px; font-weight: 700;
    cursor: help;
}
.tooltip-trigger:hover { color: var(--color-primary); border-color: var(--color-primary); }

.drawer-backdrop { display: none; }

@media (max-width: 1023px) {
    :root { --sidebar-w: 220px; }
    .questions-content .field-row { grid-template-columns: 1fr; }
}

@media (max-width: 767px) {
    .questions-shell { grid-template-columns: 1fr; }
    .topbar .hamburger { display: inline-flex; }
    .sidebar {
        position: fixed; top: var(--topbar-h); left: 0;
        width: 85%; max-width: 320px; height: calc(100vh - var(--topbar-h));
        z-index: 15;
        transform: translateX(-100%);
        transition: transform 220ms ease;
        border-right: 1px solid var(--color-border);
        box-shadow: var(--shadow);
    }
    .sidebar.open { transform: translateX(0); }
    .drawer-backdrop {
        display: block; position: fixed; inset: var(--topbar-h) 0 0 0;
        background: rgba(15, 23, 42, 0.5);
        opacity: 0; pointer-events: none; transition: opacity 200ms;
        z-index: 14;
    }
    .drawer-backdrop.open { opacity: 1; pointer-events: auto; }
    .questions-content { padding: var(--space-6) var(--space-4) 96px; }
    .sidebar .btn-calculate-wrap { display: none; }
    .mobile-submit {
        position: fixed; left: 0; right: 0; bottom: 0; z-index: 10;
        padding: var(--space-3) var(--space-4);
        background: var(--color-surface);
        border-top: 1px solid var(--color-border);
    }
    .mobile-submit .btn { width: 100%; }
}
@media (min-width: 768px) {
    .mobile-submit { display: none; }
}
```

- [ ] **Step 2: Rewrite perguntas/home.php — full markup**

Overwrite `plataforma/application/views/perguntas/home.php` with:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('header'); ?>
</head>
<body>
    <header class="topbar">
        <button type="button" class="hamburger" id="drawerToggle" aria-label="Open sections" aria-expanded="false">&#9776;</button>
        <a href="<?php echo base_url(); ?>" class="brand">AFibRisk / Assessment</a>
        <nav>
            <a href="<?php echo base_url('about'); ?>">About</a>
        </nav>
    </header>

    <div class="drawer-backdrop" id="drawerBackdrop"></div>

    <?= form_open("home/todasRespostas", 'id="formprincipal"'); ?>
    <div class="questions-shell">
        <aside class="sidebar" id="sidebar" aria-label="Sections">
            <h2>Sections</h2>
            <ul>
                <li><a href="#demographic"     data-section="demographic"><span class="marker">1</span> Demographic</a></li>
                <li><a href="#neurological"    data-section="neurological"><span class="marker">2</span> Neurological</a></li>
                <li><a href="#body-metrics"    data-section="body-metrics"><span class="marker">3</span> Body metrics</a></li>
                <li><a href="#history"         data-section="history"><span class="marker">4</span> Personal history</a></li>
                <li><a href="#echography"      data-section="echography"><span class="marker">5</span> Echography</a></li>
                <li><a href="#ecg"             data-section="ecg"><span class="marker">6</span> Electrocardiogram</a></li>
                <li><a href="#cardiology"      data-section="cardiology"><span class="marker">7</span> Cardiology &amp; general</a></li>
            </ul>

            <div class="progress">
                <div class="progress-label"><span>Progress</span><span id="progressPct">0%</span></div>
                <div class="progress-bar"><div class="progress-fill" id="progressFill"></div></div>
            </div>
            <div class="btn-calculate-wrap">
                <button type="submit" class="btn btn-primary">Calculate</button>
            </div>
        </aside>

        <div class="questions-content">

            <section class="question-section" id="demographic">
                <h2>Demographic</h2>
                <div class="field"><label for="age">Age</label>
                    <input type="number" id="age" name="1_age" inputmode="numeric" min="0" max="120" autocomplete="off">
                </div>
                <div class="field"><label>Gender</label>
                    <div class="pill-group">
                        <input type="radio" id="gender_male" name="2_gender" value="male"><label for="gender_male">Male</label>
                        <input type="radio" id="gender_female" name="2_gender" value="female"><label for="gender_female">Female</label>
                    </div>
                </div>
                <div class="field"><label>White</label>
                    <div class="pill-group">
                        <input type="radio" id="white_yes" name="27_white" value="yes"><label for="white_yes">Yes</label>
                        <input type="radio" id="white_no"  name="27_white" value="no"><label for="white_no">No</label>
                    </div>
                </div>
                <div class="field"><label>Black</label>
                    <div class="pill-group">
                        <input type="radio" id="black_yes" name="28_black" value="yes"><label for="black_yes">Yes</label>
                        <input type="radio" id="black_no"  name="28_black" value="no"><label for="black_no">No</label>
                    </div>
                </div>
            </section>

            <section class="question-section" id="neurological">
                <h2>Neurological</h2>
                <div class="field"><label for="nihss">NIH Stroke Scale on admission</label>
                    <input type="number" id="nihss" name="3_nihss" inputmode="numeric" min="0" max="42" autocomplete="off">
                </div>
                <div class="field"><label>Previous Stroke or Transient Ischemic Attack</label>
                    <div class="pill-group">
                        <input type="radio" id="stroke_yes" name="30_stroke" value="yes"><label for="stroke_yes">Yes</label>
                        <input type="radio" id="stroke_no"  name="30_stroke" value="no"><label for="stroke_no">No</label>
                    </div>
                </div>
            </section>

            <section class="question-section" id="body-metrics">
                <h2>Body metrics and laboratory</h2>
                <div class="field-row">
                    <div class="field"><label for="height_cm">Height (cm)</label>
                        <input type="number" id="height_cm" name="12_height_cm" inputmode="numeric" autocomplete="off">
                    </div>
                    <div class="field"><label for="weight_kg">Weight (kg)</label>
                        <input type="number" id="weight_kg" name="13_weight_kg" inputmode="numeric" autocomplete="off">
                    </div>
                </div>
                <div class="field-row">
                    <div class="field"><label for="systolic_bp">Systolic BP (mmHg)</label>
                        <input type="number" id="systolic_bp" name="15_systolic_bp" inputmode="numeric" autocomplete="off">
                    </div>
                    <div class="field"><label for="diastolic_bp">Diastolic BP (mmHg)</label>
                        <input type="number" id="diastolic_bp" name="16_diastolic_bp" inputmode="numeric" autocomplete="off">
                    </div>
                </div>
                <div class="field"><label>Raised BMI (BMI &gt; 30 kg/m²)</label>
                    <div class="pill-group">
                        <input type="radio" id="raised_bmi_yes" name="20_raised_bmi" value="yes"><label for="raised_bmi_yes">Yes</label>
                        <input type="radio" id="raised_bmi_no"  name="20_raised_bmi" value="no"><label for="raised_bmi_no">No</label>
                    </div>
                </div>
                <div id="bmi_25_container" hidden>
                    <div class="field"><label>BMI ≥ 25 kg/m²</label>
                        <div class="pill-group">
                            <input type="radio" id="bmi_25_yes" name="20_1_bmi_25" value="yes"><label for="bmi_25_yes">Yes</label>
                            <input type="radio" id="bmi_25_no"  name="20_1_bmi_25" value="no"><label for="bmi_25_no">No</label>
                        </div>
                    </div>
                    <div id="additional_bmi_content" hidden>
                        <div class="field"><label for="bmi_value">BMI (kg/m²)</label>
                            <input type="number" id="bmi_value" name="20_2_bmi_value" inputmode="decimal" step="0.01" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="field-row">
                    <div class="field"><label for="waist">Waist circumference (cm)</label>
                        <input type="number" id="waist" name="34_waist_circumference" inputmode="numeric" autocomplete="off">
                    </div>
                    <div class="field"><label for="hr">Heart rate (bpm)</label>
                        <input type="number" id="hr" name="35_heart_rate" inputmode="numeric" autocomplete="off">
                    </div>
                </div>
                <div class="field"><label for="ldl">Cholesterol LDL-C (mg/dL)</label>
                    <input type="number" id="ldl" name="33_cholesterol_ldl" inputmode="numeric" autocomplete="off">
                </div>
            </section>

            <section class="question-section" id="history">
                <h2>Personal history</h2>
                <div class="field"><label>History of Coronary Disease</label>
                    <div class="pill-group">
                        <input type="radio" id="coronary_yes" name="6_coronary_disease" value="yes"><label for="coronary_yes">Yes</label>
                        <input type="radio" id="coronary_no"  name="6_coronary_disease" value="no"><label for="coronary_no">No</label>
                    </div>
                </div>
                <div class="field"><label>History of COPD</label>
                    <div class="pill-group">
                        <input type="radio" id="copd_yes" name="7_copd" value="yes"><label for="copd_yes">Yes</label>
                        <input type="radio" id="copd_no"  name="7_copd" value="no"><label for="copd_no">No</label>
                    </div>
                </div>
                <div class="field"><label>History of Arterial Hypertension</label>
                    <div class="pill-group">
                        <input type="radio" id="htn_yes" name="8_hypertension" value="yes"><label for="htn_yes">Yes</label>
                        <input type="radio" id="htn_no"  name="8_hypertension" value="no"><label for="htn_no">No</label>
                    </div>
                </div>
                <div class="field"><label>History of Heart Failure</label>
                    <div class="pill-group">
                        <input type="radio" id="hf_yes" name="9_heart_failure" value="yes"><label for="hf_yes">Yes</label>
                        <input type="radio" id="hf_no"  name="9_heart_failure" value="no"><label for="hf_no">No</label>
                    </div>
                </div>
                <div class="field"><label>Known Hyperthyroidism</label>
                    <div class="pill-group">
                        <input type="radio" id="hyper_yes" name="10_hyperthyroidism" value="yes"><label for="hyper_yes">Yes</label>
                        <input type="radio" id="hyper_no"  name="10_hyperthyroidism" value="no"><label for="hyper_no">No</label>
                    </div>
                </div>
                <div class="field"><label>Smoking</label>
                    <div class="pill-group">
                        <input type="radio" id="smoking_yes" name="14_smoking" value="yes"><label for="smoking_yes">Yes</label>
                        <input type="radio" id="smoking_no"  name="14_smoking" value="no"><label for="smoking_no">No</label>
                    </div>
                </div>
                <div id="former_smoker_container" hidden>
                    <div class="field"><label>Former smoker</label>
                        <div class="pill-group">
                            <input type="radio" id="former_yes" name="14_1_former_smoker" value="yes"><label for="former_yes">Yes</label>
                            <input type="radio" id="former_no"  name="14_1_former_smoker" value="no"><label for="former_no">No</label>
                        </div>
                    </div>
                </div>
                <div class="field"><label>History of Diabetes</label>
                    <div class="pill-group">
                        <input type="radio" id="dm_yes" name="17_diabetes" value="yes"><label for="dm_yes">Yes</label>
                        <input type="radio" id="dm_no"  name="17_diabetes" value="no"><label for="dm_no">No</label>
                    </div>
                </div>
                <div class="field"><label>Sleep apnea</label>
                    <div class="pill-group">
                        <input type="radio" id="sleep_yes" name="21_sleep_apnea" value="yes"><label for="sleep_yes">Yes</label>
                        <input type="radio" id="sleep_no"  name="21_sleep_apnea" value="no"><label for="sleep_no">No</label>
                    </div>
                </div>
                <div class="field"><label>Alcohol consumption</label>
                    <div class="pill-group">
                        <input type="radio" id="alc_0"    name="22_alcohol_consumption" value="0"><label for="alc_0">0</label>
                        <input type="radio" id="alc_0_7"  name="22_alcohol_consumption" value="0_7"><label for="alc_0_7">0–7 / week</label>
                        <input type="radio" id="alc_7_14" name="22_alcohol_consumption" value="7_14"><label for="alc_7_14">7–14 / week</label>
                        <input type="radio" id="alc_15"   name="22_alcohol_consumption" value="15_plus"><label for="alc_15">15+ / week</label>
                        <input type="radio" id="alc_none" name="22_alcohol_consumption" value="none"><label for="alc_none">None</label>
                    </div>
                </div>
                <div class="field"><label>Peripheral Vascular Disease</label>
                    <div class="pill-group">
                        <input type="radio" id="pvd_yes" name="26_vascular_disease" value="yes"><label for="pvd_yes">Yes</label>
                        <input type="radio" id="pvd_no"  name="26_vascular_disease" value="no"><label for="pvd_no">No</label>
                    </div>
                </div>
                <div class="field"><label>End-stage renal disease</label>
                    <div class="pill-group">
                        <input type="radio" id="renal_yes" name="31_renal_disease" value="yes"><label for="renal_yes">Yes</label>
                        <input type="radio" id="renal_no"  name="31_renal_disease" value="no"><label for="renal_no">No</label>
                    </div>
                </div>
            </section>

            <section class="question-section" id="echography">
                <h2>Echography</h2>
                <div class="field"><label for="la_size">Left Atrium Size (mm)</label>
                    <input type="number" id="la_size" name="4_left_atrium_size" inputmode="numeric" autocomplete="off">
                </div>
                <div class="field"><label>Presence of septal aneurysm</label>
                    <div class="pill-group">
                        <input type="radio" id="septal_yes" name="5_septal_aneurysm" value="yes"><label for="septal_yes">Yes</label>
                        <input type="radio" id="septal_no"  name="5_septal_aneurysm" value="no"><label for="septal_no">No</label>
                    </div>
                </div>
                <div class="field"><label id="field_1">Valve Disease <span class="tooltip-trigger">i</span></label>
                    <div class="pill-group">
                        <input type="radio" id="valve_yes" name="25_valve_disease" value="yes"><label for="valve_yes">Yes</label>
                        <input type="radio" id="valve_no"  name="25_valve_disease" value="no"><label for="valve_no">No</label>
                    </div>
                </div>
            </section>

            <section class="question-section" id="ecg">
                <h2>Electrocardiogram</h2>
                <div class="field"><label>Left Ventricular Hypertrophy</label>
                    <div class="pill-group">
                        <input type="radio" id="lvh_yes" name="18_ecg_lv_hypertrophy" value="yes"><label for="lvh_yes">Yes</label>
                        <input type="radio" id="lvh_no"  name="18_ecg_lv_hypertrophy" value="no"><label for="lvh_no">No</label>
                    </div>
                </div>
                <div class="field"><label for="pr">PR Interval (ms)</label>
                    <input type="number" id="pr" name="19_ecg_pr_interval" inputmode="numeric" autocomplete="off">
                </div>
                <div class="field"><label id="field_2">Presence of Left Atrial Enlargement <span class="tooltip-trigger">i</span></label>
                    <div class="pill-group">
                        <input type="radio" id="lae_yes" name="29_left_atrial_enlargement" value="yes"><label for="lae_yes">Yes</label>
                        <input type="radio" id="lae_no"  name="29_left_atrial_enlargement" value="no"><label for="lae_no">No</label>
                    </div>
                </div>
                <div class="field"><label id="field_3">Atrial premature contraction/complex <span class="tooltip-trigger">i</span></label>
                    <div class="pill-group">
                        <input type="radio" id="apc_yes" name="36_atrial_premature_contraction" value="yes"><label for="apc_yes">Yes</label>
                        <input type="radio" id="apc_no"  name="36_atrial_premature_contraction" value="no"><label for="apc_no">No</label>
                    </div>
                </div>
                <div class="field"><label id="field_4">Ventricular premature contraction/complex <span class="tooltip-trigger">i</span></label>
                    <div class="pill-group">
                        <input type="radio" id="vpc_yes" name="37_ventricular_premature_contraction" value="yes"><label for="vpc_yes">Yes</label>
                        <input type="radio" id="vpc_no"  name="37_ventricular_premature_contraction" value="no"><label for="vpc_no">No</label>
                    </div>
                </div>
                <div class="field"><label>Arrhythmia (other than AF)</label>
                    <div class="pill-group">
                        <input type="radio" id="arr_yes" name="32_arrhythmia" value="yes"><label for="arr_yes">Yes</label>
                        <input type="radio" id="arr_no"  name="32_arrhythmia" value="no"><label for="arr_no">No</label>
                    </div>
                </div>
            </section>

            <section class="question-section" id="cardiology">
                <h2>Cardiology and general</h2>
                <div class="field"><label>Presence of symptomatic extra- or intracranial stenosis ≥50%, symptomatic arterial dissection, or clinico-radiological lacunar syndrome</label>
                    <div class="pill-group">
                        <input type="radio" id="sten_yes" name="23_symptomatic_stenosis" value="yes"><label for="sten_yes">Yes</label>
                        <input type="radio" id="sten_no"  name="23_symptomatic_stenosis" value="no"><label for="sten_no">No</label>
                    </div>
                </div>
                <div class="field"><label id="field_5">Significant Murmur <span class="tooltip-trigger">i</span></label>
                    <div class="pill-group">
                        <input type="radio" id="murmur_yes" name="24_significant_murmur" value="yes"><label for="murmur_yes">Yes</label>
                        <input type="radio" id="murmur_no"  name="24_significant_murmur" value="no"><label for="murmur_no">No</label>
                    </div>
                </div>
                <div id="precordial_murmur_container" hidden>
                    <div class="field"><label>Presence of any precordial murmur</label>
                        <div class="pill-group">
                            <input type="radio" id="prec_yes" name="24_1_precordial_murmur" value="yes"><label for="prec_yes">Yes</label>
                            <input type="radio" id="prec_no"  name="24_1_precordial_murmur" value="no"><label for="prec_no">No</label>
                        </div>
                    </div>
                </div>
                <div id="autoimmune_disease_container" hidden>
                    <div class="field"><label>Presence of autoimmune / inflammatory disease</label>
                        <div class="pill-group">
                            <input type="radio" id="auto_yes" name="38_autoimmune_disease" value="yes"><label for="auto_yes">Yes</label>
                            <input type="radio" id="auto_no"  name="38_autoimmune_disease" value="no"><label for="auto_no">No</label>
                        </div>
                    </div>
                </div>
                <div class="field"><label>Presence of aortic plaque</label>
                    <div class="pill-group">
                        <input type="radio" id="aortic_yes" name="39_aortic_plaque" value="yes"><label for="aortic_yes">Yes</label>
                        <input type="radio" id="aortic_no"  name="39_aortic_plaque" value="no"><label for="aortic_no">No</label>
                    </div>
                </div>
                <div class="field"><label for="bnp">B-type natriuretic peptide (pg/ml)</label>
                    <input type="number" id="bnp" name="40_bnp_level" inputmode="numeric" autocomplete="off">
                </div>
            </section>

        </div>
    </div>

    <div class="mobile-submit">
        <button type="submit" class="btn btn-primary">Calculate</button>
    </div>
    <?php echo form_close(); ?>

    <?php $this->load->view('footer'); ?>
</body>
</html>
```

- [ ] **Step 3: Verify manually**

Visit `http://localhost/afibrisk/plataforma/questions`. Expected:
- Sidebar with 7 items visible on the left (desktop ≥1024px)
- Form fields on the right, grouped under section headings
- Click pill buttons — selected pill turns blue
- Submit button in the sidebar labelled "Calculate"
- No drawer behavior yet (will come in Task 7)
- No scroll-spy yet (no item is highlighted during scroll)
- No conditional fields yet — BMI ≥25, former smoker, precordial murmur, autoimmune are permanently hidden (via `hidden` attribute) and will remain so until Task 7

Fill a couple of fields (age, gender, NIHSS) and submit. Should redirect to the results page (broken visually still, but it means the POST works).

- [ ] **Step 4: Commit**

```bash
git add plataforma/application/views/perguntas/home.php plataforma/assets/css/style.css
git commit -m "Rewrite questions page with sidebar layout and pill radios"
```

---

## Task 7: Questions page — JS behaviors

**Files:**
- Modify (append to `<script>` at bottom): `plataforma/application/views/perguntas/home.php`

- [ ] **Step 1: Add the behavior script at the end of perguntas/home.php**

Before the closing `</body>` tag (after the `<?php $this->load->view('footer'); ?>` line), append:

```html
<script>
(function () {
    const sidebar = document.getElementById('sidebar');
    const drawerToggle = document.getElementById('drawerToggle');
    const drawerBackdrop = document.getElementById('drawerBackdrop');
    const progressFill = document.getElementById('progressFill');
    const progressPct  = document.getElementById('progressPct');
    const form = document.getElementById('formprincipal');
    const sectionLinks = sidebar.querySelectorAll('a[data-section]');
    const sections = Array.from(document.querySelectorAll('.question-section'));

    // ---- Drawer (mobile) ----
    function openDrawer() {
        sidebar.classList.add('open');
        drawerBackdrop.classList.add('open');
        drawerToggle.setAttribute('aria-expanded', 'true');
    }
    function closeDrawer() {
        sidebar.classList.remove('open');
        drawerBackdrop.classList.remove('open');
        drawerToggle.setAttribute('aria-expanded', 'false');
    }
    drawerToggle.addEventListener('click', () => {
        sidebar.classList.contains('open') ? closeDrawer() : openDrawer();
    });
    drawerBackdrop.addEventListener('click', closeDrawer);
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeDrawer(); });
    sidebar.addEventListener('click', (e) => {
        if (e.target.closest('a[data-section]') && window.innerWidth <= 767) closeDrawer();
    });

    // ---- Scroll-spy (IntersectionObserver) ----
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const id = entry.target.id;
                sectionLinks.forEach(a => a.classList.toggle('active', a.dataset.section === id));
            }
        });
    }, { rootMargin: '-40% 0px -55% 0px', threshold: 0 });
    sections.forEach(s => observer.observe(s));

    // ---- Smooth scroll from sidebar clicks ----
    sectionLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const id = link.dataset.section;
            const target = document.getElementById(id);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ---- Progress + done markers ----
    function updateProgress() {
        let doneCount = 0;
        sections.forEach(section => {
            const inputs = section.querySelectorAll('input');
            const filled = Array.from(inputs).some(inp => {
                if (inp.type === 'radio') return inp.checked;
                return inp.value && inp.value.trim() !== '';
            });
            const link = sidebar.querySelector(`a[data-section="${section.id}"]`);
            if (link) link.classList.toggle('done', filled);
            if (filled) doneCount++;
        });
        const pct = Math.round((doneCount / sections.length) * 100);
        progressFill.style.width = pct + '%';
        progressPct.textContent = pct + '%';
    }
    form.addEventListener('input', updateProgress);
    form.addEventListener('change', updateProgress);
    updateProgress();

    // ---- Conditional fields (preserves existing behaviour) ----
    function show(el) { if (el) el.hidden = false; }
    function hide(el) { if (el) { el.hidden = true; el.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false); el.querySelectorAll('input[type="number"], input[type="text"]').forEach(i => i.value = ''); } }

    const bmi25Container = document.getElementById('bmi_25_container');
    const bmi25Extra     = document.getElementById('additional_bmi_content');
    const formerContainer = document.getElementById('former_smoker_container');
    const precordialContainer = document.getElementById('precordial_murmur_container');
    const autoimmuneContainer = document.getElementById('autoimmune_disease_container');

    // Raised BMI: No → show bmi_25_container; Yes → hide both
    document.querySelectorAll('input[name="20_raised_bmi"]').forEach(r => r.addEventListener('change', (e) => {
        if (e.target.value === 'no') { show(bmi25Container); }
        else { hide(bmi25Container); hide(bmi25Extra); }
    }));
    document.querySelectorAll('input[name="20_1_bmi_25"]').forEach(r => r.addEventListener('change', (e) => {
        if (e.target.value === 'yes') show(bmi25Extra); else hide(bmi25Extra);
    }));

    // Smoking: No → show former smoker container
    document.querySelectorAll('input[name="14_smoking"]').forEach(r => r.addEventListener('change', (e) => {
        if (e.target.value === 'no') show(formerContainer); else hide(formerContainer);
    }));

    // Significant murmur: Yes → show precordial murmur
    document.querySelectorAll('input[name="24_significant_murmur"]').forEach(r => r.addEventListener('change', (e) => {
        if (e.target.value === 'yes') show(precordialContainer); else hide(precordialContainer);
    }));

    // Gender female → show autoimmune disease
    document.querySelectorAll('input[name="2_gender"]').forEach(r => r.addEventListener('change', (e) => {
        if (e.target.value === 'female') show(autoimmuneContainer); else hide(autoimmuneContainer);
    }));

    // ---- Tippy tooltips (preserves existing content) ----
    if (window.tippy) {
        tippy('#field_1', { content: 'Aortic, mitral, tricuspid, and/or pulmonary valve disease', theme: 'customTooltipCssTema' });
        tippy('#field_2', { content: 'Left atrial enlargement (LAE) by ECG: p-wave duration ≥120 ms or p-wave amplitude >2.5 mm in II, or terminal p negativity in V1 (duration 0.04 s, depth 1 mm). By parasternal long-axis view, LAE = anteroposterior diameter ≥4.0 cm.', theme: 'customTooltipCssTema' });
        tippy('#field_3', { content: 'Premature P wave (often different shape), narrow/normal QRS identical to other beats, a long pause after the PAC, normal/short/longer PR than sinus, post-extrasystolic pause.', theme: 'customTooltipCssTema' });
        tippy('#field_4', { content: 'Premature QRS complexes unusually long (>120 ms), wide QRS, no preceding P wave, large T wave oriented opposite the major QRS deflection.', theme: 'customTooltipCssTema' });
        tippy('#field_5', { content: 'Significant if grade ≥3/6 systolic or any diastolic murmur on auscultation.', theme: 'customTooltipCssTema' });
    }
})();
</script>
```

- [ ] **Step 2: Verify manually**

Reload `/questions`.

1. **Pill selection** — click Yes/No; pill turns blue.
2. **Progress** — fill Age; sidebar "Demographic" gets a green check and progress shows ~14% (1/7). Fill NIHSS; 29%.
3. **Scroll-spy** — scroll down; the active item in the sidebar tracks the current section.
4. **Sidebar click** — click "Echography"; page smooth-scrolls to that section.
5. **Conditional fields** — tick "Raised BMI = No" → BMI ≥25 question appears. Tick "BMI ≥25 = Yes" → BMI value input appears. Tick "Gender = female" → autoimmune question appears on Cardiology section. Tick "Smoking = No" → former smoker appears. Tick "Significant murmur = Yes" → precordial murmur appears.
6. **Tooltips** — hover the `i` badges next to Valve Disease, Left Atrial Enlargement, APC, VPC, Significant Murmur — each shows a dark tooltip.
7. **Mobile (≤767px)** — resize or use DevTools device. Hamburger `☰` appears in the topbar. Sidebar is hidden. Click hamburger → drawer slides in; backdrop dims behind. Click backdrop or press Escape → drawer closes. Click any section link → drawer closes after scroll. Calculate button appears sticky at the bottom.
8. **Full submission** — fill fields across multiple sections, click Calculate; page goes to results.

- [ ] **Step 3: Commit**

```bash
git add plataforma/application/views/perguntas/home.php
git commit -m "Wire up scroll-spy, drawer, progress, conditional fields"
```

---

## Task 8: Results page — markup rewrite

**Files:**
- Modify (rewrite): `plataforma/application/views/resultado/home.php`
- Modify (append): `plataforma/assets/css/style.css`

This task handles the markup + styling only. The export JS module comes in Tasks 9–11.

- [ ] **Step 1: Append results-page styles to style.css**

Append to `plataforma/assets/css/style.css`:

```css
/* ============================================================================
   Results page
   ============================================================================ */
.results-shell { max-width: 960px; margin: 0 auto; padding: var(--space-8) var(--space-4); }
.results-header { display: flex; flex-wrap: wrap; align-items: baseline; justify-content: space-between; gap: var(--space-3); margin-bottom: var(--space-4); }
.results-header h1 { margin: 0; }
.results-header .timestamp { color: var(--color-muted); font-size: 13px; }

.toolbar {
    position: sticky; top: var(--topbar-h); z-index: 10;
    display: flex; flex-wrap: wrap; gap: var(--space-2);
    padding: var(--space-3) 0;
    background: var(--color-surface-alt);
    border-bottom: 1px solid var(--color-border);
    margin-bottom: var(--space-6);
}
.toolbar .btn { padding: 8px 14px; font-size: 13px; }
.toolbar .btn i { font-size: 14px; }

.result-card {
    background: var(--color-surface); border: 1px solid var(--color-border);
    border-radius: var(--radius); box-shadow: var(--shadow-sm);
    padding: var(--space-6); margin-bottom: var(--space-4);
}
.result-card .card-head { display: flex; align-items: center; justify-content: space-between; gap: var(--space-3); }
.result-card h3 { margin: 0; font-size: 16px; }
.result-card .value { font-family: var(--font-mono); font-size: 26px; font-weight: 700; color: var(--color-primary); font-variant-numeric: tabular-nums; letter-spacing: -0.01em; }
.result-card .ref-btn {
    background: transparent; border: 0; color: var(--color-muted); cursor: pointer;
    width: 28px; height: 28px; border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
}
.result-card .ref-btn:hover { color: var(--color-primary); background: var(--color-surface-alt); }
.result-card .interp { margin: var(--space-3) 0 0; padding-top: var(--space-3); border-top: 1px solid var(--color-border); font-size: 13px; color: var(--color-ink-2); line-height: 1.55; }
.result-card .hamada-image { display: block; max-width: 360px; margin: var(--space-3) auto 0; border-radius: var(--radius-sm); }

.empty-state { text-align: center; padding: var(--space-12) var(--space-4); color: var(--color-muted); }
.empty-state h2 { color: var(--color-ink); }

/* Toast (export.js will toggle .show) */
.toast {
    position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%) translateY(20px);
    background: var(--color-ink); color: #fff;
    padding: 10px 16px; border-radius: var(--radius-sm);
    font-size: 14px; font-weight: 500;
    box-shadow: var(--shadow);
    opacity: 0; pointer-events: none; z-index: 1000;
    transition: opacity 180ms, transform 180ms;
}
.toast.show { opacity: 1; transform: translateX(-50%) translateY(0); pointer-events: auto; }
.toast.success { background: var(--color-success); }
.toast.error   { background: var(--color-danger); }

/* Modal (references) — replaces Bootstrap modal */
.modal-backdrop {
    position: fixed; inset: 0; background: rgba(15, 23, 42, 0.5);
    display: none; align-items: center; justify-content: center; z-index: 100;
}
.modal-backdrop.show { display: flex; }
.modal-dialog {
    background: var(--color-surface); border-radius: var(--radius-lg);
    max-width: 720px; width: calc(100% - 32px); max-height: 85vh;
    display: flex; flex-direction: column;
    box-shadow: 0 20px 60px rgba(15,23,42,0.25);
}
.modal-head { display: flex; align-items: center; justify-content: space-between; padding: var(--space-4) var(--space-6); border-bottom: 1px solid var(--color-border); }
.modal-head h2 { margin: 0; font-size: 18px; }
.modal-close { background: transparent; border: 0; font-size: 22px; cursor: pointer; color: var(--color-muted); line-height: 1; }
.modal-close:hover { color: var(--color-ink); }
.modal-body { padding: var(--space-6); overflow-y: auto; }
.modal-body .reference { display: none; }
.modal-body .reference.active { display: block; }
.modal-body .reference p { font-size: 14px; color: var(--color-ink-2); line-height: 1.6; }
.modal-body .reference p:first-child b { color: var(--color-ink); }

/* PDF template (offscreen) */
.pdf-template {
    position: absolute; left: -10000px; top: 0; width: 780px;
    padding: 20px; background: #fff; color: #000;
    font-family: var(--font-sans); font-size: 12px;
}
.pdf-template h1 { font-size: 20px; }
.pdf-template h2 { font-size: 14px; margin-top: 18px; }
.pdf-template .pdf-kv { display: grid; grid-template-columns: 200px 1fr; gap: 4px 12px; margin-bottom: 4px; font-size: 12px; }
.pdf-template .pdf-kv span:first-child { color: #555; }
.pdf-template .pdf-score { border-top: 1px solid #ddd; padding-top: 8px; margin-top: 6px; }
.pdf-template .pdf-score strong { font-size: 13px; }
.pdf-template .pdf-score .val { color: #2563eb; font-family: var(--font-mono); font-weight: 700; margin-left: 8px; }
.pdf-template .pdf-ref { border-top: 1px solid #eee; padding-top: 6px; margin-top: 8px; font-size: 11px; color: #333; }
.pdf-template footer { margin-top: 24px; padding-top: 12px; border-top: 2px solid #0f172a; font-size: 10px; color: #555; }

@media (max-width: 640px) {
    .toolbar .btn-label { display: none; }
    .toolbar .btn { padding: 8px 10px; }
}
```

- [ ] **Step 2: Rewrite resultado/home.php**

Overwrite `plataforma/application/views/resultado/home.php` with the following. The PHP loop keeps all existing score-rendering logic (Hamada image case included). The reference modal content is preserved verbatim from the previous version since it's long and scientific — re-wrapped in the new modal classes.

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('header'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <header class="topbar">
        <a href="<?php echo base_url(); ?>" class="brand">AFibRisk</a>
        <nav>
            <a href="<?php echo base_url('about'); ?>">About</a>
        </nav>
    </header>

    <main class="results-shell">
        <?php
            $resultado = $this->session->userdata('resultados');
            $respostas = $this->session->userdata('respostas') ?: array();
            $hasResults = is_array($resultado) && count($resultado) > 0;
        ?>

        <?php if (!$hasResults): ?>
            <div class="empty-state">
                <h2>No assessment yet</h2>
                <p>Fill out the questionnaire to see results here.</p>
                <a href="<?php echo base_url('questions'); ?>" class="btn btn-primary">Start an assessment</a>
            </div>
        <?php else: ?>
            <div class="results-header">
                <h1>Results</h1>
                <div class="timestamp" id="generatedAt"></div>
            </div>

            <div class="toolbar" role="toolbar" aria-label="Export results">
                <button type="button" class="btn btn-secondary" data-action="copy"  aria-label="Copy to clipboard">📋 <span class="btn-label">Copy</span></button>
                <button type="button" class="btn btn-secondary" data-action="pdf"   aria-label="Download PDF">📄 <span class="btn-label">PDF</span></button>
                <button type="button" class="btn btn-secondary" data-action="csv"   aria-label="Download CSV">📊 <span class="btn-label">CSV</span></button>
                <button type="button" class="btn btn-secondary" data-action="print" aria-label="Print">🖨 <span class="btn-label">Print</span></button>
                <a href="<?php echo base_url('questions'); ?>" class="btn btn-ghost" style="margin-left:auto">↻ New assessment</a>
            </div>

            <div id="resultCards">
                <?php foreach ($resultado as $key => $value):
                    if ($value['resposta'] === 'none') continue;
                    $id = str_replace(' ', '', $key);
                    if (strpos($key, 'BRAFIL') !== false) $id = 'BRAFIL';
                ?>
                    <div class="result-card" data-score-name="<?= htmlspecialchars($key) ?>" data-score-value="<?= htmlspecialchars($value['resposta']) ?>">
                        <div class="card-head">
                            <h3><?= htmlspecialchars($key) ?></h3>
                            <?php if ($key === 'Hamada'): ?>
                                <span class="value">see chart</span>
                            <?php else: ?>
                                <span class="value"><?= htmlspecialchars($value['resposta']) ?></span>
                            <?php endif; ?>
                            <?php if (!empty($value['message'])): ?>
                                <button type="button" class="ref-btn show-reference" data-ref="<?= $id ?>" aria-label="View reference"><i class="fas fa-info-circle"></i></button>
                            <?php endif; ?>
                        </div>
                        <?php if ($key === 'Hamada'): ?>
                            <img class="hamada-image" src="<?= base_url('assets/images/hamada/' . $value['resposta'] . '.png') ?>" alt="Hamada risk chart">
                        <?php endif; ?>
                        <?php if (!empty($value['interpretation'])): ?>
                            <p class="interp"><?= htmlspecialchars($value['interpretation']) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Inputs payload for export.js -->
            <script>
                window.AFIBRISK_INPUTS = <?= json_encode($respostas, JSON_UNESCAPED_UNICODE) ?>;
            </script>

            <!-- Offscreen PDF template: export.js fills `#pdfBody` on demand -->
            <div class="pdf-template" id="pdfTemplate" aria-hidden="true">
                <h1>AFibRisk — Assessment Report</h1>
                <div id="pdfBody"></div>
                <footer>
                    Not a medical device. This report is for educational/research use only.
                    See the About page for the full disclaimer.
                </footer>
            </div>

            <!-- References modal (markup preserved from previous version, re-classed) -->
            <div class="modal-backdrop" id="referenceModal" role="dialog" aria-modal="true" aria-labelledby="referenceModalLabel">
                <div class="modal-dialog">
                    <div class="modal-head">
                        <h2 id="referenceModalLabel">Reference</h2>
                        <button type="button" class="modal-close" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body" id="referenceBody">
                        <!-- Keep all <div class="reference <KEY>"> blocks from the previous version -->
                        <div class="reference STAF">
                            <p><b>Score for the Targeting of Atrial Fibrillation (STAF)</b></p>
                            <p>Laurent Suissa, MD; David Bertora, MD; Sylvain Lachaud, MD; Marie Hélène Mahagne, MD, PhD</p>
                            <p>STAF, calculated from the sum of the points for the 4 items (possible total score 0 to 8): age ≥62 years (2 points); NIHSS ≥8 (1 point); left atrial dilatation (2 points); absence of symptomatic intra/extracranial stenosis ≥50% or clinico-radiological lacunar syndrome (3 points). STAF ≥5 identified patients with AF with sensitivity 89% and specificity 88%.</p>
                            <p><b>DOI: 10.1161/STROKEAHA.109.552679</b></p>
                        </div>
                        <div class="reference BRAFIL">
                            <p><b>A predictive score of Atrial Fibrillation in post-stroke patients</b></p>
                            <p>Teixeira CT, Rizelio V, Robles A, Barros LCM, Silva GS, Andrade JBC.</p>
                            <p>Score built with left atrial diameter ≥42 mm (2), age ≥70 years (1), septal aneurysm (2), NIHSS ≥6 at admission (1). Range 0–6. Score ≥2 → 5-fold AF risk. AUC 0.77 (0.72–0.85).</p>
                        </div>
                        <div class="reference TheHeinzNixdorfRecallStudy">
                            <p><b>B-type natriuretic peptide for incident AF — Heinz Nixdorf Recall Study</b></p>
                            <p>Kara K, Geisel MH, Möhlenkamp S, et al.</p>
                            <p>Elevated BNP levels are associated with significant excess of incident AF, independent of traditional risk factors. Gender-specific thresholds: ≥31 pg/ml male, ≥45 pg/ml female.</p>
                            <p><b>doi: 10.1016/j.jjcc.2014.08.003</b></p>
                        </div>
                        <div class="reference ASAS">
                            <p><b>Acute Stroke Atrial Fibrillation Scoring System (ASAS)</b></p>
                            <p>Figueiredo MM, Rodrigues ACT, Alves MB, Cendoroglo Neto M, Silva GS.</p>
                            <p>AF predictors: age, NIHSS, presence of left atrial enlargement. AUC 0.79 derivation, 0.76 validation.</p>
                            <p><b>DOI: 10.6061/clinics/2014(04)04</b></p>
                        </div>
                        <div class="reference CHA2DS2-VASC">
                            <p><b>CHADS2 / CHA2DS2-VASc for new-onset AF</b></p>
                            <p>Saliba W, Gronich N, Barnett-Griness O, Rennert G.</p>
                            <p>Each 1-point increase in CHA2DS2-VASc: hazard ratio 1.57 (95% CI 1.56–1.58). AUC for predicting new-onset AF: 0.744.</p>
                            <p><b>PMID: 27012854 · DOI: 10.1016/j.amjmed.2016.02.029</b></p>
                        </div>
                        <div class="reference C2HEST">
                            <p><b>C2HEST score for AF risk — meta-analysis</b></p>
                            <p>Haybar H, Shirbandi K, Rahim F.</p>
                            <p>Each 1-point increase: OR 1.03 (95% CI 1.01–1.05). Overall AUC 0.91 (0.85–0.96).</p>
                            <p><b>PMID: 34862957 · DOI: 10.1186/s43044-021-00230-0</b></p>
                        </div>
                        <div class="reference Takase">
                            <p><b>Prediction of AF by B-type Natriuretic Peptide</b></p>
                            <p>Takase H, Dohi Y, Sonoda H, Kimura G.</p>
                            <p>BNP as continuous variable: HR 5.65 (95% CI 2.63–12.41) for new-onset AF, adjusted for risk factors.</p>
                            <p><b>DOI: 10.4022/jafib.674</b></p>
                        </div>
                        <div class="reference HAVOC">
                            <p><b>HAVOC — A Clinical Score for Predicting AF in Cryptogenic Stroke/TIA</b></p>
                            <p>Kwong C, Ling AY, Crawford MH, Zhao SX, Shah NH.</p>
                            <p>7 clinical variables (age ≥75, obesity, CHF, hypertension, CAD, PVD, valve disease). AUC 0.77.</p>
                            <p><b>PMID: 28654919 · DOI: 10.1159/000476030</b></p>
                        </div>
                        <div class="reference CHARGE-AF">
                            <p><b>CHARGE-AF — Simple risk model for AF incidence</b></p>
                            <p>Alonso A, Krijthe BP, Aspelund T, et al.</p>
                            <p>5-year model (age, race, height, weight, BP, smoking, antihypertensive use, diabetes, MI, HF). Derivation C-statistic 0.765.</p>
                            <p><b>PMID: 23537808 · DOI: 10.1161/JAHA.112.000102</b></p>
                        </div>
                        <div class="reference HARMS2-AF">
                            <p><b>HARMS2-AF — New-onset AF lifestyle risk score</b></p>
                            <p>Segan L, Canovas R, Nanayakkara S, et al.</p>
                            <p>Predictors: hypertension, age, BMI, male sex, sleep apnoea, smoking, alcohol. 5-year AUC 0.757; 10-year AUC 0.753.</p>
                            <p><b>PMID: 37350480 · DOI: 10.1093/eurheartj/ehad375</b></p>
                        </div>
                        <div class="reference Hamada">
                            <p><b>Simple risk model and score for predicting incident AF in Japanese</b></p>
                            <p>Hamada R, Muto S.</p>
                            <p>7-year model (age, waist circumference, diastolic BP, alcohol, heart rate, cardiac murmur) + ECG add-on (LVH, atrial enlargement, APC, VPC). C-statistic 0.77 simple, 0.78 added.</p>
                            <p><b>DOI: 10.1016/j.jjcc.2018.06.005</b></p>
                        </div>
                        <div class="reference MayoScore">
                            <p><b>Clinical Predictors of Risk for AF — Mayo</b></p>
                            <p>Brunner KJ, Bunch TJ, Mullin CM, et al.</p>
                            <p>7 validated risk factors. AUC 0.812 (95% CI 0.805–0.820).</p>
                            <p><b>DOI: 10.1016/j.mayocp.2014.08.016</b></p>
                        </div>
                        <div class="reference HATCH">
                            <p><b>HATCH score in Asians</b></p>
                            <p>Suenari K, Chao TF, Liu CJ, Kihara Y, Chen TJ, Chen SA.</p>
                            <p>Hypertension (1), age &gt;75 (1), stroke/TIA (2), COPD (1), heart failure (2). HR per 1-point increase 2.059 (2.027–2.093).</p>
                            <p><b>DOI: 10.1097/MD.0000000000005597</b></p>
                        </div>
                        <div class="reference FraminghamAFriskscore">
                            <p><b>Framingham AF Risk Score</b></p>
                            <p>Schnabel RB, Sullivan LM, Levy D, et al.</p>
                            <p>Variables: age, sex, significant murmur, HF, systolic BP, hypertension treatment, BMI, ECG PR interval. C-statistic 0.78.</p>
                            <p><b>DOI: 10.1016/S0140-6736(09)60443-8</b></p>
                        </div>
                        <div class="reference MHSScore">
                            <p><b>MHS 10-year AF Risk Score</b></p>
                            <p>Aronson D, Shalev V, Katz R, Chodick G, Mutlak D.</p>
                            <p>Variables: age, sex, BMI, treated hypertension, SBP &gt;160, chronic lung disease, MI, PAD, HF, inflammatory disease. C-statistic 0.743–0.749.</p>
                            <p><b>DOI: 10.1055/s-0038-1668522</b></p>
                        </div>
                        <div class="reference ARICScore">
                            <p><b>ARIC Risk Score for AF</b></p>
                            <p>Chamberlain AM, Agarwal SK, Folsom AR, et al.</p>
                            <p>Variables: age, race, height, smoking, SBP, hypertension treatment, precordial murmur, LVH, LAE, diabetes, CHD, HF. AUC 0.76.</p>
                            <p><b>DOI: 10.1016/j.amjcard.2010.08.049</b></p>
                        </div>
                        <div class="reference Suita">
                            <p><b>Suita Study — Japanese 10-year AF risk</b></p>
                            <p>Kokubo Y, Watanabe M, Higashiyama A, Nakao YM, Kusano K, Miyamoto Y.</p>
                            <p>C-statistic 0.749 (95% CI 0.724–0.774). Score ≤2 → ≤1%; 10–11 → 9%; ≥16 → 27% observed 10-year AF probability.</p>
                            <p><b>DOI: 10.1253/circj.CJ-17-0277</b></p>
                        </div>
                        <div class="reference TaiwanAFScore">
                            <p><b>Taiwan AF Score</b></p>
                            <p>Chao TF, Chiang CE, Chen TJ, Liao JN, Tuan TC, Chen SA.</p>
                            <p>Age, male sex, hypertension, HF, CAD, ESRD, alcoholism. Range −2 to 15. AUC: 0.857 (1-yr), 0.825 (5-yr), 0.797 (10-yr), 0.756 (16-yr).</p>
                            <p><b>DOI: 10.1161/JAHA.120.020194</b></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <div class="toast" id="toast" role="status" aria-live="polite"></div>

    <?php $this->load->view('footer'); ?>
    <script src="<?php echo base_url('assets/js/export.js'); ?>"></script>

    <script>
        // Reference modal + score tooltips — kept from the previous version
        (function(){
            const modal = document.getElementById('referenceModal');
            const closeBtn = modal ? modal.querySelector('.modal-close') : null;
            const refs = modal ? modal.querySelectorAll('.reference') : [];
            function openModal(id) {
                refs.forEach(r => r.classList.toggle('active', r.classList.contains(id)));
                modal.classList.add('show');
            }
            function closeModal() { if (modal) modal.classList.remove('show'); }
            document.querySelectorAll('.show-reference').forEach(btn => {
                btn.addEventListener('click', () => openModal(btn.dataset.ref));
            });
            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (modal) modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

            // Score tooltips — attach to each .ref-btn by score key
            if (!window.tippy) return;
            const tips = {
                STAF: 'A total score of ≥5 identifies patients with AF with sensitivity 89% and specificity 88%.',
                ASAS: 'AUC 0.78 (95% CI 0.70–0.86), excluding previous AF diagnosis.',
                'CHA2DS2-VASC': 'AUC 0.744 for new-onset AF over 2-year follow-up.',
                HAVOC: 'Chance (%) of AF in 3 years; AUC 0.77.',
                'CHARGE-AF': 'Chance (%) of AF in 5 years.',
                'HARMS2-AF': 'Hazard ratio for AF detection up to 10 years. 5-year AUC 0.757; 10-year AUC 0.753.',
                Hamada: '7-year risk of AF; AUC 0.78.',
                MayoScore: 'Incident AF in ~8-year follow-up; AUC 0.812.',
                HATCH: 'Chance of AF detection in ~10 years; AUC 0.716.',
                MHSScore: '10-year predicted risk of AF; AUC 0.749.',
                ARICScore: 'Chance (%) of AF in 10 years; AUC 0.76.',
                Suita: '10-year predicted risk of AF; AUC 0.749.',
                TaiwanAFScore: 'Cumulative incidence of AF in 1–16 year follow-up; AUC 0.857 (1yr) to 0.756 (16yr).'
            };
            document.querySelectorAll('.ref-btn').forEach(btn => {
                const key = btn.dataset.ref;
                if (tips[key]) tippy(btn, { content: tips[key], theme: 'customTooltipCssTema', placement: 'top' });
            });
        })();
    </script>
</body>
</html>
```

Two PHP changes to be aware of that may require controller follow-up:
- The markup reads `$value['interpretation']` as the **card body text**. The current controller does not set this key — it only sets `resposta` and `message`. If left as-is the interpretation line will simply not render (empty check) and the tooltip on the (i) icon still provides the context. This is acceptable for the first merge; populating `interpretation` per score is a follow-up aligned with the spec's "promoting tippy content into card" goal but does not block this plan.

- [ ] **Step 3: Verify manually**

Submit a full questionnaire from `/questions`. On `/result`:
- Topbar + Results header with timestamp placeholder (empty until Task 9 sets it)
- Toolbar with 4 icon buttons (Copy / PDF / CSV / Print) and a "New assessment" link — buttons don't do anything yet (export.js not loaded; file doesn't exist). 404 is expected for `export.js` — check Network tab.
- Result cards uniform (white, shadow, rounded); score value in blue monospace on the right; (i) icon opens the references modal with the correct score reference highlighted.
- Click (i) icon → modal appears with matching reference. Click backdrop or × → closes. Escape also closes.
- Navigate directly to `/result` in a new session (or clear cookies) → empty state appears with "Start an assessment" button.

- [ ] **Step 4: Commit**

```bash
git add plataforma/application/views/resultado/home.php plataforma/assets/css/style.css
git commit -m "Rewrite results page with toolbar, cards, and reference modal"
```

---

## Task 9: export.js — Copy + toast scaffolding

**Files:**
- Create: `plataforma/assets/js/export.js`

- [ ] **Step 1: Create export.js with the shared payload builder and Copy handler**

Create `plataforma/assets/js/export.js`:

```js
(function () {
    'use strict';

    // ---- Payload ---------------------------------------------------------
    function pad2(n) { return String(n).padStart(2, '0'); }
    function nowISOLocal() {
        const d = new Date();
        const tz = -d.getTimezoneOffset();
        const sign = tz >= 0 ? '+' : '-';
        const abs = Math.abs(tz);
        return d.getFullYear() + '-' + pad2(d.getMonth()+1) + '-' + pad2(d.getDate())
             + 'T' + pad2(d.getHours()) + ':' + pad2(d.getMinutes()) + ':' + pad2(d.getSeconds())
             + sign + pad2(Math.floor(abs/60)) + ':' + pad2(abs%60);
    }
    function nowHuman() {
        const d = new Date();
        return d.getFullYear() + '-' + pad2(d.getMonth()+1) + '-' + pad2(d.getDate())
             + ' ' + pad2(d.getHours()) + ':' + pad2(d.getMinutes());
    }
    function nowFilename() {
        const d = new Date();
        return d.getFullYear() + '-' + pad2(d.getMonth()+1) + '-' + pad2(d.getDate())
             + '-' + pad2(d.getHours()) + pad2(d.getMinutes());
    }

    function readScores() {
        const cards = document.querySelectorAll('#resultCards .result-card');
        return Array.from(cards).map(card => ({
            name: card.dataset.scoreName,
            value: card.dataset.scoreValue,
            interpretation: (card.querySelector('.interp') || {}).textContent || ''
        }));
    }

    const payload = {
        generatedAt: nowISOLocal(),
        generatedHuman: nowHuman(),
        inputs: window.AFIBRISK_INPUTS || {},
        scores: readScores()
    };

    // Populate the "Generated on" timestamp in the header
    const ts = document.getElementById('generatedAt');
    if (ts) ts.textContent = 'Generated on ' + payload.generatedHuman;

    // ---- Toast ----------------------------------------------------------
    const toastEl = document.getElementById('toast');
    let toastTimer = null;
    function toast(msg, kind) {
        if (!toastEl) return;
        toastEl.textContent = msg;
        toastEl.className = 'toast show' + (kind ? ' ' + kind : '');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => { toastEl.classList.remove('show'); }, 2200);
    }

    // ---- Copy ----------------------------------------------------------
    function formatPlainText() {
        const lines = [];
        lines.push('AFibRisk — Assessment');
        lines.push('Generated: ' + payload.generatedHuman);
        lines.push('');
        lines.push('Scores');
        payload.scores.forEach(s => {
            lines.push('- ' + s.name + ': ' + s.value);
        });
        const inputKeys = Object.keys(payload.inputs);
        if (inputKeys.length) {
            lines.push('');
            lines.push('Inputs');
            inputKeys.forEach(k => {
                const label = k.replace(/^\d+_?/, '').replace(/_/g, ' ');
                lines.push('- ' + label + ': ' + payload.inputs[k]);
            });
        }
        return lines.join('\n');
    }

    async function doCopy() {
        const text = formatPlainText();
        try {
            if (navigator.clipboard && window.isSecureContext) {
                await navigator.clipboard.writeText(text);
                toast('Copied to clipboard', 'success'); return;
            }
        } catch (e) { /* fall through */ }
        try {
            const ta = document.createElement('textarea');
            ta.value = text;
            ta.setAttribute('readonly', '');
            ta.style.position = 'fixed'; ta.style.opacity = '0';
            document.body.appendChild(ta);
            ta.select();
            const ok = document.execCommand('copy');
            document.body.removeChild(ta);
            if (ok) { toast('Copied to clipboard', 'success'); return; }
        } catch (e) { /* fall through */ }
        toast("Couldn't copy. Try Print instead.", 'error');
    }

    // ---- Print ---------------------------------------------------------
    function doPrint() { window.print(); }

    // Placeholders — implemented in Task 10 (CSV) and Task 11 (PDF)
    function doCSV() { toast('CSV export not available yet', 'error'); }
    function doPDF() { toast('PDF export not available yet', 'error'); }

    // ---- Wire buttons --------------------------------------------------
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-action]');
        if (!btn) return;
        switch (btn.dataset.action) {
            case 'copy':  doCopy();  break;
            case 'pdf':   doPDF();   break;
            case 'csv':   doCSV();   break;
            case 'print': doPrint(); break;
        }
    });

    // Expose for future testing hooks
    window.AFibRisk = { payload, formatPlainText, nowFilename };
})();
```

- [ ] **Step 2: Verify manually**

Reload `/result`.

1. The "Generated on YYYY-MM-DD HH:MM" appears next to the "Results" title.
2. Click Copy — toast "Copied to clipboard" (green). Paste into Notepad — should show the formatted plain-text block starting with "AFibRisk — Assessment".
3. Click Print — browser's print dialog opens (the print CSS comes in Task 12; preview will still include the toolbar for now).
4. Click CSV / PDF — red toast "not available yet" (expected).
5. Open DevTools console and inspect `window.AFibRisk.payload` — has `generatedAt`, `inputs`, `scores` fields.

- [ ] **Step 3: Commit**

```bash
git add plataforma/assets/js/export.js
git commit -m "Add export.js with Copy, Print and payload builder"
```

---

## Task 10: export.js — CSV

**Files:**
- Modify: `plataforma/assets/js/export.js`

- [ ] **Step 1: Replace the CSV stub with a real implementation**

In `plataforma/assets/js/export.js`, find:

```js
    function doCSV() { toast('CSV export not available yet', 'error'); }
```

Replace with:

```js
    function csvEscape(v) {
        if (v === null || v === undefined) return '';
        const s = String(v);
        if (/[",\r\n]/.test(s)) return '"' + s.replace(/"/g, '""') + '"';
        return s;
    }

    function doCSV() {
        const inputKeys = Object.keys(payload.inputs);
        const scoreKeys = payload.scores.map(s => 'score_' + s.name.toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_|_$/g, ''));
        const headers = ['generated_at', ...inputKeys, ...scoreKeys];
        const row = [
            payload.generatedAt,
            ...inputKeys.map(k => payload.inputs[k]),
            ...payload.scores.map(s => s.value)
        ];
        const csv = '\uFEFF'
            + headers.map(csvEscape).join(',') + '\r\n'
            + row.map(csvEscape).join(',') + '\r\n';

        try {
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'afibrisk-' + nowFilename() + '.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            setTimeout(() => URL.revokeObjectURL(url), 1000);
            toast('CSV downloaded', 'success');
        } catch (e) {
            toast("Couldn't export CSV", 'error');
        }
    }
```

- [ ] **Step 2: Verify manually**

Reload `/result`.

1. Click CSV → file `afibrisk-YYYY-MM-DD-HHmm.csv` downloads. Toast "CSV downloaded" (green).
2. Open the file in a plain text editor — confirm:
   - Starts with UTF-8 BOM (some editors show as `﻿` or nothing)
   - Header row with `generated_at`, each input key, each score column prefixed `score_`
   - Data row with ISO timestamp, values, and scores
3. Open in Excel (or LibreOffice Calc) — accented characters render correctly (test by using a name with acento if possible — "Significant Murmur" etc. are fine). Each value lands in its own column.
4. Import into Google Sheets via File → Import → Upload — same layout.

- [ ] **Step 3: Commit**

```bash
git add plataforma/assets/js/export.js
git commit -m "Implement CSV export with UTF-8 BOM"
```

---

## Task 11: export.js — PDF via html2pdf

**Files:**
- Modify: `plataforma/assets/js/export.js`

- [ ] **Step 1: Replace the PDF stub with a real implementation**

In `plataforma/assets/js/export.js`, find:

```js
    function doPDF() { toast('PDF export not available yet', 'error'); }
```

Replace with:

```js
    function escapeHtml(s) {
        return String(s == null ? '' : s)
            .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    function buildPdfBody() {
        const parts = [];

        // Header
        parts.push('<div style="color:#64748b;font-size:11px;margin-bottom:16px">Generated on ' + escapeHtml(payload.generatedHuman) + '</div>');

        // Inputs
        const inputKeys = Object.keys(payload.inputs);
        if (inputKeys.length) {
            parts.push('<h2>Patient inputs</h2>');
            inputKeys.forEach(k => {
                const label = escapeHtml(k.replace(/^\d+_?/, '').replace(/_/g, ' '));
                parts.push('<div class="pdf-kv"><span>' + label + '</span><span>' + escapeHtml(payload.inputs[k]) + '</span></div>');
            });
        }

        // Scores
        parts.push('<h2>Scores</h2>');
        payload.scores.forEach(s => {
            parts.push(
                '<div class="pdf-score"><strong>' + escapeHtml(s.name) + '</strong>'
                + '<span class="val">' + escapeHtml(s.value) + '</span>'
                + (s.interpretation ? '<p style="margin:4px 0 0;font-size:11px;color:#333">' + escapeHtml(s.interpretation) + '</p>' : '')
                + '</div>'
            );
        });

        // References — reuse the DOM content from the modal
        const modal = document.getElementById('referenceBody');
        if (modal) {
            parts.push('<h2>References</h2>');
            payload.scores.forEach(s => {
                const key = s.name.replace(/\s+/g, '');
                const ref = modal.querySelector('.reference.' + CSS.escape(key))
                         || (/BRAFIL/i.test(s.name) ? modal.querySelector('.reference.BRAFIL') : null);
                if (ref) {
                    parts.push('<div class="pdf-ref">' + ref.innerHTML + '</div>');
                }
            });
        }

        return parts.join('');
    }

    async function doPDF() {
        if (typeof window.html2pdf === 'undefined') {
            toast('PDF failed to generate. Try Print as a workaround.', 'error');
            return;
        }
        const tpl = document.getElementById('pdfTemplate');
        const body = document.getElementById('pdfBody');
        if (!tpl || !body) return;

        body.innerHTML = buildPdfBody();
        try {
            await window.html2pdf()
                .from(tpl)
                .set({
                    filename: 'afibrisk-report-' + nowFilename() + '.pdf',
                    margin: [15, 15, 15, 15],
                    image: { type: 'jpeg', quality: 0.95 },
                    html2canvas: { scale: 2, useCORS: true },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                    pagebreak: { mode: ['css', 'legacy'] }
                })
                .save();
            toast('PDF downloaded', 'success');
        } catch (e) {
            toast('PDF failed to generate. Try Print as a workaround.', 'error');
        } finally {
            body.innerHTML = ''; // free memory
        }
    }
```

- [ ] **Step 2: Verify manually**

Reload `/result` (now with an assessment in session).

1. Click PDF → after 1–2s a file `afibrisk-report-YYYY-MM-DD-HHmm.pdf` downloads. Toast "PDF downloaded" (green).
2. Open in Chrome's built-in PDF viewer:
   - Page 1 has "AFibRisk — Assessment Report" header, timestamp, Patient Inputs (two-column key-value list), and start of Scores.
   - Scores list each on its own row with value in blue and interpretation (if present).
   - References section has bibliographic blocks for each computed score.
   - Footer with disclaimer appears on the last page.
   - References wrap across pages without cutting mid-sentence (CSS pagebreak).
3. Open in Adobe Reader — same layout, text is selectable.
4. **Offline test**: open DevTools Network tab → check "Offline" → reload `/result` → click PDF → expect red toast "PDF failed to generate. Try Print as a workaround." (because the CDN is blocked). Uncheck offline to restore.

- [ ] **Step 3: Commit**

```bash
git add plataforma/assets/js/export.js
git commit -m "Implement PDF export with html2pdf and reference inlining"
```

---

## Task 12: Print CSS, responsive polish, final verification

**Files:**
- Modify (append): `plataforma/assets/css/style.css`

- [ ] **Step 1: Append @media print block to style.css**

Append to `plataforma/assets/css/style.css`:

```css
/* ============================================================================
   Print
   ============================================================================ */
@media print {
    body { background: #fff; color: #000; }
    .topbar, .toolbar, .mobile-submit, .drawer-backdrop, .modal-backdrop, .toast,
    .sidebar, .ref-btn, .btn, .pdf-template { display: none !important; }
    .results-shell { max-width: none; padding: 0; margin: 0; }
    .results-header { display: block; margin-bottom: 16px; }
    .results-header h1 { font-size: 22px; color: #000; }
    .results-header .timestamp { font-size: 11px; color: #555; }
    .result-card {
        border: 1px solid #ccc !important; box-shadow: none !important;
        page-break-inside: avoid; break-inside: avoid;
        margin-bottom: 10px; padding: 10px;
    }
    .result-card .card-head { gap: 12px; }
    .result-card h3 { font-size: 13px; color: #000; }
    .result-card .value { color: #000; font-size: 16px; }
    .result-card .interp { font-size: 11px; color: #000; border-top: 1px solid #ccc; }
}
```

- [ ] **Step 2: Final end-to-end manual verification**

Run through this checklist (from the spec's verification plan) and note any regressions:

1. **Golden path** — `http://localhost/afibrisk/plataforma/` → Start → fill all 7 sections → Calculate → Results → Copy → paste in Notepad. Expected: formatted plain-text report with all scores and inputs.
2. **Conditional fields** — on questions page: Raised BMI = No → BMI ≥25 appears; BMI ≥25 = Yes → BMI value input appears; Smoking = No → Former smoker appears; Significant murmur = Yes → Precordial murmur appears; Gender = female → Autoimmune disease appears.
3. **Responsive** — DevTools device toolbar:
   - 1440×900: sidebar 260px, form 2 columns where applicable, toolbar labels visible.
   - 768×1024: sidebar 220px, form 1 column.
   - 390×844 (iPhone 14): hamburger in topbar, drawer opens/closes, Calculate sticky at bottom, toolbar icons only.
4. **Sidebar scroll-spy** — scroll through the questions page; active item in sidebar tracks viewport section.
5. **Progress** — fill at least one field in 3 different sections → progress shows ~43% (3/7) and those 3 have green checkmarks.
6. **CSV import** — open in Excel and Google Sheets; values in correct columns; accents render correctly.
7. **PDF** — open in Chrome PDF viewer and Adobe Reader; references wrap cleanly; no cut-mid-paragraph issues.
8. **Print preview** — Chrome and Firefox: only title + cards + generated-on timestamp appear; no topbar, no toolbar.
9. **Keyboard a11y** — Tab traverses inputs in visual order on questions page; focus ring visible; Escape closes drawer and modal.
10. **Browsers** — Chrome, Firefox, Edge (latest). Note: Safari not tested (no macOS environment available).
11. **Empty results** — clear cookies or open `/result` in a fresh incognito window → empty state with Start-assessment button; no toolbar visible.

Document any deviation as an issue in the PR, not as a code change here.

- [ ] **Step 3: Commit**

```bash
git add plataforma/assets/css/style.css
git commit -m "Add print CSS and finalize design refresh"
```

- [ ] **Step 4: Open the PR**

Push the branch and open a PR with title `Design refresh + copy/export results`. Body:

```
## Summary
- New "Dashboard Médico" visual identity: dark topbar, clinical blue, Inter typography
- Questions page redesigned with sidebar navigation, scroll-spy, progress, drawer on mobile
- Results page with Copy / PDF / CSV / Print toolbar and uniform cards
- Controller untouched except for one line persisting raw inputs in session

## Test plan
- [ ] Fill questionnaire, verify conditional fields (BMI chain, smoker, murmur, autoimmune by gender)
- [ ] Check sidebar scroll-spy + progress + drawer on mobile (≤767px)
- [ ] Copy result → paste in text editor, format correct
- [ ] CSV → opens cleanly in Excel and Google Sheets
- [ ] PDF → opens in Chrome and Adobe Reader, references paginate correctly
- [ ] Print preview shows only title + cards + timestamp
- [ ] Empty state on /result with fresh session
- [ ] Screenshots attached: home, questions desktop, questions mobile, results
```

---

## Self-review notes

- **Spec coverage** — every in-scope item has a task: tokens/base (T2), shared chrome (T3), home (T4), about (T5), questions markup (T6) + JS (T7), results markup (T8), export Copy (T9) + CSV (T10) + PDF (T11), print + final (T12), controller addition (T1). Out-of-scope items (badges, i18n) are intentionally absent.
- **Placeholders** — no "TBD" / "TODO" / "add validation" style steps. Every code block is complete.
- **Type/name consistency** — `data-action` values (`copy`/`pdf`/`csv`/`print`) match between the button markup (T8) and the click router (T9). `window.AFIBRISK_INPUTS` injection site (T8) matches reader (T9). Session key `respostas` matches between controller (T1) and view (T8).
- **Interpretation field limitation noted** — the current controller does not populate `value['interpretation']`; cards will render without a body paragraph until a separate follow-up populates it. Tooltip on (i) still provides the context. Called out in T8.
