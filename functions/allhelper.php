<?php
	include "../lib/session.php"; 
	include "../config/config.php";
	include "../lib/Database.php"; 
	include "../helpers/format.php"; 

	$db= new database();
	$format= new format();

	session::chk_session();


?>