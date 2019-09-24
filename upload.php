<?php 
require_once("includes/header.php");
require_once("includes/classes/VideoDetailsFormProvider.php");
?>

<div class="column">

<?php
	$formProvider = new VideoDetailsFormProvider($con); // $con is defined in config.php
	echo $formProvider->createUploadForm();
?>

</div>

<script>

// code to show the loading spinner
// submit will be fired when this form is submitted
$("form").submit(function(){
	$("#loadingModal").modal("show"); // austin's note: this modal is actually a bootstrap function, also be aware we have html toggle options like: <button type="button"               data-toggle="modal" data-target="#myModal">Launch modal</button>
});

</script>
<!-- Based on Bootstrap Modal --> <!--austin's notes, modal html seems to have its own topic that is not covered yet-->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <!--<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>-->
      <div class="modal-body">
        Please wait, this might take a while.
        <img src="assets/images/icons/loading-spinner.gif" />
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>

<?php require_once("includes/footer.php"); ?>