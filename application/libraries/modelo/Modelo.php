<?php
class Modelo extends CI_Model {
    public $tabla;
    public $id;

    public function __construct($tabla, $id) {        
        parent::__construct();
        $this->tabla = $tabla;
        $this->id = $id;
        $this->load->database();
    }

    public function get($id) {        
        $this->db->where($this->id, $id);
        $query = $this->db->get($this->tabla);
        return $query->result();        
    }
}