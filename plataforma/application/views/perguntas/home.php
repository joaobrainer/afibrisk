<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">

        <?= form_open("home/todasRespostas", 'id="formprincipal"'); ?>

            <details>
                <summary data-translate="demographic">Demographic</summary>

                    <p data-translate="age">1. Age:
                        <input name="1_age" maxlength="3" onkeypress="return onlyNumberKey(event);">
                    </p> 

                    <p data-translate="gender">2. Gender:
                        <input type="radio" name="2_gender" value="male" data-translate="male"> Male
                        <input type="radio" name="2_gender" value="female" data-translate="female"> Female
                    </p>

                    <p data-translate="white">27. White:
                        <input type="radio" name="27_white" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="27_white" value="no" data-translate="no"> No
                    </p>

                    <p data-translate="black">28. Black:
                        <input type="radio" name="28_black" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="28_black" value="no" data-translate="no"> No
                    </p>
            </details>

            <details>
                <summary data-translate="neurological">Neurological</summary>

                <p data-translate="nihss">3. NIH Stroke Scale on admission: 
                    <input name="3_nihss" onkeypress="return onlyNumberKey(event);">
                </p>

                <p data-translate="stroke_history">30. Previous Stroke or Transient Ischemic Attack:
                    <input type="radio" name="30_stroke" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="30_stroke" value="no" data-translate="no"> No
                </p>

            </details>

            <details>

                <summary data-translate="body_metrics">Body metrics and laboratory</summary>

                <p data-translate="height">12. Height (cm): 
                    <input name="12_height_cm" onkeypress="return onlyNumberKey(event);">
                </p>
                
                <p data-translate="weight">13. Weight (kg): 
                    <input name="13_weight_kg" onkeypress="return onlyNumberKey(event);">
                </p>
                
                <p data-translate="systolic_bp">15. Systolic Blood Pressure (mmHg): 
                    <input name="15_systolic_bp" onkeypress="return onlyNumberKey(event);">
                </p>
                
                <p data-translate="diastolic_bp">16. Diastolic Blood Pressure (mmHg): 
                    <input name="16_diastolic_bp" onkeypress="return onlyNumberKey(event);">
                </p>
                
                <p data-translate="raised_bmi">20. Raised BMI (BMI>30kg/m²): 
                    <input type="radio" id="raised_bmi_yes" name="20_raised_bmi" value="yes" data-translate="yes"> Yes
                    <input type="radio" id="raised_bmi_no" name="20_raised_bmi" value="no" data-translate="no"> No
                </p>                           

                <div id="bmi_25_container" style="display:none;">

                    <p data-translate="bmi_25">20.1. BMI ≥25 kg/m²: 
                        <input type="radio" id="bmi_25_yes" name="20_1_bmi_25" value="yes" data-translate="yes"> Yes
                        <input type="radio" id="bmi_25_no" name="20_1_bmi_25" value="no" data-translate="no"> No
                    </p>
                    
                    <div id="additional_bmi_content" style="display:none;">
                        <p data-translate="bmi_value">20.2. BMI (kg/m²): 
                            <input name="20_2_bmi_value" step="0.01" onkeypress="return onlyNumberKey(event);">
                        </p>                    
                    </div>

                </div>
                
                <p data-translate="waist_circumference">34. Waist circumference (cm): 
                    <input name="34_waist_circumference" onkeypress="return onlyNumberKey(event);">
                </p>

                <p data-translate="heart_rate">35. Heart rate (beats per minute): 
                    <input name="35_heart_rate" onkeypress="return onlyNumberKey(event);">
                </p>

                <p data-translate="cholesterol_ldl">33. Cholesterol LDL-C (mg/dL): 
                    <input name="33_cholesterol_ldl" onkeypress="return onlyNumberKey(event);">
                </p>

            </details>

            <details>

                <summary data-translate="personal_history">Personal history</summary>

                <p data-translate="history_coronary_disease">6. History of Coronary Disease:
                    <input type="radio" name="6_coronary_disease" value="yes"> Yes
                    <input type="radio" name="6_coronary_disease" value="no"> No
                </p>

                <p data-translate="history_copd">7. History of chronic obstructive pulmonary disease (COPD):
                    <input type="radio" name="7_copd" value="yes"> Yes
                    <input type="radio" name="7_copd" value="no"> No
                </p>

                <p data-translate="history_hypertension">8. History of Arterial Hypertension:
                    <input type="radio" name="8_hypertension" value="yes"> Yes
                    <input type="radio" name="8_hypertension" value="no"> No
                </p>

                <p data-translate="history_heart_failure">9. History of Heart Failure:
                    <input type="radio" name="9_heart_failure" value="yes"> Yes
                    <input type="radio" name="9_heart_failure" value="no"> No
                </p>

                <p data-translate="history_hyperthyroidism">10. Known Hyperthyroidism:
                    <input type="radio" name="10_hyperthyroidism" value="yes"> Yes
                    <input type="radio" name="10_hyperthyroidism" value="no"> No
                </p>

                <p data-translate="smoking_status">14. Smoking:
                    <input type="radio" id="smoking_yes" name="14_smoking" value="yes"> Yes
                    <input type="radio" id="smoking_no" name="14_smoking" value="no"> No
                </p>

                <div id="former_smoker_container" style="display:none;">
                    <p data-translate="former_smoker">14.1. Former smoker:
                        <input type="radio" name="14_1_former_smoker" value="yes"> Yes
                        <input type="radio" name="14_1_former_smoker" value="no"> No
                    </p>
                </div>

                <p data-translate="history_diabetes">17. History of Diabetes:
                    <input type="radio" name="17_diabetes" value="yes"> Yes
                    <input type="radio" name="17_diabetes" value="no"> No
                </p>

                <p data-translate="sleep_apnea">21. Sleep apnea:
                    <input type="radio" name="21_sleep_apnea" value="yes"> Yes
                    <input type="radio" name="21_sleep_apnea" value="no"> No
                </p>

                <p data-translate="alcohol_consumption">22. Alcohol consumption:
                    <input type="radio" name="22_alcohol_consumption" value="0"> 0
                    <input type="radio" name="22_alcohol_consumption" value="0_7"> 0-7 std. drinks per week
                    <input type="radio" name="22_alcohol_consumption" value="7_14"> 7-14 std. drinks per week
                    <input type="radio" name="22_alcohol_consumption" value="15_plus"> 15+ std. drinks per week
                    <input type="radio" name="22_alcohol_consumption" value="none"> no consumption
                </p>

                <p data-translate="peripheral_vascular_disease">26. Peripheral Vascular Disease:
                    <input type="radio" name="26_vascular_disease" value="yes"> Yes
                    <input type="radio" name="26_vascular_disease" value="no"> No
                </p>

                <p data-translate="end_stage_renal_disease">31. End-stage renal disease:
                    <input type="radio" name="31_renal_disease" value="yes"> Yes
                    <input type="radio" name="31_renal_disease" value="no"> No
                </p>

            </details>

            <details>

                <summary data-translate="echography">Echography</summary>

                <p data-translate="left_atrium_size">4. Left Atrium Size 
                    <input name="4_left_atrium_size" onkeypress="return onlyNumberKey(event);"> mm
                </p>
                
                <p data-translate="presence_septal_aneurysm">5. Presence of septal aneurysm:
                    <input type="radio" name="5_septal_aneurysm" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="5_septal_aneurysm" value="no" data-translate="no"> No
                </p>

                <p data-translate="valve_disease" class="custom-tooltip">25. Valve Disease:
                    <input type="radio" name="25_valve_disease" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="25_valve_disease" value="no" data-translate="no"> No
                    <span class="tooltip-content">
                        <span style="font-size: 12px;">Aortic, mitral, tricuspid, and/or pulmonary valve disease</span>
                    </span>
                </p>
            </details>

            <details>
                <summary data-translate="electrocardiogram">Electrocardiogram</summary>

                <p data-translate="ecg_lv_hypertrophy">18. ECG Left Ventricular Hypertrophy:
                    <input type="radio" name="18_ecg_lv_hypertrophy" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="18_ecg_lv_hypertrophy" value="no" data-translate="no"> No
                </p>
                <p data-translate="ecg_pr_interval">19. ECG PR Interval 
                    <input type="number" name="19_ecg_pr_interval"> ms
                </p>

                <p data-translate="left_atrial_enlargement" class="custom-tooltip">29. Presence of Left Atrial Enlargement:
                    <input type="radio" name="29_left_atrial_enlargement" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="29_left_atrial_enlargement" value="no" data-translate="no"> No
                    <span class="tooltip-content">
                        <span style="font-size: 12px;">Left atrial enlargement (LAE) by ECG was defined as a p-wave duration of ≥ 120 ms or p wave amplitude >2.5 mm in II and/or terminal p negativity in V1 duration 0.04 s, depth 1 mm.
                        <br> When from the bidimensional parasternal (as adopted by the ASAS score) long-axis view, LAE may be defined as an anteroposterior diameter ≥4.0cm</span>
                    </span>
                </p>

                <br>

                <p data-translate="atrial_premature_contraction" class="custom-tooltip">36. Atrial premature contraction/complex:
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
                </p>

                <br>

                <p data-translate="ventricular_premature_contraction" class="custom-tooltip">37. Ventricular premature contraction/complex:
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
                </p>
                
                <p data-translate="arrhythmia">32. Arrhythmia (other than Atrial Fibrillation):
                    <input type="radio" name="32_arrhythmia" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="32_arrhythmia" value="no" data-translate="no"> No
                </p>

            </details>

            <details>
                <summary data-translate="cardiology_general">Cardiology and General</summary>

                <p data-translate="presence_symptomatic_stenosis">23. Presence of symptomatic extra- or intracranial stenosis ≥50%, symptomatic arterial dissection, clinico-radiological lacunar syndrome:
                    <input type="radio" name="23_symptomatic_stenosis" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="23_symptomatic_stenosis" value="no" data-translate="no"> No
                </p>

                <p data-translate="significant_murmur" class="custom-tooltip">24. Significant Murmur:
                    <input type="radio" name="24_significant_murmur" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="24_significant_murmur" value="no" data-translate="no"> No
                    <span class="tooltip-content">
                        <span style="font-size: 12px;">A significant cardiac murmur was considered present if grade ≥3 out of 6 systolic or any diastolic murmur was auscultated by the physician</span>
                    </span>
                </p>

                <div id="precordial_murmur_container" style="display:none;">
                    <p data-translate="presence_precordial_murmur">24.1. Presence of any precordial murmur:
                        <input type="radio" name="24_1_precordial_murmur" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="24_1_precordial_murmur" value="no" data-translate="no"> No
                    </p>
                </div>
                
                <div id="autoimmune_disease_container" style="display:none;">
                    <p data-translate="autoimmune_disease">38. Presence of autoimmune/Inflammatory disease:
                        <input type="radio" name="38_autoimmune_disease" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="38_autoimmune_disease" value="no" data-translate="no"> No
                    </p>
                </div>

                <p data-translate="aortic_plaque">39. Presence of aortic plaque:
                    <input type="radio" name="39_aortic_plaque" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="39_aortic_plaque" value="no" data-translate="no"> No                
                </p>

                <p data-translate="bnp_level">40. B-type natriuretic peptide (pg/ml):
                    <input name="40_bnp_level" onkeypress="return onlyNumberKey(event);">
                </p>

            </details>

            <button type="submit" name="submit" class="btn btn-primary" data-translate="calculate">Calculate</button>

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