<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_parameter extends CI_Controller {

    function __construct()
    {
        parent::__construct();
            is_login();
            $this->load->library('form_validation');
            $this->load->model('c_parameter_model');
    }

    function index()
    {
    	$data = array(
    		'header' => "Kelola Nilai Parameter",
    		'button'=> "Tambah",
    		'action' => site_url('c_parameter/simpan'),
            'data2' => $this->c_parameter_model->get_kriteria(),
            'min' => set_value('min'),
    		'maks' => set_value('maks'),
            'type' => set_value('type'),
    	); 
    	$this->template->load('master', 'v_parameter/parameter_list', $data);
    }

    function rules()
    {
    	//$this->form_validation->set_rules('sub_kriteria','Nama Sub Kriteria', 'trim|required');
		$this->form_validation->set_rules('min','Nilai Minimal', 'trim|required');
		$this->form_validation->set_rules('maks','Nilai Maksimal', 'trim|required');
		//$this->form_validation->set_rules('bobot_kriteria','Bobot (%)', 'trim|required');
		$this->form_validation->set_message('required', '{field} wajib diisi');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    public function simpan()
    {
    	$this->rules();
    	if ($this->form_validation->run() == FALSE) {
    		$this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal!!!
            </div>');
            $this->index();
    	}else{
    		$data = array(
    		'id_kriteria' => $_POST['id_kriteria'],
    		'min'	=> $_POST['min'],
    		'maks'   => $_POST['maks'],
            'type' => $_POST['type'],
    	);
            //var_dump($data);
    	$this->c_parameter_model->update($this->input->post('id_kriteria', TRUE), $data);
        $this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Diupdate
        </div>');  
        redirect(site_url('c_parameter'));
    	}
    }

	public function delete() 
    {
		$id = $this->uri->segment(3);
		$this->c_parameter_model->destroy($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Hapus
        </div>'); 
		redirect('c_parameter');
    }
}