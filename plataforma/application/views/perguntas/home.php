<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
</head>
<body id="background2">
    <div class="row title">
        <div class="col-md-12">
            <span>Questions</span>
        </div>
        <div class="retangular-shape"></div>
    </div>

    <div class="container">  

        <div class="row" id="formquests">
            <div class="col-md-12">

            <?= form_open("home/todasRespostas", 'id="formprincipal"'); ?>

                <details>
                    <summary data-translate="demographic">Demographic</summary>

                        <!-- <p data-translate="age" class="mt-3">Age 
                            <input name="1_age" maxlength="3" onkeypress="return onlyNumberKey(event);">
                        </p>  -->


                        <p data-translate="age" class="age-input mt-3">Age
                            <input type="text" autocomplete="off" name="1_age" maxlength="3" onkeypress="return onlyNumberKey(event);">
                        </p>

                        <!-- <p data-translate="gender">Gender
                            <label for="male"></label>
                            <input type="radio" name="2_gender" id="male" value="male" data-translate="male"> Male
                            <label for="female"></label>
                            <input type="radio" name="2_gender" id="female" value="female" data-translate="female"> Female
                        </p> -->

                        <p data-translate="gender">Gender
                            <label class="custom-radio">
                                <input type="radio" name="2_gender" id="male" value="male" data-translate="male">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                Male
                            </label>
                            <label class="custom-radio">
                                <input type="radio" name="2_gender" id="female" value="female" data-translate="female">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                Female
                            </label>
                        </p>

                        <!-- <p data-translate="white">White
                            <input type="radio" name="27_white" value="yes" data-translate="yes"> Yes
                            <input type="radio" name="27_white" value="no" data-translate="no"> No
                        </p> -->

                        <p data-translate="white">White
                            <label class="custom-radio">
                                <input type="radio" name="27_white" id="white_yes" value="yes" data-translate="yes">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                Yes
                            </label>
                            <label class="custom-radio">
                                <input type="radio" name="27_white" id="white_no" value="no" data-translate="no">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                No
                            </label>
                        </p>

                        <!-- <p data-translate="black">Black
                            <input type="radio" name="28_black" value="yes" data-translate="yes"> Yes
                            <input type="radio" name="28_black" value="no" data-translate="no"> No
                        </p> -->

                        <p data-translate="black">Black
                            <label class="custom-radio">
                                <input type="radio" name="28_black" id="black_yes" value="yes" data-translate="yes">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                Yes
                            </label>
                            <label class="custom-radio">
                                <input type="radio" name="28_black" id="black_no" value="no" data-translate="no">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                No
                            </label>
                        </p>
                </details>

                <hr class="hr-personalizado">

                <details>
                    <summary data-translate="neurological">Neurological</summary>

                    <p data-translate="nihss" class="mt-3">NIH Stroke Scale on admission
                        <input type="text" autocomplete="off" name="3_nihss" onkeypress="return onlyNumberKey(event);">
                    </p>

                    <!-- <p data-translate="stroke_history">Previous Stroke or Transient Ischemic Attack
                        <input type="radio" name="30_stroke" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="30_stroke" value="no" data-translate="no"> No
                    </p> -->

                    <p data-translate="stroke_history">Previous Stroke or Transient Ischemic Attack
                        <label class="custom-radio">
                            <input type="radio" name="30_stroke" id="stroke_yes" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" name="30_stroke" id="stroke_no" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                </details>

                <hr class="hr-personalizado">

                <details>

                    <summary data-translate="body_metrics">Body metrics and laboratory</summary>

                    <p data-translate="height" class="mt-3">Height (cm)
                        <input type="text" autocomplete="off" name="12_height_cm" onkeypress="return onlyNumberKey(event);">
                    </p>
                    
                    <p data-translate="weight">Weight (kg)
                        <input type="text" autocomplete="off" name="13_weight_kg" onkeypress="return onlyNumberKey(event);">
                    </p>
                    
                    <p data-translate="systolic_bp">Systolic Blood Pressure (mmHg)
                        <input type="text" autocomplete="off" name="15_systolic_bp" onkeypress="return onlyNumberKey(event);">
                    </p>
                    
                    <p data-translate="diastolic_bp">Diastolic Blood Pressure (mmHg)
                        <input type="text" autocomplete="off" name="16_diastolic_bp" onkeypress="return onlyNumberKey(event);">
                    </p>
                    
                    <!-- <p data-translate="raised_bmi">Raised BMI (BMI>30kg/m²)
                        <input type="radio" id="raised_bmi_yes" name="20_raised_bmi" value="yes" data-translate="yes"> Yes
                        <input type="radio" id="raised_bmi_no" name="20_raised_bmi" value="no" data-translate="no"> No
                    </p>-->

                    <p data-translate="raised_bmi">Raised BMI (BMI>30kg/m²)
                        <label class="custom-radio">
                            <input type="radio" id="raised_bmi_yes" name="20_raised_bmi" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="raised_bmi_no" name="20_raised_bmi" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                    <div id="bmi_25_container" style="display:none;">

                        <!-- <p data-translate="bmi_25">BMI ≥25 kg/m²
                            <input type="radio" id="bmi_25_yes" name="20_1_bmi_25" value="yes" data-translate="yes"> Yes
                            <input type="radio" id="bmi_25_no" name="20_1_bmi_25" value="no" data-translate="no"> No
                        </p> -->

                        <p data-translate="bmi_25">BMI ≥25 kg/m²
                            <label class="custom-radio">
                                <input type="radio" id="bmi_25_yes" name="20_1_bmi_25" value="yes" data-translate="yes">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                Yes
                            </label>
                            <label class="custom-radio">
                                <input type="radio" id="bmi_25_no" name="20_1_bmi_25" value="no" data-translate="no">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                No
                            </label>
                        </p>
                        
                        <div id="additional_bmi_content" style="display:none;">
                            <p data-translate="bmi_value">BMI (kg/m²)
                                <input type="text" autocomplete="off" name="20_2_bmi_value" step="0.01" onkeypress="return onlyNumberKey(event);">
                            </p>                    
                        </div>

                    </div>
                    
                    <p data-translate="waist_circumference">Waist circumference (cm)
                        <input type="text" autocomplete="off" name="34_waist_circumference" onkeypress="return onlyNumberKey(event);">
                    </p>

                    <p data-translate="heart_rate">Heart rate (beats per minute)
                        <input type="text" autocomplete="off" name="35_heart_rate" onkeypress="return onlyNumberKey(event);">
                    </p>

                    <p data-translate="cholesterol_ldl">Cholesterol LDL-C (mg/dL)
                        <input type="text" autocomplete="off" name="33_cholesterol_ldl" onkeypress="return onlyNumberKey(event);">
                    </p>

                </details>

                <hr class="hr-personalizado">

                <details>

                    <summary data-translate="personal_history">Personal history</summary>

                    <!-- <p data-translate="history_coronary_disease" class="mt-3">History of Coronary Disease
                        <input type="radio" name="6_coronary_disease" value="yes"> Yes
                        <input type="radio" name="6_coronary_disease" value="no"> No
                    </p> -->
                    
                    <p data-translate="history_coronary_disease" class="mt-3">History of Coronary Disease
                        <label class="custom-radio">
                            <input type="radio" id="coronary_disease_yes" name="6_coronary_disease" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="coronary_disease_no" name="6_coronary_disease" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>


                    <!-- <p data-translate="history_copd">History of chronic obstructive pulmonary disease (COPD)
                        <input type="radio" name="7_copd" value="yes"> Yes
                        <input type="radio" name="7_copd" value="no"> No
                    </p> -->

                    <p data-translate="history_copd">History of chronic obstructive pulmonary disease (COPD)
                        <label class="custom-radio">
                            <input type="radio" id="copd_yes" name="7_copd" value="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="copd_no" name="7_copd" value="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>


                    <!-- <p data-translate="history_hypertension">History of Arterial Hypertension
                        <input type="radio" name="8_hypertension" value="yes"> Yes
                        <input type="radio" name="8_hypertension" value="no"> No
                    </p> -->

                    <p data-translate="history_hypertension">History of Arterial Hypertension
                        <label class="custom-radio">
                            <input type="radio" id="hypertension_yes" name="8_hypertension" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="hypertension_no" name="8_hypertension" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                    <!-- <p data-translate="history_heart_failure">History of Heart Failure
                        <input type="radio" name="9_heart_failure" value="yes"> Yes
                        <input type="radio" name="9_heart_failure" value="no"> No
                    </p> -->

                    <p data-translate="history_heart_failure">History of Heart Failure
                        <label class="custom-radio">
                            <input type="radio" id="heart_failure_yes" name="9_heart_failure" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="heart_failure_no" name="9_heart_failure" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>


                    <!-- <p data-translate="history_hyperthyroidism">Known Hyperthyroidism
                        <input type="radio" name="10_hyperthyroidism" value="yes"> Yes
                        <input type="radio" name="10_hyperthyroidism" value="no"> No
                    </p> -->

                    <p data-translate="history_hyperthyroidism">Known Hyperthyroidism
                        <label class="custom-radio">
                            <input type="radio" id="hyperthyroidism_yes" name="10_hyperthyroidism" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="hyperthyroidism_no" name="10_hyperthyroidism" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>


                    <!-- <p data-translate="smoking_status">Smoking
                        <input type="radio" id="smoking_yes" name="14_smoking" value="yes"> Yes
                        <input type="radio" id="smoking_no" name="14_smoking" value="no"> No
                    </p> -->

                    <p data-translate="smoking_status">Smoking
                        <label class="custom-radio">
                            <input type="radio" id="smoking_yes" name="14_smoking" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="smoking_no" name="14_smoking" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                    <div id="former_smoker_container" style="display:none;">
                        <!-- <p data-translate="former_smoker">Former smoker
                            <input type="radio" name="14_1_former_smoker" value="yes"> Yes
                            <input type="radio" name="14_1_former_smoker" value="no"> No
                        </p> -->

                        <p data-translate="former_smoker">Former smoker
                            <label class="custom-radio">
                                <input type="radio" id="former_smoker_yes" name="14_1_former_smoker" value="yes" data-translate="yes">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                Yes
                            </label>
                            <label class="custom-radio">
                                <input type="radio" id="former_smoker_no" name="14_1_former_smoker" value="no" data-translate="no">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                No
                            </label>
                        </p>

                    </div>

                    <!-- <p data-translate="history_diabetes">History of Diabetes
                        <input type="radio" name="17_diabetes" value="yes"> Yes
                        <input type="radio" name="17_diabetes" value="no"> No
                    </p> -->

                    <p data-translate="history_diabetes">History of Diabetes
                        <label class="custom-radio">
                            <input type="radio" id="diabetes_yes" name="17_diabetes" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="diabetes_no" name="17_diabetes" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                    <!-- <p data-translate="sleep_apnea">Sleep apnea
                        <input type="radio" name="21_sleep_apnea" value="yes"> Yes
                        <input type="radio" name="21_sleep_apnea" value="no"> No
                    </p> -->
                    
                    <p data-translate="sleep_apnea">Sleep apnea
                        <label class="custom-radio">
                            <input type="radio" id="sleep_apnea_yes" name="21_sleep_apnea" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="sleep_apnea_no" name="21_sleep_apnea" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                    <!-- <p data-translate="alcohol_consumption">Alcohol consumption
                        <input type="radio" name="22_alcohol_consumption" value="0"> 0
                        <input type="radio" name="22_alcohol_consumption" value="0_7"> 0-7 std. drinks per week
                        <input type="radio" name="22_alcohol_consumption" value="7_14"> 7-14 std. drinks per week
                        <input type="radio" name="22_alcohol_consumption" value="15_plus"> 15+ std. drinks per week
                        <input type="radio" name="22_alcohol_consumption" value="none"> no consumption
                    </p> -->
                    
                    <p data-translate="alcohol_consumption">Alcohol consumption
                        <br>
                        <label class="custom-radio">
                            <input type="radio" id="alcohol_0" name="22_alcohol_consumption" value="0" data-translate="0">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            0
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="alcohol_0_7" name="22_alcohol_consumption" value="0_7" data-translate="0_7">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            0-7 std. drinks per week
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="alcohol_7_14" name="22_alcohol_consumption" value="7_14" data-translate="7_14">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            7-14 std. drinks per week
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="alcohol_15_plus" name="22_alcohol_consumption" value="15_plus" data-translate="15_plus">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            15+ std. drinks per week
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="alcohol_none" name="22_alcohol_consumption" value="none" data-translate="none">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            no consumption
                        </label>
                    </p>

                    <!-- <p data-translate="peripheral_vascular_disease">Peripheral Vascular Disease
                        <input type="radio" name="26_vascular_disease" value="yes"> Yes
                        <input type="radio" name="26_vascular_disease" value="no"> No
                    </p> -->

                    <p data-translate="peripheral_vascular_disease">Peripheral Vascular Disease
                        <label class="custom-radio">
                            <input type="radio" id="vascular_disease_yes" name="26_vascular_disease" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="vascular_disease_no" name="26_vascular_disease" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                    <!-- <p data-translate="end_stage_renal_disease">End-stage renal disease
                        <input type="radio" name="31_renal_disease" value="yes"> Yes
                        <input type="radio" name="31_renal_disease" value="no"> No
                    </p> -->

                    <p data-translate="end_stage_renal_disease">End-stage renal disease
                        <label class="custom-radio">
                            <input type="radio" id="renal_disease_yes" name="31_renal_disease" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="renal_disease_no" name="31_renal_disease" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                </details>

                <hr class="hr-personalizado">

                <details>

                    <summary data-translate="echography">Echography</summary>

                    <p data-translate="left_atrium_size" class="mt-3">Left Atrium Size 
                        <input type="text" autocomplete="off" name="4_left_atrium_size" onkeypress="return onlyNumberKey(event);"> mm
                    </p>

                    <p data-translate="presence_septal_aneurysm">Presence of septal aneurysm
                        <label class="custom-radio">
                            <input type="radio" id="septal_aneurysm_yes" name="5_septal_aneurysm" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="septal_aneurysm_no" name="5_septal_aneurysm" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                    
                    <!-- <p data-translate="presence_septal_aneurysm">Presence of septal aneurysm
                        <input type="radio" name="5_septal_aneurysm" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="5_septal_aneurysm" value="no" data-translate="no"> No
                    </p> -->

                    <!-- <p data-translate="valve_disease" class="custom-tooltip">Valve Disease
                        <input type="radio" name="25_valve_disease" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="25_valve_disease" value="no" data-translate="no"> No
                        <span class="tooltip-content">
                            <span style="font-size: 12px;">Aortic, mitral, tricuspid, and/or pulmonary valve disease</span>
                        </span>
                    </p> -->

                    <p data-translate="valve_disease" class="custom-tooltip">Valve Disease
                        <label class="custom-radio">
                            <input type="radio" id="valve_disease_yes" name="25_valve_disease" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="valve_disease_no" name="25_valve_disease" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                        <span class="tooltip-content">
                            <span style="font-size: 12px;">Aortic, mitral, tricuspid, and/or pulmonary valve disease</span>
                        </span>
                    </p>

                </details>

                <hr class="hr-personalizado">

                <details>
                    <summary data-translate="electrocardiogram">Electrocardiogram</summary>

                    <!-- <p data-translate="ecg_lv_hypertrophy" class="mt-3">ECG Left Ventricular Hypertrophy
                        <input type="radio" name="18_ecg_lv_hypertrophy" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="18_ecg_lv_hypertrophy" value="no" data-translate="no"> No
                    </p> -->

                    <p data-translate="ecg_lv_hypertrophy" class="mt-3">ECG Left Ventricular Hypertrophy
                        <label class="custom-radio">
                            <input type="radio" id="ecg_lv_hypertrophy_yes" name="18_ecg_lv_hypertrophy" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="ecg_lv_hypertrophy_no" name="18_ecg_lv_hypertrophy" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                    <p data-translate="ecg_pr_interval">ECG PR Interval 
                        <input type="text" autocomplete="off" name="19_ecg_pr_interval"> ms
                    </p>

                    <!-- <p data-translate="left_atrial_enlargement" class="custom-tooltip">Presence of Left Atrial Enlargement
                        <input type="radio" name="29_left_atrial_enlargement" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="29_left_atrial_enlargement" value="no" data-translate="no"> No
                        <span class="tooltip-content">
                            <span style="font-size: 12px;">Left atrial enlargement (LAE) by ECG was defined as a p-wave duration of ≥ 120 ms or p wave amplitude >2.5 mm in II and/or terminal p negativity in V1 duration 0.04 s, depth 1 mm.
                            <br> When from the bidimensional parasternal (as adopted by the ASAS score) long-axis view, LAE may be defined as an anteroposterior diameter ≥4.0cm</span>
                        </span>
                    </p> -->

                    <p data-translate="left_atrial_enlargement" class="custom-tooltip">Presence of Left Atrial Enlargement
                        <label class="custom-radio">
                            <input type="radio" id="left_atrial_enlargement_yes" name="29_left_atrial_enlargement" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="left_atrial_enlargement_no" name="29_left_atrial_enlargement" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                        <span class="tooltip-content">
                            <span style="font-size: 12px;">Left atrial enlargement (LAE) by ECG was defined as a p-wave duration of ≥ 120 ms or p wave amplitude >2.5 mm in II and/or terminal p negativity in V1 duration 0.04 s, depth 1 mm.<br>When from the bidimensional parasternal (as adopted by the ASAS score) long-axis view, LAE may be defined as an anteroposterior diameter ≥4.0cm</span>
                        </span>
                    </p>


                    <br>

                    <!-- <p data-translate="atrial_premature_contraction" class="custom-tooltip">Atrial premature contraction/complex
                        <input type="radio" name="36_atrial_premature_contraction" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="36_atrial_premature_contraction" value="no" data-translate="no"> No
                        <span class="tooltip-content">
                            <span style="font-size: 12px;">An atrial premature contraction (PAC) is an extra heartbeat that starts in the upper chambers of the heart. On an ECG, PACs can appear as: 
                                <br> - A premature P wave, which is usually a different shape than the other P waves 
                                <br> - A narrow or normal QRS complex, which is identical to the other normal beats 
                                <br> - A long pause after the PAC as the heart tries to restore its normal rhythm 
                                <br> - A normal, short, or longer PR interval than sinus rhythm 
                                <br> - Post-extrasystolic pause                       
                            </span>
                        </span>
                    </p> -->

                    <p data-translate="atrial_premature_contraction" class="custom-tooltip">Atrial premature contraction/complex
                        <label class="custom-radio">
                            <input type="radio" id="atrial_premature_contraction_yes" name="36_atrial_premature_contraction" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="atrial_premature_contraction_no" name="36_atrial_premature_contraction" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                        <span class="tooltip-content">
                            <span style="font-size: 12px;">An atrial premature contraction (PAC) is an extra heartbeat that starts in the upper chambers of the heart. On an ECG, PACs can appear as: 
                                <br> - A premature P wave, which is usually a different shape than the other P waves 
                                <br> - A narrow or normal QRS complex, which is identical to the other normal beats 
                                <br> - A long pause after the PAC as the heart tries to restore its normal rhythm 
                                <br> - A normal, short, or longer PR interval than sinus rhythm 
                                <br> - Post-extrasystolic pause                       
                            </span>
                        </span>
                    </p>


                    <br>

                    <!-- <p data-translate="ventricular_premature_contraction" class="custom-tooltip">Ventricular premature contraction/complex
                        <input type="radio" name="37_ventricular_premature_contraction" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="37_ventricular_premature_contraction" value="no" data-translate="no"> No
                        <span class="tooltip-content">
                            <span style="font-size: 12px;">Premature Ventricular Contrations are characterized by:
                                <br> - Premature QRS complexes that are unusually long (typically >120 msec)
                                <br> - Wide QRS complexes on the ECG
                                <br> - Complexes that are not preceded by a P wave
                                <br> - A large T wave that is oriented in a direction opposite the major deflection of the QRS 
                            </span>                    
                        </span>
                    </p> -->

                    <p data-translate="ventricular_premature_contraction" class="custom-tooltip">Ventricular premature contraction/complex
                        <label class="custom-radio">
                            <input type="radio" id="ventricular_premature_contraction_yes" name="37_ventricular_premature_contraction" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="ventricular_premature_contraction_no" name="37_ventricular_premature_contraction" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                        <span class="tooltip-content">
                            <span style="font-size: 12px;">Premature Ventricular Contrations are characterized by:
                                <br> - Premature QRS complexes that are unusually long (typically >120 msec)
                                <br> - Wide QRS complexes on the ECG
                                <br> - Complexes that are not preceded by a P wave
                                <br> - A large T wave that is oriented in a direction opposite the major deflection of the QRS 
                            </span>                    
                        </span>
                    </p>

                    
                    <!-- <p data-translate="arrhythmia">Arrhythmia (other than Atrial Fibrillation)
                        <input type="radio" name="32_arrhythmia" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="32_arrhythmia" value="no" data-translate="no"> No
                    </p> -->

                    <p data-translate="arrhythmia">Arrhythmia (other than Atrial Fibrillation)
                        <label class="custom-radio">
                            <input type="radio" id="arrhythmia_yes" name="32_arrhythmia" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="arrhythmia_no" name="32_arrhythmia" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                </details>

                <hr class="hr-personalizado">

                <details>
                    <summary data-translate="cardiology_general">Cardiology and General</summary>

                    <!-- <p data-translate="presence_symptomatic_stenosis" class="mt-3">Presence of symptomatic extra- or intracranial stenosis ≥50%, symptomatic arterial dissection, clinico-radiological lacunar syndrome
                        <input type="radio" name="23_symptomatic_stenosis" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="23_symptomatic_stenosis" value="no" data-translate="no"> No
                    </p> -->

                    <p data-translate="presence_symptomatic_stenosis" class="mt-3">Presence of symptomatic extra- or intracranial stenosis ≥50%, symptomatic arterial dissection, clinico-radiological lacunar syndrome
                        <label class="custom-radio">
                            <input type="radio" id="symptomatic_stenosis_yes" name="23_symptomatic_stenosis" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="symptomatic_stenosis_no" name="23_symptomatic_stenosis" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>


                    <!-- <p data-translate="significant_murmur" class="custom-tooltip">Significant Murmur
                        <input type="radio" name="24_significant_murmur" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="24_significant_murmur" value="no" data-translate="no"> No
                        <span class="tooltip-content">
                            <span style="font-size: 12px;">A significant cardiac murmur was considered present if grade ≥3 out of 6 systolic or any diastolic murmur was auscultated by the physician</span>
                        </span>
                    </p> -->

                    <p data-translate="significant_murmur" class="custom-tooltip">Significant Murmur
                        <label class="custom-radio">
                            <input type="radio" id="significant_murmur_yes" name="24_significant_murmur" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="significant_murmur_no" name="24_significant_murmur" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                        <span class="tooltip-content">
                            <span style="font-size: 12px;">A significant cardiac murmur was considered present if grade ≥3 out of 6 systolic or any diastolic murmur was auscultated by the physician</span>
                        </span>
                    </p>


                    <div id="precordial_murmur_container" style="display:none;">
                        <!-- <p data-translate="presence_precordial_murmur">Presence of any precordial murmur
                            <input type="radio" name="24_1_precordial_murmur" value="yes" data-translate="yes"> Yes
                            <input type="radio" name="24_1_precordial_murmur" value="no" data-translate="no"> No
                        </p> -->

                        <p data-translate="presence_precordial_murmur">Presence of any precordial murmur
                            <label class="custom-radio">
                                <input type="radio" id="precordial_murmur_yes" name="24_1_precordial_murmur" value="yes" data-translate="yes">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                Yes
                            </label>
                            <label class="custom-radio">
                                <input type="radio" id="precordial_murmur_no" name="24_1_precordial_murmur" value="no" data-translate="no">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                No
                            </label>
                        </p>

                    </div>
                    
                    <div id="autoimmune_disease_container" style="display:none;">
                        <!-- <p data-translate="autoimmune_disease">Presence of autoimmune/Inflammatory disease
                            <input type="radio" name="38_autoimmune_disease" value="yes" data-translate="yes"> Yes
                            <input type="radio" name="38_autoimmune_disease" value="no" data-translate="no"> No
                        </p> -->

                        <p data-translate="autoimmune_disease">Presence of autoimmune/Inflammatory disease
                            <label class="custom-radio">
                                <input type="radio" id="autoimmune_disease_yes" name="38_autoimmune_disease" value="yes" data-translate="yes">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                Yes
                            </label>
                            <label class="custom-radio">
                                <input type="radio" id="autoimmune_disease_no" name="38_autoimmune_disease" value="no" data-translate="no">
                                <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                                No
                            </label>
                        </p>
                    </div>

                    <!-- <p data-translate="aortic_plaque">Presence of aortic plaque
                        <input type="radio" name="39_aortic_plaque" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="39_aortic_plaque" value="no" data-translate="no"> No                
                    </p> -->

                    <p data-translate="aortic_plaque">Presence of aortic plaque
                        <label class="custom-radio">
                            <input type="radio" id="aortic_plaque_yes" name="39_aortic_plaque" value="yes" data-translate="yes">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            Yes
                        </label>
                        <label class="custom-radio">
                            <input type="radio" id="aortic_plaque_no" name="39_aortic_plaque" value="no" data-translate="no">
                            <span class="radio-mark">(&nbsp; &nbsp; &nbsp;)</span>
                            No
                        </label>
                    </p>

                    <p data-translate="bnp_level">B-type natriuretic peptide (pg/ml)
                        <input type="text" autocomplete="off" name="40_bnp_level" onkeypress="return onlyNumberKey(event);">
                    </p>

                </details>            

                <button type="submit" name="submit" class="btn btn-primary mt-4" data-translate="calculate">Calculate</button>

            <?php echo form_close(); ?>

            </div>
        </div>	
    </div>
