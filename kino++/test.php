<?php
include 'open.php';

		ob_start();
		var_dump(getdate($_SERVER['REQUEST_TIME']));
		$ausgabe = ob_get_flush();

		ob_end_clean();



include 'test-gui.php';

include 'close.php';

?>