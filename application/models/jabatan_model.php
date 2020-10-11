<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model
{

    public $table = 't_jabatan';
    public $id = 'id_jabatan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    public function getJabatan()
    {
        $this->db->select('*');
        $this->db->from('t_bagian');
        $this->db->join('t_jabatan', 't_bagian.id_jabatan=t_jabatan.id_jabatan');
        $query = $this->db->get();
		$result = ($query->num_rows() > 0) ? $query->result() : FALSE;

		return $result;
    }

 

    public function get_all($table)
    {
		$this->db->from($table);
		return $this->db->get();
    }
    
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
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
		$this->db->where('id_jabatan', $id);
		$this->db->delete('t_jabatan');
	}

}