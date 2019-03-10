<?php
	include "../vendor/Shop.php";

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

	
	if (!$link) {
		$meldung .= 'MySQL Error: ' . mysqli_connect_errno() . $nl;
	}

?>