<?php
include '../open.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Wahrenkorb</title>
		<style type="text/css">
			.kaufenbtn{
				position: fixed;
				bottom: 4rem;
				right: 2rem;
				cursor: pointer;
				text-align: center;
				border: 1px solid #E8E8E8;
				background-color: white;
				transition: all 0.6s;
				padding: 0.25rem;

			}

			.kaufenbtn:hover{
				background-color: #E8E8E8;
			}
		</style>
	</head>
	<body>
			<div class="content_r">
<?php

#error_log(0);


$articles = json_decode($_COOKIE["likes"]);

$gesammtpreis = 0;
for ($i=0; $i < count($articles); $i++) { 

	if (isset($articles[$i])) {
		$search = $articles[$i][0]."rna55df|||";
		$line_number = false;

		if ($handle = fopen("../global/data/data.txt", "r")) {
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
	$lines = file("../global/data/data.txt");

		
	$data = explode("|||",$lines[$line_number-1]);
	


	$pID = explode("rna55df",$data[0])[0];
	$link = $data[2];
	$anzahl = $articles[$i][1];
	$title = $data[4];
	$gesammtpreis += $data[5] * $articles[$i][0];
	$description = $data[6];
	$einheit = $data[7];
	$gewicht = $data[8];
	$userID = $data[9];
	$score = $data[10];
	$likes = $data[11];
	$comments = $data[12];
	

	$imgLink = "global/data/".md5($link)."/1.png";
	

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
			Preis: <?php echo $data[5] * $articles[$i][0]; ?>€
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
<?php
}
?>
</body>
</html>