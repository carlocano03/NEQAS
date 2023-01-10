<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
$(document).ready(function(){
  var table1 = $('#data-table-admin').DataTable({
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
      "url": "<?= base_url('NeqasAdmin/load_application')?>",
      "type": "POST",
    },
  });
});

$(document).on('click', '.manual_upload_lto', function(){
  var ref_no = $(this).attr('id');
  $('#ref').val(ref_no);
  $('#manual_upload_lto_file').modal('show');
});

$(document).on('submit', '.manual_lto_upload', function(e){
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
          url:"<?= base_url() . 'NeqasAdmin/upload_lto_file'?>",
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
              $('.manual_lto_upload')[0].reset();
              $('#manual_upload_lto_file').modal('hide');
              var table = $('#data-table-admin').DataTable();
              table.draw();
          }
        });//end of ajax
      } else {
        $("html").animate({ scrollTop: 0 }, "slow");
      }
    });
});

</script>
