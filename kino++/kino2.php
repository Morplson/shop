<?php

	include 'open.php';

	// 2.) Aufrufart unterscheiden,
	//     Eingaben prüfen und ggfs. Fehlermeldung anzeigen,
	//     Eingaben verarbeiten und ggfs. Hinweismeldung anzeigen

	if (isset($_POST['loeschen'])) {
		if (!isset($_POST['m'])) {
			$meldung .= 'Bitte markieren Sie den zu l&ouml;schenden Datensatz!' . $brnl;
		} else {
			
			// Markierten Datensatz löschen
			$sql = 'DELETE FROM kino WHERE knr=' . $_POST['m'];
			// echo $sql;
			$result = mysqli_query($link, $sql);

			// Ergebnis der SQL-Anweisung auswerten
			$affected_rows = mysqli_affected_rows($link);
			if ($affected_rows == 1) {
				$meldung .= 'Der Datensatz wurde erfolgreich gel&ouml;scht!' . $brnl;
			} else {
				$meldung .= 'Der Datensatz konnte nicht gel&ouml;scht werden!' . $brnl;
			}
		}
	}
				
	if (isset($_POST['speichern'])) {
		if ($_POST['kname'] == '' || $_POST['bes'] == '' || $_POST['strasse'] == '' || $_POST['haus'] == '' || $_POST['tuer'] == '' || $_POST['tnr'] == '' || $_POST['email'] == '') {
			$meldung .= 'Bitte geben Sie die zu speichernden Daten vollst&auml;ndig ein!' . $brnl;
		} else {
			
			// Eingegebene Daten speichern
			$sql = 'INSERT INTO kino (kname,bes,strasse,haus,tuer,tnr,email) VALUES (' . "'"
				 . $_POST['kname'] . "', '"
				 . $_POST['bes'] . "', '"
				 . $_POST['strasse'] . "', '"
				 . $_POST['haus'] . "', '"
				 . $_POST['tuer'] . "', '"
				 . $_POST['tnr'] . "', '"
				 . $_POST['email'] . "')";
			// echo $sql;
			$result = mysqli_query($link, $sql);

			// Ergebnis der SQL-Anweisung auswerten
			$affected_rows = mysqli_affected_rows($link);
			if ($affected_rows == 1) {
				$meldung .= 'Der Datensatz wurde erfolgreich gespeichert!' . $brnl;
			} else {
				$meldung .= 'Der Datensatz konnte nicht gespeichert werden!' . $brnl;
			}
		}
	}

	// 3.) Tabelle mit den vorhandenen Datensätzen generieren,
	//     Datensatz markierbar mittels Radio-Button,
	//     Submit-Button zum Löschen des markierten Datensatzes,

	// Vorhandene Datensätze lesen
	$sql = 'SELECT * FROM kino';
	// echo $sql;
	$result = mysqli_query($link, $sql);
  
	// Ergebnis der SQL-Anweisung auswerten
	$num_rows = mysqli_num_rows($result);
	//echo $num_rows . ' Eintr&auml;ge vorhanden';
  
	for ($i = 1; $i <= $num_rows; $i++) {
		$row = mysqli_fetch_assoc($result);

		$ausgabe .= '<div class="inline">' . $nl;
		$ausgabe .=   '<div>';
		$ausgabe .=     '<input type="radio" name="m" value="' . $row['knr'] . '">';
		$ausgabe .=   '</div>' . $nl;
		$ausgabe .=   '<div>';
		$ausgabe .=      $row['knr'];
		$ausgabe .=   '</div>' . $nl;
		$ausgabe .=   '<div>';
		$ausgabe .=      $row['kname'];
		$ausgabe .=   '</div>' . $nl;
		$ausgabe .=   '<div>';
		$ausgabe .=      $row['bes'];
		$ausgabe .=   '</div>' . $nl;
		$ausgabe .=   '<div>';
		$ausgabe .=      $row['strasse']." ".$row['haus']."/".$row['tuer'];
		$ausgabe .=   '</div>' . $nl;
		$ausgabe .=   '<div>';
		$ausgabe .=      $row['tnr'];
		$ausgabe .=   '</div>' . $nl;
		$ausgabe .=   '<div>';
		$ausgabe .=      $row['email'];
		$ausgabe .=   '</div>' . $nl;
		$ausgabe .= '</div>' . $nl;
	}
include 'kino2-gui.php';

include 'close.php';
?>


