<?php
// Datum: 2016-02-11
// Autor: Nicht MARM
// Zweck: quick-and-dirty Test der Apache/MySQL/PHP-Konfiguration.
//        Die Datenbank 'kino' muss zuvor generiert werden und
//        für den Zugriff mit 'insy3', 'blabla' berechtigt werden.

include 'header-gui.php';
?>

		<h1>Kino-Verwaltung</h1>
<?php echo $meldung; ?>
		<h2>Vorhandene Einträge:</h2>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<div class="inline">
					<div>M</div>
					<div>Nr</div>
					<div>Name</div>
					<div>Beschreibung</div>
					<div>Adresse</div>
					<div>Telephon</div>
					<div>Email</div>


				</div>
<?php echo $ausgabe; ?>
			<br>
			<input type="submit" name="loeschen" value="L&ouml;schen">
		</form>
		<br>
		<h2>Neuer Eintrag:</h2>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			
				<div class="inline">
					<div>Name</div>
					<div>Beschreibung</div>
					<div>Adresse</div>
					<div>Telephon</div>
					<div>Email</div>
				</div>
				<div class="inline">
					<div>
						<input type="text" name="kname"
						 value="<?php if (isset($_POST['kname'])) echo $_POST['kname']; ?>">
					</div>
					<div>
						<input type="text" name="bes"
						 value="<?php if (isset($_POST['bes'])) echo $_POST['bes']; ?>">
					</div>
					<div>
						<input type="text" name="strasse"
						 value="<?php if (isset($_POST['strasse'])) echo $_POST['strasse']; ?>">

						<input type="number" name="haus"
						 value="<?php if (isset($_POST['haus'])) echo $_POST['haus']; ?>">

						<input type="number" name="tuer"
						 value="<?php if (isset($_POST['tuer'])) echo $_POST['tuer']; ?>">
					</div>
					<div>
						<input type="tel" name="tnr"
						 value="<?php if (isset($_POST['tnr'])) echo $_POST['tnr']; ?>">
					</div>
					<div>
						<input type="email" name="email"
						 value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
					</div>
				</div>
				<br>
			<input type="submit" name="speichern" value="Speichern">
		</form>
<?php
	include 'footer-gui.php';
?>