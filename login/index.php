<?php
	error_log(0);

include '../open.php';																	// Eingegebenes Passwort

$pdo = new PDO ( 'mysql:host=localhost;dbname=shop' , 'root' , '' );

$bname = isset($_POST['Benutzername']) ? $_POST['Benutzername'] : null;																//Eingegebener Benutzername
$bpassw = isset($_POST['Passwort']) ? $_POST['Passwort'] : null;

$bnright = 0;
$beright = 0;

$sql = "SELECT uname FROM user WHERE uname = $bname" ;
$user = $pdo -> query ( $sql );
if($user=$bname){
	$bnright=1;
}

$sql = "SELECT uid FROM user WHERE uname = $bname" ;
$user = $pdo -> query ( $sql );

$sql = "SELECT psw FROM user WHERE uid=$user" ;
$user = $pdo -> query ( $sql );
echo $user;
if($user=$passw){
	$beright=1;
} else {
	$beright=0;
}

//echo $user;

if($bnright=1&&$beright=1){
	echo "sumconfirm";
	$_SESSION['name'] = $bname;
	$_SESSION ['userid'] = md5($bname);
	$_SESSION [ 'istAngemeldet' ] = true ;
	echo "<br>";
	echo "<br>";
	echo "success";
	echo $_SESSION [ 'istAngemeldet' ];
} else{
	echo "<br>";
	echo "<br>";
	echo "failed";
	$_SESSION [ 'istAngemeldet' ] = false ;
}

?>
<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" type="text/css" href="../css/main.css">

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

	<style>
	input[type="text"].search {
		vertical-align: middle;
		margin: 0;
		padding: 0;

		background-color: transparent;
		border: none;
		color: black;
	}

	.header{
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		z-index: 5;
		padding-left: 3.5rem;
		padding-right: 9rem;
		background-color: white;

		height: 3rem;
		overflow: hidden;
	}

	.label{
		font-weight: bold;

	}

	.topleftli{

		transition: background-color .6s;

		padding: 0 1rem;
		line-height: 3rem;
		float: left;
	}

	.toprightli{
		transition: background-color .6s;

		padding: 0 1rem;
		line-height: 3rem;
		float: right;
	}

	@media only screen and (max-width: 768px) {
		.desktop {
			display: none;
		}
	}
	@media only screen and (min-width: 767px) {
		.mobile {
			display: none;
		}
	}

	.mobilecontainer{

		background-color: white;
		z-index: 30;

		position: fixed;
		box-sizing: content-box;

	}

	.mobilecontainer>.exput{
		transition: background-color .6s;
		line-height: 3rem;
		height: 3rem;
		padding: 0 1rem;
	}

	.exput:hover, .topleftli:hover, .toprightli:hover{
		background-color: #f2f2f2
	}

</style>
</head>
<body>
	<div class="header">
		<a href="../index.php"><div class="label topleftli">Shop.com</div></a>
		<a><div id="mobilemenu" class="mobile topleftli"><i class="fas fa-bars"></i></div></a>
		<!--a href="../shop/search.php?q=top"><div class="desktop topleftli">Beliebt</div></a>
		<a href="../shop/search.php?q=new"><div class="desktop topleftli">Neu</div></a-->

		<a href="logout.php"><div class="desktop toprightli">Logout</div></a>
		<a href="register.php"><div class="desktop toprightli">Register</div></a>
		<div class="desktop toprightli">
		</div>




	</div>
	<div id="mobilehovercontainer" class="mobilecontainer" style="display: none;">
		<a class="exput" href="register.php">Register</a>
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
		<input type = "text" name = "Benutzername"  />
	  <br>
	  Passwort:
		<br>
		<input type = "password" name = "Passwort"  />
	  <br>
		<br>
		<br>
		<br>
	  <input type = "Submit" value = "Absenden" class="bbutton" /> </form>

	  <input type = "Submit" value = "Absenden" class="submitbutton" /> </form>
	</form>

  </div>
</main>

  </body>
  </html>
