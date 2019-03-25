<?php
	/**
	 * AUTHOR: DAVID ZEILINGER
	 * VERSION: 23_01_2019
	 * Laedt Daten(posts) aus datenbank
	 */

	error_reporting(0);

	
	$_POST = json_decode(file_get_contents('php://input'), true);



	$last = isset($_POST['last']) ? $_POST['last'] : null;
	$query = isset($_POST['query']) ? $_POST['query'] : null;
	$max = isset($_POST['max']) ? $_POST['max'] : null;
	
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
		$search = $last;
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
	for ($i=$line_number; $i < $max; $i++) { 
		
		$data = explode("|||",$lines[$i]);
	

	$pID = $data[0];
	$anzahl = $data[1];
	$title = $data[2];
	$preis = $data[3];
	$description = $data[4];
	$einheit = $data[5];
	$gewicht = $data[6];
	$userID = $data[7];
	$score = $data[8];
	$likes = $data[9];
	$comments = $data[10];

	$imgLink = "global/data/".md5($pID).".png";





$export .= '<div class="container" id="'.$pID.'">';
$export .= '<div class="values scores">';
$export .= '<div id="'.$pID.'likes" class="like" onClick="like(\''.$pID.'\')">';
$export .= '<span class="fave-span" title="fave"><i class="fa fa-heart"></i></span>';
$export .= '<span class="favourites" title="Favourites">'.$likes.'</span>';
$export .= '</div>';
$export .= '<div id="'.$pID.'votes" class="vote">';
$export .= '<i class="upvote fa fa-arrow-up" title="Upvote" onClick="vote(\''.$pID.'\',1)"></i>';
$export .= '<span class="score" title="Score">'.$score.'</span>';
$export .= '<i class="downvote fa fa-arrow-down" title="Downvote" onClick="vote(\''.$pID.'\',-1)"></i>';
$export .= '</div>';
$export .= '<div id="'.$pID.'comments" class="comment" onClick="comment(\''.$pID.'\')">';
$export .= '<i class="fa fa-comments"></i>';
$export .= '<span class="comments_count" data-image-id="'.$pID.'">'.$comments.'</span>';
$export .= '</div>';
$export .= '</div>';

			
$export .= '<div class="values title">';
$export .= $title.'';
$export .= '</div>';

$export .= '<a class="picture" href="post.php?id='.$pID.'">';
$export .= '<picture class="picture" style="background-image: url(\''.$imgLink.'\');">';
				
$export .= '</picture>';
$export .= '</a>';

$export .= '<div class="values gets">';
$export .= '<div class="preis">';
$export .= 'Preis: '.$preis.'';
$export .= '</div>';

$export .= '<div class="anzahl">';
$export .= $anzahl.' '.$einheit.'';
$export .= '</div>';
$export .= '</div>';
$export .= '<div class="description">';
$export .= $description.'</div>';

$export .= '<div class="values buy">';
$export .= '<button class="btn" id="'.$pID.'button" onClick="buy(\''.$pID.'\')">Kaufen</button>';
$export .= '<input class="num" id="'.$pID.'anzahl" type="number" name="anzahl" min="1" max="'.$anzahl.'" value="1">';
$export .= '</div>';

$export .= '</div>';
}
echo $export;
