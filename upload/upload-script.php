<?php
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }else {
        echo json_encode($_FILES['file']['name'][0]);
        if($_FILES['file']['mime'] != 'image/jpeg' || $_FILES['file']['mime'] != 'image/png') {
            move_uploaded_file ($_FILES['file']['tmp_name'], 'upload/'.$_FILES['file']['name']);
        }
    }



?>