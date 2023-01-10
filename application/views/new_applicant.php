<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
//if($info->status == ''){
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

	.input-details.goods {
	  background-color: #fff;
	}

	.error {
		display: none;
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
			 <img src="<?= base_url()?>src/img/RITM-NEQAS-BannerV3.png" alt="" style="margin-left:5px;">
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
						<a class="dropdown-item" href="#changePass" data-toggle="modal"><i class="dw dw-edit-1"></i> Change Password</a>
						<a class="dropdown-item" href="<?= base_url('user/logout')?>"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar" style="background:#00523c">
		<div class="brand-logo">
			<a href="<?= base_url('main')?>">
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
					<li class="active">
						<a href="<?= base_url('main/new_applicant')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-add-file1"></span><span class="mtext">Application</span>
						</a>
					</li>
					<!-- <li>
						<a href="<?= base_url('main/old_applicant')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-add-file2"></span><span class="mtext">Old Applicant</span>
						</a>
					</li> -->
					<hr>
					<div class="footer">
            <div class="p-3 text-white">
              <p style="letter-spacing:1px; color:#f39c12;">NEQAS Contact Details:</p>
      				<span><b><i class="dw dw-email mr-2"></i>Email:</b> <span style="letter-spacing:1px;">neqas@ritm.gov.ph</span></span><br>
      				<span><b><i class="dw dw-phone-call mr-2"></i>Landline:</b> <span style="letter-spacing:1px;">(02) 8850 1949</span></span><br>
              <span><b><i class="dw dw-smartphone2 mr-2"></i>Cellphone:</b> <span style="letter-spacing:1px;">0945 220 4141</span></span><br>
            </div>
          </div>
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
						<img src="<?= base_url()?>vendors/images/banner-img-new.png" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10">
							Welcome Back
							<div class="weight-600 font-30 text-blue"><span class="text-secondary day-message"></span> <?= $_SESSION['loggedIn']['fullname'];?></div>
						</h4>
						<p class="font-18 max-width-700 text-secondary" style="text-align:justify;">
							The External Quality Assessment Scheme (EQAS) evaluates the performance of participating laboratories by assessing the integrity of the entire testing from
							sample receipt to releasing of test results. This would allow comparison of the laboratory's testing to the performance of a peer group and/or the national reference laboratory.
						</p>
					</div>
				</div>
			</div>

      	<section>
						<form id="neqas_form" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            	<div class="tab"><!-- 1st tab -->
				          <div class="card-box pd-20 height-100-p mb-30">
										<h4>HOSPITAL/LABORATORY INFORMATION <span id="hospital"></span></h4>
										<hr>
				              <div class="form-group mb-2">
				                 <label>INSTITUTION NAME (NO ABBREVIATIONS PLEASE)<span class="text-danger">*</span></label>
				                 <input type="text" class="form-control text-uppercase input-details" name="institution_name" id="institution_name" autocomplete="off" required title="Please input institution name">
												 <input type="hidden" name="labID" id="labID">
												 <input type="hidden" id="logic" name="logic">
												 <input type="hidden" id="brgy">
												 <input type="hidden" id="municipality">
												 <input type="hidden" id="province">

												 <input type="hidden" id="brgy_code" name="brgy_code">
												 <input type="hidden" id="municipality_code" name="municipality_code">
												 <input type="hidden" id="province_code1" name="province_code1">
											</div>
											<div class="form-group mb-2" id="last_participated">
												 <label>YEAR LAST PARTICIPATED<span class="text-danger">*</span></label>
												 <input type="text" class="form-control text-uppercase" name="year_participated" id="year_participated" autocomplete="off" title="Year last participated">
											</div>
											<div class="form-group" id="upload_lto">
												<label>Upload LTO <i>(for change of name, new participants) <span class="text-danger">pdf and jpeg only max size: 5mb</span></i></label>
												<!-- <input type="file" class="form-control-file form-control height-auto input-details" name="lto_file" accept=".pdf" id="lto_file" onchange="Filevalidation()"> -->
												<input type="file" class="form-control-file form-control height-auto input-details" name="lto_file" id="lto_file" onchange="Filevalidation()" accept="image/jpeg,image/jpg,application/pdf">
												<p id="size"></p>
											</div>
				              <div class="alert alert-success p-2">
				                INSTITUTIONAL ADDRESS INFORMATION
				              </div>
				              <div class="row">
				                <div class="col-md-3">
				                  <label>PROVINCE<span class="text-danger">*</span></label>
				                  <select class="custom-select input-details" name="province_code" id="province_code" required title="Please select province">
				                    <option value=""></option>
				                    <?php foreach($province as $pval){ ?>
				                      <option value="<?= $pval->code?>"><?= strtoupper($pval->name) ?></option>
				                    <?php } ?>
				                  </select>
				                </div>
				                <div class="col-md-3 mb-3">
				                  <label>MUNICIPALITY/CITY<span class="text-danger">*</span></label>
				                  <select class="custom-select input-details" name="municipal_code" id="municipal_code" required title="Please select municipality/city">
				          					<option value=""></option>
				                    <?php foreach($mun as $mval){ ?>
				                      <option value="<?= $mval->code?>"><?= strtoupper($mval->name) ?></option>
				                    <?php } ?>
				                  </select>
				                </div>
				                <div class="col-md-3 mb-3">
				                  <label>BARANGAY<span class="text-danger">*</span></label>
				                  <select class="custom-select input-details" name="barangay_code" id="barangay_code" required title="Please select barangay">
				                    <?php foreach($bgy as $bval){ ?>
				                      <option value="<?= $bval->code?>"><?= strtoupper($bval->name) ?></option>
				                    <?php } ?>
				                  </select>
				                </div>
				                <div class="col-md-3 mb-3">
				                  <label>NO. STREET<span class="text-danger">*</span></label>
				                  <input type="text" class="form-control text-uppercase input-details" name="no_street" id="no_street" autocomplete="off" required title="Please input house number/street">
				                </div>
												<div class="col-md-2 mb-3">
									        <label>POSTAL CODE<span class="text-danger">*</span></label>
									        <input type="number" class="form-control text-uppercase input-details" name="postal" id="postal" autocomplete="off" required title="Please input postal code">
									      </div>
												<div class="col-md-5 mb-3">
									        <label>INSTITUTIONAL CONTACT NUMBER<span class="text-danger">*</span></label>
									        <input type="number" placeholder="09xxxxxxxxx" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" class="form-control input-details" name="contact_no" id="contact_no" autocomplete="off" title="Please input 11 digit number">
									      </div>
												<div class="col-md-5 mb-3">
									        <label>INSTITUTIONAL EMAIL ADDRESS<span class="text-danger">*</span></label>
									        <input type="email" class="form-control input-details" name="email_add" id="email_add" autocomplete="off">
									      </div>
				               </div>

											 <div class="row">
						             <div class="col-md-4 mb-3">
						               <div class="card" title="Please check the applicable details" style="border:none;">
						                 <div class="card-body p-2 test">
						                   <p class="text-success"><b>OWNERSHIP<span class="text-danger">*</span></b></p>
															 <label class="text-danger error">You must check at least one in ownership!</label>
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
						               <label>HEAD OF LABORATORY<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
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
												<h4>SHIPPING INFORMATION <span id="ship"></span></h4>
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
													<div class="col-md-2 mb-3">
							               <label>TRUNK LINE<span class="text-danger">*</span></label>
							               <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8" class="form-control input-details" name="trunk_line" id="trunk_line" autocomplete="off" title="Please input trunk line/local no.">
							            </div>
													<div class="col-md-2 mb-3">
							               <label>LOCAL NO.<span class="text-danger">*</span></label>
							               <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4"  class="form-control input-details" name="local_no" id="local_no" autocomplete="off" title="Please input local no.">
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
							              <input type="number" placeholder="09xxxxxxxxx" title="Please input contact number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" class="form-control input-details" name="contact_num" id="contact_num" autocomplete="off" required>
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
															<!-- <div class="custom-control custom-checkbox mb-0">
																<input type="checkbox" class="custom-control-input selectall" id="selectall">
																<label class="custom-control-label" for="selectall">SELECT ALL</label>
															</div> -->
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
												<h4>PROGRAM ENROLLMENT <span id="prog"></span></h4>
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
												<h4>PAYMENT METHODS <span id="pay"></span><span class="text-danger">*</span></h4>
												<hr>
												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="cash" name="cash" value="1" onClick="ckChangePayment(this)">
													<label class="custom-control-label" for="cash">Cash (for on-site payment only)</label>
												</div>
												<div class="border rounded shadow-sm p-2 mb-5 bg-body rounded cash_options text-danger" style="font-size:13px;">
													- Cash payments are only available onsite for walk-in participants.
												</div>

												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="company" name="company" value="1" onClick="ckChangePayment(this)">
													<label class="custom-control-label" for="company">Company/Manager’s Check/Postal Money Order – payable to RESEARCH INSTITUTE FOR TROPICAL MEDICINE</label>
												</div>
												<div class="border rounded shadow-sm p-2 mb-5 bg-body rounded check_options text-danger" style="font-size:13px;">
													- Check payments may be sent via courier, however, processing may take several days due to check clearing.<br>
													- Personal checks will not be accepted.<br>
													- Please take note that checks should be made payable to:<br>
													<u><b>RESEARCH INSTITUTE FOR TROPICAL MEDICINE</b></u><br>
													- Please ensure that the handwriting is legible and that there are no erasures.<br>
													- Direct Deposit will not be allowed.
												</div>

												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="landbank" name="landbank" value="1" onClick="ckChangePayment(this)">
													<label class="custom-control-label" for="landbank">LANDBANK Electronic Payment Portal</label>
												</div>
												<div class="border rounded shadow-sm p-2 mb-5 bg-body rounded landbank_options text-danger" style="font-size:13px;">
													1. Go to <a href="http://epaymentportal.landbank.com" target="_blank">http://epaymentportal.landbank.com</a><br>
													2. Click <b>Pay Bills</b><br>
													3. Select <b>Research Institute for Tropical Medicine (RITM)</b> under R.<br>
													4. Select Registration Fee: <b>NEQAS PT-MICRO</b>.<br>
													5. Fill-out Transaction Form. Enter code for CAPTCHA.<br>
													6. Review Transaction Details. If all information are correct, click "Submit".<br>
													7. Choose Payment Option (e.g. LANDBANK ATM card).<br>
													8. Tick box for Terms and Conditions. Click “Submit”.<br>
													9. At the end of the Payment Details Page, input the following information:<br>
														 &emsp; a. 10-digit Account Number<br>
														 &emsp; b. Joint Account Indicator (JAI), and<br>
														 &emsp; c. Personal Identification Number (PIN)<br>
												 10. Click "Submit”, then "Print Debit Confirmation”.<br>
												 11. Click “Close Window” to begin another transaction.<br>
												 - Eligible Client Accounts:<br>
												 	 &emsp; - LANDBANK ATM Cards<br>
													 &emsp; - LANDBANK Visa Debit Cards<br>
													 &emsp; - BancNet member banks’ ATM/Debit Cards<br>
												 - A minimum transaction fee of 20.00 will be charged per successful transaction (additional P10.00 will be charged when using other BancNet member banks’ ATM/Debit Cards), and a payment confirmation receipt will be provided for your reference.<br>
												 - If you choose to pay via LANDBANK Electronic Payment Portal, <u>do not forget to send the filled up enrollment <b>form together with the payment confirmation receipt to NEQAS oflice for Registration.</b></u> Incomplete documents will not be processed.
												</div>

												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="mds" name="mds" value="1" onClick="ckChangePayment(this)">
													<label class="custom-control-label" for="mds">Modified Disbursement System (option for Government Agencies only)</label>
												</div>
												<div class="border rounded shadow-sm p-2 mb-5 bg-body rounded mds_options text-danger" style="font-size:13px;">
													- This payment option is for National Government Agencies (NGAs) only. <br>
													- For more information, please contact the NEQAS Admin Office.
												</div>

							          <hr>
							          <span class="text-danger">Please contact the NEQAS Office for clarifications</span><br>
												<b>Note:</b>
												<ul>
													<li>Payments should not be made until your registration has been pre-approved. You will receive an e-mail with payment instructions and the order of payment. </li>
													<li>Payments made in advance will not be accepted.</li>
													<li>Direct Deposit will not be allowed.</li>
												</ul>
											</div><!-- end card-box -->
									</div><!-- end 4th tab -->

									<div class="tab"><!-- 5th tab -->
						          <div class="card-box pd-20 height-100-p mb-30">
												<h4>ATTESTATION <span id="att"></span></span></h4>
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
	$(window).on('beforeunload', function(){
	      return false;
	});

	$('#cash').click(function(){
		if($(this).is(':checked')){
			$('.cash_options').show(200);
		}else{
			$('.cash_options').hide(200);
		}
	});

	$('#company').click(function(){
		if($(this).is(':checked')){
			$('.check_options').show(200);
		}else{
			$('.check_options').hide(200);
		}
	});

	$('#landbank').click(function(){
		if($(this).is(':checked')){
			$('.landbank_options').show(200);
		}else{
			$('.landbank_options').hide(200);
		}
	});

	$('#mds').click(function(){
		if($(this).is(':checked')){
			$('.mds_options').show(200);
		}else{
			$('.mds_options').hide(200);
		}
	});

	$(document).ready(function() {
		$('.cash_options').hide(300);
		$('.check_options').hide(300);
		$('.landbank_options').hide(300);
		$('.mds_options').hide(300);
		var thehours = new Date().getHours();
  	var themessage;
  	var morning = ('Good morning,');
  	var afternoon = ('Good afternoon,');
  	var evening = ('Good evening,');

  	if (thehours >= 0 && thehours < 12) {
  		themessage = morning;

  	} else if (thehours >= 12 && thehours < 17) {
  		themessage = afternoon;

  	} else if (thehours >= 17 && thehours < 24) {
  		themessage = evening;
  	}

  	$('.day-message').append(themessage);
	});
	</script>

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

			var checkbox = x[currentTab].getElementsByClassName("ownership"),i,checked;
		  for (i = 0; i < checkbox.length; i += 1) {
		    checked = (checkbox[i].checked||checked===true)?true:false;
		  }
		  if (checked == false) {
		    alert('You must check at least one in ownership!');
				$([document.documentElement, document.body]).animate({
					scrollTop: $("#neqas_form").offset().top
				},1000);
		    return false;
		  }

			var institutional = x[currentTab].getElementsByClassName("institutional"),i,checked_institutional;
		  for (i = 0; i < institutional.length; i += 1) {
		    checked_institutional = (institutional[i].checked||checked_institutional===true)?true:false;
		  }
		  if (checked_institutional == false) {
		    alert('You must check at least one in institutional character!');
				$([document.documentElement, document.body]).animate({
					scrollTop: $("#neqas_form").offset().top
				},1000);
		    return false;
		  }

			var service = x[currentTab].getElementsByClassName("service"),i,checked_service;
		  for (i = 0; i < service.length; i += 1) {
		    checked_service = (service[i].checked||checked_service===true)?true:false;
		  }
		  if (checked_service == false) {
		    alert('You must check at least one in service capability!');
				$([document.documentElement, document.body]).animate({
					scrollTop: $("#neqas_form").offset().top
				},1000);
		    return false;
		  }

			var program = x[currentTab].getElementsByClassName("program"),i,checked_program;
		  for (i = 0; i < program.length; i += 1) {
		    checked_program = (program[i].checked||checked_program===true)?true:false;
		  }
		  if (checked_program == false) {
		    alert('You must check at least one in program enrollment!');
				$([document.documentElement, document.body]).animate({
					scrollTop: $("#neqas_form").offset().top
				},1000);
		    return false;
		  }

			var payment = x[currentTab].getElementsByClassName("payment"),i,checked_payment;
		  for (i = 0; i < payment.length; i += 1) {
		    checked_payment = (payment[i].checked||checked_payment===true)?true:false;
		  }
		  if (checked_payment == false) {
		    alert('You must check at least one in payment method!');
				$([document.documentElement, document.body]).animate({
					scrollTop: $("#neqas_form").offset().top
				},1000);
		    return false;
		  }

	    // A loop that checks every input field in the current tab:
	    for (i = 0; i < y.length; i++) {
	      // If a field is empty...
	      if (y[i].value == "") {
	        // add an "invalid" class to the field:
	        y[i].className += " require";
					// add scroll focus to required fields:
					$([document.documentElement, document.body]).animate({
						scrollTop: $("#neqas_form").offset().top
					},1000);
	        // and set the current valid status to false
	        valid = false;
	      }else{
					y[i].className += " goods";
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
		$('#last_participated').hide();
	  var table = $('#data-table').DataTable({
	    destroy: true,
	    scrollCollapse: true,
	    autoWidth: false,
	    responsive: true,
	    ordering: false,
	    serverSide:true,
	    processing:true,
	    pageLength:25,
	    "language": {
	      // "info": "_START_-_END_ of _TOTAL_ entries",
	      searchPlaceholder: "Search",
	      paginate: {
	        next: '<i class="ion-chevron-right"></i>',
	        previous: '<i class="ion-chevron-left"></i>'
	      }
	    },
	    "ajax": {
	      "url": "<?= base_url('save_data/load_application')?>",
	      "type": "POST"
	    },
	  });

	  var table = $('#table-list').DataTable({
	    destroy: true,
	    scrollCollapse: true,
	    autoWidth: false,
	    responsive: true,
	    ordering: false,
	    serverSide:true,
	    processing:true,
	    pageLength:25,
	    "language": {
	      // "info": "_START_-_END_ of _TOTAL_ entries",
	      searchPlaceholder: "Search",
	      paginate: {
	        next: '<i class="ion-chevron-right"></i>',
	        previous: '<i class="ion-chevron-left"></i>'
	      }
	    },
	    "ajax": {
	      "url": "<?= base_url('save_data/load_labinfo')?>",
	      "type": "POST",
	      "data": function (data) {
	          data.institution_name = $('#institution_name').val();
	      }
	    },
	  });
	  $('#institution_name').on('change', function(){
	    table.draw();
	  });
	});

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
	    var brgy = $('#brgy').val();
	    var mun = $('#municipality').val();
	    var prov = $('#province').val();
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
	    }else if (tb && serology) {
				output = parseInt('17200').toLocaleString();
	      $('#total').val(output);
	      $('#total_hide').val('17200');
	    }else if (para && serology) {
				output = parseInt('17200').toLocaleString();
	      $('#total').val(output);
	      $('#total_hide').val('17200');
	    }
	  });
	});

  $(document).ready(function () {
    $("#selectall").change(function () {
      $(".contact").prop('checked', $(this).prop("checked"));
    });

		$('.contact').on('click', function () {
      if ($('.contact:checked').length == $('.contact').length) {
        $('#selectall').prop('checked', true);
      } else {
        $('#selectall').prop('checked', false);
      }
    });
  });

	$(document).on('change','#province_code',function(){
	  var elem = $(this);
	  var code = elem.val();
	  var text = elem.find('option:selected').text();
	  console.log(code);
	  $.post("/neqas/main/get_municipal/",{code:code},function(data){
	    $('#municipal_code').html(data);
	    $('#barangay_code').html('<option value=""><option>');
	    $('#province').val(text);
	  },"JSON");
	});

	$(document).on('change','#municipal_code',function(){
	  var elem = $(this);
	  var code = elem.val();
	  var text = elem.find('option:selected').text();
	  console.log(code);
	  $.post("/neqas/main/get_barangay/",{code:code},function(data){
	    $('#barangay_code').html(data);
	    $('#municipality').val(text);
	  },"JSON");
	});

	$(document).on('change','#barangay_code',function(){
	  var elem = $(this);
	  var code = elem.val();
	  var text = elem.find('option:selected').text();
	  $('#brgy').val(text);
	});

	$(document).on('submit', '#neqas_form', function(event){
	  event.preventDefault();
		event.stopImmediatePropagation();
	    swal({
	      text: "Are you sure you want to continue?",
	      icon: "warning",
	      buttons: ['No', 'Yes'],
	      dangerMode: true,
	    })
	    .then((willProceed) => {
	      if (willProceed) {
	        $.ajax({
	          url:"<?= base_url() . 'save_data/save'?>",
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
	              $('#neqas_form')[0].reset();
	              setTimeout(function(){
									$(window).unbind('beforeunload');
	                window.location.href = "<?= base_url() . 'main'?>";
	              }, 2000)
	          }
	        });//end of ajax
	      } else {
					$("html").animate({ scrollTop: 0 }, "slow");
				}
	    });
	});
	</script>

<?php
//}
?>
