<?php
	include '../open.php';
	/**
	 * AUTHOR: DAVID ZEILINGER
	 * VERSION: 23_01_2019
	 * Laedt Daten(posts) aus datenbank
	 */

	#error_reporting(0);




	$id = isset($_GET['id']) ? $_GET['id'] : null;

	if ($id!=null) {
		$search = $id."rna55df|||";
		$line_number = false;

		if ($handle = fopen("data/data.txt", "r")) {
			$count = 0;
			while (($line = fgets($handle, 4096)) !== FALSE and !$line_number) {
				$count++;
				$line_number = (strpos($line, $search) !== FALSE) ? $count : $line_number;
			}
			fclose($handle);
		}
		
	} else {
		$line_number = 0;
	}
	
	$export = '';
	$lines = file("data/data.txt");
	
	$data = explode("|||",$lines[$line_number-1]);
	

	$pID = explode("rna55df",$data[0])[0];
	$link = $data[2];
	$anzahl = $data[3];
	$title = $data[4];
	$preis = $data[5];
	$description = $data[6];
	$einheit = $data[7];
	$gewicht = $data[8];
	$userID = $data[9];
	$score = $data[10];
	$likes = $data[11];
	$comments = $data[12];

	$images = array();
	if(is_dir("data/".md5($link))){

		foreach (glob("data/".md5($link)."/*.png") as $file) {
			$images[] = $file;
		}
	}


	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST['loeschen'])&&$_POST['loeschen']=='loeschen'){
			echo "l";

			$out = implode($lines);
			$out = str_replace($lines[$line_number-1], '', $out);
			file_put_contents("data/data.txt", $out);

			//header("Location:../");
		}elseif (isset($_POST['bearbeiten'])&&$_POST['bearbeiten']=='bearbeiten') {

			$lines = file_get_contents("../global/data/data.txt");
			
			$pattern = preg_quote($id."rna55df|||", '/');		

			$pattern = "/^.*$pattern.*\$/m";	

			if(preg_match_all($pattern, $lines, $matches)){
				$text = explode("|||", $matches[0][0]);
				$text[3] = $_POST['anzahl'];
				$text[4] = $_POST['title'];
				$text[5] = $_POST['preis'];
				$text[6] = $_POST['description'];
				$text[7] = $_POST['einheit'];
				
				$out = str_replace($matches[0][0], implode("|||" ,$text), $lines);
				file_put_contents("../global/data/data.txt", $out);

			}

			header("Refresh:0");
		}
	}
	

	if($id!=null&&isset($_SESSION['userid'])) {
		$lines = file_get_contents("data/like.txt");
		$pattern = preg_quote($id."postid|||".$_SESSION['userid']."userid|||", '/');		

		$pattern = "/^.*$pattern.*\$/m";
		if(preg_match_all($pattern, $lines, $matches)){
			$collikes = "#f91f1f";
		}else{
			$collikes = "black";
		}
	}

	if($id!=null&&isset($_SESSION['userid'])) {
		$lines = file_get_contents("data/vote.txt");
		$pattern = preg_quote($id."postid|||".$_SESSION['userid']."userid|||", '/');		

		$pattern = "/^.*$pattern.*\$/m";
		if(preg_match_all($pattern, $lines, $matches)){
			$like = explode("|||", $matches[0][0])[2];
			if($like==-1){
				$colvotes = "#f91f1f";
			}elseif($like==1){
				$colvotes = "#5aa51d";
			}else{
				$colvotes = "black";
			}
		}else{
			$colvotes = "black";
		}
	}
	
	if($id!=null&&isset($_SESSION['userid'])) {
		$lines = file_get_contents("data/like.txt");
		$pattern = preg_quote($id."postid|||".$_SESSION['userid']."userid|||", '/');		

		$pattern = "/^.*$pattern.*\$/m";
		if(preg_match_all($pattern, $lines, $matches)){
			$colcom = "#9273d0";
		}else{
			$colcom = "black";
		}
	}



