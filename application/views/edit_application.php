<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>

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

</style>
<?php
  foreach ($result as $row) {
    $reference = $row->reference_no;

    $hospital_chief = $row->hospital_chief;
    $lab_chief = $row->lab_chief;
    $head_bacterioloy = $row->head_bacterioloy;
    $head_para = $row->head_para;
    $head_TB = $row->head_TB;
    $head_bloodService = $row->head_bloodService;

    $ownership_gov = $row->ownership_gov;
    $ownership_private = $row->ownership_private;
    //tblinstitutional_char
    $inst_based = $row->inst_based;
    $inst_free = $row->inst_free;
    //tblservice_capability
    $primary_lab = $row->primary_lab;
    $secondary = $row->secondary;
    $tertiary = $row->tertiary;
    $special = $row->special;
    $anaerobic = $row->anaerobic;
    //tblblood_service
    $bloodCU = $row->bloodCU;
    $bloodSt = $row->bloodSt;
    $bloodCUBS = $row->bloodCUBS;
    $bloodBk = $row->bloodBk;
    $bloodBkF = $row->bloodBkF;
    $bloodCr = $row->bloodCr;
    //tblshipping_Info
    $contact_person = $row->contact_person;
    $telephone = $row->telephone;
    $fax = $row->fax;
    $email = $row->email;
    $dept_lab_branch = $row->dept_lab_branch;
    $trunk_line = $row->trunk_line;
    $local_no = $row->local_no;
    $ship_address = $row->ship_address;
    $ship_consignee = $row->ship_consignee;
    $desig_chief_director = $row->desig_chief_director;
    $chck_tel = $row->chck_tel;
    $chck_mobile = $row->chck_mobile;
    $chck_email = $row->chck_email;
    $chck_fax = $row->chck_fax;
    $others = $row->others;
    $other_specify = $row->other_specify;
    $ship_contact_no = $row->contact_no;
    $ship_instruct = $row->shipping_instructions;
    //tblprogram_Enrollment
    $chck_bac = $row->chck_bac;
    $chck_para = $row->chck_para;
    $chck_TB = $row->chck_TB;
    $chck_culture = $row->chck_culture;
    $chck_serology = $row->chck_serology;
    $total_payment = $row->total_payment;
    //tblpayment;
    $cash = $row->cash;
    $company = $row->company;
    $landbank = $row->landbank;
    $mds = $row->mds;


    $noted_by = $row->noted_by;
    $date_by = $row->date_by;
  }

  foreach ($brgy as $bgy) {
    $barangay = strtoupper($bgy->name);
  }

  foreach ($mun as $mun_row) {
    $municipal = strtoupper($mun_row->name);
  }

  foreach ($province_name as $province) {
    $province_name = strtoupper($province->name);
  }
?>

