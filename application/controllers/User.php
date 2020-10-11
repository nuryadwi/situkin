<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
    {
				parent::__construct();
				is_login();
				$this->load->library('form_validation');
				$this->load->model('user_model');
				date_default_timezone_set('ASIA/JAKARTA');
		}
		
	public function index()
	{
		$data['data']		= $this->user_model->get_user();
		$data['header'] = "Manajemen Pengguna";
		$this->template->load('master', 'user/user_list', $data);
	}

	public function status(){
		if(!is_numeric($this->uri->segment(3)) || !is_numeric($this->uri->segment(4)))
		{
			redirect('user');
		}
		$this->user_model->update_status('t_users', ['status' => $this->uri->segment(3)], ['id_user ' => $this->uri->segment(4)]);
		redirect('user');
	}

	function reset_pass($id)
	{	
		$row = $this->user_model->get_by_id($id);
		$password = $row->username;
		$options = array('cost' => 4);
		$hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);
		$data = array(
			'password' => $hashPassword,
		);
		//print_r($data);
		$this->user_model->reset_pass($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-info">Password Berhasil Direset</div>');  
		redirect(site_url('user'));
	}
	

	public function rules()
	{	
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
		$this->form_validation->set_rules('id_role','Level User', 'trim|required');
		$this->form_validation->set_message('required', '{field} wajib diisi');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function create()
	{		
			$data = array( 
						'button'	=> 'Tambah',
						'header'		=> "Tambah Pengguna",
						'action'	=> site_url('user/create_action'),
						'jabatan'   => $this->user_model->getAllJabatan(),
						'bagian'    => $this->user_model->getBagian(),
				'id_user'  	=> set_value('id_user'),
				'username' => set_value('username'),
				'fullname' => set_value('full_name'),
				'nip'	=> set_value('nip'),
				'id_role' => set_value('id_role'),
				'jabatan_selected' => set_value('id_jabatan'),
				'bagian_selected' => set_value('id_bagian'),
				'status'      => 1
			);
			$this->template->load('master','user/user_form',$data);
		
	}
	function create_action()
	{
		$this->rules();
		if($this->form_validation->run() == FALSE) {
			$this->create();
		}else{
			if(! $this->user_model->isDuplicate($this->input->post('nip'))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">NIP sudah dipakai.</div>');
			 	redirect(base_url('user/create'));
		 	}else{
				$password = $this->input->post('username', TRUE);
				$options = array("cost" => 4);
				$hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);

				$data = array(
					'username' => $this->input->post('username', TRUE),
					'nip' 		=> $this->input->post('nip', TRUE),
					'password'		=> $hashPassword,
					'id_role' => $this->input->post('id_role',TRUE),
					'id_jabatan' => $this->input->post('id_jabatan',TRUE),
					'id_bagian' => $this->input->post('id_bagian',TRUE),
					'status' 		=>1,
					'create_on' => date('Y-m-d H:i:s'),
					'images'  => "user.png",
					'full_name' => $this->input->post('full_name', TRUE),
				);

			$this->user_model->insert($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Masuk</div>');
			redirect(site_url('user'));
			}
		}	
	}

	public function update($id)
	{
		$row = $this->user_model->get_by_id($id);
		if($row) {
			$data = array(
				'button' => 'Update',
				'header'		=> "Edit Data Pengguna",
				'action' => site_url('user/update_action'),
				'jabatan'   => $this->user_model->getAllJabatan(),
				'bagian'    => $this->user_model->getBagian(),
		'id_user'  	=> set_value('id_user', $row->id_user),
		'username'  	=> set_value('username', $row->username),
		'nip'	=> set_value('nip',$row->nip),
		'id_role' => set_value('id_role', $row->id_role),
		'jabatan_selected' => set_value('id_jabatan',$row->id_jabatan),
		'bagian_selected' => set_value('id_bagian', $row->id_bagian),
		'status'      => set_value('status',$row->status)
			);
		$this->template->load('master','user/user_form',$data);
		}else{
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert">Data tidak ditemukan</div>');
        redirect(site_url('user'));
		}
	}
	public function update_action(){
		$this->rules();
		if ($this->form_validation->run() == FALSE){
			$this->update($this->input->post('id_user', TRUE));
		}else{
			$data = array(
				'username' => $this->input->post('username', TRUE),
				'nip' => $this->input->post('nip', TRUE),
				'id_role' => $this->input->post('id_role',TRUE),
				'id_jabatan' => $this->input->post('id_jabatan',TRUE),
				'id_bagian' => $this->input->post('id_bagian',TRUE),
				'status'      => $this->input->post('status',TRUE)
			);
			
			$this->user_model->update($this->input->post('id_user', TRUE), $data);
			$this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Diupdate
					</div>');  
			redirect(site_url('user'));	
		}
	}
	
	public function delete() 
    {
		$id = $this->uri->segment(3);
		$this->user_model->destroy($id);	
		redirect('user');
    }
}

