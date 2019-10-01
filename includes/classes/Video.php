<?php
class Video{
	private $con, $sqlData, $userLoggedInObj;
	public function __construct($con, $input, $userLoggedInObj) {
		$this->con = $con;
		$this->userLoggedInObj = $userLoggedInObj;

		// $input can be the video id or the video sql data
		if(is_array($input)){
			$this->sqlData = $input;
		}
		else{
			$query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
			$query->bindParam(":id", $input);
			$query->execute();
			$this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
		}
	}

	public function getId() {
		return $this->sqlData["id"];
	}

	public function getUploadedBy() {
		return $this->sqlData["uploadedBy"];
	}

	public function getTitle() {
		return $this->sqlData["title"];
	}

	public function getDescription() {
		return $this->sqlData["description"];
	}

	public function getPrivacy() {
		return $this->sqlData["privacy"];
	}

	public function getFilePath() {
		return $this->sqlData["filePath"];
	}

	public function getCategory() {
		return $this->sqlData["category"];
	}

	public function getUploadDate() {
		return $this->sqlData["uploadDate"];
	}

	public function getViews() {
		return $this->sqlData["views"];
	}

	public function getDuration() {
		return $this->sqlData["duration"];
	}

	public function getLikes() {
		$query = $this->con->prepare("SELECT count(*) as 'count' FROM likes WHERE videoId = :videoId");
		$query->bindParam(":videoId", $videoId);
		$videoId = $this->getId();
		$query->execute();

		$data = $query->fetch(PDO::FETCH_ASSOC);
		return $data["count"];
	}

	public function getDislikes() {
		$query = $this->con->prepare("SELECT count(*) AS 'count' FROM dislikes WHERE videoId = :videoId");
		$query->bindParam(":videoId", $videoId);
		$videoId = $this->getId();
		$query->execute();

		$data = $query->fetch(PDO::FETCH_ASSOC);
		return $data["count"];
	}

	public function incrementViews() {
		$query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
		$query->bindParam(":id", $videoId);
		$videoId = $this->getId();

		$query->execute();

		$this->sqlData["views"] += 1;
	}

	public function like() {
		$id = $this->getId();
		$username = $_SESSION["userLoggedIn"];

		if($this->wasLikedBy()) {
			// user has already liked
			$query = $this->con->prepare("DELETE FROM likes WHERE username=:username AND videoId=:videoId");
			$query->bindParam(":username", $username);
			$query->bindParam(":videoId", $id);
			$query->execute();

			// return data count change to the called(mostly ajax caller js)
			$result = array(
				"likes" => -1,
				"dislikes" => 0
			);

			return json_encode($result);
		}
		else {
			// user has not liked
			$query = $this->con->prepare("DELETE FROM dislikes WHERE username=:username AND videoId=:videoId");
			$query->bindParam(":username", $username);
			$query->bindParam(":videoId", $id);
			$query->execute();
			$count = $query->rowCount(); // how many rows are deleted

			$query = $this->con->prepare("INSERT INTO likes(username, videoId) VALUES(:username, :videoId)");
			$query->bindParam(":username", $username);
			$query->bindParam(":videoId", $id);
			$query->execute();

						// return data count change to the called(mostly ajax caller js)
			$result = array(
				"likes" => 1,
				"dislikes" => 0 - $count
			);

			return json_encode($result);
		}
	}

	public function dislike() {
		$id = $this->getId();
		$username = $_SESSION["userLoggedIn"];

		if($this->wasDislikedBy()) {
			// user has already dsiliked
			$query = $this->con->prepare("DELETE FROM dislikes WHERE username=:username AND videoId=:videoId");
			$query->bindParam(":username", $username);
			$query->bindParam(":videoId", $id);
			$query->execute();

			// return data count change to the called(mostly ajax caller js)
			$result = array(
				"likes" => 0,
				"dislikes" => -1
			);

			return json_encode($result);
		}
		else {
			// user has not disliked
			$query = $this->con->prepare("DELETE FROM likes WHERE username=:username AND videoId=:videoId");
			$query->bindParam(":username", $username);
			$query->bindParam(":videoId", $id);
			$query->execute();
			$count = $query->rowCount(); // how many rows are deleted

			$query = $this->con->prepare("INSERT INTO dislikes(username, videoId) VALUES(:username, :videoId)");
			$query->bindParam(":username", $username);
			$query->bindParam(":videoId", $id);
			$query->execute();

			// return data count change to the called(mostly ajax caller js)
			$result = array(
				"likes" => 0 - $count,
				"dislikes" => 1
			);

			return json_encode($result);
		}
	}

	public function wasLikedBy() {
		$id = $this->getId();
		$username = $_SESSION["userLoggedIn"];

		$query = $this->con->prepare("SELECT * FROM likes WHERE username=:username AND videoId=:videoId");
		$query->bindParam(":username", $username);
		$query->bindParam(":videoId", $id);
		$query->execute();

		return $query->rowCount() > 0;
	}

	public function wasDislikedBy() {
		$id = $this->getId();
		$username = $_SESSION["userLoggedIn"];

		$query = $this->con->prepare("SELECT * FROM dislikes WHERE username=:username AND videoId=:videoId");
		$query->bindParam(":username", $username);
		$query->bindParam(":videoId", $id);
		$query->execute();

		return $query->rowCount() > 0;
	}
}
?>