<?php
	@session_start();
	/**
	 * s123_group_users_registration_controller.php
	 *
	 * Description	: S123GroupUsersRegistration Controller Page
	 *
	 * Developed By : Suresh Shinde
	 *
	 * Developed On : 07 June, 2010
	 *
	 * Liscence 	: GPL
	 *
	 * Created On 	: 23/12/2010 11:49:34
	 *
	 * Created By 	: Abhijeet Jadhav
	 *
	 */

	/**
	 * Include Config File ( Please Confirm this Path with Your Project )
	 */
	include('../config/config.php');

	/**
	 * Set Page Name
	 */
	$page_name = 'indexController.php';

	/**
	 * Include Class file ( Please Confirm this Path with Your Project )
	 */
	$AddClass = array('reuse','s123_customer');
	include(CONFIG_CLASS_PATH."class.php");
	
	// check the login staus
	
	/**
	 * Fetch Step
	 */
	$step = $_REQUEST['step'];   
    $url_site_address_id = 1;   // currently we are consider only one site if change the site address wise user name   
	/**
	 * Set Redirect URL
	 */
	 
	$redirect_to = ADMIN_FOLDER_PATH_HTTP.'index.php';


	try
	{
		switch($step)
		{
			/**
			 * Add Record
			 */
			case 'login':
				$username		= $_POST['username'];
				$password		= $_POST['password'];
				$remember_me	= $_POST['remember_me'];
							
				$where_field	= array();
				$where_field[]  = " email= '".addslashes($username)."' ";
				$where_field[]  = " password= '".md5(trim($password))."' ";
				$where_field[]  = " customer_status= '1' ";		
				$where_field[]  = " user_type = '2'";	
			
				$where_clause   = implode(" AND ", $where_field);   
				
				$login_flag 	= false;
				
				$count = $s123_customer_manager->checkLoginStatus($where_clause);
				
				if($count > 0)
				{	
				  $login_flag          = true;
				}
				else
				{		
				   $post 			   = $_POST;
				   $_SESSION['post']   = $post;
				   $_SESSION['Message'] = 36 ;
				}
			    if($login_flag){								
				  $user_object	 		= $s123_customer_manager->getSingleS123CustomerWithUsername($where_clause);	 
				  $sesssion_name	  			= 'admin';
				  $_SESSION[$sesssion_name] 	= $user_object; 
				  echo $redirect_to 			= ADMIN_FOLDER_PATH_HTTP.'user-listing.php';
				   
				}  				  
				
				if($remember_me=="YES" && $login_flag){
				  $encode_password 	= base64_encode($_POST['password']);
				  $hour 			= time() + 60*60*24*30; 				  
				  @setcookie("rememberadmin[remember]" , $remember_me , $hour);
				  @setcookie("rememberadmin[username]" , $username , $hour);
				  @setcookie("rememberadmin[password]" , $encode_password  , $hour);				  
				}else{
				   if($login_flag){
					   $hour 			= time() - 60*60*24*30; 
					   $remember_me		= "";	
					   $username        = ""; 
					   $encode_password = "";
					   @setcookie("rememberadmin[remember]" , $remember , $hour);
					   @setcookie("rememberadmin[username]" , $username , $hour);
					   @setcookie("rememberadmin[password]" , $encode_password  , $hour);	
				   } 
				}
							
				break;   
				
			case 'viewdashboard':
				$cutId	= $_REQUEST['cust_id'];
				$customerId	= base64_decode($cutId);	
				$where_field	= array();
				$where_field[]  = " customer_id= '".$customerId."' ";				
				$where_field[]  = " user_type IN ('0','1') ";		
				$where_field[]  = " ( customer_status= '1') ";				
				$where_clause   = implode(" AND ", $where_field);   
				 
				$count = $s123_customer_manager->checkLoginStatus($where_clause);

				if($count > 0){	
					$login_flag = true;
				}else{		    
					$redirect_to = 'user-listing.php';	
					$_SESSION['Message'] = 36 ;
				}						
				
			    if($login_flag){
					$redirect_to = FOLDER_PATH_HTTP.'contacts.php';								
				   $user_object 	= $s123_customer_manager->getSingleS123CustomerWithUsername($where_clause);
				  
				  try{
				 // $s123uesr = $s123_customer_manager->getSingleS123Customer($user_object->customer_id);
				  //$s123uesr->setLastLogin(date('Y-m-d H:i:s'));
				//  $s123_customer_manager->updateS123Customer($s123uesr);
				  }catch(Exception $e){}				 
				  $check_usre_for  = "login_user";
				  $_SESSION[$check_usre_for] =   $user_object;			  
				}  			
							
			break;	
			case 'logout':
			    //$site_address_id = $_SESSION['admin_site_address_id']; 
				//$loginkey		= "admin".$site_address_id;
				$loginkey		= "admin";
			  	if(isset($_SESSION[$loginkey])){				  
				  $user_object		= $_SESSION[$loginkey];
				  $massage = 492; 
				  $_SESSION['Message'] = $massage;
				  $redirect_to		 = ADMIN_FOLDER_PATH_HTTP.'index.php';
				 
				  unset($_SESSION[$loginkey]);
				}    
			break; 	
			case 'forgot_password':
					$redirect_to 	= FOLDER_PATH_HTTP.'forgot-password.php';     		
					$username		= $_POST['username'];
					  	  
					   
					if(isset($username) && $username!=""){
					    $where_field	= array();
						
						$where_field[]  = " email= '".addslashes($username)."' ";					 
						$where_field[]  = " customer_status= '1' ";		
							$where_field[]  = " user_type = '2'";	
						$where_clause   = implode(" AND ", $where_field);
						
						$count = $s123_customer_manager->checkLoginStatus($where_clause);
						
						if($count > 0){	
						    $user_object 	= $s123_customer_manager->getSingleS123CustomerWithUsername($where_clause);
							print_r( $user_object);
							 $first_name 	= $user_object->first_name;
							 $last_name 	= $user_object->last_name;	
							 $email			= $user_object->email;
							 $group_user_id = $user_object->customer_id;
							 $group_user_parent_id		 = $user_object->parent_customer_id;
							 
							 						 
							  $s123_customer 	= $s123_customer_manager->getSingleS123Customer($where_clause);
							 
							 $password 				= $re->generatePassword(6,2);
							 $hash_password 		= md5($password); 
							 $s123_customer->setPassword(stripslashes($hash_password ));
							 $s123_customer_manager->updateS123Customer($s123_customer);
							
							 $massage = 59;    
						}else{
						  $massage = 58; 
						}  
				   }else{
				      $massage = 58;
				   }
				   	
				   // INTEGRATED EMAIL TEMPLATE HERE
				  //send email to user
		$redirect_to 	= FOLDER_PATH_HTTP.'login.php'; 
		$_SESSION['pricing'] = $_POST;
		
				require(MODULES_DIR_PATH."email/email-templates.php"); 
				$link = FOLDER_PATH_HTTP.'upload-csv.php?code='.base64_encode($customer_id);
				$sample_link = FOLDER_PATH_HTTP.'login.php';
				$copyright_year = GET_CURRENT_YEAR_COPYRIGHT;
									 
				$html_template = '<div style="width:750px; margin:0 auto;  border:1px solid #999">
							<div style="margin:0 auto; background:#BCBCBC; height:120px; border-bottom:3px solid #99cccc">
							  <div style="width:971px; margin:0 auto;">
								<div style="padding:8px; padding-left:19px; float:left;">
								 <img src="{site_logo}" />
								</div>    					 
							  </div>
							</div>  
							<div style="padding:20px">  						  
														
								<table width="700px" border="0"  cellpadding="5" cellspacing="2">
								  
								 <tr>
									<td align="left"  valign="top">
									 <br/>
									 <table width="700px" border="0" cellspacing="5" cellpadding="2" >                        
										

										<tr>
										  <td align="left" valign="top">Dear {first_name},</td>
									   </tr>
										<tr>
										  <td align="left" valign="top">&nbsp;</td>
									   </tr>
										<tr>
										  <td align="left" valign="top">Your Social123 Password has been reset. Please use the credentials below to login to the site. You may change your password once logged in by selecting the "Settings" tab within your account.</td>
									   </tr>																												
										<tr>
										  <td align="left" valign="top"><a href="{sample_link}" target="_blank">{sample_link}</a></td>
									   </tr>
										<tr>
										  <td align="left" valign="top">Email: {email}</td>
									   </tr>
										<tr>
										  <td align="left" valign="top">Password: {password}</td>
									   </tr>
										<tr>
										  <td align="left" valign="top">&nbsp;</td>
									   </tr>
										<tr>
										  <td align="left" valign="top">Sincerely,</td>
									   </tr>
										<tr>
										  <td align="left" valign="top">
Social123.com<br>
1 888 530 6723<br>
Socially Enable your Data Today<br><br>

Headquarters:<br>
599 West Crossville Road, Roswell, GA 30075<br><br>

Regional Support:<br>
78 Alexander Street, Charleston, SC 29403</td>
									   </tr>
										<tr><td align="left" valign="top">&nbsp;</td>
									   </tr>
									</table>	
									</td>
								</tr>							
							   </table>		 							
</div> 							
								 <div style="padding: 20px 0pt;background:#eeeeee; overflow:hidden; padding:30px 0; border-top:1px solid #ccc;">					   <div style="margin:0 auto; width:971px;">
								   <div style="float:left; width:730px;">      
									&nbsp;&nbsp; Copyright &copy; '.$copyright_year.' by social123 LLC. All rights reserved
								   </div>
								</div>
</div>
								</div>';
				
			
				$data = array();
				$sitelogo = FOLDER_PATH_HTTP.'images/livesite/logo.png';
				$data['site_name'] = 'Social123';
				
				$data['first_name'] = $first_name;
				$data['email'] = $email;
				$data['password'] = $password;
				$data['sample_link'] = $sample_link;
				$data['site_logo'] = $sitelogo;
				
				$data['copyright_year'] = date("Y",time()); 
												   
				$formname = 'Social123 Team';
				$form_email = 'support@social123.com';
				$subject	    = " Social 123 Password Help";		
				$email_subject = $subject;
				 
				
				$body_pattern_count = 0;
				$pattern = "#[{]([a-zA-Z_0-9]+)[}]#";
				preg_match_all($pattern,$html_template,$email_body_out,PREG_SET_ORDER);	
							
				//replace email body pattern
				for($out_i=0;$out_i<(count($email_body_out));$out_i++)
				{
					$replace_var="";
					$find_var		=	$email_body_out[$out_i][0];	
					$replace_var	=	$data[$email_body_out[$out_i][1]];									
					if(trim($replace_var)!="")
					{
						$body_pattern_count++;
						$html_template	 =	str_replace($find_var,$replace_var,$html_template);
					}
				}						 
				
				$mailtext = $html_template;						
				
				//$email_to = 'bitspm6@gmail.com';
				$email_to = $email;
				//for testing
				//$email_to = 'bitspm6@gmail.com';
				//require(MODULES_DIR_PATH."email/send-email.php");					  
				   // END HERE 
				   	$_SESSION['Message'] = $massage;
			    break;	
										   			   						
			default:
				/**
				 * Invalid Action Meassage
				 */
				$_SESSION['Message'] =  0;
				break;
		}
	}
	catch(Exception $e)
	{
		$_SESSION['Message']	=	0;
	}

	 /**
	  * Redirect to Listing
	 */
	$re->redirectPage($redirect_to);
?>