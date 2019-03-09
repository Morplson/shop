<?php
include 'open.php';

	// 3.) Tabelle mit den vorhandenen Datensätzen generieren,
	//     Datensatz markierbar mittels Radio-Button,
	//     Submit-Button zum Löschen des markierten Datensatzes,

	// Vorhandene Datensätze lesen
	$sql = 'SELECT * FROM news';
	// echo $sql;
	$result = mysqli_query($link, $sql);
  
	// Ergebnis der SQL-Anweisung auswerten
	$num_rows = mysqli_num_rows($result);
	// echo $num_rows . ' Eintr&auml;ge vorhanden';
  
	for ($i = 1; $i <= $num_rows; $i++) {
		$row = mysqli_fetch_assoc($result);

		$ausgabe .= '<div>' . $nl;
		$ausgabe .=   '<div>';
		$ausgabe .=      $row['wann'];
		$ausgabe .=   '</div>' . $nl;
		$ausgabe .=   '<div>';
		$ausgabe .=      $row['was'];
		$ausgabe .=   '</div>' . $nl;
		$ausgabe .=   '<div>';
		$ausgabe .=      $row['wer'];
		$ausgabe .=   '</div>' . $nl;
		$ausgabe .= '</div>' . $nl;
	}
	
	// 4.) Verbindung zum DB-Server schließen
	mysqli_close($link);
	
	// 5.) Ausgabe im Browser anzeigen,
	//     zuvor vorbereitete Texte werden mit echo eingefügt.


	include 'index-gui.php';

include 'close.php';

?>