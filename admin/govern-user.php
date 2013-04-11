 <?php
	/**************************************************************
	*  pricing.php
	*  File used as pricing page for in Social123
	*  Author: Stark Infotech, Last Modified: 21/03/2013
	*  Created By: Sanjay M.
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
		$twitter_record_limit = $user_array[0]->twitter_record_limit;
		$lead_record_limit = $user_array[0]->lead_record_limit;	
		$data_record_limit = $user_array[0]->data_record_limit;

		$twitter_data = $user_array[0]->twitter_duration;
		$twitter_duration = explode(',', $twitter_data);

		$lead_data = $user_array[0]->lead_duration;
		$lead_duration = explode(',', $lead_data);

		$data_data = $user_array[0]->data_duration;
		$data_duration = explode(',', $data_data);

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
	
   	include (VIEW_PATH."admin-user-govern.html");	
?>