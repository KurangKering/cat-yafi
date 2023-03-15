<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_datatables extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');
	//Do your magic here
	}
	

	public function get_daftar_nilai($tahun = null, $gelombang = null)
	{
		$where['tahun'] = $tahun;
		$where['gelombang'] = $gelombang;


		$id_ujian = $this->db->where(array_filter($where, function($value) {
			return ($value !== null && $value !== FALSE && $value !== '');}))->get('ujian')->row_array()['id'];

		$this->datatables->select('peserta.id as id_peserta, peserta.no_peserta, peserta.nama, peserta.id_ujian, peserta.nilai, ujian.tahun, ujian.gelombang');
		$this->datatables->from('peserta');
		$this->datatables->join('ujian', 'peserta.id_ujian = ujian.id');
		if ($where['tahun'] != 'all') {
			$this->datatables->where('ujian.tahun', $where['tahun']);
		}
		if ($where['gelombang'] != 'all') {
			$this->datatables->where('ujian.gelombang', $where['gelombang']);
		}
		

		$this->datatables->where('peserta.selesai_ujian', '1');
		$this->datatables->add_column('number', '0');
		$this->datatables->add_column('tahun_gelombang', '$1/$2', 'tahun,gelombang');
		return  $this->datatables->generate();


	}
}

/* End of file Model_datatables.php */
/* Location: ./application/models/Model_datatables.php */