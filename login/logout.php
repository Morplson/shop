<?php
	include "../open.php";
	$_SESSION [ 'istAngemeldet' ] = false ;
	if(	$_SESSION [ 'istAngemeldet' ] == false ){
		echo "succesfull";
	} else{
		echo "failed";
	}
	header("Location: ../index.php");
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
	      width: 30%;
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

	      width: 10%;
	      margin: 1.5rem 25%;
			}

	    h1{
	      size: 15px;
	      color: red;
	    }
			.bbutton{
				width: 6rem;
				height: 3rem;
				border-radius: 3rem;
				border: 1px solid #E8E8E8;
			}
		</style>

</head>
<body>
		<form action = "../index.php" method = "post" >
			<input type="submit" value="Startseite" class="bbutton">
		</form>

  </body>
  </html>
