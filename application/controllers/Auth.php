<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');

    }

	public function index()
	{   
        if($this->session->userdata('id_user')){
            redirect(site_url('home'));
        }
        else{
            $data['header'] = "Login";
            $this->load->view('auth/login_form', $data);
        }  
    }

    public function rules() 
    {
    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    $this->form_validation->set_message('required', '{field} wajib diisi');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    }
 
    public function ceklogin(){
        $this->rules();
        $username    = $this->input->post('username');
     
        $password    = $this->input->post('password',TRUE);
    
        if ($this->form_validation->run() == FALSE) {
        $this->index();
        
        } else {
            
            $hashPass = password_hash($password,PASSWORD_DEFAULT);
            $test     = password_verify($password, $hashPass);

            $this->db->where("username = '$username' && status =1 || id_user = '$id_user' && status = 1");
            
            
            $users       = $this->db->get('t_users');

            if($users->num_rows()>0){
                 $user = $users->row_array();
             if(password_verify($password,$user['password'])){

             $this->user_model->updateLoginTime($user['id_user']);
             $this->user_model->updateStatusOnline($user['id_user']);
             $this->session->set_userdata($user);

            $this->session->set_flashdata('message-welcome', 'Hallo! Selamat datang di Aplikasi Sistem Tunjangan Kinerja Desa Sidomulyo');
             redirect('home');
            }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert">Username atau password salah</div>');
            redirect('auth');
                }
            }else{
             $this->session->set_flashdata('message', '<div class="alert alert-danger alert">Username atau Password Tidak Ditemukan</div>');
             redirect('auth');
            }
        }  
    }

    function logout(){
        $id = $this->session->userdata('id_user');
        $this->user_model->updateStatusLogout($id);
        $this->session->sess_destroy();

        $this->session->set_flashdata('message','Anda sudah berhasil keluar dari aplikasi');
        redirect('auth');
    }

    
}
