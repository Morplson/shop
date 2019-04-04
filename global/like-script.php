<?php
	include '../open.php';
	/**
	 * AUTHOR: DAVID ZEILINGER
	 * VERSION: 23_01_2019
	 * Laedt Daten(posts) aus datenbank
	 */

	error_reporting(0);

	$_POST = json_decode(file_get_contents('php://input'), true);

	$postId = isset($_POST['id']) ? $_POST['id'] : null;
	$userId = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
	
	if ($postId!=null&&$userId!=null) {
		


		$lines = file_get_contents("../global/data/like.txt");
		
		$pattern = preg_quote($postId."postid|||".$userId."userid|||", '/');	

		$pattern = "/^.*$pattern.*\$/m";



		if(preg_match_all($pattern, $lines, $matches)){
			$text = explode("|||", $matches[0][0]);

			$out = str_replace($matches[0][0], "", $lines);
			file_put_contents("../global/data/like.txt", $out);
			$dex=false;
		}else{
			file_put_contents("../global/data/like.txt", $postId."postid|||".$userId."userid|||".$vote.PHP_EOL,FILE_APPEND);
			$dex=true;
		}

		$lines = file_get_contents("../global/data/data.txt");
		
		$pattern = preg_quote($postId."rna55df|||", '/');	

		$pattern = "/^.*$pattern.*\$/m";	

		if(preg_match_all($pattern, $lines, $matches)){

			$text = explode("|||", $matches[0][0]);
			if($dex){
				$text[11] = $text[11]+1;
			}else{
				$text[11] = $text[11]-1;
			}
			

			$out = str_replace($matches[0][0], implode("|||" ,$text), $lines);
			file_put_contents("../global/data/data.txt", $out);
		}
	}
?>

