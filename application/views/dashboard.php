<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
?>
<style>
#data-table td:nth-child(4), #data-table td:nth-child(5), #data-table td:nth-child(6), #data-table td:nth-child(7), #data-table td:nth-child(8), #data-table td:nth-child(9), #data-table td:nth-child(10), #data-table td:nth-child(11) {
  text-align: center;
}

#data-table td:nth-child(9){
  text-align: center;
  font-weight: 500;
  color: red;
}

.payment_application:hover{
    cursor: pointer;
}

.edit_application:hover{
    cursor: pointer;
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
					<li class="active">
						<a href="<?= base_url('main')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
						</a>
					</li>
          <?php if($info->status == ''){ ?>
					<li>
						<a href="<?= base_url('main/new_applicant')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-add-file1"></span><span class="mtext">Application</span>
						</a>
					</li>
          <?php } ?>
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


		<!-- Simple Datatable start -->
		<div class="card-box mb-30">
			<div class="pd-20">
				<h4 class="text-green h4"><i class="icon-copy dw dw-list mr-1"></i>APPLICATION LIST</h4>
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
				<table class="data-table table stripe hover nowrap" id="data-table" width="100%">
					<thead>
						<tr>
              <th></th>
							<th>Reference No</th>
							<th>Institution Name</th>
							<th>Application Date</th>
							<th>Bacteriology</th>
							<th>Parasitology</th>
							<th>TB Microscopy</th>
							<th>TB Culture</th>
							<th>TTI Serology</th>
							<th class="text-center">Total</th>
							<th class="text-center">Status</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>

			<div class="footer-wrap pd-20 mb-20 card-box text-secondary">
				&copy; Copyright 2022 <b>NATIONAL EXTERNAL QUALITY ASSESSMENT SCHEME (NEQAS).</b> All Rights Reserved.
			</div>
		</div>
	</div>

  <!-- Modal -->
  <div class="modal fade" id="payment_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">UPLOAD PROOF OF PAYMENT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
  			<form id="upload_proofPayment" method="POST" enctype="multipart/form-data">
  				<input type="hidden" name="hideReference" id="hideReference">
  				<h5>PAYMENT METHOD:</h5>
  				<div class="form-group mb-0">
  					<input type="checkbox" class="payment" id="cash_payment" name="cash_payment">
  					<label>Cash (for on-site payment only)</label>
  				</div>
  				<div class="form-group mb-0">
  					<input type="checkbox" class="payment" id="company_payment" name="company_payment">
  					<label>Company/Manager’s Check/Postal Money Order</label>
  				</div>
  				<div class="form-group mb-0">
  					<input type="checkbox" class="payment" id="landbank_payment" name="landbank_payment">
  					<label>LANDBANK Electronic Payment Portal</label>
  				</div>
  				<div class="form-group mb-0">
  					<input type="checkbox" class="payment" id="mds_payment" name="mds_payment">
  					<label>Modified Disbursement System</label>
  				</div>
  				<hr>
  				<span class="text-danger"><i>Please contact the NEQAS Office for clarifications<br>
  				DIRECT BANK DEPOSITS WILL NOT BE ACCEPTED</i></span>
  				<hr>
  				<div class="form-group" id="upload_file">
  					<label>Upload Proof of Payment <small class="text-danger"><i>(pdf file only.)</i></small></label><br>
  					<input type="file" name="landbank_file" id="file_upload" value="landbank_file" accept=".pdf">
  				</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
  			</form>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="notif" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">NEQAS - Data Privacy Consent Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align:justify;">
  				<span id="message"></span>
          <p>
  					The Research Institute for Tropical Medicine (RITM) values the privacy of individuals and the data and information within our care, custody and control.<br><br>
            We shall collect your information related to your hospital/laboratory operations for your application processing with us.<br><br>

  					Any Personal Identifiable Information (PII) that you provide will be kept confidential and protected. Your data and information will only be disclosed to members of the NEQAS team. We will anonymize, mask or de- identify any PII whenever possible or keep it in a form that does not permit identification of the data subjects when we use it for statistical purposes. As the data subject, you have the following rights: to be informed; to access; to object; to erasure and blocking; to rectify; to file a complaint; to damages; and to data portability. Your data and information will be protected and secured while stored with RITM and will be kept for 3 years from the time of your submission. After which, it will be properly disposed following established disposal procedures of RITM.<br><br>

  					Although conditions of confidentiality are observed, participant data from the RITM NEQAS may be provided to the DOH Office of Health Laboratories (OHL) and DOH Health Facility Services Regulatory Bureau (HFSRB) for monitoring, regulatory, and policy making purposes.<br><br>
  					If you have inquiries on the RITM Data Privacy policy, you may reach the RITM Data Privacy Officer (DPO) via email at <b>data.privacy@ritm.gov.ph</b>.<br><br>
  					Click on the "I agree" button to indicate that you have read and agree to the consent form. If you don't agree, please close this window.
  				</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="agree">I Agree</button>
          <a href="<?= base_url('user')?>" type="button" class="btn btn-secondary" >Disagree</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="upload_lto_file" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">UPLOAD LTO FILE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="lto_upload" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="ref" id="ref">
            <div class="form-group" id="upload_lto">
              <label>Upload LTO <i><span class="text-danger">pdf and jpeg only max size: 5mb</span></i></label>
              <input type="file" class="form-control-file form-control height-auto input-details" name="lto_file" accept="image/jpeg,image/jpg,application/pdf" id="lto_file" onchange="Filevalidation()" required>
              <p id="size"></p>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="upload">Upload</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="announcement" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">NEQAS - ANNOUNCEMENT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align:justify;">
          <div class="text-center text-danger"><b>The 2022 RITM NEQAS registration is officially closed.</b></div>
          <hr>
            <b>Please take note of the following:</b>
            <ul>
              <li><i class="icon-copy dw dw-right-arrow1 mr-2 text-danger"></i>Due to system changes, the registration approval may take longer than usual, thus we shall consider those participants that have registered until the deadline.</li>
              <hr>
              <li><i class="icon-copy dw dw-right-arrow1 mr-2 text-danger"></i>Certificates shall be put on hold for those participants who are unable to settle their fees before the end of the 2022 NEQAS cycle.</li>
            </ul>
            <hr>
            <div class="text-center">
              For more information, please visit our site: <a href="https://ritm.gov.ph/reference-laboratories/quality-assurance/" target="_blank" class="text-primary">https://ritm.gov.ph/reference-laboratories/quality-assurance/</a> or send us an email at neqas@ritm.gov.ph
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">OK</button>
        </div>
      </div>
    </div>
  </div>


  <?php if ($info->status == 'Closed'): ?>
    <script>
      $('#announcement').modal('show');
    </script>
  <?php endif; ?>

  <?php if ($_SESSION['loggedIn']['privacy'] == ''): ?>
    <script>
      $('#notif').modal('show');
    </script>
  <?php elseif ($_SESSION['loggedIn']['privacy'] == 'Agree'): ?>
    <script>
      $('#notif').modal('hide');
    </script>
  <?php endif; ?>

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
                  alert("File too Big, please select a file less than 5mb");
                  document.getElementById('lto_file').value = '';
              } else {
                  document.getElementById('size').innerHTML = '<b>'
                  + file + '</b> KB';
              }
          }
      }
  }

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

  $(document).on('click', '.edit_application', function(){
    var reference_no = $(this).attr('id');
    console.log(reference_no);
    window.open("<?= base_url('main/edit_application/');?>"+ reference_no, 'targetWindow','resizable=yes,width=1800,height=1000,status=0,titlebar=0,menubar=0,toolbar=0,location=0');
  });

  $(document).on('click', '.upload_file', function(){
    var id = $(this).attr('id');
    var ref = $(this).data('id');
    $('#id').val(id);
    $('#ref').val(ref);
    $('#upload_lto_file').modal('show');
  });

  $(document).on('submit', '.lto_upload', function(e){
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
	          url:"<?= base_url() . 'save_data/upload_lto_file'?>",
	          method:"POST",
	          data:new FormData(this),
	          contentType:false,
	          processData:false,
	          beforeSend:function()
	          {
	            $('#upload').attr('disabled','disabled');
	          },
	          success:function(data)
	          {
	            swal({
	                title: "Thank you!",
	                text: "LTO file successfully added!",
	                icon: "success",
	                buttons: "Ok",
	              });
	              $('.lto_upload')[0].reset();
                $('#upload_lto_file').modal('hide');
                var table = $('#data-table').DataTable();
                table.draw();
	          }
	        });//end of ajax
	      } else {
					$("html").animate({ scrollTop: 0 }, "slow");
				}
	    });
	});
  </script>
