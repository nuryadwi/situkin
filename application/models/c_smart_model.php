<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_smart_model extends CI_Model {

	public function __construct()
    {
		parent::__construct();
		$this->load->database();
	}

	function get_alter()
	{
		$this->db->select('*');
		$this->db->from('tbl_alternatif');
		$this->db->join('t_users','tbl_alternatif.id_user=t_users.id_user');
		$this->db->join('t_bagian', 't_users.id_bagian = t_bagian.id_bagian');
		$this->db->join('t_jabatan', 't_bagian.id_jabatan = t_jabatan.id_jabatan');
		$query = $this->db->get();
		return $query->result();
	}

	function get_param($pram)
	{
		$this->db->select('*');
		$this->db->from('tbl_parameter');
		$this->db->where('id_kriteria', $pram);
		$query = $this->db->get();
		return $query->row();
	}

	function get_nilai($id)
	{
		$this->db->select('*');
	    $this->db->from('tbl_alternatif');
	    $this->db->join('t_users', 'tbl_alternatif.id_user=t_users.id_user');
	    $this->db->join('tbl_alternatif_kriteria', 'tbl_alternatif.id_alternatif=tbl_alternatif_kriteria.id_alternatif');
	    $this->db->join('tbl_kriteria', 'tbl_alternatif_kriteria.id_kriteria=tbl_kriteria.id_kriteria');
	    $this->db->join('tbl_nilai', 'tbl_kriteria.id_kriteria=tbl_nilai.id_kriteria');
	    $this->db->where('tbl_alternatif.id_user', $id);
	    $query = $this->db->get();
        return $query->result();
	}

	function get_alter_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_alternatif');
		$this->db->join('t_users','tbl_alternatif.id_user=t_users.id_user');
		$this->db->join('t_bagian','tbl_alternatif.id_bagian=t_bagian.id_bagian');
		$this->db->join('t_jabatan','t_jabatan.id_jabatan=t_bagian.id_jabatan');
		$this->db->where('tbl_alternatif.id_alternatif', $id);
		$query = $this->db->get();
		return $query->row();
	}

	function insert($data)
    {
        $this->db->insert_batch('tbl_alternatif_kriteria',$data);
	}
	function insert2($data2)
    {
        $this->db->insert_batch('tbl_nilai',$data2);
	}

	function destroy($id)
	{
		$this->db->where('id_alternatif', $id);
		$this->db->delete('tbl_alternatif_kriteria');
	}
	function destroy2($id)
	{
		$this->db->where('id_alternatif', $id);
		$this->db->delete('tbl_nilai');
	}

	function get_nilai_awal($id_kriteria, $id_alternatif)
	{
		$this->db->select('*');
		$this->db->from('tbl_alternatif_kriteria');
		$this->db->where('id_kriteria', $id_kriteria);
		$this->db->where('id_alternatif', $id_alternatif);
		return $this->db->get();
	}

}