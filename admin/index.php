<?php
	/**************************************************************
	*  index.php
	*  File used as Home page for in Social123
	*  Author: Benchmark, Last Modified: 12/09/2010
	*  Created By: Santosh tamse
	***************************************************************/

	include("../config/config.php");
	$page='index.php';
    $AddClass  		= array('reuse');	
	include(CONFIG_CLASS_PATH."class.php"); 
	
	//include_once(MODULES_DIR_PATH.'manage-customize-site.php'); // Customize theme code here 
 
	// Check Login status here 
	$login_status	= $re->getAdminLoginStatus();	 
	if($login_status)
	{ 
	   $redirect_to 	= ADMIN_FOLDER_PATH_HTTP.'user-listing.php';
	   $re->redirectPage($redirect_to);
	}
	// End Here
	
    
	$post_value     = $_SESSION['post'];
    if(isset($post_value ) && is_array($post_value ) && count($post_value )>0){
	  $username 	= $post_value['username'];
	  $password 	= $post_value['password'];
	  $remember_me 	= $post_value['remember_me'];
	  unset($_SESSION['post']);	  
	}
	else
	{ 	
		// Remeber me functionlity here 
			$remember 		= $_COOKIE['rememberadmin'] ;
			if(isset($remember) && is_array($remember) && count($remember)>0){
			  $username 	= $remember['username'];
			  $password 	= $remember['password'];
			  if($password != "")
			  $password     = base64_decode($password);
			  $remember_me 	= $remember['remember'];
		    }
	}

    include_once(MODULES_DIR_PATH.'messages.php');	  	
	   

    $AddCSS 		= array($current_selected_theme, "devoplercreate");  
    $AddJS 			= array("jquery", "jquery.validate", "cmxforms", "login");	
	include(VIEW_PATH."adminlogin.html"); 
?>
