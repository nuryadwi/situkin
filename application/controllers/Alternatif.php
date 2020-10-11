<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		is_login();
		$this->load->library('form_validation');
		$this->load->model('alternatif_model');
		$this->load->model('user_model');
	}
		
	public function index()
	{
		$data = array(
			'header'   => "Kelola Data Alternatif",
			'jabatan'  => $this->alternatif_model->getJabatan(),
			'pegawai' => $this->user_model->get_user(),
			'action' => site_url('alternatif/create_action'),
		'bagian'  => set_value('bagian'),
		'pegawai_selected' => set_value('id_user'),
		);
		$this->template->load('master', 'alternatif/alternatif_list', $data);
	}
	

	public function rules()
	{
		$this->form_validation->set_rules('id_user','id_user', 'trim|required');
		$this->form_validation->set_message('required', '{field} wajib diisi');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}


	function create_action()
	{
		$this->rules();
		if($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning"><h4>Gagal!!</h4> Silahlan isi Kembali</div>');
			redirect(site_url('alternatif'));
		} else{
			if(! $this->alternatif_model->isDuplicate($_POST['id_user'])){
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><h4>Gagal!!</h4>
					Pegawai Sudah Ada. Silahkan masukkan Pegawai yang belum di masukkan</div>');
			 	redirect(base_url('alternatif'));
		 }
		 else{
			$data = array(
						'id_bagian' => $_POST['bagian'],
						'id_user' => $_POST['id_user'],
						);
		
			$this->alternatif_model->insert($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil disimpan</div>');
			redirect(site_url('alternatif'));
			}
		}
			
	}
	
	public function delete() 
    {
		$id = $this->uri->segment(3);
		$this->alternatif_model->destroy($id);
		redirect('alternatif');
    }
}

