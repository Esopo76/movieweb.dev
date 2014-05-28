<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Peliculas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('admin/pelicula');
    }
    
    public function listado($id_peli = FALSE){      
        
       $data = array('title' => 'Listado películas',
               'titulo' => 'Películas',
               'subtitulo' => 'listado',
               'breadcrumbs' => array(
                   array(
                       'nombre' => 'Películas',
                       'icono' => 'fa fa-video-camera',
                       'link' => 'admin'),
                   array(
                       'nombre' => 'Listado',
                       'icono' => 'fa fa-list',
                       'link' => false)
               ),
               'peliculas' => $this->pelicula->listado($id_peli)
        );
        $this->load->view('admin/templates/head_html');
        $this->load->view('admin/templates/main_menu');
        $this->load->view('admin/templates/head_menu');
        $this->load->view('admin/list_pelis',$data);
        $this->load->view('admin/templates/footer_html');
    }

    public function add() {
        $this->load->library('form_validation');
        //validacion del formulario
        $this->form_validation->set_rules('tit_ori', 'Titulo', 'required');
        $this->form_validation->set_rules('tit_dist', 'Titulo distribución', 'required');
        $this->form_validation->set_rules('ano', 'Año', 'required');
        $this->form_validation->set_rules('url_web', 'Dirección web película', 'required');
        $this->form_validation->set_rules('url_imdb', 'Dirección web imdb', 'required');
        $this->form_validation->set_rules('duracion', 'Duración', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha de estreno', 'required');
        $this->form_validation->set_rules('valoracion', 'Valoración', 'required');
        $this->form_validation->set_rules('resumen', 'Sinopsis', 'required');

        if ($this->form_validation->run() === FALSE) {  //Es la primera llamada, mostramos el formulario de añadir pelicula

            $data = array('title' => 'Añadir película',
                   'titulo' => 'Películas',
                   'subtitulo' => 'Añadir película',
                   'breadcrumbs' => array(
                       array(
                           'nombre' => 'Películas',
                           'icono' => 'fa fa-video-camera',
                           'link' => 'admin'),
                       array(
                           'nombre' => 'Añadir película',
                           'icono' => 'fa fa-plus',
                           'link' => false)
                   ),
                   'calificaciones' => $this->pelicula->get_list_calificaciones(),
                   'idiomas' => $this->pelicula->get_list_idiomas()
            );
            $this->load->view('admin/templates/head_html');
            $this->load->view('admin/templates/main_menu');
            $this->load->view('admin/templates/head_menu');
            $this->load->view('admin/add_peli',$data);
            $this->load->view('admin/templates/footer_html');
            
        } else {
            
            if (!empty($_FILES['img1']['name'])) { //la imagen pral está informada
                $arr_insert =  array(
                    'titulo_ori' => $this->input->post('tit_ori'), //obtenemos los campos del POST
                    'titulo_dist' => $this->input->post('tit_dist'), 
                    'iso_idioma' => $this->input->post('iso_idioma'),
                    'ano_produccion' => $this->input->post('ano'),
                    'url_web' => $this->input->post('url_web'),
                    'url_imdb' => $this->input->post('url_imdb'),
                    'duracion' => $this->input->post('duracion'),
                    'id_calificacion' => $this->input->post('calificacion'),
                    'f_estreno_bcn' => $this->input->post('fecha'),
                    'resumen' => $this->input->post('resumen'),
                    'valoracion' => $this->input->post('valoracion'),
                );
                $id_peli = $this->pelicula->ins_peli($arr_insert);

                //tratameinto de la imagen principal
                $url_img = base_url().'images';
                $nombre = $id_peli.'_'.$_FILES['img1']['name'];
                $arr_insert =  array(                
                    'id_pelicula' => $id_peli,
                    'url_imagen' => $url_img,
                    'titulo' => $nombre,
                    'principal_sn' => 1
                );                    
                $id_img = $this->pelicula->ins_img($arr_insert);

                $config['upload_path'] = './images/';
                if ( !is_dir($config['upload_path'])) {
                    die("No existe el directorio para subir las imagenes");                
                }
                $config['allowed_types'] = 'gif|jpg|png';
                $config['overwrite'] = TRUE;
                $config['file_name'] = $nombre; //renombramos el fichero que subimos

                $this->load->library('upload', $config);
                $file_name = "img1";
                $this->upload->do_upload($file_name);
            
                //tratamos los doblajes
                if (isset($_POST['audio'])) {
                    foreach ($this->input->post('audio') as $item){
                        $arr_audio[$item] = array('aud' =>1,'sub'=>0);
                    }
                    if (isset($_POST['sub'])) {
                        foreach ($this->input->post('sub') as $item){
                            if (array_key_exists($item, $arr_audio)) {
                                $arr_audio[$item] = array('aud'=>1,'sub'=>1);
                            } else {
                                $arr_audio[$item] = array('aud'=>0,'sub'=>1);
                            }
                        }
                    }
                    foreach ($arr_audio as $key => $item){
                        $arr_insert =  array(                
                        'id_pelicula' => $id_peli,
                        'iso_idioma' => $key,
                        'audio_sn' => $item['aud'],
                        'subtitulos_sn' => $item['sub']
                         );                    
                         $id_img = $this->pelicula->ins_doblaje($arr_insert);         
                    }  
                }

                //mostramos el formulario con los botones habilitados 8imagenes, videos, reparto
                $data = array('title' => 'Añadir película',
                   'titulo' => 'Películas',
                   'subtitulo' => 'Añadir película',
                   'breadcrumbs' => array(
                       array(
                           'nombre' => 'Películas',
                           'icono' => 'fa fa-video-camera',
                           'link' => 'admin'),
                       array(
                           'nombre' => 'Añadir película',
                           'icono' => 'fa fa-plus',
                           'link' => false)
                   ),
                   'calificaciones' => $this->pelicula->get_list_calificaciones(),
                   'idiomas' => $this->pelicula->get_list_idiomas(),
                   'alta' => true,
                   'id_peli' => $id_peli
                );
                $this->load->view('admin/templates/head_html');
                $this->load->view('admin/templates/main_menu');
                $this->load->view('admin/templates/head_menu');
                $this->load->view('admin/add_peli',$data);
                $this->load->view('admin/templates/footer_html');
                
            } else { //No se ha seleccionado una imagen principal
                $this->load->library('upload');
                $data = array('title' => 'Añadir película',
                       'titulo' => 'Películas',
                       'subtitulo' => 'Añadir película',
                       'breadcrumbs' => array(
                           array(
                               'nombre' => 'Películas',
                               'icono' => 'fa fa-video-camera',
                               'link' => 'admin'),
                           array(
                               'nombre' => 'Añadir película',
                               'icono' => 'fa fa-plus',
                               'link' => false)
                       ),
                       'error' => 'La imagen principal es obligatoria',
                       'calificaciones' => $this->pelicula->get_list_calificaciones(),
                       'idiomas' => $this->pelicula->get_list_idiomas()
                );
                $this->load->view('admin/templates/head_html');
                $this->load->view('admin/templates/main_menu');
                $this->load->view('admin/templates/head_menu');
                $this->load->view('admin/add_peli',$data);
                $this->load->view('admin/templates/footer_html');                
            }
        }
    }
    
    public function eliminar($id_peli){
        $this->pelicula->del_peli($id_peli);
        $this->pelicula->del_img_folder($id_peli); //borramos las img del servidor
        $data = array('title' => 'Listado películas',
               'titulo' => 'Películas',
               'subtitulo' => 'listado',
               'breadcrumbs' => array(
                   array(
                       'nombre' => 'Películas',
                       'icono' => 'fa fa-video-camera',
                       'link' => 'admin'),
                   array(
                       'nombre' => 'Listado',
                       'icono' => 'fa fa-list',
                       'link' => false)
               ),
               'mostrar_msg' => true,
               'msg' => 'Película eliminada correctamente',
               'peliculas' => $this->pelicula->listado()
        );
        $this->load->view('admin/templates/head_html');
        $this->load->view('admin/templates/main_menu');
        $this->load->view('admin/templates/head_menu');
        $this->load->view('admin/list_pelis',$data);
        $this->load->view('admin/templates/footer_html');
    }
    
    public function reparto($id_peli){
        $this->load->library('form_validation');
        //validacion del formulario
        $this->form_validation->set_rules('persona', 'Persona', 'required');
        $this->form_validation->set_rules('personaje', 'Personaje', 'required');        
                
        $this->load->model('admin/personas_model');
        
        $data = array('title' => 'Reparto película',
                   'titulo' => 'Películas',
                   'subtitulo' => 'listado',
                   'breadcrumbs' => array(
                       array(
                           'nombre' => 'Películas',
                           'icono' => 'fa fa-video-camera',
                           'link' => 'admin'),
                       array(
                           'nombre' => 'Reparto',
                           'icono' => 'fa fa-list',
                           'link' => false)
                   ),              
                   'pelicula' => $this->pelicula->listado($id_peli),
                   'personas' => $this->personas_model->get_person(),
                   'reparto' => $this->pelicula->reparto($id_peli)
            );
        
        if ($this->form_validation->run() !== FALSE) {  
       
            if ($this->input->post('actor') == 0) {
                $director = 1;
            } else {
                $director = 0;
            }
            $arr_insert =  array(
                    'id_pelicula' => $id_peli,
                    'id_persona' => $this->input->post('persona'), 
                    'actor_sn' => $this->input->post('actor'),
                    'director_sn' => $director,
                    'personaje' => $this->input->post('personaje')
                );
            $this->pelicula->ins_reparto($arr_insert);
            
//            $data = array('title' => 'Reparto película',
//                   'titulo' => 'Películas',
//                   'subtitulo' => 'listado',
//                   'breadcrumbs' => array(
//                       array(
//                           'nombre' => 'Películas',
//                           'icono' => 'fa fa-video-camera',
//                           'link' => 'admin'),
//                       array(
//                           'nombre' => 'Reparto',
//                           'icono' => 'fa fa-list',
//                           'link' => false)
//                   ),              
//                   'pelicula' => $this->pelicula->listado($id_peli),
//                   'personas' => $this->personas_model->get_person(),
//                   'reparto' => $this->pelicula->reparto($id_peli)
//            );
//            $this->load->view('admin/templates/head_html');
//            $this->load->view('admin/templates/main_menu');
//            $this->load->view('admin/templates/head_menu');
//            $this->load->view('admin/reparto',$data);
//            $this->load->view('admin/templates/footer_html');                  
        }
        
        $this->load->view('admin/templates/head_html');
        $this->load->view('admin/templates/main_menu');
        $this->load->view('admin/templates/head_menu');
        $this->load->view('admin/reparto',$data);
        $this->load->view('admin/templates/footer_html');
        
    }
    
    public function eliminar_reparto($id_peli, $id_reparto){
        $this->pelicula->del_reparto($id_reparto);
        $this->reparto($id_peli);
    }



}
