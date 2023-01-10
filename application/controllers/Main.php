<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		if(!isset($_SESSION['loggedIn'])){
			redirect('user');
	  }
	}

	public function index()
	{
		$query = $this->db->where('id', 1)->get('tbldate');
		$data['info'] = $query->row();
		$date_added = $data['info']->date_added;
		$date_now = date('Y-m-d');

		if($date_added > $date_now) {
			$this->load->view('header');
			$this->load->view('opening', $data);
			$this->load->view('footer');
		}else{
			$data['lab'] = $this->db->where('userID', $_SESSION['loggedIn']['user_id'])->get('tbl_laboratory')->result();
			$this->load->view('header');
			$this->load->view('footer');
			$this->load->view('dashboard', $data);
		}

		// $data['lab'] = $this->db->where('userID', $_SESSION['loggedIn']['user_id'])->get('tbl_laboratory')->result();
		// $this->load->view('header');
		// $this->load->view('footer');
		// $this->load->view('dashboard', $data);

	}

	public function new_applicant()
	{
		$query = $this->db->where('id', 1)->get('tbldate');
		$data['info'] = $query->row();
		$date_added = $data['info']->date_added;
		$date_now = date('Y-m-d');

		if($date_added > $date_now) {
			$this->load->view('header');
			$this->load->view('opening', $data);
			$this->load->view('footer');
		}else{
			$data['province'] = $this->db->order_by('name','ASC')->get('covid19db.psgc_province')->result();
			$this->load->view('header');
			$this->load->view('footer');
			$this->load->view('new_applicant', $data);
		}

		// $data['province'] = $this->db->order_by('name','ASC')->get('covid19db.psgc_province')->result();
		// $this->load->view('header');
		// $this->load->view('footer');
		// $this->load->view('new_applicant', $data);
	}

	public function register_old_applicant($labID)
	{
		$this->db->where('labID', $labID);
		$query = $this->db->get('tbl_laboratory');
		$data['lab'] = $query->row();

		$code = $data['lab']->province_code;
		$code1 = $data['lab']->municipal_code;
		$code2 = $data['lab']->brgy_code;
		$data['province_name'] = $this->db->where('code', $code)->order_by('name')->get('covid19db.psgc_province')->row();
		$data['mun'] = $this->db->where('code', $code1)->order_by('name')->get('covid19db.psgc_municipal')->row();
		$data['brgy'] = $this->db->where('code', $code2)->order_by('name')->get('covid19db.psgc_brgy')->row();


		$this->load->view('header');
		$this->load->view('footer');
		$this->load->view('register_old', $data);
	}

	public function old_applicant()
	{
		$data['lab'] = $this->db->where('userID', $_SESSION['loggedIn']['user_id'])->get('tbl_laboratory')->result();
		$this->load->view('header');
		$this->load->view('footer');
		$this->load->view('old_applicant', $data);
	}

	public function get_municipal($prov=NULL,$value=NULL){
		$code = $prov ? $prov:$this->input->post('code',TRUE);
		$res = $this->db->like('code',substr($code,0,4),'after')->order_by('name', 'ASC')->get('covid19db.psgc_municipal')->result();
		$option = '<option value=""></option>';
		foreach($res as $val){
			$option .= '<option value="'.$val->code.'" '.($value && $value == $val->code ? 'selected':'').'>'.strtoupper($val->name).'</option>';
		}
		if($prov)
			return $option;
		else
			echo json_encode($option);
	}


	public function get_provice($prov=NULL,$value=NULL){
		$code = $prov ? $prov:$this->input->post('code',TRUE);
		// $res = $this->db->like('code', $code)->order_by('name', 'ASC')->get('covid19db.psgc_municipal')->result();
		$res = $this->db->order_by('name', 'ASC')->get('covid19db.psgc_province')->result();
		$option = '<option value=""></option>';
		foreach($res as $val){
			$option .= '<option value="'.$val->code.'" '.($value && $value == $val->code ? 'selected':'').'>'.strtoupper($val->name).'</option>';
		}
		if($prov)
			return $option;
		else
			echo json_encode($option);
	}

	public function get_barangay($muni=NULL,$value=NULL){

		$code = $muni ? $muni:$this->input->post('code',TRUE);

		$brgy = $this->db->like('code',substr($code,0,6),'after')->order_by('name', 'ASC')->get('covid19db.psgc_brgy')->result();
		// print_r($brgy);
		$option = '<option value=""></option>';
		foreach($brgy as $val){
			$option .= '<option value="'.$val->code.'" '.($value && $value == $val->code ? 'selected':'').'>'.strtoupper($val->name).'</option>';
		}
		if($muni)
			return $option;
		else
			echo json_encode($option);
	}

	// public function generate_pdf()
	// {
	// 	require_once 'vendor/autoload.php';
	// 	$this->load->helper('url');
	// 	$mpdf = new \Mpdf\Mpdf(['margin_top' => 2]);
	// 	$mpdf->showImageErrors = true;
	// 	$html = $this->load->view('generate_pdf',[],true);
	// 	$mpdf->WriteHTML($html);
	// 	$mpdf->Output();
	// }

	public function edit_application()
	{
		$this->load->model('Save_model');
		$re_no = $this->uri->segment(3);
		$list = $this->Save_model->generate_pdf($re_no);
		$data['result'] = $list;

		$labInfo['lab'] = $this->db->where('reference_no', $re_no)->get('tbl_participant')->row();

		$address = $this->db->where('labID', $labInfo['lab']->lab_ID)->get('tbl_laboratory')->row();

		$code = $address->province_code;
		$code1 = $address->municipal_code;
		$code2 = $address->brgy_code;

		$data['province_name'] = $this->db->where('code', $code)->order_by('name')->get('covid19db.psgc_province')->result();
		$data['mun'] = $this->db->where('code', $code1)->order_by('name')->get('covid19db.psgc_municipal')->result();
		$data['brgy'] = $this->db->where('code', $code2)->order_by('name')->get('covid19db.psgc_brgy')->result();
		$data['no_street'] = $address->no_street;
		$data['postal'] = $address->postal_code;
		$data['contact_no'] = $address->contact_number;
		$data['email_add'] = $address->email_add;
		$data['institution'] = $address->institution_name;
		$data['lab_id'] = $address->labID;
		// $data['lto_file_download'] = $labInfo['lab']->lto_file;

		$data['province_name'] = $this->db->where('code', $code)->order_by('name')->get('covid19db.psgc_province')->result();
		$data['mun'] = $this->db->where('code', $code1)->order_by('name')->get('covid19db.psgc_municipal')->result();
		$data['brgy'] = $this->db->where('code', $code2)->order_by('name')->get('covid19db.psgc_brgy')->result();

		$this->load->view('header');
		$this->load->view('footer');
		$this->load->view('edit_application', $data);
	}

}
?>
