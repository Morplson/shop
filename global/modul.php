<?php
	include '../open.php';
	/**
	 * AUTHOR: DAVID ZEILINGER
	 * VERSION: 23_01_2019
	 * Laedt Daten(posts) aus datenbank
	 */

	#error_reporting(0);


	$_POST = json_decode(file_get_contents('php://input'), true);



	$last = isset($_POST['last']) ? $_POST['last'] : null;
	$query = isset($_POST['query']) ? $_POST['query'] : null;
	$s = isset($_POST['s']) ? $_POST['s'] : null;
	$max = isset($_POST['max']) ? $_POST['max'] : 20;
	$uid = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;

	if($query == "new"){
		$sql = "SELECT * FROM post ";
		if($last != null || $s != null){
			$sql .= " where ";
		}
		if($last != null){
			$sql .= " pid < $last ";
		}
		if($s != null){
			if($last != null){
				$sql .= " AND ";
			}
			$sql .= " title regexp '$s' OR description regexp '$s' ";
		}
	
		$sql .= " order by pid desc limit $max ";
	}

	if($query == "top"){
		$sql = "SELECT * FROM post NATURAL JOIN (SELECT pid,sum(vote) AS 'score' FROM vote GROUP BY pid) as temp ";
		if($last != null || $s != null){
			$sql .= " where ";
		}
		if($last != null){
			$sql .= " pid < $last ";
		}
		if($s != null){
			if($last != null){
				$sql .= " AND ";
			}
			$sql .= " title regexp '$s' OR description regexp '$s' ";
		}

		$sql .= " order by score desc limit $max ";
	}

	if($query == "featured"){
		$sql = "SELECT * FROM post order by featured desc, pid desc limit $max ";
	}


	$posts = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

	foreach($posts as $data){
		
		#var_dump($data);
		
		$link = $data["imgsrc"];
		$anzahl = $data["anzahl"];
		$title = $data["title"];
		$preis = $data["preis"];
		$description = $data["description"];
		$einheit = $data["einheit"];
		$gewicht = $data["gewicht"];
		$userID = $data["uid"];	
		$postID = $data["pid"];
	

		
		
		$data = $pdo->query("SELECT sum(vote) AS 'score' FROM vote WHERE pid = $postID")->fetch(PDO::FETCH_ASSOC);
		if($data!=false){
			$score = $data["score"];
		}else{
			$score = 0;
		}	

		$data = $pdo->query("SELECT count(*) AS 'liked' FROM liked WHERE pid = $postID")->fetch(PDO::FETCH_ASSOC);
		if($data!=false){
			$likes = $data["liked"];
		}else{
			$likes = 0;
		}	

		$data = $pdo->query("SELECT count(*) AS 'comment' FROM comment WHERE pid = $postID")->fetch(PDO::FETCH_ASSOC);
		if($data!=false){
			$comments = $data["comment"];
		}else{
			$comments = 0;
		}	

		$images = array();
		if(is_dir("data/".$link)){	

			foreach (glob("data/".$link."/*.png") as $file) {
				$images[] = $file;
			}
		}	

			$data = $pdo->query("SELECT * FROM liked WHERE pid = $postID AND uid = $uid")->fetch(PDO::FETCH_ASSOC);	

			if($data!=false){
				#if(count($data>0)) {
				$collikes = "#f91f1f";		
			}else{
				$collikes = "black";
			}
			

		$data = $pdo->query("SELECT vote AS 'vote' FROM vote WHERE pid = $postID AND uid = $uid")->fetch(PDO::FETCH_ASSOC);	

		if($data!=false){
			if($data["vote"]==-1){
				$colvotes = "#f91f1f";
			}elseif($data["vote"]==1){
				$colvotes = "#5aa51d";
			}	

		}else{
			$colvotes = "black";
		}	

		$data = $pdo->query("SELECT * FROM comment WHERE pid = $postID AND uid = $uid")->fetch(PDO::FETCH_ASSOC);	

		if($data!=false){
			$colcom = "#9273d0";
		}else{
			$colcom = "black";
		}

		$imgLink = "global/data/".$link."/thumb.jpeg";


?>

<div class="container" id="<?php echo $postID; ?>">
	<div class="values scores">
			<div style="color: <?php echo $collikes; ?>" id="<?php echo $postID; ?>likes" class="like" onClick="like('<?php echo $postID; ?>')">
				<span class="fave-span" title="fave"><i class="fa fa-heart"></i></span>
				<span class="favourites" title="Favourites"><?php echo $likes; ?></span>
			</div>
			<div style="color: <?php echo $colvotes; ?>" id="<?php echo $postID; ?>votes" class="vote">
				<i class="upvote fa fa-arrow-up" title="Upvote" onClick="vote('<?php echo $postID; ?>',1)"></i>
				<span class="score" title="Score"><?php echo $score; ?></span>
				<i class="downvote fa fa-arrow-down" title="Downvote" onClick="vote('<?php echo $postID; ?>',-1)"></i>
			</div>
			<div style="color: <?php echo $colcom; ?>" id="<?php echo $postID; ?>comments" class="comment" onClick="comment('<?php echo $postID; ?>')">
				<i class="fa fa-comments"></i>
				<span class="comments_count" data-image-id="<?php echo $postID; ?>"><?php echo $comments; ?></span>
			</div>
	</div>



	<div class="values title">
		<?php echo $title.$postID?>
	</div>
	<a class="picture" href="global/post.php?id=<?php echo $postID; ?>">
		<picture class="picture" style="background-image: url('<?php echo $imgLink; ?>');">
		</picture>
	</a>
	<div class="values gets">
		<div class="preis">
			Preis: <?php echo $preis; ?>€
		</div>
		<div class="anzahl">
			<?php echo $anzahl." ".$einheit ?>
		</div>
	</div>
	<div class="description">
		<?php echo $description; ?>
	</div>
	<div class="values buy">
		<button class="btn" id="<?php echo $postID; ?>button" onClick="buy('<?php echo $postID; ?>')">Kaufen</button>
		<input class="num" id="<?php echo $postID; ?>anzahl" type="number" name="anzahl" min="1" max="<?php echo $anzahl; ?>" value="1">
	</div>
</div>

<?php } ?>
