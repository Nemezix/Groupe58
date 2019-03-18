<?php
#connecting to HOST
$dbh = new PDO('mysql:host=localhost','root','');

#creating DATABASE	 
$query = 'CREATE DATABASE dbrun';
$dbh->prepare($query)->execute();
	
#connecting to HOST
$dbh = new PDO('mysql:host=localhost;dbname=dbrun','root','');

#queries

?>
