<?php
	include '../open.php';
	/**
	 * AUTHOR: DAVID ZEILINGER
	 * VERSION: 23_01_2019
	 * Laedt Daten(posts) aus datenbank
	 */

	#error_reporting(0);
	$_POST = json_decode(file_get_contents('php://input'), true);

	$id = isset($_POST['id']) ? $_POST['id'] : null;
	$anzahl = isset($_POST['anzahl']) ? $_POST['anzahl'] : null;
	
	if($data["anzahl"]==$anzahl)
	$editmenge -> execute(array($anzahl, $id));

?>