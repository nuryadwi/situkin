<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userlevel extends CI_Controller {

    function __construct()
    {
        parent::__construct();
            is_login();
            $this->load->library('form_validation');
            $this->load->model('user_level_model');
		}

	public function index()
	{   
        $data['data'] =  $this->user_level_model->get_all('t_role');
        $data['header'] = "Manajemen Hak Akses";
        
        $this->template->load('master', 'userlevel/user_level_list', $data);
    }
    public function rules()
    {
        $this->form_validation->set_rules('nama_role', 'Nama level','trim|required');
        $this->form_validation->set_rules('id_role', 'id_role', 'trim');

        $this->form_validation->set_message('required', '{field} wajib diisi');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function akses(){
        $data['header'] = "Kelola hak akses untuk";
        $data['level'] = $this->db->get_where('t_role',array('id_role'=>  $this->uri->segment(3)))->row_array();
        $data['menu'] = $this->db->get('t_menu')->result();
        $this->template->load('master','userlevel/akses',$data);
    }

    function kasi_akses_ajax(){
        $id_menu        = $_GET['id_menu'];
        $id_role  = $_GET['level'];
        // chek data
        $params = array('id_menu'=>$id_menu,'id_role'=>$id_role);
        $akses = $this->db->get_where('t_hak_akses',$params);
        if($akses->num_rows()<1){
            // insert data baru
            $this->db->insert('t_hak_akses',$params);
        }else{
            $this->db->where('id_menu',$id_menu);
            $this->db->where('id_role',$id_role);
            $this->db->delete('t_hak_akses');
        }
    }

    public function create(){
        $data = array(
                'button' =>'Tambah',
                'action' => site_url('userlevel/create_action'),
            'id_role' => set_value('id_role'),
            'nama_role' => set_value('nama_role'),
            'header' => "Tambah Level"
        );
        
        $this->template->load('master','userlevel/user_level_form', $data);
    }

    public function create_action(){
        $this->rules();

        if($this->form_validation->run() == FALSE){
            $this->create();
        }else{
            $data = array(
                //'id_role' => $this->input->post('id_role', TRUE),
                'nama_role' => $this->input->post('nama_role', TRUE),
            );
            $this->user_level_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Masuk
            </div>');
            redirect(site_url('userlevel'));
        }
    }

    public function update($id){
        $row = $this->user_level_model->get_by_id($id);
        if($row) {
            $data = array(
                    'header' => "Update Level",
                    'button' => "Update",
                    'action' => site_url('userlevel/update_action'),
                'id_role' => set_value('id_role', $row->id_role),
                'nama_role' => set_value('nama_role', $row->nama_role),
            );
            $this->template->load('master', 'userlevel/user_level_form', $data);
        }else{
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('userlevel'));
        }
    }
    public function update_action(){
        $this->rules();

        if($this->form_validation->run() == FALSE){
            $this->update($this->input->post('id_role', TRUE));
        }else{
            $data = array(
                'nama_role' => $this->input->post('nama_role',TRUE),
            );
            
            $this->user_level_model->update($this->input->post('id_role', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Diupdate
            </div>');  
            redirect(site_url('userlevel'));
        }
    }
    public function delete() 
    {
		$id = $this->uri->segment(3);
        $this->user_level_model->destroy($id);
        $this->session->set_flashdata('message-success', 'Data berhasil di hapus');
		redirect('userlevel');
    }
}
