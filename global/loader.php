<?php
	$max = isset($_POST['max']) ? $_POST['max'] : null;
	$last = isset($_POST['last']) ? $_POST['last'] : null;
	$querry = isset($_POST['querry']) ? $_POST['querry'] : null;
	$max = isset($_POST['max']) ? $_POST['max'] : null;
	
	$likes = 1;
	$score = 2;
	$comments =3;

	$title = null;
	$poster = null;

	if ($last == null) {
		//TODO: MySQL call
		$last = 1933635;
	}

	for ($i=0; $i < $max; $i++) { 
		?><div class="container" id="<?php echo $last-$i; ?>">
			<div class="values scores">
				<div class="">
					<span class="fave-span" title="fave"><i class="fa fa-heart"></i></span>
					<span class="favourites" title="Favourites"><?php echo $likes; ?></span>
				</div>
				<div>
					<i class="fa fa-arrow-up" title="Upvote"></i>
					<span class="score" title="Score"><?php echo $score; ?></span>
					<i class="fa fa-arrow-down" title="Downvote"></i>
				</div>
				<div>
					<i class="fa fa-comments"></i>
					<span class="comments_count" data-image-id="1933082"><?php echo $comments; ?></span>
				</div>
			</div>

			<?php if ($title!=null) {
			echo "<div class=\"values title\">";
			echo "\t".$title;
			echo "</div>";
			}?>

			<picture style="background-image: url(<?php echo $last-$i; ?>);">
				
			</picture>

			<?php if ($poster!=null) {
			echo "<div class=\"values poster\">";
			echo "\t".$poster;
			echo "</div>";
			}?>
			
		</div><?php
	}
		
?>
