<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
#data-table-admin td:nth-child(5){
  text-align: center;
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
	</div>

	<div class="left-side-bar" style="background:#00523c">
		<div class="brand-logo">
			<a href="<?= base_url('NeqasAdmin')?>">
        NEQAS-ADMIN
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="active">
						<a href="<?= base_url('NeqasAdmin')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
						</a>
					</li>
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

		<!-- Simple Datatable start -->
		<div class="card-box mb-30">
			<div class="pd-20">
				<h4 class="text-green h4"><i class="icon-copy dw dw-list mr-1"></i>APPLICATION LIST</h4>
			</div>

			<div class="pb-20">
				<table class="data-table table stripe hover nowrap" id="data-table-admin" width="100%">
					<thead>
						<tr>
              <!-- <th class="text-center">Action</th> -->
              <th>LTO Status</th>
							<th>Reference No</th>
							<th>Institution Name</th>
							<th>Application Date</th>
							<th class="text-center">Status</th>
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


  <div class="modal fade" tabindex="-1" role="dialog" id="manual_upload_lto_file" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">UPLOAD LTO FILE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="manual_lto_upload" enctype="multipart/form-data" method="post">
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
  </script>
