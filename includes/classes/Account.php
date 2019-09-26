<?php
class Account{

	private $con;
	private $errorArray = array();

	public function __construct($con){
		$this->con = $con;
	}

	public function register($fn, $ln, $un, $em, $em2, $pwd, $pwd2){
		$this->validateFirstName($fn);
		$this->validateLastName($ln);
		$this->validateUsername($ln);
		$this->validateEmails($em, $em2);
		$this->validatePasswords($pwd, $pwd2);

		if(empty($this->errorArray)){
			$this->insertUserDetails($fn, $ln, $un, $em, $pwd);
		}
		else{
			return false;
		}
	}

	public function insertUserDetails($fn, $ln, $un, $em, $pwd){
		return true;
	}

	private function validateFirstName($fn){
		if(strlen($fn) > 25 || strlen($fn) < 2){
			array_push($this->errorArray, Constants::$firstNameCharacters);
		}
	}

	private function validateLastName($ln){
		if(strlen($ln) > 25 || strlen($ln) < 2){
			array_push($this->errorArray, Constants::$lastNameCharacters);
		}
	}

	private function validateUsername($un){
		if(strlen($un) > 25 || strlen($un) < 5){
			array_push($this->errorArray, Constants::$usernameCharacters);
			return;
		}

		$query = $this->con->prepare("SELECT username FROM users WHERE username=:un");
		$query->bindParam(":un", $un);
		$query->execute();
		if($query->rowCount() != 0){
			array_push($this->errorArray, Constants::$usernameTaken);
		}
	}

	private function validateEmails($em, $em2){
		if($em != $em2){
			array_push($this->errorArray, Constants::$emailsDoNotMatch);
		}

		if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
			array_push($this->errorArray, Constants::$emailInvalid);
		}

		$query = $this->con->prepare("SELECT email FROM users WHERE email=:em");
		$query->bindParam(":em", $em);
		$query->execute();
		if($query->rowCount() != 0){
			array_push($this->errorArray, Constants::$emailTaken);
		}
	}

	private function validatePasswords($pwd, $pwd2){
		if($pwd != $pwd2){
			array_push($this->errorArray, Constants::$passwordsDoNotMatch);
		}

		if(preg_match("/[^A-Za-z0-9]/", $pwd)){
			array_push($this->errorArray, Constants::$passwordsNotAlphanumeric);
		}

		if(strlen($pwd) > 30 || strlen($pwd) < 5){
			array_push($this->errorArray, Constants::$passwordLength);
			return;
		}
	}

	public function getError($error){
		if(in_array($error, $this->errorArray)){
			return "<span class='errorMessage'>$error</span>";
		}
	}

}
?>