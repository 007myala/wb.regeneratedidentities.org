<a style="display: none !important;" id="Messgae"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message"></a>

<script>
$(document).ready(function(e){
$("#Messgae").click();
});
</script>

<!-- Success Message-->
<div class="modal fade" id="Message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="max-width: 500px !important; margin: 1.75rem auto !important;">
      <div class="modal-header">
        <h3 class="modal-title" style="color: green !important;" id="MessageModalLabel"> <i class="fas fa-check-circle"></i>&nbsp;&nbsp; Successfully Updated</h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        The changes you made were recorded successfully. The log is also updated!<br>


       </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>

      </div>
    </div>
  </div>
</div>
