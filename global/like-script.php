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
	
	if ($postId!=null&&$userId!=null) {
		
		if(!$pdo->query("SELECT * FROM liked WHERE pid = $postId AND uid = $userId")->fetch(PDO::FETCH_ASSOC)){

			$insertlike->execute(array($postId, $userId));
		}else{
			
			$deletelike->execute(array($postId, $userId));
		}
		
	}
?>

