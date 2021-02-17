<div class="modal fade" tabindex="-1" role="dialog" id="jsConfirm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure to submit the form</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="jsConfirmSubmit">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var recordID = '';
   $(document).ready( function() { // Wait until document is fully parsed
    $(".jsConfirmButton").on('click touchstart', function(event) {
      event.preventDefault();
      recordID = $(this).data('value');
      console.log('called me '+ recordID);
      $('#jsConfirm').modal('show');
    });
    $("#jsConfirmSubmit").on('click touchstart', function(event) {
      event.preventDefault();
      $('#jsConfirm').modal('hide');
      $('#jsSubmitForm-'+recordID).submit();
    });
   })
</script>