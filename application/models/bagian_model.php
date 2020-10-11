<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bagian_model extends CI_Model
{

    public $table = 't_bagian';
    public $id = 'id_bagian';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    public function get_all($table)
    {
		$this->db->from($table);
		return $this->db->get();
    }

    public function getBagianJabatan()
    {
        $this->db->select('
                            tb.*
                            ,tj.nama_jabatan
                        ');
        $this->db->from('t_bagian tb');
        $this->db->join('t_jabatan tj','tb.id_jabatan = tj.id_jabatan');
        $this->db->order_by('tb.id_jabatan', 'ASC');
        return $this->db->get();
    }

    public function isDuplicate($nama_bagian, $id_jabatan)
	{
		$this->db->get_where('t_bagian', array('nama_bagian' => $nama_bagian,'id_jabatan'=>$id_jabatan), 1);
        return $this->db->affected_rows() > 0 ? FALSE : TRUE;
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
		$this->db->where('kode_bagian', $id);
		$this->db->delete('t_bagian');
	}

}