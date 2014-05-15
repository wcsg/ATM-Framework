<?php
	@session_start();
	
	$arr_functions = array(
		'test1',
		'test2'
	);

	$arr_option = $_REQUEST;

	if ( isset($arr_option['method']) and in_array($arr_option['method'], $arr_functions) ) {

		define('APPLICATION_PATH','../');
		define('TEMPLATE_PATH',APPLICATION_PATH.'templates');
		define('TEMPLATE_NAME','default');
		define('TEMPLATE',TEMPLATE_PATH.'/'.TEMPLATE_NAME);	
		define('RESOURCE_PATH',APPLICATION_PATH.'uploads');
		

		require(APPLICATION_PATH.'includes/configs.php');
		include(APPLICATION_PATH.'includes/public.func.php');
		require_once(APPLICATION_PATH.'includes/db.connect.php');

    	$php_command_param_str = '';
    	if ( is_array($arr_option['option']) and count($arr_option['option'])) {
        	$php_command_param_arr = array();
        	foreach( $arr_option['option'] as $key => $val ){
            	//$arr_option['option'][$key] = mysql_escape_string($val);
            	$php_command_param_arr[] = "'" . mysql_escape_string($val) . "'";
        	}
        	$php_command_param_str = implode(' , ', $php_command_param_arr);
    	}
    	$php_command = "return preg_replace('/\s\s+/', '', {$arr_option['method']}( {$php_command_param_str} ) );";
    	//$php_command = "print {$arr_option['method']}( {$php_command_param_str} );";
    	$funcResult = eval( $php_command );
		if ( is_array($funcResult) ) {
			print json_encode( $funcResult );
		} else {
			print $funcResult;
		}    
   
	} else {
    	print 'Invalid Request!';
	}
?>