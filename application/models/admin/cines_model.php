<?php

class Cines_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get() {
       // if ($slug === FALSE) {
            // select * from news;
            $this->db->order_by('nombre','asc');
            $query = $this->db->get('cines');
            // result_array-> devuelve todas las filas en un array.
            return $query->result_array();
       
    }
    public function get_salas($id_cine='') {
       // if ($slug === FALSE) {
            // select * from news;
            $this->db->where('id_cine',$id_cine);
            $this->db->order_by('nombre','asc');
            $query = $this->db->get('salas');
            // result_array-> devuelve todas las filas en un array.
            return $query->result_array();
       
    }
    
    public function get_cine($id=''){
         $this->db->where('id_cine',$id);
            $query = $this->db->get('cines');
        //$query="select * from cines where id_cine=".$id;
         return $query->row_array();
    }
    
     public function insert($arr_insert) {
         
         //$this->db->insert('cines',$arr_insert);
          if($this->db->insert('cines',$arr_insert)){
             return $this->db->insert_id();
         }else{
             return false;
         }
        
    }
    
      public function insert_sala($arr_insert) {
         
         //$this->db->insert('cines',$arr_insert);
          if($this->db->insert('salas',$arr_insert)){
             return $this->db->insert_id();
         }else{
             return false;
         }
        
    }
     public function update($id,$arr_insert) {
         $this->db->where('id_cine',$id);
         if($this->db->update('cines',$arr_insert)){
             return true;
         }else{
             return false;
         }
         
         
        
    }
     public function delete($id) {
         
         if($this->db->delete('cines',array('id_cine'=>$id))){
             return true;
         }else{
             return false;
         }
        
    }

}
