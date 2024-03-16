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

		var_dump($post);
		$pergunta_1 = $this->input->post('1_age') ? $this->input->post('1_age') : 0;
		$pergunta_2 = $this->input->post('2_gender') ? $this->input->post('2_gender') : null;
		$pergunta_3 = $this->input->post('3_nihss') ? $this->input->post('3_nihss') : 0;
		$pergunta_4 = $this->input->post('4_left_atrium_size') ? $this->input->post('4_left_atrium_size') : 0;
		$pergunta_5 = $this->input->post('5_septal_aneurysm') ? $this->input->post('5_septal_aneurysm') : null;
		$pergunta_6 = $this->input->post('6_coronary_disease') ? $this->input->post('6_coronary_disease') : null;
		$pergunta_7 = $this->input->post('7_copd') ? $this->input->post('7_copd') : null;
		$pergunta_8 = $this->input->post('8_hypertension') ? $this->input->post('8_hypertension') : null;
		$pergunta_9 = $this->input->post('9_heart_failure') ? $this->input->post('9_heart_failure') : null;
		$pergunta_10 = $this->input->post('10_hyperthyroidism') ? $this->input->post('10_hyperthyroidism') : null;
		$pergunta_11 = 'N/A';
		$pergunta_12 = $this->input->post('12_height_cm') ? $this->input->post('12_height_cm') : 0;
		$pergunta_13 = $this->input->post('13_weight_kg') ? $this->input->post('13_weight_kg') : 0;
		$pergunta_14 = $this->input->post('14_smoking') ? $this->input->post('14_smoking') : null;
		$pergunta_14_1 = $this->input->post('14_1_former_smoker') ? $this->input->post('14_1_former_smoker') : null;
		$pergunta_15 = $this->input->post('15_systolic_bp') ? $this->input->post('15_systolic_bp') : 0;
		$pergunta_16 = $this->input->post('16_diastolic_bp') ? $this->input->post('16_diastolic_bp') : 0;
		$pergunta_17 = $this->input->post('17_diabetes') ? $this->input->post('17_diabetes') : null;
		$pergunta_18 = $this->input->post('18_ecg_lv_hypertrophy') ? $this->input->post('18_ecg_lv_hypertrophy') : null;
		$pergunta_19 = $this->input->post('19_ecg_pr_interval') ? $this->input->post('19_ecg_pr_interval') : 0;
		$pergunta_20 = $this->input->post('20_raised_bmi') ? $this->input->post('20_raised_bmi') : null;
		$pergunta_20_1 = $this->input->post('20_1_bmi_25') ? $this->input->post('20_1_bmi_25') : null;
		$pergunta_20_2 = $this->input->post('20_2_bmi_value') ? $this->input->post('20_2_bmi_value') : 0;
		$pergunta_21 = $this->input->post('21_sleep_apnea') ? $this->input->post('21_sleep_apnea') : null;
		$pergunta_22 = $this->input->post('22_alcohol_consumption') ? $this->input->post('22_alcohol_consumption') : null;
		$pergunta_23 = $this->input->post('23_symptomatic_stenosis') ? $this->input->post('23_symptomatic_stenosis') : null;
		$pergunta_24 = $this->input->post('24_significant_murmur') ? $this->input->post('24_significant_murmur') : null;
		$pergunta_25 = $this->input->post('25_valve_disease') ? $this->input->post('25_valve_disease') : null;
		$pergunta_26 = $this->input->post('26_vascular_disease') ? $this->input->post('26_vascular_disease') : null;
		$pergunta_27 = $this->input->post('27_white') ? $this->input->post('27_white') : null;
		$pergunta_28 = $this->input->post('28_black') ? $this->input->post('28_black') : null;
		$pergunta_29 = $this->input->post('29_left_atrial_enlargement') ? $this->input->post('29_left_atrial_enlargement') : null;
		$pergunta_30 = $this->input->post('30_stroke') ? $this->input->post('30_stroke') : null;
		$pergunta_31 = $this->input->post('31_renal_disease') ? $this->input->post('31_renal_disease') : null;
		$pergunta_32 = $this->input->post('32_arrhythmia') ? $this->input->post('32_arrhythmia') : null;
		$pergunta_33 = $this->input->post('33_cholesterol_ldl') ? $this->input->post('33_cholesterol_ldl') : 0;
		$pergunta_34 = $this->input->post('34_waist_circumference') ? $this->input->post('34_waist_circumference') : 0;
		$pergunta_35 = $this->input->post('35_heart_rate') ? $this->input->post('35_heart_rate') : 0;
		$pergunta_36 = $this->input->post('36_atrial_premature_contraction') ? $this->input->post('36_atrial_premature_contraction') : null;
		$pergunta_37 = $this->input->post('37_ventricular_premature_contraction') ? $this->input->post('37_ventricular_premature_contraction') : null;
		$pergunta_38 = $this->input->post('38_atrial_fibrillation') ? $this->input->post('38_atrial_fibrillation') : null;
		$pergunta_39 = $this->input->post('39_aortic_plaque') ? $this->input->post('39_aortic_plaque') : null;
		$pergunta_40 = $this->input->post('40_bnp_level') ? $this->input->post('40_bnp_level') : 0;

		


		


		//BRAFIL
		
		
	}



	public function loadPrivacyPolicy() {
		
		$dados['titulo'] = "iRankin | Privacy Policy";

		$this->load->view('privacy', $dados);

	}










}