</body>
<footer>

<?php $this->load->view('footer'); ?>

</footer>

<script>

function onlyNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}

document.addEventListener("DOMContentLoaded", function(){
    // Get the gender radio buttons
    var genderRadios = document.querySelectorAll('input[name="gender"]');

    // Add change event listeners to the gender radio buttons
    genderRadios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            // Determine whether the "female" radio button is checked
            var isFemale = document.querySelector('input[name="gender"][value="female"]').checked;

            // Get the autoimmune disease question container
            var autoimmuneDiseaseContainer = document.getElementById('autoimmune_disease_container');

            // Show or hide the autoimmune disease question based on the gender selection
            autoimmuneDiseaseContainer.style.display = isFemale ? 'block' : 'none';
        });
    });
});

document.getElementById('raised_bmi_yes').addEventListener('change', function() {
  
  document.getElementById('bmi_25_container').style.display = 'none';
  document.getElementById('additional_bmi_content').style.display = 'none';
  const bmi25Radios = document.querySelectorAll('input[name="bmi_25"]');
  bmi25Radios.forEach(radio => {
    radio.checked = false;
  });
  
  const bmiValueInput = document.querySelector('input[name="bmi_value"]');
  if (bmiValueInput) {
    bmiValueInput.value = '';
  }
});

