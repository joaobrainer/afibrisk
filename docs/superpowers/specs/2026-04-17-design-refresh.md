# AFibRisk — Design refresh + Copy/Export results

**Date:** 2026-04-17
**Status:** Design approved, ready for implementation planning

## Goal

Reformulação geral do design do AFibRisk (CodeIgniter 3 medical AF risk-score calculator) para uma identidade moderna e profissional ("dashboard médico"), com navegação facilitada no formulário de 40+ campos, e botões de Copiar/Exportar resultados (PDF, CSV, Print, texto plano).

## Scope

**In scope**
- Reescrita completa das views: `header.php`, `footer.php`, `home.php`, `sobre.php`, `perguntas/home.php`, `resultado/home.php`
- Reescrita completa de `assets/css/style.css` com design tokens próprios
- Novo arquivo `assets/js/export.js` (Copy, PDF, CSV, Print)
- Remoção do Bootstrap 5 (substituído por CSS próprio)
- Layout sidebar com navegação scroll-spy na página de perguntas
- Drawer mobile para a sidebar
- Tipografia Inter (substitui Multicolore Pro + Roboto Condensed)

**Out of scope** (fase 2)
- Badges de risco HIGH/MID/LOW por score (exige thresholds clínicos validados)
- Internacionalização PT-BR/EN (código comentado no form fica como está)
- Refatoração do controller `application/controllers/Home.php` (permitida apenas uma adição pontual: persistir os inputs brutos em `session->userdata('respostas')` para alimentar os exports — ver seção "Export module")
- Test harness automatizado (sem PHPUnit/Jest configurados)

## Constraints

- Controller `Home.php` e lógica de cálculo dos scores **não mudam**
- Session-based result storage (`$this->session->userdata('resultados')`) mantido
- Tippy.js + Popper mantidos para tooltips (já em produção)
- Todos os scores calculados hoje (STAF, BRAFIL, ASAS, CHA2DS2-VASc, C2HEST, HAVOC, CHARGE-AF, HARMS2-AF, Hamada, Mayo, HATCH, Framingham, MHS, ARIC, Suita, Taiwan-AF) continuam aparecendo
- Lógica condicional de campos atual preservada:
  - BMI ≥25 só aparece se "Raised BMI" = No
  - BMI value só aparece se BMI ≥25 = Yes
  - "Former smoker" só aparece se Smoking = No
  - "Precordial murmur" só aparece se Significant murmur = Yes
  - "Autoimmune disease" só aparece se Gender = female

## Design decisions

### 1. Visual direction — Dashboard Médico

- Header escuro (`#0f172a`), cards brancos, azul clínico (`#2563eb`) como primary
- Tipografia Inter (sans) + JetBrains Mono para valores numéricos
- Sem ornamentos decorativos (remove `oval-shape`, `retangular-shape`, backgrounds `bg-1/2/3.jpg`)
- Scroll global normal (remove `overflow-y: hidden` do body)

### 2. Design tokens (CSS variables)

```css
:root {
  --color-ink: #0f172a;
  --color-ink-2: #1e293b;
  --color-muted: #64748b;
  --color-border: #e2e8f0;
  --color-surface: #ffffff;
  --color-surface-alt: #f8fafc;
  --color-primary: #2563eb;
  --color-primary-dark: #1d4ed8;
  --color-success: #16a34a;
  --color-danger: #dc2626;

  --font-sans: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
  --font-mono: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace;

  --space-1: 4px; --space-2: 8px; --space-3: 12px; --space-4: 16px;
  --space-6: 24px; --space-8: 32px; --space-12: 48px;

  --radius-sm: 6px;
  --radius: 10px;
  --radius-lg: 16px;

  --shadow-sm: 0 1px 2px rgba(15, 23, 42, 0.06);
  --shadow:    0 4px 12px rgba(15, 23, 42, 0.08);
}
```

### 3. Page layouts

**Home** — `home.php`
- Container centralizado, max-width 720px, padding vertical generoso
- Título "AFibRisk" em h1, subtítulo curto sobre o propósito
- Botão primário "Start assessment" → `/questions`
- Link secundário "About" → `/about`
- Fundo `--color-surface-alt` (sem imagem)

**Sobre** — `sobre.php`
- Mesmo container centralizado max-width 720px
- `<section>` para créditos, `<section>` destacada para disclaimer (borda esquerda `--color-danger`)
- Título h1 "About AFibRisk"

