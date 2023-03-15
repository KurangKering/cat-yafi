<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_hasil_ujian extends MY_Model {

	
	public function __construct()
	{

		$this->table = 'hasil_ujian';
		$this->primary_key = 'id';
		$this->has_one['peserta'] = array('Model_peserta', 'id', 'id_peserta');

		parent::__construct();
	//Do your magic here
	}


	public function get_daftar_nilai($id_ujian)
	{
		$this->db->select('peserta.id as id_peserta, peserta.no_peserta, peserta.nama, hasil_ujian.nilai');
		$this->db->from('hasil_ujian');
		$this->db->join('peserta', 'hasil_ujian.id_peserta = peserta.id', 'LEFT');
		$this->db->where('hasil_ujian.id_ujian', $id_ujian);
		$this->db->where('hasil_ujian.selesai', '1');
		$this->db->order_by('hasil_ujian.updated_at');
		return $this->db->get()->result_array();
	}
}

/* End of file Model_hasil_ujian.php */
/* Location: ./application/models/Model_hasil_ujian.php */