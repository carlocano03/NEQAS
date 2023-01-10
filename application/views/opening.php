<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
	.bg {
	  background-image: url("vendors/images/20342544.jpg");
	  height: 100%;
	  background-position: center;
	  background-repeat: no-repeat;
	  background-size: cover;
		opacity: 0.2;
	}
	.centered {
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
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
		</div>
	</div>
	<div class="bg"></div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center centered">
		<div class="container text-center">
      <h1 class="text-danger"><i class="icon-copy dw dw-warning-1 mr-2 text-warning" style="font-size:80px;"></i><br><?= $info->details;?></h1>
			<hr>
      <h5><?= $info->other_info;?></h5>
		</div>
	</div>
