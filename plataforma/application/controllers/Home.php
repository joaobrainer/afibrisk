<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {

		$dados['titulo'] = "AFibrisk | Home";

		$this->session->set_userdata('lang', 'pt-br');
		$this->load->view('home', $dados);

	}

	public function loadQuestions() { 
		
		$dados['titulo'] = "AFibrisk | Questions";

		$this->load->view('perguntas/home', $dados);

	}

	public function todasRespostas() { 

		$post = $this->input->post();

		// var_dump($post);

		$dados = array(
			'pergunta_1' => $this->input->post('1_age') ? $this->input->post('1_age') : 0,
			'pergunta_2' => $this->input->post('2_gender') ? $this->input->post('2_gender') : null,
			'pergunta_3' => $this->input->post('3_nihss') ? $this->input->post('3_nihss') : 0,
			'pergunta_4' => $this->input->post('4_left_atrium_size') ? $this->input->post('4_left_atrium_size') : 0,
			'pergunta_5' => $this->input->post('5_septal_aneurysm') ? $this->input->post('5_septal_aneurysm') : null,
			'pergunta_6' => $this->input->post('6_coronary_disease') ? $this->input->post('6_coronary_disease') : null,
			'pergunta_7' => $this->input->post('7_copd') ? $this->input->post('7_copd') : null,
			'pergunta_8' => $this->input->post('8_hypertension') ? $this->input->post('8_hypertension') : null,
			'pergunta_9' => $this->input->post('9_heart_failure') ? $this->input->post('9_heart_failure') : null,
			'pergunta_10' => $this->input->post('10_hyperthyroidism') ? $this->input->post('10_hyperthyroidism') : null,
			'pergunta_11' => 'N/A',
			'pergunta_12' => $this->input->post('12_height_cm') ? $this->input->post('12_height_cm') : 0,
			'pergunta_13' => $this->input->post('13_weight_kg') ? $this->input->post('13_weight_kg') : 0,
			'pergunta_14' => $this->input->post('14_smoking') ? $this->input->post('14_smoking') : null,
			'pergunta_14_1' => $this->input->post('14_1_former_smoker') ? $this->input->post('14_1_former_smoker') : null,
			'pergunta_15' => $this->input->post('15_systolic_bp') ? $this->input->post('15_systolic_bp') : 0,
			'pergunta_16' => $this->input->post('16_diastolic_bp') ? $this->input->post('16_diastolic_bp') : 0,
			'pergunta_17' => $this->input->post('17_diabetes') ? $this->input->post('17_diabetes') : null,
			'pergunta_18' => $this->input->post('18_ecg_lv_hypertrophy') ? $this->input->post('18_ecg_lv_hypertrophy') : null,
			'pergunta_19' => $this->input->post('19_ecg_pr_interval') ? $this->input->post('19_ecg_pr_interval') : 0,
			'pergunta_20' => $this->input->post('20_raised_bmi') ? $this->input->post('20_raised_bmi') : null,
			'pergunta_20_1' => $this->input->post('20_1_bmi_25') ? $this->input->post('20_1_bmi_25') : null,
			'pergunta_20_2' => $this->input->post('20_2_bmi_value') ? $this->input->post('20_2_bmi_value') : 0,
			'pergunta_21' => $this->input->post('21_sleep_apnea') ? $this->input->post('21_sleep_apnea') : null,
			'pergunta_22' => $this->input->post('22_alcohol_consumption') ? $this->input->post('22_alcohol_consumption') : null,
			'pergunta_23' => $this->input->post('23_symptomatic_stenosis') ? $this->input->post('23_symptomatic_stenosis') : null,
			'pergunta_24' => $this->input->post('24_significant_murmur') ? $this->input->post('24_significant_murmur') : null,
			'pergunta_24_1' => $this->input->post('24_1_precordial_murmur') ? $this->input->post('24_1_precordial_murmur') : null,
			'pergunta_25' => $this->input->post('25_valve_disease') ? $this->input->post('25_valve_disease') : null,
			'pergunta_26' => $this->input->post('26_vascular_disease') ? $this->input->post('26_vascular_disease') : null,
			'pergunta_27' => $this->input->post('27_white') ? $this->input->post('27_white') : null,
			'pergunta_28' => $this->input->post('28_black') ? $this->input->post('28_black') : null,
			'pergunta_29' => $this->input->post('29_left_atrial_enlargement') ? $this->input->post('29_left_atrial_enlargement') : null,
			'pergunta_30' => $this->input->post('30_stroke') ? $this->input->post('30_stroke') : null,
			'pergunta_31' => $this->input->post('31_renal_disease') ? $this->input->post('31_renal_disease') : null,
			'pergunta_32' => $this->input->post('32_arrhythmia') ? $this->input->post('32_arrhythmia') : null,
			'pergunta_33' => $this->input->post('33_cholesterol_ldl') ? $this->input->post('33_cholesterol_ldl') : 0,
			'pergunta_34' => $this->input->post('34_waist_circumference') ? $this->input->post('34_waist_circumference') : 0,
			'pergunta_35' => $this->input->post('35_heart_rate') ? $this->input->post('35_heart_rate') : 0,
			'pergunta_36' => $this->input->post('36_atrial_premature_contraction') ? $this->input->post('36_atrial_premature_contraction') : null,
			'pergunta_37' => $this->input->post('37_ventricular_premature_contraction') ? $this->input->post('37_ventricular_premature_contraction') : null,
			'pergunta_38' => $this->input->post('38_atrial_fibrillation') ? $this->input->post('38_atrial_fibrillation') : null,
			'pergunta_39' => $this->input->post('39_aortic_plaque') ? $this->input->post('39_aortic_plaque') : null,
			'pergunta_40' => $this->input->post('40_bnp_level') ? $this->input->post('40_bnp_level') : 0

		);

		// var_dump($dados);
		// 1.BRAFIL
		$this->calculaBRAFIL($dados);

		// 2. C2HEST
		$this->calculaC2HEST($dados);

		// 3. CHARGE-AF
		$this->calculaCHARGEAF($dados);

		// 4. HARMS2-AF
		$this->calculaHARMS2AF($dados);

		// 5. HATCH
		$this->calculaHATCH($dados);

		// 6. STAF
		$this->calculaSTAF($dados);

		// 7. Framingham AF risk score 
		$this->calculaFRAMI($dados);

		//8. HAVOC
		$this->calculaHAVOC($dados);

		//9. ARIC Score
		$this->calculaARIC($dados);

		//10.Taiwan AF Score
		$this->calculaTAIWANAF($dados);

		//11. SUITA Score
		$this->calculaSUITA($dados);

		//12. Hamada Score
		$this->calculaHAMADA($dados);

		//13. MHS Score
		$this->calculaMHS($dados);

		//14. CHA2DS2-VASc
		$this->calculaCHA2DS2($dados);

		//15. Mayo Score
		$this->calculaMAYO($dados);

		//16. The Heinz Nixdorf Recall Study
		$this->calculaTHNRS($dados);

		//17. Takase
		$this->calculaTAKASE($dados);

		//18. ASAS
		$this->calculaASAS($dados);
		
		
	}

	public function calculaBRAFIL($dados) { 
		$pontuacaoBRAFIL = 0;
		$respostaBRAFIL = '';
		if ($dados['pergunta_1'] >= 70) {
			$pontuacaoBRAFIL++;
		}
		if ($dados['pergunta_3'] >= 6) {
			$pontuacaoBRAFIL++;
		}
		if ($dados['pergunta_4'] >= 42) {
			$pontuacaoBRAFIL += 2;
		}
		if ($dados['pergunta_5'] == 'yes') {
			$pontuacaoBRAFIL += 2;
		}

		switch ($pontuacaoBRAFIL) {			
			case 1:
				$respostaBRAFIL = 'Chance of Afib detection on follow-up (median 8 months) = 8.5% (AUC of 0.77 (0.72-0.82, SD 0.027; p-value < 0.001)';
				break;

			case 2:
				$respostaBRAFIL = 'Chance of Afib detection on follow-up (median 8 months) = 15.7% (AUC of 0.77 (0.72-0.82, SD 0.027; p-value < 0.001)';
				break;

			case 3:
				$respostaBRAFIL = 'Chance of Afib detection on follow-up (median 8 months) = 29% (AUC of 0.77 (0.72-0.82, SD 0.027; p-value < 0.001)';
				break;

			case 4:
				$respostaBRAFIL = 'Chance of Afib detection on follow-up (median 8 months) = 37.5% (AUC of 0.77 (0.72-0.82, SD 0.027; p-value < 0.001)';
				break;

			case 5:
				$respostaBRAFIL = 'Chance of Afib detection on follow-up (median 8 months) = 50% (AUC of 0.77 (0.72-0.82, SD 0.027; p-value < 0.001)';
				break;

			case 6:
				$respostaBRAFIL = 'Chance of Afib detection on follow-up (median 8 months) = 100% (AUC of 0.77 (0.72-0.82, SD 0.027; p-value < 0.001)';
				break;
			default:
				$respostaBRAFIL = 'Chance of Afib detection on follow-up (median 8 months) = 1.4% (AUC of 0.77 (0.72-0.82, SD 0.027; p-value < 0.001)';
				break;
		}

		echo '<br>';
		var_dump($respostaBRAFIL);
		echo '<br>';
	}

	public function calculaC2HEST($dados) { 
		$pontuacaoC2HEST = 0;
		$respostaC2HEST = '';

		if ($dados['pergunta_1'] >= 75) {
			$pontuacaoC2HEST += 2;
		}
		if ($dados['pergunta_6'] == 'yes') {
			$pontuacaoC2HEST++;
		}
		if ($dados['pergunta_7'] == 'yes') {
			$pontuacaoC2HEST++;
		}
		if ($dados['pergunta_8'] == 'yes') {
			$pontuacaoC2HEST++;
		}
		if ($dados['pergunta_9'] == 'yes') {
			$pontuacaoC2HEST += 2;
		}
		if ($dados['pergunta_10'] == 'yes') {
			$pontuacaoC2HEST++;
		}

		switch ($pontuacaoC2HEST) {			
			case 1:
				$respostaC2HEST = 'Incidence of Afib per 1,000 person-years = 0.82 (AUC 0.749, 95% CI 0.729-0.769)';
				break;

			case 2:
				$respostaC2HEST = 'Incidence of Afib per 1,000 person-years = 2.31 (AUC 0.749, 95% CI 0.729-0.769)';
				break;

			case 3:
				$respostaC2HEST = 'Incidence of Afib per 1,000 person-years = 3.73 (AUC 0.749, 95% CI 0.729-0.769)';
				break;

			case 4:
				$respostaC2HEST = 'Incidence of Afib per 1,000 person-years = 16.1 (AUC 0.749, 95% CI 0.729-0.769)';
				break;

			case 5:
				$respostaC2HEST = 'Incidence of Afib per 1,000 person-years = 28.7 (AUC 0.749, 95% CI 0.729-0.769)';
				break;

			case 6:
			case 7:
			case 8:
				$respostaC2HEST = 'Incidence of Afib per 1,000 person-years = 59.8 (AUC 0.749, 95% CI 0.729-0.769)';
				break;

			default:
				$respostaC2HEST = 'Incidence of Afib per 1,000 person-years = 0.18 (AUC 0.749, 95% CI 0.729-0.769)';
			break;

		}
		echo '<br>';
		var_dump($respostaC2HEST);
		echo '<br>';
	}

	public function calculaCHARGEAF($dados) { 

		$age = ($dados['pergunta_1'] >= 46 && $dados['pergunta_1'] <= 94) ? $dados['pergunta_1'] : "none";
		$race = $dados['pergunta_27'] === 'yes' ? 1 : ($dados['pergunta_27'] === 'no' ? 0 : 'none');
		$height = ($dados['pergunta_12'] >= 121.9 && $dados['pergunta_12'] <= 241.4) ? $dados['pergunta_12'] : "none";
		$weight = ($dados['pergunta_13'] >= 31.75 && $dados['pergunta_13'] <= 185.1) ? $dados['pergunta_13'] : "none";
		$systolicBP = ($dados['pergunta_15'] >= 71 && $dados['pergunta_14'] <= 248) ? $dados['pergunta_15'] : "none";
		$diastolicBP = ($dados['pergunta_16'] >= 23 && $dados['pergunta_15'] <= 136) ? $dados['pergunta_16'] : "none";
		$smoking = $dados['pergunta_14'] === 'yes' ? 1 : ($dados['pergunta_14'] === 'no' ? 0 : 'none');
		$hypertensionTreatment = $dados['pergunta_8'] === 'yes' ? 1 : ($dados['pergunta_8'] === 'no' ? 0 : 'none');
		$diabetes = $dados['pergunta_17'] === 'yes' ? 1 : ($dados['pergunta_17'] === 'no' ? 0 : 'none');
		$heartFailure = $dados['pergunta_9'] === 'yes' ? 1 : ($dados['pergunta_9'] === 'no' ? 0 : 'none');
		$myocardialInfarction = $dados['pergunta_6'] === 'yes' ? 1 : ($dados['pergunta_6'] === 'no' ? 0 : 'none');
		$eCGLVH = $dados['pergunta_18'] === 'yes' ? 1 : ($dados['pergunta_18'] === 'no' ? 0 : 'none');

		$pRIntervalLT = 0;
		$pRIntervalGT = 0;
		if ($dados['pergunta_19'] < 120 && $dados['pergunta_19'] >= 56) {
			$pRIntervalLT = 1;
		} elseif ($dados['pergunta_19'] > 199 && $dados['pergunta_19'] <= 481) {
			$pRIntervalGT = 1;
		} elseif ($dados['pergunta_19'] < 56 || $dados['pergunta_19'] > 481) {
			$pRIntervalLT = $pRIntervalGT = "none";
		}

		$normal = array(
			'heigth' => 22.5 * (pow($heigth / 100, 2))
		);

		

		$coefSimple = [
			'Age' => 0.010616,
			'Race (White)' => 0.46491,
			'Height' => 0.02478,
			'Weight' => 0.0077,
			'SystolicBP' => 0.00986,
			'DiastolicBP' => -0.01013,
			'Smoking' => 0.35931,
			'Hypertension Treatment' => 0.34889,
			'Diabetes' => 0.23666,
			'Heart Failure' => 0.70127,
			'Myocardial Infarction' => 0.49536,
			'ECG LVH' => 0,
			'PR Interval LT' => 0,
			'PR Interval GT' => 0
		];
		
		$means = [
			'Age' => 65.096357,
			'Race (White)' => 0.8335309,
			'Height' => 166.554394,
			'Weight' => 78.2681334,
			'SystolicBP' => 130.7214969,
			'DiastolicBP' => 71.7049472,
			'Smoking' => 0.133645,
			'Hypertension Treatment' => 0.41576865,
			'Diabetes' => 0.1528886,
			'Heart Failure' => 0.0378314,
			'Myocardial Infarction' => 0.0594417,
			'ECG LVH' => 0.02656822,
			'PR Interval LT' => 0.0193577,
			'PR Interval GT' => 0.1195301
		];

		// Inicialize as variáveis com valores de exemplo, você precisará substituir isso pelos valores reais
		// As variáveis devem ser obtidas por meio do input do usuário, arquivo ou banco de dados
		$age = 65; // em anos
		$height_in_inches = 0; // altura em polegadas, se aplicável
		$height_in_cm = 160; // altura em centímetros, se aplicável
		$weight_in_pounds = 0; // peso em libras, se aplicável
		$weight_in_kg = 70; // peso em quilogramas, se aplicável
		$systolicBP = 120; // pressão arterial sistólica
		$diastolicBP = 80; // pressão arterial diastólica
		$prInterval = 100; // intervalo PR
		$answerB3 = 'yes'; // resposta para a pergunta B3

		// Valores de exemplo para converter unidades
		$height = ($height_in_inches > 0) ? $height_in_inches / 0.393700787 : $height_in_cm;
		$weight = ($weight_in_pounds > 0) ? $weight_in_pounds / 2.20462262 : $weight_in_kg;

		// Converta as respostas "yes"/"no" em "y"/"n"
		$answerB3 = strtolower($answerB3) === 'yes' ? 'y' : (strtolower($answerB3) === 'no' ? 'n' : $answerB3);

		// Valide as faixas de valores para diferentes variáveis
		$validatedAge = ($age >= 46 && $age <= 94) ? $age : null;
		$validatedWeight = ($weight >= 31.75 && $weight <= 185.1) ? $weight : null;
		// Repita a validação para outras variáveis conforme necessário

		// Realize os cálculos das somas dos produtos dos valores pelas médias e coeficientes
		$riskScoreSimple = $age * $coefSimple['Age'] + $height * $coefSimple['Height'] + $weight * $coefSimple['Weight']; // ...continuar para outros valores
		// Realize os cálculos de risco
		$risk = (1 - pow(0.9719033184, exp($riskScoreSimple - 12.4411305))) * 100; // para o risco simples

		// Condicional para verificar os valores de corte
		$finalRisk = $risk > 0.2638808 ? 0.264 : $risk;

		
		echo "<br>";
		echo "O risco calculado é: " . number_format($finalRisk, 3) . "%\n";
		echo "<br>";


		
	}

	public function calculaHARMS2AF($dados) { 
		$pontuacaoHARMS2AF = 0;
		$respostaHARMS2AF = '';
		
		if ($dados['pergunta_1'] >= 65) {
			$pontuacaoHARMS2AF += 2;
		}elseif($dados['pergunta_1'] >= 61 && $dados['pergunta_1'] <= 64) {
			$pontuacaoHARMS2AF ++;			
		}

		if ($dados['pergunta_8'] == 'yes') {
			$pontuacaoHARMS2AF += 4;
		}
		if ($dados['pergunta_20'] == 'yes') {
			$pontuacaoHARMS2AF += 1;
		}
		if ($dados['pergunta_2'] == 'male') {
			$pontuacaoHARMS2AF += 2;
		}
		if ($dados['pergunta_14'] == 'yes') {
			$pontuacaoHARMS2AF ++;
		}
		if ($dados['pergunta_21'] == 'yes') {
			$pontuacaoHARMS2AF += 2;
		}
		if ($dados['pergunta_22'] == '7_14') {
			$pontuacaoHARMS2AF ++;	
		}elseif ($dados['pergunta_22'] == '15_plus') {
			$pontuacaoHARMS2AF += 2;
		}

		switch ($pontuacaoHARMS2AF) {
			case 0:
			case 1:
			case 2:
			case 3:	
			case 4:
				$respostaHARMS2AF = 'HR 2.81 (95% CI 1.95, 4.04)';
				break;
			
			case 5:
			case 6:
			case 7:	
			case 8:
			case 9:
				$respostaHARMS2AF = 'HR 12.79 (95% CI 8.93, 18.33)';
				break;

			// 10-14	
			default: 
				$respostaHARMS2AF = 'HR 38.70 (95% CI 26.96, 55.54)';
				break;
		}

		echo '<br>';
		var_dump($respostaHARMS2AF);
		echo '<br>';

	}

	public function calculaHATCH($dados) { 
		$pontuacaoHATCH = 0;
		$respostaHATCH = '';

		if ($dados['pergunta_1'] > 75) {
			$pontuacaoHATCH ++;
		}
		if ($dados['pergunta_8'] == 'yes') {
			$pontuacaoHATCH ++;
		}
		if ($dados['pergunta_30'] == 'yes') {
			$pontuacaoHATCH += 2;
		}
		if ($dados['pergunta_7'] == 'yes') {
			$pontuacaoHATCH ++;
		}
		if ($dados['pergunta_9'] == 'yes') {
			$pontuacaoHATCH += 2;
		}

		switch ($pontuacaoHATCH) {		
			case 1:
				$respostaHATCH = 'Incidence (per 1000 person-years of follow-up) of Afib detection = 7.3 / Hazard Ratio 8.3 (95% CI 7.933–8.763)';	
				break;
			
			case 2:
				$respostaHATCH = 'Incidence (per 1000 person-years of follow-up) of Afib detection = 9.9 / Hazard Ratio 10.9 (95% CI 10.138–11.719)';
				break;

			case 3:
				$respostaHATCH = 'Incidence (per 1000 person-years of follow-up) of Afib detection = 10.5 / Hazard Ratio 11.16 (95% CI 10.191–12.235)';
				break;

			case 4:
				$respostaHATCH = 'Incidence (per 1000 person-years of follow-up) of Afib detection = 18 / Hazard Ratio 19.12 (95% CI 16.980–21.542)';
				break;

			case 5:
				$respostaHATCH = 'Incidence (per 1000 person-years of follow-up) of Afib detection = 20.5 / Hazard Ratio 20.64 (95% CI 16.696–25.529)';
				break;

			case 6:
				$respostaHATCH = 'Incidence (per 1000 person-years of follow-up) of Afib detection = 32.3 / Hazard Ratio 32.79 (95% CI 23.104–46.556)';
				break;

			case 7:
				$respostaHATCH = 'Incidence (per 1000 person-years of follow-up) of Afib detection = 57.3 / Hazard Ratio 55.42 (95% CI 32.067–95.801)';
				break;
			
			default:
				$respostaHATCH = 'Incidence (per 1000 person-years of follow-up) of Afib detection = 0.8 / Hazard Ratio 1';
				break;
		}

		echo '<br>';
		var_dump($respostaHATCH);
		echo '<br>';
	}

	public function calculaSTAF($dados) { 
		$pontuacaoSTAF = 0;
		$respostaSTAF = '';

		if ($dados['pergunta_1'] >= 63) {
			$pontuacaoSTAF += 2;
		}
		if ($dados['pergunta_3'] >= 8) {
			$pontuacaoSTAF ++;
		}
		if ($dados['pergunta_4'] >= 40) {
			$pontuacaoSTAF += 2;
		}
		if ($dados['pergunta_23'] == 'no') {
			$pontuacaoSTAF += 3;
		}

		if ($pontuacaoSTAF <= 4) {
			$respostaSTAF = 'Low chance of Afib detection on follow-up (3 months)  - AUC of 0.94 (0.92-0.96, SD 0.012; p-value < 0.001)';
		}else{
			$respostaSTAF = 'High chance of Afib detection on follow-up (3 months)  - AUC of 0.94 (0.92-0.96, SD 0.012; p-value < 0.001)';
		}

		echo '<br>';
		var_dump($respostaSTAF);
		echo '<br>';
	}

	public function calculaFRAMI($dados) { 
		$pontuacaoFRAMI = 0;
		$respostaFRAMI = '';

		$male = 0;
		$female = 0;

		if ($dados['pergunta_2'] == 'male') {
			$male = 1;
		}elseif ($dados['pergunta_2'] == 'female') {
			$female = 1;
		}

		if ($dados['pergunta_1'] >= 85) {
			$pontuacaoFRAMI += 8;
		}elseif ($dados['pergunta_1'] >= 80 && $dados['pergunta_1'] <= 84) {
			$pontuacaoFRAMI += 7;
		}elseif ($dados['pergunta_1'] >= 75 && $dados['pergunta_1'] <= 79) {
			if ($male == 1) {
				$pontuacaoFRAMI += 7;
			}elseif ($female == 1) {
				$pontuacaoFRAMI += 6;
			}
		}elseif ($dados['pergunta_1'] >= 70 && $dados['pergunta_1'] <= 74) {
			if ($male == 1) {
				$pontuacaoFRAMI += 6;
			}elseif ($female == 1) {
				$pontuacaoFRAMI += 4;
			}
		}elseif ($dados['pergunta_1'] >= 65 && $dados['pergunta_1'] <= 69) {
			if ($male == 1) {
				$pontuacaoFRAMI += 5;
			}elseif ($female == 1) {
				$pontuacaoFRAMI += 3;
			}
		}elseif ($dados['pergunta_1'] >= 60 && $dados['pergunta_1'] <= 64) {
			if ($male == 1) {
				$pontuacaoFRAMI += 4;
			}elseif ($female == 1) {
				$pontuacaoFRAMI += 1;
			}
		}elseif ($dados['pergunta_1'] >= 55 && $dados['pergunta_1'] <= 59) {
			if ($male == 1) {
				$pontuacaoFRAMI += 3;
			}elseif ($female == 1) {
				$pontuacaoFRAMI += 0;
			}
		}elseif ($dados['pergunta_1'] >= 50 && $dados['pergunta_1'] <= 54) {
			if ($male == 1) {
				$pontuacaoFRAMI += 2;
			}elseif ($female == 1) {
				$pontuacaoFRAMI += -2;
			}
		}elseif ($dados['pergunta_1'] >= 45 && $dados['pergunta_1'] <= 49) {
			if ($male == 1) {
				$pontuacaoFRAMI += 1;
			}elseif ($female == 1) {
				$pontuacaoFRAMI += -3;
			}
		}

		if ($dados['pergunta_15'] >= 160) {
			$pontuacaoFRAMI++;
		}

		if ($dados['pergunta_8'] == 'yes') {
			$pontuacaoFRAMI++;
		}

		if ($dados['pergunta_19'] >= 160 && $dados['pergunta_19'] <= 190) {
			$pontuacaoFRAMI++;
		}elseif ($dados['pergunta_19'] >= 200) {
			$pontuacaoFRAMI += 2;
		}

		if ($dados['pergunta_24'] == 'yes') {
			if($dados['pergunta_1'] >= 75 && $dados['pergunta_1'] <= 84) {
				$pontuacaoFRAMI ++;
			}elseif ($dados['pergunta_1'] >= 65 && $dados['pergunta_1'] <= 74) {
				$pontuacaoFRAMI += 2;
			}elseif ($dados['pergunta_1'] >= 55 && $dados['pergunta_1'] <= 64) {
				$pontuacaoFRAMI += 4;
			}elseif ($dados['pergunta_1'] >= 45 && $dados['pergunta_1'] <= 54) {
				$pontuacaoFRAMI += 5;
			}
		}

		if ($dados['pergunta_9'] == 'yes') {
			if ($dados['pergunta_1'] >= 65 && $dados['pergunta_1'] <= 74) {
				$pontuacaoFRAMI += 2;
			}elseif ($dados['pergunta_1'] >= 55 && $dados['pergunta_1'] <= 64) {
				$pontuacaoFRAMI += 6;
			}elseif ($dados['pergunta_1'] >= 45 && $dados['pergunta_1'] <= 54) {
				$pontuacaoFRAMI += 10;
			}
		}

		switch ($pontuacaoFRAMI) {		
			case 0:
				$respostaFRAMI = 'Chance of Afib detection on follow-up (10 years) = < 1% {C statistic=0.78, 95% confidence interval [CI] 0.76–0.80)}. The applicability of this risk score, derived from whites, to predict new-onset AF in non-whites is uncertain.';	
				break;

			case 1:
				$respostaFRAMI = 'Chance of Afib detection on follow-up (10 years) = 2% {C statistic=0.78, 95% confidence interval [CI] 0.76–0.80)}. The applicability of this risk score, derived from whites, to predict new-onset AF in non-whites is uncertain.';	
				break;
			
			case 2:
				$respostaFRAMI = 'Chance of Afib detection on follow-up (10 years) = 2% {C statistic=0.78, 95% confidence interval [CI] 0.76–0.80)}. The applicability of this risk score, derived from whites, to predict new-onset AF in non-whites is uncertain.';
				break;

			case 3:
				$respostaFRAMI = 'Chance of Afib detection on follow-up (10 years) = 3% {C statistic=0.78, 95% confidence interval [CI] 0.76–0.80)}. The applicability of this risk score, derived from whites, to predict new-onset AF in non-whites is uncertain.';
				break;

			case 4:
				$respostaFRAMI = ' Chance of Afib detection on follow-up (10 years) = 4% {C statistic=0.78, 95% confidence interval [CI] 0.76–0.80)}. The applicability of this risk score, derived from whites, to predict new-onset AF in non-whites is uncertain.';
				break;

			case 5:
				$respostaFRAMI = '> Chance of Afib detection on follow-up (10 years) = 6% {C statistic=0.78, 95% confidence interval [CI] 0.76–0.80)}. The applicability of this risk score, derived from whites, to predict new-onset AF in non-whites is uncertain.';
				break;

			case 6:
				$respostaFRAMI = 'Chance of Afib detection on follow-up (10 years) = 8% {C statistic=0.78, 95% confidence interval [CI] 0.76–0.80)}. The applicability of this risk score, derived from whites, to predict new-onset AF in non-whites is uncertain.';
				break;

			case 7:
				$respostaFRAMI = 'Chance of Afib detection on follow-up (10 years) = 12% {C statistic=0.78, 95% confidence interval [CI] 0.76–0.80)}. The applicability of this risk score, derived from whites, to predict new-onset AF in non-whites is uncertain.';
				break;

			case 8:
				$respostaFRAMI = 'Chance of Afib detection on follow-up (10 years) = 16% {C	statistic=0.78, 95% confidence interval [CI] 0.76–0.80)}. The applicability of this risk score, derived from whites, to predict new-onset AF in non-whites is uncertain.';
				break;

			case 9:
				$respostaFRAMI = 'Chance of Afib detection on follow-up (10 years) = 22% {C	statistic=0.78, 95% confidence interval [CI] 0.76–0.80)}. The applicability of this risk score, derived from whites, to predict new-onset AF in non-whites is uncertain.';
				break;
			
			default:
				$respostaFRAMI = 'Chance of Afib detection on follow-up (10 years) => 30% {C statistic=0.78, 95% confidence interval [CI] 0.76–0.80)}. The applicability of this	risk score, derived from whites, to predict new-onset AF in non-whites is uncertain.';
				break;
		}

		echo '<br>';
		var_dump($respostaFRAMI);
		echo '<br>';
		
	}

	public function calculaHAVOC($dados) { 
		$pontuacaoHAVOC = 0;
		$respostaHAVOC = '';

		if ($dados['pergunta_1'] >= 75) {
			$pontuacaoHAVOC += 2;
		}

		if ($dados['pergunta_8'] == 'yes') {
			$pontuacaoHAVOC += 2;
		}

		if ($dados['pergunta_25'] == 'yes') {
			$pontuacaoHAVOC += 2;
		}

		if ($dados['pergunta_20'] == 'yes') {
			$pontuacaoHAVOC++;
		}

		if ($dados['pergunta_26'] == 'yes') {
			$pontuacaoHAVOC++;
		}

		if ($dados['pergunta_9'] == 'yes') {
			$pontuacaoHAVOC += 4;
		}

		if ($dados['pergunta_6'] == 'yes') {
			$pontuacaoHAVOC += 2;
		}

		switch ($pontuacaoHAVOC) {
			case 0:
			case 1:
			case 2:
			case 3:	
			case 4:
				$respostaHAVOC = 'Low chance of Afib detection on follow; 2.5%';
				break;
			
			case 5:
			case 6:
			case 7:	
			case 8:
			case 9:
				$respostaHAVOC = 'Medium chance of Afib detection on follow; 11.8%';
				break;

			// 10-14	
			default: 
				$respostaHAVOC = 'High chance of Afib detection on follow; 24.9%';
				break;
		}

		echo '<br>';
		var_dump($respostaHAVOC);
		echo '<br>';
	}

	public function calculaARIC($dados) { 
		$pontuacaoARIC = 0;
		$respostaARIC = '';

		if ($dados['pergunta_1'] >= 50 && $dados['pergunta_1'] < 55) {
			$pontuacaoARIC += 3;
		}elseif ($dados['pergunta_1'] >= 55 && $dados['pergunta_1'] < 60) {
			$pontuacaoARIC += 4;
		}elseif ($dados['pergunta_1'] >= 60 && $dados['pergunta_1'] <= 64) {
			$pontuacaoARIC += 8;
		}

		if ($dados['pergunta_28'] == 'yes') {
			$pontuacaoARIC += -4;
		}

		if ($dados['pergunta_12'] >= 164 && $dados['pergunta_12'] < 173) {
			$pontuacaoARIC ++;
		}elseif ($dados['pergunta_12'] >= 173) {
			$pontuacaoARIC += 4;
		}

		if ($dados['pergunta_15'] < 100) {
			$pontuacaoARIC += -1;
		}elseif ($dados['pergunta_15'] >= 120 && $dados['pergunta_15'] < 140) {
			$pontuacaoARIC ++;
		}elseif ($dados['pergunta_15'] >= 140 && $dados['pergunta_15'] < 160) {
			$pontuacaoARIC += 2;
		}elseif ($dados['pergunta_15'] >= 160) {
			$pontuacaoARIC += 3;
		}

		if ($dados['pergunta_8'] == 'yes') {
			$pontuacaoARIC += 3;
		}
		if ($dados['pergunta_14'] == 'yes') {
			$pontuacaoARIC += 3;
		}
		if ($dados['pergunta_14_1'] == 'yes') {
			$pontuacaoARIC ++;
		}
		if ($dados['pergunta_24_1'] == 'yes') {
			$pontuacaoARIC += 2;
		}
		if ($dados['pergunta_29'] == 'yes') {
			$pontuacaoARIC += 2;
		}
		if ($dados['pergunta_9'] == 'yes') {
			$pontuacaoARIC += 2;
		}

		if ($dados['pergunta_6'] == 'yes') {
			if ($dados['pergunta_1'] >= 45 && $dados['pergunta_1'] < 50) {
				$pontuacaoARIC += 5;
			}elseif ($dados['pergunta_1'] >= 50 && $dados['pergunta_1'] < 60) {
				$pontuacaoARIC += 3;
			}
		}

		if ($dados['pergunta_17'] == 'yes') {
			if ($dados['pergunta_1'] >= 45 && $dados['pergunta_1'] < 55) {
				$pontuacaoARIC += 4;
			}elseif ($dados['pergunta_1'] >= 55 && $dados['pergunta_1'] < 60) {
				$pontuacaoARIC ++;
			}
		}

		if ($dados['pergunta_18'] == 'yes') {
			if ($dados['pergunta_27'] == 'yes') {
				$pontuacaoARIC += 4;
			}
		}

		if ($pontuacaoARIC <= 1) {
			$respostaARIC = "Chance (%) of Afib in 10 years = <1%";
		} elseif ($pontuacaoARIC >= 2 && $pontuacaoARIC <= 6) {
			$respostaARIC = "Chance (%) of Afib in 10 years = 1%";
		} elseif ($pontuacaoARIC >= 7 && $pontuacaoARIC <= 8) {
			$respostaARIC = "Chance (%) of Afib in 10 years = 2%";
		} elseif ($pontuacaoARIC == 9) {
			$respostaARIC = "Chance (%) of Afib in 10 years = 3%";
		} elseif ($pontuacaoARIC >= 10 && $pontuacaoARIC <= 11) {
			$respostaARIC = "Chance (%) of Afib in 10 years = 4%";
		} elseif ($pontuacaoARIC == 12) {
			$respostaARIC = "Chance (%) of Afib in 10 years = 6%";
		} elseif ($pontuacaoARIC == 13) {
			$respostaARIC = "Chance (%) of Afib in 10 years = 7%";
		} elseif ($pontuacaoARIC == 14) {
			$respostaARIC = "Chance (%) of Afib in 10 years = 9%";
		} elseif ($pontuacaoARIC == 15) {
			$respostaARIC = "Chance (%) of Afib in 10 years = 11%";
		} elseif ($pontuacaoARIC == 16) {
			$respostaARIC = "Chance (%) of Afib in 10 years = 13%";
		} elseif ($pontuacaoARIC == 17) {
			$respostaARIC = "Chance (%) of Afib in 10 years = 16%";
		} elseif ($pontuacaoARIC == 18) {
			$respostaARIC = "Chance (%) of Afib in 10 years = 20%";
		} elseif ($pontuacaoARIC >= 19) {
			$respostaARIC = "Chance (%) of Afib in 10 years = >24%";
		} 

		echo '<br>';
		var_dump($respostaARIC);
		echo '<br>';
	}

	public function calculaTAIWANAF($dados) { 
		$pontuacaoTAIWANAF = 0;
		$respostaTAIWANAF = '';

		if ($dados['pergunta_1'] >= 80) {
			$pontuacaoTAIWANAF += 8;
		}elseif ($dados['pergunta_1'] >= 75 && $dados['pergunta_1'] <= 79) {
			$pontuacaoTAIWANAF += 5;
		}elseif ($dados['pergunta_1'] >= 70 && $dados['pergunta_1'] <= 74) {
			$pontuacaoTAIWANAF += 4;
		}elseif ($dados['pergunta_1'] >= 65 && $dados['pergunta_1'] <= 69) {
			$pontuacaoTAIWANAF += 3;	
		}elseif ($dados['pergunta_1'] >= 60 && $dados['pergunta_1'] <= 64) {
			$pontuacaoTAIWANAF += 2;
		}elseif ($dados['pergunta_1'] >= 55 && $dados['pergunta_1'] <= 59) {
			$pontuacaoTAIWANAF += 1;
		}elseif ($dados['pergunta_1'] >= 45 && $dados['pergunta_1'] <= 49) {
			$pontuacaoTAIWANAF += -1;
		}elseif ($dados['pergunta_1'] >= 40 && $dados['pergunta_1'] <= 44) {
			$pontuacaoTAIWANAF += -2;
		}

		if ($dados['pergunta_2'] == 'male') {
			$pontuacaoTAIWANAF += 1;
		}

		if ($dados['pergunta_8'] == 'yes') {
			$pontuacaoTAIWANAF += 1;
		}

		if ($dados['pergunta_9'] == 'yes') {
			$pontuacaoTAIWANAF += 2;
		}

		if ($dados['pergunta_6'] == 'yes') {
			$pontuacaoTAIWANAF += 1;
		}

		if ($dados['pergunta_31'] == 'yes') {
			$pontuacaoTAIWANAF += 1;
		}

		switch ($dados['pergunta_22']) {
			case '0_7':
			case '7_14':
			case '15_plus':	
				$pontuacaoTAIWANAF += 1;
				break;
			
			default:
				# code...
				break;
		}

		if ($pontuacaoTAIWANAF >= -3 && $pontuacaoTAIWANAF <= 3) {
			$respostaTAIWANAF = 'Low incidence of Afib detection on follow; 0.08% (2 years) 1.26% (10 years) and 2.81% (16 years)';
		}elseif ($pontuacaoTAIWANAF >= 4 && $pontuacaoTAIWANAF <= 9) {
			$respostaTAIWANAF = 'Medium incidence of Afib detection on follow; 2.03% (2 years) 11.13% (10 years) and 19.59% (16 years)';
		}elseif ($pontuacaoTAIWANAF >= 10) {
			$respostaTAIWANAF = 'High incidence of Afib detection on follow; 7.82% (2 years) 27.9% (10 years) and 38.9% (16 years)';
		}

		echo '<br>';
		var_dump($respostaTAIWANAF);
		echo '<br>';

	}

	public function calculaSUITA($dados) { 
		$pontuacaoSUITA = 0;
		$respostaSUITA = 'none';

		if ($dados['pergunta_1'] >= 30) {
			$male = 0;
			$female = 0;
			if ($dados['pergunta_2'] == 'male') {
				$male = 1;
			}elseif ($dados['pergunta_2'] == 'female') {
				$female = 1;
			}

			if ($dados['pergunta_1'] >= 30 && $dados['pergunta_1'] <= 49) {
				if ($female == 1) {
					$pontuacaoSUITA += -5;
				}
			}elseif ($dados['pergunta_1'] >= 50 && $dados['pergunta_1'] <= 59) {
				if ($male == 1) {
					$pontuacaoSUITA += 3;
				}
			}elseif ($dados['pergunta_1'] >= 60 && $dados['pergunta_1'] <= 69) {
				if ($male == 1) {
					$pontuacaoSUITA += 7;
				}elseif ($female == 1) {
					$pontuacaoSUITA += 5;
				}
			}elseif ($dados['pergunta_1'] >= 70 && $dados['pergunta_1'] <= 79) {				
				$pontuacaoSUITA += 9;				
			}

			if ($dados['pergunta_8'] == 'yes') {
				$pontuacaoSUITA += 2;
			}

			if ($dados['pergunta_20_1'] == 'yes') {
				$pontuacaoSUITA += 2;
			}

			if($dados['pergunta_22'] == '15_plus') {
				$pontuacaoSUITA += 2;
			}

			if ($dados['pergunta_14'] == 'yes') {
				$pontuacaoSUITA += 1;
			}	

			if ($dados['pergunta_33'] >= 130 && $dados['pergunta_33'] <= 189) {
				$pontuacaoSUITA += -1;
			}

			if ($dados['pergunta_32'] == 'yes') {
				$pontuacaoSUITA += 4;
			}
			
			if ($dados['pergunta_6'] == 'yes') {
				$pontuacaoSUITA += 2;
			}

			if ($dados['pergunta_24_1'] == 'yes') {
				if ($dados['pergunta_1'] >= 60 && $dados['pergunta_1'] <= 69) {
					$pontuacaoSUITA += 2;
				}elseif ($dados['pergunta_1'] >= 50 && $dados['pergunta_1'] <= 59) {
					$pontuacaoSUITA += 6;
				}elseif ($dados['pergunta_1'] >= 30 && $dados['pergunta_1'] <= 49) {
					$pontuacaoSUITA += 8;
				}
			}

			if ($pontuacaoSUITA < 0) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF <0.5 %";
			} elseif ($pontuacaoSUITA == 0) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF 0.8%";
			} elseif ($pontuacaoSUITA >= 1 && $pontuacaoSUITA <= 2) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF 1%";
			} elseif ($pontuacaoSUITA == 3) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF 2%";
			} elseif ($pontuacaoSUITA == 4) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF 3%";
			} elseif ($pontuacaoSUITA >= 5 && $pontuacaoSUITA <= 7) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF 4%";
			} elseif ($pontuacaoSUITA >= 8 && $pontuacaoSUITA <= 9) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF 7%";
			} elseif ($pontuacaoSUITA >= 10 && $pontuacaoSUITA <= 11) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF 9%";
			} elseif ($pontuacaoSUITA == 12) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF 12%";
			} elseif ($pontuacaoSUITA == 13) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF 16%";
			} elseif ($pontuacaoSUITA >= 14 && $pontuacaoSUITA <= 15) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF 20%";
			} elseif ($pontuacaoSUITA >= 16) {
				$respostaSUITA = "Predicted 10-Year Risk of Incident AF 27%";
			}

		}

		echo '<br>';
		var_dump($respostaSUITA);
		echo '<br>';


	}

	public function calculaHAMADA($dados) { 
		$pontuacaoHAMADA = 0;
		$respostaHAMADA = 'none';

		if ($dados['pergunta_1'] >= 40 && $dados['pergunta_1'] <= 79) {
			if ($dados['pergunta_1'] >= 50 && $dados['pergunta_1'] <= 59) {
				$pontuacaoHAMADA += 2;
			}elseif ($dados['pergunta_1'] >= 60 && $dados['pergunta_1'] <= 64) {
				$pontuacaoHAMADA += 3;
			}elseif ($dados['pergunta_1'] >= 65 && $dados['pergunta_1'] <= 69) {
				$pontuacaoHAMADA += 4;
			}elseif ($dados['pergunta_1'] >= 70 && $dados['pergunta_1'] <= 79) {
				$pontuacaoHAMADA += 5;
			}

			if ($dados['pergunta_2'] == 'male') {
				$pontuacaoHAMADA += 2;
				if ($dados['pergunta_34'] >= 85) {
					$pontuacaoHAMADA += 1;
				}
			}elseif ($dados['pergunta_2'] == 'female') {
				if ($dados['pergunta_34'] >= 90) {
					$pontuacaoHAMADA += 1;
				}
			}

			if ($dados['pergunta_16'] >= 90) {
				$pontuacaoHAMADA += 1;
			}

			if ($dados['pergunta_22'] == '7_14') {
				$pontuacaoHAMADA += 1;
			}elseif ($dados['pergunta_22'] == '15_plus') {
				$pontuacaoHAMADA += 2;
			}

			if ($dados['pergunta_35'] <= 50) {
				$pontuacaoHAMADA += 1;
			}

			if ($dados['pergunta_36'] == 'yes') {
				$pontuacaoHAMADA += 3;
			}

			if ($dados['pergunta_18'] == 'yes') {
				$pontuacaoHAMADA += 1;
			}

			if($dados['pergunta_29'] == 'yes') {
				$pontuacaoHAMADA += 5;
			}

			if ($dados['pergunta_37'] == 'yes') {
				$pontuacaoHAMADA += 2;
			}

			//chamar a imagem do grafico com a resposta			
			$respostaHAMADA = $pontuacaoHAMADA;
			
		}

		echo '<br>';
		var_dump($respostaHAMADA);
		echo '<br>';
	}

	public function calculaMHS($dados) { 
		$pontuacaoMHS = 0;
		$respostaMHS = 'none';

		if ($dados['pergunta_1'] >= 50) {
			if ($dados['pergunta_1'] >= 55 && $dados['pergunta_1'] <= 59) {
				$pontuacaoMHS++;
			}elseif ($dados['pergunta_1'] >= 60 && $dados['pergunta_1'] <= 64) {
				$pontuacaoMHS =+ 2;
			}elseif ($dados['pergunta_1'] >= 65 && $dados['pergunta_1'] <= 69) {
				$pontuacaoMHS =+ 3;
			}elseif ($dados['pergunta_1'] >= 70 && $dados['pergunta_1'] <= 74) {
				$pontuacaoMHS =+ 4;
			}elseif ($dados['pergunta_1'] >= 75 && $dados['pergunta_1'] <= 79) {
				$pontuacaoMHS =+ 5;
			}elseif ($dados['pergunta_1'] >= 80 && $dados['pergunta_1'] <= 84) {
				$pontuacaoMHS =+ 6;
			}elseif ($dados['pergunta_1'] >= 85) {
				$pontuacaoMHS =+ 7;
			}

			if ($dados['pergunta_2'] == 'female') {
				$pontuacaoMHS =+ -1;
			}
	
			if ($dados['pergunta_20_1'] == 'yes') {
				if ($dados['pergunta_20_2'] >= 25 && $dados['pergunta_20_2'] <= 31) {
					$pontuacaoMHS++;
				}elseif ($dados['pergunta_20_2'] >= 32 && $dados['pergunta_20_2'] <= 38) {
					$pontuacaoMHS =+ 2;
				}elseif ($dados['pergunta_20_2'] >= 39) {
					$pontuacaoMHS =+ 3;
				}
			}
	
			if ($dados['pergunta_6'] == 'yes') {
				$pontuacaoMHS++;
			}
	
			if ($dados['pergunta_26'] == 'yes') {
				$pontuacaoMHS++;
			}
	
			if ($dados['pergunta_8'] == 'yes') {
				$pontuacaoMHS++;
			}
	
			if ($dados['pergunta_15'] >= 160) {
				$pontuacaoMHS++;
			}
	
			if ($dados['pergunta_7'] == 'yes') {
				$pontuacaoMHS++;
			}
	
			if ($dados['pergunta_38'] == 'yes') {
				$pontuacaoMHS++;
			}
	
			if ($dados['pergunta_9'] == 'yes') {
				if ($dados['pergunta_1'] >= 50 && $dados['pergunta_1'] <= 54) {
					$pontuacaoMHS =+ 6;
				}elseif ($dados['pergunta_1'] >= 55 && $dados['pergunta_1'] <= 59) {
					$pontuacaoMHS =+ 5;
				}elseif ($dados['pergunta_1'] >= 60 && $dados['pergunta_1'] <= 64) {
					$pontuacaoMHS =+ 4;
				}elseif ($dados['pergunta_1'] >= 65 && $dados['pergunta_1'] <= 69) {
					$pontuacaoMHS =+ 3;
				}elseif ($dados['pergunta_1'] >= 70 && $dados['pergunta_1'] <= 74) {
					$pontuacaoMHS =+ 2;
				}elseif ($dados['pergunta_1'] >= 75 && $dados['pergunta_1'] <= 79) {
					$pontuacaoMHS =+ 1;
				}
			}
	
			switch ($pontuacaoMHS) {
				case -1:
					$respostaMHS = 'Predicted 10-year risk of atrial fibrillation by risk score 1.0%';	
					break;

				case 0:
					$respostaMHS = 'Predicted 10-year risk of atrial fibrillation by risk score 1.4%';	
					break;
	
				case 1:
					$respostaMHS = 'Predicted 10-year risk of atrial fibrillation by risk score 1.9%';	
					break;
				
				case 2:
					$respostaMHS = 'Predicted 10-year risk of atrial fibrillation by risk score 2.7%';
					break;
	
				case 3:
					$respostaMHS = 'Predicted 10-year risk of atrial fibrillation by risk score 3.8%';
					break;
	
				case 4:
					$respostaMHS = 'Predicted 10-year risk of atrial fibrillation by risk score 5.3%';
					break;
	
				case 5:
					$respostaMHS = 'Predicted 10-year risk of atrial fibrillation by risk score 7.5%';
					break;
	
				case 6:
					$respostaMHS = 'Predicted 10-year risk of atrial fibrillation by risk score 10.5%';
					break;
	
				case 7:
					$respostaMHS = 'Predicted 10-year risk of atrial fibrillation by risk score 14.6%';
					break;
	
				case 8:
					$respostaMHS = 'Predicted 10-year risk of atrial fibrillation by risk score 20.1%';
					break;
	
				case 9:
					$respostaMHS = 'Predicted 10-year risk of atrial fibrillation by risk score 27.2%';
					break;
				
				default:
					$respostaMHS = 'There are no confident data for predicting the risk of AFib in patients with score ≥ 10 points - according to the original paper';
					break;
			}

		}

		echo '<br>';
		var_dump($respostaMHS);
		echo '<br>';	

	}

	public function calculaCHA2DS2($dados) { 

		$pontuacaoCHA2DS2 = 0;
		$respostaCHA2DS2 = '';

		if ($dados['pergunta_1'] >= 65 && $dados['pergunta_1'] <= 74) {
			$pontuacaoCHA2DS2++;
		}elseif ($dados['pergunta_1'] >= 75) {
			$pontuacaoCHA2DS2 += 2;
		}

		if ($dados['pergunta_2'] == 'female') {
			$pontuacaoCHA2DS2++;
		}

		if ($dados['pergunta_9'] == 'yes') {
			$pontuacaoCHA2DS2++;
		}

		if ($dados['pergunta_8'] == 'yes') {
			$pontuacaoCHA2DS2++;
		}

		if ($dados['pergunta_30'] == 'yes') {
			$pontuacaoCHA2DS2 += 2;
		}

		if ($dados['pergunta_26'] == 'yes' || $dados['pergunta_6'] == 'yes' || $dados['pergunta_39'] == 'yes') {
			$pontuacaoCHA2DS2++;
		}

		if ($dados['pergunta_17'] == 'yes') {
			$pontuacaoCHA2DS2++;
		}

		switch ($pontuacaoCHA2DS2) {

			case 0:
				$respostaCHA2DS2 = 'Incidence Density Rate of AF (Per 100 Person-Years) 0.17 ; Hazard Ratio (95% CI) 1';	
				break;

			case 1:
				$respostaCHA2DS2 = 'Incidence Density Rate of AF (Per 100 Person-Years) 0.21 ; Hazard Ratio (95% CI) 1.19 (1.09-1.29)';	
				break;
			
			case 2:
				$respostaCHA2DS2 = 'Incidence Density Rate of AF (Per 100 Person-Years) 0.49 ; Hazard Ratio (95% CI) 2.81 (2.60-3.04)';
				break;

			case 3:
				$respostaCHA2DS2 = 'Incidence Density Rate of AF (Per 100 Person-Years) 0.94 ; Hazard Ratio (95% CI) 5.42 (5.02-5.84)';
				break;

			case 4:
				$respostaCHA2DS2 = 'Incidence Density Rate of AF (Per 100 Person-Years) 1.65 ; Hazard Ratio (95% CI) 9.46 (8.78-10.19)';
				break;

			case 5:
				$respostaCHA2DS2 = 'Incidence Density Rate of AF (Per 100 Person-Years) 2.31 ; Hazard Ratio (95% CI) 13.24 (12.26-14.29)';
				break;

			case 6:
				$respostaCHA2DS2 = 'Incidence Density Rate of AF (Per 100 Person-Years) 2.75 ; Hazard Ratio (95% CI) 15.70 (14.47-17.04)';
				break;

			case 7:
				$respostaCHA2DS2 = 'Incidence Density Rate of AF (Per 100 Person-Years) 3.39 ; Hazard Ratio (95% CI) 19.40 (17.71-21.25)';
				break;

			case 8:
				$respostaCHA2DS2 = 'Incidence Density Rate of AF (Per 100 Person-Years) 4.09 ; Hazard Ratio (95% CI) 23.34 (20.59-26.46)';
				break;

			case 9:
				$respostaCHA2DS2 = 'Incidence Density Rate of AF (Per 100 Person-Years) 6.71 ; Hazard Ratio (95% CI) 38.16 (30.54-47.67)';
				break;
			
			default:
				$respostaCHA2DS2 = '';
				break;
		}

		echo '<br>';
		var_dump($respostaCHA2DS2);
		echo '<br>';	

	}

	public function calculaMAYO($dados) { 

		$pontuacaoMAYO = 0;
		$respostaMAYO = '';

		if ($dados['pergunta_1'] >= 65 && $dados['pergunta_1'] <= 75) {
			$pontuacaoMAYO++;
		}elseif ($dados['pergunta_1'] >= 76) {
			$pontuacaoMAYO += 2;
		}

		if ($dados['pergunta_2'] == 'female') {
			$pontuacaoMAYO++;
		}

		if ($dados['pergunta_9'] == 'yes') {
			$pontuacaoMAYO += 3;
		}

		if ($dados['pergunta_25'] == 'yes') {
			$pontuacaoMAYO += 2;
		}

		if ($dados['pergunta_6'] == 'yes') {
			$pontuacaoMAYO += 2;
		}

		if ($dados['pergunta_8'] == 'yes') {
			$pontuacaoMAYO++;
		}

		if ($dados['pergunta_17'] == 'yes') {
			$pontuacaoMAYO++;
		}

		switch ($pontuacaoMAYO) {

			case 0:
				$respostaMAYO = 'Cumulative incidence of AF 0.07% / Odd ratio (95% CI) 1 (vs a score of	0)';	
				break;

			case 1:
				$respostaMAYO = 'Cumulative incidence of AF 2.02% / Odd ratio (95% CI) 3.05 (2.67-3.49)	(vs a score of 0)';	
				break;
			
			case 2:
				$respostaMAYO = 'Cumulative incidence of AF 8.22% / Odd ratio (95% CI) 12.9 (11.4-14.8)	(vs a score of 0)';
				break;

			case 3:
				$respostaMAYO = 'Cumulative incidence of AF 13.2% / Odd ratio (95% CI) 22.8 (19.9-26.1)	(vs a score of 0)';
				break;

			case 4:
				$respostaMAYO = 'Cumulative incidence of AF 18.7% / Odd ratio (95% CI) 34.0 (29.2-39.5)	(vs a score of 0)';
				break;				
			
			default:
				$respostaMAYO = 'Cumulative incidence of AF 22.2% / Odd ratio (95% CI) 48.0	(41.9-54.9) (vs a score of 0)';
				break;
		}

		echo '<br>';
		var_dump($respostaMAYO);
		echo '<br>';	
	}

	public function calculaTHNRS($dados) { 

		$pontuacaoTHNRS = 0;
		$respostaTHNRS = 'none';

		if ($dados['pergunta_2'] == 'female') {
			if ($dados['pergunta_40'] >= 45) {
				$respostaTHNRS = 'A higher chance of incident Afib in a 2-years follow-up (AUC 0.826), based on BNP levels';
			}else{
				$respostaTHNRS = 'A lower chance of incident Afib in a 2-years follow-up (AUC 0.826), based on BNP levels';
			}
		}

		if ($dados['pergunta_2'] == 'male') {
			if ($dados['pergunta_40'] >= 31) {
				$respostaTHNRS = 'A higher chance of incident Afib in a 2-years follow-up (AUC 0.826), based on BNP levels';
			}else{
				$respostaTHNRS = 'A lower chance of incident Afib in a 2-years follow-up (AUC 0.826), based on BNP levels';
			}
		}

		echo '<br>';
		var_dump($respostaTHNRS);
		echo '<br>';	

	}

	public function calculaTAKASE($dados) { 

		$pontuacaoTAKASE = 0;
		$respostaTAKASE = 'none';

		if ($dados['pergunta_40'] >= 11.4) {
			$respostaTAKASE = 'A higher chance of incident AFib in a 5-years follow-up, based on BNP levels. Sensitivity and specificity of 81.1%, and 55.2%, respectively. The area under the ROC curve was 0.703';
		}else{
			$respostaTAKASE = 'A lower chance of incident AFib in a 5-years follow-up, based on BNP levels. Sensitivity and specificity of 81.1%, and 55.2%, respectively. The area under the ROC curve was 0.703';
		}

		echo '<br>';
		var_dump($respostaTAKASE);
		echo '<br>';	

	}

	public function calculaASAS($dados) { 

		$respostaASAS = '';

		$pontuacao_pergunta29 = 0;
		if ($dados['pergunta_29'] == 'yes') {
			$pontuacao_pergunta29++;
		}

		$e = exp(1);
		$asas = -6 + ($dados['pergunta_1'] / 20) + ($dados['pergunta_3'] / 10) + (0.9 * $pontuacao_pergunta29);	
		$probabilidade = (pow($e, $asas)) / (1 + pow($e, $asas));	
		$probabilidadeEmProcentagem = $probabilidade * 100;

		$respostaASAS = 'Probability of new AFib in a 3-year period: ' . number_format($probabilidadeEmProcentagem, 2) . '%';

		echo '<br>';
		var_dump($respostaASAS);
		echo '<br>';
		
	}



	public function loadPrivacyPolicy() {
		
		$dados['titulo'] = "iRankin | Privacy Policy";

		$this->load->view('privacy', $dados);

	}










}
