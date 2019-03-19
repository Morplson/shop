<?php
    include "../vendor/Shop.php";

    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $preis = isset($_POST['preis']) ? $_POST['preis'] : null;
    $gewicht = isset($_POST['gewicht']) ? $_POST['gewicht'] : null;
    $anzahl = isset($_POST['anzahl']) ? $_POST['anzahl'] : null;
    $einheit = isset($_POST['einheit']) ? $_POST['einheit'] : 'Stk.';
    var_dump($_POST);
    var_dump($_FILES);


    if($title==null||$anzahl==null||$preis==null||$description==null){
        echo "\nfailed to upload\n";
    }else{
        $anon = isset($_POST['anon']) ? $_POST['anon'] : null;

        $userID=0;
        if(($anon||$anon==null)||(!isset($_SESSION['istAngemeldet'])||$_SESSION['istAngemeldet']==false)){
            $userID=0;
        }else{
            $userID=$_SESSION['userid'];
        }

    
        $produkt = new Produkt($title, $description, $preis, $gewicht, $userID, $anzahl, $einheit);

        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
            exit();
        }else {
            echo json_encode($_FILES['file']['name'][0]);
            if($_FILES['file']['mime'] != 'image/jpeg' || $_FILES['file']['mime'] != 'image/png') {
                move_uploaded_file ($_FILES['file']['tmp_name'], '../global/data/'.md5($produkt->getSerialnumber()).".png");
            }
        }

        $data = $produkt->getSerialnumber().";".$produkt->getAnzahl().";".$produkt->getName().";".$produkt->getPreis().";".$produkt->getBezeichnung().";".$produkt->getEinheit().";".$produkt->getGewicht().";".$produkt->getUID().";".$produkt->getScore().";".$produkt->getLikes().";".$produkt->getComments().";".PHP_EOL;

        $fp = fopen("../global/data/data.txt", 'a');
        fwrite($fp, $data);
        
    }
    header('Location: ../');


    
?>