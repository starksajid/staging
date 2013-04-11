 <?php
	/**************************************************************
	*  pricing.php
	*  File used as pricing page for in Social123
	*  Author: Benchmark, Last Modified: 15/12/2011
	*  Created By: Devyani Karmarkar
	***************************************************************/

	include("../config/config.php");

	$page='login.php';
	$AddClass  		= array('reuse','s123_customer','s123_customer_payments');	
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
    $AddJS 			= array();
	
	$from_dateParam = $re->convertDate($_REQUEST['from_date']);
	$to_dateParam = $re->convertDate($_REQUEST['to_date']);	
	if(strtotime($from_dateParam) > strtotime($to_dateParam))
	{
		$_SESSION['Message'] = '293'; 
		$re->redirectPage('payment-listing.php');
		exit;
	}	

	//code for getting all the users with pagination and search starts
	
	$pagination_object					= new paging;
	$pagenum							= $pagination_object->setPageNumber(@$_REQUEST['page']);
	$maxrows							= $pagination_object->setDisplayRows(DEFAULT_ROWS_PER_PAGE);
	//$maxrows							= $pagination_object->setDisplayRows(5);
	$pagination_object->setURL($_SERVER['PHP_SELF'],base64_encode(serialize($_GET)));
 
	
	$name			= stripslashes(trim($_REQUEST['first_name'])); 
	$email			= stripslashes(trim($_REQUEST['email']));
	$company_name			= stripslashes(trim($_REQUEST['company_name']));
	$last_name			= stripslashes(trim($_REQUEST['last_name']));
	$from_dateParam = $re->convertDate($_REQUEST['from_date']);
	$to_dateParam = $re->convertDate($_REQUEST['to_date']);	
	$fsortorder		= $_REQUEST['fsortorder']; 
	$lsortorder		= $_REQUEST['lsortorder']; 
	$esortorder		= $_REQUEST['esortorder']; 
	$lisortorder		= $_REQUEST['lisortorder'];
	$tsortorder		= $_REQUEST['tsortorder'];
	$asortorder		= $_REQUEST['asortorder'];
	$dsortorder		= $_REQUEST['dsortorder'];
	$status			= $_REQUEST['status'];
    $status			= isset($status) && $status!=""? $status : '1';
	$currTime=time();
	$field			= array();
	$join			= array();
	$where			= array();
	$extra			= array();
	$where_clause	= "";
	$extra_clause	= "";
	
	$field = array(
		' pay.* , cust.*,pay.created_date as pay_date'//, list.list_title '
	);
			
	$join = array(	
			//' join s123_social_profile_list as list on list.list_id = pay.list_id'		
			' join s123_customer as cust on cust.customer_id = pay.customer_id'		
		);
	
	$where[]		= " cust.parent_customer_id = '0' "	;    
	$where[]		= " cust.customer_status ='1'"	;    
	
