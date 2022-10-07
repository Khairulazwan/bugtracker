<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bugcontroller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkIsLogin();
		$this->load->model('Bugmodel', 'tMO', TRUE);
	}

	public function index()
	{
		$data['title'] = 'Bug Reporting Form';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$this->form_validation->set_rules('bug_desc', 'Bug Description', 'required');

		if ($this->form_validation->run() == false) {
			$data['userInfo'] = $this->tMO->getUserInfo($data);
			$data['page_name']  = "bug/appform";
			$this->load->view('index', $data);
		} else {
			$bug_no = $this->_bug_no(); // generate Travel Number
			$this->tMO->addForm($bug_no);
			$this->session->set_flashdata('flashData', 'Data has been submitted successfully!');
			redirect('viewBug');
		}
	}

	public function viewBugUser()
	{
		$data['title'] = 'Submitted Bug Report';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$data['bugUser'] = $this->tMO->getBugUser($data);

		$data['page_name']  = "bug/viewUser";
		$this->load->view('index', $data);
	}

	public function viewBugA()
	{
		$data['title'] = 'Bug Report List';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$data['bugAdmin'] = $this->tMO->getBugAdmin($data);

		$data['page_name']  = "bug/viewAdmin";
		$this->load->view('index', $data);
	}

	public function assignUser()
	{
		$b_id = $this->input->post('id');
		$as_date = $this->input->post('date');
		$this->tMO->assignExpert($b_id, $as_date);
		$this->session->set_flashdata('updateData', 'Details are successfully updated!');
		redirect('viewBugA');
	}

	public function viewBugE()
	{
		$data['title'] = 'Bug Report List';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$data['bugExpert'] = $this->tMO->getBugExpert($data);

		$data['page_name']  = "bug/viewExpert";
		$this->load->view('index', $data);
	}

	public function updateStatus()
	{
		$b_id = $this->input->post('id');
		$com_date = $this->input->post('date');
		$this->tMO->statusUpdate($b_id, $com_date);
		$this->session->set_flashdata('updateData', 'Details are successfully updated!');
		redirect('viewBugE');
	}

	public function eClosed()
	{
		$data['title'] = 'Bug Report List';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$data['bugExpert'] = $this->tMO->getBugExpert($data);

		$data['page_name']  = "bug/expertClosed";
		$this->load->view('index', $data);
	}

	public function aClosed()
	{
		$data['title'] = 'Bug Report List';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$data['bugAdmin'] = $this->tMO->getBugAdmin($data);

		$data['page_name']  = "bug/adminClosed";
		$this->load->view('index', $data);
	}

	private function _bug_no()
	{
		$this->db->select('bug_no');
		$this->db->from('report');
		$this->db->order_by('b_id', 'DESC');
		$this->db->limit(1);
		$preBugNo = $this->db->get()->row_array();

		if (substr($preBugNo['bug_no'], 3, 2) == date("y") && substr($preBugNo['bug_no'], 5, 2) == date("m")) { //substring for year and month after the "BUG"
			$firstBugNo = substr($preBugNo['bug_no'], 0, 7);
			$lastBugNo = strval(substr($preBugNo['bug_no'], 7, 4));
			$lastBugNoNew = str_pad($lastBugNo + 1, 3, 0, STR_PAD_LEFT);
			return strval($firstBugNo . $lastBugNoNew);
		} else {
			return "BUG" . date("ym") . "001";
		}
	}


}