document.getElementById('raised_bmi_no').addEventListener('change', function() {
    document.getElementById('bmi_25_container').style.display = 'block';
    
});

document.getElementById('bmi_25_yes').addEventListener('change', function() {
    document.getElementById('additional_bmi_content').style.display = 'block';    
  
});
document.getElementById('bmi_25_no').addEventListener('change', function() {
    document.getElementById('additional_bmi_content').style.display = 'none'; 
});

if (document.getElementById('raised_bmi_yes').checked) {
  document.getElementById('bmi_25_container').style.display = 'block';
}
if (document.getElementById('bmi_25_yes').checked) {
  document.getElementById('additional_bmi_content').style.display = 'block';
}

document.getElementById('smoking_yes').addEventListener('change', function() {  
    document.getElementById('former_smoker_container').style.display = 'none';
    clearRadioSelection('former_smoker');
});

document.getElementById('smoking_no').addEventListener('change', function() {
    document.getElementById('former_smoker_container').style.display = 'block';
});

function clearRadioSelection(radioName) {
  document.querySelectorAll(`input[name="${radioName}"]`).forEach(radio => {
    radio.checked = false;
  });
}

document.querySelectorAll('input[name="24_significant_murmur"]').forEach(radio => {
  radio.addEventListener('change', function() {
    // If 'Yes' is selected for Significant Murmur, show the next question, else hide and clear it
    const displayStyle = radio.value === 'yes' ? 'block' : 'none';
    document.getElementById('precordial_murmur_container').style.display = displayStyle;
    if (radio.value === 'no') {
      clearRadioSelection('24_1_precordial_murmur');
    }
  });
});

