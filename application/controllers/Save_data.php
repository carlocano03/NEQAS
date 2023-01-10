<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Save_data extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Save_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		date_default_timezone_set('Asia/Manila');
	}

  public function save()
  {
		$logic = $this->input->post('logic');

		switch ($logic) {
					case 'NEW PARTICIPANT':
					$date_created = date('Y-m-d H:i:s');
					$time = time();
					$rand = rand(1,1000);
					$year = Date('y');
					$referenceno = 'NEQAS-'.$year .'-'.$time .$rand;
					$labID = $time . $rand;

			    if (!empty($_FILES['lto_file']['name'])) {
						$config['upload_path'] = 'uploaded_file';
						$config['allowed_types'] = 'pdf|jpeg|jpg';
						$config['file_name'] = $referenceno . str_replace(' ', '_', $_FILES['lto_file']['name']);

						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if ($this->upload->do_upload('lto_file')) {
							$uploadData = $this->upload->data();
							$uploadFile = $uploadData['file_name'];
						}else{
							$uploadFile = '';
						}
					}else{
						$uploadFile = '';
					}

			    $insert_labDetails = array(
			      'userID' => $_SESSION['loggedIn']['user_id'],
						'labID' => $labID,
			      'email_add' => $this->input->post('email_add'),
			      'institution_name' => $this->input->post('institution_name'),
			      'no_street' => $this->input->post('no_street'),
			      'brgy_code' => $this->input->post('barangay_code'),
			      'municipal_code' => $this->input->post('municipal_code'),
			      'province_code' => $this->input->post('province_code'),
			      'postal_code' => $this->input->post('postal'),
			      'contact_number' => $this->input->post('contact_no'),
			    );
			    $this->db->insert('tbl_laboratory', $insert_labDetails);

			    $insert_participantDetails = array(
			      'userID' => $_SESSION['loggedIn']['user_id'],
						'lab_ID' => $labID,
			      'reference_no' => $referenceno,
			      'email' => $this->input->post('email_add'),
			      'hospital_chief' => strtoupper($this->input->post('hospital_chief')),
			      'lab_chief' => strtoupper($this->input->post('lab_chief')),
			      'head_bacterioloy' => strtoupper($this->input->post('head_bacterioloy')),
			      'head_para' => strtoupper($this->input->post('head_para')),
			      'head_TB' => strtoupper($this->input->post('head_TB')),
			      'head_bloodService' => strtoupper($this->input->post('head_bloodService')),
			      'participant_status' => $this->input->post('logic'),
			      'lto_file' => $uploadFile,
			      'date_register' => $date_created,
			      'status_approval' => 'FOR APPROVAL',
			    );
			    $this->db->insert('tbl_participant', $insert_participantDetails);

			    $chckGov = isset($_POST['ownership_gov']) ? 1 : 0;
					$chckPrv = isset($_POST['ownership_private']) ? 1 : 0;
					$insertOwner = array(
						'reference_no' => $referenceno,
						'ownership_gov' => $chckGov,
						'ownership_private' => $chckPrv,
					);
					$this->db->insert('tblownership', $insertOwner);

			    $chckbased = isset($_POST['inst_based']) ? 1 : 0;
					$chckfree = isset($_POST['inst_free']) ? 1 : 0;
					$insertInstitutional = array(
						'reference_no' => $referenceno,
						'inst_based' => $chckbased,
						'inst_free' => $chckfree,
					);
					$this->db->insert('tblinstitutional_char', $insertInstitutional);

			    $primary_lab = isset($_POST['primary_lab']) ? 1 : 0;
					$secondary = isset($_POST['secondary']) ? 1 : 0;
					$tertiary = isset($_POST['tertiary']) ? 1 : 0;
					$special = isset($_POST['special']) ? 1 : 0;
					$anaerobic = isset($_POST['anaerobic']) ? 1 : 0;
					$insertService = array(
						'reference_no' => $referenceno,
						'primary_lab' => $primary_lab,
						'secondary' => $secondary,
						'tertiary' => $tertiary,
						'special' => $special,
						'anaerobic' => $anaerobic,
					);
					$this->db->insert('tblservice_capability', $insertService);

			    $bloodCU = isset($_POST['bloodCU']) ? 1 : 0;
					$bloodSt = isset($_POST['bloodSt']) ? 1 : 0;
					$bloodCUBS = isset($_POST['bloodCUBS']) ? 1 : 0;
					$bloodBk = isset($_POST['bloodBk']) ? 1 : 0;
					$bloodBkF = isset($_POST['bloodBkF']) ? 1 : 0;
					$bloodCr = isset($_POST['bloodCr']) ? 1 : 0;
					$insertBlood = array(
						'reference_no' => $referenceno,
						'bloodCU' => $bloodCU,
						'bloodSt' => $bloodSt,
						'bloodCUBS' => $bloodCUBS,
						'bloodBk' => $bloodBk,
						'bloodBkF' => $bloodBkF,
						'bloodCr' => $bloodCr,
					);
					$this->db->insert('tblblood_service', $insertBlood);

			    if (isset($_POST['others'])) {
						$chck_tel = isset($_POST['chck_tel']) ? 1 : 0;
						$chck_mobile = isset($_POST['chck_mobile']) ? 1 : 0;
						$chck_email = isset($_POST['chck_email']) ? 1 : 0;
						$chck_fax = isset($_POST['chck_fax']) ? 1 : 0;
						$others = isset($_POST['others']) ? 1 : 0;
						$insertShipInfo = array(
							'reference_no' => $referenceno,
							'contact_person' => strtoupper($this->input->post('contact_person')),
							'telephone' => $this->input->post('telephone'),
							'fax' => $this->input->post('fax'),
							'contact_no' => $this->input->post('contact_num'),
							'email' => $this->input->post('ship_email'),
							'dept_lab_branch' => strtoupper($this->input->post('dept_lab_branch')),
							'trunk_line' => $this->input->post('trunk_line'),
							'local_no' => $this->input->post('local_no'),
							'ship_address' => strtoupper($this->input->post('ship_address')),
							'ship_consignee' => strtoupper($this->input->post('shipping_consignee')),
							'desig_chief_director' => strtoupper($this->input->post('designation_chief')),
							'chck_tel' => $chck_tel,
							'chck_mobile' => $chck_mobile,
							'chck_email' => $chck_email,
							'chck_fax' => $chck_fax,
							'others' => $others,
							'other_specify' => strtoupper($this->input->post('other_specify')),
							'shipping_instructions' => strtoupper($this->input->post('shipping_instruction')),
						);
					}else{
						$chck_tel = isset($_POST['chck_tel']) ? 1 : 0;
						$chck_mobile = isset($_POST['chck_mobile']) ? 1 : 0;
						$chck_email = isset($_POST['chck_email']) ? 1 : 0;
						$chck_fax = isset($_POST['chck_fax']) ? 1 : 0;
						$others = isset($_POST['others']) ? 1 : 0;
						$insertShipInfo = array(
							'reference_no' => $referenceno,
							'contact_person' => strtoupper($this->input->post('contact_person')),
							'telephone' => $this->input->post('telephone'),
							'fax' => $this->input->post('fax'),
							'contact_no' => $this->input->post('contact_num'),
							'email' => $this->input->post('ship_email'),
							'dept_lab_branch' => strtoupper($this->input->post('dept_lab_branch')),
							'trunk_line' => $this->input->post('trunk_line'),
							'local_no' => $this->input->post('local_no'),
							'ship_address' => strtoupper($this->input->post('ship_address')),
							'ship_consignee' => strtoupper($this->input->post('shipping_consignee')),
							'desig_chief_director' => strtoupper($this->input->post('designation_chief')),
							'chck_tel' => $chck_tel,
							'chck_mobile' => $chck_mobile,
							'chck_email' => $chck_email,
							'chck_fax' => $chck_fax,
							'others' => $others,
							'shipping_instructions' => strtoupper($this->input->post('shipping_instruction')),
						);
					}
					$this->db->insert('tblship_information_details', $insertShipInfo);

			    $chck_bac = isset($_POST['chck_bac']) ? 1 : 0;
			    $chck_para = isset($_POST['chck_para']) ? 1 : 0;
			    $chck_TB = isset($_POST['chck_TB']) ? 1 : 0;
			    $chck_culture = isset($_POST['chck_culture']) ? 1 : 0;
			    $chck_serology = isset($_POST['chck_serology']) ? 1 : 0;

			    $insertProgram = array(
			      'reference_no' => $referenceno,
			      'chck_bac' => $chck_bac,
			      'chck_para' => $chck_para,
			      'chck_TB' => $chck_TB,
			      'chck_culture' => $chck_culture,
			      'chck_serology' =>$chck_serology,
			      'total_payment' => $this->input->post('total_hide'),
			    );
			    $this->db->insert('tblprogram_Enrollment', $insertProgram);

			    $cash = isset($_POST['cash']) ? 1 : 0;
			    $company = isset($_POST['company']) ? 1 : 0;
			    $landbank = isset($_POST['landbank']) ? 1 : 0;
			    $mds = isset($_POST['mds']) ? 1 : 0;
			    $insertPayment = array(
			      'reference_no' => $referenceno,
			      'cash' => $cash,
			      'company' => $company,
			      'landbank' => $landbank,
			      'mds' => $mds,
			      'payment_status' => 'NOT YET PAID',
			    );
			    $this->db->insert('tblpayment', $insertPayment);

			    $insertAttestation = array(
						'reference_no' => $referenceno,
						'noted_by' => $this->input->post('noted_by'),
						'date_by' => $this->input->post('date_by'),
					);
					$this->db->insert('tblattestation', $insertAttestation);

			    //Generate email with attachment
			    require_once 'vendor/autoload.php';
					$this->load->model('Save_model');

			    $code = $this->input->post('province_code');
					$code1 = $this->input->post('municipal_code');
					$code2 = $this->input->post('barangay_code');
			    $data['province_name'] = $this->db->where('code', $code)->order_by('name')->get('covid19db.psgc_province')->result();
					$data['mun'] = $this->db->where('code', $code1)->order_by('name')->get('covid19db.psgc_municipal')->result();
					$data['brgy'] = $this->db->where('code', $code2)->order_by('name')->get('covid19db.psgc_brgy')->result();

					$data['no_street'] = $this->input->post('no_street');
					$data['postal'] = $this->input->post('postal');
					$data['contact_no'] = $this->input->post('contact_no');
					$data['email_add'] = $this->input->post('email_add');
					$data['institution'] = $this->input->post('institution_name');

			    $data['result'] = $this->Save_model->generate_pdf($referenceno);
					$mpdf = new \Mpdf\Mpdf(['margin_top' => 2]);
					$mpdf->showImageErrors = true;
					$html = $this->load->view('generate_pdf', $data, true);
					$file = '';
			    $file = 'APPLICATION-' . $referenceno;
					$pdfFilePath = "";
			    $pdfFilePath = FCPATH . "uploaded_file/" . $file . ".pdf";
					$mpdf->WriteHTML($html);
					$mpdf->Output($pdfFilePath, "F");

			    $config = Array(
					  'protocol' => 'smtp',
					  'smtp_host' => 'ssl://smtp.googlemail.com',
					  'smtp_port' => 465,
						'smtp_user' => 'autoreply@ritm.gov.ph', // change it to yours
					  'smtp_pass' => 'ch@ng30il2021_v2', // change it to yours
					  'mailtype' => 'html',
					  'charset' => 'iso-8859-1',
					  'wordwrap' => TRUE
					);
					$this->load->library('email', $config);

			    $message = '
			    Dear NEQAS applicant,<br><br>
			    Greetings!<br><br>

			    We have received your application and will be subject for review.<br><br>
			    If you have any concerns or clarifications, please send us an email at <b>neqas@ritm.gov.ph</b><br><br>

					<hr>
					If you did not register for this, please disregard the email. If you have any concerns, please do not hesitate to reach us through our NEQAS contact details:<br>
					<b>Email: neqas@ritm.gov.ph<br>
					Contact Numbers:<br>
					Landline: (02) 8850 1949<br>
					Cellphone: 0945 220 4141<b><br><br>

			    Thank You.<br>
			    <b>RITM NEQAS TEAM</b><br><br>
			    *** This is a system generated message. <b>DO NOT REPLY TO THIS EMAIL. ***</b>
			    ';
			    $this->email->set_newline("\r\n");
			    $this->email->from('autoreply@ritm.gov.ph');
			    $this->email->to($_POST['email_add']);
			    $this->email->subject('RITM NEQAS Application [REF NO. '.$referenceno.']');
			    $this->email->message($message);
			    $this->email->attach($pdfFilePath);
			    $this->email->send();
			    $this->email->clear(true);
			    unlink($pdfFilePath);
				break;

//OLD Participant
			case 'OLD PARTICIPANT':
					$date_created = date('Y-m-d H:i:s');
					$time = time();
					$rand = rand(1,1000);
					$year = Date('y');
					$referenceno = 'NEQAS-'.$year .'-'.$time .$rand;
					// $labID = $time . $rand;

					$updateLab = array(
						'email_add' => $this->input->post('email_add'),
						'contact_number' => $this->input->post('contact_no'),
					);
					$this->db->where('labID', $this->input->post('labID'))->update('tbl_laboratory', $updateLab);

					$insert_participantDetails = array(
						'userID' => $_SESSION['loggedIn']['user_id'],
						'lab_ID' => $this->input->post('labID'),
						'reference_no' => $referenceno,
						'email' => $this->input->post('email_add'),
						'hospital_chief' => strtoupper($this->input->post('hospital_chief')),
						'lab_chief' => strtoupper($this->input->post('lab_chief')),
						'head_bacterioloy' => strtoupper($this->input->post('head_bacterioloy')),
						'head_para' => strtoupper($this->input->post('head_para')),
						'head_TB' => strtoupper($this->input->post('head_TB')),
						'head_bloodService' => strtoupper($this->input->post('head_bloodService')),
						// 'participant_status' => 'OLD PARTICIPANT',
						'participant_status' => $this->input->post('logic'),
						'year_last_participated' => $this->input->post('year_participated'),
						'date_register' => $date_created,
						'status_approval' => 'FOR APPROVAL',
					);
					$this->db->insert('tbl_participant', $insert_participantDetails);

					$chckGov = isset($_POST['ownership_gov']) ? 1 : 0;
					$chckPrv = isset($_POST['ownership_private']) ? 1 : 0;
					$insertOwner = array(
						'reference_no' => $referenceno,
						'ownership_gov' => $chckGov,
						'ownership_private' => $chckPrv,
					);
					$this->db->insert('tblownership', $insertOwner);

					$chckbased = isset($_POST['inst_based']) ? 1 : 0;
					$chckfree = isset($_POST['inst_free']) ? 1 : 0;
					$insertInstitutional = array(
						'reference_no' => $referenceno,
						'inst_based' => $chckbased,
						'inst_free' => $chckfree,
					);
					$this->db->insert('tblinstitutional_char', $insertInstitutional);

					$primary_lab = isset($_POST['primary_lab']) ? 1 : 0;
					$secondary = isset($_POST['secondary']) ? 1 : 0;
					$tertiary = isset($_POST['tertiary']) ? 1 : 0;
					$special = isset($_POST['special']) ? 1 : 0;
					$anaerobic = isset($_POST['anaerobic']) ? 1 : 0;
					$insertService = array(
						'reference_no' => $referenceno,
						'primary_lab' => $primary_lab,
						'secondary' => $secondary,
						'tertiary' => $tertiary,
						'special' => $special,
						'anaerobic' => $anaerobic,
					);
					$this->db->insert('tblservice_capability', $insertService);

					$bloodCU = isset($_POST['bloodCU']) ? 1 : 0;
					$bloodSt = isset($_POST['bloodSt']) ? 1 : 0;
					$bloodCUBS = isset($_POST['bloodCUBS']) ? 1 : 0;
					$bloodBk = isset($_POST['bloodBk']) ? 1 : 0;
					$bloodBkF = isset($_POST['bloodBkF']) ? 1 : 0;
					$bloodCr = isset($_POST['bloodCr']) ? 1 : 0;
					$insertBlood = array(
						'reference_no' => $referenceno,
						'bloodCU' => $bloodCU,
						'bloodSt' => $bloodSt,
						'bloodCUBS' => $bloodCUBS,
						'bloodBk' => $bloodBk,
						'bloodBkF' => $bloodBkF,
						'bloodCr' => $bloodCr,
					);
					$this->db->insert('tblblood_service', $insertBlood);

					if (isset($_POST['others'])) {
						$chck_tel = isset($_POST['chck_tel']) ? 1 : 0;
						$chck_mobile = isset($_POST['chck_mobile']) ? 1 : 0;
						$chck_email = isset($_POST['chck_email']) ? 1 : 0;
						$chck_fax = isset($_POST['chck_fax']) ? 1 : 0;
						$others = isset($_POST['others']) ? 1 : 0;
						$insertShipInfo = array(
							'reference_no' => $referenceno,
							'contact_person' => strtoupper($this->input->post('contact_person')),
							'telephone' => $this->input->post('telephone'),
							'fax' => $this->input->post('fax'),
							'contact_no' => $this->input->post('contact_num'),
							'email' => $this->input->post('ship_email'),
							'dept_lab_branch' => strtoupper($this->input->post('dept_lab_branch')),
							'trunk_line' => $this->input->post('trunk_line'),
							'local_no' => $this->input->post('local_no'),
							'ship_address' => strtoupper($this->input->post('ship_address')),
							'ship_consignee' => strtoupper($this->input->post('shipping_consignee')),
							'desig_chief_director' => strtoupper($this->input->post('designation_chief')),
							'chck_tel' => $chck_tel,
							'chck_mobile' => $chck_mobile,
							'chck_email' => $chck_email,
							'chck_fax' => $chck_fax,
							'others' => $others,
							'other_specify' => strtoupper($this->input->post('other_specify')),
							'shipping_instructions' => strtoupper($this->input->post('shipping_instruction')),
						);
					}else{
						$chck_tel = isset($_POST['chck_tel']) ? 1 : 0;
						$chck_mobile = isset($_POST['chck_mobile']) ? 1 : 0;
						$chck_email = isset($_POST['chck_email']) ? 1 : 0;
						$chck_fax = isset($_POST['chck_fax']) ? 1 : 0;
						$others = isset($_POST['others']) ? 1 : 0;
						$insertShipInfo = array(
							'reference_no' => $referenceno,
							'contact_person' => strtoupper($this->input->post('contact_person')),
							'telephone' => $this->input->post('telephone'),
							'fax' => $this->input->post('fax'),
							'contact_no' => $this->input->post('contact_num'),
							'email' => $this->input->post('ship_email'),
							'dept_lab_branch' => strtoupper($this->input->post('dept_lab_branch')),
							'trunk_line' => $this->input->post('trunk_line'),
							'local_no' => $this->input->post('local_no'),
							'ship_address' => strtoupper($this->input->post('ship_address')),
							'ship_consignee' => strtoupper($this->input->post('shipping_consignee')),
							'desig_chief_director' => strtoupper($this->input->post('designation_chief')),
							'chck_tel' => $chck_tel,
							'chck_mobile' => $chck_mobile,
							'chck_email' => $chck_email,
							'chck_fax' => $chck_fax,
							'others' => $others,
							'shipping_instructions' => strtoupper($this->input->post('shipping_instruction')),
						);
					}
					$this->db->insert('tblship_information_details', $insertShipInfo);

					$chck_bac = isset($_POST['chck_bac']) ? 1 : 0;
					$chck_para = isset($_POST['chck_para']) ? 1 : 0;
					$chck_TB = isset($_POST['chck_TB']) ? 1 : 0;
					$chck_culture = isset($_POST['chck_culture']) ? 1 : 0;
					$chck_serology = isset($_POST['chck_serology']) ? 1 : 0;

					$insertProgram = array(
						'reference_no' => $referenceno,
						'chck_bac' => $chck_bac,
						'chck_para' => $chck_para,
						'chck_TB' => $chck_TB,
						'chck_culture' => $chck_culture,
						'chck_serology' =>$chck_serology,
						'total_payment' => $this->input->post('total_hide'),
					);
					$this->db->insert('tblprogram_Enrollment', $insertProgram);

					$cash = isset($_POST['cash']) ? 1 : 0;
					$company = isset($_POST['company']) ? 1 : 0;
					$landbank = isset($_POST['landbank']) ? 1 : 0;
					$mds = isset($_POST['mds']) ? 1 : 0;
					$insertPayment = array(
						'reference_no' => $referenceno,
						'cash' => $cash,
						'company' => $company,
						'landbank' => $landbank,
						'mds' => $mds,
						'payment_status' => 'NOT YET PAID',
					);
					$this->db->insert('tblpayment', $insertPayment);

					$insertAttestation = array(
						'reference_no' => $referenceno,
						'noted_by' => $this->input->post('noted_by'),
						'date_by' => $this->input->post('date_by'),
					);
					$this->db->insert('tblattestation', $insertAttestation);

					//Generate email with attachment
					require_once 'vendor/autoload.php';
					$this->load->model('Save_model');

					$code = $this->input->post('province_code1');
					$code1 = $this->input->post('municipality_code');
					$code2 = $this->input->post('brgy_code');
					$data['province_name'] = $this->db->where('code', $code)->order_by('name')->get('covid19db.psgc_province')->result();
					$data['mun'] = $this->db->where('code', $code1)->order_by('name')->get('covid19db.psgc_municipal')->result();
					$data['brgy'] = $this->db->where('code', $code2)->order_by('name')->get('covid19db.psgc_brgy')->result();

					$data['no_street'] = $this->input->post('no_street');
					$data['postal'] = $this->input->post('postal');
					$data['contact_no'] = $this->input->post('contact_no');
					$data['email_add'] = $this->input->post('email_add');
					$data['institution'] = $this->input->post('institution_name');

					$data['result'] = $this->Save_model->generate_pdf($referenceno);
					$mpdf = new \Mpdf\Mpdf(['margin_top' => 2]);
					$mpdf->showImageErrors = true;
					$html = $this->load->view('generate_pdf', $data, true);
					$file = '';
					$file = 'APPLICATION-' . $referenceno;
					$pdfFilePath = "";
					$pdfFilePath = FCPATH . "uploaded_file/" . $file . ".pdf";
					$mpdf->WriteHTML($html);
					$mpdf->Output($pdfFilePath, "F");

					$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.googlemail.com',
						'smtp_port' => 465,
						'smtp_user' => 'autoreply@ritm.gov.ph', // change it to yours
						'smtp_pass' => 'ch@ng30il2021_v2', // change it to yours
						'mailtype' => 'html',
						'charset' => 'iso-8859-1',
						'wordwrap' => TRUE
					);
					$this->load->library('email', $config);

					$message = '
					Dear NEQAS applicant,<br><br>
					Greetings!<br><br>

					We have received your application and will be subject for review.<br><br>
					If you have any concerns or clarifications, please send us an email at <b>neqas@ritm.gov.ph</b><br><br>


					<hr>
					If you did not register for this, please disregard the email. If you have any concerns, please do not hesitate to reach us through our NEQAS contact details:<br>
					<b>Email: neqas@ritm.gov.ph<br>
					Contact Numbers:<br>
					Landline: (02) 8850 1949<br>
					Cellphone: 0945 220 4141<b><br><br>

					Thank You.<br>
					<b>RITM NEQAS TEAM</b><br><br>
					*** This is a system generated message. <b>DO NOT REPLY TO THIS EMAIL. ***</b>
					';
					$this->email->set_newline("\r\n");
					$this->email->from('autoreply@ritm.gov.ph');
					$this->email->to($_POST['email_add']);
					$this->email->subject('RITM NEQAS Application [REF NO. '.$referenceno.']');
					$this->email->message($message);
					$this->email->attach($pdfFilePath);
					$this->email->send();
					$this->email->clear(true);
					unlink($pdfFilePath);
				break;


//case defualt
				default:
				$date_created = date('Y-m-d H:i:s');
				$time = time();
				$rand = rand(1,1000);
				$year = Date('y');
				$referenceno = 'NEQAS-'.$year .'-'.$time .$rand;
				$labID = $time . $rand;

				if (!empty($_FILES['lto_file']['name'])) {
					$config['upload_path'] = 'uploaded_file';
					$config['allowed_types'] = 'pdf|jpeg|jpg';
					$config['file_name'] = $referenceno . str_replace(' ', '_', $_FILES['lto_file']['name']);

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('lto_file')) {
						$uploadData = $this->upload->data();
						$uploadFile = $uploadData['file_name'];
					}else{
						$uploadFile = '';
					}
				}else{
					$uploadFile = '';
				}

				$insert_labDetails = array(
					'userID' => $_SESSION['loggedIn']['user_id'],
					'labID' => $labID,
					'email_add' => $this->input->post('email_add'),
					'institution_name' => $this->input->post('institution_name'),
					'no_street' => $this->input->post('no_street'),
					'brgy_code' => $this->input->post('barangay_code'),
					'municipal_code' => $this->input->post('municipal_code'),
					'province_code' => $this->input->post('province_code'),
					'postal_code' => $this->input->post('postal'),
					'contact_number' => $this->input->post('contact_no'),
				);
				$this->db->insert('tbl_laboratory', $insert_labDetails);

				$insert_participantDetails = array(
					'userID' => $_SESSION['loggedIn']['user_id'],
					'lab_ID' => $labID,
					'reference_no' => $referenceno,
					'email' => $this->input->post('email_add'),
					'hospital_chief' => strtoupper($this->input->post('hospital_chief')),
					'lab_chief' => strtoupper($this->input->post('lab_chief')),
					'head_bacterioloy' => strtoupper($this->input->post('head_bacterioloy')),
					'head_para' => strtoupper($this->input->post('head_para')),
					'head_TB' => strtoupper($this->input->post('head_TB')),
					'head_bloodService' => strtoupper($this->input->post('head_bloodService')),
					'participant_status' => 'NEW PARTICIPANT',
					'lto_file' => $uploadFile,
					'date_register' => $date_created,
					'status_approval' => 'FOR APPROVAL',
				);
				$this->db->insert('tbl_participant', $insert_participantDetails);

				$chckGov = isset($_POST['ownership_gov']) ? 1 : 0;
				$chckPrv = isset($_POST['ownership_private']) ? 1 : 0;
				$insertOwner = array(
					'reference_no' => $referenceno,
					'ownership_gov' => $chckGov,
					'ownership_private' => $chckPrv,
				);
				$this->db->insert('tblownership', $insertOwner);

				$chckbased = isset($_POST['inst_based']) ? 1 : 0;
				$chckfree = isset($_POST['inst_free']) ? 1 : 0;
				$insertInstitutional = array(
					'reference_no' => $referenceno,
					'inst_based' => $chckbased,
					'inst_free' => $chckfree,
				);
				$this->db->insert('tblinstitutional_char', $insertInstitutional);

				$primary_lab = isset($_POST['primary_lab']) ? 1 : 0;
				$secondary = isset($_POST['secondary']) ? 1 : 0;
				$tertiary = isset($_POST['tertiary']) ? 1 : 0;
				$special = isset($_POST['special']) ? 1 : 0;
				$anaerobic = isset($_POST['anaerobic']) ? 1 : 0;
				$insertService = array(
					'reference_no' => $referenceno,
					'primary_lab' => $primary_lab,
					'secondary' => $secondary,
					'tertiary' => $tertiary,
					'special' => $special,
					'anaerobic' => $anaerobic,
				);
				$this->db->insert('tblservice_capability', $insertService);

				$bloodCU = isset($_POST['bloodCU']) ? 1 : 0;
				$bloodSt = isset($_POST['bloodSt']) ? 1 : 0;
				$bloodCUBS = isset($_POST['bloodCUBS']) ? 1 : 0;
				$bloodBk = isset($_POST['bloodBk']) ? 1 : 0;
				$bloodBkF = isset($_POST['bloodBkF']) ? 1 : 0;
				$bloodCr = isset($_POST['bloodCr']) ? 1 : 0;
				$insertBlood = array(
					'reference_no' => $referenceno,
					'bloodCU' => $bloodCU,
					'bloodSt' => $bloodSt,
					'bloodCUBS' => $bloodCUBS,
					'bloodBk' => $bloodBk,
					'bloodBkF' => $bloodBkF,
					'bloodCr' => $bloodCr,
				);
				$this->db->insert('tblblood_service', $insertBlood);

				if (isset($_POST['others'])) {
					$chck_tel = isset($_POST['chck_tel']) ? 1 : 0;
					$chck_mobile = isset($_POST['chck_mobile']) ? 1 : 0;
					$chck_email = isset($_POST['chck_email']) ? 1 : 0;
					$chck_fax = isset($_POST['chck_fax']) ? 1 : 0;
					$others = isset($_POST['others']) ? 1 : 0;
					$insertShipInfo = array(
						'reference_no' => $referenceno,
						'contact_person' => strtoupper($this->input->post('contact_person')),
						'telephone' => $this->input->post('telephone'),
						'fax' => $this->input->post('fax'),
						'contact_no' => $this->input->post('contact_num'),
						'email' => $this->input->post('ship_email'),
						'dept_lab_branch' => strtoupper($this->input->post('dept_lab_branch')),
						'trunk_line' => $this->input->post('trunk_line'),
						'local_no' => $this->input->post('local_no'),
						'ship_address' => strtoupper($this->input->post('ship_address')),
						'ship_consignee' => strtoupper($this->input->post('shipping_consignee')),
						'desig_chief_director' => strtoupper($this->input->post('designation_chief')),
						'chck_tel' => $chck_tel,
						'chck_mobile' => $chck_mobile,
						'chck_email' => $chck_email,
						'chck_fax' => $chck_fax,
						'others' => $others,
						'other_specify' => strtoupper($this->input->post('other_specify')),
						'shipping_instructions' => strtoupper($this->input->post('shipping_instruction')),
					);
				}else{
					$chck_tel = isset($_POST['chck_tel']) ? 1 : 0;
					$chck_mobile = isset($_POST['chck_mobile']) ? 1 : 0;
					$chck_email = isset($_POST['chck_email']) ? 1 : 0;
					$chck_fax = isset($_POST['chck_fax']) ? 1 : 0;
					$others = isset($_POST['others']) ? 1 : 0;
					$insertShipInfo = array(
						'reference_no' => $referenceno,
						'contact_person' => strtoupper($this->input->post('contact_person')),
						'telephone' => $this->input->post('telephone'),
						'fax' => $this->input->post('fax'),
						'contact_no' => $this->input->post('contact_num'),
						'email' => $this->input->post('ship_email'),
						'dept_lab_branch' => strtoupper($this->input->post('dept_lab_branch')),
						'trunk_line' => $this->input->post('trunk_line'),
						'local_no' => $this->input->post('local_no'),
						'ship_address' => strtoupper($this->input->post('ship_address')),
						'ship_consignee' => strtoupper($this->input->post('shipping_consignee')),
						'desig_chief_director' => strtoupper($this->input->post('designation_chief')),
						'chck_tel' => $chck_tel,
						'chck_mobile' => $chck_mobile,
						'chck_email' => $chck_email,
						'chck_fax' => $chck_fax,
						'others' => $others,
						'shipping_instructions' => strtoupper($this->input->post('shipping_instruction')),
					);
				}
				$this->db->insert('tblship_information_details', $insertShipInfo);

				$chck_bac = isset($_POST['chck_bac']) ? 1 : 0;
				$chck_para = isset($_POST['chck_para']) ? 1 : 0;
				$chck_TB = isset($_POST['chck_TB']) ? 1 : 0;
				$chck_culture = isset($_POST['chck_culture']) ? 1 : 0;
				$chck_serology = isset($_POST['chck_serology']) ? 1 : 0;

				$insertProgram = array(
					'reference_no' => $referenceno,
					'chck_bac' => $chck_bac,
					'chck_para' => $chck_para,
					'chck_TB' => $chck_TB,
					'chck_culture' => $chck_culture,
					'chck_serology' =>$chck_serology,
					'total_payment' => $this->input->post('total_hide'),
				);
				$this->db->insert('tblprogram_Enrollment', $insertProgram);

				$cash = isset($_POST['cash']) ? 1 : 0;
				$company = isset($_POST['company']) ? 1 : 0;
				$landbank = isset($_POST['landbank']) ? 1 : 0;
				$mds = isset($_POST['mds']) ? 1 : 0;
				$insertPayment = array(
					'reference_no' => $referenceno,
					'cash' => $cash,
					'company' => $company,
					'landbank' => $landbank,
					'mds' => $mds,
					'payment_status' => 'NOT YET PAID',
				);
				$this->db->insert('tblpayment', $insertPayment);

				$insertAttestation = array(
					'reference_no' => $referenceno,
					'noted_by' => $this->input->post('noted_by'),
					'date_by' => $this->input->post('date_by'),
				);
				$this->db->insert('tblattestation', $insertAttestation);

				//Generate email with attachment
				require_once 'vendor/autoload.php';
				$this->load->model('Save_model');

				$code = $this->input->post('province_code');
				$code1 = $this->input->post('municipal_code');
				$code2 = $this->input->post('barangay_code');
				$data['province_name'] = $this->db->where('code', $code)->order_by('name')->get('covid19db.psgc_province')->result();
				$data['mun'] = $this->db->where('code', $code1)->order_by('name')->get('covid19db.psgc_municipal')->result();
				$data['brgy'] = $this->db->where('code', $code2)->order_by('name')->get('covid19db.psgc_brgy')->result();

				$data['no_street'] = $this->input->post('no_street');
				$data['postal'] = $this->input->post('postal');
				$data['contact_no'] = $this->input->post('contact_no');
				$data['email_add'] = $this->input->post('email_add');
				$data['institution'] = $this->input->post('institution_name');

				$data['result'] = $this->Save_model->generate_pdf($referenceno);
				$mpdf = new \Mpdf\Mpdf(['margin_top' => 2]);
				$mpdf->showImageErrors = true;
				$html = $this->load->view('generate_pdf', $data, true);
				$file = '';
				$file = 'APPLICATION-' . $referenceno;
				$pdfFilePath = "";
				$pdfFilePath = FCPATH . "uploaded_file/" . $file . ".pdf";
				$mpdf->WriteHTML($html);
				$mpdf->Output($pdfFilePath, "F");

				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'autoreply@ritm.gov.ph', // change it to yours
					'smtp_pass' => 'ch@ng30il2021_v2', // change it to yours
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE
				);
				$this->load->library('email', $config);

				$message = '
				Dear NEQAS applicant,<br><br>
				Greetings!<br><br>

				We have received your application and will be subject for review.<br><br>
				If you have any concerns or clarifications, please send us an email at <b>neqas@ritm.gov.ph</b><br><br>

				<hr>
				If you did not register for this, please disregard the email. If you have any concerns, please do not hesitate to reach us through our NEQAS contact details:<br>
				<b>Email: neqas@ritm.gov.ph<br>
				Contact Numbers:<br>
				Landline: (02) 8850 1949<br>
				Cellphone: 0945 220 4141<b><br><br>

				Thank You.<br>
				<b>RITM NEQAS TEAM</b><br><br>
				*** This is a system generated message. <b>DO NOT REPLY TO THIS EMAIL. ***</b>
				';
				$this->email->set_newline("\r\n");
				$this->email->from('autoreply@ritm.gov.ph');
				$this->email->to($_POST['email_add']);
				$this->email->subject('RITM NEQAS Application [REF NO. '.$referenceno.']');
				$this->email->message($message);
				$this->email->attach($pdfFilePath);
				$this->email->send();
				$this->email->clear(true);
				unlink($pdfFilePath);
			break;
		}
  }

  public function load_application()
  {
    $this->load->model('save_model');
    $list = $this->save_model->get_application_table();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $row_app) {
      $no++;
      $row = array();

			switch ($row_app->participant_status) {
				case 'NEW PARTICIPANT':
					if ($row_app->lto_file == '') {
						$row[] = '<button class="btn btn-danger btn-sm upload_file" title="Upload LTO file" id="'.$row_app->id.'" data-id="'.$row_app->reference_no.'">UPLOAD LTO</button>';
					}else{
						$row[] = '<span class="badge badge-success">LTO ALREADY UPLOADED</span>';
					}
					break;

				default:
					$row[] = '<span class="badge badge-danger">OLD PARTICIPANT</span>';
					break;
			}

      $row[] = $row_app->reference_no;
      $row[] = strtoupper($row_app->institution_name);

			$default_dt = strtotime($row_app->date_register);
			$register_date = date("F j, Y H:i:s", $default_dt);
      $row[] = $register_date;

			if ($row_app->chck_bac == '1') {
				$row[] = '<img src="'.base_url('vendors/images/check-mark-green.png').'">';
			}else{
				$row[] = '<img src="'.base_url('vendors/images/cross.png').'">';
			}

			if ($row_app->chck_para == '1') {
				$row[] = '<img src="'.base_url('vendors/images/check-mark-green.png').'">';
			}else{
				$row[] = '<img src="'.base_url('vendors/images/cross.png').'">';
			}

			if ($row_app->chck_TB == '1') {
				$row[] = '<img src="'.base_url('vendors/images/check-mark-green.png').'">';
			}else{
				$row[] = '<img src="'.base_url('vendors/images/cross.png').'">';
			}

			if ($row_app->chck_culture == '1') {
				$row[] = '<img src="'.base_url('vendors/images/check-mark-green.png').'">';
			}else{
				$row[] = '<img src="'.base_url('vendors/images/cross.png').'">';
			}

			if ($row_app->chck_serology == '1') {
				$row[] = '<img src="'.base_url('vendors/images/check-mark-green.png').'">';
			}else{
				$row[] = '<img src="'.base_url('vendors/images/cross.png').'">';
			}

			if ($row_app->total_payment == '') {
				$row[] = '';
			}else{
				$row[] = number_format($row_app->total_payment);
			}
      // $row[] = '<div class="badge badge-primary p-2">'.$row_app->status_approval.'</div>';

			if ($row_app->status_approval == 'FOR APPROVAL') {
				$row[] = '<div class="badge badge-primary p-2">'.$row_app->status_approval.'</div>';
				$row[] = '<div class="dropdown">
										<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
											<i class="dw dw-more"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
											<a class="dropdown-item edit_application" id="'.$row_app->reference_no.'"><i class="icon-copy dw dw-edit-1"></i> Edit Application</a>
										</div>
									</div>
									';
			}elseif ($row_app->status_approval == 'FOR PAYMENT') {
				$row[] = '<div class="badge badge-warning p-2">'.$row_app->status_approval.'</div>';
				$row[] = '
	                <div class="dropdown">
	                  <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
	                    <i class="dw dw-more"></i>
	                  </a>
	                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
	                    <a class="dropdown-item payment_application" id="'.$row_app->reference_no.'"><i class="dw dw-money-2"></i> Proceed Payment</a>
	                  </div>
	                </div>
	                ';
			}elseif ($row_app->status_approval == 'APPROVED') {
				$row[] = '<div class="badge badge-success p-2">'.$row_app->status_approval.'</div>';
				$row[] = '
	                <div class="dropdown">
	                  <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
	                    <i class="dw dw-more"></i>
	                  </a>
	                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
	                    <a class="dropdown-item" href="'.base_url('save_data/download_pdf/').''.$row_app->reference_no.'" target="_blank"><i class="dw dw-eye"></i> View</a>
	                  </div>
	                </div>
	                ';
			}else{
				$row[] = '<div class="badge badge-danger p-2">'.$row_app->status_approval.'</div>';
				$row[] = '';
			}


      $data[] = $row;
    }
    $output = array(
      'draw' => $_POST['draw'],
      'recordsTotal' => $this->save_model->count_all_application(),
      'recordsFiltered' => $this->save_model->count_filtered_application(),
      'data' => $data
    );
    echo json_encode($output);
  }

  public function load_labinfo()
  {
    $this->load->model('Load_model');
    $list = $this->Load_model->get_application_table();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $row_app) {
      $no++;
      $row = array();

			$code = $row_app->province_code;
			$code1 = $row_app->municipal_code;
			$code2 = $row_app->brgy_code;
	    $record['province_name'] = $this->db->where('code', $code)->order_by('name')->get('covid19db.psgc_province')->row();
			$record['mun'] = $this->db->where('code', $code1)->order_by('name')->get('covid19db.psgc_municipal')->row();
			$record['brgy'] = $this->db->where('code', $code2)->order_by('name')->get('covid19db.psgc_brgy')->row();

			$row[] = strtoupper($row_app->institution_name);
			$row[] = strtoupper($row_app->no_street).' '.strtoupper($record['brgy']->name).', '.strtoupper($record['mun']->name).', '.strtoupper($record['province_name']->name).' '.$row_app->postal_code;
			$row[] = $row_app->email_add;
			$row[] = $row_app->contact_number;

      $row[] = '
                <div class="dropdown">
                  <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <i class="dw dw-more"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="'.base_url('main/register_old_applicant/').''.$row_app->labID.'"><i class="dw dw-edit2"></i> Create application</a>

                  </div>
                </div>
                ';
      $data[] = $row;
			// <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
    }
    $output = array(
      'draw' => $_POST['draw'],
      'recordsTotal' => $this->Load_model->count_all_application(),
      'recordsFiltered' => $this->Load_model->count_filtered_application(),
      'data' => $data
    );
    echo json_encode($output);
  }

	public function save_old_applicant()
	{
		$date_created = date('Y-m-d H:i:s');
		$time = time();
		$year = Date('y');
		$referenceno = 'NEQAS-'.$year .'-'.$time;
		// $labID = time();

		$insert_participantDetails = array(
			'userID' => $_SESSION['loggedIn']['user_id'],
			'lab_ID' => $this->input->post('labID'),
			'reference_no' => $referenceno,
			'email' => $this->input->post('email_add'),
			'hospital_chief' => strtoupper($this->input->post('hospital_chief')),
			'lab_chief' => strtoupper($this->input->post('lab_chief')),
			'head_bacterioloy' => strtoupper($this->input->post('head_bacterioloy')),
			'head_para' => strtoupper($this->input->post('head_para')),
			'head_TB' => strtoupper($this->input->post('head_TB')),
			'head_bloodService' => strtoupper($this->input->post('head_bloodService')),
			'participant_status' => 'OLD PARTICIPANT',
			'year_last_participated' => $this->input->post('year_participated'),
			'date_register' => $date_created,
			'status_approval' => 'FOR APPROVAL',
		);
		$this->db->insert('tbl_participant', $insert_participantDetails);

		$chckGov = isset($_POST['ownership_gov']) ? 1 : 0;
		$chckPrv = isset($_POST['ownership_private']) ? 1 : 0;
		$insertOwner = array(
			'reference_no' => $referenceno,
			'ownership_gov' => $chckGov,
			'ownership_private' => $chckPrv,
		);
		$this->db->insert('tblownership', $insertOwner);

		$chckbased = isset($_POST['inst_based']) ? 1 : 0;
		$chckfree = isset($_POST['inst_free']) ? 1 : 0;
		$insertInstitutional = array(
			'reference_no' => $referenceno,
			'inst_based' => $chckbased,
			'inst_free' => $chckfree,
		);
		$this->db->insert('tblinstitutional_char', $insertInstitutional);

		$primary_lab = isset($_POST['primary_lab']) ? 1 : 0;
		$secondary = isset($_POST['secondary']) ? 1 : 0;
		$tertiary = isset($_POST['tertiary']) ? 1 : 0;
		$special = isset($_POST['special']) ? 1 : 0;
		$anaerobic = isset($_POST['anaerobic']) ? 1 : 0;
		$insertService = array(
			'reference_no' => $referenceno,
			'primary_lab' => $primary_lab,
			'secondary' => $secondary,
			'tertiary' => $tertiary,
			'special' => $special,
			'anaerobic' => $anaerobic,
		);
		$this->db->insert('tblservice_capability', $insertService);

		$bloodCU = isset($_POST['bloodCU']) ? 1 : 0;
		$bloodSt = isset($_POST['bloodSt']) ? 1 : 0;
		$bloodCUBS = isset($_POST['bloodCUBS']) ? 1 : 0;
		$bloodBk = isset($_POST['bloodBk']) ? 1 : 0;
		$bloodBkF = isset($_POST['bloodBkF']) ? 1 : 0;
		$bloodCr = isset($_POST['bloodCr']) ? 1 : 0;
		$insertBlood = array(
			'reference_no' => $referenceno,
			'bloodCU' => $bloodCU,
			'bloodSt' => $bloodSt,
			'bloodCUBS' => $bloodCUBS,
			'bloodBk' => $bloodBk,
			'bloodBkF' => $bloodBkF,
			'bloodCr' => $bloodCr,
		);
		$this->db->insert('tblblood_service', $insertBlood);

		if (isset($_POST['others'])) {
			$chck_tel = isset($_POST['chck_tel']) ? 1 : 0;
			$chck_mobile = isset($_POST['chck_mobile']) ? 1 : 0;
			$chck_email = isset($_POST['chck_email']) ? 1 : 0;
			$chck_fax = isset($_POST['chck_fax']) ? 1 : 0;
			$others = isset($_POST['others']) ? 1 : 0;
			$insertShipInfo = array(
				'reference_no' => $referenceno,
				'contact_person' => strtoupper($this->input->post('contact_person')),
				'telephone' => $this->input->post('telephone'),
				'fax' => $this->input->post('fax'),
				'contact_no' => $this->input->post('contact_num'),
				'email' => $this->input->post('ship_email'),
				'dept_lab_branch' => strtoupper($this->input->post('dept_lab_branch')),
				'trunk_line' => $this->input->post('trunk_line'),
				'local_no' => $this->input->post('local_no'),
				'ship_address' => strtoupper($this->input->post('ship_address')),
				'ship_consignee' => strtoupper($this->input->post('shipping_consignee')),
				'desig_chief_director' => strtoupper($this->input->post('designation_chief')),
				'chck_tel' => $chck_tel,
				'chck_mobile' => $chck_mobile,
				'chck_email' => $chck_email,
				'chck_fax' => $chck_fax,
				'others' => $others,
				'other_specify' => strtoupper($this->input->post('other_specify')),
				'shipping_instructions' => strtoupper($this->input->post('shipping_instruction')),
			);
		}else{
			$chck_tel = isset($_POST['chck_tel']) ? 1 : 0;
			$chck_mobile = isset($_POST['chck_mobile']) ? 1 : 0;
			$chck_email = isset($_POST['chck_email']) ? 1 : 0;
			$chck_fax = isset($_POST['chck_fax']) ? 1 : 0;
			$others = isset($_POST['others']) ? 1 : 0;
			$insertShipInfo = array(
				'reference_no' => $referenceno,
				'contact_person' => strtoupper($this->input->post('contact_person')),
				'telephone' => $this->input->post('telephone'),
				'fax' => $this->input->post('fax'),
				'contact_no' => $this->input->post('contact_num'),
				'email' => $this->input->post('ship_email'),
				'dept_lab_branch' => strtoupper($this->input->post('dept_lab_branch')),
				'trunk_line' => $this->input->post('trunk_line'),
				'local_no' => $this->input->post('local_no'),
				'ship_address' => strtoupper($this->input->post('ship_address')),
				'ship_consignee' => strtoupper($this->input->post('shipping_consignee')),
				'desig_chief_director' => strtoupper($this->input->post('designation_chief')),
				'chck_tel' => $chck_tel,
				'chck_mobile' => $chck_mobile,
				'chck_email' => $chck_email,
				'chck_fax' => $chck_fax,
				'others' => $others,
				'shipping_instructions' => strtoupper($this->input->post('shipping_instruction')),
			);
		}
		$this->db->insert('tblship_information_details', $insertShipInfo);

		$chck_bac = isset($_POST['chck_bac']) ? 1 : 0;
		$chck_para = isset($_POST['chck_para']) ? 1 : 0;
		$chck_TB = isset($_POST['chck_TB']) ? 1 : 0;
		$chck_culture = isset($_POST['chck_culture']) ? 1 : 0;
		$chck_serology = isset($_POST['chck_serology']) ? 1 : 0;

		$insertProgram = array(
			'reference_no' => $referenceno,
			'chck_bac' => $chck_bac,
			'chck_para' => $chck_para,
			'chck_TB' => $chck_TB,
			'chck_culture' => $chck_culture,
			'chck_serology' =>$chck_serology,
			'total_payment' => $this->input->post('total_hide'),
		);
		$this->db->insert('tblprogram_Enrollment', $insertProgram);

		$cash = isset($_POST['cash']) ? 1 : 0;
		$company = isset($_POST['company']) ? 1 : 0;
		$landbank = isset($_POST['landbank']) ? 1 : 0;
		$mds = isset($_POST['mds']) ? 1 : 0;
		$insertPayment = array(
			'reference_no' => $referenceno,
			'cash' => $cash,
			'company' => $company,
			'landbank' => $landbank,
			'mds' => $mds,
			'payment_status' => 'NOT YET PAID',
		);
		$this->db->insert('tblpayment', $insertPayment);

		$insertAttestation = array(
			'reference_no' => $referenceno,
			'noted_by' => $this->input->post('noted_by'),
			'date_by' => $this->input->post('date_by'),
		);
		$this->db->insert('tblattestation', $insertAttestation);

		//Generate email with attachment
		require_once 'vendor/autoload.php';
		$this->load->model('Save_model');

		$code = $this->input->post('province_code');
		$code1 = $this->input->post('municipal_code');
		$code2 = $this->input->post('barangay_code');
		$data['province_name'] = $this->db->where('code', $code)->order_by('name')->get('covid19db.psgc_province')->result();
		$data['mun'] = $this->db->where('code', $code1)->order_by('name')->get('covid19db.psgc_municipal')->result();
		$data['brgy'] = $this->db->where('code', $code2)->order_by('name')->get('covid19db.psgc_brgy')->result();

		$data['no_street'] = $this->input->post('no_street');
		$data['postal'] = $this->input->post('postal');
		$data['contact_no'] = $this->input->post('contact_no');
		$data['email_add'] = $this->input->post('email_add');
		$data['institution'] = $this->input->post('institution_name');

		$data['result'] = $this->Save_model->generate_pdf($referenceno);
		$mpdf = new \Mpdf\Mpdf(['margin_top' => 2]);
		$mpdf->showImageErrors = true;
		$html = $this->load->view('generate_pdf', $data, true);
		$file = '';
		$file = 'APPLICATION-' . $referenceno;
		$pdfFilePath = "";
		$pdfFilePath = FCPATH . "uploaded_file/" . $file . ".pdf";
		$mpdf->WriteHTML($html);
		$mpdf->Output($pdfFilePath, "F");

		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'autoreply@ritm.gov.ph', // change it to yours
			'smtp_pass' => 'ch@ng30il2021_v2', // change it to yours
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);
		$this->load->library('email', $config);

		$message = '
		Dear NEQAS applicant,<br><br>
		Greetings!<br><br>

		We have received your application and will be subject for review.<br><br>
		If you have any concerns or clarifications, please send us an email at <b>neqas@ritm.gov.ph</b><br><br>

		<b>PAYMENT INSTRUCTIONS:</b><br>
		1. Cash payments are only available on site for walk-in participants.<br>
		2. For those paying with checks or PMOs, please make sure that the check or PMO is payable to RITM. Please ensure that the handwriting is legible and that there are no erasures whatsoever.<br>
		3. For instructions regarding e-payment portal or modified disbursement system procedure, please contact the NEQAS Admin Office.<br>
		4. Ensure that your registration has been confirmed and that payment instructions has been received before settling the fees.<br><br>

		<hr>
		If you did not register for this, please disregard the email. If you have any concerns, please do not hesitate to reach us through our NEQAS contact details:<br>
		<b>Email: neqas@ritm.gov.ph<br>
		Contact Numbers:<br>
		Landline: (02) 8850 1949<br>
		Cellphone: 0945 220 4141<b><br>

		Thank You.<br>
		<b>RITM NEQAS</b><br><br>
		*** This is a system generated message. <b>DO NOT REPLY TO THIS EMAIL. ***</b>
		';
		$this->email->set_newline("\r\n");
		$this->email->from('autoreply@ritm.gov.ph');
		$this->email->to($_POST['email_add']);
		$this->email->subject('RITM NEQAS Application [REF NO. '.$referenceno.']');
		$this->email->message($message);
		$this->email->attach($pdfFilePath);
		$this->email->send();
		$this->email->clear(true);
		unlink($pdfFilePath);
	}

	function get_payment_details()
	{
		 if($this->input->post('reference'))
		 {
		 $output = array();
		 $data = $this->db->where('reference_no', $this->input->post('reference'))->get('tblpayment')->result();
		 foreach($data as $row)
		 {
			 $output['cash_payment'] = $row->cash;
			 $output['company_payment'] = $row->company;
			 $output['landbank_payment'] = $row->landbank;
			 $output['mds_payment'] = $row->mds;
		 }
	 echo json_encode($output);
		 }
	}

	public function upload_proof_payment()
	{
		$referenceno = $this->input->post('hideReference');
		if (!empty($_FILES['landbank_file']['name'])) {
			$config['upload_path'] = 'uploaded_file/proof_payment';
			$config['allowed_types'] = 'pdf|jpeg|jpg';
			$config['file_name'] = $referenceno . str_replace(' ', '_', $_FILES['landbank_file']['name']);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('landbank_file')) {
				$uploadLandbank = $this->upload->data();
				$uploadFilebank = $uploadLandbank['file_name'];
			}else{
				$uploadFilebank = '';
			}
		}else{
			$uploadFilebank = '';
		}

		if (isset($_POST['landbank_payment'])) {
			$updatePayment = array(
				'landbank_transaction' => $uploadFilebank,
				'payment_status' => 'PAID',
			);
			$updatePaymentstatus = array(
				'status_approval' => 'PAID-LANDBANK',
			);
		}else{
			$updatePayment = array(
				'payment_status' => 'PAID',
				'landbank_transaction' => $uploadFilebank,
			);
			$updatePaymentstatus = array(
				'status_approval' => 'PAYMENT READY',
			);
		}
		$this->db->where('reference_no', $referenceno)->update('tblpayment', $updatePayment);
		$this->db->where('reference_no', $referenceno)->update('tbl_participant', $updatePaymentstatus);
	}

	public function download_pdf()
	{
		require_once 'vendor/autoload.php';
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

		$mpdf = new \Mpdf\Mpdf(['margin_top' => 1]);
		$mpdf->showImageErrors = true;
		$html = $this->load->view('generate_pdf', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function privacy_consent()
	{
		$error = '';
		$privacy = $this->input->post('privacy');
		$update_privacy = array(
			'privacy_status' => $privacy,
		);
		if ($this->db->where('user_id', $_SESSION['loggedIn']['user_id'])->update('tblaccount', $update_privacy)) {
			$sess_array = array(
				'user_id' => $_SESSION['loggedIn']['user_id'],
				'email' => $_SESSION['loggedIn']['email'],
				'fullname' => $_SESSION['loggedIn']['fullname'],
				'username' => $_SESSION['loggedIn']['username'],
				'status' => $_SESSION['loggedIn']['status'],
				'privacy' => 'Agree',
			);
			$this->session->set_userdata('loggedIn', $sess_array);
			$error = 'Success';
		}else{
			$error = 'Error';
		}
		$output = array(
			'error' => $error,
		);
		echo json_encode($output);
	}

	public function update_applicant_info()
	{
		$lab_id = time();
		$date_created = date('Y-m-d H:i:s');
		$referenceno = $this->input->post('refno');

		$update_lab = array(
			'institution_name' => $this->input->post('institution_name'),
			'contact_number' => $this->input->post('contact_no'),
			'email_add' => $this->input->post('email_add'),
		);
		$this->db->where('labID', $this->input->post('labID'))->update('tbl_laboratory', $update_lab);

		$insertLab = array(
			'email' => $this->input->post('email_add'),
			'hospital_chief' => strtoupper($this->input->post('hospital_chief')),
			'lab_chief' => strtoupper($this->input->post('lab_chief')),
			'head_bacterioloy' => strtoupper($this->input->post('head_bacterioloy')),
			'head_para' => strtoupper($this->input->post('head_para')),
			'head_TB' => strtoupper($this->input->post('head_TB')),
			'head_bloodService' => strtoupper($this->input->post('head_bloodService')),
			'status_approval' => 'FOR APPROVAL',
 		);
		$this->db->where('reference_no', $this->input->post('refno'))->update('tbl_participant', $insertLab);

		$chckGov = isset($_POST['ownership_gov']) ? 1 : 0;
		$chckPrv = isset($_POST['ownership_private']) ? 1 : 0;
		$insertOwner = array(
			'ownership_gov' => $chckGov,
			'ownership_private' => $chckPrv,
		);
		$this->db->where('reference_no', $this->input->post('refno'))->update('tblownership', $insertOwner);

		$chckbased = isset($_POST['inst_based']) ? 1 : 0;
		$chckfree = isset($_POST['inst_free']) ? 1 : 0;
		$insertInstitutional = array(
			'inst_based' => $chckbased,
			'inst_free' => $chckfree,
		);
		$this->db->where('reference_no', $this->input->post('refno'))->update('tblinstitutional_char', $insertInstitutional);

		$primary_lab = isset($_POST['primary_lab']) ? 1 : 0;
		$secondary = isset($_POST['secondary']) ? 1 : 0;
		$tertiary = isset($_POST['tertiary']) ? 1 : 0;
		$special = isset($_POST['special']) ? 1 : 0;
		$anaerobic = isset($_POST['anaerobic']) ? 1 : 0;
		$insertService = array(
			'primary_lab' => $primary_lab,
			'secondary' => $secondary,
			'tertiary' => $tertiary,
			'special' => $special,
			'anaerobic' => $anaerobic,
		);
		$this->db->where('reference_no', $this->input->post('refno'))->update('tblservice_capability', $insertService);

		$bloodCU = isset($_POST['bloodCU']) ? 1 : 0;
		$bloodSt = isset($_POST['bloodSt']) ? 1 : 0;
		$bloodCUBS = isset($_POST['bloodCUBS']) ? 1 : 0;
		$bloodBk = isset($_POST['bloodBk']) ? 1 : 0;
		$bloodBkF = isset($_POST['bloodBkF']) ? 1 : 0;
		$bloodCr = isset($_POST['bloodCr']) ? 1 : 0;
		$insertBlood = array(
			'bloodCU' => $bloodCU,
			'bloodSt' => $bloodSt,
			'bloodCUBS' => $bloodCUBS,
			'bloodBk' => $bloodBk,
			'bloodBkF' => $bloodBkF,
			'bloodCr' => $bloodCr,
		);
		$this->db->where('reference_no', $this->input->post('refno'))->update('tblblood_service', $insertBlood);

		if (isset($_POST['others'])) {
			$chck_tel = isset($_POST['chck_tel']) ? 1 : 0;
			$chck_mobile = isset($_POST['chck_mobile']) ? 1 : 0;
			$chck_email = isset($_POST['chck_email']) ? 1 : 0;
			$chck_fax = isset($_POST['chck_fax']) ? 1 : 0;
			$others = isset($_POST['others']) ? 1 : 0;
			$insertShipInfo = array(
				'contact_person' => strtoupper($this->input->post('contact_person')),
				'telephone' => $this->input->post('telephone'),
				'fax' => $this->input->post('fax'),
				'contact_no' => $this->input->post('contact_num'),
				'email' => $this->input->post('ship_email'),
				'dept_lab_branch' => strtoupper($this->input->post('dept_lab_branch')),
				'trunk_line' => $this->input->post('trunk_line'),
				'ship_address' => strtoupper($this->input->post('ship_address')),
				'ship_consignee' => strtoupper($this->input->post('shipping_consignee')),
				'desig_chief_director' => strtoupper($this->input->post('designation_chief')),
				'chck_tel' => $chck_tel,
				'chck_mobile' => $chck_mobile,
				'chck_email' => $chck_email,
				'chck_fax' => $chck_fax,
				'others' => $others,
				'other_specify' => strtoupper($this->input->post('other_specify')),
				'shipping_instructions' => strtoupper($this->input->post('shipping_instruction')),
			);
		}else{
			$chck_tel = isset($_POST['chck_tel']) ? 1 : 0;
			$chck_mobile = isset($_POST['chck_mobile']) ? 1 : 0;
			$chck_email = isset($_POST['chck_email']) ? 1 : 0;
			$chck_fax = isset($_POST['chck_fax']) ? 1 : 0;
			$others = isset($_POST['others']) ? 1 : 0;
			$insertShipInfo = array(
				'contact_person' => strtoupper($this->input->post('contact_person')),
				'telephone' => $this->input->post('telephone'),
				'fax' => $this->input->post('fax'),
				'contact_no' => $this->input->post('contact_num'),
				'email' => $this->input->post('ship_email'),
				'dept_lab_branch' => strtoupper($this->input->post('dept_lab_branch')),
				'trunk_line' => $this->input->post('trunk_line'),
				'ship_address' => strtoupper($this->input->post('ship_address')),
				'ship_consignee' => strtoupper($this->input->post('shipping_consignee')),
				'desig_chief_director' => strtoupper($this->input->post('designation_chief')),
				'chck_tel' => $chck_tel,
				'chck_mobile' => $chck_mobile,
				'chck_email' => $chck_email,
				'chck_fax' => $chck_fax,
				'others' => $others,
				'shipping_instructions' => strtoupper($this->input->post('shipping_instruction')),
			);
		}
		$this->db->where('reference_no', $this->input->post('refno'))->update('tblship_information_details', $insertShipInfo);

		$chck_bac = isset($_POST['chck_bac']) ? 1 : 0;
		$chck_para = isset($_POST['chck_para']) ? 1 : 0;
		$chck_TB = isset($_POST['chck_TB']) ? 1 : 0;
		$chck_culture = isset($_POST['chck_culture']) ? 1 : 0;
		$chck_serology = isset($_POST['chck_serology']) ? 1 : 0;
		$insertProgram = array(
			'chck_bac' => $chck_bac,
			'chck_para' => $chck_para,
			'chck_TB' => $chck_TB,
			'chck_culture' => $chck_culture,
			'chck_serology' =>$chck_serology,
			'total_payment' => $this->input->post('total_hide'),
		);
		$this->db->where('reference_no', $this->input->post('refno'))->update('tblprogram_Enrollment', $insertProgram);

		$cash = isset($_POST['cash']) ? 1 : 0;
		$company = isset($_POST['company']) ? 1 : 0;
		$landbank = isset($_POST['landbank']) ? 1 : 0;
		$mds = isset($_POST['mds']) ? 1 : 0;
		$insertPayment = array(
			'cash' => $cash,
			'company' => $company,
			'landbank' => $landbank,
			'mds' => $mds,
			'payment_status' => 'NOT YET PAID',
		);
		$this->db->where('reference_no', $this->input->post('refno'))->update('tblpayment', $insertPayment);

		$insertAttestation = array(
			'noted_by' => $this->input->post('noted_by'),
			'date_by' => $this->input->post('date_by'),
		);
		$this->db->where('reference_no', $this->input->post('refno'))->update('tblattestation', $insertAttestation);
	}

	public function upload_lto_file()
	{
		$rand = rand(1,1000);
		$referenceno = $this->input->post('ref');
		if (!empty($_FILES['lto_file']['name'])) {
			$config['upload_path'] = 'uploaded_file';
			$config['allowed_types'] = 'pdf|jpeg|jpg';
			$config['file_name'] = $referenceno . str_replace(' ', '_', $_FILES['lto_file']['name']);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('lto_file')) {
				$uploadData = $this->upload->data();
				$uploadFile = $uploadData['file_name'];
			}else{
				$uploadFile = '';
			}
		}else{
			$uploadFile = '';
		}

		$updateFile = array(
				'lto_file' => $uploadFile,
				'status_approval' => 'FOR APPROVAL',
				'disapproval_remarks' => '',
				'employee_id' => ''
		);
		$this->db->where('reference_no', $this->input->post('ref'))->update('tbl_participant', $updateFile);
	}

}
