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
		$this->load->model('frontal/cines_front_model');
	}
	public function index()
	{	
		$data['cines'] = $this->cines_front_model->list_cines();
		$data['cartelera'] = $this->cines_front_model->list_cartelera();
		$data['estrenos'] = $this->cines_front_model->list_estrenos();


		if ($data['cartelera'] && $data['estrenos'] && $data['cines']) {
			
			$this->load->view('frontal/templates/head_html');
			$this->load->view('frontal/templates/cabecera');
			$this->load->view('frontal/home',$data);
			$this->load->view('frontal/templates/pie');
			$this->load->view('frontal/templates/footer_html');
		}

	}
}
