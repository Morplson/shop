<?php

include '../open.php';

$bname = $_POST["Benutzername"];																//Eingegebener Benutzername
$bpassw = $_POST["Passwort"];																		// Eingegebenes Passwort


$teile = "";																													//für die teile des namensarray

$error = "";																										//errormessage

$bnameBenutzt = 0;																							//Speichert ob der bname schon benutzt wurde

$gname = file ( "../global/data/bname.txt" ) ;

$line_number = -1;
$count=0;

if ($bname!=null) {
	$search = $bname;
	$line_number = false;

	if ($handle = fopen("../global/data/bname.txt", "r")) {
		$count = 0;
		while (($line = fgets($handle, 4096)) !== FALSE and !$line_number) {
			$count++;
			$line_number = (strpos($line, $search) !== FALSE) ? $count : $line_number;
		}
		fclose($handle);
	}

} else {
	$line_number = -1;
}


if($line_number!=false){
	echo "<br>";
	echo "<br>";
	echo "succesfull";
	#$hashid=$bname;
	$_SESSION['name'] = $bname;
	$_SESSION ['userid'] = md5($bname);
	$_SESSION ['id'] = $count;
	$_SESSION [ 'istAngemeldet' ] = true ;
} else{
	echo "<br>";
	echo "<br>";
	echo "failed";
	$_SESSION [ 'istAngemeldet' ] = false ;
}


echo $error;





?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<!--link rel="stylesheet" id="Pstyle" href="css/main.css"-->
	<link href="https://fonts.googleapis.com/css?family=Source+Code+Pro:900&amp;subset=latin-ext" rel="stylesheet">
	<script src="js/crusader.js"></script>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<script>
		if (document.cookie.indexOf("articles=") < 0){
			document.cookie = "articles="+JSON.stringify([]);
			document.cookie = "votes="+JSON.stringify([]);
			document.cookie = "likes="+JSON.stringify([]);
			document.cookie = "comments="+JSON.stringify([]);
		}



	</script>
	<title>Railway</title>

</head>
<body>
	<div class="header">
		<a href="../index.php"><div class="label topleftli">Shop.com</div></a>
		<a><div id="mobilemenu" class="mobile topleftli"><i class="fas fa-bars"></i></div></a>
		<!--a href="../shop/search.php?q=top"><div class="desktop topleftli">Beliebt</div></a>
		<a href="../shop/search.php?q=new"><div class="desktop topleftli">Neu</div></a-->

		<a href="register.php"><div class="desktop toprightli">Register</div></a>
		<div class="desktop toprightli">
		</div>




	</div>
	<div id="mobilehovercontainer" class="mobilecontainer" style="display: none;">
		<a class="exput" href="login/"></a>
		<div class="exput"><input id="searchm" class="search" type="text" placeholder="" name="sInput"></div>
	</div>

	<script type="text/javascript">
		const searchinp = document.getElementById("search");
		searchinp.addEventListener("keyup", ()=>{
			if (event.key === "Enter") {
				search();
			}
		});

		const searchinpm = document.getElementById("searchm");
		searchinpm.addEventListener("keyup", ()=>{
			if (event.key === "Enter") {
				search();
			}
		});

		function search(){
					window.location.replace("search.php?s="+searchinp.value);
			}


		const mobilemenu = document.getElementById("mobilemenu");
		mobilemenu.addEventListener("mouseover", function(event) {

					let el = document.getElementById("mobilehovercontainer");
					el.style.display = "block";
					el.style.left = mobilemenu.offsetLeft+"px";
					el.style.top =  mobilemenu.offsetTop+mobilemenu.offsetHeight+"px";

		});
		mobilemenu.addEventListener("mouseout", function(event) {

					let el = document.getElementById("mobilehovercontainer");
					el.style.display = "none";

		});



		const mobilehovercontainer = document.getElementById("mobilehovercontainer");
		mobilehovercontainer.addEventListener("mouseover", function(event) {

					let el = document.getElementById("mobilehovercontainer");
					el.style.display = "block";

		});
		mobilehovercontainer.addEventListener("mouseout", function(event) {

					let el = document.getElementById("mobilehovercontainer");
					el.style.display = "none";

		});



	</script>

	<main id="content" class="content">

  <div id="content" class="contentv2">

		<br>

		<form action = "index.php" method = "post" >
		<h1>Anmelden</h1>
	  Benutzername:
		<br>
		<input type = "text" name = "Benutzername" />
	  <br>
	  Passwort:
		<br>
		<input type = "password" name = "Passwort" />
	  <br>
		<br>
		<br>
		<br>
	  <input type = "Submit" value = "Absenden" class="bbutton" /> </form>

		<form action = "logout.php" method = "post" >
			<input type="submit" value="logout" class="bbutton">
		</form>

	<p> Noch kein Account? Rechts oben können Sie einen erstellenss</p>
  </div>
</main>

  </body>
  </html>
