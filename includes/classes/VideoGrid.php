<?php
class VideoGrid {
	private $con, $userLoggedIn;
	private $largeMode = false;
	private $gridClass = "videoGrid";
	public function __construct($con, $userLoggedInObj) {
		$this->con = $con;
		$this->userLoggedInObj = $userLoggedInObj;
	}

	public function create($videos, $title, $showFilter) {

		if($videos == null) {
			$girdItems = $this->generateItems();
		}
		else {
			$girdItems = $this->generateItemsFromVideos();
		}

		$header = "";

		if($title != null) {
			$header = $this->createGridHeader($title, $showFilter);
		}

		return "$header
				<div class='$this->gridClass'>
					$girdItems
			    </div>";
	}

	public function generateItems() {
		$query = $this->con->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 15");
		$query->execute();

		$elementsHtml = "";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$video = new Video($this->con, $row, $this->userLoggedInObj);
			$item = new VideoGridItem($video, $this->largeMode);
			$elementsHtml .= $item->create();
		}

		return $elementsHtml;
	}

	public function generateItemsFromVideos() {
		
	}

	public function createGridHeader($title, $showFilter) {
		return "";
	}
}
?>