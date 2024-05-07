<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
</head>
<body id="background3">

    <div class="row title results">
        <div class="col-md-12">
            <span>Results</span>
        </div>
        <div class="retangular-shape"></div>
    </div>

	<div class="container container-resultado">

        <div class="subcontainer-resultado">

            <?php 
                $resultado = $this->session->userdata('resultados'); 

                if($resultado != null){
                    foreach ($resultado as $key => $value) {
                        if ($value['resposta'] != 'none') {
                            echo '<div class="card-container">';
                            echo '<div class="card">';
                            echo '<div class="card-header">';
                            echo '<h5 class="card-title">'.$key.'</h5>';
                            if ($value['message']) {
                                $id = str_replace(' ', '', $key);
                                if (strpos($key, 'BRAFIL') !== false) {
                                    $id = 'BRAFIL';
                                }
                                echo '<i class="fas fa-info-circle show-reference" id="'.$id.'"></i>'; 
                            }
                            echo '</div>';
                            echo '<div class="card-body">';    
                            if ($key == 'Hamada') {
                                echo '<img src="'.base_url("assets/images/hamada/".$value['resposta'].".png").'" class="img-size" alt="Hamada">';                             
                            } else{
                                echo '<p class="card-text">'.$value['resposta'].'</p>'; 
                            }                          
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }            
            ?>

            <div class="d-flex justify-content-end mt-5 div-btn-calculate">
                <button type="button" name="submit" class="btn btn-primary btn-calculate" data-translate="repeat">Repeat</button>
            </div>   
            
            <!-- Modal -->
            <div class="modal fade" id="referenceModal" tabindex="-1" role="dialog" aria-labelledby="referenceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg"" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="referenceModalLabel">Reference</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="reference STAF">
                                <p><b>Score for the Targeting of Atrial Fibrillation (STAF) - A New Approach to the Detection of Atrial Fibrillation in the Secondary Prevention of Ischemic Stroke</b></p>
                                <p>Laurent Suissa, MD; David Bertora, MD; Sylvain Lachaud, MD; Marie He´le`ne Mahagne, MD, PhD</p>
                                <p>Background and Purpose—The high risk of recurrence and comorbidity after a stroke associated with atrial fibrillation (AF) justifies an aggressive diagnostic approach so that anticoagulant treatment can be initiated. <br>
                                    Methods—The clinical and paraclinical characteristics of consecutive ischemic stroke patients with and without documented AF were recorded. Independent predictive factors were then used to produce a predictive grading score for diagnosing AF, derived by logistic regression analysis: Score for the Targeting of Atrial Fibrillation (STAF). <br>
                                    Results—STAF, calculated from the sum of the points for the 4 items (possible total score 0 to 8): age _62 years (2 points); NIHSS _8 (1 point); left atrial dilatation (2 points); absence of symptomatic intra or extracranial stenosis _50%, or clinico-radiological lacunar syndrome (3 points). STAF _5 identified patients with AF with a sensitivity of 89% and a specificity of 88%. <br>
                                    Conclusions—STAF can be used as part of a novel and simple strategy for the targeting of AF in the secondary prevention of ischemic stroke. A multicenter study is now required to validate STAF in a larger number of patients
                                    </p>
                                <p><b>DOI: 10.1161/STROKEAHA.109.552679</b></p>
                            </div>


                            <div class="reference BRAFIL">
                                <p><b>A predictive score of Atrial Fibrillation in post-stroke patients</b></p>
                                <p>Caroliny Trevisan Teixeira, Vanessa Rizelio, Alexandre Robles, Levi Coelho Maia Barros, Gisele Sampaio Silva, Joao Brainer Clares de Andrade</p>
                                <p>Background and objective <br>
                                    Atrial Fibrillation (AF) is a risk factor for cerebral ischemia. Identifying the presence of AF, especially in paroxysmal cases, may take time and lacks clear support in the literature regarding the optimal investigative approach; in resource-limited settings, identifying a higher-risk group for AF can assist in planning further investigation. Our objective is to develop a scoring tool to predict the risk of AF in the post-stroke follow-up. <br>
                                    Methods <br>
                                    A retrospective longitudinal study with data collected from electronic medical records of patients hospitalized and followed up for cerebral ischemia from 2014 to 2021 at a tertiary stroke center. Demographic, clinical, laboratory, electrocardiogram, and echocardiogram data, as well as neuroimaging, were collected. A stepwise logistic regression was employed to identify associated variables. A score with integer numbers was created based on beta-coefficients. Calibration and validation were performed to evaluate accuracy. <br>
                                    Results <br>
                                    We included 872 patients in our final analysis. The score was created with left atrial diameter ≥42 mm (2 points), age ≥70 years (1), presence of septal aneurysm (2), and NIHSS ≥6 at admission (1). The score ranges from 0 to 6. Patients with a score ≥2 points had a fivefold increased risk of detecting AF in the follow-up. The area under the curve (AUC) was 0.77 (0.72-0.85). <br>
                                    Conclusions <br>
                                    It was possible to structure an accurate risk score tool for AF, which could be validated in multicenter samples in future studies
                                </p>
                            </div>

                            <div class="reference TheHeinzNixdorfRecallStudy">
                                <p><b>B-type natriuretic peptide for incident atrial fibrillation-The Heinz Nixdorf Recall Study</b></p>
                                <p>Kaffer Kara , Marie Henrike Geisel , Stefan Möhlenkamp , Nils Lehmann , Hagen Kälsch , Marcus Bauer , Till Neumann , Nico Dragano , Susanne Moebus , Karl-Heinz Jöckel , Raimund Erbel , Amir Abbas Mahabadi </p>
                                <p>Abstract <br>
                                    Background: Atrial fibrillation (AF) is the most common arrhythmia and is associated with increased morbidity and mortality. Thus, identifying subjects with unknown AF or at higher risk for future AF in the general population is of importance. B-type natriuretic peptide (BNP) is linked with silent cardiac diseases. We evaluated the association of BNP with incident AF in a large population-based cohort study. <br>
                                    Methods: We included subjects from the population-based Heinz Nixdorf Recall study without known coronary heart disease, prior stroke, history of open heart surgery, heart-device therapy, or prevalent AF at baseline. Association of continuous and binary (≥31pg/ml for male, ≥45pg/ml for female) BNP with incident AF after 5 years was assessed using logistic regression analysis. <br>
                                    Results: A total of 3067 subjects (mean age 58.9 years, 47.9% male) were included in this analysis. Subjects with incident AF (n=42) had higher levels of BNP (median (Q1; Q3): 33.2pg/ml (19.4; 50.5) vs. 16.9pg/ml (9.2; 30.2)). Likewise, BNP was associated with incidence of AF both in univariate model and when adjusting for AF risk factors (odds ratio (OR) (95% confidence interval (CI)): BNP as continuous variable: 1.27 (1.09; 1.47), p=0.002; BNP as binary variable: 2.68 (1.41; 5.11) with AF risk factor adjustment). Notably, especially younger subjects (<60 years) showed stronger association with incident AF than older ones (OR (95%CI) for dichotomized BNP: 7.20 (1.60; 32.49), p=0.01 for <60 years, vs. 2.13 (0.89; 5.09), p=0.09 for 60-70 years, and 4.40 (1.29; 14.97), p=0.02 for >70 years).
                                </p>
                                <p>Conclusions: Elevated levels of BNP are associated with significant excess of incident AF, independent of traditional AF risk factors in the general population. Gender-specific BNP thresholds may help in prevention by detecting unknown or future AF, which carries a high risk of stroke events.</p>
                                <p><b>doi: 10.1016/j.jjcc.2014.08.003</b></p>
                            </div>

                            <div class="reference ASAS">
                                <p><b>Score for atrial fibrillation detection in acute stroke and transient ischemic attack patients in a Brazilian population: The acute stroke atrial fibrillation scoring system</b></p>
                                <p>Marcelo Marinho de Figueiredo, Ana Clara Tude Rodrigues, Monique Bueno Alves, Miguel Cendoroglo Neto, Gisele Sampaio Silva</p>
                                <p>OBJECTIVE: Atrial fibrillation is a common arrhythmia that increases the risk of stroke by four- to five-fold. We aimed to establish a profile of patients with atrial fibrillation from a population of patients admitted with acute ischemic stroke or transient ischemic attack using clinical and echocardiographic findings. <br>
                                    METHODS: We evaluated patients consecutively admitted to a tertiary hospital with acute ischemic stroke or transient ischemic attack. Subjects were divided into an original set (admissions from May 2009 to October 2010) and a validation set (admissions from November 2010 to April 2013). The study was designed as a cohort, with clinical and echocardiographic findings compared between patients with and without atrial fibrillation. A multivariable model was built, and independent predictive factors were used to produce a predictive grading score for atrial fibrillation (Acute Stroke AF Score-ASAS). <br>
                                    RESULTS: A total of 257 patients were evaluated from May 2009 to October 2010 and included in the original set. Atrial fibrillation was diagnosed in 17.5% of these patients. Significant predictors of atrial fibrillation in the multivariate analysis included age, National Institutes of Health Stroke Scores, and the presence of left atrial enlargement. These predictors were used in the final logistic model. For this model, the area under the receiver operating characteristic curve was 0.79. The score derived from the logistic regression analysis was -- <br>
                                    The model developed from the original data set was then applied to the validation data set, showing the preserved discriminatory ability of the model (c statistic = 0.76). <br>
                                    CONCLUSIONS: Our risk score suggests that the individual risk for atrial fibrillation in patients with acute ischemic stroke can be assessed using simple data, including age, National Institutes of Health Stroke Scores at
                                    admission, and the presence of left atrial enlargement.
                                    DOI: 10.6061/clinics/2014(04)04
                                </p>
                            </div>

                            <div class="reference CHA2DS2-VASC">
                                <p><b>Usefulness of CHADS2 and CHA2DS2-VASc Scores in the Prediction of New-Onset Atrial Fibrillation: A Population-Based Study</b></p>
                                <p>Walid Saliba , Naomi Gronich , Ofra Barnett-Griness , Gad Rennert </p>
                                <p>Abstract <br>
                                    Background: CHADS2 and CHA2DS2-VASc are validated scores used to predict stroke in patients with atrial fibrillation. Many of the individual risk factors included in these scores are also risk factors for atrial fibrillation. We aimed to examine the performance of CHADS2 and CHA2DS2-VASc scores in predicting new-onset atrial fibrillation in subjects without preexisting diagnosis of atrial fibrillation.
                                </p>
                                <p>Methods: Using the computerized database of the largest health maintenance organization in Israel, we identified all adults aged 50 years or older without atrial fibrillation prior to January 1, 2012. CHADS2 and CHA2DS2-VASc scores were calculated for each participant at study entry, and the cohort was followed for incident atrial fibrillation until December 31, 2014.</p>
                                <p>Results: Of 1,062,073 subjects without preexisting diagnosis of atrial fibrillation; 23,223 developed atrial fibrillation during a follow-up of 3,053,754 person-years (incidence rate, 0.76 per 100 person-years). Incidence rate of atrial fibrillation increased in a graded manner with increasing CHA2DS2-VASc score: 0.17, 0.21, 0.49, 0.94, 1.65, 2.31, 2.75, 3.39, 4.09, and 6.71 per 100 person-years for CHA2DS2-VASc score of 0 to 9 points, respectively (P < .001). The hazard ratio for atrial fibrillation for each 1-point increase in CHA2DS2-VASc score was 1.57 (95% confidence interval [CI], 1.56-1.58). Results were similar for CHADS2 score. The area under the receiver operating characteristic curve to predict new-onset atrial fibrillation was 0.728 (95% CI, 0.725-0.711) and 0.744 (95% CI, 0.741-0.747) for CHADS2 and CHA2DS2-VASc scores, respectively.</p>
                                <p>Conclusions: CHADS2 and CHA2DS2-VASc scores are directly associated with the incidence of new-onset atrial fibrillation, and have a relatively high performance for atrial fibrillation prediction.</p>
                                <p><b>PMID: 27012854 DOI: 10.1016/j.amjmed.2016.02.029</b></p>
                            </div>

                            <div class="reference C2HEST">
                                <p><b>C2HEST score for atrial fibrillation risk prediction models: a Diagnostic Accuracy Tests meta-analysis</b></p>
                                <p>Habib Haybar , Kimia Shirbandi , Fakher Rahim </p>
                                <p>Abstract <br>
                                    Background: This meta-analysis aimed to assess the value of the C2HEST score to facilitate population screening and detection of AF risk in millions of populations and validate risk scores and their composition and discriminatory power for identifying people at high or low risk of AF. We searched major indexing databases, including Pubmed/Medline, ISI web of science, Scopus, Embase, and Cochrane central, using ("C2HEST" OR "risk scoring system" OR "risk score") AND ("atrial fibrillation (AF)" OR "atrial flutter" OR "tachycardia, supraventricular" OR "heart atrium flutter") without any language, study region or study type restrictions between 1990 and 2021 years. Analyses were done using Meta-DiSc. The title and abstract screening were conducted by two independent investigators.
                                </p>
                                <p>Results: Totally 679 records were found through the initial search, of which ultimately, nine articles were included in the qualitative and quantitative analyses. The risk of AF accompanied every one-point increase of C2HEST score (OR 1.03, 95% CI 1.01-1.05, p < 0.00001), with a high heterogeneity across studies (I2 = 100%). The SROC for C2HEST score in the prediction of AF showed that the overall area under the curve (AUC) was 0.91 (95% CI 0.85-0.96), AUC in Asian population was 0.87 (95% CI: 0.78-0.95) versus non-Asian 0.95 (95% CI 0.91-0.99), and in general population was 0.92 (95% CI 0.85-0.99) versus those with chronic conditions 0.83 (95% CI 0.71-0.95), respectively</p>
                                <p>Conclusions: The results of this research support the idea that this quick score has the opportunity for use as a risk assessment in patients' AF screening strategies.</p>
                                <p><b>PMID: 34862957 PMCID: PMC8643379 DOI: 10.1186/s43044-021-00230-0</b></p>
                            </div>

                            <div class="reference Takase">
                                <p><b>Prediction of Atrial Fibrillation by B-type Natriuretic Peptide</b></p>
                                <p>Hiroyuki Takase, MD, Yasuaki Dohi, MD, Hiroo Sonoda, MD, and Genjiro Kimura, MD</p>
                                <p>Background: Although several conditions have been proposed as risk factors contributing to the incidence of atrial fibrillation, many individuals without such ‘risk factors’ also suffer from atrial fibrillation. The present study tested the hypothesis that the risk of new-onset atrial fibrillation increases with increasing circulating levels of B-type natriuretic peptide in the general population.</p>
                                <p>Methods: Participants in our health checkup program without atrial fibrillation or a history of atrial fibrillation were enrolled (n=10,058, 54.3±11.3 years old). After baseline evaluation, subjects were followed up for the median of 1,791 days with the endpoint being the new onset of atrial fibrillation.</p>
                                <p>Results: Atrial fibrillation occurred in 53 subjects during the follow-up period (1.16 per 1,000 person-year). The risk of new-onset atrial fibrillation increased across the gender-specific quartiles of B-type natriuretic peptide levels at baseline. In multivariate Cox proportional hazard regression analysis where B-type natriuretic peptide concentrations were taken as a continuous variable, B-type natriuretic peptide was a significant predictor of new onset of atrial fibrillation after adjustment for possible factors (hazard ratio 5.65 [95% CI 2.63–12.41]).</p>
                                <p>Conclusions: The risk of new onset of atrial fibrillation increases with increasing B-type natriuretic peptide levels in the general population. Measurement of B-type natriuretic peptide may improve the prediction of incident atrial fibrillation</p>
                                <p><b>DOI: 10.4022/jafib.674</b></p>
                            </div>

                            <div class="reference HAVOC">
                                <p><b>A Clinical Score for Predicting Atrial Fibrillation in Patients with Cryptogenic Stroke or Transient Ischemic Attack</b></p>
                                <p>Calvin Kwong , Albee Y Ling, Michael H Crawford, Susan X Zhao, Nigam H Shah</p>
                                <p>Abstract <br>
                                    Objectives: Detection of atrial fibrillation (AF) in post-cryptogenic stroke (CS) or transient ischemic attack (TIA) patients carries important therapeutic implications.
                                </p>
                                <p>Methods: To risk stratify CS/TIA patients for later development of AF, we conducted a retrospective cohort study using data from 1995 to 2015 in the Stanford Translational Research Integrated Database Environment (STRIDE).
                                    Results: Of the 9,589 adult patients (age ≥40 years) with CS/TIA included, 482 (5%) patients developed AF post CS/TIA. Of those patients, 28.4, 26.3, and 45.3% were diagnosed with AF 1-12 months, 1-3 years, and >3 years after the index CS/TIA, respectively. Age (≥75 years), obesity, congestive heart failure, hypertension, coronary artery disease, peripheral vascular disease, and valve disease are significant risk factors, with the following respective odds ratios (95% CI): 1.73 (1.39-2.16), 1.53 (1.05-2.18), 3.34 (2.61-4.28), 2.01 (1.53-2.68), 1.72 (1.35-2.19), 1.37 (1.02-1.84), and 2.05 (1.55-2.69). A risk-scoring system, i.e., the HAVOC score, was constructed using these 7 clinical variables that successfully stratify patients into 3 risk groups, with good model discrimination (area under the curve = 0.77).
                                </p>
                                <p>Conclusions: Findings from this study support the strategy of looking longer and harder for AF in post-CS/TIA patients. The HAVOC score identifies different levels of AF risk and may be used to select patients for extended rhythm monitoring.</p>
                                <p>PMID: 28654919 PMCID: PMC5683906 DOI: 10.1159/000476030</p>
                            </div>

                            <div class="reference CHARGE-AF">
                                <p><b>Simple risk model predicts incidence of atrial fibrillation in a racially and geographically diverse population: the CHARGE-AF consortium</b></p>
                                <p>Alvaro Alonso , Bouwe P Krijthe, Thor Aspelund, Katherine A Stepas, Michael J Pencina, Carlee B Moser, Moritz F Sinner, Nona Sotoodehnia, João D Fontes, A Cecile J W Janssens, Richard A Kronmal, Jared W Magnani, Jacqueline C Witteman, Alanna M Chamberlain, Steven A Lubitz, Renate B Schnabel, Sunil K Agarwal, David D McManus, Patrick T Ellinor, Martin G Larson, Gregory L Burke, Lenore J Launer, Albert Hofman, Daniel Levy, John S Gottdiener, Stefan Kääb, David Couper, Tamara B Harris, Elsayed Z Soliman, Bruno H C Stricker, Vilmundur Gudnason, Susan R Heckbert, Emelia J Benjamin</p>
                                <p>Abstract <br>
                                    Background: Tools for the prediction of atrial fibrillation (AF) may identify high-risk individuals more likely to benefit from preventive interventions and serve as a benchmark to test novel putative risk factors.
                                </p>
                                <p>Methods and results: Individual-level data from 3 large cohorts in the United States (Atherosclerosis Risk in Communities [ARIC] study, the Cardiovascular Health Study [CHS], and the Framingham Heart Study [FHS]), including 18 556 men and women aged 46 to 94 years (19% African Americans, 81% whites) were pooled to derive predictive models for AF using clinical variables. Validation of the derived models was performed in 7672 participants from the Age, Gene and Environment-Reykjavik study (AGES) and the Rotterdam Study (RS). The analysis included 1186 incident AF cases in the derivation cohorts and 585 in the validation cohorts. A simple 5-year predictive model including the variables age, race, height, weight, systolic and diastolic blood pressure, current smoking, use of antihypertensive medication, diabetes, and history of myocardial infarction and heart failure had good discrimination (C-statistic, 0.765; 95% CI, 0.748 to 0.781). Addition of variables from the electrocardiogram did not improve the overall model discrimination (C-statistic, 0.767; 95% CI, 0.750 to 0.783; categorical net reclassification improvement, -0.0032; 95% CI, -0.0178 to 0.0113). In the validation cohorts, discrimination was acceptable (AGES C-statistic, 0.664; 95% CI, 0.632 to 0.697 and RS C-statistic, 0.705; 95% CI, 0.664 to 0.747) and calibration was adequate.</p>
                                <p>Conclusion: A risk model including variables readily available in primary care settings adequately predicted AF in diverse populations from the United States and Europe</p>
                                <p>PMID: 23537808 PMCID: PMC3647274 DOI: 10.1161/JAHA.112.000102</p>
                            </div>

                            <div class="reference HARMS2-AF">
                                <p><b>New-onset atrial fibrillation prediction: the HARMS2-AF risk score</b></p>
                                <p>Louise Segan, Rodrigo Canovas, Shane Nanayakkara , David Chieng , Sandeep Prabhu , Aleksandr Voskoboinik , Hariharan Sugumar , Liang-Han Ling , Geoff Lee , Joseph Morton , Andre LaGerche , David M Kaye , Prashanthan Sanders , Jonathan M Kalman , Peter M Kistler</p>
                                <p>Abstract <br>
                                    Aims: Lifestyle risk factors are a modifiable target in atrial fibrillation (AF) management. The relative contribution of individual lifestyle risk factors to AF development has not been described. Development and validation of an AF lifestyle risk score to identify individuals at risk of AF in the general population are the aims of the study.
                                </p>
                                <p>Methods and results: The UK Biobank (UKB) and Framingham Heart Study (FHS) are large prospective cohorts with outcomes measured >10 years. Incident AF was based on International Classification of Diseases version 10 coding. Prior AF was excluded. Cox proportional hazards regression identified independent AF predictors, which were evaluated in a multivariable model. A weighted score was developed in the UKB and externally validated in the FHS. Kaplan-Meier estimates ascertained the risk of AF development. Among 314 280 UKB participants, AF incidence was 5.7%, with median time to AF 7.6 years (interquartile range 4.5-10.2). Hypertension, age, body mass index, male sex, sleep apnoea, smoking, and alcohol were predictive variables (all P < 0.001); physical inactivity [hazard ratio (HR) 1.01, 95% confidence interval (CI) 0.96-1.05, P = 0.80] and diabetes (HR 1.03, 95% CI 0.97-1.09, P = 0·38) were not significant. The HARMS2-AF score had similar predictive performance [area under the curve (AUC) 0.782] to the unweighted model (AUC 0.802) in the UKB. External validation in the FHS (AF incidence 6.0% of 7171 participants) demonstrated an AUC of 0.757 (95% CI 0.735-0.779). A higher HARMS2-AF score (≥5 points) was associated with a heightened AF risk (score 5-9: HR 12.79; score 10-14: HR 38.70). The HARMS2-AF risk model outperformed the Framingham-AF (AUC 0.568) and ARIC (AUC 0.713) risk models (both P < 0.001) and was comparable to the CHARGE-AF risk score (AUC 0.754, P = 0.73).</p>
                                <p>Conclusion: The HARMS2-AF score is a novel lifestyle risk score which may help identify individuals at risk of AF in the general community and assist population screening.</p>
                                <p><b>PMID: 37350480 DOI: 10.1093/eurheartj/ehad375</b></p>
                            </div>

                            <div class="reference Hamada">
                                <p><b>Simple risk model and score for predicting of incident atrial fibrillation in Japanese</b></p>
                                <p>Richiro Hamada, Shigeki Muto </p>
                                <p>Abstract <br>
                                    Background
                                    Investigating regarding a predicted risk score of incident atrial fibrillation (AF) for an Asian general population has not been enough. Whether addition of electrocardiogram (ECG) variables to risk factors improves prediction of incident AF is unclear in a context that ECGs are extensively used at medical check-ups and outpatient clinics in Japan.
                                </p>
                                <p>Methods <br>
                                    Participants undergoing periodic health check-ups during 2008–2014 followed-up by December 2015 including 96,841 (65.1% male) aged 40–79 years were pooled to derive prediction models and risk scores for incident AF. Multivariable Cox regression identified clinical risk factors associated with incident AF in 7 years among 65,984 eligible participants including 349 AF cases.
                                </p>
                                <p>Results <br>
                                    A 7-year prediction model ("Simple-model") including the variables of age, waist circumference, diastolic blood pressure, alcohol consumption, heart rate, and cardiac murmur, had good discrimination (C-statistic, 0.77), requiring no blood sampling. Addition model of the ECGs variables (“Added-model”) including left ventricular hypertrophy, atrial enlargement, atrial premature contraction, and ventricular premature contraction, improved significantly the overall model discrimination (C-statistic, 0.78; categorical net reclassification improvement, 0.063; 95%CI, 0.031–0.099). The risk scores derived from the two models respectively showed an approximation of the observed and predicted probability for each score. Participants with score ≤4 or ≥9 points had, respectively, ≤1% and ≥5% predicted probability of incident AF in 7 years. The receiver-operating characteristics curve for the risk score of the added-model was significantly higher than the simple-model (0.769 vs 0.753, p < 0.001). Atrial enlargement on ECG and the highest age group were the highest risk points of the significant predictors.
                                </p>
                                <p>Conclusions <br>
                                    We developed 7-year risk scores for incident AF using usually available clinical factors including ECGs in primary care. These risk scores could identify individuals with high risk of incident AF at health check-up and outpatient clinics.
                                </p>
                                <p><b>DOI 10.1016/j.jjcc.2018.06.005</b></p>
                            </div>

                            <div class="reference MayoScore">
                                <p><b>Clinical Predictors of Risk for Atrial Fibrillation: Implications for Diagnosis and Monitoring</b></p>
                                <p>Kyle J. Brunner, MBA; T. Jared Bunch, MD; Christopher M. Mullin, MS; Heidi T. May, PhD; Tami L. Bair, BS; David W. Elliot, MBA; Jeffrey L. Anderson, MD; and Srijoy Mahapatra, MD</p>
                                <p>Abstract <br>
                                    Objective: To create a risk score using clinical factors to determine whom to screen and monitor for atrial fibrillation (AF). <br>
                                    Patients and Methods: The AF risk score was developed based on the summed odds ratios (ORs) for AF development of 7 accepted clinical risk factors. The AF risk score is intended to assess the risk of AF similar to
                                    how the CHA2DS2-VASc score assesses stroke risk. Seven validated risk factors for AF were used to develop the AF risk score: age, coronary artery disease, diabetes mellitus, sex, heart failure, hypertension, and valvular
                                    disease. The AF risk score was tested within a random population sample of the Intermountain Healthcare outpatient database. Outcomes were stratified by AF risk score for OR and Kaplan-Meier analysis.<br>
                                    Results: A total of 100,000 patient records with an index follow-up from January 1, 2002, through December 31, 2007, were selected and followed up for the development of AF through the time of this analysis, May 13, 2013, through September 6, 2013. Mean SD follow-up time was 3106 - 819 days. The ORs of subsequent AF diagnosis of patients with AF risk scores of 1, 2, 3, 4, and 5 or higher were 3.05, 12.9, 22.8, 34.0, and 48.0, respectively. The area under the curve statistic for the AF risk score was 0.812 (95% CI, 0.805-0.820). <br>
                                    Conclusion: We developed a simple AF risk score made up of common clinical factors that may be useful to possibly select patients for long-term monitoring for AF detection.
                                </p>
                                <p><b>DOI 10.1016/j.mayocp.2014.08.016</b></p>
                            </div>

                            <div class="reference HATCH">
                                <p><b>Usefulness of HATCH score in the prediction of new-onset atrial fibrillation for Asians</b></p>
                                <p>Kazuyoshi Suenari, MD, Tze-Fan Chao, MD, Chia-Jen Liu, MD, Yasuki Kihara, MD,Tzeng-Ji Chen, MD, Shih-Ann Chen, MD</p>
                                <p>Abstract <br>
                                    The HATCH score (hypertension <1 point>, age >75 years <1 point>, stroke or transient ischemic attack <2 points>, chronic obstructive pulmonary disease <1 point>, and heart failure <2 points>) was reported to be useful for predicting the progression of atrial fibrillation (AF) from paroxysmal to persistent or permanent AF for patients who participated in the Euro Heart Survey. The goal of the current study was to investigate whether the HATCH score was a useful scheme in predicting new-onset AF. Furthermore, we aimed to use the HATCH scoring system to estimate the individual risk in developing AF for patients with different comorbidities. We used the “Taiwan National Health Insurance Research Database.” From January 1, 2000, to December 31, 2001, a total of 670,804 patients older than 20 years old and who had no history of cardiac arrhythmias were enrolled. According to the calculation rule of the HATCH score, 599,780 (score 0), 46,661 (score 1), 12,892 (score 2), 7456 (score 3), 2944 (score 4), 802 (score 5), 202 (score 6), and 67 (score 7) patients were studied and followed for the new onset of AF. During a follow-up of 9.0 ± 2.2 years, there were 9174 (1.4%) patients experiencing new-onset AF. The incidence of AF was 1.5 per 1000 patient-years. The incidence increased from 0.8 per 1000pat ient-years for patients with a HATCH score of 0 to 57.3 per 1000 patient-years for those with a HATCH score of 7. After an adjustment for the gender and comorbidities, the hazard ratio (95% confidence interval) of each increment of the HATCH score in predicting AF was 2.059 (2.027–2.093; P<0.001). The HATCH score was useful in risk estimation and stratification of new-onset AF. <br>
                                    Abbreviations: AF = atrial fibrillation, ARIC = atherosclerosis risk in communities, COPD = chronic obstructive pulmonary disease, FEV1 = forced expiratory volume in 1 second, NHIRD = National Health Insurance Research Database, TIA = transient ischemic attack.
                                </p>
                                <p><b>DOI 10.1097/MD.0000000000005597</b></p>
                            </div>

                            <div class="reference FraminghamAFriskscore">
                                <p><b>Development of a Risk Score for Atrial Fibrillation in the Community; The Framingham Heart Study</b></p>
                                <p>Renate B. Schnabel, MD, Lisa M. Sullivan, PhD, Daniel Levy, MD, Michael J. Pencina, PhD, Joseph M. Massaro, PhD, Ralph B. D’Agostino Sr, PhD, Christopher Newton-Cheh, MD, MPH, Jennifer F. Yamamoto, BS, Jared W. Magnani, MD, Thomas M. Tadros, MD, MPH, William B. Kannel, MD, Thomas J. Wang, MD, Patrick T. Ellinor, MD, PhD, Philip A Wolf, MD, Ramachandran S. Vasan, MD, and Emelia J. Benjamin, MD, ScM</p>
                                <p>Abstract <br>
                                    Background—Atrial fibrillation (AF) contributes to substantial increases in morbidity and mortality. Our aim was to develop a risk prediction model to assess individuals’ absolute risk for incident AF; to offer clinicians a tool to communicate risk; and to provide researchers a framework to evaluate new risk markers. <br>
                                    Methods—We examined 4764 Framingham Heart Study individuals (8044 person-exams; mean age 60.9 years, 55% women) aged 45–95 years. Multivariable Cox regression related clinical variables to 10-year AF incidence (n=457). Secondary analyses incorporated routine echocardiographic data (person-exams=7156, 445 events) for reclassifying individuals’ AF risk.<br>
                                    Findings—Age, sex, significant murmur, heart failure, systolic blood pressure, hypertension treatment, body mass index, and electrocardiographic PR interval were associated with incident AF (p<0.05; clinical model C statistic=0.78, 95% confidence interval [CI] 0.76–0.80). Ten-year AF risk varied with age; >15% 10-year AF risk was observed in 1.0% of individuals <65 years versus 26.9% of participants ≥65 years. Predicted 10-year risk deciles for developing AF were similar to observed risks (calibration Chi-square statistic, 4.16, p=0.90). Additional incorporation of echocardiographic features minimally improved the C statistic from 0.78 (0.75, 0.80) to 0.79 (95% CI 0.77–0.82), p=0.005. Echocardiographic variables did not significantly improve net reclassification (p=0.18). We provide a point score for estimating AF risk with variables easily-measured in primary care. Interpretation—The Framingham AF risk score may help risk stratify individuals in the community, and may provide a framework to evaluate new biological or genetic markers for AF risk prediction and help target individuals destined to develop AF for preventive measures.
                                </p>
                                <p><b>DOI:10.1016/S0140-6736(09)60443-8</b></p>
                            </div>                         

                            <div class="reference MHSScore">
                                <p><b>Risk Score for Prediction of 10-Year Atrial Fibrillation: A Community-Based Study</b></p>
                                <p>Doron Aronson, Varda Shalev, Rachel Katz, Gabriel Chodick, Diab Mutlak</p>
                                <p>Purpose We used a large real-world data from community settings to develop and validate a 10-year risk score for new-onset atrial fibrillation (AF) and calculate its net benefit performance. <br>
                                    Methods Multivariable Cox proportional hazards model was used to estimate effects of risk factors in the derivation cohort (n = 96,778) and to derive a risk equation. <br>
                                    Measures of calibration and discrimination were calculated in the validation cohort (n = 48,404).  <br>
                                    Results Cumulative AF incidence rates for both the derivation and validation cohorts were 5.8% at 10 years. The final models included the following variables: age, sex, body mass index, history of treated hypertension, systolic blood pressure > 160 mm Hg,
                                    chronic lung disease, history of myocardial infarction, history of peripheral arterial disease, heart failure and history of an inflammatory disease. There was a 27-fold difference (1.0% vs. 27.2%) in AF risk between the lowest (–1) and the highest (9) sum score. The c-statistic was 0.743 (95% confidence interval [CI], 0.737–0.749) for the derivation cohort and 0.749 (95% CI, 0.741–0.759) in the validation cohort. The risk
                                    equation was well calibrated, with predicted risks closely matching observed risks. Decision curve analysis displayed consistent positive net benefit of using the AF risk score for decision thresholds between 1 and 25% 10-year AF risk. <br>
                                    Conclusion We provide a simple score for the prediction of 10-year risk for AF. The score can be used to select patients at highest risk for treatments of modifiable risk factors, monitoring for sub-clinical AF detection or for clinical trials of primary prevention of AF.
                                </p>
                                <p><b>DOI: 10.1055/s-0038-1668522</b></p>
                            </div>

                            <div class="reference ARICScore">
                                <p><b>A clinical risk score for atrial fibrillation in a biracial prospective cohort (from the Atherosclerosis Risk in Communities [ARIC] study)</b></p>
                                <p>Alanna M Chamberlain , Sunil K Agarwal, Aaron R Folsom, Elsayed Z Soliman, Lloyd E Chambless, Richard Crow, Marietta Ambrose, Alvaro Alonso</p>
                                <p>Abstract <br>
                                    A risk score for atrial fibrillation (AF) has been developed by the Framingham Heart Study; however, the applicability of this risk score, derived using data from white patients, to predict new-onset AF in nonwhites is uncertain. Therefore, we developed a 10-year risk score for new-onset AF from risk factors commonly measured in clinical practice using 14,546 subjects from the Atherosclerosis Risk In Communities (ARIC) study, a prospective community-based cohort of blacks and whites in the United States. During 10 years of follow-up, 515 incident AF events occurred. The following variables were included in the AF risk score: age, race, height, smoking status, systolic blood pressure, hypertension medication use, precordial murmur, left ventricular hypertrophy, left atrial enlargement, diabetes, coronary heart disease, and heart failure. The area under the receiver operating characteristics curve (AUC) of a Cox regression model that included the previous variables was 0.78, suggesting moderately good discrimination. The point-based score developed from the coefficients in the Cox model had an AUC of 0.76. This clinical risk score for AF in the Atherosclerosis Risk In Communities cohort compared favorably with the Framingham Heart Study's AF (AUC 0.68), coronary heart disease (CHD) (AUC 0.63), and hard CHD (AUC 0.59) risk scores and the Atherosclerosis Risk In Communities CHD risk score (AUC 0.58). In conclusion, we have developed a risk score for AF and have shown that the different pathophysiologies of AF and CHD limit the usefulness of a CHD risk score in identifying subjects at greater risk of AF.
                                </p>
                                <p><b>DOI: 10.1016/j.amjcard.2010.08.049</b></p>
                            </div>                          

                            <div class="reference Suita">
                                <p><b>Development of a Basic Risk Score for Incident Atrial Fibrillation in a Japanese General Population　― The Suita Study</b></p>
                                <p>Yoshihiro Kokubo, Makoto Watanabe, Aya Higashiyama, Yoko M Nakao, Kengo Kusano, Yoshihiro Miyamoto</p>
                                <p>Background:An atrial fibrillation (AF) risk score for a non-Western general population has not been established.</p>
                                <p>Methods and Results:A total of 6,898 participants (30–79 years old) initially free of AF have been prospectively followed for incident AF since 1989. AF was diagnosed when AF or atrial flutter was present on ECG at a biannual health examination; was indicated as a current illness; or was in the medical records during follow-up. Cox proportional hazard ratios were analyzed after adjusting for cardiovascular risk factors at baseline. During the 95,180 person-years of follow-up, 311 incident AF events occurred. We developed a scoring system for each risk factor as follows: 0/−5, 3/0, 7/5, and 9/9 points for men/women in their 30 s–40 s, 50 s, 60 s, and 70 s, respectively; 2 points for systolic hypertension, overweight, excessive drinking, or coronary artery disease; 1 point for current smoking; −1 point for moderate non-high-density lipoprotein-cholesterol; 4 points for arrhythmia; and 8, 6, and 2 points for subjects with cardiac murmur in their 30 s–40 s, 50 s, and 60 s, respectively (C-statistic 0.749; 95% confidence interval, 0.724−0.774). Individuals with score ≤2, 10–11, or ≥16 points had, respectively, ≤1%, 9%, and 27% observed probability of developing AF in 10 years.</p>
                                <p>Conclusions:We developed a 10-year risk score for incident AF using traditional risk factors that are easily obtained in routine outpatient clinics/health examinations without ECG.</p>
                                <p><b>DOI: 10.1253/circj.CJ-17-0277</b></p>
                            </div>

                            <div class="reference TaiwanAFScore">
                                <p><b>Clinical Risk Score for the Prediction of Incident Atrial Fibrillation: Derivation in 7 220 654 Taiwan Patients With 438 930 Incident Atrial Fibrillations During a 16-Year Follow-Up</b></p>
                                <p>Tze-Fan Chao, Chern-En Chiang, Tzeng-Ji Chen , Jo-Nan Liao, Ta-Chuan Tuan, Shih-Ann Chen</p>
                                <p>Background Although several risk schemes have been proposed to predict new-onset atrial fibrillation (AF), clinical prediction models specific for Asian patients were limited. In the present study, we aimed to develop a clinical risk score (Taiwan AF score) for AF prediction using the whole Taiwan population database with a long-term follow-up. Methods and Results Among 7 220 654 individuals aged ≥40 years without a past history of cardiac arrhythmia identified from the Taiwan Health Insurance Research Database, 438 930 incident AFs occurred after a 16-year follow-up. Clinical risk factors of AF were identified using Cox regression analysis and then combined into a clinical risk score (Taiwan AF score). The Taiwan AF score included age, male sex, and important comorbidities (hypertension, heart failure, coronary artery disease, end-stage renal disease, and alcoholism) and ranged from -2 to 15. The area under the receiver operating characteristic curve of the Taiwan AF scores in the predictions of AF are 0.857 for the 1-year follow-up, 0.825 for the 5-year follow-up, 0.797 for the 10-year follow-up, and 0.756 for the 16-year follow-up. The annual risks of incident AF were 0.21%/year, 1.31%/year, and 3.37%/year for the low-risk (score -2 to 3), intermediate-risk (score 4 to 9), and high-risk (score ≥10) groups, respectively. Compared with low-risk patients, the hazard ratios of incident AF were 5.78 (95% CI, 3.76-7.75) for the intermediate-risk group and 8.94 (95% CI, 6.47-10.80) for the high-risk group. Conclusions We developed a clinical AF prediction model, the Taiwan AF score, among a large-scale Asian cohort. The new score could help physicians to identify Asian patients at high risk of AF in whom more aggressive and frequent detections and screenings may be considered.</p>
                                <p><b>DOI: 10.1161/JAHA.120.020194</b></p>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>

        </div>	

	</div>
</body>
<footer>
	<?php $this->load->view('footer'); ?>
</footer>

<script>
    $(document).ready(function(){
        $('.btn-calculate').click(function(){
            window.location.href = "<?php echo base_url('home'); ?>";
        });

       
    });

    $('.show-reference').click(function(){
        $('.reference').css('display', 'none');

        var id = $(this).attr('id');
        $('.'+id).css('display', 'block');
        $('#referenceModal').modal('show');

    });

    tippy('#STAF', {
        content: 'A total score of ≥5 enabled the identification of patients with AF in 3 months with a sensitivity of 89% (95% CI, 83 to 94) and a specificity of 88% (95% CI, 84 to 91)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#ASAS', {
        content: 'The AUC for the predicted probabilities of the ASAS was 0.78 [95%CI 0.70-0.86], excluding patients with a previous diagnosis of atrial fibrillation.',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#CHA2DS2-VASC', {
        content: 'Predicting a new-onset atrial fibrillation in 2-years follow-up (AUC 0.744 (95% CI, 0.741-0.747)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#HAVOC', {
        content: 'Chance (%) of Afib in 3 years (AUC 0.77)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#CHARGE-AF', {
        content: 'Chance (%) of Afib in 5 year',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#HARMS2-AF', {
        content: 'Hazard ratio (HR) for Afib detection in up to 10 years. Performance with a 5-year AUC 0.757 (95% CI 0.735–0.779) and 10-year AUC 0.753 (95% CI 0.732–0.775)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#Hamada', {
        content: 'A 7-year risk of atrial fibrillation (AUC 0.78)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#MayoScore', {
        content: 'Predicting incidente AFib in about 8-years follow-up (AUC 0.812 (95% CI, 0.805-0.820))',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#HATCH', {
        content: 'Chance of AFib detection in about 10 years (AUC 0.716 (95% CI 0.710–0.723). Results from an external validation in a Taiwanese cohort.',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#MHSScore', {
        content: 'A 10-years predicted risk of AFib (AUC 0.749 (0.740–0.758)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#ARICScore', {
        content: 'Chance (%) of Afib in 10 years (The point-based score developed from coefficients in the Cox model had an AUC of 0.76.)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#Suita', {
        content: 'Predicted 10-Year Risk of Incident AF (AUC 0.749; 95% CI 0.724−0.774)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#TaiwanAFScore', {
        content: 'Cumulative Incidence of AFib in a 1 to 16-years follow-up. AUC ranged from 0.857 (0.855–0.860) to 0.756 (0.755–0.757) in follow-up of 1 or 16 years, respectively',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

</script>
</html>