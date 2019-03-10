<?php

    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $anon = isset($_POST['anon']) ? $_POST['anon'] : null;
    

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }else {
        echo json_encode($_FILES['file']['name'][0]);
        if($_FILES['file']['mime'] != 'image/jpeg' || $_FILES['file']['mime'] != 'image/png') {
            move_uploaded_file ($_FILES['file']['tmp_name'], 'upload/'.$_FILES['file']['name']);
        }
    }


    


    $fp = fopen('../global/produkte.json', 'w');
    fwrite($fp, json_encode($response));
    fclose($fp);



?>