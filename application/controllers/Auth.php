<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		goToDefaultPage();
		$data['title'] = 'Bug Tracking System Login';

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('auth/login', $data);
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = htmlspecialchars($this->input->post('username', true));
		$password = htmlspecialchars($this->input->post('password', true));

		$user = $this->db->get_where('user', ['username' => $username])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
				// session script
				$data = [
					'user_id' => $user['id'],
					'fullname' => $user['fullname'],
					'designation' => $user['designation'],
					'lvl_access' => $user['lvl_access']
				];
				$this->session->set_userdata($data);

				if ($user['lvl_access'] == "ADMIN") { // success: admin
					redirect('viewBugA');	
				} 
				elseif ($user['lvl_access'] == "EXPERT") { // success: expertise/someone can solve the bug/issues
					redirect('viewBugE');	
				} 
				else { // success: user
					redirect('viewBug');
				}
			} else { // error: wrong password
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Wrong password!</div>');
				redirect('auth');
			}
		} else { // error: wrong staffID
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Wrong staffID!</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('fullname');
		$this->session->unset_userdata('lvl_access');
		$this->session->set_flashdata('message', '<div class="alert alert-success">You have been logged out!</div>');
		redirect('auth');
	}
}