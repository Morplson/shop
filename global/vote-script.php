<?php
	include '../open.php';
	/**
	 * AUTHOR: DAVID ZEILINGER
	 * VERSION: 23_01_2019
	 * Laedt Daten(posts) aus datenbank
	 */

	#error_reporting(0);
	
	$_POST = json_decode(file_get_contents('php://input'), true);

	$postId = isset($_POST['id']) ? $_POST['id'] : null;
	$userId = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
	$vote = isset($_POST['vote']) ? $_POST['vote'] : null;
	
	if ($postId!=null&&$userId!=null&&$vote!=null) {
		


		$lines = file_get_contents("../global/data/vote.txt");
		
		$pattern = preg_quote($postId."postid|||".$userId."userid|||", '/');	

		$pattern = "/^.*$pattern.*\$/m";



		if(preg_match_all($pattern, $lines, $matches)){
			$text = explode("|||", $matches[0][0]);
			if ($text[2]-$vote!=0) {
				$dex=true;
			}else{
				$dex=false;
			}
			$text[2] = $vote;
			echo implode("|||" ,$text);

			$out = str_replace($matches[0][0], implode("|||" ,$text), $lines);
			file_put_contents("../global/data/vote.txt", $out);
			$vote = $vote*2;
		}else{
			$dex=true;
			file_put_contents("../global/data/vote.txt", $postId."postid|||".$userId."userid|||".$vote.PHP_EOL,FILE_APPEND);
		}
	

		if ($dex) {
			$lines = file_get_contents("../global/data/data.txt");
			
			$pattern = preg_quote($postId."rna55df|||", '/');		

			$pattern = "/^.*$pattern.*\$/m";	

			if(preg_match_all($pattern, $lines, $matches)){
				$text = explode("|||", $matches[0][0]);
				$text[10] = $text[10] + $vote;
				echo implode("|||" ,$text);	

				$out = str_replace($matches[0][0], implode("|||" ,$text), $lines);
				file_put_contents("../global/data/data.txt", $out);
			}
		}

	}
?>

