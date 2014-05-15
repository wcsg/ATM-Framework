<?php
	@session_start();
	defined('APPLICATION_PATH') || define('APPLICATION_PATH','../');
	if( isset($_SESSION['user']) and isset($_SESSION['user']['username']) and isset($_SESSION['user']['password']) ) {
			
	} else {
		header('Location:'.APPLICATION_PATH.'main.php?module=login');
	}

?>