?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
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
	<style type="text/css">
		*{
			font-size: 16pt;
			font-family: 'Raleway', sans-serif;
			scroll-behavior: smooth;
		}

		body{
			x-overflow: hidden;
			padding: 0.5rem;
			margin: 0;
		}
		.container{
			border: 1px solid #E8E8E8;
			height: auto;
			width: 100%;
			display: inline-block;
			position: relative;
			vertical-align: baseline;
			
		}

		picture.picture,a.picture{
			display: block;
			height: 25rem;
			width:100%;
			background-repeat: no-repeat;
			background-size: contain;
			background-position: center;
			padding: 0;
			margin: 0;
		}



		.values{
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

		.values.buy>.btn:hover, .values.buy>.num:hover, .hoverbutton:hover{
			background-color: #D8D8D8;
		}

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
				padding: 0.5rem 12.5%;
				word-break: break-word;
			}
			.description > textarea{
				width: 100%;
				height: 6rem;
			}

			.values.buy{
			}

			.values.buy>.btn{
				padding: 0 12.5%;
				background-color: transparent;
				border: none;

				height: 1.5rem;

				width: 6rem;
				float: left;

				transition: all 0.6s;
			}

			.values.buy>.num{
				padding: 0 12.5%;
				background-color: transparent;
				border: none;

				height: 1.5rem;

				float: right;
				width: 4rem;

				transition: all 0.6s;
			}

			.values.gets>.preis{
				float: left;
				padding-left: 12.5%;
			}

			.values.gets>.anzahl{
				float: right;
				padding-right: 12.5%;
				
			}

			.hoverbutton{
				height: 20rem;
				width: 2.5rem;

				border-radius: 0.125rem;
				background-color: #E8E8E8;

				line-height: 20rem;
				text-align: center;

				position: absolute;
				top: 50%;
				bottom: 50%;

				transform: translate(0, -50%);
				-ms-transform: translate(0, -50%);
				transition: all 0.6s;
				
			}

			.hoverbutton.right{
				right: 12.5%;
			}

			.hoverbutton.left{
				left: 12.5%;
			}

			.piccontainer {display:none;}

			.comments{
				margin-top: 1.5rem;
			}

			.comment{
				margin-top: 0.25rem;
			}

			.commentbox {
				text-align: justify;
				padding: 0.5rem 5%;
				word-break: break-word;
			}

		</style>
	</head>
	<body>

	<div class="container" id="<?php echo $pID; ?>">
		<div class="values scores">
			<div style="color: <?php echo $collikes; ?>" id="<?php echo $pID; ?>likes" class="like" onClick="like('<?php echo $pID; ?>')">
				<span class="fave-span" title="fave"><i class="fa fa-heart"></i></span>
				<span class="favourites" title="Favourites"><?php echo $likes; ?></span>
			</div>
			<div style="color: <?php echo $colvotes; ?>" id="<?php echo $pID; ?>votes" class="vote">
				<i class="upvote fa fa-arrow-up" title="Upvote" onClick="vote('<?php echo $pID; ?>',1)"></i>
				<span class="score" title="Score"><?php echo $score; ?></span>
				<i class="downvote fa fa-arrow-down" title="Downvote" onClick="vote('<?php echo $pID; ?>',-1)"></i>
			</div>
			<div style="" id="<?php echo $pID; ?>comments" class="comment" onClick="comment('<?php echo $pID; ?>')">
				<i class="fa fa-comments"></i>
				<span class="comments_count" data-image-id="<?php echo $pID; ?>"><?php echo $comments; ?></span>
			</div>
		</div>




<?php
	if($_SESSION['userid']."benutzer"==$data[1]):
?>

<form  method="post"  enctype="multipart/form-data" action="post.php?id=<?php echo $id; ?>">

				
		<div class="description">
			
		</div>
		<div>
			<?php
				if(count($images)>1):
			?>
				<div class="hoverbutton left" onclick="plusDivs(-1)"><i class="fas fa-angle-left"></i></div>
				<div class="hoverbutton right" onclick="plusDivs(1)"><i class="fas fa-angle-right"></i></div>
			<?php 
				endif;	

				$j = 0;
				foreach ($images as $imgLink):
			?>
				<a class="picture piccontainer" href="<?php echo $imgLink; ?>">
					<picture id="<?php echo $j; ?>picture" class="picture" style="background-image: url('<?php echo $imgLink; ?>');">
					</picture>
				</a>
			<?php
				$j++;
				endforeach; 
			?>		
		</div>

	<div class="values buy">
		<button class="btn" id="<?php echo $pID; ?>button" onClick="buy('<?php echo $pID; ?>')">Kaufen</button>
		<input class="num" id="<?php echo $pID; ?>anzahl" type="number" name="anzahl" min="1" max="<?php echo $anzahl; ?>" value="1">
	</div>
		
		<div class="description">
			<div class="input1">
				<input class="inputfield" type="text" type="text" name="title" value="<?php echo $title; ?>" placeholder="">
				<label>Titel</label>
				<span class="focus-bg"></span>
			</div>
			<div class="input1">
				<input class="inputfield" id="preis" name="preis" min="0" max="1000000" type="number" placeholder="" value="<?php echo $preis; ?>">
				<label>Preis in €</label>
				<span class="focus-bg"></span>
			</div>

			<div style="width: 50%" class="input1">
				<input class="inputfield" id="anzahl" name="anzahl" min="0" max="1000000" type="number" placeholder="" value="<?php echo $anzahl; ?>">
				<label>Anzahl</label>
				<span class="focus-bg"></span>
			</div>

			<div style="width: 50%" class="input1">
				<input class="inputfield" id="einheit" type="text" name="einheit" placeholder="" value="<?php echo $einheit; ?>">
				<label>Einheit</label>
				<span class="focus-bg"></span>
			</div>
		
			<div class="input1">
				<textarea id="comtext" style="resize: none;" class="inputfield" type="text" id="description" name="description" maxlength="1200" placeholder=""><?php echo $description; ?></textarea>
				<label>Beschreibung</label>
				<span class="focus-bg"></span>
			</div>
		</div>
		
	</div>
	<button class="submitbutton" type="submit" name="bearbeiten" value="bearbeiten">Bearbeiten</button>
	<button class="submitbutton" type="submit" name="loeschen" value="loeschen">Löschen</button>
