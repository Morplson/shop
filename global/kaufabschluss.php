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
	

	$lines = file_get_contents("../global/data/data.txt");
	
	$pattern = preg_quote($id."rna55df|||", '/');
	$pattern = "/^.*$pattern.*\$/m";

	if(preg_match_all($pattern, $lines, $matches)){
		$text = explode("|||", $matches[0][0]);
		$text[3] = $text[3]-$_POST['anzahl'];
		
		$out = str_replace($matches[0][0], implode("|||" ,$text), $lines);
		file_put_contents("../global/data/data.txt", $out);
		
	}
?>