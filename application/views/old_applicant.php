<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
/* #table-list td:nth-child(3), #table-list td:nth-child(4), #table-list td:nth-child(5), #table-list td:nth-child(6), #table-list td:nth-child(7), #table-list td:nth-child(8) {
  text-align: center;
} */
#table-list td:nth-child(5){
  text-align: center;
}

	li.active{
		background: #f39c12;
		margin-left: 20px;
		border-top-left-radius: 20px;
	}
</style>
<body>

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
      <img src="<?= base_url()?>src/img/NEQAS-Banner(black-font).png" alt="" style="width:50vh; margin-left:5px;">
		</div>
		<div class="header-right">
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="<?= base_url()?>src/img/RITM-Logo.png" alt="">
						</span>
						<span class="user-name"><?= $_SESSION['loggedIn']['fullname'];?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="<?= base_url('user/logout')?>"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar" style="background:#00523c">
		<div class="brand-logo">
			<a href="index.html">
        NEQAS APP
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="<?= base_url('main')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url('main/new_applicant')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-add-file1"></span><span class="mtext">New Applicant</span>
						</a>
					</li>
					<li class="active">
						<a href="<?= base_url('main/old_applicant')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-add-file2"></span><span class="mtext">Old Applicant</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="<?= base_url()?>vendors/images/banner-img.png" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10">
							Welcome Back <div class="weight-600 font-30 text-blue"><?= $_SESSION['loggedIn']['fullname'];?></div>
						</h4>

						<p class="font-18 max-width-600 text-secondary" style="text-align:justify;">
							The External Quality Assessment Scheme (EQAS) evaluates the performance of participating laboratories by assessing the integrity of the entire testing from
							sample receipt to releasing of test results. This would allow comparison of the laboratory's testing to the performance of a peer group and/or the national reference laboratory.
						</p>
					</div>
				</div>
			</div>


		<!-- Simple Datatable start -->
		<div class="card-box mb-30">
			<div class="pd-20">
				<h4 class="text-green h4">List of Laboratory</h4>
			</div>
      <div class="col-md-3 mb-3">
        <select class="custom-select input-details" name="institution_name" id="institution_name">
            <option value="">Filter by laboratory</option>
          <?php foreach($lab as $row){ ?>
            <option value="<?= $row->institution_name?>"><?= strtoupper($row->institution_name) ?></option>
          <?php } ?>
        </select>
      </div>
			<div class="pb-20">
				<table class="data-table table stripe hover nowrap" id="table-list">
					<thead>
						<tr>
							<th>Institution Name</th>
							<th>Address</th>
              <th>Email Address</th>
              <th>Contact Number</th>
              <th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<!-- <tr>
							<td class="table-plus">Gloria F. Mead</td>
							<td>25</td>
							<td>Sagittarius</td>
							<td>2829 Trainer Avenue Peoria, IL 61602 </td>
							<td>29-03-2018</td>
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
										<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
										<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
									</div>
								</div>
							</td>
						</tr> -->
					</tbody>
				</table>
			</div>
		</div>


			<div class="footer-wrap pd-20 mb-20 card-box text-secondary">
				&copy; Copyright 2022 <b>NATIONAL EXTERNAL QUALITY ASSESSMENT SCHEME (NEQAS).</b> All Rights Reserved.
			</div>
		</div>
	</div>
