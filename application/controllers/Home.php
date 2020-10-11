<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
		parent::__construct();
        is_login();
        $this->load->model('tugas_model');
        $this->load->model('bukupegawai_model');
        $this->load->model('alternatif_model');
        $this->load->model('user_model');
		
	}
    public function index()
    {
        $idsess = $this->session->userdata('id_user');
        //admin
        if ($this->session->userdata('id_role')==='1') {
           $data = array(
            'header' =>"Administrator",
            'jml_aktif' => $this->user_model->get_user_aktif(),
            'jml_user' => $this->user_model->get_total_user(),
            'jml_online' => $this->user_model->get_user_online(),
           );
        
        //operator
        } elseif ($this->session->userdata('id_role')==='6') {
            $bln = date('m');
            $thn = date('Y');
            $awal = $thn.'-'.$bln.'-01';
            $akhir = $thn.'-'.$bln.'-31';
            $data = array(
            'header' =>"Operator",
            'recent' => $this->tugas_model->get_recent(),
            'jml1'   => $this->user_model->get_jml_pegawai(),
            'jml2'   => $this->alternatif_model->getJmlPegawaiHasNilai(),
            'jml3'    => $this->tugas_model->getJmlTugas($awal, $akhir),
           );
        
        //user
        }else{
            $bln = date('m');
            $thn = date('Y');
            $awal = $thn.'-'.$bln.'-01';
            $akhir = $thn.'-'.$bln.'-31';
            $where = ['tanggal >=' => $awal, 'tanggal <=' => $akhir, 't_tugas.id_user' => $idsess];
            $jml = $this->bukupegawai_model->getJmlTugas($where);
            $nilai = $this->alternatif_model->get_nilai($idsess);
            $level = $this->user_model->get_user_by_id($idsess);
            $data = array(
            'header' => "Pegawai",
            'jml_tugas' => $jml->jumlah,
            'nilai' => $nilai->hasil_alternatif,
            'level' => $level->nama_role,
            'buku'  => $this->bukupegawai_model->getBukuPegawai($idsess),
            );
        }

        $this->template->load('master', 'dashboard', $data);
    }

}