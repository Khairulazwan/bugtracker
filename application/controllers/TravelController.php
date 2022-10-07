<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TravelController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkIsLogin();
		$this->load->model('TravelModel', 'tMO', TRUE);
	}

	public function index()
	{
		$data['title'] = 'Travel Application Form';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$this->form_validation->set_rules('purpose', 'Purpose of Travel', 'required');
		$this->form_validation->set_rules('dep_route', 'Depart Route', 'required');
		$this->form_validation->set_rules('ret_route', 'Return Route', 'required');
		$this->form_validation->set_rules('transport', 'Transportation Type', 'required');
		$this->form_validation->set_rules('dep_date', 'Depart Date', 'required');
		$this->form_validation->set_rules('ret_date', 'Return Date', 'required');
		$this->form_validation->set_rules('dep_date', 'Depart Time', 'required');
		$this->form_validation->set_rules('ret_date', 'Return Time', 'required');

		if ($this->form_validation->run() == false) {
			$data['userInfo'] = $this->tMO->getUserInfo($data);
			$data['page_name']  = "travel/appform";
			$this->load->view('index', $data);
		} else {
			$tra_no = $this->_travel_no(); // generate Travel Number
			$this->tMO->addForm($tra_no);
			//Configuration to send email notification
			$this->load->library("email");
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_timeout' => '30',
				'smtp_port' => '465',
				'smtp_user' => 'system_admin@ppks.edu.my',
				'smtp_pass' => 'Swk12345',
				'charset' => 'utf-8',
				'mailtype' => 'html',
				'newline' => '\r\n',
			);
			$staffName = $this->input->post('fullname');
			$time = date('d/m/Y', time());
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->set_crlf("\r\n");
			$this->email->to('khairulazwan@ppks.edu.my');
			// $emailUser = $this->input->post('email');
			// $this->email->to($emailUser );
			$this->email->from('system_admin@ppks.edu.my', 'System Administrator');
			$this->email->subject("Appraisal System");
			$this->email->message("Travel application has been submitted by $staffName on $time. Pending for your approval.. http://localhost/appraisal ");
			if ($this->email->send()) {
				$this->session->set_flashdata('email_send', 'Mail sent successfully!');
			} else {
				echo "Something went wrong!";
				$this->session->set_flashdata('email_send', 'Failed. Something is wrong.');
			}
			redirect('viewTravel');
		}
	}

	public function subsistence($t_id)
	{
		$data['title'] = 'Travel and Subsistence Claim Form';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		if ($this->form_validation->run() == false) {
			$data['travel'] = $this->tMO->getTravelData($t_id);
			// if ($data['supp_status'] == '1') {
			// 	$data['page_name']  = "travel/subsistenceForm";
			// }
			// else{
			// 	$data['page_name']  = "extra-pages/error400";
			// }
			$data['page_name']  = "travel/subsistenceForm";
			$this->load->view('index', $data);
		} else {
			// $this->tMO->addForm();
			redirect('subsistence');
		}
	}

	public function subsistenceUser()
	{
		$data['title'] = 'Travel and Subsistence Claim Form';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		if ($this->form_validation->run() == false) {
			$data['userInfo'] = $this->tMO->getUserInfo($data);
			$data['page_name']  = "travel/subsistenceForm1";
			$this->load->view('index', $data);
		} else {
			// $this->tMO->addForm();
			redirect('subsistence');
		}
	}

	public function viewTravelA()
	{
		$data['title'] = 'Staff Travel Application';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$data['travelApp'] = $this->tMO->getTravelAdmin($data);

		$data['page_name']  = "travel/viewAdmin";
		$this->load->view('index', $data);
	}

	public function adminApprList()
	{
		$data['title'] = 'Claim Approved List';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$data['travelApp'] = $this->tMO->getTravelAdmin($data);

		$data['page_name']  = "travel/appr_list";
		$this->load->view('index', $data);
	}

	public function supportApprList()
	{
		$data['title'] = 'Claim Approved List';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$data['travelApp'] = $this->tMO->getTravelAdmin($data);

		$data['page_name']  = "travel/supp_itinerary";
		$this->load->view('index', $data);
	}

	public function viewTravelM()
	{
		$data['title'] = 'Staff Travel Application';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$data['travelApp'] = $this->tMO->getTravelManager($data);



		$data['page_name']  = "travel/viewManager";
		$this->load->view('index', $data);
	}

	public function viewTravelUser()
	{
		$data['title'] = 'Submitted Travel Application';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$data['travelUser'] = $this->tMO->getTravelUser($data);

		$data['page_name']  = "travel/viewUser";
		$this->load->view('index', $data);
	}

	public function approveHOD()
	{
		$t_id = $this->input->post('id');
		$this->tMO->approveTravelHOD($t_id);
		redirect('viewTravelM');
	}

	public function approveED()
	{
		$t_id = $this->input->post('id');
		$this->tMO->approveTravelED($t_id);
		redirect('viewTravelA');
	}

	private function _travel_no()
	{
		$this->db->select('tra_no');
		$this->db->from('travel');
		$this->db->order_by('t_id', 'DESC');
		$this->db->limit(1);
		$preTraNo = $this->db->get()->row_array();

		if (substr($preTraNo['tra_no'], 2, 2) == date("y") && substr($preTraNo['tra_no'], 4, 2) == date("m")) { //substring for year and month after the "TR"
			$firstTraNo = substr($preTraNo['tra_no'], 0, 6);
			$lastTraNo = strval(substr($preTraNo['tra_no'], 6, 4));
			$lastTraNoNew = str_pad($lastTraNo + 1, 3, 0, STR_PAD_LEFT);
			return strval($firstTraNo . $lastTraNoNew);
		} else {
			return "TR" . date("ym") . "001";
		}
	}

	public function submitItin()
	{
		$travelID = $this->input->post('id');
		$this->tMO->submitItinerary($travelID);
		redirect('approveSupp');
	}

	public function editTravel($t_id)
	{
		$data['title'] = 'Edit Travel Application';
		$data['fullname'] = $this->session->userdata('fullname');
		$data['designation'] = $this->session->userdata('designation');

		$this->form_validation->set_rules('purpose', 'Purpose of Travel', 'required');
		$this->form_validation->set_rules('dep_route', 'Depart Route', 'required');
		$this->form_validation->set_rules('ret_route', 'Return Route', 'required');
		$this->form_validation->set_rules('transport', 'Transportation Type', 'required');
		$this->form_validation->set_rules('dep_date', 'Depart Date', 'required');
		$this->form_validation->set_rules('ret_date', 'Return Date', 'required');
		$this->form_validation->set_rules('dep_date', 'Depart Time', 'required');
		$this->form_validation->set_rules('ret_date', 'Return Time', 'required');

		if ($this->form_validation->run() == false) {
			$data['travelData'] = $this->tMO->getTravelData($t_id);
			$data['page_name']  = "travel/edit_application";
			$this->load->view('index', $data);
		} else {
			$this->tMO->editForm($t_id);
			redirect('viewTravel');
		}
	}
}
