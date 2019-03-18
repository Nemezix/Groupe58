<?php
#connecting to HOST
$dbh = new PDO('mysql:host=localhost','root','');

#creating DATABASE	 
$query = 'CREATE DATABASE dbrun';
$dbh->prepare($query)->execute();
	
#connecting to HOST
$dbh = new PDO('mysql:host=localhost;dbname=dbrun','root','');

#query to create TABLE MEMBERS
$query = 'CREATE TABLE members (lastname VARCHAR(25) COLLATE utf8_bi, firstname VARCHAR(25) COLLATE utf8_bi, email VARCHAR(50) COLLATE utf8_bi, phone integer, adress VARCHAR(100) COLLATE utf8_bi, bankid INTEGER, iconepath VARCHAR(150) COLLATE utf8_bi, moderator BOOLEAN NOT NULL default 0, coach BOOLEAN NOT NULL default 0, valided BOOLEAN NOT NULL default 0) ';

$dbh->prepare($query)->execute(); 

?>
