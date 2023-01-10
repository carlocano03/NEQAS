<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
	.disclaimer{
		text-align: justify;
		font-size: 13px;
		font-style: italic;
		color: red;
	}
	.message{
		text-align: justify;
		font-size: 13.5px;
	}
</style>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="logo">
				<a href="<?= base_url('user')?>">
					<img src="<?= base_url()?>src/img/RITM-NEQAS-BannerV3.png" alt="" style=" width:50rem; margin-left:5px;">
				</a>
			</div>
			<?php if($info->status == ''){ ?>
			<div class="login-menu">
				<ul>
					<li><a class="text-success" href="<?= base_url('user/register')?>"><i class="icon-copy dw dw-edit-file mr-1"></i>Register</a></li>
				</ul>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">

					<img src="<?= base_url()?>vendors/images/options.png" alt="">
					<div class="message">
						<p>
							<b class="text-success">Welcome to the online registration portal of the RITM National External Quality Assessment Scheme (NEQAS)!</b><br>
							<span class="text-secondary">
								NEQAS evaluates the performance of participating laboratories by assessing the integrity of the entire testing from sample receipt to releasing of test results.
								This would allow comparison of the laboratory’s testing to the performance of a peer group and/or the national reference laboratory.<br><br>

								The panels offered by the Research Institute for Tropical Medicine consist of a combination of positive and negative samples that are designed to mimic patient samples.
								Completed tests are then encoded online via Oneworld Accuracy System (OASYS), a cloud-based application developed by 1WA, and the data are then analyzed under ISO13528.
								Performance reports are provided to the participants to assess their results and compare their performance against their peer group.<br><br>
								Participation in an EQAS program is required under local regulatory policies for a laboratory to operate.<br><br>
								<span><b>Registration covers the following programs offered by the Research Institute for Tropical Medicine:</b></span><br>
								<span class="text-success">
									<b><i class="icon-copy fa fa-hand-o-right mr-2"></i>Bacteriology<br>
									<i class="icon-copy fa fa-hand-o-right mr-2"></i>Parasitology<br>
									<i class="icon-copy fa fa-hand-o-right mr-2"></i>Mycobacteriology<br>
									<i class="icon-copy fa fa-hand-o-right mr-2"></i>Transfusion Transmissible Infections</b>
								</span>
							</span>
						</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-5 mb-30">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-success">Login To NEQAS APP</h2>
						</div>
						<form class="login_account" method="POST">
							<!-- <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"> -->
							<div class="text-center mb-1"><span id="message"></span></div>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Username" name="username" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="**********" name="password" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
								</div>
								<div class="col-6">
									<div class="forgot-password"><a href="<?= base_url('user/forgot')?>" class="text-success"><i class="icon-copy dw dw-lock mr-1"></i>Forgot Password</a></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<button type="submit" class="btn btn-success btn-block" id="sign_in">Sign In</button>
									</div>
									<?php if($info->status == ''){ ?>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-success btn-block" href="<?= base_url('user/register')?>">Register To Create Account</a>
									</div>
									<?php } ?>
									<hr>
									<div class="disclaimer"><b>DISCLAIMER:</b> Some features of the systems behave differently with various browsers, we recommend using the latest version of Internet Explorer, Firefox Mozilla, Google Chrome and/or Safari</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
