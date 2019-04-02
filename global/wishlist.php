<?php
	/**
	 * AUTHOR: DAVID ZEILINGER
	 * VERSION: 23_01_2019
	 * Laedt Daten(posts) aus datenbank
	 */

	error_reporting(0);

	
	$_POST = json_decode(file_get_contents('php://input'), true);



	$last = isset($_POST['last']) ? $_POST['last'] : null;
	$anzl = isset($_POST['anzl']) ? $_POST['anzl'] : null;
	
	$likes = 0;
	$score = 0;
	$comments = 0;

	$pID = rand();//$last;
	
	$title = "Titel";

	$imgLink = null;

	$description = "

▓█████▄  ▄▄▄    ██▒   █▓ ██▓▓█████▄ 
▒██▀ ██▌▒████▄ ▓██░   █▒▓██▒▒██▀ ██▌
░██   █▌▒██  ▀█▄▓██  █▒░▒██▒░██   █▌
░▓█▄   ▌░██▄▄▄▄██▒██ █░░░██░░▓█▄   ▌
░▒████▓  ▓█   ▓██▒▒▀█░  ░██░░▒████▓ 
 ▒▒▓  ▒  ▒▒   ▓▒█░░ ▐░  ░▓   ▒▒▓  ▒ 
 ░ ▒  ▒   ▒   ▒▒ ░░ ░░   ▒ ░ ░ ▒  ▒ 
 ░ ░  ░   ░   ▒     ░░   ▒ ░ ░ ░  ░ 
   ░          ░  ░   ░   ░     ░    
 ░                  ░        ░      

";

	$anzahl = 0;

	$einheit = "Stk.";

	$preis = 0;




	if ($last!=null) {
		$search = $last."rna55df|||";
		$line_number = false;

		if ($handle = fopen("data/data.txt", "r")) {
			$count = 0;
			while (($line = fgets($handle, 4096)) !== FALSE and !$line_number) {
				$count++;
				$line_number = (strpos($line, $search) !== FALSE) ? $count : $line_number;
			}
			fclose($handle);
		}
		
	} else {
		$line_number = 0;
	}
	
	$export = '';
	$lines = file("data/data.txt");

		
	$data = explode("|||",$lines[$line_number-1]);
	


	$pID = explode("rna55df",$data[0])[0];
	$link = $data[1];
	$anzahl = $anzl;
	$title = $data[3];
	$preis = $data[4];
	$description = $data[5];
	$einheit = $data[6];
	$gewicht = $data[7];
	$userID = $data[8];
	$score = $data[9];
	$likes = $data[10];
	$comments = $data[11];
	

	$imgLink = "global/data/".md5($link)."/1.png";
	

?>

<div class="container" id="<?php echo $pID; ?>">
		
	<div class="values title">
		<?php echo $title ?>
	</div>
	<a class="picture" href="global/post.php?id=<?php echo $pID; ?>">
		<picture class="picture" style="background-image: url('<?php echo $imgLink; ?>');">
		</picture>
	</a>
	<div class="values gets">
		<div class="preis">
			Preis: <?php echo $preis; ?>
		</div>
		<div class="anzahl">
			<?php echo $anzahl." ".$einheit ?>
		</div>
	</div>
	<div class="description">
		<?php echo $description; ?>
	</div>
</div>

