<?php

include '../open.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Upload</title>
		<style type="text/css">


			
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
				<div class="input1">
					<input class="inputfield" type="text" id="title" type="text" name="title" placeholder="">
					<label>Titel</label>
					<span class="focus-bg"></span>
				</div>
				<br>
				Bilder:<br>
				<input placeholder="Upload file" id="file" type="file" name="file[]"></input>
				<input placeholder="Upload file 2" id="file" type="file" name="file[]"></input>
				<input placeholder="Upload file 3" id="file" type="file" name="file[]"></input>
				<input placeholder="Upload file 4" id="file" type="file" name="file[]"></input>
				<input placeholder="Upload file 5" id="file" type="file" name="file[]"></input>
				<br>
				<div class="input1">
					<textarea style="resize: none;" class="inputfield" type="text" id="description" name="description" maxlength="1200" placeholder=""></textarea>
					<label>Deine Produktbeschreibung</label>
					<span class="focus-bg"></span>
				</div>
				<br>Text:<br>
				<input placeholder="Upload file" id="file" type="file" name="text"></input>
				<br>
				
				<div class="input1">
					<input class="inputfield" id="preis" name="preis" type="number" step="0.01" max="1000000" min="0" placeholder="">
					<label>Preis in €</label>
					<span class="focus-bg"></span>
				</div>
				<div class="input1">
					<input class="inputfield" id="gewicht" name="gewicht" type="number" step="0.0001" max="1000000" min="0" placeholder="">
					<label>Gewicht in Kg</label>
					<span class="focus-bg"></span>
				</div>
				
				<div style="width: 50%" class="input1">
					<input class="inputfield" id="anzahl" name="anzahl" min="0" max="1000000" type="number" placeholder="">
					<label>Anzahl</label>
					<span class="focus-bg"></span>
				</div>

				<div style="width: 50%" class="input1">
					<input class="inputfield" id="einheit" type="text" name="einheit" placeholder="">
					<label>Einheit</label>
					<span class="focus-bg"></span>
				</div>

				<br>
				<br>
				<button type="submit" onclick="upload()">Posten</button>
			</form>

		</main>


	</body>
	
</html>