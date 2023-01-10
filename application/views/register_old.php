<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
	li.active{
    background: #f39c12;
    margin-left: 20px;
    border-top-left-radius: 20px;
	}
	/* Mark input boxes that gets an error on validation: */
	.input-details.require {
	  background-color: #ffdddd;
	}

	/* Hide all steps by default: */
	.tab {
	  display: none;
	}

	button {
	  background-color: #04AA6D;
	  color: #ffffff;
	  border: none;
	  padding: 10px 20px;
	  font-size: 17px;
	  cursor: pointer;
	}

	button:hover {
	  opacity: 0.8;
	}

	#prevBtn {
	  background-color: #bbbbbb;
	}

	/* Make circles that indicate the steps of the form: */
	.step {
	  height: 15px;
	  width: 15px;
	  margin: 0 2px;
	  background-color: #bbbbbb;
	  border: none;
	  border-radius: 50%;
	  display: inline-block;
	  opacity: 0.5;
	}

	.step.active {
	  background: #27ae60;
	}

	/* Mark the steps that are finished and valid: */
	.step.finish {
	  background-color: #2980b9;
	}
</style>
<body>
	<!-- <div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="<?= base_url()?>src/img/NEQAS-Banner(black-font).png" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div> -->

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
			<!-- <div class="github-link">
				<a href="https://github.com/dropways/deskapp" target="_blank"><img src="<?= base_url()?>vendors/images/github.svg" alt=""></a>
			</div> -->
		</div>
	</div>

	<div class="left-side-bar" style="background:#00523c">
		<div class="brand-logo">
			<a href="index.html">
				<!-- <img src="<?= base_url()?>vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="<?= base_url()?>vendors/images/deskapp-logo-white.svg" alt="" class="light-logo"> -->
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

      	<section>
						<form id="old_applicant_registration" method="POST" enctype="multipart/form-data">
            	<div class="tab"><!-- 1st tab -->
				          <div class="card-box pd-20 height-100-p mb-30">
										<h4>HOSPITAL/LABORATORY INFORMATION - OLD APPLICANT</h4>
										<hr>
                    <div class="row">
                      <div class="col-md-9">
                        <div class="form-group mb-2">
  				                 <label>INSTITUTION NAME (NO ABBREVIATIONS PLEASE)<span class="text-danger">*</span></label>
                           <input type="hidden" name="labID" id="labID" value="<?= isset($lab->labID) ? $lab->labID: ''?>">
  				                 <input type="text" class="form-control text-uppercase" name="institution_name" id="institution_name" value="<?= isset($lab->institution_name) ? $lab->institution_name: ''?>" autocomplete="off" readonly>
  				              </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group mb-2">
  				                 <label>YEAR LAST PARTICIPATED<span class="text-danger">*</span></label>
  				                 <input type="text" class="form-control text-uppercase input-details" name="year_participated" id="year_participated" autocomplete="off" title="Year last participated">
  				              </div>
                      </div>
                    </div>

				              <div class="alert alert-success p-2">
				                INSTITUTIONAL ADDRESS INFORMATION
				              </div>
				              <div class="row">
				                <div class="col-md-3">
				                  <label>PROVINCE<span class="text-danger">*</span></label>
                          <input type="text" class="form-control text-uppercase" name="province_code" id="province_code" value="<?= isset($province_name->name) ? $province_name->name: ''?>" autocomplete="off" readonly>
				                </div>
				                <div class="col-md-3 mb-3">
				                  <label>MUNICIPALITY/CITY<span class="text-danger">*</span></label>
                          <input type="text" class="form-control text-uppercase" name="municipal_code" id="municipal_code" value="<?= isset($mun->name) ? $mun->name: ''?>" autocomplete="off" readonly>
				                </div>
				                <div class="col-md-3 mb-3">
				                  <label>BARANGAY<span class="text-danger">*</span></label>
                          <input type="text" class="form-control text-uppercase" name="barangay_code" id="barangay_code" value="<?= isset($brgy->name) ? $brgy->name: ''?>" autocomplete="off" readonly>
				                </div>
				                <div class="col-md-3 mb-3">
				                  <label>NO. STREET<span class="text-danger">*</span></label>
				                  <input type="text" class="form-control text-uppercase" name="no_street" id="no_street" value="<?= isset($lab->no_street) ? $lab->no_street: ''?>" autocomplete="off" readonly>
				                </div>
												<div class="col-md-2 mb-3">
									        <label>POSTAL CODE<span class="text-danger">*</span></label>
									        <input type="number" class="form-control text-uppercase" name="postal" id="postal" value="<?= isset($lab->postal_code) ? $lab->postal_code: ''?>" autocomplete="off" readonly>
									      </div>
												<div class="col-md-5 mb-3">
									        <label>INSTITUTIONAL CONTACT NUMBER<span class="text-danger">*</span></label>
									        <input type="number" class="form-control" name="contact_no" id="contact_no" value="<?= isset($lab->contact_number) ? $lab->contact_number: ''?>" autocomplete="off" readonly>
									      </div>
												<div class="col-md-5 mb-3">
									        <label>INSTITUTIONAL EMAIL ADDRESS<span class="text-danger">*</span></label>
									        <input type="email" class="form-control" name="email_add" id="email_add" value="<?= isset($lab->email_add) ? $lab->email_add: ''?>" autocomplete="off" readonly>
									      </div>
				               </div>

											 <div class="row">
						             <div class="col-md-4 mb-3">
						               <div class="card" title="Please check the applicable details" style="border:none;">
						                 <div class="card-body p-2">
						                   <p class="text-success"><b>OWNERSHIP<span class="text-danger">*</span></b></p>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input ownership" id="ownership_gov" name="ownership_gov[]" value="1">
																	<label class="custom-control-label" for="ownership_gov">Government</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input ownership" id="ownership_private" name="ownership_private[]" value="1">
																	<label class="custom-control-label" for="ownership_private">Private</label>
															 </div>
						                   <p class="text-success"><b>INSTITUTIONAL CHARACTER<span class="text-danger">*</span></b></p>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input institutional" id="inst_based" name="inst_based" value="1">
																	<label class="custom-control-label" for="inst_based">Institution-based</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input institutional" id="inst_free" name="inst_free" value="1">
																	<label class="custom-control-label" for="inst_free">Freestanding</label><br><br>
															 </div>
						                 </div>
						               </div>
						             </div>

												 <div class="col-md-4 mb-3">
						               <div class="card" title="Please check the applicable details" style="border:none;">
						                 <div class="card-body p-2">
						                   <p class="text-success mb-0"><b>SERVICE CAPABILITY<span class="text-danger">*</span></b></p>
						                   <span><b>1. General Laboratory</b></span>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input service" id="primary_lab" name="primary_lab" value="1" onClick="ckChangeService(this)">
																	<label class="custom-control-label" for="primary_lab">Primary</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input service" id="secondary" name="secondary" value="1" onClick="ckChangeService(this)">
																	<label class="custom-control-label" for="secondary">Secondary</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input service" id="tertiary" name="tertiary" value="1" onClick="ckChangeService(this)">
																	<label class="custom-control-label" for="tertiary">Tertiary</label>
															 </div>
						                   <span><b>2. Special Laboratory</b></span>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input service" id="special" name="special" value="1" onClick="ckChangeService(this)">
																	<label class="custom-control-label" for="special">Special</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input service" id="anaerobic" name="anaerobic" value="1" onClick="ckChangeService(this)">
																	<label class="custom-control-label" for="anaerobic">Anaerobic Culture performed</label>
															 </div>
						                 </div>
						               </div>
						             </div>

												 <div class="col-md-4 mb-3">
						               <div class="card" title="Please check the applicable details" style="border:none;">
						                 <div class="card-body p-2">
						                   <p class="text-success" style="margin-bottom:12px;"><b>BLOOD SERVICE</b></p>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input blood" id="bloodCU" name="bloodCU" value="1" onClick="ckChange(this)">
																	<label class="custom-control-label" for="bloodCU">Blood Collecting Unit</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input blood" id="bloodSt" name="bloodSt" value="1" onClick="ckChange(this)">
																	<label class="custom-control-label" for="bloodSt">Blood Station</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input blood" id="bloodCUBS" name="bloodCUBS" value="1" onClick="ckChange(this)">
																	<label class="custom-control-label" for="bloodCUBS">Blood Collecting Unit/Blood Station</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input blood" id="bloodBk" name="bloodBk" value="1" onClick="ckChange(this)">
																	<label class="custom-control-label" for="bloodBk">Blood Bank</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input blood" id="bloodBkF" name="bloodBkF" value="1" onClick="ckChange(this)">
																	<label class="custom-control-label" for="bloodBkF">Blood Bank with Additional Function</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input blood" id="bloodCr" name="bloodCr" value="1" onClick="ckChange(this)">
																	<label class="custom-control-label" for="bloodCr">Blood Center</label><br>
															 </div>
						                 </div>
						               </div>
						             </div>

												 <div class="col-md-6 mb-3">
						               <label>HOSPITAL CHIEF/DIRECTOR<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="hospital_chief" id="hospital_chief" required title="Input Hospital Chief/Director">
						             </div>
						             <div class="col-md-6 mb-3">
						               <label>LABORATORY CHIEF/HEAD<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="lab_chief" id="lab_chief" title="Input Laboratory Chief/Head">
						             </div>
						             <div class="col-md-6 mb-3">
						               <label>HEAD OF BACTERIOLOGY<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="head_bacterioloy" id="head_bacterioloy" title="Input Head of Bacteriology">
						             </div>
						             <div class="col-md-6 mb-3">
						               <label>HEAD OF PARASITOLOGY<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="head_para" id="head_para" title="Input Head of Parasitology">
						             </div>
						             <div class="col-md-6 mb-3">
						               <label>HEAD OF TB LABORATORY<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="head_TB" id="head_TB" title="Input Head of TB Laboratory">
						             </div>
						             <div class="col-md-6 mb-3">
						               <label>HEAD OF BLOOD SERVICE FACILITY<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="head_bloodService" id="head_bloodService" title="Input Head of Blood Service Facility">
						             </div>
						           </div><!-- end row -->
										 </div><!-- end 1st tab -->
									 </div><!-- end card-box -->


									<div class="tab"><!-- 2nd tab -->
						          <div class="card-box pd-20 height-100-p mb-30">
												<h4>SHIPPING INFORMATION - OLD APPLICANT</h4>
												<hr>
												<div class="row">
													<div class="col-md-4 mb-3">
							               <label>CONTACT PERSON<span class="text-danger">*</span></label>
							               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="contact_person" id="contact_person" title="Please input contact person">
							            </div>
													<div class="col-md-4 mb-3">
							               <label>DEPARTMENT/LABORATORY/BRANCH NAME<span class="text-danger">*</span></label>
							               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="dept_lab_branch" id="dept_lab_branch" title="Please input department/laboratory/branch name">
							            </div>
													<div class="col-md-4 mb-3">
							               <label>TRUNK LINE/LOCAL NO.<span class="text-danger">*</span></label>
							               <input type="number" class="form-control input-details" name="trunk_line" id="trunk_line" autocomplete="off" title="Please input trunk line/local no.">
							            </div>
													<div class="col-md-4 mb-3">
							              <label>TELEPHONE (Area Code + Landline)<span class="text-danger">*</span></label>
							              <input type="number" class="form-control input-details" name="telephone" id="telephone" autocomplete="off" title="Please input telephone no.">
							            </div>
													<div class="col-md-4 mb-3">
							              <label>FAX (Area Code + Landline)</label>
							              <input type="number" class="form-control" name="fax" id="fax" autocomplete="off" title="Please input fax no.">
							            </div>
													<div class="col-md-4 mb-3">
							              <label>CONTACT NO.<span class="text-danger">*</span></label>
							              <input type="number" title="Please input contact number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" class="form-control input-details" name="contact_num" id="contact_num" autocomplete="off" required>
							            </div>
													<div class="col-md-4 mb-3">
							              <label>EMAIL ADDRESS<span class="text-danger">*</span></label>
							              <input type="email" class="form-control input-details" name="ship_email" id="ship_email" autocomplete="off" title="Please input email address">
							            </div>
													<div class="col-md-8 mb-3">
							              <label>SHIPPING ADDRESS<span class="text-danger mr-5">*</span>
															<input type="checkbox" class="custom-control-input facility_address" id="facility_address" name="facility_address">
		 												  <label class="custom-control-label text-danger" for="facility_address">Same as the facility address</label>
							              </label>
							              <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="ship_address" id="ship_address" title="Please input shipping address">
							            </div>
													<div class="col-md-12 mb-3">
								            <label>SHIPPING INSTRUCTIONS <span class="text-danger"><small><i>(optional)</i></small></span></label>
								            <textarea class="form-control text-uppercase" name="shipping_instruction" aria-label="With textarea"></textarea>
								          </div>
													<div class="col-md-6 mb-3">
							              <label>DESIGNATION OF SHIPPING CONSIGNEE<span class="text-danger">*</span></label>
							              <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="shipping_consignee" id="shipping_consignee" title="Please input shipping consignee">
							            </div>
													<div class="col-md-6 mb-3">
							              <label>DESIGNATION FOR HOSPITAL CHIEF/DIRECTOR<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
							              <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="designation_chief" id="designation_chief" title="Please input hospital chief/director">
							            </div>
												</div><!-- end row -->
												<div class="card" title="Please check all the applicable details">
							            <div class="card-body p-2">
														<p class="text-success"><b>Please check the best way to contact you<span class="text-danger mr-5">*</span></b>
															<input type="checkbox" class="custom-control-input selectall" id="selectall">
															<label class="custom-control-label" for="selectall">SELECT ALL</label>
							              </p>
														<div class="row">
															<div class="col-md-6">
							                  <div class="row">
							                    <div class="col-sm-3">
																		<div class="custom-control custom-checkbox mb-0">
		 																	<input type="checkbox" class="custom-control-input contact" id="chck_tel" name="chck_tel" value="1">
		 																	<label class="custom-control-label" for="chck_tel">Telephone</label>
		 															  </div>
							                    </div>
							                    <div class="col-sm-4">
																		<div class="custom-control custom-checkbox mb-0">
		 																	<input type="checkbox" class="custom-control-input contact" id="chck_mobile" name="chck_mobile" value="1">
		 																	<label class="custom-control-label" for="chck_mobile">Mobile Number</label>
		 															  </div>
							                    </div>
							                    <div class="col-sm-2">
																		<div class="custom-control custom-checkbox mb-0">
		 																	<input type="checkbox" class="custom-control-input contact" id="chck_email" name="chck_email" value="1">
		 																	<label class="custom-control-label" for="chck_email">Email</label>
		 															  </div>
							                    </div>
							                    <div class="col-sm-2">
																		<div class="custom-control custom-checkbox mb-0">
		 																	<input type="checkbox" class="custom-control-input contact" id="chck_fax" name="chck_fax" value="1">
		 																	<label class="custom-control-label" for="chck_fax">Fax</label>
		 															  </div>
							                    </div>
							                  </div>
							                </div>
															<div class="col-md-6">
																<input type="checkbox" class="custom-control-input" id="others" name="others" value="1">
																<label class="custom-control-label" for="others">Others <i>(please indicate)</i>:</label>
							                  <input type="text" class="others" name="other_specify" id="other_specify">
							                </div>
														</div><!-- end row -->
													</div>
												</div>
											</div><!-- end card-box -->
									</div><!-- end 2nd tab -->

									<div class="tab"><!-- 3rd tab -->
						          <div class="card-box pd-20 height-100-p mb-30">
												<h4>PROGRAM ENROLLMENT - OLD APPLICANT</h4>
												<hr>
												<p class="text-success"><b>Please check the proficiency test your laboratory would like to register<span class="text-danger">*</span></b></p>
												<div class="row">

													<div class="col-md-2">
														<div class="custom-control custom-checkbox mb-0">
															<input type="checkbox" class="custom-control-input program" id="chck_bac" name="chck_bac">
															<label class="custom-control-label" for="chck_bac">Bacteriology</label>
														</div>
							            </div>
													<div class="col-md-2">
														<div class="custom-control custom-checkbox mb-0">
															<input type="checkbox" class="custom-control-input program" id="chck_para" name="chck_para">
															<label class="custom-control-label" for="chck_para">Parasitology</label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="custom-control custom-checkbox mb-0">
															<input type="checkbox" class="custom-control-input program" id="chck_TB" name="chck_TB">
															<label class="custom-control-label" for="chck_TB">TB Microscopy</label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="custom-control custom-checkbox mb-0">
															<input type="checkbox" class="custom-control-input program" id="chck_culture" name="chck_culture">
															<label class="custom-control-label" for="chck_culture">TB Culture (Optional)</label>
														</div>
													</div>
													<div class="col-md-2">
														<div class="custom-control custom-checkbox mb-0">
															<input type="checkbox" class="custom-control-input program" id="chck_serology" name="chck_serology">
															<label class="custom-control-label" for="chck_serology">TTI Serology</label>
														</div>
													</div>
												</div><!-- end row -->
												<div class="input-group mt-2 col-md-4">
							            <div class="input-group-prepend">
							              <span class="input-group-text" id="basic-addon1">Total Payment</span>
							            </div>
							            <input type="text" class="form-control input-details" id="total" name="total" readonly>
							            <!-- <input type="text" class="form-control" id="test_total" name="test_total" readonly>-->
							            <input type="hidden" class="form-control" id="total_hide" name="total_hide">
							          </div>
											</div><!-- end card-box -->
									</div><!-- end 3rd tab -->

									<div class="tab"><!-- 4th tab -->
						          <div class="card-box pd-20 height-100-p mb-30">
												<h4>PAYMENT METHODS - OLD APPLICANT<span class="text-danger">*</span></h4>
												<hr>
												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="cash" name="cash" value="1" onClick="ckChangePayment(this)">
													<label class="custom-control-label" for="cash">Cash (for on-site payment only)</label>
												</div>
												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="company" name="company" value="1" onClick="ckChangePayment(this)">
													<label class="custom-control-label" for="company">Company/Manager’s Check/Postal Money Order – payable to RESEARCH INSTITUTE FOR TROPICAL MEDICINE</label>
												</div>
												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="landbank" name="landbank" value="1" onClick="ckChangePayment(this)">
													<label class="custom-control-label" for="landbank">LANDBANK Electronic Payment Portal</label>
												</div>
												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="mds" name="mds" value="1" onClick="ckChangePayment(this)">
													<label class="custom-control-label" for="mds">Modified Disbursement System (option for Government Agencies only)</label>
												</div>
							          <hr>
							          <span class="text-danger"><i>Please contact the NEQAS Office for clarifications<br>
							          DIRECT BANK DEPOSITS WILL NOT BE ACCEPTED</i></span>
											</div><!-- end card-box -->
									</div><!-- end 4th tab -->

									<div class="tab"><!-- 5th tab -->
						          <div class="card-box pd-20 height-100-p mb-30">
												<h4>ATTESTATION - OLD APPLICANT</span></h4>
												<hr>
												<p style="text-align:justify;">I, the undersigned, performing the laboratory testing must attest to the incorporation of the NEQAS analytes
							             into the routine laboratory workload and that the testing of the NEQAS analytes shall be done using the
							             laboratory’s standard operating procedures.
							          </p>
							          <p style="text-align:justify;">I also attest that the laboratory testing of the NEQAS analytes shall neither be referred to nor done in another
							              laboratory other than the laboratory that enrolled in the NEQAS program and that I should sign the Laboratory Result Form.
							          </p>
												<div class="row mt-5">
													<div class="col-md-6">
							              <div class="form-group">
							                <input type="text" name="noted_by" id="noted_by" class="form-control form-control-sm input-details text-uppercase">
							                <label><i>(Printed Name)</i></label><br>
							                <label><b>PATHOLOGY-LABORATORY HEAD</b></label>
							              </div>
							              <br>
							              <b>DATE</b>
							              <div class="form-group">
							                <input type="date" name="date_by" id="date_by" class="form-control form-control-sm input-details text-uppercase">
							              </div>
							            </div>
												</div>
											</div><!-- end card-box -->
									</div><!-- end 5th tab -->




										<div class="text-right mt-2 mb-5">
							        <button type="submit" class="btn btn-success" id="save_form" style="display:none;"><i class="icon-copy dw dw-next-2 mr-2"></i><span class="btn-txt">SUBMIT</span></button>
							      </div>
										<div style="overflow:auto;">
								      <div style="float:right;">
								        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
								        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
								        <button type="button" id='remove'name="button" style="display:none;">Review</button>
								      </div>
								    </div>
								    <!-- Circles which indicates the steps of the form: -->
								    <div style="text-align:center;margin-top:40px;">
								      <span class="step"></span>
								      <span class="step"></span>
								      <span class="step"></span>
								      <span class="step"></span>
								      <span class="step"></span>
								    </div>
								</form>
      			</section>

			<div class="footer-wrap pd-20 mb-20 card-box text-secondary">
				&copy; Copyright 2022 <b>NATIONAL EXTERNAL QUALITY ASSESSMENT SCHEME (NEQAS).</b> All Rights Reserved.
			</div>
		</div>
	</div>

	<script>
	var currentTab = 0; // Current tab is set to be the first tab (0)
	showTab(currentTab); // Display the current tab

	function showTab(n) {
	  // This function will display the specified tab of the form...
	  var x = document.getElementsByClassName("tab");
	  x[n].style.display = "block";
	  //... and fix the Previous/Next buttons:
	  if (n == 0) {
	    document.getElementById("prevBtn").style.display = "none";
	  } else {
	    document.getElementById("prevBtn").style.display = "inline";
	  }
	  if (n == (x.length - 1)) {
	   document.getElementById("nextBtn").innerHTML = "Review";
	   // var test =  document.getElementById("nextBtn");
	   // test.style.display = 'none'
	  } else {
	    document.getElementById("nextBtn").innerHTML = "Next";
	  }
	  //... and run a function that will display the correct step indicator:
	  fixStepIndicator(n)
	}

	function nextPrev(n) {
	  // This function will figure out which tab to display
	  var x = document.getElementsByClassName("tab");
	  // Exit the function if any field in the current tab is invalid:
	  if (n == 1 && !validateForm()) return false;
	  // Hide the current tab:
	  x[currentTab].style.display = "none";
	  // // Increase or decrease the current tab by 1:
	  currentTab = currentTab + n;
	  // if you have reached the end of the form...
	  if (currentTab >= x.length) {
	    // ... the form gets submitted:
	    document.getElementById("remove").click();

	    return false;
	  }
	  // Otherwise, display the correct tab:
	  showTab(currentTab);
	}

	function validateForm() {
	  // This function deals with validation of the form fields
	    var x, y, i, valid = true;
	    x = document.getElementsByClassName("tab");
	    y = x[currentTab].getElementsByClassName("input-details");
	    // A loop that checks every input field in the current tab:
	    for (i = 0; i < y.length; i++) {
	      // If a field is empty...
	      if (y[i].value == "") {
	        // add an "invalid" class to the field:
	        y[i].className += " require";
	        // and set the current valid status to false
	        valid = false;
	      }
	    }
	    // If the valid status is true, mark the step as finished and valid:
	    if (valid) {
	      document.getElementsByClassName("step")[currentTab].className += " finish";
	    }
	    return valid; // return the valid status
	}

	function fixStepIndicator(n) {
	  // This function removes the "active" class of all steps...
	  var i, x = document.getElementsByClassName("step");
	  for (i = 0; i < x.length; i++) {
	    x[i].className = x[i].className.replace(" active", "");
	  }
	  //... and adds the "active" class on the current step:
	  x[n].className += " active";
	}

	</script>

	<script>
	    Filevalidation = () => {
	        const fi = document.getElementById('lto_file');
	        // Check if any file is selected.
	        if (fi.files.length > 0) {
	            for (const i = 0; i <= fi.files.length - 1; i++) {

	                const fsize = fi.files.item(i).size;
	                const file = Math.round((fsize / 1024));
	                // The size of the file.
	                if (file >= 5000) {
	                    alert(
	                      "File too Big, please select a file less than 5mb");
	                      document.getElementById('lto_file').value = '';
	                } else {
	                    document.getElementById('size').innerHTML = '<b>'
	                    + file + '</b> KB';
	                }
	            }
	        }
	    }

	    function ckChange(ckType) {
	      var ckName = document.getElementsByClassName(ckType.className);

	      for (var i = 0; i < ckName.length; i++) {
	      if (!ckType.checked) {
	        ckName[i].disabled = false;
	      } else {
	        if (!ckName[i].checked) {
	          ckName[i].disabled = true;
	        } else {
	          ckName[i].disabled = false;
	        }
	      }
	      }
	    }

	    function ckChangeService(ckType) {
	      var ckName = document.getElementsByClassName(ckType.className);

	      for (var i = 0; i < ckName.length; i++) {
	      if (!ckType.checked) {
	        ckName[i].disabled = false;
	      } else {
	        if (!ckName[i].checked) {
	          ckName[i].disabled = true;
	        } else {
	          ckName[i].disabled = false;
	        }
	      }
	      }
	    }

	    function ckChangePayment(ckType) {
	      var ckName = document.getElementsByClassName(ckType.className);

	      for (var i = 0; i < ckName.length; i++) {
	      if (!ckType.checked) {
	        ckName[i].disabled = false;
	      } else {
	        if (!ckName[i].checked) {
	          ckName[i].disabled = true;
	        } else {
	          ckName[i].disabled = false;
	        }
	      }
	      }
	    }
	</script>

	<script>
	$(document).ready(function(){
	  $("#remove").click(function(){
	    if ($(this).text() == 'Review') {
	      $('.tab').css('display', 'block');
	      $('#prevBtn').css('display', 'none');
	      $('#nextBtn').css('display', 'none');
	      $('#save_form').css('display', 'block');
	      $("html").animate({ scrollTop: 0 }, "slow");
	    }
	  });

	  $('#other_specify').attr('disabled','disabled');
	  $('#others').click(function(){
	    if ($(this).is(":checked")) {
	      $('#other_specify').attr('disabled',false);
	      $('#other_specify').val('');
	    }else{
	      $('#other_specify').attr('disabled',true);
	      $('#other_specify').val('');
	    }
	  });

	  $('#ownership_gov').on('change', function(){
	    if($(this).is(':checked')) {
	      $('#ownership_private').prop('disabled', true);
	    }else{
	      $('#ownership_private').prop('disabled', false);
	    }
	  });

	  $('#ownership_private').on('change', function(){
	    if($(this).is(':checked')) {
	      $('#ownership_gov').prop('disabled', true);
	    }else{
	      $('#ownership_gov').prop('disabled', false);
	    }
	  });

	  $('#inst_based').on('change', function(){
	    if($(this).is(':checked')) {
	      $('#inst_free').prop('disabled', true);
	    }else{
	      $('#inst_free').prop('disabled', false);
	    }
	  });

	  $('#inst_free').on('change', function(){
	    if($(this).is(':checked')) {
	      $('#inst_based').prop('disabled', true);
	      $('#hospital_chief').removeClass('input-details');
	      $('#hospital_chief').attr('readonly', 'readonly');
	      $('#hospital_chief').val('');
	    }else{
	      $('#inst_based').prop('disabled', false);
	      $('#hospital_chief').addClass('input-details');
	      $('#hospital_chief').attr('readonly', false);
	    }
	  });

	  $('#facility_address').on('click', function(){
	    var street = $('#no_street').val();
	    var brgy = $('#barangay_code').val();
	    var mun = $('#municipal_code').val();
	    var prov = $('#province_code').val();
	    var postal = $('#postal').val();

	    if($(this).is(':checked'))
	    {
	      var address = street +' '+ brgy +', '+ mun +', '+ prov +', '+ postal;
	      $('#ship_address').val(address);
	      $('#ship_address').attr('readonly', true);
	    }else{
	      $('#ship_address').val('');
	      $('#ship_address').attr('readonly', false);
	    }
	  });

	  $('.program').change(function(){
	    var price_one = '7500';
	    var price_two = '4200';
	    var price_TTI = '13000';
	    var add = 0;
	    var output = '';

	    var bac = $('#chck_bac').is(':checked');
	    var para = $('#chck_para').is(':checked');
	    var tb = $('#chck_TB').is(':checked');
	    var culture = $('#chck_culture').is(':checked');
	    var serology = $('#chck_serology').is(':checked');

	    if (bac && para) {
	      output = parseInt(price_one).toLocaleString();
	      $('#total').val(output);
	      $('#total_hide').val(price_one);

	    }else if (bac) {
	      output = parseInt(price_one).toLocaleString();
	      $('#total').val(output);
	      $('#total_hide').val(price_one);

	    }else if (para && tb) {
	      output = parseInt(price_two).toLocaleString();
	      $('#total').val(output);
	      $('#total_hide').val(price_two);

	    }else if (para || tb) {
	      output = parseInt(price_two).toLocaleString();
	      $('#total').val(output);
	      $('#total_hide').val(price_two);

	    }else if (serology) {
	      output = parseInt(price_TTI).toLocaleString();
	      $('#total').val(output);
	      $('#total_hide').val(price_TTI);

	    }else{
	      $('#total').val('');
	      $('#total_hide').val('');
	    }

	    if (serology && bac) {
	      output = parseInt('20500').toLocaleString();
	      $('#total').val(output);
	      $('#total_hide').val('20500');
	    }
	  });

	  $('#selectall').click(function(){
	    if ($(this).is(':checked')) {
	      $('.contact').attr('checked', true);
	    }else{
	      $('.contact').attr('checked', false);
	    }
	  });
	});


	$(document).on('submit', '#old_applicant_registration', function(e){
	  e.preventDefault();
	    swal({
	      text: "Are you sure you want to continue? Or do you want to review your application before you proceed?",
	      icon: "warning",
	      buttons: ['Review/Edit', 'Confirm'],
	      dangerMode: true,
	    })
	    .then((willProceed) => {
	      if (willProceed) {
	        $.ajax({
	          url:"<?= base_url() . 'save_data/save_old_applicant'?>",
	          method:"POST",
	          data:new FormData(this),
	          contentType:false,
	          processData:false,
	          beforeSend:function()
	          {
	            $(".loading-icon").removeClass('hide');
	            $('#save_form').attr('disabled','disabled');
	            $('#nextBtn').text('Please wait...');
	            $('#modal_email').modal('show');
	          },
	          success:function(data)
	          {
	            $('#modal_email').modal('hide');
	            swal({
	                title: "Thank you!",
	                text: "Application successfully submitted. Please check your email for the copy of your application!",
	                icon: "success",
	                buttons: "Ok",
	              });
	              $('#old_applicant_registration')[0].reset();
	              setTimeout(function(){
	                window.location.href = "<?= base_url() . 'main'?>";
	              }, 2000)
	          }
	        });//end of ajax
	      }
	    });
	});
	</script>
