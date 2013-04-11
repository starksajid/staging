 <?php
	/**************************************************************
	*  pricing.php
	*  File used as pricing page for in Social123
	*  Author: Benchmark, Last Modified: 15/12/2011
	*  Created By: Devyani Karmarkar
	***************************************************************/

	include("../config/config.php");

	$page='login.php';
	$AddClass  		= array('reuse');	
	include(CONFIG_CLASS_PATH."class.php"); 
	
	include_once(MODULES_DIR_PATH.'messages.php');
			
    $AddCSS 		= array('style2'); 
    $AddJS 			= array('jquery','jquery.validate','login');
	
	
	if($re->getAdminLoginStatus())
	{
		$re->redirectPage(ADMIN_FOLDER_PATH_HTTP.'user-listing.php');
	}
	
   	include (VIEW_PATH."adminforgot-password.html");
?>