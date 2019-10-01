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
}
?>