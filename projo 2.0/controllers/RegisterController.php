<?php

class RegisterController{

	

	public function run(){

		#main CODE on homeController

		#kicking out authentified USER
		if(!empty($_SESSION['authentified'])){
			
			header('location: index.php?action=hub');
			die();
		}


		if(isset($_POST['submitRegister'])){

			$inscr = array(
			"name" => $_POST['name'],
			"surname" => $_POST['surname'],
			"email" => $_POST['email'],			
			"numtel" => $_POST['numtel'],
			"adress" => $_POST['adress'],
			"bankid" => $_POST['bankid'],
			"pswd" => $_POST['pwd']
			);

			Db::getInstance()->submit_new_member($inscr);

		}



		#require home.php
		require_once(VIEWS.'register.php');

	}

}

?>