<?php
	defined('APPLICATION_PATH') || define('APPLICATION_PATH','');
	require(APPLICATION_PATH.'includes/security.php');
	
	$_product_message = '';
	$_product_content = 'This is product module';
	
	if(isset($_POST['savebtn'])) {
		$_code   = $_POST['code'];
		$_name   = $_POST['name'];
		$_amount = $_POST['amount'];
		$_price  = $_POST['price'];
		$_status = $_POST['status'];
		
		saveProduct($_code,$_name,$_amount,$_price,$_status);
		
	}
	
	
?>