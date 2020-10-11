<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas_model extends CI_Model {

	public function __construct()
    {
		parent::__construct();
		$this->load->database();
	}

	function getJmlTugas($awal, $akhir)
	{
		
		$query = $this->db->query("select COUNT(IF(jml ='1',1,NULL)) AS tugas1,
									COUNT(IF(jml ='0',0,NULL)) AS tugas2
								from t_tugas
								where create_at >='".$awal."' and create_at <='".$akhir."' ");
    	return $query->row();
		
	}

	function report($where= '')
	{
		$this->db->select('*');
		$this->db->from('t_tugas');
		$this->db->join('t_users', 't_tugas.id_user=t_users.id_user');
		$this->db->join('t_bagian', 't_tugas.id_bagian=t_bagian.id_bagian');
		$this->db->join('t_jabatan', 't_bagian.id_jabatan=t_jabatan.id_jabatan');
		$this->db->where($where);
		$this->db->order_by('t_tugas.id_user');

		return $this->db->get()->result();
	}

	function get_recent()
	{
		$this->db->select('*');
		$this->db->from('t_tugas');
		$this->db->join('t_users', 't_tugas.id_user=t_users.id_user');
		$this->db->where('jml', 0);

		return $this->db->get()->result();
	}

	function update_jml($table = null, $data=null, $where=null){
		$this->db->update($table, $data, $where);
	}

	function download($id)
	{
		$query = $this->db->get_where('t_tugas',array('id_tugas'=>$id));
  		return $query->row_array();
	}

}