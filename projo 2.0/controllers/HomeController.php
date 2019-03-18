<?php

class HomeController{

	public function __construct(){

	}

	public function run(){

		#main CODE on homeController

		#kicking out authentified USER
		if(!empty($_SESSION['authentified'])){
			
			header('location: index.php?action=hub');
			die();
		}

		#require home.php
		require_once(VIEWS.'home.php');

	}

}

?>