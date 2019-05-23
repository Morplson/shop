<?php
include 'open.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/main.css">
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
	<?php
		$s = isset($_GET['s']) ? $_GET['s'] : null;
		$q = isset($_GET['q']) ? $_GET['q'] : null;
		include "menu/top-menu.php";
	?>

	<main id="content" class="content flex-container">
		<div id="main" class="content_r">
			<?php
				if($q != null){
					echo "ACTUNG: Querys werden erst beim DB-Store unterstützt!";
				}
			?>
		</div>
		<script type="text/javascript">

			document.addEventListener('DOMContentLoaded', function(){
				request("main",40,null,"new","<?php echo $s ?>")
			});


			document.onscroll = function(){
				if (document.documentElement.scrollTop + document.documentElement.clientHeight >= document.documentElement.scrollHeight-20){
					var last = document.getElementById("main").lastChild.id;
					request("main",40,last,"new","<?php echo $s ?>");
				}
			}


			function request(where, max, last, query, search){

				console.log("acc");
				//for (var i = num; i > 0; i--) {
					
					fetch("global/modul.php", {
						method: "POST",
						body: JSON.stringify({
							last: last,
							query: query,
							max: max,
							s:search
						}),
						headers:{
							'Content-Type': 'application/json'
						}
					}).then(function (response) {
						return response.text();
					}).then(function (data) {
						let html = data.trim();
						document.getElementById(where).innerHTML += html.trim();
					}).catch(function (error) {
						console.log('Request failed', error);
					});

					last = document.getElementById(where).lastChild.id;
				//}
			}


			function buy(id){
				let anzel = document.getElementById(id+"anzahl");
				let jsong = getCookie("articles");

				let buts = document.querySelectorAll("[id^='"+id+"button']");
				for (var i = buts.length - 1; i >= 0; i--) {
					buts[i].style.color = "#ff8c00";
				}
				
				
				let arr = JSON.parse(jsong);
				arr.push([id, anzel.value]);
				
				document.cookie = "articles="+JSON.stringify(arr);
			}

			function like(id){
				let jsong = getCookie("likes");

				let arr = JSON.parse(jsong);

				arr.push([id]);

				document.cookie = "likes="+JSON.stringify(arr);

				let buts = document.querySelectorAll("[id^='"+id+"likes']");

				for (var i = buts.length - 1; i >= 0; i--) {
					
					if (buts[i].style.color == "black") {
						buts[i].style.color = "#f91f1f";
						buts[i].querySelector(".favourites").innerHTML = Number(buts[i].querySelector(".favourites").innerHTML)+1;
					}else{
						buts[i].style.color = "black";
						buts[i].querySelector(".favourites").innerHTML = Number(buts[i].querySelector(".favourites").innerHTML)-1;
					}
					
				}

				fetch("global/like-script.php", {
					method: "POST",
					body: JSON.stringify({
						id: id
					}),
					headers:{
						'Content-Type': 'application/json'
					}
				}).then(function (response) {
					return response.text();
				}).then(function (data) {
					let html = data.trim();
					document.getElementById("content").innerHTML += html.trim();
				}).catch(function (error) {
					console.log('Request failed', error);
				});
			}

			function vote(id, vote){
				let jsong = getCookie("votes");

				let arr = JSON.parse(jsong);
				let d = indexOfArray([id,vote],arr);

				arr.push([id,vote]);

				let buts = document.querySelectorAll("[id^='"+id+"votes']");
				if(vote<0){
					for (var i = buts.length - 1; i >= 0; i--) {
						let a = document.createElement('div');
						a.style.color =  "#5aa51d";
						if (buts[i].style.color == "black") {
							buts[i].querySelector(".score").innerHTML = Number(buts[i].querySelector(".score").innerHTML)-1;
						}else if(buts[i].style.color == a.style.color){
							buts[i].querySelector(".score").innerHTML = Number(buts[i].querySelector(".score").innerHTML)-2;
						}
						buts[i].style.color = "#f91f1f";
					}
				}else if (vote>0) {
					for (var i = buts.length - 1; i >= 0; i--) {
						let a = document.createElement('div');
						a.style.color =  "#f91f1f";
						if (buts[i].style.color == "black") {
							buts[i].querySelector(".score").innerHTML = Number(buts[i].querySelector(".score").innerHTML)+1;
						}else if(buts[i].style.color == a.style.color){
							buts[i].querySelector(".score").innerHTML = Number(buts[i].querySelector(".score").innerHTML)+2;
						}
						buts[i].style.color = "#5aa51d";
					}
				}
				
				document.cookie = "votes="+JSON.stringify(arr);

				fetch("global/vote-script.php", {
					method: "POST",
					body: JSON.stringify({
						id: id,
						vote: vote
					}),
					headers:{
						'Content-Type': 'application/json'
					}
				}).catch(function (error) {
					console.log('Request failed', error);
				});

			}

			function comment(id){
				let jsong = getCookie("comments");

				let buts = document.querySelectorAll("[id^='"+id+"comments']");
				for (var i = buts.length - 1; i >= 0; i--) {
					buts[i].style.color = "#9273d0";
				}
				
				let arr = JSON.parse(jsong);
				arr.push([id]);
				
				document.cookie = "comments="+JSON.stringify(arr);
				window.location.href = "global/post.php?id="+id+"#comment";


			}

			function indexOfArray(val, array) {
				var hash = {}, indexes = {}, i, j;
				for(i = 0; i < array.length; i++) {
					hash[array[i]] = i;
				}
				return (hash.hasOwnProperty(val)) ? hash[val] : -1;
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

			function requestkorb(where){
				let jsong = JSON.parse(getCookie("articles"));

				for (var i = jsong.length-1; i >= 0; i--) {
					
					fetch("global/wishlist.php", {
						method: "POST",
						body: JSON.stringify({
							last: jsong[i][0],
							anzl: jsong[i][1]
						}),
						headers:{
							'Content-Type': 'application/json'
						}
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

			function kaufabschluss() {
				let jsong = getCookie("articles");
				let arr = JSON.parse(jsong);

				for (var i = arr.length - 1; i >= 0; i--) {
					fetch("global/kaufabschluss.php", {
						method: "POST",
						body: JSON.stringify({
							id: arr[i][0],
							anzahl: arr[i][1]
						}),
						headers:{
							'Content-Type': 'application/json'
						}
					}).catch(function (error) {
						console.log('Request failed', error);
					});
				}

				document.cookie = "articles="+JSON.stringify([]);
				alert("Kauf erfolgreich abgeschlossen!\n");
				location.reload(); 


			}


		</script>
	</main>
	<?php
		include "menu/side-menu.php";
		include "menu/coinhive_footer.php";
	?>
</body>


</html>