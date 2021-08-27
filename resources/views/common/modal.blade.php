<div class="modal" tabindex="-1" role="dialog" id='editAnswerModal'>
  <div class="modal-dialog" role="document">
    @include('msmt.common.loader')
    <form action="{{ $submitURL }}" method="POST" id="jsEditAnswerForm" onsubmit="return false">
      @csrf {{ method_field('post') }}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="jsModalTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="jsUserMessage"></p>
          <p>Story answer: <span id="jsStoryAnswer"></span></p>
          <p><input type="text" class="form-control py-4" name="answer" id="jsUserAnswer" placeholder="User Answer" value=""></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="jsSaveAnswer">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  var recordID = '';
   $(document).ready( function() { // Wait until document is fully parsed
    $("#jsSaveAnswer").on('click touchstart', function(event) {
      $(this).prop("disabled", true);
      $("#jsQueContainer").slideDown();
      $("#jsLoader").removeClass('d-none');
      $("#jsNext").text("CHECK");
      $('#jsUserMessage').text('');
      $('#jsUserMessage').removeClass().addClass('alert d-none');
      requestInProcess = true;
      var form = $('#jsEditAnswerForm');
      var formData = form.serialize();
      console.log('submit', formData);
      //return;
      $.ajax({
        type: "POST",
        url: form.attr("action"),
        data: formData,
        success: function(response) {
          console.log('Response', response);
          if (response.reload) {
            window.location.reload();
          } else {
            $('#jsUserMessage').addClass('alert-danger');
            $('#jsUserMessage').html(response.message);
            $('#jsUserMessage').removeClass('d-none');
          }
          $("#jsSaveAnswer").prop("disabled", false);
          $("#jsLoader").addClass('d-none');
          requestInProcess = false;
        },
        error: function(xhr, textStatus, errorThrown) {
          console.log('Error came in');
          $('#jsUserMessage').addClass('alert-danger');
          $('#jsUserMessage').html(response.message);
          $('#jsUserMessage').removeClass('Some server error! Please come after sometimes!');
          $("#jsSaveAnswer").prop("disabled", false);
          $("#jsLoader").addClass('d-none');
        },
        dataType: 'json'
      });
    });
   })
</script>