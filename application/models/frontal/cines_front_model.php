<?php

class Cines_front_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	public function list_cines() {
			$query = $this->db->get('cines');// =  'SELECT * FROM administradores'
			return $query->result_array();//devuelve todas las filas de la tabla en un array
		}

	public function list_cartelera() {
		$this->db->select("i.id_pelicula as id, i.url_imagen as url, i.titulo as imagen, p.titulo_dist as titulo_p , p.ano_produccion as anho, duracion, p.f_estreno_bcn estreno, c.descripcion descripcion FROM imagenes i INNER JOIN peliculas p ON i.id_pelicula = p.id_pelicula INNER JOIN calificaciones c ON c.id_calificacion = p.id_calificacion WHERE principal_sn = 1");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_estrenos() {
		$this->db->select("i.id_pelicula as id, i.url_imagen as url, i.titulo as imagen, p.titulo_dist as titulo_p , p.ano_produccion as anho, duracion, p.f_estreno_bcn estreno, c.descripcion descripcion FROM imagenes i INNER JOIN peliculas p ON i.id_pelicula = p.id_pelicula INNER JOIN calificaciones c ON c.id_calificacion = p.id_calificacion WHERE principal_sn = 1 ORDER BY estreno DESC LIMIT 6");
		$query = $this->db->get();
		return $query->result_array();
	}

}