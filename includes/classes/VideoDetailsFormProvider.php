<?php
	class VideoDetailsFormProvider{
		public function createUploadForm(){
			$fileInput = $this->createFileInput();
			$titleInput = $this->createTitleInput();
			$descriptionInput = $this->createDescriptionInput();
			$privacyInput = $this->createPrivacyInput();
			return "<form action='processing.php' method='POST'>
						$fileInput
						$titleInput
						$descriptionInput
						$privacyInput
					</form>";
		}

		private function createFileInput() {

			return "
					<div class='form-group'>
						<label for='exampleFormControlFile1'>Your File</label>
						<input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
					</div>
				   "; // with the "id" and "for" matching, the label will actually show the name of the selected file 
		}

		private function createTitleInput() {
			return "
					<div class='form-group'>
						<input class='form-control' type='text' placeholder='Title' name='titleInput'>
					</div>
				   ";
		}

		private function createDescriptionInput() {
			return "
					<div class='form-group'>
						<textarea class='form-control' placeholder='Description' name='descriptionInput' rows='3'></textarea>
					</div>
				   "; // if we want to disable the resizability of the textarea, add resize:none to its style
		}

		private function createPrivacyInput() {
			return "
					<div class='form-group'>
						<select class='form-control' name='privacyInput'>
		  					<option value='0'>Private</option>
					        <option value='1'>Public</option>
                        </select>
					</div>"; // <select multiple class='form-control' name='privacyInput'> this will be a multiple select
		}
	}
?>