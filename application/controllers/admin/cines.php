<?php

class Cines extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/cines_model');
        $this->load->library('session');
    }

    public function index() {
        
    }

    public function listado($men = '') {
        $data['mensaje'] = $men;
        $data['cines'] = $this->cines_model->get();
        $data['titulo'] = "Cines";
        $data['subtitulo'] = "Listado";
        $data['breadcrumbs'] = array(
            array(
                'nombre' => 'Cines',
                'icono' => 'fa fa-university',
                'link' => 'admin'
            ),
            array(
                'nombre' => 'Listado de cines',
                'icono' => 'fa fa-list',
                'link' => false
            )
        );


        $this->load->view('admin/templates/head_html');
        $this->load->view('admin/templates/main_menu');
        $this->load->view('admin/templates/head_menu');
        $this->load->view('admin/cines/listado', $data);
        $this->load->view('admin/templates/footer_html');
    }

    public function listado_salas($id_cine, $men = '') {
        $data['mensaje'] = $men;
        $data['salas'] = $this->cines_model->get_salas();
        $data['titulo'] = "Cines";
        $data['subtitulo'] = "Listado";
        $data['breadcrumbs'] = array(
            array(
                'nombre' => 'Cines',
                'icono' => 'fa fa-university',
                'link' => 'admin'
            ),
            array(
                'nombre' => 'Listado de cines',
                'icono' => 'fa fa-list',
                'link' => false
            )
        );


        $this->load->view('admin/templates/head_html');
        $this->load->view('admin/templates/main_menu');
        $this->load->view('admin/templates/head_menu');
        $this->load->view('admin/cines/listado', $data);
        $this->load->view('admin/templates/footer_html');
    }

    public function add() {
        $this->load->library('form_validation');
        $data['titulo'] = "Cines";
        $data['subtitulo'] = "añadir cine";
        $data['breadcrumbs'] = array(
            array(
                'nombre' => 'Cines',
                'icono' => 'fa fa-university',
                'link' => 'admin'
            ),
            array(
                'nombre' => 'Añadir cine',
                'icono' => 'fa fa-plus',
                'link' => false
            )
        );
        //reglas de validacion
        //$this->form_validation->set_rules('title', 'Título', 'required|alpha_numeric');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('calle', 'Calle', 'required');
        $this->form_validation->set_rules('numero', 'Número', 'required');
        $this->form_validation->set_rules('poblacion', 'Población', 'required');
        $this->form_validation->set_rules('latitud', 'Latitud', 'required');
        $this->form_validation->set_rules('longitud', 'Longitud', 'required');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        // $this->form_validation->set_rules('text', 'Texto', 'trim'); si no hay que controlarlo, mejor ponerla con trim

        if ($this->form_validation->run() === FALSE) {
            $data['nombre'] = $this->input->post('nombre', true);
            $data['calle'] = $this->input->post('calle', true);
            $data['numero'] = $this->input->post('numero', true);
            $data['poblacion'] = $this->input->post('poblacion', true);
            $data['latitud'] = $this->input->post('latitud', true);
            $data['longitud'] = $this->input->post('longitud', true);
            $data['telefono'] = $this->input->post('telefono', true);
            $data['email'] = $this->input->post('email', true);


            $this->load->view('admin/templates/head_html');
            $this->load->view('admin/templates/main_menu');
            $this->load->view('admin/templates/head_menu');
            $this->load->view('admin/cines/add', $data);
            $this->load->view('admin/templates/footer_html');
        } else {
            //$data['mensaje'] = $men;
            $arr_insert = array();
            $arr_insert['nombre'] = $this->input->post('nombre', true);
            $arr_insert['calle'] = $this->input->post('calle', true);
            $arr_insert['numero'] = $this->input->post('numero', true);
            $arr_insert['poblacion'] = $this->input->post('poblacion', true);
            $arr_insert['latitud'] = $this->input->post('latitud', true);
            $arr_insert['longitud'] = $this->input->post('longitud', true);
            $arr_insert['telefono'] = $this->input->post('telefono', true);
            $arr_insert['email'] = $this->input->post('email', true);

            /*
              echo "<pre>";
              print_r($arr_insert);
              echo "</pre>";
             */
            $data['nombre'] = $this->input->post('nombre', true);
            $data['calle'] = $this->input->post('calle', true);
            $data['numero'] = $this->input->post('numero', true);
            $data['poblacion'] = $this->input->post('poblacion', true);
            $data['latitud'] = $this->input->post('latitud', true);
            $data['longitud'] = $this->input->post('longitud', true);
            $data['telefono'] = $this->input->post('telefono', true);
            $data['email'] = $this->input->post('email', true);
            $id = 0;
            if ($id = $this->cines_model->insert($arr_insert)) {
                $data['mensaje'] = "cine dado de alta con id " . $id;
                $data['realizado'] = "ok";
                //$this->listado($men);

                $this->load->view('admin/templates/head_html');
                $this->load->view('admin/templates/main_menu');
                $this->load->view('admin/templates/head_menu');
                $this->load->view('admin/cines/add', $data);
                $this->load->view('admin/templates/footer_html');
            } else {
                $data['mensaje'] = "no se ha podido dar de alta";

                $this->load->view('admin/templates/head_html');
                $this->load->view('admin/templates/main_menu');
                $this->load->view('admin/templates/head_menu');
                $this->load->view('admin/cines/add', $data);
                $this->load->view('admin/templates/footer_html');
            }
        }
    }

    public function add_sala($id_cine) {
        $this->load->library('form_validation');
        $data['titulo'] = "Salas";
        $data['subtitulo'] = "añadir sala";
        $data['breadcrumbs'] = array(
            array(
                'nombre' => 'Salas',
                'icono' => 'fa fa-university',
                'link' => 'admin'
            ),
            array(
                'nombre' => 'Añadir sala',
                'icono' => 'fa fa-plus',
                'link' => false
            )
        );
        //reglas de validacion
        //$this->form_validation->set_rules('title', 'Título', 'required|alpha_numeric');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('butacas', 'Butacas', 'required');

        // $this->form_validation->set_rules('text', 'Texto', 'trim'); si no hay que controlarlo, mejor ponerla con trim

        if ($this->form_validation->run() === FALSE) {
            $data['nombre'] = $this->input->post('nombre', true);
            $data['butacas'] = $this->input->post('butacas', true);
            $data['id_cine'] = $id_cine;
            $data['salas'] = $this->cines_model->get_salas($id_cine);
            $this->load->view('admin/templates/head_html');
            $this->load->view('admin/templates/main_menu');
            $this->load->view('admin/templates/head_menu');
            $this->load->view('admin/cines/add_sala', $data);
            $this->load->view('admin/templates/footer_html');
        } else {
            //$data['mensaje'] = $men;
            $arr_insert = array();
            $arr_insert['id_cine'] = $id_cine;
            $arr_insert['num_sala'] = 0;
            $arr_insert['nombre'] = $this->input->post('nombre', true);
            $arr_insert['butacas'] = $this->input->post('butacas', true);

            // echo '-'.$this->input->post('disponible').'-';
            //exit;

            if ($this->input->post('disponible')) {
                $arr_insert['disponible_sn'] = 1;
            }



            /*
              echo "<pre>";
              print_r($arr_insert);
              echo "</pre>";
             */
            $data['nombre'] = $this->input->post('nombre', true);
            $data['butacas'] = $this->input->post('butacas', true);

            if ($this->input->post('disponible')) {
                $data['disponible'] = 1;
            }


            $id = 0;
            if ($id = $this->cines_model->insert_sala($arr_insert)) {
                $data['mensaje'] = "sala dada de alta con id " . $id;
                $data['realizado'] = "ok";
                $data['id_cine'] = $id_cine;
                //$this->listado($men);
                $data['salas'] = $this->cines_model->get_salas($id_cine);
                $this->load->view('admin/templates/head_html');
                $this->load->view('admin/templates/main_menu');
                $this->load->view('admin/templates/head_menu');
                $this->load->view('admin/cines/add_sala', $data);
                $this->load->view('admin/templates/footer_html');
            } else {
                $data['mensaje'] = "no se ha podido dar de alta";
                $data['id_cine'] = $id_cine;
                $data['salas'] = $this->cines_model->get_salas($id_cine);
                $this->load->view('admin/templates/head_html');
                $this->load->view('admin/templates/main_menu');
                $this->load->view('admin/templates/head_menu');
                $this->load->view('admin/cines/add_sala', $data);
                $this->load->view('admin/templates/footer_html');
            }
        }
    }

    public function edit($id) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        //Diccionario de datos
        $data['cines'] = $this->cines_model->get_cine($id);

        $data['id'] = $id;
        $data['nombre'] = $data['cines']['nombre'];
        $data['calle'] = $data['cines']['calle'];
        $data['numero'] = $data['cines']['numero'];
        $data['poblacion'] = $data['cines']['poblacion'];
        $data['latitud'] = $data['cines']['latitud'];
        $data['longitud'] = $data['cines']['longitud'];
        $data['telefono'] = $data['cines']['telefono'];
        $data['email'] = $data['cines']['email'];


        $data['titulo'] = "Cines";
        $data['subtitulo'] = "editar cine";
        $data['modificacion'] = "si";
        $data['breadcrumbs'] = array(
            array(
                'nombre' => 'Cines',
                'icono' => 'fa fa-university',
                'link' => 'admin'
            ),
            array(
                'nombre' => 'Modificar cine',
                'icono' => 'fa fa-plus',
                'link' => false
            )
        );

        $this->load->view('admin/templates/head_html');
        $this->load->view('admin/templates/main_menu');
        $this->load->view('admin/templates/head_menu');
        $this->load->view('admin/cines/add', $data);
        $this->load->view('admin/templates/footer_html');
    }

    public function update($id) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['id'] = $id;
        $data['nombre'] = $this->input->post('nombre', true);
        $data['calle'] = $this->input->post('calle', true);
        $data['numero'] = $this->input->post('numero', true);
        $data['poblacion'] = $this->input->post('poblacion', true);
        $data['latitud'] = $this->input->post('latitud', true);
        $data['longitud'] = $this->input->post('longitud', true);
        $data['telefono'] = $this->input->post('telefono', true);
        $data['email'] = $this->input->post('email', true);


        $data['titulo'] = "Cines";
        $data['subtitulo'] = "editar cine";
        $data['modificacion'] = "si";
        $data['breadcrumbs'] = array(
            array(
                'nombre' => 'Cines',
                'icono' => 'fa fa-university',
                'link' => 'admin'
            ),
            array(
                'nombre' => 'Modificar cine',
                'icono' => 'fa fa-plus',
                'link' => false
            )
        );
        //reglas de validacion
        //$this->form_validation->set_rules('title', 'Título', 'required|alpha_numeric');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('calle', 'Calle', 'required');
        $this->form_validation->set_rules('numero', 'Número', 'required');
        $this->form_validation->set_rules('poblacion', 'Población', 'required');
        $this->form_validation->set_rules('latitud', 'Latitud', 'required');
        $this->form_validation->set_rules('longitud', 'Longitud', 'required');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        // $this->form_validation->set_rules('text', 'Texto', 'trim'); si no hay que controlarlo, mejor ponerla con trim

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('admin/templates/head_html');
            $this->load->view('admin/templates/main_menu');
            $this->load->view('admin/templates/head_menu');
            $this->load->view('admin/cines/add', $data);
            $this->load->view('admin/templates/footer_html');
        } else {
            //$data['mensaje'] = $men;
            $arr_insert = array();
            $arr_insert['nombre'] = $this->input->post('nombre', true);
            $arr_insert['calle'] = $this->input->post('calle', true);
            $arr_insert['numero'] = $this->input->post('numero', true);
            $arr_insert['poblacion'] = $this->input->post('poblacion', true);
            $arr_insert['latitud'] = $this->input->post('latitud', true);
            $arr_insert['longitud'] = $this->input->post('longitud', true);
            $arr_insert['telefono'] = $this->input->post('telefono', true);
            $arr_insert['email'] = $this->input->post('email', true);

            /*
              echo "<pre>";
              print_r($arr_insert);
              echo "</pre>";
             */
            if ($this->cines_model->update($id, $arr_insert)) {
                $data['mensaje'] = "cine modificado";
                $data['realizado'] = "ok";
                //$this->listado($men);

                $this->load->view('admin/templates/head_html');
                $this->load->view('admin/templates/main_menu');
                $this->load->view('admin/templates/head_menu');
                $this->load->view('admin/cines/add', $data);
                $this->load->view('admin/templates/footer_html');
            } else {
                $data['mensaje'] = "no se ha podido dar de alta";
                $this->load->view('admin/templates/head_html');
                $this->load->view('admin/templates/main_menu');
                $this->load->view('admin/templates/head_menu');
                $this->load->view('admin/cines/add', $data);
                $this->load->view('admin/templates/footer_html');
            }
        }
    }

    public function delete($id = '') {
        if ($this->cines_model->delete($id)) {
            $men = "cine " . $id . " eliminado";
        } else {
            $men = "cine " . $id . "no de ha podido eliminar, es posible que contenga salas";
        }
        $this->listado($men);
    }

}
