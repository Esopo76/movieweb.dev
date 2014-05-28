<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

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
		$this->load->model('admin/administradores');
		$this->load->model('admin/paises_model');
	}

	public function index(){
		$this->listado();
	}

	public function listado(){
		$data['administradores'] = $this->administradores->list_user();
		$data['title'] = "Listado de usuario";
		$data['titulo'] = "Usuarios";
		$data['subtitulo'] ="Listado";
		$data['breadcrumbs'] = array(
			array(
				'nombre' => 'Usuarios',
				'icono' => 'fa fa-user',
				'link' =>  'admin/usuarios'
				),
			array(
				'nombre' => 'Listado usuarios',
				'icono' => 'fa fa-users',
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
		$this->load->view('admin/admin_list',$data);
		$this->load->view('admin/templates/footer_html');
	}

	public function delete($id){
		$data['administradores'] = $this->administradores->list_user();
		$data['title'] = "Listado de usuario";
		$data['titulo'] = "Administradores";
		
		
		if($this->administradores->del_user($id)) {
		$data['eliminada'] = $id;
		$data['administradores'] = $this->administradores->list_user();
		$data['title'] = "Listado de usuario";
		$data['titulo'] = "Usuarios";
		$data['subtitulo'] ="Listado";
		$data['breadcrumbs'] = array(
			array(
				'nombre' => 'Usuarios',
				'icono' => 'fa fa-user',
				'link' =>  'admin/usuarios'
				),
			array(
				'nombre' => 'Listado usuarios',
				'icono' => 'fa fa-users',
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
		$this->load->view('admin/admin_list',$data);
		$this->load->view('admin/templates/footer_html');
		}
	}

	public function add(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['administradores'] = $this->administradores->list_user();
		$data['title'] = "Listado de usuario";
		$data['titulo'] = "Usuarios";
		$data['subtitulo'] ="Listado";
		$data['breadcrumbs'] = array(
			array(
				'nombre' => 'Usuarios',
				'icono' => 'fa fa-user',
				'link' =>  'admin/usuarios'
				),
			array(
				'nombre' => 'Añadir usuario',
				'icono' => 'fa fa-edit',
				'link' =>  false
				)
			);

		//reglas de validación
		$this->form_validation->set_rules('usuario','usuario','required');
		$this->form_validation->set_rules('password','contraseña','required');
		$this->form_validation->set_rules('email', 'Correo electrónico', 'required');

		if ($this->form_validation->run() === FALSE){
			$this->load->view('admin/templates/head_html',$data);
			$this->load->view('admin/templates/main_menu');
			$this->load->view('admin/templates/head_menu');
			$this->load->view('admin/edit_admin',$data);
			$this->load->view('admin/templates/footer_html');

		} else {

			$arr_insert = array(
				'usuario' =>	$this->input->post('usuario', TRUE) , 
				'contrasena'	=>	md5($this->input->post('password', TRUE)),
				'email'	=>	$this->input->post('email', TRUE)
			);

			
			$this->administradores->insert($arr_insert);
			//falta control de errores

			$data['añadida'] = TRUE;
			$data['administradores'] = $this->administradores->list_user();
			$data['title'] = "Listado de usuario";
			$data['titulo'] = "Usuarios";
			$data['subtitulo'] ="Listado";
			$data['breadcrumbs'] = array(
				array(
					'nombre' => 'Usuarios',
					'icono' => 'fa fa-user',
					'link' =>  'admin/usuarios'
					),
				array(
					'nombre' => 'Listado usuarios',
					'icono' => 'fa fa-users',
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
			$this->load->view('admin/admin_list',$data);
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
		$data['administrador'] = $this->administradores->list_user($id);
		$data['title'] = "Listado de usuario";
		$data['titulo'] = "Usuarios";
		$data['breadcrumbs'] = array(
			array(
				'nombre' => 'Usuarios',
				'icono' => 'fa fa-user',
				'link' =>  'admin/usuarios'
				),
			array(
				'nombre' => 'Editar usuario '.$data['administrador']['usuario'],
				'icono' => 'fa fa-edit',
				'link' =>  false
				)
			);
		//Carga de vistas
		$this->load->view('admin/templates/head_html',$data);
		$this->load->view('admin/templates/main_menu');
		$this->load->view('admin/templates/head_menu');
		$this->load->view('admin/edit_admin',$data);
		$this->load->view('admin/templates/footer_html');
	}

	public function update($id){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['administrador'] = $this->administradores->list_user($id);
		$data['title'] = "Editar usuario: ".$data['administradores']['usuario'];

		//reglas de validación
		$this->form_validation->set_rules('usuario','usuario','required');
		$this->form_validation->set_rules('password','contraseña','required');
		$this->form_validation->set_rules('email', 'Correo electrónico', 'required');

		if ($this->form_validation->run() === FALSE){
			$this->load->view('admin/templates/head_html',$data);
			$this->load->view('admin/templates/main_menu');
			$this->load->view('admin/templates/head_menu');
			$this->load->view('admin/edit_admin',$data);
			$this->load->view('admin/templates/footer_html');

		} else {

			$arr_insert = array(
				'usuario' =>	$this->input->post('usuario', TRUE) , 
				'contrasena'	=>	md5($this->input->post('password', TRUE)),
				'email'	=>	$this->input->post('email', TRUE),
			);

			$this->administradores->update($arr_insert,$id);
			//falta control de errores

			redirect('admin/usuarios');

		}
	}
}