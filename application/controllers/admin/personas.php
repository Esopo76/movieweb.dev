<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personas extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/admin/actores
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
		$this->load->model('admin/personas_model');
		$this->load->model('admin/paises_model');
	}

	public function index(){
		$this->listado();
	}

	public function listado(){
		$data['personas'] = $this->personas_model->get_person();
		$data['title'] = "Listado de actores/directores";
		$data['titulo'] = "Actores/Directores";
		$data['subtitulo'] ="Listado";
		$data['breadcrumbs'] = array(
			array(
				'nombre' => 'Actores/Directores',
				'icono' => 'fa fa-star',
				'link' =>  'admin/personas'
				),
			array(
				'nombre' => 'Listado actores/directores',
				'icono' => 'fa fa-user',
				'link' =>  false
				)
			);
		//falta el title

		/*echo '<pre>';
			print_r($data);
		echo '</pre>';*/
		$this->load->view('admin/templates/head_html',$data);
		$this->load->view('admin/templates/main_menu');
		$this->load->view('admin/templates/head_menu');
		$this->load->view('admin/personas_list',$data);
		$this->load->view('admin/templates/footer_html');
	}

	public function delete($id){

		if($this->personas_model->delete($id)) {
			$data['eliminada'] = $id;
			$data['personas'] = $this->personas_model->get_person();
			$data['title'] = "Listado de actores/directores";
			$data['titulo'] = "Actores/Directores";
			$data['subtitulo'] ="Listado";
			$data['breadcrumbs'] = array(
				array(
					'nombre' => 'Actores/Directores',
					'icono' => 'fa fa-star',
					'link' =>  'admin/personas'
					),
				array(
					'nombre' => 'Listado actores/directores',
					'icono' => 'fa fa-user',
					'link' =>  false
					)
				);
		//falta el title

		/*echo '<pre>';
			print_r($data);
		echo '</pre>';*/
		$this->load->view('admin/templates/head_html',$data);
		$this->load->view('admin/templates/main_menu');
		$this->load->view('admin/templates/head_menu');
		$this->load->view('admin/personas_list',$data);
		$this->load->view('admin/templates/footer_html');

		}
	}

	public function add(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['title'] = "Añadir actor/director";
		$data['paises'] = $this->paises_model->get_paises();
		$data['titulo'] = "Actores/Directores";
		$data['breadcrumbs'] = array(
			array(
				'nombre' => 'Actores/Directores',
				'icono' => 'fa fa-star',
				'link' =>  'admin/personas'
				),
			array(
				'nombre' => 'Añadir actor/director',
				'icono' => 'fa fa-plus',
				'link' =>  false
				)
			);

		//reglas de validación
		$this->form_validation->set_rules('nombre','nombre','required');
		$this->form_validation->set_rules('apellidos','apellidos','required');
		$this->form_validation->set_rules('asoc', 'Número de las asociación de actores/directores', 'required');
		$this->form_validation->set_rules('pais', 'País', 'required');

		if ($this->form_validation->run() === FALSE){
			$this->load->view('admin/templates/head_html',$data);
			$this->load->view('admin/templates/main_menu');
			$this->load->view('admin/templates/head_menu');
			$this->load->view('admin/edit_personas',$data);
			$this->load->view('admin/templates/footer_html');

		} else {

			$arr_insert = array(
				'nombre' =>	$this->input->post('nombre', TRUE) , 
				'apellidos'	=>	$this->input->post('apellidos', TRUE),
				'num_Asoc'	=>	url_title($this->input->post('asoc', TRUE)),
				'iso_pais'	=>	url_title($this->input->post('pais', TRUE))
			);

			$data['personas'] = $this->personas_model->get_person();
			$this->personas_model->insert($arr_insert);
			//falta control de errores

			$data['añadida'] = TRUE;
			$data['title'] = "Listado de actores/directores";
			$data['titulo'] = "Actores/Directores";
			$data['subtitulo'] ="Listado";
			$data['breadcrumbs'] = array(
				array(
					'nombre' => 'Actores/Directores',
					'icono' => 'fa fa-star',
					'link' =>  'admin/personas'
					),
				array(
					'nombre' => 'Listado actores/directores',
					'icono' => 'fa fa-user',
					'link' =>  false
					)
				);
		//falta el title

		/*echo '<pre>';
			print_r($data);
		echo '</pre>';*/
		$this->load->view('admin/templates/head_html',$data);
		$this->load->view('admin/templates/main_menu');
		$this->load->view('admin/templates/head_menu');
		$this->load->view('admin/personas_list',$data);
		$this->load->view('admin/templates/footer_html');




		}

	}


	public function edit($id){
		$this->load->helper('form');
		$this->load->library('form_validation');
		//reglas de validación
		$this->form_validation->set_rules('nombre','nombre','required');
		$this->form_validation->set_rules('apellidos','apellidos','required');
		$this->form_validation->set_rules('asoc', 'Número de las asociación de actores/directores', 'required');
		$this->form_validation->set_rules('pais', 'País', 'required');
		//Diccionario de datos
		$data['personas'] = $this->personas_model->get_person($id);
		$data['title'] = "Editar ".$data['personas']['nombre']." ".$data['personas']['apellidos'];
		$data['paises'] = $this->paises_model->get_paises();
		$data['titulo'] = "Actores/Directores";
		$data['breadcrumbs'] = array(
			array(
				'nombre' => 'Actores/Directores',
				'icono' => 'fa fa-star',
				'link' =>  'admin/personas'
				),
			array(
				'nombre' => "Editar ".$data['personas']['nombre']." ".$data['personas']['apellidos'],
				'icono' => 'fa fa-edit',
				'link' =>  false
				)
			);
		//Carga de vistas
		$this->load->view('admin/templates/head_html',$data);
		$this->load->view('admin/templates/main_menu');
		$this->load->view('admin/templates/head_menu');
		$this->load->view('admin/edit_personas',$data);
		$this->load->view('admin/templates/footer_html');
	}

	public function update($id){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['personas'] = $this->personas_model->get_person($id);
		$data['title'] = "Editar ".$data['personas']['nombre']." ".$data['personas']['apellidos'];
		$data['paises'] = $this->paises_model->get_paises();
		$data['titulo'] = "Actores/Directores";
		$data['breadcrumbs'] = array(
			array(
				'nombre' => 'Actores/Directores',
				'icono' => 'fa fa-star',
				'link' =>  'admin/personas'
				),
			array(
				'nombre' => "Editar ".$data['personas']['nombre']." ".$data['personas']['apellidos'],
				'icono' => 'fa fa-edit',
				'link' =>  false
				)
			);

		//reglas de validación
		$this->form_validation->set_rules('nombre','nombre','required');
		$this->form_validation->set_rules('apellidos','apellidos','required');
		$this->form_validation->set_rules('asoc', 'Número de las asociación de actores/directores', 'required');
		$this->form_validation->set_rules('pais', 'País', 'required');

		if ($this->form_validation->run() === FALSE){
			$this->load->view('admin/templates/head_html',$data);
			$this->load->view('admin/templates/main_menu');
			$this->load->view('admin/templates/head_menu');
			$this->load->view('admin/edit_personas',$data);
			$this->load->view('admin/templates/footer_html');

		} else {

			$arr_insert = array(
				'nombre' =>	$this->input->post('nombre', TRUE) , 
				'apellidos'	=>	$this->input->post('apellidos', TRUE),
				'num_asoc'	=>	$this->input->post('asoc', TRUE),
				'iso_pais' =>	$this->input->post('pais',TRUE)
			);

			$this->personas_model->update($arr_insert,$id);
			//falta control de errores

			redirect('admin/personas');

		}
	}
}