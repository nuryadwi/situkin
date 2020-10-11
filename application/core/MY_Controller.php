<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->userdata = $this->session->userdata('id_user');
        $this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));
		
	}
    public function sess_notif()
    {

        if($this->userdata !=''){
            $data = $this->user_model->select($this->userdata->id);

            $this->session->set_userdata('id_user', $data);
            $this->userdata = $this->session->userdata('id_user');
        }
    }
}