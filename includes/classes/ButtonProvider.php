<?php
class ButtonProvider {

	public static $signInFunction = "notSignedIn()";
	public static function createLink($link) {
		return User::isLoggedIn() ? $link : ButtonProvider::$signInFunction;
	}

	public static function createButton($text, $imgSrc, $action, $class) {
		$img = ($imgSrc == null) ? "" : "<img src='$imgSrc'>";

		$action = ButtonProvider::createLink($action); // override the action with notSignedIn() if user is not logged in

		return "<button class='$class' onclick='$action'>
					$img
					<span class='text'>$text</span>
				</button>";

	}

	public static function createUserProfileButton($con, $username) {
		$userObj = new User($con, $username);
		$profilePic = $userObj->getProfilePic();
		$link = "profile.php?username=$username";

		return "<a href='$link'>
					<img src='$profilePic' class='profilePicture'>
				</a>";
	}

	public static function createEditVideoButton($videoId) {
		$href = "editVideo.php?videoId=$videoId";
		$button = ButtonProvider::createHyperLinkButton("Edit Video", null, $href, "edit button");

		return "<div class='editVideoButtonContainer'>
					$button 
				</div>";

	}

	public static function createHyperLinkButton($text, $imgSrc, $href, $class) {
		$img = ($imgSrc == null) ? "" : "<img src='$imgSrc'>";

		$action = ButtonProvider::createLink($href); // override the href with notSignedIn() if user is not logged in

		return "<a href='$href'>
					<button class='$class'>
						$img
						<span class='text'>$text</span>
					</button>
				</a>";

	}

	public static function createSubscriberButton($con, $userToObj, $userLoggedInObj) {
		$userTo = $userToObj->getUsername();
		$userLoggedIn = $userLoggedInObj->getUsername();

		$isSubscribedTo = $userLoggedInObj->isSubscribedTo($userTo);
		$buttonText = $isSubscribedTo ? "SUBSCRIBED" : "SUBSCRIBE";
		$buttonText .= " " . $userToObj->getSubscriberCount();

		$buttonClass = $isSubscribedTo ? "unsubscribe button" : "subscribe button";
		$action = "subscribe(\"$userTo\",\"$userLoggedIn\", this)";

		$button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

		return "<div class='subscribeButtonContainer'>
					$button
				</div>";

	}
}
?>