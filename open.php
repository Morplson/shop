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

$_SESSION['userid'] = 1;

$pdo = new PDO('mysql:host=localhost;dbname=shop','shop','shop');
$additem = $pdo -> prepare( "INSERT INTO post(uid, title, preis, description, gewicht, anzahl, einheit, imgsrc)
   VALUES (?,?,?,?,?,?,?,?)");
$deleteitem = $pdo -> prepare("DELETE FROM post WHERE pid = ?");

$editname = $pdo -> prepare("UPDATE post SET title=? WHERE pid=?");
$editkosten = $pdo -> prepare("UPDATE post SET preis=? WHERE pid=?");
$editbeschreibung = $pdo -> prepare("UPDATE post SET description=? WHERE pid=?");
$editmenge = $pdo -> prepare("UPDATE post SET anzahl=? WHERE pid=?");
$editgewicht = $pdo -> prepare("UPDATE post SET gewicht=? WHERE pid=?");
$editeinheit = $pdo -> prepare("UPDATE post SET einheit=? WHERE pid=?");

$insertlike = $pdo -> prepare("INSERT INTO liked(pid, uid) VALUES (?,?)");
$deletelike = $pdo -> prepare("DELETE FROM liked WHERE pid=? AND uid=?");

$insertvote = $pdo -> prepare("INSERT INTO vote(pid, vote, uid) VALUES (?,?,?)");
$updatevote = $pdo -> prepare("UPDATE vote SET vote=? WHERE pid=? AND uid=?");
$deletevote = $pdo -> prepare("DELETE FROM vote WHERE pid=? AND uid=?");

$insertcomment = $pdo -> prepare("INSERT INTO comment(pid, uid, title, description) VALUES (?,?,?,?)");


#$additem->execute(array($_SESSION['userid'],"test2","10","test0.5",4,3,"Stk.","3b4f55012091385994d7ab5ced1df639"));

#VALUES (1,"test","10","test",4,3,"Stk.","26b914475cc2c0165a03264d66c0289f") ;

?>