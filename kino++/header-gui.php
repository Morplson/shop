<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="de">
	<head>
		<link href="https://fonts.googleapis.com/css?family=Roboto:400" rel="stylesheet"> 

		<title>Kino++</title>
		<style type="text/css">
		*{
			font-size: 14pt;
			font-family: 'Roboto', sans-serif;
		}

		body{
			margin: 0;
			padding: 0;
		}

		.top{
			position: fixed;
			top: 0;
			left:0;
			width: 100%;
			height: 3rem;
			box-shadow: 0 -1rem 1rem 1rem #999999;
			background-color: white;
			z-index: 20;
			overflow: hidden;
		}

		.top *{
			top: 0;
			display: block;
			float: left;
		}

		.top a{
			font-style: normal;
			color: inherit;
		}

		.top .el{
			position: relative;
			padding: 1em;
			margin-left: 1em;
			transition: background-color 0.6s;
		}

		.top .el:hover{
			background-color: #f2f2f2;
		}

		.top .src{
			position: relative;
			padding: 1em;
			margin-left: 3em;
			border-bottom: 1px solid black;
		}

		.top .icon{
			width: 9rem;
			padding: auto 0;
			max-height: 3rem;
		}

		.top .icon *{
			align-content: center;
			max-height: 3rem;
		}

		.left{
			position: fixed;
			top: 0;
			left: 0;

			height: 100%;
			width: 9rem;
			padding-top: 4rem;
			background-color: white;
			box-shadow: -1rem 0 1rem 1rem #999999;
			z-index: 10;
			overflow-x: hidden;


		}

		.left *{
			word-wrap: normal;
		}

		.left a{
			padding: 1rem 3rem;
			font-style: normal;
			display: block;
			color: inherit;
		}
		.left a:hover{
			background-color: #f2f2f2;
			transition: background-color 0.6s;
		}
		.left p.headline{
			padding: 1rem 3rem;
			font-weight: 700;
			display: block;
			color: inherit;
		}

		.content{
            position: absolute;
            top:3.5rem;
            right:2rem;
            left: 11rem;
            padding-bottom: 9rem;
		}

		.content *{
			padding: 1em 1rem;
			margin: 0 2rem;
			background-color: #f3f2f2;
			box-shadow: 0 3px 7px #999999;
		}

		.content p{
			margin-top: 3rem;
			text-align: justify;
			text-align-last: left;
		}
		.content h1{
			font-size: 2em;
			margin-top: 5rem;
			text-align: center;
			
		}
		.content h2{
			font-size: 1.5em;
			margin-top: 4rem;
			text-align: center;
		}

		.content img{
			margin: 0 2rem;
			margin-top: 3rem;
			box-shadow: 0 3px 7px #999999;
			max-height: 10rem;

		}

		.content img.banner{
			margin: 0 2rem;
			margin-top: 2rem;
			max-height: 6rem;
			margin-bottom: -1rem;
			box-shadow: 0 3px 7px #999999;

		}

		.inline{
			display: flex;
			flex-direction: row;
			align-items: stretch;
            clear: both;
            text-align: center;

			min-height: 1rem;
			padding: 1rem 0;
			margin: 0;
		}
		.inline *{
			flex: 1; 
			line-height: 100%;
			padding: 0;
			margin: 0 1rem;
			box-shadow: none;
		}
	</style>
	</head>
	<body>
		<div class="top">
			<div class="icon">
				<a href="index.php">
					<img src="img/TGM_LogoQuadrat.png" alt="LOGO">
				</a>
			</div>
			<div class="el">
				<?php
					if(isset($_SESSION['istAngemeldet'])&&$_SESSION['istAngemeldet']==true){
						echo 'willkommen zurrueck '. $_SESSION['username'].'!';
					}
				?>
			</div>
			<?php
					if(isset($_SESSION['istAngemeldet'])&&$_SESSION['istAngemeldet']==true){
						echo '<a class="el" href="anmelden.php?an=1">abmelden</a>';
					}else{
						echo '<a class="el" href="anmelden.php">anmelden</a>';
					}
			?>
			<div class="el">
				<?php
					$date = getdate($_SERVER['REQUEST_TIME']);

					echo $date['mon'].".".$date['mday'].".".$date['year']."     ".$date['hours'].":".$date['minutes'].":".$date['seconds'].'';


				?>
					
			</div>

		</div>

		<div class="left">
			<p class="headline">Unsere Themen</p>
			<a href="index.php">Newz</a><br>
			<a href="kino2.php">Kino</a><br>
			<a href="test.php">Test</a>
		</div>

		<div class="content">
			
