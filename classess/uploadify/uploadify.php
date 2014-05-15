<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination

//$targetFolder = 'shoutfactory/portal/uploads'; // Relative to the root
$targetFolder = '/portal/uploads'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	//$targetPath = APPLICATION_PATH . $targetFolder;
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	
	$targetFileExtension = 'txt';
	$targetFileName = 'tmp_tmp_'.date("Ym",time());
	
	//$_SESSION['mailchimp']['file'] = array();
	//$_SESSION['mailchimp']['file']['name'] = $targetFileName;
	//$_SESSION['mailchimp']['file']['ext']  = $targetFileExtension;
	
	//$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	$targetFile = rtrim($targetPath,'/') . '/' . $targetFileName . '.' . $targetFileExtension;
	
	if( file_exists($targetFile) ) {
		@unlink($targetFile);
	}
	
	// Validate the file type
	$fileTypes = array('txt'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
?>