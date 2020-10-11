<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->library('form_validation');
        $this->load->model('pegawai_model');
		
	}
    function index() {
        
        $data = array(
            'header' => "Data Pegawai",
            'pegawai'    => $this->pegawai_model->get_pegawai(),
        );
        //var_dump($data);
        $this->template->load('master', 'pegawai/pegawai_list', $data);
    }



   

}