function clearRadioSelection(radioName) {
  document.querySelectorAll(`input[name="${radioName}"]`).forEach(radio => {
    radio.checked = false;
  });
}


// // Sample translations
// const translations = {
//   'pt-br': {
//     demographic: "Demográfico",
//     age: "Idade:",
//     gender: "Gênero:",
//     male: "Masculino",
//     female: "Feminino",
//     neurological: "Neurológico",
//     nihss: "Escala de AVC NIH na admissão:",
//     stroke_history: "Acidente Vascular Cerebral prévio ou Ataque Isquêmico Transitório:",
//     yes: "Sim",
//     no: "Não"
//     // ... more translations
//   },
//   // ... other languages
// };

// function translate(lang) {
//   document.querySelectorAll('[data-translate]').forEach((elem) => {
//     const key = elem.getAttribute('data-translate');
//     const translation = translations[lang][key];
//     if (translation) {
//       if (elem.tagName === 'INPUT' && elem.type === 'radio') {
//         elem.nextSibling.textContent = translation;
//       } else {
//         elem.textContent = translation;
//       }
//     }
//   });
// }

// // Event listener for language change
// document.getElementById('languageSelect').addEventListener('change', function() {
//   translate(this.value);
// });

// // Set initial language based on browser preference or default to English
// translate(navigator.language.toLowerCase() === 'pt-br' ? 'pt-br' : 'en');
</script>
</html>