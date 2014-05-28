<?php

class Administradores extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	public function get_user($user, $pass){

		$this->db->where('usuario', $user);
		$this->db->where('contrasena', md5($pass));
		$query = $this->db->get('administradores');

		return $query->row_array();
	}

	public function list_user($id = FALSE) {

			if ($id === FALSE)//si no nos preguntan por un usuario en concreto
			{   //nos devuelve todos
				$query = $this->db->get('administradores');// =  'SELECT * FROM administradores'
				return $query->result_array();//devuelve todas las filas de la tabla en un array
			}

			$query = $this->db->get_where('administradores', array('id_admin' => $id));//en el caso de que nos indiquen una persona en concreto pues nos devuelve la que se ha solicitado
			return $query->row_array();//nos devuelve la primera
		}

	public function update ($arr_insert,$id){
			$this->db->where('id_admin', $id);
			$this->db->update('administradores', $arr_insert); 
		}

	public function insert($arr_insert){

		$this->db->insert('administradores',$arr_insert);
	}

	public function del_user($id){

		if($this->db->delete('administradores', array('id_admin' => $id))) {
				return TRUE;
			} else {
				return FALSE;
			}
	}

}
