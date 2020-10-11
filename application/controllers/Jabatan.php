<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
            is_login();
            $this->load->model('jabatan_model');
    }
    
    public function rules()
    {
        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan','trim|required');
        $this->form_validation->set_rules('id_jabatan', 'id_jabatan', 'trim');

        $this->form_validation->set_message('required', '{field} wajib diisi');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

	public function index()
	{   

        $data = array(
            'jabatan' => $this->jabatan_model->get_all('t_jabatan'), 
            'header'  => "Manajeman Jabatan",
            'action'  => site_url('jabatan/create_action'),
            'id_jabatan' => set_value('id_jabatan'),
            'nama_jabatan' => set_value('nama_jabatan'),
        );
        
        $this->template->load('master', 'jabatan/jabatan_list', $data);
    }

    public function create(){
        $data = array(
                'button' =>'Tambah',
                'action' => site_url('jabatan/create_action'),
            'id_jabatan' => set_value('id_jabatan'),
            'nama_jabatan' => set_value('nama_jabatan'),
            'header' => "Tambah Jabatan"
        );
        
        $this->template->load('master','jabatan/jabatan_form', $data);
    }

    public function create_action(){
        $this->rules();

        if($this->form_validation->run() == FALSE){
            $this->create();
        }else{
            $data = array(
                
                'nama_jabatan' => $this->input->post('nama_jabatan', TRUE),
            );
            $this->jabatan_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Masuk
            </div>');
            redirect(site_url('jabatan'));
        }
    }

    public function update($id){
        $row = $this->jabatan_model->get_by_id($id);
        if($row) {
            $data = array(
                    'header' => "Update Jabatan",
                    'button' => "Update",
                    'action' => site_url('jabatan/update_action'),
                'id_jabatan' => set_value('id_jabatan', $row->id_jabatan),
                'nama_jabatan' => set_value('nama_jabatan', $row->nama_jabatan),
            );
            $this->template->load('master', 'jabatan/_jabatan_form', $data);
        }else{
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }

    public function update_action(){
        $this->rules();

        if($this->form_validation->run() == FALSE){
            $this->update($this->input->post('id_jabatan', TRUE));
        }else{
            $data = array(
                'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
            );
            
            $this->jabatan_model->update($this->input->post('id_jabatan', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Diupdate
            </div>');  
            redirect(site_url('jabatan'));
        }
    }
    public function delete() 
    {
		$id = $this->uri->segment(3);
		$this->jabatan_model->destroy($id);
		redirect('jabatan');
    }

}