 <?php
	/**************************************************************
	*  pricing.php
	*  File used as pricing page for in Social123
	*  Author: Benchmark, Last Modified: 15/12/2011
	*  Created By: Devyani Karmarkar
	***************************************************************/

	include("../config/config.php");

	$page='login.php';
	$AddClass  		= array('reuse','s123_customer', 's123_countrylist');	
	include(CONFIG_CLASS_PATH."class.php"); 
	
	include_once(MODULES_DIR_PATH.'messages.php');
			
    $AddCSS 		= array('style2'); 
    $AddJS 			= array('admin-edit-user');

	$login_status	= $re->getAdminLoginStatus();	 
	if(!$login_status)
	{ 
	   $redirect_to 	= ADMIN_FOLDER_PATH_HTTP.'index.php';
	   $re->redirectPage($redirect_to);
	}
	
	//fetch admin user records starts 
		
	$customer_id = base64_decode($_REQUEST['cust_id']);
	
	$where = "user_type  IN ('0','1') AND customer_status = '1' AND customer_id = '$customer_id'";

	
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
		$user_type = $user_array[0]->user_type;
		$api_key = base64_decode($user_array[0]->api_key);
		$parent_customer_id = $user_array[0]->parent_customer_id;	
		if($user_type == '')
			$user_type = '1';
		if($user_type == '0'){
			$adminchecked = '';
			$supportchecked = 'checked=checked';
		}else{
			$supportchecked = '';
			$adminchecked = 'checked=checked';
		}
		$address_line1	=	$user_array[0]->getAddressLine1();
		$address_line2	=	$user_array[0]->getAddressLine2();
		$city	=	$user_array[0]->getCity();
		$state	=	$user_array[0]->getState();
		$zip	=	$user_array[0]->getZip();
		$country	=	$user_array[0]->getCountry();
	}else{
		$redirect_to = ADMIN_FOLDER_PATH_HTTP.'user-listing.php';
		$re->redirectPage($redirect_to);
	}
	
	
	$s123_country_list = array();
	try
			{
				//var_dump($s123_countrylist_manager);
				$where_clause = '';
				$countryList = $s123_countrylist_manager->getAllS123Countrylist($where_clause);
				
				foreach($countryList as $counties)
				{
					$country_list[] = array(
						'CountryID'		=> $counties->CountryID,
						'Name'		=> $counties->Name,
										  );
				}
			}
			catch(Exception $e)
			{
			}
	//fetch admin user records ends	
	
   	include (VIEW_PATH."admin-edit-user.html");	
?>