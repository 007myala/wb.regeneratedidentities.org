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
        <h3 class="modal-title" style="color: red !important;" id="MessageModalLabel"> <i class="fas fa-exclamation-circle"></i></i>&nbsp;&nbsp; Error</h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        What would you like to do? <br><br>
        1. Remove Event: The event connection to this person will be remove. The event will still be exist in the database and all connections with other individuals in the database will be not be changes.
        2. Delete Event: Delete the event from the database. The connection between all individuals for this event will be removed and the event will be deleted from the database.
        <br>




       </div>
      <div class="modal-footer">
        <a href="chat.php"><button class="btn btn-success" type="button">Group Chat</button></a>
        <a href="chat.php"><button class="btn btn-success" type="button">Group Chat</button></a>
        <button class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>

      </div>
    </div>
  </div>
</div>
