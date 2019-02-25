<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title></title>
	<style type="text/css">
		body{
			padding: 0;
			margin: 0;
			overflow: hidden;
		}
		#slideshow img{
		    position: fixed;
    		top: 0;
    		bottom: 0;
    		left: 0;
    		right: 0;
    		max-width: 100%;
    		height: 100%;
    		margin: auto;
    		overflow: auto;
		}
		#slideshow video{
		    position: fixed;
    		top: 0;
    		bottom: 0;
    		left: 0;
    		right: 0;
    		max-width: 100%;
    		height: 100%;
    		margin: auto;
    		overflow: auto;
		}

	</style>

<script type="text/javascript">
	var hold = false;




	$(document).ready(function(){


		var folders =	<?php 
							$folder = array("img/This","img/reddit_sub_ClopClop","img/reddit_sub_crotchtits","img/reddit_sub_FapFap","img/reddit_sub_fillyfiddlers","img/reddit_sub_mouthhugs","img/reddit_sub_TrueClop","img/reddit_sub_AnthroClop","img/Pony","img/Diggs","img/homegrown","img/Album 1","img/Clop/Anlogi");
							
							//$files = array();
							//foreach($folder as $dir){
							//	$files[] = glob($dir . "/*");
							//}
							//
							//foreach($files as $file){
							//	if(is_dir($file)){
							//		$folder[] = $file;
							//	}
							//}
							
							echo json_encode($folder);
							
							
							
						?>;






		$(document).keypress(function(event){
			switch(event.key){
				case "ArrowRight":
					nextSlide();
					break;
				case "ArrowLeft":
					lastSlide();
					break;
				case " ":
					if(hold){
						hold = false;
					}else{
						hold = true;
					}
					break;
				default:
					break;
			}
		});

		$("#slideshow > div:gt(0)").hide();

		setInterval(function() { 
			if(!hold){
				nextSlide();

			}
 		},  5000);


	});

	function nextSlide() {
		$('#slideshow > div:first').fadeOut(1000).next().fadeIn(1000).end().appendTo('#slideshow');
	}

	function lastSlide() {
		$('#slideshow > div:first').fadeOut(1000);
		$('#slideshow > div:last').fadeIn(1000).prependTo('#slideshow');
	}




</script>
</head>
<body>
	<div id="slideshow">
		<?php
			$images = array();
			foreach ($GLOBALS['folder'] as $folde) {
				$images = array_merge(array_merge(glob($folde . "/*.webm"),glob($folde . "/*.mp4"),glob($folde . "/*.jpg"),glob($folde . "/*.png"),glob($folde . "/*.gif")), $images);
			}
			
			shuffle($images);
			$picty = array('gif','jpg','jpeg','png');
			$vidty = array('mp4','webm');
			
			$i=0;
			foreach($images as $image){
				if($i<=1000){
				
					if (strpos($image, 'gif') !== false) {
						echo "<div><img src=\"" . $image . "\"></img></div>";
					}
					if (strpos($image, 'jpg') !== false) {
						echo "<div><img src=\"" . $image . "\"></img></div>";
					}
					if (strpos($image, 'jpeg') !== false) {
						echo "<div><img src=\"" . $image . "\"></img></div>";
					}
					if (strpos($image, 'png') !== false) {
						echo "<div><img src=\"" . $image . "\"></img></div>";
					}
					
					
					if(strpos($image, 'mp4') !== false) {
						echo "<div><video src=\"" . $image . "\"></video></div>";
					}
					if(strpos($image, 'webm') !== false) {
						echo "<div><video src=\"" . $image . "\"></video></div>";
					}
					$i++;
				}
				
			}
		
		?>
	</div>
</body>
</html>

