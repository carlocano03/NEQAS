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
					<!-- <li><a class="text-success" href="<?= base_url('user')?>"><i class="icon-copy dw dw-login mr-1"></i>Login</a></li> -->
				</ul>
			</div>
		</div>
	</div>
	<div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container text-center">
      <div class="alert alert-success">
        <?= $success;?>
      </div>
        <a href="<?= base_url('user')?>" class="btn btn-success btn-lg" name="button" style="width:250px;"><i class="icon-copy dw dw-login mr-1"></i>GO TO LOGIN PAGE</a>
		</div>
	</div>
