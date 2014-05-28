<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('admin/administradores');
	}


	public function login(){

		//if (isset($this->session->userdata('acceso')) && $this->session->userdata('acceso') == 1) {
		if ($this->session->userdata('acceso') === FALSE || $this->session->userdata('acceso') != 1 ){

			$this->load->library('form_validation');
			$this->load->view('admin/templates/head_basico_html');
			$this->load->view('admin/login');
			$this->load->view('admin/templates/footer_html');

		} else {

			$this->load->view('admin/templates/head_html');
			$this->load->view('admin/templates/main_menu');
			$this->load->view('admin/templates/head_menu');
			$this->load->view('admin/escritorio');
			$this->load->view('admin/templates/footer_html');

			
		}
	}

	public function check(){
		$this->load->library('form_validation');
		//validacion de acceso
		$this->form_validation->set_rules('user','Usuario','required');		
		$this->form_validation->set_rules('pass','Contraseña','required');

		if ($this->form_validation->run() === FALSE) {
			
			$this->load->library('form_validation');
			$this->load->view('admin/templates/head_basico_html');
			$this->load->view('admin/login');
			$this->load->view('admin/templates/footer_html');

		} else {
			$user = $this->input->post('user', TRUE);
			$pass = $this->input->post('pass', TRUE);
			$array = $this->administradores->get_user($user,$pass);

			if ($array) {
				$this->session->set_userdata('acceso',1);
				$this->session->set_userdata('usuario', $array['usuario']);
				$this->load->view('admin/templates/head_html');
				$this->load->view('admin/templates/main_menu');
				$this->load->view('admin/templates/head_menu');
				$this->load->view('admin/escritorio');
				$this->load->view('admin/templates/footer_html');
			} else {
				$data ['error'] = "Usuario y/o contraseña incorrecto";

				$this->load->library('form_validation');
				$this->load->view('admin/templates/head_basico_html');
				$this->load->view('admin/login',$data);
				$this->load->view('admin/templates/footer_html');

			}
		}
	}
}