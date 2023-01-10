<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		date_default_timezone_set('Asia/Manila');
	}

  public function index()
  {
    $this->load->view('header');
    $this->load->view('login');
    $this->load->view('footer');
  }

  public function register()
  {
    $this->load->view('header');
    $this->load->view('register');
    $this->load->view('footer');
  }

	public function forgot()
	{
		$this->load->view('header');
		$this->load->view('forgot_password');
		$this->load->view('footer');
	}

	public function reset()
	{
		$this->load->view('header');
		$this->load->view('footer');
		$this->load->view('reset_password');
	}

  public function register_account()
	{
		// $flag_id = time();
		$code = md5(rand(0,1000));
		$error = '';
		$message = '';
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		require_once 'vendor/autoload.php';
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'autoreply@ritm.gov.ph', // change it to yours
			'smtp_pass' => 'ch@ng30il2021_v3', // change it to yours
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);
		$this->load->library('email', $config);

		$where = "username='".$username."' OR email ='".$email."'";
		$query = $this->db->where($where)->get('tblaccount');
		$row = $query->row();
		if ($query->num_rows() > 0)
		{
			$error = '<span class="alert alert-danger p-2 mt-2 form-control text-center">Username/Email already exist!</span>';
		}else{
			$date_created = date('Y-m-d H:i:s');
			$insert_account = array(
				'username' => $this->input->post('username'),
        'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'in_word' => $this->input->post('password'),
				'fullname' => $this->input->post('name'),
				'account_status' => 'For Verification',
				'date_added' => $date_created,
				'flag' => $code,
			);
			$message = '
				Dear NEQAS applicant,<br><br>
				Greetings!<br><br>

				Please click this link to verify your account https://apps.ritm.gov.ph/neqas/user/verify?email='.$email.'&hash='.$code.' <br><br>

				<b>ACCOUNT CREDENTIALS:</b><br>
				<b>Username:</b> '.$this->input->post('username').'<br>
				<b>Password:</b> '.$this->input->post('password').'<br><br><br>

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
			$this->email->to($this->input->post('email'));
			$this->email->subject('RITM NEQAS Application | Verify your account');
			$this->email->message($message);
			$this->email->send();
			$this->db->insert('tblaccount', $insert_account);
		}
        $output = array(
        	'error' => $error,
        );
        echo json_encode($output);
	}

	public function forgotPass()
	{
		require_once 'vendor/autoload.php';
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'autoreply@ritm.gov.ph', // change it to yours
			'smtp_pass' => 'ch@ng30il2021_v3', // change it to yours
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);
		$this->load->library('email', $config);

		$error = '';
		$success = '';
		$code = md5( rand(0,1000) );
		$email = $this->input->post('email_address');
		$temp_pass = time();
		$query = $this->db->where('email', $this->input->post('email_address'))->get('tblaccount');
		$row = $query->row();
		if ($query->num_rows() > 0)
		{

			$message = '
				Dear NEQAS applicant,<br><br>
				Greetings!<br><br>

				Please click this link to reset your password https://apps.ritm.gov.ph/neqas/user/reset?email='.$email.'&hash='.$code.' <br><br>

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

			$update_account = array(
				'account_status' => 'For Reset',
				'flag' => $code,
			);
			$this->email->set_newline("\r\n");
			$this->email->from('autoreply@ritm.gov.ph');
			$this->email->to($this->input->post('email_address'));
			$this->email->subject('RITM NEQAS Application | Reset Password');
			$this->email->message($message);
			if ($this->email->send()) {
				$this->db->where('email', $this->input->post('email_address'))->update('tblaccount', $update_account);
				$success = '<div class="alert alert-success">Please check your email for the link.</div>';
			}else{
				$error = '<span class="alert alert-danger p-2 mt-2 form-control text-center">Failed to sent email.</span>';
			}
		}else{
			$error = '<span class="alert alert-danger p-2 mt-2 form-control text-center">Email address not register.</span>';
		}
        $output = array(
        	'error' => $error,
					'success' => $success,
        );
        echo json_encode($output);
	}

	public function login_account()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$success = '';
		$error = '';
		$session = $this->User_model->user_check($username, $password);
		if ($session)
		{
			if ($session->account_status == 'Inactive') {
				$error = '<div class="alert alert-danger">Your account is deactivated!</div>';
			}else{
				if ($session->account_status == 'For Verification') {
					$error = '<div class="alert alert-danger">Please check your email and verify your account!</div>';
				}elseif ($session->account_status == 'For Reset') {
					$error = '<div class="alert alert-danger">Please check your email and reset your password!</div>';
				}else{
					$sess_array = array(
						'user_id' => $session->user_id,
						'email' => $session->email,
						'fullname' => $session->fullname,
						'username' => $session->username,
						'status' => $session->account_status,
						'privacy' => $session->privacy_status,
					);
					$this->session->set_userdata('loggedIn', $sess_array);
					$success = '<div class="alert alert-success">Please wait redirecting...</div>';
				}
			}
		}else{
			$error = '<div class="alert alert-danger">Please check your username and password!</div>';
		}
		$output = array(
			'success' => $success,
			'error' => $error,
		);
		echo json_encode($output);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('user');
	}


	public function labList(){
		$this->load->model('Load_model');
	 // POST data
	 $postData = $this->input->post();

	 // Get data
	 $data = $this->Load_model->labList($postData);

	 echo json_encode($data);
 }

 public function verify()
 {

	 if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
		 $email = $_GET['email'];
		 $code = $_GET['hash'];

		 $this->db->select('email, flag, account_status');
		 $this->db->where('email', $email);
		 $this->db->where('flag', $code);
		 $this->db->where('account_status', 'For Verification');
		 $query = $this->db->get('tblaccount');
		 if ($query->num_rows() > 0)
		 {
			 $verify = array(
				 'account_status' => 'Active',
				 'flag' => 'Verified',
			 );
			 $where = "email='".$email."' AND flag ='".$code."' AND account_status ='For Verification'";
			 $this->db->where($where)->update('tblaccount', $verify);
			 $data['success'] = 'Your account has been activated, you can now login';
			 $this->load->view('header');
			 $this->load->view('footer');
			 $this->load->view('verify_account', $data);
		 }else{
			 $data['success'] = 'The url is either invalid or you already have activated your account.';
			 $this->load->view('header');
			  $this->load->view('footer');
			 $this->load->view('verify_account', $data);
		 }
	 }else{
		 $data['success'] = 'Invalid approach, please use the link that has been sent to your email.';
		 $this->load->view('header');
		 $this->load->view('footer');
		 $this->load->view('verify_account', $data);
	 }
 }

 public function resetPassword()
 {
	 $success = '';
	 $error = '';
	 if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['code']) && !empty($_POST['code']))
	 {
		 $email = $_POST['email'];
		 $code = $_POST['code'];

		 $this->db->select('email, flag');
		 $this->db->where('email', $email);
		 $this->db->where('flag', $code);
		 $query = $this->db->get('tblaccount');
		 if ($query->num_rows() > 0)
		 {
				$reset = array(
					'password' => password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT),
					'in_word' => $this->input->post('new_pass'),
					'account_status' => 'Active',
					'flag' => 'Verified'
				);
				$where = "email='".$email."' AND flag ='".$code."'";
				$this->db->where($where)->update('tblaccount', $reset);
				$success = '<div class="alert alert-success">Your password has been reset.</div>';
		 }else{
			 $error = '<div class="alert alert-danger">The url is either invalid or you already reset your password.</div>';
		 }

	 }else{
		 $error = '<div class="alert alert-danger">Invalid approach, please use the link that has been sent to your email.</div>';
	 }
	 $output = array(
		 'success' => $success,
		 'error' => $error,
	 );
	 echo json_encode($output);
 }

 public function changePassword()
 {
	 $changepass = array(
		 'password' => password_hash($this->input->post('change_pass'), PASSWORD_DEFAULT),
		 'in_word' => $this->input->post('change_pass'),
	 );
	 if ($this->db->where('user_id', $_SESSION['loggedIn']['user_id'])->update('tblaccount', $changepass)) {
	 		redirect('user');
	 }
 }


}
