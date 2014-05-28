<?php 
	class Paises_model extends CI_Model {

		public function __construct(){
			$this->load->database();
		}

		public function get_paises() {

				$query = $this->db->get('nacionalidades');// =  'SELECT * FROM personas'
				return $query->result_array();//devuelve todas las filas de la tabla en un array
		
		}
	}