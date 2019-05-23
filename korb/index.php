<?php
include '../open.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Warenkorb</title>
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
		<main class="x0x342">
			<h1>Warenkorb</h1>
			<div class="content_r">
<?php

error_log(0);


$articles = json_decode($_COOKIE["articles"]);

$gesammtpreis = 0;
for ($i=0; $i < count($articles); $i++) { 

	$id = $articles[$i][0];

	$sql = "SELECT * FROM post WHERE pid=$id";
	$data = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

	$link = $data["imgsrc"];
	$anzahl = $articles[$i][1];
	$title = $data["title"];
	$preis = $data["preis"];
	$description = $data["description"];
	$einheit = $data["einheit"];
	$gewicht = $data["gewicht"];
	$userID = $data["uid"];


	$gesammtpreis += $preis * $articles[$i][1];


	

	$imgLink = "global/data/".$link."/1.png";
	

?>



<div class="container" id="<?php echo $id; ?>">
		
	<div class="values title">
		<?php echo $title ?>
	</div>
	<a class="picture" href="global/post.php?id=<?php echo $id; ?>">
		<picture class="picture" style="background-image: url('<?php echo $imgLink; ?>');">
		</picture>
	</a>
	<div class="values gets">
		<div class="preis">
			Preis: <?php echo $preis * $articles[$i][1]; ?>€
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
<form method="post" action="korb/pay.php" enctype="multipart/form-data">
	<input style="display: none;" type="number" id="preis" name="preis" placeholder="" value="<?=$gesammtpreis?>">
	<input style="display: none;" type="text" id="title" name="title" placeholder="" value="">
	<button  type="submit" onclick="kaufabschluss()" class="kaufenbtn" placeholder="">Preis: <?php echo $gesammtpreis; ?>€<br> KAUFEN</button>
</form>

<?php
}
?>
	</main>
</body>
</html>