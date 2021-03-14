<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function inicializa() {
    header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Content-Type: application/json');
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Accept, Referer");        
}

class Controlador extends CI_Controller {

    public $modelo = 'no definido';

    public function __construct($modelo) {
        parent::__construct();
        $this->modelo = $modelo;
        $this->load->model($modelo.'_model');
    }

	public function index()
	{
        inicializa();
        $out = array(
            'modelo' => $this->modelo
        );
        echo json_encode($out);
    }
    
    public function get() {
        inicializa();        
        $default = array('id');
        $datos = $this->uri->uri_to_assoc(3, $default);
        $result = $this->{$this->modelo.'_model'}->get($datos['id']);        
        echo json_encode($result);
    }

    public function post() {
        inicializa();        
        $obj = file_get_contents('php://input');
        $json = json_decode($obj);
        $dato = $this->{$this->modelo.'_model'}->post($json);
        $out = array(
            'item' => $dato
        );
        echo json_encode($out);
    }

    public function put() {        
        inicializa();        
        $default = array('id');
        $datos = $this->uri->uri_to_assoc(3, $default);
        $obj = file_get_contents('php://input');
        $json = json_decode($obj);
        $dato = $this->{$this->modelo.'_model'}->put($datos['id'], $json);
        $out = array(
            'success' => $dato
        );        
        http_response_code(201);
        echo json_encode($out);
    }

    public function list() {
        inicializa();
        $default = array('offset', 'limit', 'campo', 'orden');
        $datos = $this->uri->uri_to_assoc(3, $default);
        if ($datos['offset'] === NULL) {
            $datos['offset'] = 0;
        }
        if ($datos['limit'] === NULL) {
            $datos['limit'] = 10;
        }
        $result = $this->{$this->modelo.'_model'}->list($datos);
        $n = $this->{$this->modelo.'_model'}->count();        
        $out = array(
            'items' => $result,
            'limit' => $datos['limit'],
            'offset' => $datos['offset'],
            'total' => $n['0']->n
        );
        echo json_encode($out);        
    }
}