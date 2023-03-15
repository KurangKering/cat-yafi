<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == TRUE) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('Model_admin');
			$dataAdmin = $this->Model_admin->where(array('username' => $username, 'password' => $password))->as_array()->get();
			if ((bool) $dataAdmin) {
				$arrSess = array(
					'username' => $dataAdmin['username'],
					'nama' => $dataAdmin['nama'],
				);
				
				$this->session->set_userdata('admin', $arrSess );
				redirect(site_url('admin'));

			} else
			{
				$data['error'] = 'username / password salah';
				$this->load->view('admin/view_login_admin', $data);

			}

		} else {
			$this->load->view('admin/view_login_admin');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('admin');
		redirect(site_url());
	}
}
