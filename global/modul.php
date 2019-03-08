


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

	$pID = $last;
	
	$title = "Titel";

	$imgLink = null;

	$description = null;

	$anzahl = 40;

	$preis = 40;


	if ($last == null) {
		//TODO: MySQL call
		$last = 1933635;
	} else {
		//TODO: MySQL call
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
				color: #e52b06;
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
				padding: 0;
				background-color: transparent;
				border: none;

				height: 1.5rem;

				width: 4rem;
				float: left;
			}

			.values.buy>.num{
				padding: 0;
				background-color: transparent;
				border: none;

				height: 1.5rem;

				float: right;
				width: 4rem;
			}

			.values.info>.preis{
				float: left;
				padding-left: 1rem;
			}

			.values.info>.anzahl{
				float: right;
				padding-right: 1rem;
			}
		</style>
		<div class="container" id="<?php echo $pID; ?>">
			<div class="values scores">
				<div class="like">
					<span class="fave-span" title="fave"><i class="fa fa-heart"></i></span>
					<span class="favourites" title="Favourites"><?php echo $likes; ?></span>
				</div>
				<div class="vote">
					<i class="upvote fa fa-arrow-up" title="Upvote"></i>
					<span class="score" title="Score"><?php echo $score; ?></span>
					<i class="downvote fa fa-arrow-down" title="Downvote"></i>
				</div>
				<div class="comment">
					<i class="fa fa-comments"></i>
					<span class="comments_count" data-image-id="1933082"><?php echo $comments; ?></span>
				</div>
			</div>

			
			<div class="values title">
				<?php echo $title;?>
			</div>

			<picture style="background-image: url(<?php echo $imgLink; ?>);">
				
			</picture>
			<div class="values info">
				<div class="preis">
					Preis: <?php echo $preis;?>
				</div>

				<div class="anzahl">
					<?php echo $preis;?> Stk.
				</div>
			</div>
			<div class="description">
				<?php echo $description;?>
				dfgs afjnbas jidfna snf löj dn fjna sk djfn osaj kdn fdfgs afjnbas jidfna snf löj dn fjna sk djfn osaj kdn fdfgs afjnbas jidfna snf löj dn fjna sk djfn osaj
			</div>

			<div class="values buy">
				<button class="btn" id="<?php echo $pID; ?>" onClick="buy(<?php echo $pID; ?>)">Kaufen</button>
				<input class="num" id="<?php echo $pID; ?>" type="number" name="anzahl" min="1" max="<?php echo $anzahl; ?>" value="1">
			</div>

		</div>
