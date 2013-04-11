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
	
	$login_status	= $re->getAdminLoginStatus();	 
	if(!$login_status)
	{ 
	   $redirect_to 	= ADMIN_FOLDER_PATH_HTTP.'index.php';
	   $re->redirectPage($redirect_to);
	}


	include(FUNCTION_DIR_PATH."paging.class_sub.php");	
    $AddCSS 		= array('style2'); 
    $AddJS 			= array('login');


    //for admin side payment - start
	if(isset($_POST['submit']))
	{ 
		$customer_id = base64_decode($_POST['customer_id']);
		$where_clause = "customer_id='$customer_id'";
		$cust_data = $s123_customer_manager->getAllS123Customer($where_clause);
		if($_POST['payment'] == "79.00")
		{
			$payment_mode = '1';
		}
		else
		{
			$payment_mode = '2';
		}
		$payment_date = date("Y-m-d H:i:s");

		$cust_data[0]->setFreeRecordsCount(-10000);
		$cust_data[0]->setPaymentMode($payment_mode);
		$cust_data[0]->setPaymentDate($payment_date);
		$s123_customer_manager->updateS123Customer($cust_data[0]);

		$_SESSION['Message'] = '65_1';
	}
	//for admin side payment - end


	//code for getting all the users with pagination and search starts
	
	$pagination_object					= new paging;
	$pagenum							= $pagination_object->setPageNumber(@$_REQUEST['page']);
	$maxrows							= $pagination_object->setDisplayRows(DEFAULT_ROWS_PER_PAGE);
	//$maxrows							= $pagination_object->setDisplayRows(5);
	$pagination_object->setURL($_SERVER['PHP_SELF'],base64_encode(serialize($_GET)));
 
 	$cust_id			= base64_decode($_REQUEST['cust_id']);
	
	$name		= stripslashes(trim($_REQUEST['first_name']));
	$email			= stripslashes(trim($_REQUEST['email']));
	$company_name	= stripslashes(trim($_REQUEST['company_name']));
	$last_name		= stripslashes(trim($_REQUEST['last_name']));
	$fsortorder		= $_REQUEST['fsortorder']; 
	$csortorder		= $_REQUEST['csortorder']; 
	$esortorder		= $_REQUEST['esortorder']; 
	$psortorder		= $_REQUEST['psortorder']; 
	$status			= $_REQUEST['status'];
    $status			= isset($status) && $status!=""? $status : '1';
	
	if(isset($_REQUEST['step']) && $_REQUEST['step'] == 'view'){
		//get parent user name
		$user_obj = $s123_customer_manager->getSingleS123Customer($cust_id);		
		$parent_user_name = $user_obj->name."'s";
	}
	
	$field			= array();
	$join			= array();
	$where			= array();
	$extra			= array();
	$where_clause	= "";
	$extra_clause	= "";
	
	$field[]		= " customer_id ";	
	$field[]		= " name ";
	//$field[]		= " last_name ";
	$field[]		= " company ";
	$field[]		= " email ";
	$field[]		= " last_login ";
	$field[]		= " phone ";
	$field[]		= " customer_status	";
	$field[]		= " fliptop_enable	";
	$field[]		= " parent_customer_id";
	$field[]		= " free_records_count";
	$field[]		= "	payment_mode ";
	
	
	
	if(isset($_REQUEST['step']) && $_REQUEST['step'] == 'view'){
		$where[]		= " user_type IN ('0','1') ";  
		$where[]		= " parent_customer_id = '$cust_id'";      
	}else{
		$where[]		= " user_type = '1'"	; 
		$where[]		= " parent_customer_id = '0'"	;      
	}
		
	$where[]		= " customer_status != '0'"	;    
	
	if($name!='')
		$where[]		= "name LIKE '%$name%'";

	/*if($last_name!='')		
		$where[]		= "last_name LIKE '%$last_name%'";*/
		
	if( $email != "" )	
		$where[] = "email='$email'";
		
	if( $company_name != "" )
		$where[] = "company LIKE '%$company_name%'";	
		
	
	if(is_array($where) && count($where)>0){
	 $where_clause  = implode(" AND ", $where);
	}
	

	
	try
	{
	 $countfield			= array();
	 $countfield[]		= " count(*) as totalrow ";	
	 $totalrowObj    	= $s123_customer_manager->getAllS123CustomerWithJoin($countfield, $join, $where_clause, $extra_clause);	 	
	 $totalrow			= $totalrowObj[0]->totalrow;

	}
	catch(Exception $e) 
	{
    }
		
	$sku_count=$pagination_object->setTotalPages($totalrow);
	if($sku_count <= $pagenum)	
	$pagenum			= @$pagination_object->setPageNumber($totalpages-1);
	$startrow			= $pagination_object->setStartRow(); 
	

	// CONCAT ORDER BY FIELD HERE
	$order_by 			= array();	
	if(isset($fsortorder) && $fsortorder!=""){	 
	  $order_by[]		= " name ".base64_decode($fsortorder); 
	}
	
	if(isset($csortorder) && $csortorder!=""){
	  $order_by[]		= " company ".base64_decode($csortorder); 
	}
	
	if(isset($esortorder) && $esortorder!=""){
	  $order_by[]		= " email ".base64_decode($esortorder); 
	}
	
	if(isset($psortorder) && $psortorder!=""){
	  $order_by[]		= " phone ".base64_decode($psortorder); 
	}
	
	if(is_array($order_by) && count($order_by)>0){
	  $extra[]	= " ORDER BY ".implode(" ,  ", $order_by);	 
	}else{
	  $extra[]	= " ORDER BY customer_id DESC "; 
	}
	
	// ORDER BY END HERE   
	$extra[]	= " LIMIT ".$startrow." ,".$maxrows;	
	
	if(is_array($extra) && count($extra)>0){
	 $extra_clause  	= implode(" ", $extra);
	}

	try
	{	
	
	$result_set	= $s123_customer_manager->getAllS123CustomerWithJoin($field, $join, $where_clause, $extra_clause);

	}
	catch(Exception $e) 
	{
    }
	
	// SET THE SORT  URL CODE HERE
     // SET THE SORT  URL CODE HERE
       // FIRST NAME
      $first_name_field 		=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('fsortorder','esortorder','psortorder','csortorder'));
	   if(isset($fsortorder) && $fsortorder!=""){	
	      if(base64_decode($fsortorder)=='ASC'){
		       
		    $first_name_field  	.= "&fsortorder=".base64_encode('DESC');		    
			$f_name_img		   	= "up-arrow.png";
		  }else{
		   $first_name_field  	.="&fsortorder=".base64_encode('ASC');
		   $f_name_img		   	= "arrow-down.png";
		  }
	   }else{
	      $first_name_field   	.="&fsortorder=".base64_encode('ASC');
	   }
	   
	  
	   // EMAIL FIELD 
	   $email_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)),array('esortorder','fsortorder','psortorder','csortorder'));
	   if(isset($esortorder) && $esortorder!=""){	
	      if(base64_decode($esortorder)=='ASC'){
		      $email_field 	  .= "&esortorder=".base64_encode('DESC');		    
			 $email_img	   	  = "up-arrow.png";
		  }else{
		     $email_field  	  .="&esortorder=".base64_encode('ASC');
		     $email_img		  = "arrow-down.png";
		  }
	   }else{
	       $email_field  	 .= "&esortorder=".base64_encode('ASC');
		   $email_img		  = "";
	   }  
	  //PHONE NO 	   
	  $phone_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('psortorder','esortorder','fsortorder','csortorder'));	  
	   if(isset($psortorder) && $psortorder!=""){	
	      if(base64_decode($psortorder)=='ASC'){
		      $phone_field   .= "&psortorder=".base64_encode('DESC');		    
			  $phone_img	 = "up-arrow.png";
		  }else{
		     $phone_field   .="&psortorder=".base64_encode('ASC');
		     $phone_img		= "arrow-down.png";
		  }
	   }else{
	       $phone_field 	.= "&psortorder=".base64_encode('ASC');
		   $phone_img		= "";
	   } 
	   //company
	  $company_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('csortorder','esortorder','fsortorder','psortorder'));	  
	   if(isset($csortorder) && $csortorder!=""){	
	      if(base64_decode($csortorder)=='ASC'){
		      $company_field   .= "&csortorder=".base64_encode('DESC');		    
			  $company_img	 = "up-arrow.png";
		  }else{
		     $company_field   .="&csortorder=".base64_encode('ASC');
		     $company_img		= "arrow-down.png";
		  }
	   }else{
	       $company_field 	.= "&csortorder=".base64_encode('ASC');
		   $company_img		= "";
	   } 
		
	//code for getting all the users with pagination and search ends

	include (VIEW_PATH."adminuser-listing.html");
?>