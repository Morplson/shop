<?php
	if(!isset($_SESSION)){}
	session_start();
	if(!isset($_SESSION['istAngemeldet'])){
		$_SESSION['istAngemeldet'] = false;
		$_SESSION['username'] = '';
	}

	$nl = "\n";
	$brnl = "<br>\n";
	$ausgabe = '';
	$meldung = '';

	$link = mysqli_connect('localhost', 'insy3', 'blabla', 'kino2');
	
	if (!$link) {
		$meldung .= 'MySQL Error: ' . mysqli_connect_errno() . $nl;
	}

?>