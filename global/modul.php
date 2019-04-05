<?php
	include '../open.php';
	/**
	 * AUTHOR: DAVID ZEILINGER
	 * VERSION: 23_01_2019
	 * Laedt Daten(posts) aus datenbank
	 */

	error_reporting(0);

	
	$_POST = json_decode(file_get_contents('php://input'), true);



	$last = isset($_POST['last']) ? $_POST['last'] : null;
	$query = isset($_POST['query']) ? $_POST['query'] : null;
	$s = isset($_POST['s']) ? $_POST['s'] : null;
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

	start:


	if ($last!=null) {
		$search = $last."rna55df|||";
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
	for($i=$line_number; $i < $max+$line_number; $i++):
		$data = explode("|||",$lines[$i]);

		if ($data[0] == FALSE) {

			continue;
		}

		if ($s!=null) {
			if((strpos(strtolower($s), strtolower($data[4])) === false)&&(strpos(strtolower($s), strtolower($data[6])) === false)){
				$max++;
				continue;
			}
		}





	$pID = explode("rna55df",$data[0])[0];
	$link = $data[2];
	$anzahl = $data[3];
	$title = $data[4];
	$preis = $data[5];
	$description = $data[6];
	$einheit = $data[7];
	$gewicht = $data[8];
	$userID = $data[9];
	$score = $data[10];
	$likes = $data[11];
	$comments = $data[12];
	
		
	$imgLink = "global/data/".md5($link)."/thumb.jpeg";

	if($pID!=null&&isset($_SESSION['userid'])) {
		$linesx = file_get_contents("data/like.txt");
		$pattern = preg_quote($pID."postid|||".$_SESSION['userid']."userid|||", '/');		

		$pattern = "/^.*$pattern.*\$/m";
		if(preg_match_all($pattern, $linesx, $matches)){
			$collikes = "#f91f1f";
		}else{
			$collikes = "black";
		}
	}

	if($pID!=null&&isset($_SESSION['userid'])) {
		$linesx = file_get_contents("data/vote.txt");
		$pattern = preg_quote($pID."postid|||".$_SESSION['userid']."userid|||", '/');		

		$pattern = "/^.*$pattern.*\$/m";
		if(preg_match_all($pattern, $linesx, $matches)){
			$like = explode("|||", $matches[0][0])[2];
			if($like==-1){
				$colvotes = "#f91f1f";
			}elseif($like==1){
				$colvotes = "#5aa51d";
			}else{
				$colvotes = "black";
			}
		}else{
			$colvotes = "black";
		}
	}
	
	if($pID!=null&&isset($_SESSION['userid'])) {
		$linesx = file_get_contents("data/like.txt");
		$pattern = preg_quote($pID."postid|||".$_SESSION['userid']."userid|||", '/');		

		$pattern = "/^.*$pattern.*\$/m";
		if(preg_match_all($pattern, $linesx, $matches)){
			$colcom = "#9273d0";
		}else{
			$colcom = "black";
		}
	}

?>

<div class="container" id="<?php echo $pID; ?>">
	<div class="values scores">
			<div style="color: <?php echo $collikes; ?>" id="<?php echo $pID; ?>likes" class="like" onClick="like('<?php echo $pID; ?>')">
				<span class="fave-span" title="fave"><i class="fa fa-heart"></i></span>
				<span class="favourites" title="Favourites"><?php echo $likes; ?></span>
			</div>
			<div style="color: <?php echo $colvotes; ?>" id="<?php echo $pID; ?>votes" class="vote">
				<i class="upvote fa fa-arrow-up" title="Upvote" onClick="vote('<?php echo $pID; ?>',1)"></i>
				<span class="score" title="Score"><?php echo $score; ?></span>
				<i class="downvote fa fa-arrow-down" title="Downvote" onClick="vote('<?php echo $pID; ?>',-1)"></i>
			</div>
			<div style="" id="<?php echo $pID; ?>comments" class="comment" onClick="comment('<?php echo $pID; ?>')">
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