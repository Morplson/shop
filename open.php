<?php
	
	include "vendor/Shop.php";

	if(!isset($_SESSION)){
		session_start();
	}
	if(!isset($_SESSION['istAngemeldet'])){
		$_SESSION['istAngemeldet'] = false;
		$_SESSION['userid'] = '';
		$_SESSION['username'] = '';
	}

	$nl = "\n";
	$brnl = "<br>\n";
	$ausgabe = '';
	$meldung = '';

	error_log(0);


?>
