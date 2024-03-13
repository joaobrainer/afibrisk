<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">

        <?php echo form_open("home/todasRespostas", 'id="formprincipal"'); ?>

            <details>
                <summary data-translate="demographic">Demographic</summary>
                    <p data-translate="age">Age:</p> <input type="number" name="age">
                    <p data-translate="gender">Gender:</p>
                    <input type="radio" name="gender" value="male" data-translate="male"> Male
                    <input type="radio" name="gender" value="female" data-translate="female"> Female
            </details>

            <details>
                <summary data-translate="neurological">Neurological</summary>
                <p data-translate="nihss">NIH Stroke Scale on admission:</p> <input type="text" name="nihss">
                <p data-translate="stroke_history">Previous Stroke or Transient Ischemic Attack:</p>
                <input type="radio" name="stroke" value="yes" data-translate="yes"> Yes
                <input type="radio" name="stroke" value="no" data-translate="no"> No
            </details>

            <details>
                <summary data-translate="body_metrics">Body metrics and laboratory</summary>
                <p data-translate="height">12. Height (cm): <input type="number" name="height_cm"></p>
                <p data-translate="weight">13. Weight (kg): <input type="number" name="weight_kg"></p>
                <p data-translate="systolic_bp">15. Systolic Blood Pressure (mmHg): <input type="number" name="systolic_bp"></p>
                <p data-translate="diastolic_bp">16. Diastolic Blood Pressure (mmHg): <input type="number" name="diastolic_bp"></p>
                
                <p data-translate="raised_bmi">20. Raised BMI (BMI>30kg/m²): 
                    <input type="radio" id="raised_bmi_yes" name="raised_bmi" value="yes" data-translate="yes"> Yes
                    <input type="radio" id="raised_bmi_no" name="raised_bmi" value="no" data-translate="no"> No
                </p>                           

                <div id="bmi_25_container" style="display:none;">
                    <p data-translate="bmi_25">20.1. BMI ≥25 kg/m²: 
                        <input type="radio" id="bmi_25_yes" name="bmi_25" value="yes" data-translate="yes"> Yes
                        <input type="radio" id="bmi_25_no" name="bmi_25" value="no" data-translate="no"> No</p>
                    
                    <div id="additional_bmi_content" style="display:none;">
                        <p data-translate="bmi_value">20.2. BMI (kg/m²): <input type="number" name="bmi_value" step="0.01"></p>
                    
                    </div>
                </div>
                <p data-translate="waist_circumference">34. Waist circumference (cm): <input type="number" name="waist_circumference"></p>
                <p data-translate="heart_rate">35. Heart rate (beats per minute): <input type="number" name="heart_rate"></p>
                <p data-translate="cholesterol_ldl">33. Cholesterol LDL-C (mg/dL): <input type="number" name="cholesterol_ldl"></p>
            </details>

            <details>
                <summary data-translate="personal_history">Personal history</summary>
                <p data-translate="history_coronary_disease">6. History of Coronary Disease:
                    <input type="radio" name="coronary_disease" value="yes"> Yes
                    <input type="radio" name="coronary_disease" value="no"> No</p>
                <p data-translate="history_copd">7. History of chronic obstructive pulmonary disease (COPD):
                    <input type="radio" name="copd" value="yes"> Yes
                    <input type="radio" name="copd" value="no"> No</p>
                <p data-translate="history_hypertension">8. History of Arterial Hypertension:
                    <input type="radio" name="hypertension" value="yes"> Yes
                    <input type="radio" name="hypertension" value="no"> No</p>
                <p data-translate="history_heart_failure">9. History of Heart Failure:
                    <input type="radio" name="heart_failure" value="yes"> Yes
                    <input type="radio" name="heart_failure" value="no"> No</p>
                <p data-translate="history_hyperthyroidism">10. Known Hyperthyroidism:
                    <input type="radio" name="hyperthyroidism" value="yes"> Yes
                    <input type="radio" name="hyperthyroidism" value="no"> No</p>
                <p data-translate="smoking_status">14. Smoking:
                    <input type="radio" id="smoking_yes" name="smoking" value="yes"> Yes
                    <input type="radio" id="smoking_no" name="smoking" value="no"> No</p>
                <div id="former_smoker_container" style="display:none;">
                    <p data-translate="former_smoker">14.1. Former smoker:
                        <input type="radio" name="former_smoker" value="yes"> Yes
                        <input type="radio" name="former_smoker" value="no"> No</p>
                </div>
                <p data-translate="history_diabetes">17. History of Diabetes:
                    <input type="radio" name="diabetes" value="yes"> Yes
                    <input type="radio" name="diabetes" value="no"> No</p>
                <p data-translate="sleep_apnea">21. Sleep apnea:
                    <input type="radio" name="sleep_apnea" value="yes"> Yes
                    <input type="radio" name="sleep_apnea" value="no"> No</p>
                <p data-translate="alcohol_consumption">22. Alcohol consumption:
                    <input type="radio" name="alcohol_consumption" value="0"> 0
                    <input type="radio" name="alcohol_consumption" value="1_7"> 0-7 std. drinks per week
                    <input type="radio" name="alcohol_consumption" value="8_14"> 7-14 std. drinks per week
                    <input type="radio" name="alcohol_consumption" value="15_plus"> 15+ std. drinks per week
                    <input type="radio" name="alcohol_consumption" value="none"> no consumption</p>
                <p data-translate="peripheral_vascular_disease">26. Peripheral Vascular Disease:
                    <input type="radio" name="vascular_disease" value="yes"> Yes
                    <input type="radio" name="vascular_disease" value="no"> No</p>
                <p data-translate="end_stage_renal_disease">31. End-stage renal disease:
                    <input type="radio" name="renal_disease" value="yes"> Yes
                    <input type="radio" name="renal_disease" value="no"> No</p>
            </details>

            <details>
                <summary data-translate="echography">Echography</summary>
                <p data-translate="left_atrium_size">4. Left Atrium Size <input type="number" name="left_atrium_size" min="0"> mm</p>
                <p data-translate="presence_septal_aneurysm">5. Presence of septal aneurysm:
                    <input type="radio" name="septal_aneurysm" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="septal_aneurysm" value="no" data-translate="no"> No</p>
                <p data-translate="valve_disease">25. Valve Disease:
                    <input type="radio" name="valve_disease" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="valve_disease" value="no" data-translate="no"> No</p>
            </details>

            <details>
                <summary data-translate="electrocardiogram">Electrocardiogram</summary>
                <p data-translate="ecg_lv_hypertrophy">18. ECG Left Ventricular Hypertrophy:
                    <input type="radio" name="ecg_lv_hypertrophy" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="ecg_lv_hypertrophy" value="no" data-translate="no"> No</p>
                <p data-translate="ecg_pr_interval">19. ECG PR Interval <input type="number" name="ecg_pr_interval"> ms</p>
                <p data-translate="left_atrial_enlargement">29. Presence of Left Atrial Enlargement:
                    <input type="radio" name="left_atrial_enlargement" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="left_atrial_enlargement" value="no" data-translate="no"> No</p>
                <p data-translate="atrial_premature_contraction">36. Atrial premature contraction/complex:
                    <input type="radio" name="atrial_premature_contraction" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="atrial_premature_contraction" value="no" data-translate="no"> No</p>
                <p data-translate="ventricular_premature_contraction">37. Ventricular premature contraction/complex:
                    <input type="radio" name="ventricular_premature_contraction" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="ventricular_premature_contraction" value="no" data-translate="no"> No</p>
                <p data-translate="arrhythmia">32. Arrhythmia (other than Atrial Fibrillation):
                    <input type="radio" name="arrhythmia" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="arrhythmia" value="no" data-translate="no"> No</p>
            </details>

            <details>
                <summary data-translate="cardiology_general">Cardiology and General</summary>
                <p data-translate="presence_symptomatic_stenosis">23. Presence of symptomatic extra- or intracranial stenosis ≥50%, symptomatic arterial dissection, clinico-radiological lacunar syndrome:
                    <input type="radio" name="symptomatic_stenosis" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="symptomatic_stenosis" value="no" data-translate="no"> No</p>
                <p data-translate="significant_murmur">24. Significant Murmur:
                    <input type="radio" name="significant_murmur" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="significant_murmur" value="no" data-translate="no"> No</p>
                <div id="precordial_murmur_container" style="display:none;">
                    <p data-translate="presence_precordial_murmur">24.1. Presence of any precordial murmur:
                        <input type="radio" name="precordial_murmur" value="yes" data-translate="yes"> Yes
                        <input type="radio" name="precordial_murmur" value="no" data-translate="no"> No</p>
                </div>
                <p data-translate="autoimmune_disease">38. Presence of autoimmune/Inflammatory disease:
                    <input type="radio" name="autoimmune_disease" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="autoimmune_disease" value="no" data-translate="no"> No</p>
                <p data-translate="aortic_plaque">39. Presence of aortic plaque:
                    <input type="radio" name="aortic_plaque" value="yes" data-translate="yes"> Yes
                    <input type="radio" name="aortic_plaque" value="no" data-translate="no"> No</p>
                <p data-translate="bnp_level">40. B-type natriuretic peptide (pg/ml):
                    <input type="number" name="bnp_level"></p>
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

document.getElementById('raised_bmi_yes').addEventListener('change', function() {
  document.getElementById('bmi_25_container').style.display = 'block';
});

document.getElementById('raised_bmi_no').addEventListener('change', function() {
  
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
  document.getElementById('former_smoker_container').style.display = 'block';
});

document.getElementById('smoking_no').addEventListener('change', function() {
  document.getElementById('former_smoker_container').style.display = 'none';
  clearRadioSelection('former_smoker');
});

function clearRadioSelection(radioName) {
  document.querySelectorAll(`input[name="${radioName}"]`).forEach(radio => {
    radio.checked = false;
  });
}

document.querySelectorAll('input[name="significant_murmur"]').forEach(radio => {
  radio.addEventListener('change', function() {
    // If 'Yes' is selected for Significant Murmur, show the next question, else hide and clear it
    const displayStyle = radio.value === 'yes' ? 'block' : 'none';
    document.getElementById('precordial_murmur_container').style.display = displayStyle;
    if (radio.value === 'no') {
      clearRadioSelection('precordial_murmur');
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