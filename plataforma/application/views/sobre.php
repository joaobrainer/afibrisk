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

        <section class="about-section citations">
            <h2>How to cite</h2>
            <ol class="citation-list">
                <li>
                    Andrade JBC, Gomes RP, Robles AC, Fagundes TP, Mendes GNN.
                    A preliminary evaluation of AFibrisk: digital decision-support platform for atrial fibrillation risk assessment after cryptogenic stroke—a cross-sectional concordance study.
                    <i>JAMIA Open</i>. 2026;9(1):ooag001.
                    <a href="https://doi.org/10.1093/jamiaopen/ooag001" target="_blank" rel="noopener">doi:10.1093/jamiaopen/ooag001</a>
                </li>
                <li>
                    Teixeira CT, Rizelio V, Robles A, Barros LCM, Silva GS, Andrade JBC.
                    A predictive score for atrial fibrillation in poststroke patients.
                    <i>Arq Neuropsiquiatr</i>. 2024;82(10):1-8.
                    <a href="https://www.scielo.br/j/anp/a/X9f3P4VyDMKPpfhXCqc7Pwy/abstract/?lang=en" target="_blank" rel="noopener">doi:10.1055/s-0044-1788271</a>
                </li>
                <li>
                    Andrade JBC, Pisa I, Oliveira NS, Gomes RP, Morais ABCG, Silva JV, Pardini TF, Goulart TO.
                    Predicting Incident Atrial Fibrillation after Stroke: A Scoping Review of Clinical Scores, Biomarkers, and AI-Enhanced Strategies.
                    <i>Cerebrovasc Dis Extra</i>. 2026;16(1):94-109.
                    <a href="https://doi.org/10.1159/000550097" target="_blank" rel="noopener">doi:10.1159/000550097</a>
                </li>
            </ol>
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