<body>

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
						<form id="edit_neqas_form" method="POST" enctype="multipart/form-data">
            	<div class="tab"><!-- 1st tab -->
				          <div class="card-box pd-20 height-100-p mb-30">
										<h4>HOSPITAL/LABORATORY INFORMATION <span id="hospital"></span></h4>
										<hr>
                    <input type="hidden" name="refno" id="refno" value="<?= $reference;?>">
										<input type="hidden" name="labID" id="labID" value="<?= $lab_id;?>">
				              <div class="form-group mb-2">
				                 <label>INSTITUTION NAME (NO ABBREVIATIONS PLEASE)<span class="text-danger">*</span></label>
				                 <input type="text" class="form-control text-uppercase input-details" name="institution_name" id="institution_name" id="institution_name" value="<?= isset($institution) ? $institution: ''?>">
											</div>
                      <hr>
											<!-- <div class="form-group mb-2" id="last_participated">
												 <label>YEAR LAST PARTICIPATED<span class="text-danger">*</span></label>
												 <input type="text" class="form-control text-uppercase" name="year_participated" id="year_participated" autocomplete="off" title="Year last participated">
											</div>
											<div class="form-group" id="upload_lto">
												<label>Upload LTO <i>(for change of name, new participants) <span class="text-danger">pdf only max size: 5mb</span></i></label>
												<input type="file" class="form-control-file form-control height-auto input-details" name="lto_file" accept=".pdf" id="lto_file" onchange="Filevalidation()">
												<p id="size"></p>
											</div> -->
				              <div class="alert alert-success p-2">
				                INSTITUTIONAL ADDRESS INFORMATION
				              </div>
				              <div class="row">
				                <div class="col-md-3">
				                  <label>PROVINCE<span class="text-danger">*</span></label>
				                  <input type="text" class="form-control" name="province" id="province" value="<?= isset($province_name) ? $province_name: ''?>" readonly>
				                </div>
				                <div class="col-md-3 mb-3">
				                  <label>MUNICIPALITY/CITY<span class="text-danger">*</span></label>
				                  <input type="text" class="form-control" name="municipality" id="municipality" value="<?= isset($municipal) ? $municipal: ''?>" readonly>
				                </div>
				                <div class="col-md-3 mb-3">
				                  <label>BARANGAY<span class="text-danger">*</span></label>
				                  <input type="text" class="form-control" name="brgy" id="brgy" value="<?= isset($barangay) ? $barangay: ''?>" readonly>
				                </div>
				                <div class="col-md-3 mb-3">
				                  <label>NO. STREET<span class="text-danger">*</span></label>
				                  <input type="text" class="form-control text-uppercase" name="no_street" id="no_street" value="<?= isset($no_street) ? $no_street: ''?>" readonly>
				                </div>
												<div class="col-md-2 mb-3">
									        <label>POSTAL CODE<span class="text-danger">*</span></label>
									        <input type="number" class="form-control text-uppercase" name="postal" id="postal" value="<?= isset($postal) ? $postal: ''?>" readonly>
									      </div>
												<div class="col-md-5 mb-3">
									        <label>INSTITUTIONAL CONTACT NUMBER<span class="text-danger">*</span></label>
									        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" class="form-control" name="contact_no" id="contact_no" value="<?= isset($contact_no) ? $contact_no: ''?>">
									      </div>
												<div class="col-md-5 mb-3">
									        <label>INSTITUTIONAL EMAIL ADDRESS<span class="text-danger">*</span></label>
									        <input type="email" class="form-control" name="email_add" id="email_add" value="<?= isset($email_add) ? $email_add: ''?>">
									      </div>
				               </div>

											 <div class="row">
						             <div class="col-md-4 mb-3">
						               <div class="card" title="Please check the applicable details" style="border:none;">
						                 <div class="card-body p-2 test">
						                   <p class="text-success"><b>OWNERSHIP<span class="text-danger">*</span></b></p>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input ownership" id="ownership_gov" name="ownership_gov[]" value="1" <?= (isset($ownership_gov) && $ownership_gov=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="ownership_gov">Government</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input ownership" id="ownership_private" name="ownership_private[]" value="1" <?= (isset($ownership_private) && $ownership_private=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="ownership_private">Private</label>
															 </div>
						                   <p class="text-success"><b>INSTITUTIONAL CHARACTER<span class="text-danger">*</span></b></p>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input institutional" id="inst_based" name="inst_based" value="1" <?= (isset($inst_based) && $inst_based=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="inst_based">Institution-based</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input institutional" id="inst_free" name="inst_free" value="1" <?= (isset($inst_free) && $inst_free=='1') ? 'checked':'' ?>>
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
																	<input type="checkbox" class="custom-control-input service" id="primary_lab" name="primary_lab" value="1" onClick="ckChangeService(this)" value="1" <?= (isset($primary_lab) && $primary_lab=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="primary_lab">Primary</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input service" id="secondary" name="secondary" value="1" onClick="ckChangeService(this)" <?= (isset($secondary) && $secondary=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="secondary">Secondary</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input service" id="tertiary" name="tertiary" value="1" onClick="ckChangeService(this)" <?= (isset($tertiary) && $tertiary=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="tertiary">Tertiary</label>
															 </div>
						                   <span><b>2. Special Laboratory</b></span>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input service" id="special" name="special" value="1" onClick="ckChangeService(this)" <?= (isset($special) && $special=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="special">Special</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input service" id="anaerobic" name="anaerobic" value="1" onClick="ckChangeService(this)" <?= (isset($anaerobic) && $anaerobic=='1') ? 'checked':'' ?>>
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
																	<input type="checkbox" class="custom-control-input blood" id="bloodCU" name="bloodCU" value="1" onClick="ckChange(this)" <?= (isset($bloodCU) && $bloodCU=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="bloodCU">Blood Collecting Unit</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input blood" id="bloodSt" name="bloodSt" value="1" onClick="ckChange(this)" <?= (isset($bloodSt) && $bloodSt=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="bloodSt">Blood Station</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input blood" id="bloodCUBS" name="bloodCUBS" value="1" onClick="ckChange(this)" <?= (isset($bloodCUBS) && $bloodCUBS=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="bloodCUBS">Blood Collecting Unit/Blood Station</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input blood" id="bloodBk" name="bloodBk" value="1" onClick="ckChange(this)" <?= (isset($bloodBk) && $bloodBk=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="bloodBk">Blood Bank</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input blood" id="bloodBkF" name="bloodBkF" value="1" onClick="ckChange(this)" <?= (isset($bloodBkF) && $bloodBkF=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="bloodBkF">Blood Bank with Additional Function</label>
															 </div>
															 <div class="custom-control custom-checkbox mb-0">
																	<input type="checkbox" class="custom-control-input blood" id="bloodCr" name="bloodCr" value="1" onClick="ckChange(this)" <?= (isset($bloodCr) && $bloodCr=='1') ? 'checked':'' ?>>
																	<label class="custom-control-label" for="bloodCr">Blood Center</label><br>
															 </div>
						                 </div>
						               </div>
						             </div>

												 <div class="col-md-6 mb-3">
						               <label>HOSPITAL CHIEF/DIRECTOR<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="hospital_chief" id="hospital_chief" value="<?= isset($hospital_chief) ? $hospital_chief: ''?>">
						             </div>
						             <div class="col-md-6 mb-3">
						               <label>HEAD OF LABORATORY<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="lab_chief" id="lab_chief" value="<?= isset($lab_chief) ? $lab_chief: ''?>">
						             </div>
						             <div class="col-md-6 mb-3">
						               <label>HEAD OF BACTERIOLOGY<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="head_bacterioloy" id="head_bacterioloy" value="<?= isset($head_bacterioloy) ? $head_bacterioloy: ''?>">
						             </div>
						             <div class="col-md-6 mb-3">
						               <label>HEAD OF PARASITOLOGY<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="head_para" id="head_para" value="<?= isset($head_para) ? $head_para: ''?>">
						             </div>
						             <div class="col-md-6 mb-3">
						               <label>HEAD OF TB LABORATORY<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="head_TB" id="head_TB" value="<?= isset($head_TB) ? $head_TB: ''?>">
						             </div>
						             <div class="col-md-6 mb-3">
						               <label>HEAD OF BLOOD SERVICE FACILITY<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
						               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="head_bloodService" id="head_bloodService" value="<?= isset($head_bloodService) ? $head_bloodService: ''?>">
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
							               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="contact_person" id="contact_person" value="<?= isset($contact_person) ? $contact_person: ''?>">
							            </div>
													<div class="col-md-4 mb-3">
							               <label>DEPARTMENT/LABORATORY/BRANCH NAME<span class="text-danger">*</span></label>
							               <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="dept_lab_branch" id="dept_lab_branch" value="<?= isset($dept_lab_branch) ? $dept_lab_branch: ''?>">
							            </div>
													<div class="col-md-2 mb-3">
							               <label>TRUNK LINE<span class="text-danger">*</span></label>
							               <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8" class="form-control input-details" name="trunk_line" id="trunk_line" value="<?= isset($trunk_line) ? $trunk_line: ''?>">
							            </div>
													<div class="col-md-2 mb-3">
							               <label>LOCAL NO.<span class="text-danger">*</span></label>
							               <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4"  class="form-control input-details" name="local_no" id="local_no" value="<?= isset($local_no) ? $local_no: ''?>">
							            </div>
													<div class="col-md-4 mb-3">
							              <label>TELEPHONE (Area Code + Landline)<span class="text-danger">*</span></label>
							              <input type="number" class="form-control input-details" name="telephone" id="telephone" value="<?= isset($telephone) ? $telephone: ''?>">
							            </div>
													<div class="col-md-4 mb-3">
							              <label>FAX (Area Code + Landline)</label>
							              <input type="number" class="form-control" name="fax" id="fax" value="<?= isset($fax) ? $fax: ''?>">
							            </div>
													<div class="col-md-4 mb-3">
							              <label>CONTACT NO.<span class="text-danger">*</span></label>
							              <input type="number" placeholder="09xxxxxxxxx" title="Please input contact number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" class="form-control input-details" name="contact_num" id="contact_num" value="<?= isset($ship_contact_no) ? $ship_contact_no: ''?>">
							            </div>
													<div class="col-md-4 mb-3">
							              <label>EMAIL ADDRESS<span class="text-danger">*</span></label>
							              <input type="email" class="form-control input-details" name="ship_email" id="ship_email" value="<?= isset($email) ? $email: ''?>">
							            </div>
													<div class="col-md-8 mb-3">
							              <label>SHIPPING ADDRESS<span class="text-danger mr-5">*</span>
															<!-- <input type="checkbox" class="custom-control-input facility_address" id="facility_address" name="facility_address">
		 												  <label class="custom-control-label text-danger" for="facility_address">Same as the facility address</label> -->
							              </label>
							              <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="ship_address" id="ship_address" value="<?= isset($ship_address) ? $ship_address: ''?>">
							            </div>
													<div class="col-md-12 mb-3">
								            <label>SHIPPING INSTRUCTIONS <span class="text-danger"><small><i>(optional)</i></small></span></label>
								            <textarea class="form-control text-uppercase" name="shipping_instruction" aria-label="With textarea"><?= isset($ship_instruct) ? $ship_instruct: ''?></textarea>
								          </div>
													<div class="col-md-6 mb-3">
							              <label>DESIGNATION OF SHIPPING CONSIGNEE<span class="text-danger">*</span></label>
							              <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="shipping_consignee" id="shipping_consignee" value="<?= isset($ship_consignee) ? $ship_consignee: ''?>">
							            </div>
													<div class="col-md-6 mb-3">
							              <label>DESIGNATION FOR HOSPITAL CHIEF/DIRECTOR<span class="text-danger">* <i><small>(If not applicable type N/A)</small></i></span></label>
							              <input type="text" class="form-control text-uppercase input-details" autocomplete="off" name="designation_chief" id="designation_chief" value="<?= isset($desig_chief_director) ? $desig_chief_director: ''?>">
							            </div>
												</div><!-- end row -->
												<div class="card" title="Please check all the applicable details">
							            <div class="card-body p-2">
														<p class="text-success"><b>Please check the best way to contact you<span class="text-danger mr-5">*</span></b>
															<!-- <input type="checkbox" class="custom-control-input selectall" id="selectall">
															<label class="custom-control-label" for="selectall">SELECT ALL</label> -->
							              </p>
														<div class="row">
															<div class="col-md-6">
							                  <div class="row">
							                    <div class="col-sm-3">
																		<div class="custom-control custom-checkbox mb-0">
		 																	<input type="checkbox" class="custom-control-input contact" id="chck_tel" name="chck_tel" value="1" <?= (isset($chck_tel) && $chck_tel=='1') ? 'checked':'' ?>>
		 																	<label class="custom-control-label" for="chck_tel">Telephone</label>
		 															  </div>
							                    </div>
							                    <div class="col-sm-4">
																		<div class="custom-control custom-checkbox mb-0">
		 																	<input type="checkbox" class="custom-control-input contact" id="chck_mobile" name="chck_mobile" value="1" <?= (isset($chck_mobile) && $chck_mobile=='1') ? 'checked':'' ?>>
		 																	<label class="custom-control-label" for="chck_mobile">Mobile Number</label>
		 															  </div>
							                    </div>
							                    <div class="col-sm-2">
																		<div class="custom-control custom-checkbox mb-0">
		 																	<input type="checkbox" class="custom-control-input contact" id="chck_email" name="chck_email" value="1" <?= (isset($chck_email) && $chck_email=='1') ? 'checked':'' ?>>
		 																	<label class="custom-control-label" for="chck_email">Email</label>
		 															  </div>
							                    </div>
							                    <div class="col-sm-2">
																		<div class="custom-control custom-checkbox mb-0">
		 																	<input type="checkbox" class="custom-control-input contact" id="chck_fax" name="chck_fax" value="1" <?= (isset($chck_fax) && $chck_fax=='1') ? 'checked':'' ?>>
		 																	<label class="custom-control-label" for="chck_fax">Fax</label>
		 															  </div>
							                    </div>
							                  </div>
							                </div>
															<div class="col-md-6">
																<input type="checkbox" class="custom-control-input" id="others" name="others" value="1" <?= (isset($others) && $others=='1') ? 'checked':'' ?>>
																<label class="custom-control-label" for="others">Others <i>(please indicate)</i>:</label>
							                  <input type="text" class="others" name="other_specify" id="other_specify" value="<?= isset($other_specify) ? $other_specify: ''?>">
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
															<input type="checkbox" class="custom-control-input program" id="chck_bac" name="chck_bac" <?= (isset($chck_bac) && $chck_bac=='1') ? 'checked':'' ?>>
															<label class="custom-control-label" for="chck_bac">Bacteriology</label>
														</div>
							            </div>
													<div class="col-md-2">
														<div class="custom-control custom-checkbox mb-0">
															<input type="checkbox" class="custom-control-input program" id="chck_para" name="chck_para" <?= (isset($chck_para) && $chck_para=='1') ? 'checked':'' ?>>
															<label class="custom-control-label" for="chck_para">Parasitology</label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="custom-control custom-checkbox mb-0">
															<input type="checkbox" class="custom-control-input program" id="chck_TB" name="chck_TB" <?= (isset($chck_TB) && $chck_TB=='1') ? 'checked':'' ?>>
															<label class="custom-control-label" for="chck_TB">TB Microscopy</label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="custom-control custom-checkbox mb-0">
															<input type="checkbox" class="custom-control-input program" id="chck_culture" name="chck_culture" <?= (isset($chck_culture) && $chck_culture=='1') ? 'checked':'' ?>>
															<label class="custom-control-label" for="chck_culture">TB Culture (Optional)</label>
														</div>
													</div>
													<div class="col-md-2">
														<div class="custom-control custom-checkbox mb-0">
															<input type="checkbox" class="custom-control-input program" id="chck_serology" name="chck_serology" <?= (isset($chck_serology) && $chck_serology=='1') ? 'checked':'' ?>>
															<label class="custom-control-label" for="chck_serology">TTI Serology</label>
														</div>
													</div>
												</div><!-- end row -->
												<div class="input-group mt-2 col-md-4">
							            <div class="input-group-prepend">
							              <span class="input-group-text" id="basic-addon1">Total Payment</span>
							            </div>
							            <input type="text" class="form-control input-details" id="total" name="total" value="<?= isset($total_payment) ? $total_payment: ''?>" readonly>
							            <input type="hidden" class="form-control" id="total_hide" name="total_hide" value="<?= isset($total_payment) ? $total_payment: ''?>">
							          </div>
											</div><!-- end card-box -->
									</div><!-- end 3rd tab -->

									<div class="tab"><!-- 4th tab -->
						          <div class="card-box pd-20 height-100-p mb-30">
												<h4>PAYMENT METHODS <span id="pay"></span><span class="text-danger">*</span></h4>
												<hr>
												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="cash" name="cash" value="1" onClick="ckChangePayment(this)" <?= (isset($cash) && $cash=='1') ? 'checked':'' ?>>
													<label class="custom-control-label" for="cash">Cash (for on-site payment only)</label>
												</div>
												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="company" name="company" value="1" onClick="ckChangePayment(this)" <?= (isset($company) && $company=='1') ? 'checked':'' ?>>
													<label class="custom-control-label" for="company">Company/Manager’s Check/Postal Money Order – payable to RESEARCH INSTITUTE FOR TROPICAL MEDICINE</label>
												</div>
												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="landbank" name="landbank" value="1" onClick="ckChangePayment(this)" <?= (isset($landbank) && $landbank=='1') ? 'checked':'' ?>>
													<label class="custom-control-label" for="landbank">LANDBANK Electronic Payment Portal</label>
												</div>
												<div class="custom-control custom-checkbox mb-0">
													<input type="checkbox" class="custom-control-input payment" id="mds" name="mds" value="1" onClick="ckChangePayment(this)" <?= (isset($mds) && $mds=='1') ? 'checked':'' ?>>
													<label class="custom-control-label" for="mds">Modified Disbursement System (option for Government Agencies only)</label>
												</div>
							          <hr>
							          <span class="text-danger"><i>Please contact the NEQAS Office for clarifications<br>
							          DIRECT BANK DEPOSITS WILL NOT BE ACCEPTED</i></span>
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
							                <input type="text" name="noted_by" id="noted_by" class="form-control form-control-sm input-details text-uppercase" value="<?= isset($noted_by) ? $noted_by: ''?>">
							                <label><i>(Printed Name)</i></label><br>
							                <label><b>PATHOLOGY-LABORATORY HEAD</b></label>
							              </div>
							              <br>
							              <b>DATE</b>
							              <div class="form-group">
							                <input type="date" name="date_by" id="date_by" class="form-control form-control-sm input-details" value="<?= isset($date_by) ? $date_by: ''?>">
							              </div>
							            </div>
												</div>
											</div><!-- end card-box -->
									</div><!-- end 5th tab -->



										<div class="mb-5">
							        <button type="submit" class="btn btn-success" id="edit_form"><i class="icon-copy dw dw-next-2 mr-2"></i><span class="btn-txt">UPDATE</span></button>
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

	$(document).ready(function() {
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

	$(document).on('submit', '#edit_neqas_form', function(e){
	  e.preventDefault();
    e.stopImmediatePropagation();
	    swal({
	      text: "Are you sure you want to continue?",
	      icon: "warning",
	      buttons: ['No', 'Yes'],
	      dangerMode: true,
	    })
	    .then((willProceed) => {
	      if (willProceed) {
	        $.ajax({
	          url:"<?= base_url() . 'save_data/update_applicant_info'?>",
	          method:"POST",
	          data:new FormData(this),
	          contentType:false,
	          processData:false,
	          beforeSend:function()
	          {
	            $('#edit_form').attr('disabled','disabled');
	          },
	          success:function(data)
	          {
	            swal({
	                title: "Thank you!",
	                text: "Application successfully updated!",
	                icon: "success",
	                buttons: "Ok",
	              });
	              $('#edit_neqas_form')[0].reset();
	              setTimeout(function(){
									$(window).unbind('beforeunload');
                  window.close();
                  var table = $('#data-table').DataTable();
                  table.draw();
	              }, 2000)
	          }
	        });//end of ajax
	      } else {
					$("html").animate({ scrollTop: 0 }, "slow");
				}
	    });
	});
	</script>