**Perguntas** — `perguntas/home.php`

Layout:
```
┌─ Topbar sticky 56px (logo + Help + Cancel) ─────────────────┐
├────────────────┬────────────────────────────────────────────┤
│ Sidebar 260px  │ Conteúdo (flex)                            │
│ (fixa desktop) │   <section id="demographic"> ...           │
│                │   <section id="neurological"> ...          │
│ ✓ Demographic  │   <section id="body-metrics"> ...          │
│ ● Neurological │   <section id="history"> ...              │
│   Body metrics │   <section id="echography"> ...           │
│   History      │   <section id="ecg"> ...                  │
│   Echography   │   <section id="cardiology"> ...           │
│   ECG          │                                            │
│   Cardiology   │   [← Previous]        [Next: Body →]       │
│                │                                            │
│ Progress 29%   │                                            │
│ [Calculate]    │                                            │
└────────────────┴────────────────────────────────────────────┘
```

Comportamento:
- Cada seção é `<section id="...">`. Click na sidebar faz `scrollIntoView({ behavior: 'smooth' })`.
- Sidebar usa `IntersectionObserver` com `rootMargin: "-40% 0px -55% 0px"` para marcar a seção ativa enquanto o usuário rola.
- Item completo (`✓`): qualquer campo `name` da seção com valor preenchido → conta como "done" em verde.
- Item ativo (`●`): azul primary. Hover de itens pendentes em cinza.
- Barra de progresso: `(seções com ao menos 1 campo preenchido) / 7`. Atualiza ao `change` de qualquer input.
- Radios "Yes/No" redesenhados como **pill buttons** (div com `role="radiogroup"`, cada opção um `<label>` com input escondido visualmente mas acessível por tab).
- Inputs numéricos: `type="number"` + `inputmode="numeric"` (substitui `onkeypress="return onlyNumberKey(event)"`). Validação HTML5 `min/max` onde aplicável.
- Tooltips de ajuda (os 5 `tippy` atuais + 12 na página de resultado): tema `customTooltipCssTema` reestilizado para a nova paleta.

Mobile (≤768px):
- Sidebar vira **drawer**: botão `☰` na topbar abre/fecha overlay 85% da largura.
- Drawer é `<aside class="sidebar">` com `transform: translateX(-100%)` e classe `.open` que muda para `translateX(0)`.
- Backdrop `<div class="drawer-backdrop">` com fade; click fecha drawer.
- Botão "Calculate" sticky no rodapé (100% largura) no mobile.
- Formulário em 1 coluna (desktop usa 2).

**Resultados** — `resultado/home.php`

Layout:
```
┌─ Topbar sticky (igual) ─────────────────────────────────────┐
├─────────────────────────────────────────────────────────────┤
│  h1 "Results"    Generated on 17 Apr 2026, 14:32           │
│  [📋 Copy] [📄 PDF] [📊 CSV] [🖨 Print] [↻ New assessment]  │
│                                                             │
│  ┌── Card ──────────────────────────────────────────┐       │
│  │ STAF                              6 / 8      (i) │       │
│  │ ───────────────────────────────────              │       │
│  │ Score of ≥5 identifies patients with AF with...  │       │
│  └──────────────────────────────────────────────────┘       │
│  ... (outros scores)                                        │
│                                                             │
│  [hidden div .pdf-template — usado pelo html2pdf]           │
│  [modal de referências — markup existente, re-estilizado]   │
└─────────────────────────────────────────────────────────────┘
```

Detalhes:
- Toolbar sticky logo abaixo do título (fica visível no scroll). Desktop: ícone + label. Mobile: só ícone, com `aria-label` para acessibilidade.
- Cards uniformes (todos brancos, `--shadow-sm`, `--radius`). Remove alternância par/ímpar.
- Título do card: semibold, `--color-ink`. Valor: `--font-mono`, 24px, `--color-primary`, `font-variant-numeric: tabular-nums`.
- O card exibe duas camadas de informação:
  1. **Interpretação curta** (hoje só no tooltip Tippy de cada score, ex.: "A total score of ≥5 identifies patients with AF with sensitivity 89%..."): promovida para dentro do card abaixo do separador. Não depende mais de hover.
  2. **Referência bibliográfica completa**: ícone `(i)` no canto superior direito do card abre o modal existente (`#referenceModal` com `.reference.<KEY>`). Markup reaproveitado, só re-estilizado.
