<?php
class Blokir extends CI_Controller{
    
    
    function index(){
    	$data = array('header' => "Blokir");
        $this->load->view('auth/blokir_akses', $data);
    }
}