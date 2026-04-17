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