</form>

<?php
	else:
?>


			
	<div class="values title">
		<?php echo $title; ?>
	</div>
	<div>
		<?php if(count($images)>1): ?>
			<div class="hoverbutton left" onclick="plusDivs(-1)"><i class="fas fa-angle-left"></i></div>
			<div class="hoverbutton right" onclick="plusDivs(1)"><i class="fas fa-angle-right"></i></div>
		<?php 
			endif;

			$j = 0;
			foreach ($images as $imgLink):
		?>
			<a class="picture piccontainer" href="<?php echo $imgLink; ?>">
				<picture id="<?php echo $j; ?>picture" class="picture" style="background-image: url('<?php echo $imgLink; ?>');">
				</picture>
			</a>
		<?php
			$j++;
			endforeach; 
		?>		
	</div>
	
	<div class="values gets">
		<div class="preis">
			Preis: <?php echo $preis; ?>€
		</div>
		<div class="anzahl">
			<?php echo $anzahl." ".$einheit; ?>
		</div>
	</div>
	<div class="description">
		<?php echo $description; ?>
	</div>
	<div class="values buy">
		<button class="btn" id="<?php echo $pID; ?>button" onClick="buy('<?php echo $pID; ?>')">Kaufen</button>
		<input class="num" id="<?php echo $pID; ?>anzahl" type="number" name="anzahl" min="1" max="<?php echo $anzahl; ?>" value="1">
	</div>
</div>

<?php
	endif;
?>




<a id="comment"></a>
<div class="container comments">
	<div class="values">
		Kommentare
	</div>
	<div class="commentbox">

		<div class="container comment">
			<div class="values">
				Dein Kommentar
			</div>
			<div class="description">
				<div class="input1">
					<input class="inputfield" type="text" id="comtitle" type="text" name="title" placeholder="">
					<label>Titel</label>
					<span class="focus-bg"></span>
				</div>

				<div class="input1">
					<textarea id="comtext" style="resize: none;" class="inputfield" type="text" id="description" name="text" maxlength="1200" placeholder=""></textarea>
					<label>Kommentar</label>
					<span class="focus-bg"></span>
				</div>
				
				<div class="submitbutton" onclick="post(<?php echo $pID; ?>)">Post</div>
			</div>
			
		</div>

		<?php
			
			if($id!=null) {
				$lines = file_get_contents("data/comment.txt");
				$pattern = preg_quote($id."postid|||", '/');		

				$pattern = "/^.*$pattern.*\$/m";
				if(preg_match_all($pattern, $lines, $matches)){
					foreach ($matches[0] as $line) {	
						$text = explode("|||", $line);

						?>

						<div class="container comment">
							<div class="values title">
								<?php echo $text[2]; ?>
							</div>
							<div class="description">
								<?php echo $text[3]; ?>
							</div>
						</div>

						<?php
					}
				}
			}		
		?>

	</div>
</div>



<script>
			function post(id){
				let title = document.getElementById("comtitle").value;
				let text = document.getElementById("comtext").value;
				
				fetch("comment-script.php", {
					method: "POST",
					body: JSON.stringify({
						id: id,
						title: title,
						text: text
					}),
					headers:{
						'Content-Type': 'application/json'
					}
				}).catch(function (error) {
					console.log('Request failed', error);
				});
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

			var slideIndex = 1;
			showDivs(slideIndex);

			function plusDivs(n) {
				showDivs(slideIndex += n);
			}

			function showDivs(n) {
				var i;
				var x = document.getElementsByClassName("piccontainer");
				if (n > x.length) {slideIndex = 1}
				if (n < 1) {slideIndex = x.length}
				for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";  
				  }
				x[slideIndex-1].style.display = "block";  
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

				let buts = document.querySelectorAll("[id^='"+id+"likes']");
				for (var i = buts.length - 1; i >= 0; i--) {
					buts[i].style.color = "#f91f1f";
				}

				let arr = JSON.parse(jsong);
				arr.push([id]);
				

				fetch("like-script.php", {
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

				let buts = document.querySelectorAll("[id^='"+id+"votes']");
				if(vote<0){
					for (var i = buts.length - 1; i >= 0; i--) {
						buts[i].style.color = "#f91f1f";
					}
				}else if (vote>0) {
					for (var i = buts.length - 1; i >= 0; i--) {
						buts[i].style.color = "#5aa51d";
					}
				}
				
				
				let arr = JSON.parse(jsong);
				arr.push([id,vote]);
				
				document.cookie = "votes="+JSON.stringify(arr);

				fetch("vote-script.php", {
					method: "POST",
					body: JSON.stringify({
						id: id,
						vote: vote
					}),
					headers:{
						'Content-Type': 'application/json'
					}
				}).then(function (response) {
					return response.text();
				}).then(function (data) {
					let html = data.trim();
					document.getElementById("comment").innerHTML += html.trim();
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
				window.location.replace("post.php?id="+id+"#comment");


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
					
					fetch("wishlist.php", {
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
</script>

</body>
</html>
