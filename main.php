<?php
	ob_start();
	@session_start();
	
	require('includes/configs.php');

	error_reporting(ERROR_STATUS);
	
	include('includes/public.func.php');
	include('includes/modules_list.php');
	require_once('includes/db.connect.php');
	


	if( isset($_GET['module']) and ($_GET['module']!='') and (in_array($_GET['module'],$_modules_list)) ) {
		$_module = $_GET['module'];
	} else {
		$_module = 'login';
	}
	

	$_module_js_document = TEMPLATE.'/js/modules/_'.$_module.'.mod.js';
	if( !file_exists($_module_js_document) ) {
		unset($_module_js_document);
	}

	$_module_css_document = TEMPLATE.'/css/modules/_'.$_module.'.mod.css';
	if( !file_exists($_module_css_document) ) {
		unset($_module_css_document);
	}

	if( LOAD_HEADER) {
		include(TEMPLATE.'/includes/header.html');
	}

	include(APPLICATION_PATH.'modules/_' . $_module . '.mod.php');
 	include(TEMPLATE.'/modules/_'.$_module.'.mod.html');
	
	if( LOAD_FOOTER) {
		include(TEMPLATE.'/includes/footer.html');
	}

?>
