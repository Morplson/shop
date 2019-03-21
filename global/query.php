


<?php
	/**
	 * AUTHOR: DAVID ZEILINGER
	 * VERSION: 23_01_2019
	 * Laedt Daten(posts) aus datenbank
	 */
	$last = isset($_POST['last']) ? $_POST['last'] : null;
	$query = isset($_POST['query']) ? $_POST['query'] : null;
	$TODO = isset($_POST['max']) ? $_POST['max'] : null;
	
	$likes = 1;
	$score = 2;
	$comments =3;

	$pID = $last-1;
	
	$title = "Titel";

	$imgLink = null;

	$description = null;

	$anzahl = 40;


	if ($last == null) {
		//TODO: MySQL call
		$last = 1933635;
	} else {
		//TODO: MySQL call
	}


?>



<div class="container" id="<?php echo $pID; ?>">
	<div class="values scores">
		<div id="<?php echo $pID; ?>likes" class="like" onClick="like('<?php echo $pID; ?>')">
			<span class="fave-span" title="fave"><i class="fa fa-heart"></i></span>
			<span class="favourites" title="Favourites">'.$likes.'</span>
		</div>
		<div id="<?php echo $pID; ?>votes" class="vote">
			<i class="upvote fa fa-arrow-up" title="Upvote" onClick="vote('<?php echo $pID; ?>',1)"></i>
			<span class="score" title="Score"><?php echo $score; ?></span>
			<i class="downvote fa fa-arrow-down" title="Downvote" onClick="vote('<?php echo $pID; ?>',-1)"></i>
		</div>
		<div id="<?php echo $pID; ?>comments" class="comment" onClick="comment('<?php echo $pID; ?>')">
			<i class="fa fa-comments"></i>
			<span class="comments_count" data-image-id="'.$pID.'"> <?php echo $comments ?></span>
		</div>
	</div>
	<div class="values title">
		<?php echo $title; ?>
	</div>

	<a href="post.php?id=<?php echo $pID; ?>">
		<picture style="background-image: url( <?php echo $imgLink; ?>);"></picture>
	</a>
	<div class="values gets">
		<div class="preis">
			Preis: <?php echo $preis; ?>
		</div>

		<div class="anzahl">
			<?php echo $anzahl.' '.$einheit.''; ?>
		</div>
	</div>
	<div class="description">
		<?php echo $description; ?>
	</div>

	<div class="values buy">
		<button class="btn" id="'.$pID.'button" onClick="buy(\''.$pID.'\')">Kaufen</button>
		<input class="num" id="'.$pID.'anzahl" type="number" name="anzahl" min="1" max="'.$anzahl.'" value="1">
	</div>
</div>
