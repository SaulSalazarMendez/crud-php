<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'libraries/modelo/Modelo.php';
class Persona_model extends Modelo {

    public function __construct()
    {
        parent::__construct('persona', 'id_persona');
    }
}