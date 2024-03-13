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
		
	}



	public function loadPrivacyPolicy() {
		
		$dados['titulo'] = "iRankin | Privacy Policy";

		$this->load->view('privacy', $dados);

	}










}
