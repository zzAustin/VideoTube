<?php
class Account{

	private $con;
	private $errorArray = array();

	public function __construct($con){
		$this->con = $con;
	}

	public function register($fn, $ln, $un, $em, $em2, $pwd, $pwd2){
		$this->validateFirstName($fn);
	}

	private function validateFirstName($fn){
		if(strlen($fn) > 25 || strlen($fn) < 2){
			array_push($this->errorArray, Constants::$firstNameCharacters);
		}
	}

	public function getError($error){
		if(in_array($error, $this->errorArray)){
			return "<span class='errorMessage'>$error</span>";
		}
	}

}
?>