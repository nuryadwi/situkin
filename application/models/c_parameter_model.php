<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_parameter_model extends CI_Model {

	public function __construct()
    {
		parent::__construct();
		$this->load->database();
	}

    public function get_kriteria()
    {
        $this->db->select('*');
        $this->db->from('tbl_parameter');
        $this->db->join('tbl_kriteria', 'tbl_kriteria.id_kriteria=tbl_parameter.id_kriteria');
        $query = $this->db->get();
        return $query->result();
    }

	public function get_all($table)
    {
		$this->db->from($table);
		return $this->db->get();
    }
    function get_by_id($id)
    {
        $this->db->where('id_kriteria', $id);
        return $this->db->get('tbl_parameter')->row();
	}

	function update($id, $data)
    {
        $this->db->where('id_kriteria', $id);
        $this->db->update('tbl_parameter', $data);
    }

    function destroy($id)
    {   
        $data = array(
            'min' => NULL,
            'maks' => NULL,
            'type' => NULL,
        );
        $this->db->set('min');
        $this->db->set('maks');
        $this->db->set('type');
        $this->db->where('id_kriteria', $id);
        $this->db->update('tbl_parameter',$data);
    }
}