- Tooltips Tippy atuais nos scores ficam como **fonte da interpretação curta** — o texto vai do JS para o PHP (rendered estático no card).
- Card do **Hamada** mantém a imagem (`assets/images/hamada/<value>.png`) com moldura `--radius` e legenda.
- "Repeat" renomeado para "New assessment" — botão secondary no topo.

Empty state (sem dados na session):
- Texto: "No assessment yet. [Start an assessment]"
- Botões de export desabilitados (`aria-disabled="true"`, pointer-events: none, opacity 0.5).

### 4. Export module — `assets/js/export.js`

Monta payload único no `DOMContentLoaded` a partir do DOM:

```js
const payload = {
  generatedAt: "2026-04-17T14:32:00-03:00",  // ISO local
  inputs: {  // chave = name do input, valor = value
    age: "72", gender: "male", nihss: "8", /* ... */
  },
  scores: [
    { name: "STAF",         value: "6", max: "8",  message: "..." },
    { name: "BRAFIL",       value: "3", max: "6",  message: "..." },
    { name: "CHA2DS2-VASc", value: "4", max: null, message: "..." },
    // ...
  ]
}
```

Os inputs são injetados no `resultado/home.php` via:
```php
<script>window.AFIBRISK_INPUTS = <?= json_encode($this->session->userdata('respostas') ?: []) ?>;</script>
```
Isso **exige** que o controller `Home.php` persista os inputs brutos na sessão sob a chave `respostas` (em paralelo a `resultados`). A única alteração no controller é adicionar `$this->session->set_userdata('respostas', $this->input->post())` antes do redirect — flagged na seção de Open questions. Se o controller estiver intocável, fallback: ler os inputs do `$_POST` no próprio action e repassar via flashdata.

**Copy** (texto plano):
```
AFibRisk — Assessment
Generated: 2026-04-17 14:32

Scores
- STAF:          6 / 8
- BRAFIL:        3 / 6
- CHA2DS2-VASc:  4
...

Inputs
- Age: 72
- Gender: male
- NIHSS: 8
...
```
- `navigator.clipboard.writeText(text)` com try/catch
- Fallback: `<textarea>` temporário + `document.execCommand('copy')`
- Feedback: toast `--color-success` "Copied to clipboard" por 2s
- Se falha em ambos: toast `--color-danger` "Couldn't copy. Try Print instead."

**CSV** (research row):
- Header: `generated_at,age,gender,nihss,...,score_staf,score_brafil,score_cha2ds2vasc,...`
- Valores escapados: envolvidos em `"` se contêm vírgula/quebra/aspas; aspas internas viram `""`
- UTF-8 BOM (`\uFEFF`) no início para Excel reconhecer acentos
- Download: `Blob` + `<a download>`, filename `afibrisk-YYYY-MM-DD-HHmm.csv`

**PDF** (relatório completo):
- Biblioteca: `html2pdf.js` via CDN (`https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js`)
- Renderiza `<div class="pdf-template" hidden>` pré-montada no view, contendo:
  - Cabeçalho: "AFibRisk Assessment Report" + data/hora
  - Seção "Patient inputs" — tabela 2 colunas (label, value)
  - Seção "Scores" — um bloco por score (nome, valor, mensagem)
  - Seção "References" — para cada score computado, a referência bibliográfica completa (reaproveita HTML de `.reference .<KEY>` do modal atual)
  - Rodapé: disclaimer resumido + "Not a medical device"
- Config: A4 portrait, margens 15mm, `pagebreak: { mode: ['css', 'avoid-all'] }`
- Filename: `afibrisk-report-YYYY-MM-DD-HHmm.pdf`
- Falha (CDN offline): toast `--color-danger` "PDF failed to generate. Try Print as a workaround."

**Print** (`window.print()`):
- CSS `@media print` em `style.css`:
  - Esconde `.topbar`, `.toolbar`, `.btn-new`, modais
  - Fundo branco, cores em preto
  - Cards com borda 1px sólida em vez de shadow
  - `break-inside: avoid` dentro de cada card
  - Mostra data/hora e título normalmente

### 5. Error handling and edge cases

