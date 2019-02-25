<?php
	//error_reporting(E_ERROR);
	$times = isset($_POST['times']) ? $_POST['times'] : null;
	for ($i=2100+$times; $i <= 2100+$times; $i++) { 
		$image = 'https:///booru/image/'.$i.'/';

		echo '<div><img height="20%" src="'.$image.'"  onerror="imgError(this)"></div>';
		echo '<div><video height="20%" loop controls src="'.$image.'"  onerror="imgError(this)"></video></div>';
		
	}
	

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	function imgError(err){
		$(err).parent().remove();
	}

</script>