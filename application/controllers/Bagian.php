<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bagian extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->library('form_validation');
        $this->load->model('bagian_model');
		
    }
     
    public function index() {
        $data['header'] = "Data Bagian";
        $data['data'] = $this->bagian_model->getBagianJabatan()->result();

        $this->template->load('master', 'bagian/bagian_list', $data);
    }

    public function rules()
    {   
        $this->form_validation->set_rules('nama_bagian', 'Nama Bagian', 'trim|required');
        $this->form_validation->set_rules('id_jabatan', 'Jabatan', 'trim|required');
        $this->form_validation->set_message('required', '{field} wajib diisi');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

    public function create()
    {
        $data = array(
            'header' => 'Tambah Data Departemen',
            'button' => 'Tambah',
            'action' => site_url('bagian/create_action'),
        'id_bagian'     => set_value('id_bagian'),
        'nama_bagian'   => set_value('nama_bagian'),
        'id_jabatan'   => set_value('id_jabatan')
        
        );
        $this->template->load('master','bagian/bagian_form', $data);
    }

    public function create_action(){
        $this->rules();

        if( $this->form_validation->run() == FALSE) {
            $this->create();
        }else{
            if(!$this->bagian_model->isDuplicate($_POST['nama_bagian'],$_POST['id_jabatan'])){
                $this->session->set_flashdata('message-failed', 'Maaf data ini sudah ada di dalam datatase');
                redirect('bagian/create');
            }else{
                $data = array(
                    'nama_bagian' => $this->input->post('nama_bagian', TRUE),
                    'id_jabatan'  => $this->input->post('id_jabatan', TRUE),
                );
                $this->bagian_model->insert($data);
                $this->session->set_flashdata('message-success', 'Data berhasil tersimpan di database');
                redirect(site_url('bagian'));
            }
            
        }
    }

    public function update($id){
        $row = $this->bagian_model->get_by_id($id);
        if($row) {
            $data = array(
                    'header' => "Update Bagian",
                    'button' => "Update",
                    'action' => site_url('bagian/update_action'),
                'id_bagian' => set_value('id_bagian', $row->id_bagian),
                'nama_bagian' => set_value('nama_bagian', $row->nama_bagian),
                'id_jabatan' => set_value('id_jabatan', $row->id_jabatan),
            );
            $this->template->load('master', 'bagian/bagian_form', $data);
        }else{
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bagian'));
        }
    }

    public function update_action(){
        $this->rules();

        if($this->form_validation->run() == FALSE){
            $this->update($this->input->post('id_bagian', TRUE));
        }else{
            $data = array(
                'nama_bagian' => $this->input->post('nama_bagian'),
                'id_jabatan' => $this->input->post('id_jabatan'),
            );

            $this->bagian_model->update($this->input->post('id_bagian', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Diupdate
            </div>');  
            redirect(site_url('bagian'));
        }
    }

    public function delete() 
    {
		$id = $this->uri->segment(3);
		$this->bagian_model->destroy($id);
		redirect('bagian');
    }
}