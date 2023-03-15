<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pelajaran extends MY_Model {

	public function __construct()
	{
		$this->table = 'pelajaran';
		$this->primary_key = 'id';
		$this->has_many['soals'] = array('Model_soal', 'id_pelajaran', 'id');
		parent::__construct();
		//Do your magic here
	}

	public function get_pelajarans_with_jumlah_soal()
	{

	}

}

/* End of file Model_pelajaran.php */
/* Location: ./application/models/Model_pelajaran.php */