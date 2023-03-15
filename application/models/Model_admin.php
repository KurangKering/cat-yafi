<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_admin extends MY_Model {
	public function __construct()
	{


		$this->table = 'admin';
		$this->primary_key = 'id';
		

		parent::__construct();
	}
	

}

/* End of file Model_admin.php */
/* Location: ./application/models/Model_admin.php */