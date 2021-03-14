<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'libraries/modelo/Modelo.php';
class Sexo_model extends Modelo {

    public function __construct()
    {
        parent::__construct('sexo', 'id_sexo');
    }
}