<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif_model extends CI_Model {
	public $table ='tbl_alternatif';
	public $id = 'id_alternatif';
	public $order ='DESC';


	public function __construct()
    {
		parent::__construct();
		$this->load->database();
	}
    public function get_alternatif()
    {
        $this->db->select('*');
        $this->db->from('tbl_alternatif');
        $this->db->join('t_users', 'tbl_alternatif.id_user=t_users.id_user', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    function getJmlPegawaiHasNilai()
    {
    	$query = $this->db->query("SELECT COUNT(hasil_alternatif) AS pegawai
								FROM tbl_alternatif");
    	return $query->row();
    }

    function get_nilai($idsess)
	{
		$this->db->select('*');
		$this->db->from('tbl_alternatif');
		$this->db->join('t_users', 'tbl_alternatif.id_user=t_users.id_user');
		$this->db->where('tbl_alternatif.id_user', $idsess);
		$query = $this->db->get();
        return $query->row();
	}	

	public function getAlternatif()
	{
		$query = $this->db->query('SELECT*FROM tbl_alternatif');
		return $query->result();
	}
	
	public function isDuplicate($id_user)
	{
		$this->db->get_where('tbl_alternatif', array('id_user' => $id_user), 1);
        return $this->db->affected_rows() > 0 ? FALSE : TRUE;
	}

	function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
	}
	public function get_all($table){
		$this->db->from($table);
		return $this->db->get();
	}

	public function getJabatan()
	{
		$this->db->select('*');
    	$this->db->from('t_bagian');
    	$this->db->join('t_jabatan', 't_bagian.id_jabatan=t_jabatan.id_jabatan');

    	$query= $this->db->get();
		return $query->result();
	}

	public function get_user() {
		$this->db->select('*');
		$this->db->from('tbl_alternatif');
		$this->db->join('t_users', 't_users.id_user=tbl_alternatif.id_user');
		$this->db->join('t_bagian', 't_bagian.id_bagian=tbl_alternatif.id_bagian');
		$this->db->join('t_jabatan', 't_bagian.id_jabatan=t_jabatan.id_jabatan');

		$query = $this->db->get();
		return $query->result();
	   }

	function insert($data)
    {
        $this->db->insert($this->table, $data);
	}

	
	function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

	function destroy($id){
		$this->db->where('id_alternatif', $id);
		$this->db->delete('tbl_alternatif');
	}
	function destroy_ket($id){
		$this->db->where('id_alternatif', $id);
		$this->db->delete('tbl_alternatif');
	}


}
