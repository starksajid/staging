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
	
	date_default_timezone_set("America/Denver");
	ini_set("memory_limit",'64M');
	
	//ini_set("session.cookie_domain", ".social123.com");
	//error_reporting(E_ERROR | E_WARNING | E_PARSE);
	//error_reporting(E_ALL);
	ini_set('display_errors','0');
	
	define("ROOT_PATH",BASE_PATH);
	define("FOLDER_PATH",BASE_PATH);
	define("FOLDER_PATH_HTTP",SERVER_PATH);
	define('FULL_PATH',FOLDER_PATH_HTTP);

  	// 0 : for local maching
	// 1 : for live site 
	define('LIVE_MODE',1);
	define('ALLOW_TRIAL',1);
	define('FREE_RECORDS',150);

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
	define("IMAGES_PATH_LIVE",FOLDER_PATH_HTTP."images/livesite/");
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
	define("DEFAULT_ROWS_PER_PAGE", 50);
	
	//======== FACEBOOK Api Details =============//
	
	//cost saved in config starts
	function cost_calculation($total_cnt)
	{
		if($total_cnt >= 0 && $total_cnt < 5000){
			$static_price = '0.25';
		}elseif($total_cnt > 5000 && $total_cnt < 10000){
			$static_price = '0.20';
		}elseif($total_cnt > 10000 && $total_cnt < 50000){
			$static_price = '0.15';
		}elseif($total_cnt > 50000 && $total_cnt < 100000){
			$static_price = '0.10';
		}elseif($total_cnt > 100000 && $total_cnt < 250000){
			$static_price = '0.05';
		}elseif($total_cnt > 250000){
			$static_price = '0.03';
		}
		return $static_price;
	}
	//cost saved in config ends
	//created from old on 080611
	define("FACEBOOK_APP_ID", 403795563015393);
		define("FACEBOOK_APP_SECRET", "0c23be87e4f7c07305b21363f92f5685");
		
		//define("FACEBOOK_CALL_URL", "https://graph.facebook.com/oauth/authorize?client_id=".FACEBOOK_APP_ID."&redirect_uri=http://social123.com/customerapi-return.php?type=apifacebook&scope=offline_access,user_status,user_likes,user_activities,read_stream,user_birthday");//,friends_birthday, manage_pages,read_insights
		define("FACEBOOK_CALL_URL", "https://graph.facebook.com/oauth/authorize?client_id=".FACEBOOK_APP_ID."&redirect_uri=https://www.social123.com/customerapi-accounts-controller-back-accounts.php?type=apifacebook&scope=offline_access,user_status,user_likes,user_activities,read_stream,user_birthday");//,friends_birthday, manage_pages,read_insights
		
		// on 140212
		//define("FACEBOOK_CALL_URL", "https://graph.facebook.com/oauth/authorize?client_id=".FACEBOOK_APP_ID."&redirect_uri=http://social123.com/customerapi-return.php?type=apifacebook&scope=user_photos,user_videos,publish_stream,offline_access,user_status,email,user_likes,user_activities,read_stream,read_mailbox,user_photo_video_tags,user_groups,user_notes,read_requests,user_events,user_birthday");//,friends_birthday, manage_pages,read_insights
		//define("FACEBOOK_REDIRECT_URL", "http://social123.com/customerapi-return.php?type=apifacebook");
		define("FACEBOOK_REDIRECT_URL", "https://www.social123.com/customerapi-accounts-controller-back-accounts.php?type=apifacebook");
		define("FACEBOOK_AUTH_ACCESS_URL", "https://graph.facebook.com/oauth/access_token");

	
	
//======== LINKEDIN Api Details =============//
	/*define("LINKEDIN_APP_ID", 'KtXsJ50afteN6qY-KKPrB4tGz6m8H2y3HPtB2h9XPosPhkiSlzOR6H0A8lElQYoj'); //considered app key
	define("LINKEDIN_APP_SECRET", "ferDj5tLTWNiUDT-LEdrX8UbMhYWIzr69X4R9ejQU0Wx2b47GKCYPifFyXPUVpyG");
	*/
	
	define("DATABASE_LI_APP_ID", '27');
	define("LINKEDIN_APP_ID", 'vcokkb2sqj0j');
	define("LINKEDIN_APP_SECRET", "Ab7wBSLOAlfKGt86");
	define("DATABASE_LI_EMAIL", 'bitsdev1@gmail.com');
	define("DATABASE_LI_PASS", 'Test123$$');
	
	
	
	define("LINKEDIN_BASE_URL", 'http://social123.com/includes/modules/api/linkedin/auth.php');
	define("LINKEDIN_CALLBACK_URL", "http://social123.com/customerapi-return.php?type=apilinkedin");
		
	//======== TWITTER Api Details =============//
	/*define("TWITTER_APP_ID", 'RvFjSzYQei0koeJt4rF8iw');
	define("TWITTER_CONSUMER_KEY", "RvFjSzYQei0koeJt4rF8iw");
	define("TWITTER_CONSUMER_SECRET", "Qt1IAqZrIhqrGZyuIltD1I1IK0Z9qgSFPYf71Xumks");*/

	define("TWITTER_APP_ID", 'RvFjSzYQei0koeJt4rF8iw');
	define("TWITTER_CONSUMER_KEY", "RvFjSzYQei0koeJt4rF8iw");
	define("TWITTER_CONSUMER_SECRET", "Qt1IAqZrIhqrGZyuIltD1I1IK0Z9qgSFPYf71Xumks");
	define("TWITTER_APP_ID1", '14');
	
	define("TWITTER_EMAIL", 'emmaobryan@yahoo.com');
		
	$TestUsersArray = array('15', '45');

?>
