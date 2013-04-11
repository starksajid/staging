<?php
	include("config/config.php");
	$page			= '404.php';
	$AddClass  		= array('reuse');	
	include(CONFIG_CLASS_PATH."class.php"); 
	include_once(MODULES_DIR_PATH.'manage-customize-site.php'); // Customize theme code here  

	$re->redirectPage(FOLDER_PATH_HTTP);
	//include (VIEW_PATH."404.html");
?>
