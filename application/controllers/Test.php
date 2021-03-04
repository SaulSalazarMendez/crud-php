<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'libraries/controlador/Controlador.php';

class Test extends Controlador {

    public function __construct() {
        parent::__construct('test');        
    }
}
