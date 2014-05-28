<?php

class Pelicula extends CI_Model {

	function __construct(){
            parent::__construct();
            $this->load->database();
	}

	function get_list_idiomas(){
            
		$this->db->where('principal', 1);
                $this->db->order_by('nombre','asc'); 
		$query = $this->db->get('idiomas');

		return $query->result_array();
	}
        
        function get_list_calificaciones(){

		$query = $this->db->get('calificaciones');

		return $query->result_array();
	}
        
        function ins_peli($arr_insert) {
            $this->db->insert('peliculas',$arr_insert); 
            return $this->db->insert_id();
        
        }
        
        function ins_img($arr_insert) {
            $this->db->insert('imagenes',$arr_insert); 
            return $this->db->insert_id();
        
        }
        
        function listado($id_peli = FALSE){
            
            if ($id_peli === FALSE){
                $this->db->order_by('id_pelicula','asc'); 
		$query = $this->db->get('peliculas');
                $retorno = $query->result_array();
                //obtenemos la img pral
                $this->db->where('principal_sn', 1);
                foreach ($retorno as $ind => $item) {
                    $this->db->where('id_pelicula', $item['id_pelicula']);
                    $query = $this->db->get('imagenes');
                    $row_img = $query->row_array();
                    if (isset($row_img['titulo'])) {
                        $retorno[$ind]['tit_img'] = $row_img['titulo'];
                        $retorno[$ind]['url_img'] = $row_img['url_imagen'];
                    } else {
                        $retorno[$ind]['tit_img'] = '';
                        $retorno[$ind]['url_img'] = '';
                    }
                }

		return $retorno;
                
            } else{
                $this->db->where('id_pelicula', $id_peli);
                $query = $this->db->get('peliculas');
                $retorno = $query->row_array();
//            echo '<pre>';
//             print_r($retorno);
//             echo '</pre>';
                $this->db->where('principal_sn', 1);
                $this->db->where('id_pelicula', $retorno['id_pelicula']);
                $query = $this->db->get('imagenes');
                $row_img = $query->row_array();
                $retorno['tit_img'] = $row_img['titulo'];
                $retorno['url_img'] = $row_img['url_imagen'];
                return $retorno;                
            }
            
        }
        
        function ins_doblaje($arr_insert) {
            $this->db->insert('doblaje',$arr_insert); 
        
        }
        
        function del_peli($id_peli) {
            $this->db->where('id_pelicula',$id_peli);
            $this->db->delete('peliculas'); 
        
        }
        
        function del_img_folder($id_peli) {
		$prefix = $id_peli.'_';
		
		array_map('unlink', glob("images/$prefix*.*"));
	}
        
        function reparto($id_peli){
//            $this->db->where('id_pelicula', $id_peli);
//            $query = $this->db->get('reparto');
            $query = $this->db->select( 'id_reparto, id_pelicula, actor_sn, director_sn, personaje, nombre, apellidos FROM reparto a, personas b WHERE a.id_persona = b.id_persona;' );
            $query = $this->db->get();
            return $query->result_array();            
        }
        
        function ins_reparto($arr_insert) {
            $this->db->insert('reparto',$arr_insert); 
        
        }


}