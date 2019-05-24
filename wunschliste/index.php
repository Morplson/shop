<?php
include '../open.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Wunschliste</title>
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
			<h1>Wunschliste</h1>
			<div class="content_r">
<?php

#error_log(0);


$articles = json_decode($_COOKIE["likes"]);

$gesammtpreis = 0;
for ($i=0; $i < count($articles); $i++) { 

	$id = $articles[$i][0];

	$sql = "SELECT * FROM post WHERE pid=$id";
	$data = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

	$link = $data["imgsrc"];
	$anzahl = $data["anzahl"];
	$title = $data["title"];
	$preis = $data["preis"];
	$description = $data["description"];
	$einheit = $data["einheit"];
	$gewicht = $data["gewicht"];
	$userID = $data["uid"];
	

	$imgLink = "global/data/".$link."/1.png";
	
	

?>

<div class="container" id="wunsch<?php echo $id; ?>">

	<div class="values title">
		<?php echo $title ?>
	</div>
	<a class="picture" href="global/post.php?id=<?php echo $id; ?>">
		<picture class="picture" style="background-image: url('<?php echo $imgLink; ?>');">
		</picture>
	</a>
	<div class="values gets">
		<div class="preis">
			Preis: <?php echo (float)$preis; ?>€
		</div>
		<div class="anzahl">
			<?php echo $anzahl." ".$einheit ?>
		</div>
	</div>
	<div class="description">
		<?php echo $description; ?>
	</div>

	<div class="values buy">
		<button class="btn" id="wunsch<?php echo $id; ?>button" onClick="buy('<?php echo $id; ?>')">Kaufen</button>
		<input class="num" id="wunsch<?php echo $id; ?>anzahl" type="number" name="anzahl" min="1" max="<?php echo $anzahl; ?>" value="1">
	</div>
</div>
<?php
}
?>
	</main>
</body>
</html>