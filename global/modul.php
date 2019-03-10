<?php
	/**
	 * AUTHOR: DAVID ZEILINGER
	 * VERSION: 23_01_2019
	 * Laedt Daten(posts) aus datenbank
	 */
	$last = isset($_POST['last']) ? $_POST['last'] : null;
	$query = isset($_POST['query']) ? $_POST['query'] : null;
	$TODO = isset($_POST['max']) ? $_POST['max'] : null;
	
	$likes = 1;
	$score = 2;
	$comments =3;

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

	$anzahl = 40;

	$einheit = "Stk.";

	$preis = 40;




	if ($last == null) {
		
	} else {
		
	}
	?>
		<style type="text/css">
			.values.scores>.like:hover {
				color: #f91f1f;
			}

			.upvote:hover{
				color: #5aa51d;
			}

			.downvote:hover{
				color: #f91f1f;
			}


			.values.scores>.comment:hover {
				color: #9273d0;
			}

			.description {
				text-align: justify;
				padding: 0.125rem;
				word-break: break-word;
			}

			.values.buy{
			}

			.values.buy>.btn{
				padding: 0 1rem;
				background-color: transparent;
				border: none;

				height: 1.5rem;

				width: 6rem;
				float: left;

				transition: all 0.6s;
			}

			.values.buy>.num{
				padding: 0 1rem;
				background-color: transparent;
				border: none;

				height: 1.5rem;

				float: right;
				width: 4rem;

				transition: all 0.6s;
			}

			.values.gets>.preis{
				float: left;
				padding-left: 1rem;
			}

			.values.gets>.anzahl{
				float: right;
				padding-right: 1rem;
				
			}

		</style>
<?php

$export = '';

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

$export .= '<a href="post.php?id='.$pID.'"><picture style="background-image: url(\''.$imgLink.'\');"></a>';
				
$export .= '</picture>';
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

echo $export;