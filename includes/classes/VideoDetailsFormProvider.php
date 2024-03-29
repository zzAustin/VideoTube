<?php
	class VideoDetailsFormProvider{
		private $con;
		public function __construct($con) {
			$this->con = $con;
		}

		public function createUploadForm(){
			$fileInput = $this->createFileInput();
			$titleInput = $this->createTitleInput();
			$descriptionInput = $this->createDescriptionInput();
			$privacyInput = $this->createPrivacyInput();
			$categoryInput = $this->createCategoryInput();
			$uploadButton = $this->createUploadButton();
			
			return "<form action='processing.php' method='POST' enctype='multipart/form-data'>
						$fileInput
						$titleInput
						$descriptionInput
						$privacyInput
						$categoryInput
						$uploadButton
					</form>";
		}

		private function createFileInput() {

			return "<div class='form-group'>
						<label for='exampleFormControlFile1'>Your File</label>
						<input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
					</div>
				   "; // with the "id" and "for" matching, the label will actually show the name of the selected file 
		}

		private function createTitleInput() {
			return "<div class='form-group'>
						<input class='form-control' type='text' placeholder='Title' name='titleInput'>
					</div>
				   ";
		}

		private function createDescriptionInput() {
			return "<div class='form-group'>
						<textarea class='form-control' placeholder='Description' name='descriptionInput' rows='3'></textarea>
					</div>
				   "; // if we want to disable the resizability of the textarea, add resize:none to its style
		}

		private function createPrivacyInput() {
			return "<div class='form-group'>
						<select class='form-control' name='privacyInput'>
		  					<option value='0'>Private</option>
					        <option value='1'>Public</option>
                        </select>
					</div>"; // <select multiple class='form-control' name='privacyInput'> this will be a multiple select
		}

		private function createCategoryInput() {
			$query = $this->con->prepare("SELECT * FROM categories");
			$query->execute();

			$html = "<div class='form-group'>
						<select class='form-control' name='categoryInput'>
					";

			while($row = $query->fetch(PDO::FETCH_ASSOC)) {
				//echo $row["name"] . "<br>";
				$id = $row["id"]; // just use the id field for values
				$name = $row["name"];
				$html .= "<option value=$id>$name</option>";
			}

			$html .= "  </select>
					  </div>";

		    return $html;
		}

		private function createUploadButton(){
			return "<button type='submit' class='btn btn-primary' name='uploadButton'>Upload</button>";
		}
	}
?>