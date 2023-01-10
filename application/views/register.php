<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="logo">
				<a href="<?= base_url('user')?>">
					<img src="<?= base_url()?>src/img/RITM-NEQAS-BannerV3.png" alt="" style=" width:50rem;">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a class="text-success" href="<?= base_url('user')?>"><i class="icon-copy dw dw-login mr-1"></i>Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="<?=base_url()?>vendors/images/Vaccine development-cuate.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="register-box bg-white box-shadow border-radius-10 p-3">
            <form id="add_account" method="POST">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <h5 class="text-success"><i class="icon-copy dw dw-edit-1 mr-2"></i>Basic Account Credentials</h5>
              <hr>
              <div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Username" name="username" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
              <div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Active Email" name="email" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-email1"></i></span>
								</div>
							</div>
              <div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="Password" name="password" id="password" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="Confirm Password" name="confirm_pass" id="confirm_pass" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-padlock1"></i></span>
								</div>
							</div>

              <div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Fullname" name="name" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-name"></i></span>
								</div>
							</div>

              <div class="form-group mb-3">
                <div id="error-message"></div>
              </div>
              <div class="">
                <button type="submit" class="btn btn-success btn-block" id="register_acct"><i class="icon-copy dw dw-floppy-disk mr-2"></i>Submit</button>
              </div>
            </form>
					</div>
				</div>
			</div>
		</div>
	</div>
