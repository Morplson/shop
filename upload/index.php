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
	</head>
	<body>

		<main class="x0x342">
			<h1>Upload Content.</h1>
		
			<div class="plain">
				Check you can upload the image
			</div>
			<div class="danger">
				Read the <a href="">site rules</a> and check our <a href="">do-not-post list</a> <br>

				Provide a useful source link, tag artist name and descriptive tags, and follow our rating/tagging guidelines. <br>

				Don't post content the artist doesn't want here (or shared in general), especially not content under a DNP listing. This includes commercial content. 
			</div>
			<br>
			<div class="plain">
				<input class="" id="tytle" type="text" name="tytle"></input>
				<input id="file" type="file" name="file"></input>
				<textarea  id="description" name="description"></textarea >
				<input id="image_anonymous" type="checkbox" name="anonymous"></input>
			</div>
			<?php
				$post_data = [
					'secret' => "SECRET-KEY", // <- Your secret key
					'token' => $_POST['coinhive-captcha-token'],
					'hashes' => 1024
				];

				$post_context = stream_context_create([
					'http' => [
						'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
						'method'  => 'POST',
						'content' => http_build_query($post_data)
					]
				]);

				$url = 'https://api.coinhive.com/token/verify';
				$response = json_decode(file_get_contents($url, false, $post_context));

				if ($response && $response->success) {
					// All good. Token verified!
				}
			?>
		</main>
		
		



	</body>
	<script type="text/javascript">
	    
	    function upload(){
			

			fetch(url, {
				method: 'post',
				headers: {
					"Content-type": "text/html"
				},
				body: body
			}).then(function (response) {
				return response.text();
			}).then(function (data) {
				//console.log(data);
				
	
			}).catch(function (error) {
				console.log('Request failed', error);
			});
	    }
	</script>
</html>