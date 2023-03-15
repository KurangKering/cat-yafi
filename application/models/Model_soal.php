<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_soal extends MY_Model {

	
public function __construct()
{
	$this->table = 'soal';
	$this->primary_key = 'id';
	$this->has_one['pelajaran'] = array('Model_pelajaran', 'id', 'id_pelajaran');
	parent::__construct();
	//Do your magic here
}
}

/* End of file Model_soal.php */
/* Location: ./application/models/Model_soal.php */