<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="modal fade" id="modal_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?= base_url() . 'src/img/mail-download.gif'?>" alt="">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="changePass" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('user/changePassword')?>" method="post">
          <div class="input-group custom">
            <input type="password" class="form-control form-control-lg" placeholder="**********" name="change_pass" required>
            <div class="input-group-append custom">
              <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- js -->
<script src="<?=base_url()?>vendors/scripts/core.js"></script>
<script src="<?=base_url()?>vendors/scripts/script.min.js"></script>
<script src="<?=base_url()?>vendors/scripts/process.js"></script>
<script src="<?=base_url()?>vendors/scripts/layout-settings.js"></script>
<script src="<?=base_url()?>src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript">
// var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
//     csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>'
  $(document).ready(function(){
    window.setInterval(function(){
      var table = $('#data-table').DataTable();
      table.draw();
    },60000);
  });
</script>

<script>
    function checkPasswordMatch() {
        var password = $("#password").val();
        var confirmPassword = $("#confirm_pass").val();
        if (password != confirmPassword)
        {
          $("#error-message").text("Passwords does not match!");
          $("#register_acct").attr("disabled", true);
        }else{
          $("#error-message").text("Passwords match.");
          $("#register_acct").attr("disabled", false);
        }
    }
    $(document).ready(function () {
      var password = $("#password").val();
       $("#confirm_pass").keyup(checkPasswordMatch);
    });
    $(document).on('keyup', '#password', function(){
      if ($(this).val() == '') {
        $("#error-message").text("");
      }
    });
</script>

<script>
// document.addEventListener('contextmenu', function(e){
// // alert("Sorry, right click is disabled to prevent leakage of confidential functions! Thank you.");
// swal({
//   title: "Sorry!",
//   text: "Right click is disabled to prevent leakage of confidential functions. Thank you!",
//   icon: "error",
//   buttons: "Ok",
// });
// e.preventDefault();
// });

$(document).ready(function(){
     // Initialize
     $( "#institution_name" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?=base_url()?>User/labList",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#institution_name').val(ui.item.label); // display the selected text
          var id = $('#labID').val(ui.item.labID); // save selected id to input
          $('#no_street').val(ui.item.street);
          $('#postal').val(ui.item.postal_code);
          $('#contact_no').val(ui.item.contact_no);
          $('#email_add').val(ui.item.email);
          if (id == '') {
            $('#upload_lto').show(300);
            $('#year_participated').removeClass('input-details');
            $('#hospital').text('- NEW PARTICIPANT');
            $('#ship').text('- NEW PARTICIPANT');
            $('#prog').text('- NEW PARTICIPANT');
            $('#pay').text('- NEW PARTICIPANT');
            $('#att').text('- NEW PARTICIPANT');
            $('#logic').val('NEW PARTICIPANT');
            $('#province_code').val('');
          }else{
            $('#province_code option[value="' + ui.item.province_code + '"]').attr("selected", "selected");

            // var prov = $('#province_code').find('option:selected').text();
            // $('#province').val(prov);
            var code = ui.item.province_code;
        	  $.post("/neqas/main/get_provice/",{code:code},function(data){
        	    $('#province_code').html(data);
              $('#province_code option[value="' + ui.item.province_code + '"]').attr("selected", "selected");
              var prov = $('#province_code').find('option:selected').text();
              $('#province').val(prov);
              $('#province_code1').val(ui.item.province_code);
        	  },"JSON");

        	  var code = ui.item.province_code;
        	  $.post("/neqas/main/get_municipal/",{code:code},function(data){
        	    $('#municipal_code').html(data);
              $('#municipal_code option[value="' + ui.item.mun_code + '"]').attr("selected", "selected");
              var mun = $('#municipal_code').find('option:selected').text();
              $('#municipality').val(mun);
              $('#municipality_code').val(ui.item.mun_code);
        	  },"JSON");

            var code = ui.item.mun_code;
        	  $.post("/neqas/main/get_barangay/",{code:code},function(data){
        	    $('#barangay_code').html(data);
              $('#barangay_code option[value="' + ui.item.brgy_code + '"]').attr("selected", "selected");
              var brgy = $('#barangay_code').find('option:selected').text();
              $('#brgy').val(brgy);
              $('#brgy_code').val(ui.item.brgy_code);
        	  },"JSON");

            $('#upload_lto').hide(300);
            $('#last_participated').show(300);
            $('#year_participated').addClass('input-details');
            $('#hospital').text('- OLD PARTICIPANT');
            $('#ship').text('- OLD PARTICIPANT');
            $('#prog').text('- OLD PARTICIPANT');
            $('#pay').text('- OLD PARTICIPANT');
            $('#att').text('- OLD PARTICIPANT');
            $('#logic').val('OLD PARTICIPANT');
            $('#lto_file').removeClass('input-details');

            $('#province_code').attr('disabled', true);
            $('#municipal_code').attr('disabled', true);
            $('#barangay_code').attr('disabled', true);
            $('#no_street').attr('readonly', true);
            $('#postal').attr('readonly', true);
          }
          return false;

        }
      });
    });

