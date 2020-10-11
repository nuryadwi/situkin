<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{

    public $table = 't_pegawai';
    public $id = 'id_pegawai';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function isDuplicate($nip)
	{
		$this->db->get_where('t_users', array('nip' => $nip), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
    public function get_pegawai()
    {
        $this->db->select('*');
        $this->db->from('t_users');
        $this->db->join('t_bagian', 't_users.id_bagian=t_bagian.id_bagian');
        $this->db->join('t_jabatan', 't_bagian.id_jabatan=t_jabatan.id_jabatan');
        return $this->db->get()->result();

	}
    
}