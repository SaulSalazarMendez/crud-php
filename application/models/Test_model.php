<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'libraries/modelo/Modelo.php';
class Test_model extends Modelo {

    public function __construct()
    {
        parent::__construct('test', 'tabla_id');
    }
}