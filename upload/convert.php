<?php
	if ( 0 < $_FILES['file']['error'] ) {
        //echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }else {
    	echo json_encode($_FILES['file']['name'][0]);
    	if(false === $ext = array_search(
        	$finfo->file($_FILES['file']['tmp_name']),
        	array(
            	'jpg' => 'image/jpeg',
            	'png' => 'image/png',
            	'gif' => 'image/gif',
        	),
        	true
    	)) {
    		echo json_encode($_FILES['file']['name']);
    	}
        
    }



?>