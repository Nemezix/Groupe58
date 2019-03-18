<?php

class ProfilController{

	public function __construct(){

	}

	public function run(){

		#main CODE on homeController

		#kicking out non-authentified USER
		if(empty($_SESSION['authentified'])){
			
			header('location: index.php?action=home');
			die();
		}
		

		$user = Db::getInstance()->select_member($_SESSION['login']);


		
		if(isset($_POST['profileSubmit'])){


			if(!empty($_POST['newpwd'])){

				$user->pswd = password_hash($_POST['newpwd'], PASSWORD_DEFAULT);
			}

			$update_user = new Member( $user->memberid, $_POST['name'], $_POST['surname'], $_POST['numtel'], $_POST['email'], $_POST['adress'], $_POST['bankid'], $user->trainingid, $user->rights, $user->title, $user->pswd);

			Db::getInstance()->update_member($update_user);

			$user->mail = $_POST['email'];
			$_SESSION['login'] = $user->mail;

		}

		$user = Db::getInstance()->select_member($user->mail);



		#require home.php
		if (isset($_GET['modify']) AND ($user->rights > 1)){
			$member = Db::getInstance()->select_member($_GET['modify']);

			if(isset($_POST['modifySubmit'])){
				$update_member = $member;

				$update_member->rights = $_POST['rightsModify'];
				$update_member->title = $_POST['titleModify'];


				Db::getInstance()->update_member($update_member);
				Db::getInstance()->update_title($update_member);

				$member = Db::getInstance()->select_member($member->mail);
			}

			require_once(VIEWS.'profil_modify.php');
		}
		else{
			require_once(VIEWS.'profil.php');
		}


	}

}

?>