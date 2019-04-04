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
	$title = isset($_POST['title']) ? $_POST['title'] : null;
	$text = isset($_POST['text']) ? $_POST['text'] : null;
	
	if ($postId!=null&&$userId!=null&&$title!=null&&$text!=null) {
		file_put_contents("../global/data/comment.txt", $postId."postid|||".$userId."userid|||".$title."|||".$text.PHP_EOL,FILE_APPEND);
	}
?>

