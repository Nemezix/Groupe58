<?php

class LoginController{

	private $_db;

	public function __construct($db){

		$this->_db = $db;
	}

	public function run(){

		#main CODE on LoginController

		#kicking out authentified USER
		if(!empty($_SESSION['authentified'])){
			
			header('location: index.php?action=hub');
			die();
		}

		#managing connection of USER
		$notification = 'test';

		#verifying if data is sent
		if(isset($_POST['submitLogin'])){

			if($this->_db->pswdCheck($_POST['userLogin'], $_POST['pwLogin'])){

				if ($this->_db->rights_check($_POST['userLogin'], 1)){

					$_SESSION['authentified'] = 'authentified';
					$_SESSION['login'] = $_POST['userLogin'];

					$this->_db->select_member($_SESSION['login']);

					header('location: index.php?action=hub');
					die();
					
				}else{

					$notification = 'Erreur de connextion : vous navez pas encore les droits de connection.';
					$_POST['notif'] = $notification;
				}
				
			}
			elseif(!$this->_db->pswdCheck($_POST['userLogin'], $_POST['pwLogin'])){

				$notification = 'Erreur de connexion : les identifiants sont incorrects.';
				$_POST['notif'] = $notification;
			}
		}
		
		#require home.php
		require_once(VIEWS.'login.php');

	}

}

?>