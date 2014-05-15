<?php
	function redirect( $_url ) {
		header("Location:$_url");
	}
	
	function loadModule( $_module ) {
		redirect('main.php?module='.$_module);
	}
	
	function dump( $_data ) {
		if( is_array($_data) ) {
			echo '<pre>';
			print_r($_data);
			echo '<pre>';
		} else {
			echo '<br>'.$_data.'<br>';	
		}
	}
	
	
	function getConfigValue( $_name ) {
		$_value = '';
		if( $_name!='' ) {
			$_sql = "SELECT value FROM ".DB_PREFIX."config WHERE name='$_name' ";
			$_result = mysql_query( $_sql );
			if( $_result and (mysql_num_rows($_result)>0) ) {
				$_row = mysql_fetch_assoc( $_result );
				$_value = $_row['value'];
			} else {
				$_value = '';
			}
		}
		return $_value;
	}
	
	function getFieldValue( $_table,$_field,$_condition='' ) {
		if( ($_table!='') and ($_field!='') ) {
			if( $_condition!='' )
				$_sql = "SELECT * FROM ".DB_PREFIX."$_table WHERE ($_condition)";
			else
				$_sql = "SELECT * FROM ".DB_PREFIX."$_table";
			$_result = mysql_query( $_sql );
			if( $_result and (mysql_num_rows($_result)>0) ) {		
				$_row = mysql_fetch_assoc( $_result );
				return $_row[$_field];
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function saveProduct( $code,$name,$amount,$price,$status ) {
		if( !$code || !$name || !$amount || !$price || !$status) {
			return array(
							'success'=>false,
							'error'=>'Please Fill All Feilds!'
							);
			
		}

			
			$sql = "INSERT INTO ".DB_PREFIX."products (code,name,amount,price,status) VALUES ('$code','$name','$amount','$price','$status') ; ";

			$result = mysql_query( $sql );
			if( $result ) {
				$output = array(
							'success'=>true,
							'id'=>mysql_insert_id()
							);	
			} else { 
				$output = array(
							'success'=>false,
							'error'=>'Product not saved!'
							);
			}
			
			return $output;
	}
	
	function getProductList() {
		$sql = "SELECT * FROM ".DB_PREFIX."products ;";
		$result = mysql_query( $sql );
		return $result;
	}
	
?>