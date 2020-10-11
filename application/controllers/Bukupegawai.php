<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bukupegawai extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		is_login();
		$this->load->library('form_validation');
		$this->load->model('bukupegawai_model');
				
	}

	public function index()
	{
		$idsess = $this->session->userdata('id_user');
		$bln = date('m');
		$thn = date('Y');
		$awal = $thn.'-'.$bln.'-01';
        $akhir =$thn.'-'.$bln.'-31';
        $where = ['tanggal >=' => $awal, 'tanggal <=' => $akhir, 't_tugas.id_user' => $idsess];
		$jml = $this->bukupegawai_model->getJmlTugas($where);
		$data = array(
			'header' => "Buku Tugas Pegawai",
			'buku'  => $this->bukupegawai_model->getBukuPegawai($idsess),
			'jml_tugas' => $jml->jumlah, 
			);
		$this->template->load('master', 'pegawai/list_buku', $data);
	}

	public function create()
	{
		$idsess = $this->session->userdata('id_user');

		$data = array(
			'header' => "Tulis Tugas",
			'button' => "Tambah",
			'action' => site_url('bukupegawai/create_action'),
			'subheader' => strtoupper($this->session->userdata('full_name')),
		'id_user'  => set_value('id_user', $idsess),
		'id_bagian' => set_value('id_bagian', $this->session->userdata('id_bagian')),
		'waktu_mulai' => set_value('waktu_mulai'),
		'waktu_selesai' => set_value('waktu_selesai'),
		'tanggal' => set_value('tanggal'),
		'tugas'  => set_value('tugas'),
		'pemberi_tugas' => set_value('pemberi_tugas'),
		'files'   => set_value('files'),
		'keterangan' => set_value('keterangan')
		);
		$this->template->load('master', 'pegawai/tulis_tugas', $data);
	}

	public function create_action()
	{
		$this->rules();
		$file = $this->upload_file();
		if ($this->form_validation->run() == FALSE) {
			echo "gagal";
		}else{
			$tgl = ubah_tgl($_POST['tanggal']);
			$data = array(
				'id_user' => $_POST['id_user'],
				'id_bagian' => $_POST['id_bagian'],
				'waktu_mulai' => $_POST['waktu_mulai'],
				'waktu_selesai' => $_POST['waktu_selesai'],
				'tanggal' => $tgl,
				'tugas' =>$_POST['tugas'],
				'pemberi_tugas' => $_POST['pemberi_tugas'],
				'file_tambahan' => $file,
				'ket' => $_POST['keterangan'],
				'jml' => 0,
				'create_at' =>date('Y-m-d'),

			);
			// print_r($data);
			$this->bukupegawai_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Masuk
            </div>');
             redirect(site_url('bukupegawai'));

		}
		
	}

	public function rules()
	{
		
		$this->form_validation->set_rules('tugas', 'tugas', 'trim|required');
		$this->form_validation->set_rules('id_user', 'id_user', 'trim|required');
		$this->form_validation->set_rules('id_bagian', 'id_bagian', 'trim|required');
		$this->form_validation->set_rules('pemberi_tugas', 'pemberi_tugas', 'trim|required');

        $this->form_validation->set_message('required', '{field} wajib diisi');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	private function upload_file()
	{
		$config['upload_path']          = './assets/file_tambahan';
        $config['allowed_types']        = 'doc|docx|xls|jpg|png';
        $config['file_name']            = $_POST['tugas'].'_'.$_POST['id_user'];
        $config['overwrite']            = 'true';
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('files')) {
        	return $this->upload->data('file_name');
        }
        return "kosong";
        
	}

}