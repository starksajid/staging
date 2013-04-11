 <?php
	/**************************************************************
	*  pricing.php
	*  File used as pricing page for in Social123
	*  Author: Benchmark, Last Modified: 15/12/2011
	*  Created By: Devyani Karmarkar
	***************************************************************/

	include("../config/config.php");

	$page='login.php';
	$AddClass  		= array('reuse','s123_pdf_contacts');	
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


	//code for getting all the users with pagination and search starts
	
	$pagination_object					= new paging;
	$pagenum							= $pagination_object->setPageNumber(@$_REQUEST['page']);
	$maxrows							= $pagination_object->setDisplayRows(DEFAULT_ROWS_PER_PAGE);
	//$maxrows							= $pagination_object->setDisplayRows(5);
	$pagination_object->setURL($_SERVER['PHP_SELF'],base64_encode(serialize($_GET)));
 
 	$cust_id			= base64_decode($_REQUEST['cust_id']);
	
	$first_name		= stripslashes(trim($_REQUEST['first_name']));
	$email			= stripslashes(trim($_REQUEST['email']));
	$company_name	= stripslashes(trim($_REQUEST['company_name']));
	$from_dateParam = $re->convertDate($_REQUEST['from_date']);
	$to_dateParam = $re->convertDate($_REQUEST['to_date']);	
	$fsortorder		= $_REQUEST['fsortorder']; 
	$csortorder		= $_REQUEST['csortorder']; 
	$esortorder		= $_REQUEST['esortorder']; 
	$psortorder		= $_REQUEST['psortorder'];
	$p1sortorder	= $_REQUEST['p1sortorder']; 
	$dsortorder		= $_REQUEST['dsortorder'];
	$status			= $_REQUEST['status'];
    $status			= isset($status) && $status!=""? $status : '1';
	
	if(isset($_REQUEST['step']) && $_REQUEST['step'] == 'view'){
		//get parent user name
		$user_obj = $s123_pdf_contacts_manager->getSingleS123Customer($cust_id);		
		$parent_user_name = $user_obj->first_name."'s";
	}
	
	$field			= array();
	$join			= array();
	$where			= array();
	$extra			= array();
	$where_clause	= "";
	$extra_clause	= "";
	
	$field[]		= " contact_id ";	
	$field[]		= " name ";
	$field[]		= " company ";
	$field[]		= " email ";
	$field[]		= " phone ";
	$field[]		= " created_date	";
	$field[]		= " pdfname	";
	//$field[]		= " filename	";
		
		
	$where[]		= " delete_status ='1'"	;    
	
	if($first_name!='')
		$where[]		= "name LIKE '%$first_name%'";
	
	if( $email != "" )	
		$where[] = "email='$email'";
		
	if( $company_name != "" )
		$where[] = "company LIKE '%$company_name%'";	
	
	if(($from_dateParam != "" &&  $to_dateParam != ""))
		$where[] = " created_date >= '$from_dateParam' and created_date <= '$to_dateParam'";	
		
	
	if(is_array($where) && count($where)>0){
	 $where_clause  = implode(" AND ", $where);
	}
		
	try
	{
	 $countfield			= array();
	 $countfield[]		= " count(*) as totalrow ";	
	 $totalrowObj    	= $s123_pdf_contacts_manager->getAllS123PdfContactsWithJoin($countfield, $join, $where_clause, $extra_clause);	 	
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
	if(isset($dsortorder) && $dsortorder!=""){
	  $order_by[]		= " created_date ".base64_decode($dsortorder); 
	}
	
	if(isset($esortorder) && $esortorder!=""){
	  $order_by[]		= " email ".base64_decode($esortorder); 
	}
	
	if(isset($psortorder) && $psortorder!=""){
	  $order_by[]		= " phone ".base64_decode($psortorder); 
	}
	if(isset($p1sortorder) && $p1sortorder!=""){
	  $order_by[]		= " pdfname ".base64_decode($p1sortorder); 
	}
	
	if(is_array($order_by) && count($order_by)>0){
	  $extra[]	= " ORDER BY ".implode(" ,  ", $order_by);	 
	}else{
	  $extra[]	= " ORDER BY contact_id	 DESC "; 
	}
	
	// ORDER BY END HERE   
	$extra[]	= " LIMIT ".$startrow." ,".$maxrows;	
	
	if(is_array($extra) && count($extra)>0){
	 $extra_clause  	= implode(" ", $extra);
	}

	try
	{	
	
	$result_set	= $s123_pdf_contacts_manager->getAllS123PdfContactsWithJoin($field, $join, $where_clause, $extra_clause);

	}
	catch(Exception $e) 
	{
    }
	
	// SET THE SORT  URL CODE HERE
     // SET THE SORT  URL CODE HERE
       // FIRST NAME
      $first_name_field 		=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('fsortorder','esortorder','psortorder','csortorder','p1sortorder','dsortorder'));
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
	   $email_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)),array('esortorder','fsortorder','psortorder','csortorder','p1sortorder','dsortorder'));
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
	  $phone_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('psortorder','esortorder','fsortorder','csortorder','p1sortorder','dsortorder'));	  
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
	   
	    //PDF
	  $pdf_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('p1sortorder','psortorder','esortorder','fsortorder','csortorder','dsortorder'));	  
	   if(isset($p1sortorder) && $p1sortorder!=""){	
	      if(base64_decode($p1sortorder)=='ASC'){
		      $pdf_field   .= "&p1sortorder=".base64_encode('DESC');		    
			  $pdf_img	 = "up-arrow.png";
		  }else{
		     $pdf_field   .="&p1sortorder=".base64_encode('ASC');
		     $pdf_img		= "arrow-down.png";
		  }
	   }else{
	       $pdf_field 	.= "&p1sortorder=".base64_encode('ASC');
		   $pdf_img		= "";
	   } 
	   //company
	  $company_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('csortorder','esortorder','fsortorder','psortorder','p1sortorder','dsortorder'));	  
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
	   
	     //date 	   
	  $date_field 	=  $re->getSortURL( $_SERVER['PHP_SELF'],base64_encode(serialize($_GET)), array('dsortorder','csortorder','esortorder','fsortorder','psortorder','p1sortorder'));	  
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
	   
	//code for getting all the users with pagination and search ends
		   
	//code to export contacts starts

	if(isset($_REQUEST['export']))
	{
		$field			= array();
	$join			= array();
	$where			= array();
	$extra			= array();
	$where_clause	= "";
	$extra_clause	= "";
	

	$field[]		= " name ";
	$field[]		= " company ";
	$field[]		= " email ";
	$field[]		= " phone ";
	//$field[]		= " delete_status	";
	$field[]		= " pdfname	";
	//$field[]		= " filename	";
		
		
	$where[]		= " delete_status ='1'"	;    
	
	if($first_name!='')
		$where[]		= "name LIKE '%$first_name%'";
	
	if( $email != "" )	
		$where[] = "email='$email'";
		
	if( $company_name != "" )
		$where[] = "company LIKE '%$company_name%'";	
	
	if(($from_dateParam != "" &&  $to_dateParam != ""))
		$where[] = " created_date >= '$from_dateParam' and created_date <= '$to_dateParam'";	
		
	
	if(is_array($where) && count($where)>0){
	 $where_clause  = implode(" AND ", $where);
	}
		
	try
	{
	 $countfield			= array();
	 $countfield[]		= " count(*) as totalrow ";	
	 $totalrowObj    	= $s123_pdf_contacts_manager->getAllS123PdfContactsWithJoin($countfield, $join, $where_clause, $extra_clause);	 	
	 $totalrow			= $totalrowObj[0]->totalrow;

	}
	catch(Exception $e) 
	{
    }
		
	$sku_count=$pagination_object->setTotalPages($totalrow);
	if($sku_count <= $pagenum)	
	$pagenum			= @$pagination_object->setPageNumber($totalpages-1);
	$startrow			= $pagination_object->setStartRow(); 
	

	
	 $extra[]	= " ORDER BY contact_id	 DESC "; 
	
	
	// ORDER BY END HERE   
	//$extra[]	= " LIMIT ".$startrow." ,".$maxrows;	
	
	if(is_array($extra) && count($extra)>0){
	 $extra_clause  	= implode(" ", $extra);
	}

	try
	{	
	
	$result_set	= $s123_pdf_contacts_manager->getAllS123PdfContactsWithJoin($field, $join, $where_clause, $extra_clause);

	}
	catch(Exception $e) 
	{
    }
		if(count($result_set)>0)
		{				
		  $filename.= date('Ymd') . ".xls";
	
		  header("Content-Disposition: attachment; filename=\"$filename\"");
		  header("Content-Type: application/msexcel");
		  header("Content-Transfer-Encoding: binary");
		  header("Pragma: no-cache");
		  header("Expires: 0");
		  $flag = false;
		  foreach($result_set as $row) {
		  $row = (array)$row;
		
		  array_walk($row, 'cleanDataCsv');
			if(!$flag) {
			  # display field/column names as first row
			  echo implode("\t", array_keys($row)) . "\r\n";
			  $flag = true;
			}
			echo implode("\t", array_values($row)) . "\r\n";
		  }
		  exit;
		}
		else
		{
			$redirect_to = ADMIN_FOLDER_PATH_HTTP.'pdf-downloads.php';
			$_SESSION['Message'] = 185;
			$re->redirectPage($redirect_to);
		}
	}  
	function cleanDataCsv(&$str)
	{
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
	}
	//code to export contacts ends  
		

	//delete code starts
	if(isset($_REQUEST['step']) && $_REQUEST['step'] == 'delete'){
		$redirect_to = ADMIN_FOLDER_PATH_HTTP.'pdf-downloads.php';
		$contact_id = base64_decode($_REQUEST['contact_id']);
		$s123_pdf_contacts_manager->softdeleteS123Contact($contact_id);		
		$_SESSION['Message'] = '52';
		$re->redirectPage($redirect_to);
	}
	//delete code ends
	
	
   	include (VIEW_PATH."adminpdf-downloads.html");	
?>