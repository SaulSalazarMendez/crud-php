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

    public function list($datos) {
        $this->db->limit($datos['limit'], $datos['offset']);
        if ($datos['campo'] !== NULL) {
            $this->db->order_by($datos['campo'], $datos['orden']);
        }
        $query = $this->db->get($this->tabla);
        return $query->result();        
    }

    public function post($datos) {
        $this->db->insert($this->tabla,$datos);
        $id = $this->db->insert_id();
        $this->db->where($this->id, $id);
        $query = $this->db->get($this->tabla);
        return $query->result();        
    }

    public function count() {
        $query = $this->db->query("SELECT COUNT(*) as n FROM ".$this->tabla.';');        
        return $query->result();        
    }
}