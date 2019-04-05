<?php

include '../open.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Upload</title>
		<style type="text/css">
			h1{
				font-size: 3rem;
			}
			.plain {
				text-align: justify;
				margin: 0.5rem 0;
				padding: 0 0.5rem;
			}

			.plain a{
				color: #305ee8;
				transition: color 0.6s;
			}

			.plain a:hover{
				color: #3869fa;
			}

			
			.danger {
				background-color: #ffdddd;
				border-left: 0.25rem solid #f44336;
				text-align: justify;
				margin: 0.5rem 0;
				padding: 0 0.5rem;
			}

			.danger a{
				color: #f44336;
				transition: color 0.6s;
			}

			.danger a:hover{
				color: #fb746a;
			}


			.success {
				background-color: #ddffdd;
				border-left: 0.25rem solid #4CAF50;
				text-align: justify;
				margin: 0.5rem 0;
				padding: 0 0.5rem;
			}

			.success a{
				color: #4CAF50;
				transition: color 0.6s;
			}

			.success a:hover{
				color: 	#7ece80;
			}


			.info {
				background-color: #e7f3fe;
				border-left: 6px solid #2196F3;
				text-align: justify;
				margin: 0.5rem 0;
				padding: 0 0.5rem;
			}

			.info a{
				color: #2196F3;
				transition: color 0.6s;
			}

			.info a:hover{
				color: #6abafb;
			}


			.warning {
				background-color: #ffffcc;
				border-left: 0.25rem solid #ffeb3b;
				text-align: justify;
				margin: 0.5rem 0;
				padding: 0 0.5rem;
			}

			.warning a{
				color: #ffeb3b;
				transition: color 0.6s;
			}

			.warning a:hover{
				color: #fff599;
			}



			.x0x342{
				padding: 1rem;
			}

			
		</style>
		<script type="text/javascript">

			function upload(){

				var data = new FormData();
				data.append('file', document.getElementById('file').files[0]);
				data.append('title', document.getElementById('title').value);
				data.append('description', document.getElementById('description').value);
				data.append('preis', document.getElementById('preis').value);
				data.append('gewicht', document.getElementById('gewicht').value);
				data.append('anzahl', document.getElementById('anzahl').value);
				data.append('einheit', document.getElementById('einheit').value);

				data.append('anon', document.getElementById('anonymous').value);




					fetch("upload-script.php", {
						method: 'post',
						body: data
					}).then(
						response => response.text()
					).then(
						success => console.log(success)
					).catch(function (error) {
						console.log('Request failed', error);
					});
			}

		</script>
	</head>

	<body>

		<main class="x0x342">
			<h1>Upload Content.</h1>
		
			<!--div class="plain">
				Check you can upload the image
			</div>
			<div class="danger">
				Read the <a href="">site rules</a> and check our <a href="">do-not-post list</a> <br>

				Provide a useful source link, tag artist name and descriptive tags, and follow our rating/tagging guidelines. <br>

				Don't post content the artist doesn't want here (or shared in general), especially not content under a DNP listing. This includes commercial content. 
			</div>
			<br-->
			<form  method="post" action="upload/upload-script.php" enctype="multipart/form-data" class="plain">
				<input style="width: 100%" placeholder="Titel" id="title" type="text" name="title"></input>
				<br>
				Bilder:<br>
				<input placeholder="Upload file" id="file" type="file" name="file[]"></input>
				<input placeholder="Upload file 2" id="file" type="file" name="file[]"></input>
				<input placeholder="Upload file 3" id="file" type="file" name="file[]"></input>
				<input placeholder="Upload file 4" id="file" type="file" name="file[]"></input>
				<input placeholder="Upload file 5" id="file" type="file" name="file[]"></input>

				<textarea style="resize: none; width: 100%;" id="description" name="description" maxlength="1200" placeholder="here goes your text!"></textarea>
				Text:<br>
				<input placeholder="Upload file" id="file" type="file" name="text"></input>
				<br><br>
				<input style="width: 80%" placeholder="Preis" id="preis" name="preis" type="number" step="0.01" max="1000000" min="0">€</input>
				<input style="width: 80%" placeholder="Gewicht" id="gewicht" name="gewicht" type="number" step="0.0001" max="1000000" min="0">Kg</input> 
				
				<input style="width: 46%" placeholder="Anzahl" id="anzahl" name="anzahl" min="0" max="1000000" type="number"></input>
				<input style="width: 46%" placeholder="Einheit" id="einheit" type="text" name="einheit"></input>
				<br>
				<button type="submit" onclick="upload()">sdfdf</button>
			</form>

		</main>


	</body>
	
</html>