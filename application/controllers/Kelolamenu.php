<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelolamenu extends CI_Controller {

	function __construct()
    {
				parent::__construct();
				is_login();
				$this->load->library('form_validation');
				$this->load->model('menu_model');
		}
		
	public function index()
	{
		
		$data = array(
					'header' => "Kelola Menu",
					'button' => "Simpan",
					'action' => site_url('kelolamenu/simpan_setting'),
		'id_menu' 	=>set_value('id_menu'),
		'setting'  	=>$this->db->get_where('t_setting',array('id_setting'=>1))->row_array(),
		'menu'		=> $this->menu_model->get_all('t_menu'),
		);
		$this->template->load('master', 'kelolamenu/menu_list', $data);
	}

	function simpan_setting(){
        $value = $this->input->post('tampil_menu');
        $this->db->where('id_setting',1);
        $this->db->update('t_setting',array('value'=>$value));
        redirect('kelolamenu');
    }

	

	public function rules()
	{
		$this->form_validation->set_rules('title', 'title', 'trim|required');
		$this->form_validation->set_rules('url', 'url', 'trim|required');
		//$this->form_validation->set_rules('icon','icon', 'trim|required');
		$this->form_validation->set_rules('is_aktif','is_aktif', 'trim|required');
		$this->form_validation->set_rules('id_menu', 'id_menu', 'trim');
		$this->form_validation->set_message('required', '{field} wajib diisi');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function create()
	{		
			$data = array( 
						'button'	=> 'Tambah',
						'header'		=> "Tambah Menu",
						'action'	=> site_url('kelolamenu/create_action'),
				'id_menu'  	=> set_value('id_menu'),
				'title'	=> set_value('title'),
				'url'  => set_value('url'),
				'icon' => set_value('icon'),
				'is_main_menu' => set_value('is_main_menu'),
				'is_aktif' => set_value('is_aktif'),
			);
			$this->template->load('master','kelolamenu/menu_form',$data);
		
	}
	function create_action()
	{
		$this->rules();
		if($this->form_validation->run() == FALSE) {
			$this->create();
		} else{
			$data = array(
				//'id_menu' 		=> $this->input->post('id_menu', TRUE),
				'title'		=> $this->input->post('title', TRUE),
				'url' => $this->input->post('url',TRUE),
				'icon' => $this->input->post('icon',TRUE),
				'is_main_menu' => $this->input->post('is_main_menu',TRUE),
				'is_aktif' 		=> $this->input->post('is_aktif', TRUE),
			);
		//print_r($data);
		$this->menu_model->insert($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Masuk</div>');
		redirect(site_url('kelolamenu'));
		}
	}

	public function update($id)
	{
		$row = $this->menu_model->get_by_id($id);
		if($row) {
			$data = array(
						'button' => 'Update',
						'header'		=> "Edit Data Menu",
						'action' => site_url('kelolamenu/update_action'),
				'id_menu'  	=> set_value('id_menu', $row->id_menu),
				'title'	=> set_value('title',$row->title),
				'url' => set_value('url', $row->url),
				'icon' => set_value('icon', $row->icon),
				'is_main_menu' => set_value('is_main_menu', $row->is_main_menu),
				'is_aktif' => set_value('is_aktif', $row->is_aktif),
				
			);
		$this->template->load('master','kelolamenu/menu_form',$data);
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert">Data tidak ditemukan</div>');
        	redirect(site_url('kelolamenu'));
			}
	}
	public function update_action(){
		$this->rules();
		if ($this->form_validation->run() == FALSE){
			$this->update($this->input->post('id_user', TRUE));
		}else{
			$data = array(
				'id_menu' 		=> $this->input->post('id_menu', TRUE),
				'title'			=> $this->input->post('title', TRUE),
				'url'			=> $this->input->post('url',TRUE),
				'icon' 			=> $this->input->post('icon',TRUE),
				'is_main_menu' 	=> $this->input->post('is_main_menu',TRUE),
				'is_aktif' 		=> $this->input->post('is_aktif', TRUE),
			);
			$this->menu_model->update($_POST['id_menu'], $data);
			$this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Diupdate
					</div>');  
			redirect(site_url('kelolamenu'));
		}

	}

	public function delete() 
    {
		$id = $this->uri->segment(3);
		$this->menu_model->destroy($id);
		$this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Dihapus</div>');
		redirect('kelolamenu');
    }
}

