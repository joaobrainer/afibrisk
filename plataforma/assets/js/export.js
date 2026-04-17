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
