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

error_log(0);


$articles = json_decode($_COOKIE["articles"]);

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
	$gesammtpreis += $data[5] * $articles[$i][1];
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
		
	<div class="values title">
		<?php echo $title ?>
	</div>
	<a class="picture" href="global/post.php?id=<?php echo $pID; ?>">
		<picture class="picture" style="background-image: url('<?php echo $imgLink; ?>');">
		</picture>
	</a>
	<div class="values gets">
		<div class="preis">
			Preis: <?php echo $data[5] * $articles[$i][1]; ?>€
		</div>
		<div class="anzahl">
			<?php echo $anzahl." ".$einheit ?>
		</div>
	</div>
	<div class="description">
		<?php echo $description; ?>
	</div>
</div>
<?php
}
if($gesammtpreis>0){
?>
<form method="post" action="/korb/pay.php" enctype="multipart/form-data">
	<input style="display: none;" type="number" id="preis" name="preis" placeholder="" value="<?=$gesammtpreis?>">
	<input style="display: none;" type="text" id="title" name="title" placeholder="" value="<?=$gesammtpreis?>">
	<input type="submit" class="kaufenbtn" onclick="/*kaufabschluss()*/" >Preis: <?php echo $gesammtpreis; ?>€<br>KAUFEN</input>
</form>

<?php
}
?>
	
</body>
</html>