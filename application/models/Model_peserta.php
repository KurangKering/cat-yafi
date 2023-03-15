<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_peserta extends MY_Model {

	public function __construct()
	{
		$this->table = 'peserta';
		$this->primary_key = 'id';
		$this->has_one['hasil_ujian'] = array('Model_hasil_ujian', 'id_peserta', 'id');
		$this->has_one['ujian'] = array('Model_ujian', 'id', 'id');
		parent::__construct();
		//Do your magic here
	}

}

/* End of file Model_peserta.php */
/* Location: ./application/models/Model_peserta.php */