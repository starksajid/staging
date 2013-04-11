<?php
/***
*   config.php
*   File used to store the configuration details of Social123
*	@Date  : December 01 ,2010		Version: 1.0

*/
	@include("config.base.php");
	if(!defined("PROTOCOL"))
	{
		@header("Location: install/");
		exit;
	}

	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	define("ROOT_PATH",BASE_PATH);
	define("FOLDER_PATH",BASE_PATH);
	define("FOLDER_PATH_HTTP",SERVER_PATH);
	define('FULL_PATH',FOLDER_PATH_HTTP);

  

	//======== Admin Path =============//
	define("ADMIN_FOLDER_PATH",BASE_PATH."admin/");
	define("ADMIN_FOLDER_PATH_HTTP",FOLDER_PATH_HTTP."admin/");

	//======== Include Directory Path =============//
	define("INCLUDE_DIR_PATH",FOLDER_PATH."includes/");
	define("INCLUDE_HTTP_PATH",FOLDER_PATH_HTTP."includes/");

	//======== Classes Directory Path =============//
	define("CLASS_DIR_PATH",INCLUDE_DIR_PATH."classes/");

	//======== Functions & Modules Path =============//
	define("FUNCTION_DIR_PATH",INCLUDE_DIR_PATH."functions/");
	define("MODULES_DIR_PATH",INCLUDE_DIR_PATH."modules/");

	//==== HTML View Path =====//
	define("VIEW_PATH",FOLDER_PATH."views/");
	define("WIDGET_PATH",FOLDER_PATH."widget/");

	//==== Header Footer Path =====//
	define("HEADER_PATH",INCLUDE_DIR_PATH."navigation/");
	define("FOOTER_PATH",INCLUDE_DIR_PATH."navigation/");

	//==== Path for CSS Stylesheet ====//
	define("STYLE_ROOT_PATH",INCLUDE_HTTP_PATH."styles/");
	define("ADMIN_STYLE_ROOT_PATH",INCLUDE_HTTP_PATH."styles/");

	//=====Path  for Images===//
	define("IMAGES_PATH",FOLDER_PATH_HTTP."images/");
	define("ADMIN_IMAGES_PATH",FOLDER_PATH_HTTP."images/");
	
	//======path logo site =====//
	define("SITE_LOGO_IMAGES_BASE_PATH", BASE_PATH."images/sitelogo/");
	define("SITE_LOGO_IMAGES_PATH",FOLDER_PATH_HTTP."images/sitelogo/");
	define("SITE_LOGO_ADMIN_IMAGES_PATH",FOLDER_PATH_HTTP."images/sitelogo/");
	//======== END HERE============ //
	

	//====Path for Java Scripts Directory ====//
	define("JSCRIPT_ROOT_PATH",INCLUDE_HTTP_PATH."jscripts/");
	define("ADMIN_JSCRIPT_ROOT_PATH",INCLUDE_HTTP_PATH."jscripts/");

	//========= Loacl Image Path =====//
	define("IMAGE_ROOT_PATH",ROOT_PATH);
	define("IMAGE_MAIN_PATH",ROOT_PATH);	
	
	//======== class config Path =============//
	define("CONFIG_CLASS_PATH", BASE_PATH."config/");
	
	//======== Default row per pages =============//
	define("DEFAULT_ROWS_PER_PAGE", 10);
	
	//======== FACEBOOK Api Details =============//
	if(getSiteAddressForFB()!=33)
	{
		define("FACEBOOK_APP_ID", 144151372312594);
		define("FACEBOOK_APP_SECRET", "197224f10b3ff7896543a7e3140b2da8");
		define("FACEBOOK_CALL_URL", "https://graph.facebook.com/oauth/authorize?client_id=".FACEBOOK_APP_ID."&    redirect_uri=http://social123.iphoneappdev.net/version3/customerapi-accounts-controller.php?type=apifacebook&scope=user_photos,user_videos,publish_stream,offline_access,user_status,email,user_likes,user_activities,read_stream,read_mailbox,user_photo_video_tags,user_groups,user_notes,read_requests,user_events,user_birthday,friends_birthday, manage_pages"); 
		define("FACEBOOK_REDIRECT_URL", "http://social123.iphoneappdev.net/version3/customerapi-accounts-controller.php?type=apifacebook");
		define("FACEBOOK_AUTH_ACCESS_URL", "https://graph.facebook.com/oauth/access_token");
	}
	else
	{
		define("FACEBOOK_APP_ID", 159837837406002);
		define("FACEBOOK_APP_SECRET", "02c37248f81db57fd4512bd9cebd3a22");
		define("FACEBOOK_CALL_URL", "https://graph.facebook.com/oauth/authorize?client_id=".FACEBOOK_APP_ID."&    redirect_uri=http://social123.iphoneappdev.net/version3/customerapi-accounts-controller.php?type=apifacebook&scope=user_photos,user_videos,publish_stream,offline_access,user_status,email,user_likes,user_activities,read_stream,read_mailbox,user_photo_video_tags,user_groups,user_notes,read_requests,user_events,user_birthday,friends_birthday, manage_pages"); 
		define("FACEBOOK_REDIRECT_URL", "http://social123.iphoneappdev.net/version3/customerapi-accounts-controller.php?type=apifacebook");
		define("FACEBOOK_AUTH_ACCESS_URL", "https://graph.facebook.com/oauth/access_token");
	
	}
	
	
	//======== LINKEDIN Api Details =============//
	define("LINKEDIN_APP_ID", 'p7ol47lzQKpecGRHVlmfDy6_MjpByGFm5OmBsg6aSpYacytKGOe7-QvtlbWkWrFN'); //considered app key
	define("LINKEDIN_APP_SECRET", "evl06VZ-onMNKOgBS3CmnT412hkQOPFTVsMfh_99Cxths7jwqp0CP0z6NgNP3q6T");
	define("LINKEDIN_BASE_URL", 'http://social123.iphoneappdev.net/version3/includes/modules/api/linkedin/auth.php');
	define("LINKEDIN_CALLBACK_URL", "http://social123.iphoneappdev.net/version3/customerapi-accounts-controller.php?type=apilinkedin");
		
	//======== TWITTER Api Details =============//
	define("TWITTER_APP_ID", '0glcK31gMAUTJIaMM9wqzQ');
	define("TWITTER_CONSUMER_KEY", "0glcK31gMAUTJIaMM9wqzQ");
	define("TWITTER_CONSUMER_SECRET", "v8mk35OPaYhAPtx1fQWq7wcvX63rFs6gI0ydZxvFojI");
	
	//======== TYPEPAD Api Details =============//
	define("TYPEPAD_API_ID", "6p0147e2679f4a970b");
	define("TYPEPAD_CONSUMER_KEY", "59d286e11378bcaf");
	define("TYPEPAD_CONSUMER_SECRET", "zALlDLgN");
	define("TYPEPAD_ANONYMOUS_ACCESS_KEY", "rJnMiPozgRApVoHi");
	define("TYPEPAD_ANONYMOUS_ACCESS_SECRET", "QW2ZpQ9ahZY0Z9yr");
	define("TYPEPAD_LIBRARY_PATH",BASE_PATH."includes/modules/api/typepad/extlib/");
	
	//======== FLICKR Api Details =============//
	define("FLICKR_API_KEY", "64b911c6c3451f8a0cb6b79c7df92f89");
	define("FLICKR_API_SECRET", "28be7c9c78913013");
	
	//======== BITLY Api Details =============//
	define("BITLY_API_KEY", "R_a617642dda3acb960b1091a32921f76c");
	
	//======== YELP Api Details =============//
	define("YELP_ACCESS_KEY", "pZzV0P3Avbd0Z_gNhcyrBQ"); //considered ywsid
	define("YELP_CONSUMER_KEY", "1SiHPjbQLdGflnGz_Au5Ww");
	define("YELP_CONSUMER_SECRET", "198CSz1REDWgxWb7VO4OXs49lyg");
	define("YELP_TOKEN_KEY", "8Wh6sIhXbQDUtBMgc_ZWbZoOnPjhhQWo");
	define("YELP_TOKEN_SECRET", "uBzsjdajkAwZqREdJkvf5-PhCtc");

	//======== CITYSEARCH Api Details =============//	
	define("CITYSEARCH_API_KEY", "wunubuu3x9g95fwnujuqwy2u");
	define("CITYSEARCH_PUBLISHER_CODE", "0361521546");
	
	//======== Google Search API Details =============//
	define("GOOGLE_NEWS_SEARCH_API_KEY",'ABQIAAAAOL9WzdFC4ioGE8GsvotbOBRcrrpfjcqFINRJb9NQkON8iDzNExThSGnHR4dICJGSFVXAGPpYOKzwUw');

   //======== Default package duration =============//
	define("PACKAGE_DURATION", 7); 
 
	function getSiteAddressForFB()
	{
		$AddClass  		= array();
		include(CONFIG_CLASS_PATH."class.php"); 
		$siteaddress = $_REQUEST['siteaddress'];
		require_once(CLASS_DIR_PATH."s123_site_address/S123SiteAddressManager.php");
		$site_address_manager	= 	new S123SiteAddressManager();
		$site_address_object	=	new S123SiteAddress();
		
		
		
		if(isset($_SESSION['CustiomizeSiteDetails']) && is_object($_SESSION['CustiomizeSiteDetails']) && $siteaddress==""){	  
		  $site_address_row 		= $_SESSION['CustiomizeSiteDetails'];	   
		  $siteaddress		 		= $site_address_row->site_address;
		}else{ 
		  if(isset($siteaddress) && $siteaddress!="" ){
			$siteaddress 	= $siteaddress;
		  }else{
			$siteaddress	= "social123";
		  }	  	 
		}
	 
		 
		$where_clause					 	= " site_address='".$siteaddress."' AND site_address_status='1' ";
		$site_address_row				 	= $site_address_manager ->getSingleS123SiteAddressWithWhere($where_clause); 
		$current_site_address_id			= $site_address_row->site_address_id;
		return $current_site_address_id;
	}
?>