$(document).on('keyup', '#institution_name', function(){
  if ($(this).val() == '') {
    $(window).unbind('beforeunload');
    location.reload();
    $('#labID').val('');
    $('#upload_lto').show(300);
    $('#last_participated').hide();
    $('#hospital').text('- NEW PARTICIPANT');
    $('#ship').text('- NEW PARTICIPANT');
    $('#prog').text('- NEW PARTICIPANT');
    $('#pay').text('- NEW PARTICIPANT');
    $('#att').text('- NEW PARTICIPANT');
    $('#logic').val('NEW PARTICIPANT');
    $('#province_code').val('');
    $('#municipal_code').val('');
    $('#barangay_code').val('');
    $('#no_street').val('');
    $('#postal').val('');
    $('#contact_no').val('');
    $('#email_add').val('');
    $('#lto_file').addClass('input-details');
    $('#year_participated').removeClass('input-details');
    $('#province').val('');
    $('#municipality').val('');
    $('#brgy').val('');

    $('#province_code').attr('disabled', false);
    $('#municipal_code').attr('disabled', false);
    $('#barangay_code').attr('disabled', false);
    $('#no_street').attr('readonly', false);
    $('#postal').attr('readonly', false);
  }
});

$(document).ready(function(){
  var table1 = $('#data-table').DataTable({
    destroy: true,
    // scrollCollapse: true,
    // autoWidth: false,
    // responsive: true,
    scrollX: true,
    ordering: false,
    serverSide:true,
    processing:true,
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
      "type": "POST",
      "data": function (data) {
          data.institution_name = $('#institution_name').val();
      }
    },
  });
  $('#institution_name').on('change', function(){
    table1.draw();
  });

  var table = $('#table-list').DataTable({
    destroy: true,
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    ordering: false,
    serverSide:true,
    processing:true,
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

$(document).on('submit', '#add_account', function(e){
  e.preventDefault();
  var password = $("#password").val();
  var confirmPassword = $("#confirm_pass").val();

  if (password != confirmPassword) {
    swal("Error", "Passwords does not match!", "error");
  }else{
    $.ajax({
      url:"<?= base_url() . 'user/register_account'?>",
      method:"POST",
      data:new FormData(this),
      dataType:'json',
      contentType:false,
      processData:false,
      beforeSend:function()
      {
        $('#register_acct').text('Please wait...');
        $('#register_acct').attr('disabled', 'disabled');
        // $('#modal_email').modal('show');
      },
      success:function(data)
      {
        if (data.error != '') {
          $('#error-message').html(data.error);
          $('#register_acct').text('Submit');
          $('#register_acct').attr('disabled', false);
          setTimeout(function(){
            data.error = '';
            $('#error-message').html('');
          },1000);
        }else{
          swal({
            title: "Thank you!",
            text: "Save Successfully! Please check your email for the verification link.",
            icon: "success",
            buttons: "Ok",
          });
          $('#modal_email').modal('hide');
          setTimeout(function(){
            window.location.href = "<?= base_url('user')?>";
          },3000);
          $('#add_account')[0].reset();
          $('#register_acct').text('SUBMIT');
          $('#register_acct').attr('disabled', false);
        }
      }
    });
  }
});

$(document).on('submit', '.login_account', function(e){
  e.preventDefault();
  $.ajax({
    url: "<?= base_url() . 'user/login_account'?>",
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
          window.location.href = "<?= base_url('main')?>";
        },3000);
      }
    }
  });
});

