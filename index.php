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
		document.cookie = "articles="+JSON.stringify([]);
	</script>
	<title>Railway</title>




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

		picture{
			display: block;
			height: 12rem;
			width: 13.5rem;
			display: inline-block;
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

		.content_l .container{
			width: 97%;
			height: auto;

			margin: 0.25rem -1px;
		}

		.values.buy>.btn:hover, .values.buy>.num:hover{
			background-color: #D8D8D8;
		}

	</style>

</head>
<body>
	<?php
		include "menu/top-menu.php";
	?>

	<main id="content" class="content flex-container">
		<aside class="content_l">
			<div id="trend" class="container">
				<div class="values">
					Beliebte Produkte
				</div>
			</div>
			<script type="text/javascript">
				document.addEventListener('DOMContentLoaded', function(){
					request("trend",8,null,"top")
				});
			</script>
			<div id="comment" class="container">
				<div class="values">
					Recent Comments
				</div>
			</div>
		</aside>	
		<div id="main" class="content_r">
			
		</div>
		<script type="text/javascript">

			document.addEventListener('DOMContentLoaded', function(){
				request("main",40,null,"new")
			});


			document.onscroll = function(){
				if (document.documentElement.scrollTop + document.documentElement.clientHeight >= document.documentElement.scrollHeight-20){
					var last = document.getElementById("main").lastChild.id;
					request("main",40,last,"new");
				}
			}


			function request(where, num, last, query){

				console.log("acc");
				for (var i = num; i > 0; i--) {
					last++;
					fetch("global/modul.php", {
						method: 'post',
						headers: {
							"Content-type": "text/html"
						},
						body: JSON.stringify({last: last, query: query})
					}).then(function (response) {
						return response.text();
					}).then(function (data) {
						let html = data.trim();
						document.getElementById(where).innerHTML += html.trim();
					}).catch(function (error) {
						console.log('Request failed', error);
					});
				}
			}


			function buy(id){

				let anzel = document.getElementById(id+"anzahl");
				let jsong = getCookie("articles");

				document.getElementById(id+"button").style.color = "#ff8c00";


				let arr = JSON.parse(jsong);

				arr.push([id, anzel.value]);

				document.cookie = "articles="+JSON.stringify(arr);

				//alert(getCookie("articles"));
			}


			function getCookie(cname) {
				var name = cname + "=";
				var decodedCookie = decodeURIComponent(document.cookie);
				var ca = decodedCookie.split(';');
				for(var i = 0; i <ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') {
						c = c.substring(1);
					}
					if (c.indexOf(name) == 0) {
						return c.substring(name.length, c.length);
					}
				}
				return "";
			}

		</script>
	</main>
	<?php
		include "menu/side-menu.php";
		include "menu/coinhive_footer.php";
	?>
</body>


</html>