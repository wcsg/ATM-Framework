<?php
	$_login_message = '';
	
	if( isset($_POST['submitbtn']) ) {
		$_user = mysql_escape_string($_POST['username']);
		$_pass = mysql_escape_string($_POST['password']);
		$_pass_md5 = md5($_pass);
		
		$_sql = "SELECT * FROM ".DB_PREFIX."users WHERE ((username='$_user') and (password='$_pass_md5') and (status='Active'));";
		
		$_result = mysql_query( $_sql );
		
		if( $_result and (mysql_num_rows($_result)>0) ) {
			$_row = mysql_fetch_assoc( $_result );
			$_SESSION['user']['id']  		  = $_row['id'];
			$_SESSION['user']['username'] 	= $_user;
			$_SESSION['user']['password'] 	= $_pass;
			$_SESSION['user']['name'] 		= $_row['name'];
			$_SESSION['user']['lastlogin']   = $_row['lastlogin'];	
			
			$_lastip 	= $_SERVER['REMOTE_ADDR'];
			$_lastlogin = time();
			$_sql = "UPDATE ".DB_PREFIX."users SET lastlogin='$_lastlogin',lastip='$_lastip' WHERE id='{$_row['id']}' ";
			$_result = mysql_query( $_sql );
			
			
			loadModule('home');	
		} else {
			unset($_SESSION['user']);
			$_login_message = 'Your login information is wrong!';
		}
		
	}
?>