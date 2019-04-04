<?php

    include "../vendor/Shop.php";

    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title'], ENT_QUOTES, "UTF-8") : null;
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description'], ENT_QUOTES, "UTF-8") : null;
    $preis = isset($_POST['preis']) ? htmlspecialchars($_POST['preis'], ENT_QUOTES, "UTF-8") : null;
    $gewicht = isset($_POST['gewicht']) ? htmlspecialchars($_POST['gewicht'], ENT_QUOTES, "UTF-8") : null;
    $anzahl = isset($_POST['anzahl']) ? htmlspecialchars($_POST['anzahl'], ENT_QUOTES, "UTF-8") : null;
    $einheit = (isset($_POST['einheit'])&&$_POST['einheit']!="") ? htmlspecialchars($_POST['einheit'], ENT_QUOTES, "UTF-8") : 'Stk.';

    $error = "";

    if($title==null||$anzahl==null||$preis==null||$description==null){
        $error .= "Failed to upload <br>No inputs given <br>";
        header( "refresh:1;url=../" );
        goto end;
    }else{
        $anon = isset($_POST['anon']) ? $_POST['anon'] : null;

        $userID=0;
        if(($anon||$anon==null)||(!isset($_SESSION['istAngemeldet'])||$_SESSION['istAngemeldet']==false)){
            $error .= "Kein Nutzer Angemeldet<br>";
            header( "refresh:1;url=../" );
            #goto end; -----------------------------------------------------------------------------------
        }else{
            $userID=$_SESSION['userid'];
        }

    
        $produkt = new Produkt($title, $description, $preis, $gewicht, $userID, $anzahl, $einheit);

        if ( 0 < $_FILES['file']['error'][0] ) {
            $error .= 'Error when uploading file <br> Error: ' . $_FILES['file']['error'][0] . '<br>';
            header( "refresh:2;url=../" );
            #goto end; -----------------------------------------------------------------------------------
        }else {
            #echo json_encode($_FILES['file']['name'][0]);

            mkdir('../global/data/'.md5($produkt->getSerialnumber()));                     #erstelle gehashtes dir
            $j=1;

            foreach ($_FILES['file']['tmp_name'] as $fileone) {
                if(in_array(mime_content_type($fileone),array('image/jpeg','image/png'))) {
                    move_uploaded_file ($fileone, '../global/data/'.md5($produkt->getSerialnumber())."/$j.png");  #lädt file hoch
                    $j++;
                } else {
                    if(strlen($fileone)>0){
                        $error .= 'Error: Unsupported type!<br>';
                        header( "refresh:2;url=../" );
                        goto end;
                        
                    }
                    
                }
            }

            $lines = file("../global/data/data.txt");
            if(explode("|||",$lines[0])[0]){
                $id = explode("|||",$lines[0])[0]+1;
            }else{
                $id = 1;
            }
            
            $data =  $id."rna55df|||".$userID."benutzer|||".$produkt->getSerialnumber()."|||".$produkt->getAnzahl()."|||".$produkt->getName()."|||".$produkt->getPreis()."|||".$produkt->getBezeichnung()."|||".$produkt->getEinheit()."|||".$produkt->getGewicht()."|||".$produkt->getUID()."|||".$produkt->getScore()."|||".$produkt->getLikes()."|||".$produkt->getComments().PHP_EOL; 

            $fileContents = file_get_contents("../global/data/data.txt");   

            file_put_contents("../global/data/data.txt", $data . $fileContents);
        }

        

        
    }
    header( "refresh:5;url=../" );

    end:
        


    
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro:900&amp;subset=latin-ext" rel="stylesheet"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 

        <title>Upload</title>
        <style type="text/css">
            *{
                font-size: 16pt;
                font-family: 'Raleway', sans-serif;
                scroll-behavior: smooth;
            }

            body{
                x-overflow: hidden;
                padding: 0;
                margin: 0;
            }
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
                color:  #7ece80;
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
                padding: 0 12.5%;
            }


            .loader {
                margin: 0 auto;
                border: 0.25rem solid #E8E8E8;
                border-radius: 50%;
                border-top: 0.25rem solid #5aa51d;
                width: 6rem;
                height: 6rem;
                -webkit-animation: spin 2s linear infinite;
                animation: spin 2s linear infinite;
            }

            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .loaderbar {
                background-color: #5aa51d;
                height: 100%;
                width: 0%;
                -webkit-animation: strech 5.5s linear infinite;
                animation: strech 5.5s linear infinite;
            }

            .loading {
                margin: 0 auto;
                border: 0.25rem solid #E8E8E8;
                background-color: #E8E8E8;
                width: 25rem;
                height: 2.5rem;
                
            }

            @-webkit-keyframes strech {
                10% { width: 20%; }
                30% { width: 35%; }
                50% { width: 43%; }
                51% { width: 46%; }
                70% { width: 65%; }
                90% { width: 80%; }
                100% { width: 100%; }
            }


            @keyframes strech {
                10% { width: 20%; }
                30% { width: 35%; }
                50% { width: 43%; }
                51% { width: 46%; }
                70% { width: 65%; }
                90% { width: 80%; }
                100% { width: 100%; }
            }



        </style>
    </head>


    <body>
        <main class="x0x342">
            <h1>Boorushop-Uploader</h1>
            
            <?php if($error == ""): ?>
                
                <h1 id="uploding">uploding</h1>
                
                <div class="loader"></div>
                <br>
                <div class="loading">
                    <div class="loaderbar"></div>
                </div>
            <?php else: ?>
                <br>
                <br>
                <div class="danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>


        </main>
    </body>
    <script type="text/javascript">
        var e = document.getElementById("uploding");
        var i=-1;
        var r = setInterval(() => {
            i++;
            switch (i){
                case 0:
                    e.innerHTML = "uploding";
                    break;
                case 1:
                    e.innerHTML = "uploding.";
                    break;
                case 2:
                    e.innerHTML = "uploding..";
                    break;
                case 3:
                    e.innerHTML = "uploding...";
                    i=-1;
                    break;
                
            }

        },666);
    </script>
</html>