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
		// 1.BRAFIL
		$this->calculoBRAFIL($dados);

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
		
		
	}

	public function calculoBRAFIL($dados) { 
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
		// Verificar
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
		if ($pergunta['pergunta_2'] == 'male') {
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

	}

	public function calculaHATCH() { 
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
	}



	public function loadPrivacyPolicy() {
		
		$dados['titulo'] = "iRankin | Privacy Policy";

		$this->load->view('privacy', $dados);

	}










}