$(document).on('click', '.payment_application', function(){
  var reference = $(this).attr('id');
  // console.log(reference);
  $.ajax({
     url:"<?= base_url() . 'save_data/get_payment_details'?>",
     method:"POST",
     data:{reference:reference},
     dataType:"json",
     success:function(data)
     {
       $('#payment_modal').modal('show');

       $('#hideReference').val(reference);
       if(data.cash_payment == '1')
       {
         $('#cash_payment').prop('checked','checked');
         $('#company_payment').prop('disabled','disabled');
         $('#landbank_payment').prop('disabled','disabled');
         $('#mds_payment').prop('disabled','disabled');
         $('#upload_file').hide();
         $("#file_upload").attr("required", false);
       }else{
         $('#cash_payment').prop('checked', false);
       }

       if(data.company_payment == '1')
       {
         $('#company_payment').prop('checked','checked');
         $('#cash_payment').prop('disabled','disabled');
         $('#landbank_payment').prop('disabled','disabled');
         $('#mds_payment').prop('disabled','disabled');
         $('#upload_file').hide();
         $("#file_upload").attr("required", false);
       }else{
         $('#company_payment').prop('checked', false);
       }

       if(data.landbank_payment == '1')
       {
         $('#landbank_payment').prop('checked','checked');
         $('#cash_payment').prop('disabled','disabled');
         $('#company_payment').prop('disabled','disabled');
         $('#mds_payment').prop('disabled','disabled');
         $('#upload_file').show();
         $("#file_upload").attr("required", true);
       }else{
         $('#landbank_payment').prop('checked', false);
       }

       if(data.mds_payment == '1')
       {
         $('#mds_payment').prop('checked','checked');
         $('#cash_payment').prop('disabled','disabled');
         $('#company_payment').prop('disabled','disabled');
         $('#landbank_payment').prop('disabled','disabled');
         $('#upload_file').hide();
         $("#file_upload").attr("required", false);
       }else{
         $('#mds_payment').prop('checked', false);
       }

     }
  });
});

$(document).on('submit', '#upload_proofPayment', function(event){
  event.preventDefault();
  $.ajax({
    url:"<?= base_url() . 'save_data/upload_proof_payment'?>",
    method:"POST",
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      swal({
          title: "Thank you!",
          text: "Successfully Updated!",
          icon: "success",
          buttons: "Ok",
      });
      $('#payment_modal').modal('hide');
      $("#upload_proofPayment").trigger('reset');
      var table = $('#data-table').DataTable();
      table.ajax.reload();
    }
  });
});

$(document).on('submit', '#forgotPass', function(e){
  e.preventDefault();
  $.ajax({
    url: "<?= base_url() . 'user/forgotPass'?>",
    data: new FormData(this),
    method: "POST",
    dataType: "json",
    contentType:false,
    processData:false,
    beforeSend:function()
    {
      // $('#modal_email').modal('show');
      $('#reset').text('Please wait...');
      $('#reset').attr('disabled', 'disabled');
    },
    success:function(data)
    {
      if (data.error != '') {
        $('#message').html(data.error);
        setTimeout(function(){
          $('#message').html('');
          $('#reset').text('Submit');
          $('#reset').attr('disabled', false);
        },2000);
        $('#modal_email').modal('hide');
      }else{
        $('#message').html(data.success);
        $('#reset').text('Submit');
        $('#reset').attr('disabled', false);
        // $('#modal_email').modal('hide');
        setTimeout(function(){
        $('#message').html('');
          window.location.href = "<?= base_url('user')?>";
        },3000);
      }
    }
  });
});

$(document).on('click', '#agree', function(){
  var privacy = 'Agree';
  $.ajax({
    url: "<?= base_url() . 'save_data/privacy_consent'?>",
    data: {privacy:privacy},
    method: "POST",
    dataType:"json",
    success:function(data)
    {
      $('#notif').modal('hide');
    }
  });
});

</script>