//	$where[]		= " pay.customer_id ='1'"	;  
	$where[]		= " pay.payment_status ='1'"	;   
	
	
	if($name!='')
		$where[]		= "cust.name LIKE '%$name%'";

	if($last_name!='')		
		$where[]		= "cust.last_name LIKE '%$last_name%'";
		
	if( $email != "" )	
		$where[] = "cust.email = '$email'";
		
	if( $company_name != "" )
		$where[] = "cust.company LIKE '%$company_name%'";	
	
	if(($from_dateParam != "" &&  $to_dateParam != ""))
		$where[] = " pay.created_date >= '$from_dateParam' and pay.created_date <= '$to_dateParam'";	
	
	if(is_array($where) && count($where)>0){
		$where_clause  = implode(" AND ", $where);
	}
	
	try
	{
	 $countfield			= array();
	 $countfield[]		= " count(*) as totalrow ";	
	 $totalrowObj    	= $s123_customer_payments_manager->getAllS123CustomerPaymentsWithJoin($countfield, $join, $where_clause, $extra_clause);	 	
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
	  $order_by[]		= " cust.name ".base64_decode($fsortorder); 
	}
	
	if(isset($esortorder) && $esortorder!=""){
	  $order_by[]		= " cust.email ".base64_decode($esortorder); 
	}
	
	if(isset($lisortorder) && $lisortorder!=""){
	  $order_by[]		= " pay.list_title ".base64_decode($lisortorder); 
	}
	
	if(isset($tsortorder) && $tsortorder!=""){
	  $order_by[]		= " pay.total_records ".base64_decode($tsortorder); 
	}
	
	if(isset($dsortorder) && $dsortorder!=""){
	  $order_by[]		= " pay.created_date ".base64_decode($dsortorder); 
	}
	
	
	if(isset($asortorder) && $asortorder!=""){
	  $order_by[]		= " pay.amount ".base64_decode($asortorder); 
	}
	
	
	if(is_array($order_by) && count($order_by)>0){
	  $extra[]	= " ORDER BY ".implode(" ,  ", $order_by);	 
	}else{
	  $extra[]	= " ORDER BY pay.payment_id DESC "; 
	}
	
	
	
	// ORDER BY END HERE   
	$extra[]	= " LIMIT ".$startrow." ,".$maxrows;	
	
	if(is_array($extra) && count($extra)>0){
	  $extra_clause  	= implode(" ", $extra);
	}

	try
	{	
	
	$result_set	= $s123_customer_payments_manager->getAllS123CustomerPaymentsWithJoin($field, $join, $where_clause, $extra_clause);
	
	}
	catch(Exception $e) 
	{
    }
	
	// SET THE SORT  URL CODE HERE
       // FIRST NAME
    $first_name_field 		=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('fsortorder','esortorder','lisortorder','tsortorder','asortorder','dsortorder'));
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
	   $email_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)),array('esortorder','fsortorder','lisortorder','tsortorder','asortorder','dsortorder'));
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
	     
	  //list title 	   
	  $list_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('lisortorder','fsortorder','esortorder','tsortorder','asortorder','dsortorder'));	  
	   if(isset($lisortorder) && $lisortorder!=""){	
	      if(base64_decode($lisortorder)=='ASC'){
		      $list_field   .= "&lisortorder=".base64_encode('DESC');		    
			  $list_img	 = "up-arrow.png";
		  }else{
		     $list_field   .="&lisortorder=".base64_encode('ASC');
		     $list_img		= "arrow-down.png";
		  }
	   }else{
	       $list_field 	.= "&lisortorder=".base64_encode('ASC');
		   $list_img		= "";
	   } 
	  
	    //total records	   
	  $total_records_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('tsortorder','fsortorder','esortorder','lisortorder','asortorder','dsortorder'));	  
	   if(isset($tsortorder) && $tsortorder!=""){	
	      if(base64_decode($tsortorder)=='ASC'){
		      $total_records_field   .= "&tsortorder=".base64_encode('DESC');		    
			  $total_records_img	 = "up-arrow.png";
		  }else{
		     $total_records_field   .="&tsortorder=".base64_encode('ASC');
		     $total_records_img		= "arrow-down.png";
		  }
	   }else{
	       $total_records_field 	.= "&tsortorder=".base64_encode('ASC');
		   $total_records_img		= "";
	   } 
	   
	     //date 	   
	  $date_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('dsortorder','asortorder','fsortorder','esortorder','tsortorder','lisortorder'));	  
	   if(isset($dsortorder) && $dsortorder!=""){	
	      if(base64_decode($dsortorder)=='ASC'){
		      $date_field   .= "&dsortorder=".base64_encode('DESC');		    
			  $date_img	 = "up-arrow.png";
		  }else{
		     $date_field   .="&dsortorder=".base64_encode('ASC');
		     $date_img		= "arrow-down.png";
		  }
	   }else{
	       $date_field 	.= "&dsortorder=".base64_encode('ASC');
		   $date_img		= "";
	   }  
	   
	     //amount 	   
	  $amount_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('asortorder','fsortorder','esortorder','tsortorder','lisortorder','dsortorder'));	  
	   if(isset($asortorder) && $asortorder!=""){	
	      if(base64_decode($asortorder)=='ASC'){
		      $amount_field   .= "&asortorder=".base64_encode('DESC');		    
			  $amount_img	 = "up-arrow.png";
		  }else{
		     $amount_field   .="&asortorder=".base64_encode('ASC');
		     $amount_img		= "arrow-down.png";
		  }
	   }else{
	       $amount_field 	.= "&asortorder=".base64_encode('ASC');
		   $amount_img		= "";
	   }  
		
	//code for getting all the users with pagination and search ends
	
   	include (VIEW_PATH."adminuser-payments.html");	
?>