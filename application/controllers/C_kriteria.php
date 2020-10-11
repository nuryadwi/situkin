<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kriteria extends CI_Controller {

    function __construct()
    {
        parent::__construct();
            is_login();
            $this->load->library('form_validation');
            $this->load->model('c_kriteria_model');
    }

    public function index()
    {
    	$data = array(
    		'header' => "Kelola Data Kriteria",
    		'button' => "Tambah",
    		'action' => site_url('c_kriteria/tambah'),
    		'krit' => $this->c_kriteria_model->get_kriteria(),
    		'rata'	=> $this->c_kriteria_model->get_all('tbl_kriteria')->result(),
            'jml1'  =>$this->c_kriteria_model->get_sum1()->row(),
            'jml2'  =>$this->c_kriteria_model->get_sum2()->row(),
    		'kriteria' => set_value('kriteria'),
            'deskripsi' => set_value('deskripsi'),
    		'bobot1'   => set_value('bobot1'),
    		'bobot2'   => set_value('bobot2'),
    	);
    	$this->template->load('master','v_kriteria/kriteria_list', $data);
    }

    function rules()
    {
    	$this->form_validation->set_rules('kriteria','Kode Kriteria', 'trim|required');
        $this->form_validation->set_rules('nama_kriteria','Nama Kriteria', 'trim|required');
        $this->form_validation->set_rules('deskripsi','Deskripsi', 'trim|required');
		$this->form_validation->set_rules('bobot1','Bobot Tabel 1', 'trim|required');
		$this->form_validation->set_rules('bobot2','Bobot Tabel 2', 'trim|required');
		$this->form_validation->set_message('required', '{field} wajib diisi');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function tambah()
    {
    	$this->rules();
    	if ($this->form_validation->run() == FALSE) {
    		$this->index();
    	}else{

  			$data1 = array(
  				'kriteria' => $this->input->post('kriteria'),
                'nama_kriteria' => $this->input->post('nama_kriteria'),
                'deskripsi' => $this->input->post('deskripsi'),
  			);
  			$data2 = array(
  				'bobot1' => $this->input->post('bobot1'),
  			);
  			$data3 = array(
  				'bobot2' => $this->input->post('bobot2'),
  			);

  		//var_dump($data1,$data2,$data3);
  		$this->c_kriteria_model->insert_data($data1,$data2,$data3);
  		$this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Ditambah
            </div>');
  		redirect('c_kriteria');

    	}
    }

    function update()
    {
        $this->form_validation->set_rules('nama_kriteria','Nama Kriteria', 'trim|required');
        $this->form_validation->set_rules('deskripsi','Deskripsi', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal!!!
            </div>');
            $this->index();
        }else{
            $data = array(
                'id_kriteria' => $_POST['id_kriteria'],
                'nama_kriteria' => $_POST['nama_kriteria'],
                'deskripsi' => $_POST['deskripsi'],
            );
        $this->c_kriteria_model->update($this->input->post('id_kriteria', TRUE), $data);
        $this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Diupdate
        </div>');  
        redirect(site_url('c_kriteria'));
        }
    }

    function norm1()
    {
    	$row1 = $this->c_kriteria_model->get_sum1()->row();
    	$bbt1 = $row1->bobot_norm_1;
    	$data1 = $this->c_kriteria_model->get_all('tbl_bobot1')->result();

    	foreach ($data1 as $b) 
    	{
			$id = $b->id_kriteria;
			$data[] = array(
				'id_kriteria' => $id,
	    		'norm1' => $b->bobot1/$bbt1,
				);
    	}
    	$this->db->set('norm1');
    	$this->db->update_batch('tbl_bobot1', $data,'id_kriteria');
    	
    	$this->session->set_flashdata('message', '<div class="alert alert-info">Berhasil Normalisasi Relatif 1
            </div>');
		redirect('c_kriteria');

    }

    function norm2()
    {
    	$row2 = $this->c_kriteria_model->get_sum2()->row();
    	$bbt2 = $row2->bobot_norm_2;
    	$data2 = $this->c_kriteria_model->get_all('tbl_bobot2')->result();

    	foreach ($data2 as $b) 
    	{
			$id = $b->id_kriteria;
			$data[] = array(
				'id_kriteria' => $id,
	    		'norm2' => $b->bobot2/$bbt2,
				);
    	}
    	//var_dump($bbt2);
    	$this->db->set('norm2');
    	$this->db->update_batch('tbl_bobot2', $data,'id_kriteria');
    	
    	$this->session->set_flashdata('message', '<div class="alert alert-info">Berhasil Normalisasi Relatif 2
            </div>');
		redirect('c_kriteria');

    }

    function rerata()
    {
    	$row = $this->c_kriteria_model->get_kriteria();
    	
    	foreach ($row as $r) {
			$a = ($r->norm1+$r->norm2)/2;
			$data[] = array(
				'id_kriteria' => $r->id_kriteria,
				'bobot_rerata' => $a,
			);
    	}
    	$this->db->set('bobot_rerata');
    	$this->db->update_batch('tbl_kriteria', $data,'id_kriteria');
    	
    	$this->session->set_flashdata('message', '<div class="alert alert-info">Berhasil Mendapatkan Nilai Normalisasi Rata-rata
            </div>');
		redirect('c_kriteria');
    }



    public function delete() 
    {
		$id = $this->uri->segment(3);
		$this->c_kriteria_model->destroy($id);
		$this->c_kriteria_model->destroy2($id);
		$this->c_kriteria_model->destroy3($id);
        $this->c_kriteria_model->destroy4($id);

		$this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Dihapus
            </div>');
		redirect('c_kriteria');
    }

    function delete_norm()
    {
    	$this->c_kriteria_model->destroy_norm();
    	$this->c_kriteria_model->destroy_rata();
    	$this->session->set_flashdata('message', '<div class="alert alert-info">Semua Data Relatif 1 Berhasil Dihapus
            </div>');
		redirect('c_kriteria');
    }
    function delete_norm2()
    {
    	$this->c_kriteria_model->destroy_norm2();
    	$this->c_kriteria_model->destroy_rata();
    	$this->session->set_flashdata('message', '<div class="alert alert-info">Semua Data Relatif 2 Berhasil Dihapus
            </div>');
		redirect('c_kriteria');
    }


}