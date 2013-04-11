<?php
	@session_start();
	/**
	 * Include Config File ( Please Confirm this Path with Your Project )
	 */
	include('../config/config.php');
	ini_set("upload_max_filesize", '10M');
	ini_set("post_max_size", '10M');
	$AddClass = array('reuse','s123_customer','s123_social_points','s123_social_profile_list','s123_twitter_names','s123_socialprofile_content_mentions');
	include("../config/class.php");
	ini_set("max_execution_time", 0);
	/**
	 * Set Page Name
	 */
	$page_name = 'settings-controller.php';

	/**
	 * Include Class file ( Please Confirm this Path with Your Project )
	 */
	
	/**
	 * Set Redirect URL
	 */
	$redirect_to = ADMIN_FOLDER_PATH_HTTP.'edit-profile.php';
	
	//to activate the user
	if(isset($_REQUEST['step']) && ($_REQUEST['step'] == 'activate') &&  ($_REQUEST['cust_id'] != ''))
	{
		$redirect_to = ADMIN_FOLDER_PATH_HTTP.'user-listing.php';
		$parent_customer_id = $re->getAdmin_id();
		$customer_id = base64_decode($_GET['cust_id']);			
		$status = base64_decode($_GET['status']);		
		
		$s123_customer = $s123_customer_manager->getSingleS123Customer($customer_id);
		
		if(count($s123_customer) == 1)
		{
			if($status == '1'){
				$customer_status = '1';
				$_SESSION['Message'] = '4_1';	
			}else{
				$customer_status = '2';
				$_SESSION['Message'] = '4_2';
			}	
			$s123_customer->setCustomerStatus($customer_status);
			
			$customer_id = $s123_customer_manager->updateS123Customer($s123_customer);		
			
		}else{
			//error set 
		}	
		
	}
	
	//to activate the user
	if(isset($_REQUEST['step']) && ($_REQUEST['step'] == 'fliptop_activate') &&  ($_REQUEST['cust_id'] != ''))
	{
		$redirect_to = ADMIN_FOLDER_PATH_HTTP.'user-listing.php';
		$parent_customer_id = $re->getAdmin_id();
		$customer_id = base64_decode($_GET['cust_id']);			
		$status = base64_decode($_GET['status']);		
		
		$s123_customer = $s123_customer_manager->getSingleS123Customer($customer_id);
		
		if(count($s123_customer) == 1)
		{
			if($status == '1'){
				$fliptop_enable = '1';
				$_SESSION['Message'] = '4_1_1';	
			}else{
				$fliptop_enable = '0';
				$_SESSION['Message'] = '4_2_1';
			}	
			$s123_customer->setFliptopEnable($fliptop_enable);
			
			$customer_id = $s123_customer_manager->updateS123Customer($s123_customer);		
			
		}else{
			//error set 
		}	
		
	}


	//for update profile
	if(isset($_REQUEST['update_profile']))
	{
		
		$customer_id = $re->getAdmin_id();
		$first_name	= $_POST['first_name'];
		$last_name	= $_POST['last_name'];		
		$email	= $_POST['email'];
		$phone	= $_POST['phone'];
		$password	= $_POST['password'];		
		$confirm_password	= $_POST['password'];
		$company	= $_POST['company_name'];
		
		if($password != '' && $confirm_password != ''){
			if($password != $confirm_password)
			{
				$_SESSION['Message'] =  '4';
				$re->redirectPage(ADMIN_FOLDER_PATH_HTTP.'edit-profile.php');
			}
		}
		
		$s123_customer_array = $s123_customer_manager->getAllS123Customer("email='$email' AND customer_id != '$customer_id' LIMIT 1");
		
		if(count($s123_customer_array)>0)
		{
			$_SESSION['Message'] = '34';
			$re->redirectPage('edit-profile.php');
			exit;	
		}	
		
		$s123_customer = $s123_customer_manager->getSingleS123Customer($customer_id);
		
		
		$s123_customer->setModifiedDate(date('Y-m-d H:i:s'));
		$s123_customer->setModifiedBy($customer_id);
		$s123_customer->setPhone(stripslashes($phone));
		$s123_customer->setFirstName(stripslashes($first_name));
		$s123_customer->setEmail(stripslashes($email));
		$s123_customer->setLastName(stripslashes($last_name));
		$s123_customer->setCompany(stripslashes($company));
		if($password != '' && $confirm_password != ''){
			if($password == $confirm_password){
				$s123_customer->setPassword(stripslashes(md5($password)));
			}	
		}	
		/**
		 * Add to Database
		 */
		
		$s123_customer_manager->updateS123Customer($s123_customer);
		$_SESSION['Message'] = '9';		
	}	
	

	//for edit user
	if(isset($_REQUEST['edit_user']))
	{
		$redirect_to = ADMIN_FOLDER_PATH_HTTP.'user-listing.php';
		$parent_customer_id = $re->getAdmin_id();
		$customer_id = base64_decode($_POST['cust_id']);
		$first_name	= $_POST['first_name'];
		$last_name	= $_POST['last_name'];
		$phone	= $_POST['phone'];
		$company	= $_POST['company_name'];
		$email	= $_POST['email'];
		$user_type	= $_POST['user_type'];
		$password	= $_POST['password'];		
		$confirm_password	= $_POST['password'];
		if($user_type == ''){
			$user_type = '0';
		}		
		
		//add validation for duplicate email address starts
		
		$s123_customer_array = $s123_customer_manager->getAllS123Customer("email='$email' AND customer_id != '$customer_id' and customer_status = '1' LIMIT 1");
		
		if(count($s123_customer_array)>0)
		{
			$_SESSION['Message'] = '34';			
			$re->redirectPage('edit-user.php?cust_id='.$_POST['cust_id'].'&step=edit');
			exit;	
		}	
		//add validation for duplicate email address ends
		
		$s123_customer = $s123_customer_manager->getSingleS123Customer($customer_id);
				
		
		$s123_customer->setCustomerId(stripslashes($customer_id));		
		$s123_customer->setFirstName(stripslashes($first_name));
		$s123_customer->setLastName(stripslashes($last_name));
		$s123_customer->setEmail(stripslashes($email));		
		$s123_customer->setCompany(stripslashes($company));
		$s123_customer->setPhone(stripslashes($phone));
		if($s123_customer->parent_customer_id > 0){
			$s123_customer->setUserType(stripslashes($user_type));		
		}
		$s123_customer->setModifiedDate(date('Y-m-d H:i:s'));
		$s123_customer->setModifiedBy($parent_customer_id);
		if($password != '' && $confirm_password != ''){
			if($password == $confirm_password){
				$s123_customer->setPassword(stripslashes(md5($password)));
			}	
		}
		
		if($s123_customer->parent_customer_id == 0)
		{
			$address_line1	= $_POST['address_line1'];
			$address_line2	= $_POST['address_line2'];
			$city	= $_POST['city'];
			$state	= $_POST['state'];
			$zip	= $_POST['zip'];
			$country	= $_POST['country'];
			$s123_customer->setAddressLine1(stripslashes($address_line1));
			$s123_customer->setAddressLine2(stripslashes($address_line2));
			$s123_customer->setCity(stripslashes($city));
			$s123_customer->setState(stripslashes($state));
			$s123_customer->setZip(stripslashes($zip));
			$s123_customer->setCountry(stripslashes($country));	
		}
		
		$customer_id = $s123_customer_manager->updateS123Customer($s123_customer);		
		$_SESSION['Message'] = '4';		
	}
	
	//for delete user
	if(isset($_REQUEST['step']) && ($_REQUEST['step'] == 'delete') &&  ($_REQUEST['cust_id'] != ''))
	{
		$redirect_to = ADMIN_FOLDER_PATH_HTTP.'user-listing.php';
		$customer_id = base64_decode($_REQUEST['cust_id']);

		//delete all social data - start
		$profile_list_where = "group_user_id=".$customer_id;
		$profile_list_select = "list_id";
		$profile_list = $s123_social_profile_list_manager->getAllS123SocialProfileList($profile_list_where, $profile_list_select);
		
		if( count($profile_list) > 0 ) {
			for($i=0; $i<count($profile_list); $i++) {
				$list_id = $profile_list[$i]->list_id;
				$s123_social_profile_list_manager->deleteS123SocialProfileList($list_id, $customer_id);
			}
		}
		//delete all social data - end

		
		//delete all social leads - start
		$content_id_list_where = "group_user_id=".$customer_id;
		$content_id_list_select = "content_id";
		$content_id_list = $s123_socialprofile_content_mentions_manager->getAllS123SocialprofileContentMentions($content_id_list_where, '', $content_id_list_select);
		
		if(count($content_id_list) > 0) {
			for ($i=0; $i < count($content_id_list); $i++) {
				$content_id = $content_id_list[$i]->content_id;
				$s123_socialprofile_content_mentions_manager->deleteS123SocialprofileContentMentions($content_id);
			}
		}
		//delete all social leads - end
		
		$s123_customer_manager->softdeleteS123Customer($customer_id);
		$_SESSION['Message'] = '52';
	}

	
	//added code on 19th may2012 facility to activate customer's account as free account starts
	//echo 'hi'; print_r($_REQUEST);exit;
	
	if(isset($_REQUEST['step']) && ($_REQUEST['step'] == 'freeaccount') &&  ($_REQUEST['cust_id'] != ''))
	{
		//echo "<pre>"; print_r($_REQUEST);exit;
		$redirect_to = ADMIN_FOLDER_PATH_HTTP.'user-listing.php';
		$customer_id = base64_decode($_REQUEST['cust_id']);
		$status = base64_decode($_REQUEST['status']);
		if($status == '0')
		{
			$free_records = "-10000000";
			$_SESSION['Message'] = '294';
		}else{
			$free_records = "0";			
			//code to count number of free records for the user and update to the free record count if unlimited account is removed form the customer
			$where_clause = '';	
			$where_clause .= " group_user_id = '$customer_id'";
			$where_clause .= " AND show_status = 'F'";				
			$free_records  	= $s123_social_points_manager->getAllS123SocialPointsCount($where_clause);			
			$_SESSION['Message'] = '295';
		}

		$s123_customer = $s123_customer_manager->getSingleS123Customer($customer_id);
		$s123_customer->setFreeRecordsCount(stripslashes($free_records));		
		
		$s123_customer_manager->updateS123Customer($s123_customer);	

	}

	//add the limit for user
	if($_REQUEST['cust_id'] != '' && $_REQUEST['step'] == 'limit')
	{
		//echo "<pre>"; print_r($_POST);exit;
		$mod_date = date('Y-m-d H:i:s');
		$customer_id = $_POST['cust_id'];
		$email	= $_POST['email'];
		$twitter_original = '';
		$lead_original = '';
		$data_original = '';

		if($_POST['twitter_duration'] != '') {
			$twitter_original = $_POST['twitter_duration'];
			$twitter_duration = $twitter_original.",".$mod_date;
		}

		$twitter_duration_hidden = $_POST['twitter_duration_hidden'];

		if($_POST['lead_duration'] != '') {
			$lead_original = $_POST['lead_duration'];
			$lead_duration = $lead_original.",".$mod_date;
		}

		$lead_duration_hidden = $_POST['lead_duration_hidden'];

		if($_POST['data_duration'] != '') {
			$data_original = $_POST['data_duration'];
			$data_duration = $data_original.",".$mod_date;
		}

		$data_duration_hidden = $_POST['data_duration_hidden'];

		$twitter_record_limit = $_POST['twitter_record_limit'];
		$lead_record_limit = $_POST['lead_record_limit'];
		$data_record_limit = $_POST['data_record_limit'];

		
		//echo "email='$email' AND customer_status = '1' AND customer_id != '$customer_id' LIMIT 1";
		//echo "<pre>"; print_r($_REQUEST); 
		
		$s123_customer_array = $s123_customer_manager->getAllS123Customer("email='$email' AND customer_status = '1' AND customer_id != '$customer_id' LIMIT 1");
		
		//echo "s123_customer_array"; print_r($s123_customer_array);die;
		if(count($s123_customer_array)>0)
		{
			$_SESSION['Message'] = '34';
			$re->redirectPage('govern-user.php?cust_id='.$_POST['cust_id'].'&step=limit');
			exit;	
		}	
		
		//echo "here<pre>"; echo $customer_id; 

		$s123_customer = $s123_customer_manager->getSingleS123Customer($customer_id);
		//echo "hi"; print_r($s123_customer);die;
		
		$s123_customer->setTwitterRecordLimit($twitter_record_limit);
		$s123_customer->setLeadRecordLimit($lead_record_limit);
		$s123_customer->setDataRecordLimit($data_record_limit);
		if($twitter_duration_hidden != $twitter_original) {
			$s123_customer->setTwitterDuration($twitter_duration);
		}
		if($lead_duration_hidden != $lead_original){
			$s123_customer->setLeadDuration($lead_duration);
		}
		if($data_duration_hidden != $data_original){
			$s123_customer->setDataDuration($data_duration);
		}
		//echo "data<pre>"; print_r($s123_customer);die;

		/**
		 * Add to Database
		 */
		$s123_customer_manager->updateS123Customer($s123_customer);
		$_SESSION['Message'] = '9';	
		$re->redirectPage('user-listing.php');
	}


	//added code on 19th may2012 facility to activate customer's account as free account ends
		
	/**
	 * Redirect to Listing
	*/
	$re->redirectPage($redirect_to);
?>