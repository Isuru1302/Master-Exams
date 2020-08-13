<?php
	session_start();
	session_destroy();
	session_unset();
	echo '<script type="text/javascript">location.href = "../";</script>';

?>