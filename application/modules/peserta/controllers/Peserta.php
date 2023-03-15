<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('Response');
		$this->load->model('Model_ujian');
		$this->load->model('Model_peserta');
		$this->load->model('Model_soal');
	}
	public function index()
	{
		
	}

	public function daftar_ujian()
	{

		$this->load->view('peserta/view_daftar_ujian');
	}


	public function cek_ujian()
	{
		if ($this->input->post()) {
			$no_peserta = $this->input->post('no_peserta');
			$nama = $this->input->post('nama');
			$token = $this->input->post('token');
			try {

				if ($no_peserta === '')
					$this->response->addError('No Peserta Tidak Boleh Kosong', "error");
				if ($nama === '')
					$this->response->addError('Nama Tidak Boleh Kosong', 'error');
				if ($token === '')
					$this->response->addError('Token Harap Diisi', 'error');

				if ($this->response->isSuccess()) {
					//cek token
					
					$dataUjian = $this->Model_ujian->where('token', $token)->as_array()->get();
					$soalsActive = $this->Model_soal->where(array('active' => 1))->as_array()->get_all();
					if ($dataUjian) {
						$dataUjian['soal_soal'] = array();
						if ($soalsActive)
							$dataUjian['soal_soal'] = json_encode(array_map(function($tmp) {return $tmp['id'];}, $soalsActive));

					}
					



					if (! (bool) $dataUjian)
						throw new Exception("Token Tidak Terdaftar");
					if ($dataUjian['soal_soal'] == null) 
						throw new Exception("Tidak Ada Soal Yang Akan Diujiankan");

					//cek peserta sudah ujian
					$dataPeserta = $this->Model_peserta->as_array()->where(array('no_peserta' => $no_peserta, 'id_ujian' => $dataUjian['id']))->get();
					if (isset($dataPeserta) && $dataPeserta['selesai_ujian'] == '1')
						throw new Exception("Anda Telah Mengikuti CAT");



					if (!$dataPeserta) {

						$idSoals = json_decode($dataUjian['soal_soal']);

						shuffle($idSoals);

						$listJawaban = array();

						foreach ($idSoals as $ind_idSoal => $idSoal_) {
							$obj = new stdClass();
							$obj->id = $idSoal_;
							$obj->jawaban = '';

							$listJawaban[] = $obj;
						}
						
						$insert['no_peserta'] = $no_peserta;
						$insert['nama'] = $nama;
						$insert['id_ujian'] = $dataUjian['id'];
						$insert['list_jawaban'] = json_encode($listJawaban);
						$this->Model_peserta->insert($insert);

					} else
					{

						$update['nama'] = $nama;
						$this->Model_peserta->update($update, array('id' => $dataPeserta['id']));
					}

					$this->session->unset_userdata('peserta');
					$sessPeserta = array(
						'no_peserta' => $no_peserta,
						'nama' => $nama,
						'data_ujian' => $dataUjian,
					);
					
					$this->session->set_userdata('peserta', $sessPeserta );

				}
			} catch (Exception $e) {
				$this->response->addError($e->getMessage(), 'error');
			}
			die(json_encode($this->response));
		}
	}
	public function ujian()
	{

		$dataSession = $this->session->userdata('peserta');
		if (!$dataSession) 
			redirect(site_url());


		$dataPeserta = $this->Model_peserta->where(array('no_peserta' => $dataSession['no_peserta'], 'id_ujian' => $dataSession['data_ujian']['id']))->as_array()->get();

		$dataUjian = $this->Model_ujian->as_array()->where(array('id' => $dataSession['data_ujian']['id']))->get();


		$data['waktuMulai'] = $dataPeserta['created_at'];
		$data['durasi'] = $dataUjian['durasi'];
		$data['waktuSelesai'] = date('Y/m/d H:i:s' , strtotime($data['waktuMulai'] . "+ {$data['durasi']} minute"));
		$data['listJawaban'] = json_decode($dataPeserta['list_jawaban']);

		$idSoals = array_map(function($tmp) {return $tmp->id;}, $data['listJawaban']);

		$limit = 5;
		$this->load->library('pagination');

		$config['base_url'] = base_url('peserta/ujian/');
		$config['total_rows'] = count($idSoals);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<nav><ul class="pagination" style="margin-top:0px">';
		$config['full_tag_close'] = "</ul></nav>";
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '>>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<<';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['display_pages'] = FALSE;

		$this->pagination->initialize($config);
		$start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$newIdSoals = array_slice($idSoals, $start, $limit);
		$newIdSoals = $newIdSoals != FALSE ? $newIdSoals : '';
		$data['dataPeserta'] = $dataPeserta;
		$data['jumlahSoal'] = count($idSoals);
		$data['soals'] = $this->Model_soal->where('id', $newIdSoals)->as_array()->get_all();

		$this->load->view('view_ujian', $data);
	}

	public function simpan_jawaban()
	{
		if ($this->input->post()) {
			$id_peserta = $this->input->post('id_peserta');
			$id_soal = $this->input->post('id_soal');
			$jawaban = $this->input->post('jawaban');


			$dataPeserta = $this->Model_peserta->where('id', $id_peserta)->as_array()->get();
			$listJawaban = json_decode($dataPeserta['list_jawaban'], true);


			foreach ($listJawaban as $in_jawaban => $jawaban_) {
				if ($id_soal == $jawaban_['id']) {
					$listJawaban[$in_jawaban]['jawaban'] = $jawaban;

				}
			}

			$this->Model_peserta->update(array('list_jawaban' => json_encode($listJawaban)), array('id' => $id_peserta));
			die(json_encode('ok'));
		}
	}


	public function hitung()
	{
		if ($this->input->post()) {
			$id_peserta = $this->input->post('id_peserta');
			$dataPeserta = $this->Model_peserta->where('id', $id_peserta)->as_array()->get();
			$dataUjian = $this->Model_ujian->as_array()->where(array('id' => $dataPeserta['id_ujian']))->get();
			
			if ($dataUjian) {
				$soalsActive = $this->Model_soal->where(array('active' => 1))->as_array()->get_all();

				$dataUjian['soal_soal'] = array();
				if ($soalsActive)
					$dataUjian['soal_soal'] = json_encode(array_map(function($tmp) {return $tmp['id'];}, $soalsActive));

			}

			$jawabanPeserta = json_decode($dataPeserta['list_jawaban'], true);
			
			$masterIdSoals = json_decode($dataUjian['soal_soal']);
			$masterIdSoals = $masterIdSoals != FALSE ? $masterIdSoals : '';
			$masterSoals = $this->Model_soal->where('id', $masterIdSoals)->as_array()->get_all();

			$score = 0;
			$nilaiPerSoal =  (100 / sizeof($masterSoals));
			foreach ($masterSoals as $key_master => $master_soal) {
				foreach ($jawabanPeserta as $key_jawaban => $jawaban_peserta) {
					if ($master_soal['id'] == $jawaban_peserta['id']) {
						if ($master_soal['jawaban'] == $jawaban_peserta['jawaban']) {
							$score += $nilaiPerSoal;
							break;
						}
					}
				}
			}

			$this->Model_peserta->update(array('nilai' => $score, 'selesai_ujian' => '1'), array('id' => $id_peserta));

			$this->session->unset_userdata('peserta');
			die(json_encode($score));
			


		}
	}


}

/* End of file Peserta.php */
/* Location: ./application/modules/peserta/controllers/Peserta.php */