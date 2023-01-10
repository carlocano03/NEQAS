<body>
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="logo">
				<a href="<?= base_url('user')?>">
					<img src="<?= base_url()?>src/img/RITM-NEQAS-BannerV3.png" alt="" style=" width:50rem; margin-left:5px;">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a class="text-success" href="<?= base_url('user')?>"><i class="icon-copy dw dw-login mr-1"></i>Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="<?= base_url()?>vendors/images/Laboratory-cuate.png" alt="">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-success">Forgot Password</h2>
						</div>
						<h6 class="mb-20">Enter your email address to reset your password</h6>
						<form id="forgotPass" method="POST">
							<div class="text-center mb-1"><span id="message"></span></div>
							<div class="input-group custom">
								<input type="email" class="form-control form-control-lg" name="email_address" placeholder="Email" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
										-->

                    <button type="submit" class="btn btn-success btn-block" id="reset" name="button">Submit</button>
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373">OR</div>
								</div>
								<div class="col-5">
									<div class="input-group mb-0">
										<a class="btn btn-outline-success btn-block" href="<?= base_url('main')?>">Login</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
