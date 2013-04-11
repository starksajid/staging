 <?php
	/**************************************************************
	*  pricing.php
	*  File used as pricing page for in Social123
	*  Author: Benchmark, Last Modified: 15/12/2011
	*  Created By: Devyani Karmarkar
	***************************************************************/

	include("../config/config.php");

	$page='login.php';
	$AddClass  		= array('reuse','s123_customer');	
	include(CONFIG_CLASS_PATH."class.php"); 
	
	include_once(MODULES_DIR_PATH.'messages.php');
			
    $AddCSS 		= array('style2'); 
    $AddJS 			= array('admin-edit-profile');

	$login_status	= $re->getAdminLoginStatus();	 
	if(!$login_status)
	{ 
	   $redirect_to 	= ADMIN_FOLDER_PATH_HTTP.'index.php';
	   $re->redirectPage($redirect_to);
	}

	//fetch admin user records starts search record with user_type = '2'
		
	
	$where = "user_type  = '2' AND customer_status = '1'";

	
	//declaring extra clause as order by clause or ordering.
	$extra_clause=' ';
	
	//declaring the fileds array for passing to query
	$field = array(
		' * '//, list.list_title '
	);
		
	//declaring the joins for the query
	$join = array(	
			
			
		);
		
	$user_array = $s123_customer_manager->getAllS123Customer($where);

	
	if(count($user_array) > 0){
		$name = $user_array[0]->name;
		//$last_name = $user_array[0]->last_name;
		$email = $user_array[0]->email;
		$phone = $user_array[0]->phone;
		$company = $user_array[0]->company;		
	}
	//fetch admin user records ends	
		
	
   	include (VIEW_PATH."adminedit-profile.html");	
?>