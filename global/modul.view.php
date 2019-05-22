

<div class="container" id="<?php echo $pID; ?>">
	<div class="values scores">
			<div style="color: <?php echo $colorLikes; ?>" id="<?php echo $pID; ?>likes" class="like" onClick="like('<?php echo $pID; ?>')">
				<span class="fave-span" title="fave"><i class="fa fa-heart"></i></span>
				<span class="favourites" title="Favourites"><?php echo $likes; ?></span>
			</div>
			<div style="color: <?php echo $colorVotes; ?>" id="<?php echo $pID; ?>votes" class="vote">
				<i class="upvote fa fa-arrow-up" title="Upvote" onClick="vote('<?php echo $pID; ?>',1)"></i>
				<span class="score" title="Score"><?php echo $score; ?></span>
				<i class="downvote fa fa-arrow-down" title="Downvote" onClick="vote('<?php echo $pID; ?>',-1)"></i>
			</div>
			<div style="" id="<?php echo $pID; ?>comments" class="comment" onClick="comment('<?php echo $pID; ?>')">
				<i class="fa fa-comments"></i>
				<span class="comments_count" data-image-id="<?php echo $pID; ?>"><?php echo $colorComments; ?></span>
			</div>
	</div>



	<div class="values title">
		<?php echo $title ?>
	</div>
	<a class="picture" href="global/post.php?id=<?php echo $pID; ?>">
		<picture class="picture" style="background-image: url('<?php echo $imgLink; ?>');">
		</picture>
	</a>
	<div class="values gets">
		<div class="preis">
			Preis: <?php echo $preis; ?>€
		</div>
		<div class="anzahl">
			<?php echo $anzahl." ".$einheit ?>
		</div>
	</div>
	<div class="description">
		<?php echo $description; ?>
	</div>
	<div class="values buy">
		<button class="btn" id="<?php echo $pID; ?>button" onClick="buy('<?php echo $pID; ?>')">Kaufen</button>
		<input class="num" id="<?php echo $pID; ?>anzahl" type="number" name="anzahl" min="1" max="<?php echo $anzahl; ?>" value="1">
	</div>
</div>

<?php endfor; ?>
