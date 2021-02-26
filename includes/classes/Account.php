<?php

class Account {

	private $errorArray= array(); 
	private $con;
	public function __construct($con)  {
		$this->con = $con;
	}


	public function register ($fn, $ln, $un, $em1, $em2, $pw1, $pw2){
		$this->validateFirstName ($fn);
		$this->validateLasttName ($ln);
		$this->validateUsertName ($un);
		$this->validateEmails ($em1,$em2);
		$this->validatePassword ($pw1,$pw2);

		if (empty($this->errorArray)){
			return $this->insertUserDetails($fn, $ln, $un, $em1, $pw1);
		}
		return false;

	}

	public function login ($un,$pw1){
		//$pw1 = hash("sha512", $pw1);

		$query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
		$query->bindValue(":un", $un);
		$query->bindValue(":pw", $pw1);

		$query->execute();

		if ($query->rowCount()== 1){
			return true;
		}

		array_push($this->errorArray, Constants::$Loginfailed);
		return false;
		
	}

	private function insertUserDetails($fn, $ln, $un, $em1, $pw1){
		//$pw1 = hash("sha512", $pw1);
		$query = $this->con->prepare("INSERT INTO users (firstName,lastName,username,email,password)
									VALUES (:fn,:ln,:un,:em,:pw)");
		$query->bindValue(":fn", $fn);
		$query->bindValue(":ln", $ln);
		$query->bindValue(":un", $un);
		$query->bindValue(":em", $em1);
		$query->bindValue(":pw", $pw1);

			return $query->execute();
		
	}

	private function validateFirstName ($fn) {
		if (strlen($fn) <2 || strlen($fn)>25){
			array_push($this->errorArray, Constants::$FirstNameCharachters);
		}
		
	}

	private function validateLasttName ($ln) {
		if (strlen($ln) <2 || strlen($ln)>25){
			array_push($this->errorArray, Constants::$LastNameCharachters);
		}
	}

	private function validateUsertName ($un) {
		if (strlen($un) <2 || strlen($un)>25){
			array_push($this->errorArray, Constants::$UserNameCharachters);
			return;
		}
		$query = $this->con->prepare("SELECT * FROM users WHERE username =:un");
		$query->bindValue(":un", $un);
		$query->execute();
		if ($query->rowCount() != 0) {
			array_push($this->errorArray, Constants::$UserNameTaken);
		}
	}

	private function validateEmails($em1,$em2){
		if ($em1 != $em2) {
			array_push($this->errorArray, Constants::$EmailsDontMatch);
			return;
		}

		if (!filter_var($em1, FILTER_VALIDATE_EMAIL)){
			array_push($this->errorArray, Constants::$EmailsInvalid);
			return;
		}

		$query = $this->con->prepare("SELECT * FROM users WHERE email =:em");
		$query->bindValue(":em", $em1);
		$query->execute();
		if ($query->rowCount() != 0) {
			array_push($this->errorArray, Constants::$EmailTaken);
		}
	}


	private function validatePassword($pw1,$pw2){
		if($pw1!=$pw2){
			array_push($this->errorArray, Constants::$PasswordDontMatch);
			}

		if (strlen($pw1) <5 || strlen($pw1)>25){
			array_push($this->errorArray, Constants::$PasswordCharachters);
		}

			

	}



	public function getError ($error){
		if (in_array($error, $this->errorArray)) {
			return "<span class ='errorMessage'>$error</span>";
			}
	}
}
?>