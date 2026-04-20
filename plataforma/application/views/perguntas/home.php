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
                <div class="field"><label>Presence of symptomatic extra- or intracranial stenosis &#x2265;50%, symptomatic arterial dissection, or clinico-radiological lacunar syndrome</label>
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
        const firstLink = sidebar.querySelector('a[data-section]');
        if (firstLink) firstLink.focus();
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
</body>
</html>
