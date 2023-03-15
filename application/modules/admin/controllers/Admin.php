<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->template->set_template('templates/temp_admin');
		$this->load->model('Model_pelajaran');
		$this->load->model('Model_soal');
		$this->load->model('Model_ujian');
		$this->load->model('Model_peserta');
		if (!$this->session->userdata('admin')) {
			redirect(site_url());
		}

	}
	public function index()
	{
		
		$this->template->title('Dashboard Admin');
		$this->template->render('view_dashboard');
	}

	public function kelola_pelajaran()
	{
		


		$totalRow = count((array) $this->Model_pelajaran->get_all());
		$offset = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		$limit = 5;

		$data['pelajarans'] = $this->Model_pelajaran->with_soals('fields:*count*')->as_array()->order_by('created_at', 'desc')->limit($limit, $offset)->get_all();
		

		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/kelola_pelajaran/';
		$config['total_rows'] = $totalRow;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close']   = '</ul>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$this->template->title('Kelola Pelajaran');
		$this->template->render('view_kelola_pelajaran', $data);
	}
	public function tambah_pelajaran()
	{
		$this->form_validation->set_rules(
			'nama', 
			'nama', 
			'required|is_unique[pelajaran.nama]',
			array
			(
				'is_unique' => 'Pelajaran ini telah terdaftar',
				'required' => 'Pelajaran tidak boleh kosong',

			)

		);
		if ($this->form_validation->run() == TRUE) {

			$insert['nama'] = $this->input->post('nama');
			$this->Model_pelajaran->insert($insert);
			redirect('admin/kelola_pelajaran');
		} else {

			$data['errors'] = $this->form_validation->error_array();
			$this->template->title('Tambah Pelajaran');
			$this->template->render('view_tambah_pelajaran', $data);
		}
		
	}
	public function ubah_pelajaran()
	{
		$this->form_validation->set_rules(
			'nama', 
			'nama', 
			'required|is_unique[pelajaran.nama]',
			array
			(
				'is_unique' => 'Pelajaran ini telah terdaftar',
				'required' => 'Pelajaran tidak boleh kosong',

			)

		);
		if ($this->form_validation->run() == TRUE) {

			$id = $this->input->post('id');
			$update['nama'] = $this->input->post('nama');
			$this->Model_pelajaran->update($update, array('id' => $id));
			redirect('admin/kelola_pelajaran');
		} else {
			$id = $this->uri->segment(3);
			$data['pelajaran'] = $this->Model_pelajaran->as_array()->get(array('id' => $id));
			if (empty($data['pelajaran'])) {show_404();}
			$data['errors'] = $this->form_validation->error_array();
			$this->template->title('Ubah Pelajaran');
			$this->template->render('view_ubah_pelajaran', $data);
		}
	}
	public function hapus_pelajaran()
	{
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			$where['id'] = $this->input->post('id');
			$this->Model_pelajaran->delete($where);
			redirect('admin/kelola_pelajaran');
		} else {
			$id = $this->uri->segment(3);
			$data['pelajaran'] = $this->Model_pelajaran->as_array()->get(array('id' => $id));
			$data['errors'] = $this->form_validation->error_array();
			if (empty($data['pelajaran'])) {show_404();}

			$this->template->title('Hapus Pelajaran');
			$this->template->render('view_hapus_pelajaran', $data);
		}
		

	}

	public function cari_soal()
	{

	}
	public function kelola_soal()
	{

		if (!$this->input->get('id_pel') && !$this->input->get('status')) {
			redirect('admin/kelola_soal?id_pel=all&status=all');
		}
		$page = $this->input->get('offset');
		$where['id_pelajaran'] = $this->input->get('id_pel') === 'all' ? '' : $this->input->get('id_pel') ;
		$where['active'] = $this->input->get('status') === 'all' ? '' : $this->input->get('status');
		$where['soal like'] = $this->input->get('kunci') == false ? '' : "%" .$this->input->get('kunci') . "%";


		$limit = 5;
		$offset = $page !== false ? $page : 0; 

		$data['soals'] = $this->Model_soal->limit($limit, $offset)->where(array_filter($where, function($value) {
			return ($value !== null && $value !== FALSE && $value !== '');
		}))->with_pelajaran()->order_by('created_at', 'desc')->as_array()->get_all();


		$tmpRow = ($this->Model_soal->where(array_filter($where, function($value) {
			return ($value !== null && $value !== FALSE && $value !== '');}))->get_all());
		$totalRow = $tmpRow !== false ? count((array)$tmpRow) : 0;
		if ($totalRow == 0 ) {
			$countsStatus[0] = 0;
			$countsStatus[1] = 0;
		} else
		{
			$countsStatus = array_count_values(
				array_column($tmpRow, 'active')
			);
		}
		$totalRowSoalsActive = isset($countsStatus[1]) && $countsStatus[1]  !== false ? $countsStatus[1] : 0;
		$totalRowSoalsInactive = isset($countsStatus[0]) && $countsStatus[0] !== false ? $countsStatus[0] : 0;

		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/kelola_soal';

		$config['total_rows'] = $totalRow;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = 3;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'offset';
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close']   = '</ul>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$query_string = $_GET;
		if (isset($query_string['offset'])) {
			unset($query_string['offset']);
		}
		if (count($query_string) > 0) {
			$config['suffix'] = '&' . http_build_query($query_string, '', "&");
			$config['first_url'] = $config['base_url'] . '?' . http_build_query($query_string, '', "&");
		}
		$data['totalSoal'] = $totalRow;
		$data['soalsActive'] = $totalRowSoalsActive;
		$data['soalsInActive'] = $totalRowSoalsInactive;
		$data['id_pel'] = $this->input->get('id_pel');
		$data['status'] = $this->input->get('status') !== FALSE ? $this->input->get('status') : 0;
		$data['keyword'] = $this->input->get('kunci') !== FALSE ? $this->input->get('kunci') : 0;
		$data['pelajarans'] = $this->Model_pelajaran->as_array()->get_all();
		$this->pagination->initialize($config);
		$this->template->title('Kelola Soal');
		$this->template->render('view_kelola_soal', $data);
	}

	public function tambah_soal()
	{
		$this->form_validation->set_rules('id_pelajaran', 'pelajaran', 'required');
		$this->form_validation->set_rules('soal', 'soal', 'required');
		$this->form_validation->set_rules('pilihan_A', 'pilihan A', 'required');
		$this->form_validation->set_rules('pilihan_B', 'pilihan B', 'required');
		$this->form_validation->set_rules('pilihan_C', 'pilihan C', 'required');
		$this->form_validation->set_rules('pilihan_D', 'pilihan D', 'required');
		$this->form_validation->set_rules('pilihan_E', 'pilihan E', 'required');
		$this->form_validation->set_rules('jawaban', 'jawaban', 'required');

		if ($this->form_validation->run() == TRUE) {

			$insert['soal'] = $this->input->post('soal');
			$insert['pilihan_A'] = $this->input->post('pilihan_A');
			$insert['pilihan_B'] = $this->input->post('pilihan_B');
			$insert['pilihan_C'] = $this->input->post('pilihan_C');
			$insert['pilihan_D'] = $this->input->post('pilihan_D');
			$insert['pilihan_E'] = $this->input->post('pilihan_E');
			$insert['jawaban'] = $this->input->post('jawaban');
			$insert['id_pelajaran'] = $this->input->post('id_pelajaran');
			$insert['active'] = $this->input->post('active');
			$this->Model_soal->insert($insert);
			redirect("admin/kelola_soal?id_pel={$insert['id_pelajaran']}&status=all");
		} else {
			$data['errors'] = $this->form_validation->error_array();

			$data['pelajarans'] = $this->Model_pelajaran->as_array()->get_all();
			$this->template->title('Tambah Soal');
			$this->template->render('view_tambah_soal', $data);
		}
		
	}

	public function ubah_soal()
	{
		$this->form_validation->set_rules('id_pelajaran', 'pelajaran', 'required');
		$this->form_validation->set_rules('soal', 'soal', 'required');
		$this->form_validation->set_rules('pilihan_A', 'pilihan A', 'required');
		$this->form_validation->set_rules('pilihan_B', 'pilihan B', 'required');
		$this->form_validation->set_rules('pilihan_C', 'pilihan C', 'required');
		$this->form_validation->set_rules('pilihan_D', 'pilihan D', 'required');
		$this->form_validation->set_rules('pilihan_E', 'pilihan E', 'required');
		$this->form_validation->set_rules('jawaban', 'jawaban', 'required');

		if ($this->form_validation->run() == TRUE) {
			$id_soal = $this->input->post('id');
			$update['soal'] = $this->input->post('soal');
			$update['pilihan_A'] = $this->input->post('pilihan_A');
			$update['pilihan_B'] = $this->input->post('pilihan_B');
			$update['pilihan_C'] = $this->input->post('pilihan_C');
			$update['pilihan_D'] = $this->input->post('pilihan_D');
			$update['pilihan_E'] = $this->input->post('pilihan_E');
			$update['jawaban'] = $this->input->post('jawaban');
			$update['id_pelajaran'] = $this->input->post('id_pelajaran');
			$update['active'] = $this->input->post('active');
			$this->Model_soal->update($update, array('id' => $id_soal));
			redirect("admin/kelola_soal?id_pel={$update['id_pelajaran']}&status=all");
		} else {
			$id_soal = $this->uri->segment(3);
			$data['pelajarans'] = $this->Model_pelajaran->as_array()->get_all();
			$data['soal'] = $this->Model_soal->as_array()->get(array('id' => $id_soal));
			$this->template->title('Ubah Soal');

			$this->template->render('view_ubah_soal', $data);
		}
	}
	public function hapus_soal()
	{
		$this->template->title('Hapus Soal');
		$this->template->render('view_hapus_soal');
	}
	public function kelola_ujian()
	{
		$totalRow = count((array) $this->Model_ujian->get_all());
		$offset = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$limit = 5;

		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'admin/kelola_ujian/';
		$config['total_rows'] = $totalRow;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close']   = '</ul>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['ujians'] = $this->Model_ujian->get_data_ujians($limit, $offset);

		$this->template->title('Kelola Ujian');
		$this->template->render('view_kelola_ujian', $data);
	}

	public function tambah_ujian()
	{
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|regex_match[/^\d{4}$/]');
		$this->form_validation->set_rules('gelombang', 'Gelombang', 'trim|required|callback_check_tahun_gelombang');
		$this->form_validation->set_rules('durasi', 'Durasi Ujian', 'trim|required|numeric');
		$this->form_validation->set_rules('jumlah_soal', 'Jumlah Soal', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run() == TRUE) {
			$randToken = '';
			$checkAvailableToken = '';

			do {
				$randToken = substr(md5(microtime()), rand(0,26),5);
				$checkAvailableToken = (bool) !$this->Model_ujian->as_array()->get(array('token' => $randToken));
				
			} while ($checkAvailableToken === FALSE);
			$insert['gelombang'] = $this->input->post('gelombang');
			$insert['tahun'] = $this->input->post('tahun');
			$insert['token'] = $randToken;
			$insert['soal_soal'] = json_encode(explode(',', $this->input->post('soal_soal')));
			$insert['durasi']  = $this->input->post('durasi');
			$this->Model_ujian->insert($insert);
			redirect('admin/kelola_ujian');
		} else {
			$data['errors'] = $this->form_validation->error_array();
			$soals_active = $this->Model_soal->where(array('active' => '1'))->as_array()->get_all();
			$data['jumlah_soal'] = $soals_active !== FALSE ? count($soals_active) : '0';
			$data['id_soals'] = $soals_active !== FALSE ? implode(',',array_column($soals_active, 'id')) : '';

			$this->template->title('Tambah Ujian');
			$this->template->render('view_tambah_ujian', $data);
		}
		
	}
	
	public function check_tahun_gelombang()
	{
		$tahun = $this->input->post('tahun');
		$gelombang = $this->input->post('gelombang');
		$res = $this->Model_ujian->as_array()->get(array('tahun' => $tahun, 'gelombang' => $gelombang));
		if (!$res) {
			return true;
		}
		$this->form_validation->set_message('check_tahun_gelombang', '{field} Sudah Ada');
		return false;

	}


	public function json_get_daftar_nilai()
	{	
		$this->load->model('Model_datatables');
		$tahun = '';
		$gelombang = '';
		if ($this->input->post('json')) {
			$tahun = $this->input->post('tahun');
			$gelombang = $this->input->post('gelombang');
		}	else
		{
			$tahun = $this->uri->segment(3);
			$gelombang = $this->uri->segment(4);
		}
		$result = $this->Model_datatables->get_daftar_nilai($tahun, $gelombang);
		if ($this->input->post('json')) {
			header('Content-Type: application/json');
			die($result);
		} else
		return $result;
		
	}

	public function daftar_nilai()
	{
		
		$tahun = $this->uri->segment(3);
		$gelombang = $this->uri->segment(4);


		$data['ujian'] = $this->Model_ujian->as_array()->where(array('tahun' => $tahun, 'gelombang' => $gelombang))->get();
		$data['tahun'] = $tahun;
		$data['gelombang'] = $gelombang;
		$tmpTahuns = $this->Model_ujian->order_by('tahun', 'desc')->as_array()->get_all();
		$data['tahuns'] = $tmpTahuns != FALSE ? array_unique(array_column($tmpTahuns, 'tahun')) : array();


		$this->template->title('Daftar Nilai');
		$this->template->render('view_daftar_nilai', $data);
	}
	public function cetak_daftar_nilai()
	{
		if ($this->input->post()) {
			$this->load->library('Pdfgenerator');

			$where['tahun'] = $this->input->post('tahun') === 'all' ? '' : $this->input->post('tahun');
			$where['gelombang'] = $this->input->post('gelombang') === 'all' ? '' : $this->input->post('gelombang');


			$data['dataUjian'] = $this->Model_ujian->where((array_filter($where, function($value) {
				return ($value !== null && $value !== FALSE && $value !== '');
			})))->as_array()->get();

			if ((bool)$data['dataUjian']) {
				$wheere['id_ujian'] = $data['dataUjian']['id'];
			}
			$wheere['selesai_ujian'] = '1';
			$data['nilais'] = $this->Model_peserta->order_by('nilai', 'desc')->where($wheere)->as_array()->get_all();
			$data['tahun'] = $where['tahun'];
			$data['gelombang'] = $where['gelombang'];
			$output = $this->load->view('view_cetak_peserta', $data, TRUE);

			$name['tahun'] = $where['tahun'] == '' ? 'all' : $where['tahun'];
			$name['gelombang'] = $where['gelombang'] == '' ? 'all' : $where['gelombang'];
			$this->pdfgenerator->generate($output, 'cetak_peserta' . '_'.$name['tahun'].'_'. $name['gelombang']);
		} else
		{
			echo "<script type='text/javascript'>";
			echo "window.close();";
			echo "</script>";
		}

		echo "<script type='text/javascript'>";
		echo "window.close();";
		echo "</script>";


	}
	public function daftar_nilai_peserta()
	{

	}

}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */