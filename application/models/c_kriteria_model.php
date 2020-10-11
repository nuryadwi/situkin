<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kriteria_model extends CI_Model {

	public function __construct()
    {
		parent::__construct();
		$this->load->database();
	}

    public function get_all($table)
    {
		$this->db->from($table);
		return $this->db->get();
    }
    public function get_kriteria_param()
    {
        $this->db->select('*');
        $this->db->from('tbl_kriteria');
        $this->db->join('tbl_parameter', 'tbl_kriteria.id_kriteria=tbl_parameter.id_kriteria');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_kriteria()
    {
    	$this->db->select('*');
    	$this->db->from('tbl_kriteria');
    	$this->db->join('tbl_bobot1','tbl_kriteria.id_kriteria=tbl_bobot1.id_kriteria');
    	$this->db->join('tbl_bobot2','tbl_kriteria.id_kriteria=tbl_bobot2.id_kriteria');
    	$query = $this->db->get();
    	return $query->result();
    }

    function get_sum1()
    {
        return $this->db->query("SELECT CAST(SUM(bobot1) AS DECIMAL(12,2)) AS bobot_norm_1
								FROM tbl_bobot1
								JOIN tbl_kriteria ON tbl_bobot1.`id_kriteria`=tbl_kriteria.`id_kriteria`");
    }

    function get_sum2()
    {
        return $this->db->query("SELECT CAST(SUM(bobot2) AS DECIMAL(12,2)) AS bobot_norm_2
								FROM tbl_bobot2
								JOIN tbl_kriteria ON tbl_bobot2.`id_kriteria`=tbl_kriteria.`id_kriteria`");
    }

    public function insert_data($data1,$data2,$data3)
    {
    	$this->db->trans_start();
    		$id = $this->tambah_kriteria($data1);
    		$data2['id_kriteria'] = $id;
    		$data3['id_kriteria'] = $id;
            $data4['id_kriteria'] = $id;
    		$this->tambah_bobot1($data2);
    		$this->tambah_bobot2($data3);
            $this->tambah_param($data4);
    	$this->db->trans_complete();

    	return $this->db->trans_status();
    }

    function tambah_kriteria($data)
    {
    	$this->db->insert('tbl_kriteria', $data);
    	$id = $this->db->insert_id();
    	return (isset($id)) ? $id : FALSE;
    }

    function tambah_bobot1($data)
    {
    	$res = $this->db->insert('tbl_bobot1', $data);
    	return $res;
    }
    function tambah_bobot2($data)
    {
    	$res = $this->db->insert('tbl_bobot2', $data);
    	return $res;
    }
    function tambah_param($data)
    {
        $res = $this->db->insert('tbl_parameter', $data);
        return $res;
    }

    function update($id, $data)
    {
        $this->db->where('id_kriteria', $id);
        $this->db->update('tbl_kriteria', $data);
    }


    function destroy($id)
    {
		$this->db->where('id_kriteria', $id);
		$this->db->delete('tbl_kriteria');
	}


	function destroy2($id)
    {
		$this->db->where('id_kriteria', $id);
		$this->db->delete('tbl_bobot1');
	}
	function destroy3($id)
    {
		$this->db->where('id_kriteria', $id);
		$this->db->delete('tbl_bobot2');
	}

    function destroy4($id)
    {
        $this->db->where('id_kriteria', $id);
        $this->db->delete('tbl_parameter');
    }
	function destroy_norm()
	{	
		$data = array(
    		'norm1' => NULL,
    	);
		$this->db->set('norm1');
    	$this->db->update('tbl_bobot1',$data);
	}
	function destroy_norm2()
	{	
		$data = array(
    		'norm2' => NULL,
    	);
		$this->db->set('norm2');
    	$this->db->update('tbl_bobot2',$data);
	}
    
    function destroy_rata()
	{	
		$data = array(
    		'bobot_rerata' => NULL,
    	);
		$this->db->set('bobot_rerata');
    	$this->db->update('tbl_kriteria',$data);
	}
}