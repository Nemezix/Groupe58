<?php

class Member{

	#variables
	public $memberid;
	public $name;
	public $lastname;
	public $mail;
	public $rights;
	public $state;
	public $pswd;

	public function __construct($memberid, $name, $lastname, $mail, $state, $rights, $pswd){

		$this->memberid = $memberid;
		$this->name = $name;
		$this->lastname = $lastname;
		$this->mail = $mail;
		$this->rights = $rights;
		$this->state = $state;
		$this->pswd = $pswd;

	}


	public function getMemberid(){
		return $this->memberid;
	}

	public function getName(){
		return $this->name;
	}

	public function getLastname(){
		return $this->lastname;
	}

	public function getMail(){
		return $this->mail;
	}

	public function getState(){
		return $this->state;
	}

	public function getRights(){
		return $this->rights;
	}

	public function setRights($rights){
		$this->rights = $rights;	
	}

	
}

?>