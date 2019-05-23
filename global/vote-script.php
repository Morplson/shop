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

		$data = $pdo->query("SELECT vote FROM vote WHERE pid = $postId AND uid = $userId")->fetch(PDO::FETCH_ASSOC);
		if(!$data){
			if($vote>0){
				$insertvote->execute(array($postId, 1, $userId));
			}

			if ($vote<0) {
				$insertvote->execute(array($postId, -1, $userId));
			}
			
		}else{
			if($data['vote']==$vote){
				$deletevote->execute(array($postId, $userId));
			}

			if($data['vote']!=$vote){
				if($vote<0){
					$updatevote->execute(array(-1, $postId, $userId));
				}elseif ($vote>0) {
					$updatevote->execute(array(1, $postId, $userId));
				}
			}
			
		}
		
	}
?>

