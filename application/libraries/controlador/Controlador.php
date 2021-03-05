<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador extends CI_Controller {

    public $modelo = 'no definido';

    public function __construct($modelo) {
        parent::__construct();
        $this->modelo = $modelo;
        $this->load->model($modelo.'_model');
    }

	public function index()
	{
        header('Content-Type: application/json');
        echo $this->modelo;
    }
    
    public function get() {        
        $default = array('id');
        $datos = $this->uri->uri_to_assoc(3, $default);
        $result = $this->{$this->modelo.'_model'}->get($datos['id']);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function post() {
        header('Content-Type: application/json');
        echo 'POST';
    }

    public function put() {
        header('Content-Type: application/json');
        echo 'PUT';
    }

    public function list() {
        $default = array('offset', 'limit', 'campo', 'orden');
        $datos = $this->uri->uri_to_assoc(3, $default);
        if ($datos['offset'] === NULL) {
            $datos['offset'] = 0;
        }
        if ($datos['limit'] === NULL) {
            $datos['limit'] = 10;
        }
        $result = $this->{$this->modelo.'_model'}->list($datos);
        header('Content-Type: application/json');
        $out = array(
            'items' => $result,
            'limit' => $datos['limit'],
            'offset' => $datos['offset']
        );
        echo json_encode($out);        
    }
}