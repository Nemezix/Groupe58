<?php

class LogoutController{

	public function __construct(){

	}

	public function run(){

		#main CODE on LogoutController

		#exiting connection for USER
		session_destroy();

		#kicking out unlogged user to HOME
		header('location: index.php?action=home');
		die();
	}

}

?>