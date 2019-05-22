<?php
	
	include "vendor/Shop.php";

	if(!isset($_SESSION)){
		session_start();
	}
	if(!isset($_SESSION['istAngemeldet'])){
		$_SESSION['istAngemeldet'] = false;
		$_SESSION['userid'] = 0;
		$_SESSION['username'] = '';
	}

	$nl = "\n";
	$brnl = "<br>\n";
	$ausgabe = '';
	$meldung = '';

	#error_log(0);

$pdo = new PDO('mysql:host=localhost;dbname=shop','root','');
$additem = $pdo -> prepare( "INSERT INTO post (uid, title, preis, description, gewicht, anzahl, einheit, imgsrc)
   VALUES (?,?,?,?,?,?)");
$deleteitem = $pdo -> prepare("DELETE FROM post WHERE pid = ?");

$editname = $pdo -> prepare("UPDATE post title=? WHERE pid=?");
$editkosten = $pdo -> prepare("UPDATE post preis=? WHERE pid=?");
$editbeschreibung = $pdo -> prepare("UPDATE post description=? WHERE pid=?");
$editmenge = $pdo -> prepare("UPDATE post anzahl=? WHERE pid=?");
$editgewicht = $pdo -> prepare("UPDATE post gewicht=? WHERE pid=?");
$editimgsrc = $pdo -> prepare("UPDATE post imgsrc=? WHERE pid=?");
?>
