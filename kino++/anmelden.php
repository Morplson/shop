<?php
include 'open.php';
		$messege="";

		if(isset($_GET['an'])){
			$_SESSION['istAngemeldet'] = false;
			$_SESSION['username'] = '';
		}

		if(isset($_POST['anmelden'])){
			if (isset($_POST['name'])&&isset($_POST['psw'])) {
				
				

				$sql = "SELECT * FROM user WHERE name='".$_POST['name']."'";
				// echo $sql;
				$result = mysqli_query($link, $sql);
  
				// Ergebnis der SQL-result auswerten
				$row =mysqli_fetch_assoc($result);

				if ($num_rows != 1){
					$meldung .= "nutzer unbekannt";
				}

				if ($_POST['psw']==$row['psw']&&$_POST['name']==$row['name']) {
					$_SESSION['username'] = $row['name'];
					$_SESSION['istAngemeldet'] = true;
				}else{

					$messege.= "Eingaben falsch/unbekannt";
				}

			}else{
				$messege = "Bitte alle Felder aus";
			}
		}

		if(isset($_POST['abbrechen'])){
			
		}

		
include 'anmelden-gui.php';

include 'close.php';


?>