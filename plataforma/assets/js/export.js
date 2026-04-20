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

    function refTextFor(scoreName) {
        const modal = document.getElementById('referenceBody');
        if (!modal) return '';
        const key = scoreName.replace(/\s+/g, '');
        const ref = modal.querySelector('.reference.' + CSS.escape(key))
                 || (/BRAFIL/i.test(scoreName) ? modal.querySelector('.reference.BRAFIL') : null);
        if (!ref) return '';
        return (ref.innerText || ref.textContent || '').replace(/\s+\n/g, '\n').replace(/\n\s+/g, '\n').trim();
    }

    function doPDF() {
        const jspdfNs = window.jspdf;
        const JsPDF = jspdfNs && jspdfNs.jsPDF;
        if (!JsPDF) {
            toast('PDF library failed to load. Try Print as a workaround.', 'error');
            return;
        }

        try {
            const pdf = new JsPDF({ unit: 'mm', format: 'a4', orientation: 'portrait' });
            const pageWidth  = pdf.internal.pageSize.getWidth();
            const pageHeight = pdf.internal.pageSize.getHeight();
            const margin = 15;
            const contentWidth = pageWidth - 2 * margin;
            let y = margin;

            function ensureSpace(needed) {
                if (y + needed > pageHeight - margin) {
                    pdf.addPage();
                    y = margin;
                }
            }
            function writeText(text, opts) {
                opts = opts || {};
                const size   = opts.size   || 10;
                const style  = opts.style  || 'normal';
                const color  = opts.color  || [15, 23, 42];
                const indent = opts.indent || 0;
                const lineH  = size * 0.45;
                pdf.setFont('helvetica', style);
                pdf.setFontSize(size);
                pdf.setTextColor(color[0], color[1], color[2]);
                const lines = pdf.splitTextToSize(String(text), contentWidth - indent);
                lines.forEach(line => {
                    ensureSpace(lineH);
                    pdf.text(line, margin + indent, y);
                    y += lineH;
                });
            }
            function hr() {
                ensureSpace(4);
                pdf.setDrawColor(226, 232, 240);
                pdf.setLineWidth(0.2);
                pdf.line(margin, y, pageWidth - margin, y);
                y += 3;
            }
            function gap(mm) { y += mm; }

            // Title block
            writeText('AFibRisk — Assessment Report', { size: 18, style: 'bold' });
            writeText('Generated on ' + payload.generatedHuman, { size: 9, color: [100, 116, 139] });
            gap(4);
            hr();

            // Patient inputs
            const inputKeys = Object.keys(payload.inputs);
            if (inputKeys.length) {
                writeText('Patient inputs', { size: 13, style: 'bold' });
                gap(1);
                inputKeys.forEach(k => {
                    const label = k.replace(/^\d+_?/, '').replace(/_/g, ' ');
                    writeText(label + ': ' + payload.inputs[k], { size: 10, color: [30, 41, 59] });
                });
                gap(3);
                hr();
            }

            // Scores
            writeText('Scores', { size: 13, style: 'bold' });
            gap(1);
            payload.scores.forEach(s => {
                ensureSpace(10);
                writeText(s.name + ' — ' + s.value, { size: 11, style: 'bold', color: [37, 99, 235] });
                if (s.interpretation) {
                    writeText(s.interpretation, { size: 9, color: [51, 65, 85], indent: 2 });
                }
                gap(1);
            });
            gap(2);

            // References
            const hasRefs = payload.scores.some(s => refTextFor(s.name));
            if (hasRefs) {
                hr();
                writeText('References', { size: 13, style: 'bold' });
                gap(1);
                payload.scores.forEach(s => {
                    const text = refTextFor(s.name);
                    if (!text) return;
                    ensureSpace(8);
                    writeText(s.name, { size: 10, style: 'bold' });
                    writeText(text, { size: 8, color: [71, 85, 105], indent: 2 });
                    gap(2);
                });
            }

            // Footer on every page
            const pageCount = pdf.internal.getNumberOfPages();
            pdf.setFont('helvetica', 'normal');
            pdf.setFontSize(8);
            pdf.setTextColor(100, 116, 139);
            for (let i = 1; i <= pageCount; i++) {
                pdf.setPage(i);
                pdf.text('Not a medical device. For educational/research use only. Page ' + i + ' of ' + pageCount,
                    pageWidth / 2, pageHeight - 8, { align: 'center' });
            }

            pdf.save('afibrisk-report-' + nowFilename() + '.pdf');
            toast('PDF downloaded', 'success');
        } catch (e) {
            console.error('[afibrisk] PDF generation failed:', e);
            toast('PDF failed to generate. Try Print as a workaround.', 'error');
        }
    }

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
