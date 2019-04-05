<?php
$bname = $_POST["rname"];																//Eingegebener Benutzername
$bpassw = $_POST["rpasswort"];																		// Eingegebenes Passwort
$bemail = $_POST["remail"];

$teile="";																													//für die teile des namensarray

$error = "";																										//errormessage

$bnameBenutzt = 0;																							//Speichert ob der bname schon benutzt wurde
$bemailBenutzt = 0;																							//Speichert ob der

$i=0;

//$gname = file ( "../global/data/bname.txt" ) ;								//Genomene namen (array geholt aus bname.txt)
//for ( $i = 0 ; $i < count ( $gname ) ; $i ++ ) {
//	$teile=$gname[$i];																					//teile bekommt einen Namen
//	if($bname==$teile){
//		$bnameBenutzt = 1;																			  //Namen gibt es schon
//		$error .="Benutzername oder Password falsch";
//	}
//}

//$gemail = file ( "../global/data/bemail.txt" ) ;								//Genomene namen (array geholt aus bname.txt)
//for ( $i = 0 ; $i < count ( $gemail ) ; $i ++ ) {
//	$teile=$gemail[$i];																					//teile bekommt einen Namen
//	if($bname==$teile){
//		$bemailBenutzt = 1;																			  //Namen gibt es schon
//		$error .="Benutzername oder Password falsch";
//	}
//}


$line_number1 = -1;

if ($bname!=null) {
	$search = $bname;
	$line_number1 = false;

	if ($handle = fopen("../global/data/bname.txt", "r")) {
		$count = 0;
		while (($line = fgets($handle, 4096)) !== FALSE and !$line_number1) {
			$count++;
			$line_number1 = (strpos($line, $search) !== FALSE) ? $count : $line_number1;
		}
		fclose($handle);
	}

} else {
	$line_number1 = -1;
}

$line_number3 = -1;

if ($bemail!=null) {
	$search = $bname;
	$line_number3 = false;

	if ($handle = fopen("../global/data/bemail.txt", "r")) {
		$count = 0;
		while (($line = fgets($handle, 4096)) !== FALSE and !$line_number3) {
			$count++;
			$line_number3 = (strpos($line, $search) !== FALSE) ? $count : $line_number3;
		}
		fclose($handle);
	}

} else {
	$line_number3 = -1;
}

if($line_number1==false&&$line_number3==false){
	file_put_contents ("../global/data/bname.txt" , PHP_EOL.$bname,  FILE_APPEND) ;
	file_put_contents ("../global/data/bpassw.txt" , PHP_EOL.$bpassw,  FILE_APPEND) ;
	file_put_contents ("../global/data/bemail.txt" , PHP_EOL.$bemail,  FILE_APPEND) ;

		//$i--;
	$_SESSION [ 'name' ] = $bname ;
	echo "succesfull";
} else{
		echo "failed";
}








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



		<style type="text/css">
			.values.scores>.like:hover {
				color: #f91f1f;
			}

			.upvote:hover{
				color: #5aa51d;
			}

			.downvote:hover{
				color: #f91f1f;
			}


			.values.scores>.comment:hover {
				color: #9273d0;
			}

			.description {
				text-align: justify;
				padding: 0.125rem;
				word-break: break-word;
			}

			.values.buy{
			}

			.values.buy>.btn{
				padding: 0 1rem;
				background-color: transparent;
				border: none;

				height: 1.5rem;

				width: 6rem;
				float: left;

				transition: all 0.6s;
			}

			.values.buy>.num{
				padding: 0 1rem;
				background-color: transparent;
				border: none;

				height: 1.5rem;

				float: right;
				width: 4rem;

				transition: all 0.6s;
			}

			.values.gets>.preis{
				float: left;
				padding-left: 1rem;
			}

			.values.gets>.anzahl{
				float: right;
				padding-right: 1rem;

			}

		</style>
	<style type="text/css">
		*{
			font-size: 16pt;
			font-family: 'Raleway', sans-serif;
			scroll-behavior: smooth;
		}

		body{
			x-overflow: hidden;
			padding: 0;
			margin: 0;
		}

		a, a:visited, a:hover, a:active{
			text-decoration: none;
			color: inherit;
		}

		.playarea{
			z-index: 0;
		}
		.playcontent{
			margin-left: 10%;
		}

		.playbar{
			z-index: 5;

			height: 7rem;
			width: 40%;
			min-width: 25rem;

			bottom: 0;
			left: 0;

			position: absolute;

			overflow: hidden;

			background-color: black;
		}




		.topleftli:hover, .toprightli:hover{
			background-color: #f2f2f2
		}

		.controlls{
			position: fixed;
			bottom: 1rem;
			right: 7rem;

		}
		.controllbutton{
			width: 3rem;
			height: 3rem;
			margin: 0 1.5rem;
			border-radius: 3rem;
			padding: 0.5rem;
			border: 1px solid #E8E8E8;
			float: right;
			text-align: center;
		}

		.container{
			border: 1px solid #E8E8E8;
			height: auto;
			width: 13.5rem;
			margin: 0.25rem;
			display: inline-block;
			position: relative;
			vertical-align: baseline;
		}

		picture.picture,a.picture{
			display: block;
			height: 12rem;
			width: 13.5rem;
			background-repeat: no-repeat;
			background-size: contain;
			background-position: center;
		}



		.values{
			height:1.5rem;
			line-height: 1.5rem;
			background-color: #E8E8E8;
			text-align: center;
			white-space: nowrap;
			word-wrap: break-word;

		}

		.values div{
			width: auto;
			display: inline-block;

		}

		.values.scores{
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			letter-spacing: 0.25rem;
		}

		.content {
			position: absolute;
			top: 4.5rem;
			right:4.5rem;
			left: 2rem;
      width: 90%;
      margin: 1.5rem 25%;
		}

		.flex-container{
			display: flex;

			clear: both;
			flex: 1 0 auto;
			text-align: center;
		}

		.content_l {
			flex: 0 0 auto;
			width: 15rem;
			word-wrap: break-word;

		}

		@media only screen and (max-width: 768px) {
			.content_l {
				display: none;
			}
		}

		.content_r {
			flex: 1 0 auto;
			width: 15rem;
			word-wrap: break-word;
			align-items: center;
		}

		.content_l .container{
			width: 98%;
			height: auto;

			margin: 0.25rem -1px;
		}

		.values.buy>.btn:hover, .values.buy>.num:hover{
			background-color: #D8D8D8;
		}
    .con1{
      top: 25%;
      right:50%;
      width:10%;
      height: 15px;
    }

    .contentv2 {
			position: absolute;
			top: 0rem;;
			right:4.5rem;
			left: 2rem;
      width: 90%;
      margin: 1.5rem 25%;
		}

    h1{
      size: 15px;
      color: red;
    }
	</style>

</head>
<body>
	<main id="content" class="content">
		<form action = "register.php" method = "post" >
    <h1>Regristrieren</h1>
    Benutzername:
		<br>
    <input type="text" name="rname" />
		<br>
    Passwort:
		<br>
    <input type="text" name="rpasswort" />
		<br>
    E-mail:
		<br>
    <input type="text" name="remail" />
    <br>
		<br>
		<br>
    <input type="submit" value="Submit">
		</form>
		<form action = "../index.php" method = "post" >
			<input type="submit" value="back">
		</form>

</main>

  </body>
  </html>