- **Session null/empty em `/result`** → empty state com botões desabilitados
- **Clipboard API bloqueada** (HTTP, permissão) → fallback `execCommand`, depois toast de erro
- **html2pdf CDN offline** → try/catch no `.save()`, toast de erro, outros botões continuam funcionais
- **Campos numéricos vazios** → mesma validação do backend hoje; visualmente destacar primeiro campo com erro em vermelho + scroll até ele
- **Scroll-spy com seções curtas** → `rootMargin: "-40% 0px -55% 0px"` garante uma seção ativa de cada vez

### 6. Accessibility

- Todos `<input>` com `<label for="...">` associado
- Radios como pill buttons mantêm `<input type="radio">` real (visualmente escondido via `.sr-only`), acessível por tab e screen reader
- Foco visível em todos os interativos (`outline: 2px solid var(--color-primary); outline-offset: 2px;`)
- Toolbar ícone-only no mobile tem `aria-label` em cada botão
- Sidebar drawer: `aria-expanded` no botão hamburger, foco transferido para primeiro item ao abrir, ESC fecha

### 7. Responsive breakpoints

- Desktop: ≥1024px — sidebar fixa 260px, form 2 colunas
- Tablet: 768–1023px — sidebar fixa 220px, form 1 coluna
- Mobile: ≤767px — sidebar drawer, topbar com hamburger, form 1 coluna, Calculate sticky

### 8. Files and structure

```
plataforma/
├── application/views/
│   ├── header.php              [rewritten — Inter font, export.js conditional load]
│   ├── footer.php              [rewritten — remove jQuery slim, keep Tippy/Popper]
│   ├── home.php                [rewritten]
│   ├── sobre.php               [rewritten]
│   ├── perguntas/home.php      [rewritten — sidebar + sections + pill radios]
│   └── resultado/home.php      [rewritten — toolbar, cards, pdf-template, modal re-skin]
└── assets/
    ├── css/style.css           [rewritten from scratch]
    └── js/export.js            [NEW — copy, csv, pdf, print]
```

Bootstrap 5 CSS/JS removido do `header.php`. jQuery mantida (Tippy depende via Popper). Adicionado html2pdf via CDN só em `resultado/home.php`.

## Verification plan

Sem test harness automatizado — checklist manual obrigatório antes de merge:

1. **Golden path**: home → preencher todas 7 seções → Calculate → Results → Copy → paste em editor de texto → validar formato
2. **Lógica condicional preservada**: testar Raised BMI No → BMI ≥25 aparece; Smoking No → Former smoker aparece; Significant murmur Yes → Precordial aparece; Gender female → Autoimmune aparece
3. **Responsivo**: testar em 1440px, 768px, 390px (Chrome DevTools device toolbar). Sidebar vira drawer abaixo de 768px
4. **Sidebar scroll-spy**: rolar página de perguntas, confirmar que item ativo segue o scroll; clicar item, confirmar scroll suave até seção
5. **Progresso**: preencher 1 campo em 3 seções diferentes, confirmar barra em ~43% (3/7) e checkmarks
6. **Export CSV**: abrir em Excel + Google Sheets, validar acentos (UTF-8 BOM) e separadores
7. **Export PDF**: abrir no Chrome PDF viewer + Adobe Reader, validar paginação das referências longas
8. **Print preview**: Chrome + Firefox, confirmar que só título + cards + data aparecem
9. **Acessibilidade**: tab atravessa campos na ordem lógica; foco visível; sidebar drawer fecha com ESC
10. **Browsers**: Chrome, Firefox, Edge atuais. Safari não testado (sem ambiente) — anotar como limitação conhecida no PR

## Rollout

Um único PR cobrindo todas as views + CSS + JS. Preview local via XAMPP antes do merge. Screenshots das 4 telas principais (home, questions desktop, questions mobile, results) anexadas no PR.

## Open questions / assumptions to validate during implementation

- **Inputs na session** — confirmar na leitura do `Home.php` durante implementação se já existe persistência dos inputs brutos. Caso não, adicionar uma única linha no action `todasRespostas`: `$this->session->set_userdata('respostas', $this->input->post())` antes do redirect. Nenhuma outra mudança no controller.
- **Validação no backend** — confirmar se o controller valida campos obrigatórios; se sim, alinhar mensagens de erro com o novo visual.
- **Licença dos fontes** — Inter é OFL, sem problema. Confirmar que remover Multicolore Pro não quebra nada (está só no header.php).
