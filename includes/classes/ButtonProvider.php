<?php
class ButtonProvider {

	public static function createButton($text, $imgSrc, $action, $class){
		$img = ($imgSrc == null) ? "" : "<img src='$imgSrc'>";

		return "<button class='$class' onclick='$action'>
					$img
					<span class='text'>$text</span>
				</button>";

	}
}
?>