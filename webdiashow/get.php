<?php
	$times = isset($_POST['times']) ? $_POST['times'] : null;
	$folders = isset($_POST['folder']) ? $_POST['folder'] : null;

	$images = array();
	foreach ($folders as $folde) {
		//$folde = json_decode($folde);
		$images = array_merge(array_merge(glob($folde . "/*.webm"),glob($folde . "/*.mp4"),glob($folde . "/*.jpg"),glob($folde . "/*.png"),glob($folde . "/*.gif")), $images);
	}
			
	shuffle($images);
	$picty = array('gif','jpg','jpeg','png');
	$vidty = array('mp4','webm');
			
	$i=0;
	foreach($images as $image){
		if($i<$times){
				
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
				echo "<div><video src=\"" . $image . "\" loop controls></video></div>";
			}
			if(strpos($image, 'webm') !== false) {
				echo "<div><video src=\"" . $image . "\" loop controls></video></div>";
			}
			$i++;
		}
				
	}
		
?>