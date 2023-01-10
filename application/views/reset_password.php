<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
  $email = $_GET['email'];
  $code = $_GET['hash'];
?>

<body>
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="logo">
				<a href="<?= base_url('user')?>">
					<img src="<?= base_url()?>src/img/RITM-NEQAS-BannerV3.png" alt="" style=" width:50rem;">
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
					<img src="<?= base_url()?>vendors/images/Laboratory-amico.png" alt="">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-success">Reset Password</h2>
						</div>
						<h6 class="mb-20">Enter your new password, confirm and submit</h6>
						<form id="resetPassword" method="POST">
              <div class="text-center mb-1"><span id="message"></span></div>
              <input type="hidden" name="email" value="<?= $email;?>">
              <input type="hidden" name="code" value="<?= $code;?>">
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="New Password" name="new_pass" id="new_pass" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="Confirm New Password" name="confirm_password" id="confirm_password" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
              <div class="form-group mb-3">
                <div id="error-message"></div>
              </div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
										-->
										<button class="btn btn-success btn-block" id="reset_btn">Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

  <script>
      function checkPasswordMatch() {
          var password = $("#new_pass").val();
          var confirmPassword = $("#confirm_password").val();
          if (password != confirmPassword){
						$("#error-message").text("Passwords does not match!");
						$("#reset_btn").attr("disabled", true);
					}else{
						$("#error-message").text("Passwords match.");
						$("#reset_btn").attr("disabled", false);
					}
      }
      $(document).ready(function () {
        var password = $("#new_pass").val();
         $("#confirm_password").keyup(checkPasswordMatch);
      });
      $(document).on('keyup', '#new_pass', function(){
        if ($(this).val() == '') {
          $("#error-message").text("");
        }
      });

      $(document).on('submit', '#resetPassword', function(e){
        e.preventDefault();
        $.ajax({
          url: "<?= base_url() . 'user/resetPassword'?>",
          data: new FormData(this),
          method: "POST",
          dataType: "json",
          contentType:false,
          processData:false,
          success:function(data)
          {
            if (data.error != '') {
              $('#message').html(data.error);
              setTimeout(function(){
                $('#message').html('');
              },3000);
            }else{
              $('#message').html(data.success);
              setTimeout(function(){
              $('#message').html('');
                window.location.href = "<?= base_url('user')?>";
              },3000);
            }
          }
        });
      })
  </script>

</body>
</html>
