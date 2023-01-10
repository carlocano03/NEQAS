<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NeqasAdmin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

  public function index()
  {
    $this->load->view('header');
    $this->load->view('manual_uploading');
    $this->load->view('footer');
    $this->load->view('admin');
  }

	public function load_application()
  {
    $this->load->model('Admin_model');
    $list = $this->Admin_model->get_application_table();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $row_app) {
      $no++;
      $row = array();

			if ($row_app->lto_file == '') {
				$row[] = '<button class="btn btn-outline-primary btn-sm manual_upload_lto" title="Upload LTO" id="'.$row_app->reference_no.'"><i class="icon-copy dw dw-upload2 mr-1"></i>Upload LTO</button>';
			}else{
				$row[] = 'Already Uploaded';
			}

			$row[] = $row_app->reference_no;
			$row[] = strtoupper($row_app->institution_name);
			$default_dt = strtotime($row_app->date_register);
			$register_date = date("F j, Y H:i:s", $default_dt);
      $row[] = $register_date;

			switch ($row_app->status_approval) {
				case 'FOR APPROVAL':
					$row[] = '<span class="badge badge-warning">'.$row_app->status_approval.'</span>';
					break;
				case 'FOR ISSUANCE':
					$row[] = '<span class="badge badge-info">'.$row_app->status_approval.'</span>';
					break;
				case 'FOR PAYMENT':
					$row[] = '<span class="badge badge-primary">'.$row_app->status_approval.'</span>';
					break;
				case 'PAYMENT READY':
					$row[] = '<span class="badge badge-primary">'.$row_app->status_approval.'</span>';
					break;
				case 'PAID-LANDBANK':
					$row[] = '<span class="badge badge-primary">'.$row_app->status_approval.'</span>';
					break;
				case 'DISAPPROVED':
					$row[] = '<span class="badge badge-danger">'.$row_app->status_approval.'</span>';
					break;
				default:
					$row[] = '<span class="badge badge-success">'.$row_app->status_approval.'</span>';
					break;
			}

      $data[] = $row;
    }
    $output = array(
      'draw' => $_POST['draw'],
      'recordsTotal' => $this->Admin_model->count_all_application(),
      'recordsFiltered' => $this->Admin_model->count_filtered_application(),
      'data' => $data
    );
    echo json_encode($output);
  }

	public function upload_lto_file()
	{
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
