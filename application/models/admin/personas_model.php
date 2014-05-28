<?php 
	class Personas_model extends CI_Model {

		public function __construct(){
			$this->load->database();
		}

		public function get_person($id = FALSE) {

			if ($id === FALSE)//si no nos preguntan por una noticia en concreto
			{   //nos devuelve todas
				$query = $this->db->get('personas');// =  'SELECT * FROM personas'
				return $query->result_array();//devuelve todas las filas de la tabla en un array
			}

			$query = $this->db->get_where('personas', array('id_persona' => $id));//en el caso de que nos indiquen una persona en concreto pues nos devuelve la que se ha solicitado
			return $query->row_array();//nos devuelve la primera
		}

		public function delete($id){
			if($this->db->delete('personas', array('id_persona' => $id))) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		public function update ($arr_insert,$id){
			$this->db->where('id_persona', $id);
			$this->db->update('personas', $arr_insert); 
		}

		public function insert($arr_insert){
			$this->db->insert('personas',$arr_insert);
		}

	}