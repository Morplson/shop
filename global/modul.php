<?php
	/**
	 * AUTHOR: DAVID ZEILINGER
	 * VERSION: 23_01_2019
	 * Laedt Daten(posts) aus datenbank
	 */

	error_reporting(0);

	
	$_POST = json_decode(file_get_contents('php://input'), true);



	$last = isset($_POST['last']) ? $_POST['last'] : null;
	$query = isset($_POST['query']) ? $_POST['query'] : null;
	$max = isset($_POST['max']) ? $_POST['max'] : null;
	
	$likes = 0;
	$score = 0;
	$comments = 0;

	$pID = rand();//$last;
	
	$title = "Titel";

	$imgLink = null;

	$description = "

▓█████▄  ▄▄▄    ██▒   █▓ ██▓▓█████▄ 
▒██▀ ██▌▒████▄ ▓██░   █▒▓██▒▒██▀ ██▌
░██   █▌▒██  ▀█▄▓██  █▒░▒██▒░██   █▌
░▓█▄   ▌░██▄▄▄▄██▒██ █░░░██░░▓█▄   ▌
░▒████▓  ▓█   ▓██▒▒▀█░  ░██░░▒████▓ 
 ▒▒▓  ▒  ▒▒   ▓▒█░░ ▐░  ░▓   ▒▒▓  ▒ 
 ░ ▒  ▒   ▒   ▒▒ ░░ ░░   ▒ ░ ░ ▒  ▒ 
 ░ ░  ░   ░   ▒     ░░   ▒ ░ ░ ░  ░ 
   ░          ░  ░   ░   ░     ░    
 ░                  ░        ░      

";

	$anzahl = 0;

	$einheit = "Stk.";

	$preis = 0;




	if ($last!=null) {
		$search = $last;
		$line_number = false;

		if ($handle = fopen("data/data.txt", "r")) {
			$count = 0;
			while (($line = fgets($handle, 4096)) !== FALSE and !$line_number) {
				$count++;
				$line_number = (strpos($line, $search) !== FALSE) ? $count : $line_number;
			}
			fclose($handle);
		}
		
	} else {
		$line_number = 0;
	}
	
	$export = '';
	$lines = file("data/data.txt");
	for($i=$line_number; $i < $max; $i++):
		
		$data = explode("|||",$lines[$i]);
	

		$pID = $data[0];
		$link = $data[1];
		$anzahl = $data[2];
		$title = $data[3];
		$preis = $data[4];
		$description = $data[5];
		$einheit = $data[6];
		$gewicht = $data[7];
		$userID = $data[8];
		$score = $data[9];
		$likes = $data[10];
		$comments = $data[11];
	
		#$imgLink = "global/data/".md5($link).".png";

		if(!file_exists("global/data/".md5($link).".png")){


			$imgLink = "global/data/".md5($link)."/1.png";
		}else{
			$imgLink = "global/data/".md5($link).".png";
		}

?>

<div class="container" id="<?php echo $pID; ?>">
	<div class="values scores">
		<div id="<?php echo $pID; ?>likes" class="like" onClick="like('<?php echo $pID; ?>')">
			<span class="fave-span" title="fave"><i class="fa fa-heart"></i></span>
			<span class="favourites" title="Favourites"><?php echo $likes; ?></span>
		</div>
		<div id="<?php echo $pID; ?>votes" class="vote">
			<i class="upvote fa fa-arrow-up" title="Upvote" onClick="vote('<?php echo $pID; ?>',1)"></i>
			<span class="score" title="Score"><?php echo $score; ?></span>
			<i class="downvote fa fa-arrow-down" title="Downvote" onClick="vote('<?php echo $pID; ?>',-1)"></i>
		</div>
		<div id="<?php echo $pID; ?>comments" class="comment" onClick="comment('<?php echo $pID; ?>')">
			<i class="fa fa-comments"></i>
			<span class="comments_count" data-image-id="<?php echo $pID; ?>"><?php echo $comments; ?></span>
		</div>
	</div>

			
	<div class="values title">
		<?php echo $title ?>
	</div>
	<a class="picture" href="global/post.php?id=<?php echo $pID; ?>">
		<picture class="picture" style="background-image: url('<?php echo $imgLink; ?>');">
		</picture>
	</a>
	<div class="values gets">
		<div class="preis">
			Preis: <?php echo $preis; ?>
		</div>
		<div class="anzahl">
			<?php echo $anzahl." ".$einheit ?>
		</div>
	</div>
	<div class="description">
		<?php echo $description; ?>
	</div>
	<div class="values buy">
		<button class="btn" id="<?php echo $pID; ?>button" onClick="buy('<?php echo $pID; ?>')">Kaufen</button>
		<input class="num" id="<?php echo $pID; ?>anzahl" type="number" name="anzahl" min="1" max="<?php echo $anzahl; ?>" value="1">
	</div>
</div>

<?php endfor; ?>