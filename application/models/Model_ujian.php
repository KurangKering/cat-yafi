<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ujian extends MY_Model {

	public function __construct()
	{
		$this->table = 'ujian';
		$this->primary_key = 'id';
		$this->has_many['peserta'] = array('Model_peserta', 'id_ujian', 'id');
		parent::__construct();
		//Do your magic here
	}

	public function get_data_ujians($limit, $offset)
	{
		
		$query = "SELECT u.id, u.tahun, u.gelombang, u.token, u.soal_soal, u.durasi, (SELECT COUNT(peserta.id) FROM peserta WHERE peserta.id_ujian = u.id ) as jumlah_peserta FROM ujian u ORDER BY u.tahun DESC, u.gelombang  DESC LIMIT {$limit} OFFSET {$offset}";
		return $this->db->query($query)->result_array();
		
	}
}

/* End of file Model_ujian.php */
/* Location: ./application/models/Model_ujian.php */