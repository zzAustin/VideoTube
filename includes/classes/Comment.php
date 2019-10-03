<?php
require_once("ButtonProvider.php");
class Comment {

	private $con, $sqlData, $userLoggedInObj, $videoId;

	public function __construct($con, $input, $userLoggedInObj, $videoId) {
		if(!is_array($input)) {
			$query = $con->prepare("SELECT * FROM comments WHERE id=:id");
			$query->bindParam(":id", $input);
			$id = $videoId;
			$query->execute();

			$input = $query->fetch(PDO::FETCH_ASSOC);
		}

		$this->sqlData = $input;
		$this->con = $con;
		$this->userLoggedInObj = $userLoggedInObj;
		$this->videoId = $videoId;
	}

	public function create() {
		$body = $this->sqlData["body"];
		$postedBy = $this->sqlData["postedBy"];
		$profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);
		$timespan = ""; //TODO: get timespan

		return "<div class='itemContainer'>
					<div class='comment'>
						$profileButton
						<div class='mainContainer'>
							<div class='commentHeader'>
								<a href='profile.php?username=$postedBy'>
									<span class='username'>$postedBy</span>
								</a>
								<span class='timestamp'>$timespan</span>
							</div>

							<div class='body'>
								$body
							</div>
						</div>
					</div>
				</div>";
	}
}
?>