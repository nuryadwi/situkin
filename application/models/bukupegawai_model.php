<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bukupegawai_model extends CI_Model {


	public function __construct()
    {
		parent::__construct();
		$this->load->database();
	}

	function insert($data)
    {
        $this->db->insert('t_tugas', $data);
    }

    function getBukuPegawai($idsess)
    {
    	$this->db->select('*');
    	$this->db->from('t_tugas');
    	$this->db->join('t_users', 't_tugas.id_user=t_users.id_user');
    	$this->db->join('t_bagian','t_tugas.id_bagian=t_bagian.id_bagian');
    	$this->db->join('t_jabatan', 't_bagian.id_jabatan=t_jabatan.id_jabatan');
    	$this->db->where('t_tugas.id_user', $idsess);
        $this->db->order_by('t_tugas.tanggal', 'DESC');
    	$query = $this->db->get();
    	return $query->result();
    }

    function getJmlTugas($where)
    {
       $this->db->select_sum('jml','jumlah');
       $this->db->from('t_tugas');
       $this->db->join('t_users','t_tugas.id_user=t_users.id_user');
       $this->db->where($where);
       return $this->db->get()->row();
    }

    function get_ket($idsess)
    {
        $this->db->select('*');
        $this->db->from('tbl_alternatif');
        $this->db->where('id_user', $idsess);
        return $this->db->get()->row();
    }


    /*---
    rapot pegawai sql

    SELECT full_name,hasil_alternatif,ket_alternatif, nilai_alternatif_kriteria, nama_kriteria, nama_sub_kriteria
    FROM t_alternatif
    JOIN t_users ON t_alternatif.`id_user`=t_users.`id_user`
    JOIN t_alternatif_kriteria ON t_alternatif.`id_alternatif`=t_alternatif_kriteria.`id_alternatif`
    JOIN t_kriteria ON t_alternatif_kriteria.`id_kriteria`=t_kriteria.`id_kriteria`
    JOIN t_sub_kriteria ON t_kriteria.`id_kriteria`=t_sub_kriteria.`id_kriteria`
    WHERE t_alternatif.`id_user`='58'
    GROUP BY nilai_alternatif_kriteria;

  */


}