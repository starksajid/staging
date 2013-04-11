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
	define('MAX_CONTACTS_PER_LIST',10);

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
	define("DEFAULT_ROWS_PER_PAGE", 10);
	define("API_MAX_ROWS_PER_PAGE", 100);
       define("FREE_FOLLOWER" , 150);
	
	//======== FACEBOOK Api Details =============//
	
	//cost saved in config starts
	function cost_calculation($total_cnt)
	{
		/*if($total_cnt >= 0 && $total_cnt < 5000){
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
		}*/
		$static_price = '0.10';
		return $static_price;
	}
	//cost saved in config ends
	//created from old on 080611
	       define("FACEBOOK_APP_ID", 221085874568116);
		define("FACEBOOK_APP_SECRET", "09acf18cbb7d8fe7c9f32c5894f02d42");

              //define("FACEBOOK_APP_ID", 403795563015393);
		//define("FACEBOOK_APP_SECRET", "0c23be87e4f7c07305b21363f92f5685");

		
		define("FACEBOOK_CALL_URL", "https://graph.facebook.com/oauth/authorize?client_id=".FACEBOOK_APP_ID."&redirect_uri=http://social123.com/customerapi-return.php?type=apifacebook&scope=offline_access,user_status,user_likes,user_activities,read_stream,user_birthday,manage_notifications,manage_pages");//,friends_birthday, manage_pages,read_insights
		
		// on 140212
		//define("FACEBOOK_CALL_URL", "https://graph.facebook.com/oauth/authorize?client_id=".FACEBOOK_APP_ID."&redirect_uri=http://social123.com/customerapi-return.php?type=apifacebook&scope=user_photos,user_videos,publish_stream,offline_access,user_status,email,user_likes,user_activities,read_stream,read_mailbox,user_photo_video_tags,user_groups,user_notes,read_requests,user_events,user_birthday");//,friends_birthday, manage_pages,read_insights
		define("FACEBOOK_REDIRECT_URL", "http://social123.com/customerapi-return.php?type=apifacebook");
		define("FACEBOOK_AUTH_ACCESS_URL", "https://graph.facebook.com/oauth/access_token");

	
	
//======== LINKEDIN Api Details =============//
	/*define("LINKEDIN_APP_ID", 'KtXsJ50afteN6qY-KKPrB4tGz6m8H2y3HPtB2h9XPosPhkiSlzOR6H0A8lElQYoj'); //considered app key
	define("LINKEDIN_APP_SECRET", "ferDj5tLTWNiUDT-LEdrX8UbMhYWIzr69X4R9ejQU0Wx2b47GKCYPifFyXPUVpyG");*/
	
       define("LINKEDIN_APP_ID", 'p4jjv3sgsa8s'); //considered app key
	define("LINKEDIN_APP_SECRET", "3xhMObZ5vrkUKyqC");
	
	
	/*define("DATABASE_LI_APP_ID", '27');
	define("LINKEDIN_APP_ID", 'vcokkb2sqj0j');
	define("LINKEDIN_APP_SECRET", "Ab7wBSLOAlfKGt86");
	define("DATABASE_LI_EMAIL", 'elisa_collett@yahoo.com');
	define("DATABASE_LI_PASS", 'Test123$$');
	*/
	
	define("LINKEDIN_BASE_URL", 'http://social123.com/includes/modules/api/linkedin/auth.php');
	define("LINKEDIN_CALLBACK_URL", "http://social123.com/customerapi-return.php?type=apilinkedin");
		
	//======== TWITTER Api Details =============//
	define("TWITTER_APP_ID", 'RvFjSzYQei0koeJt4rF8iw');
	define("TWITTER_CONSUMER_KEY", "RvFjSzYQei0koeJt4rF8iw");
	define("TWITTER_CONSUMER_SECRET", "Qt1IAqZrIhqrGZyuIltD1I1IK0Z9qgSFPYf71Xumks");
	
	//======== Yahoo Placefinder Api Details =============//
	define("YAHOO_PLACEFINDER_APP_ID", 'CX9T4S62');//bitsqa
	
	$TestUsersArray = array();
	$TestUsers1Array = array();
	$TestUsersArray = array('15', '45', '192');
	//$TestUsersArray = array('6','7','8','15','21','45','79','83','85','90','91','102','119','120','125','134','135','141','152','155','159','165');
	//$TestUsers1Array = array('6','7','8','15','21','45','79','83','85','90','91','102','119','120','125','134','135','141','152','155','159','165');
	//
	//======== To split large CSV to smaller units =============//
	define("RECORDS_PER_PROCESS", 3000);
	define("RECORDS_PER_PROCESS_TWITTER", 1000);


	#==========User list array for Free twitter followers=======#
	$TwitterFollowerFreeArray = array(15,102,192,205,305,384,419);

       #==========User list array for limited twitter followers=======#
	$TwiiterFollowerAllowedArray = array('dmscott','charleneli','LinkedInQueen','steverubel',CHRISVOSS,loriruff,MailChimp,bsainsbury,ChrisHusong);
	//
	
	//======== FOR IP SPOOFING =============//
	$IP_ADDRESS_ARRAY = array('66.132.130.100', '66.132.130.73', '66.132.130.68',  '66.132.130.84', '66.132.130.63', '66.132.130.60', '66.132.130.54', '66.132.130.64', '66.132.130.55', '66.132.130.99', '66.132.130.83', '66.132.130.62', '66.132.130.57', '66.132.130.67', '66.132.130.56', '66.132.130.51', '66.132.130.52', '66.132.130.72', '66.132.130.76', '66.132.130.69', '66.132.130.70', '66.132.130.61', '66.132.130.71', '66.132.130.81', '66.132.130.65', '66.132.130.53', '66.132.130.74', '66.132.130.59', '66.132.130.91', '66.132.130.75', '66.132.130.90', '66.132.130.79', '66.132.130.96', '66.132.130.93', '66.132.130.80', '66.132.130.85', '66.132.130.98', '66.132.130.82', '66.132.130.95', '66.132.130.94', '66.132.130.89', '66.132.130.66', '66.132.130.92', '66.132.130.78', '66.132.130.97', '66.132.130.77', '66.132.135.101');
	//removed used for socialfaster '66.132.130.86', avectrasocialconsole '66.132.130.87', socialapt '66.132.130.88'
	define("ENABLE_IP_SPOOFING", true);
	define("NO_OF_CALLS_PER_ACCOUNT", 1000);
	$USER_AGENTS_ARRAY = array(
	// My browsers
	'Mozilla/5.0 (Windows NT 6.1; rv:6.0.2) Gecko/20100101 Firefox/6.0.2', //FF
	'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C)',//IE7
	'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C)', //ie8
	'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)', //IE9
	'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.168 Safari/535.19', //Chrome
	
	//http://my-sliit.blogspot.in/2009/04/list-of-browser-user-agents-to-use-with.html
	'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; SU 3.21; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET CLR 3.5.21022)',//IE7
	'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.19 (KHTML, like Gecko) Chrome/1.0.154.53 Safari/525.19', //crome
	'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8', //FF 3.0
	'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6', //FF 2.0
	'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.28 (KHTML, like Gecko) Version/3.2.2 Safari/525.28.1', //Safari
	'Opera/10.00 (Windows NT 5.1; U; en) Presto/2.2.0' //Opera
	);
	
	$DOMAIN_INITIALS_TO_SKIP = array('about', 'blog', 'blogger', 'blogspot', 'dmoz', 'example', 'facebook', 'google', 'linkedin', 'microsoft', 'myspace', 'tumblr', 'twitter', 'wordpress', 'youtube', 'callboxinc', 'yourname', 'yourmail', 'noreply', 'myname', 'msn', 'live', 'bellsouth', 'worldnet', 'sbcglobal', 'att', 'gmail', 'yahoo', 'mail', 'pinterest', 'posterous','tiny.cc','reverberation','twitpic');

	$DOMAINS_TO_SKIP = array('wefollow.com', 'dictionary.com', 'yourcompany.com', 'yourisp.com', 'yourteam.com', 'email.com', 'netaccessman.com', 'yourhost.com', 'amazon.com', 'salesforce.com', 'dma.org', 'seoworkers.com', 'rogers.com', 'att.net', 'verizon.net', 'ameritech.net', 'sbcglobal.net', 'pacbell.net', 'rogers.com', 'prodigy.net', 'swbell.net', 'flash.net', 'dot.state', 'dot.gov', 'alaska.gov', 'talk21.com', 'tumblr.com', 'rr.com', 'about.me', 'bit.ly');

	$TOP_DOMAINS_TO_SKIP = array('.asia', '.be', '.br', '.de', '.fi', '.fr', '.ftc', '.edu', '.gov', '.hk', '.htm', '.ip', '.it', '.jp', '.mil', '.nl', '.pdf', '.ru', '.tv', '.me');
	
	//======== Email Append Verity API key =============//
	define("EMAIL_APPEND_API_KEY", 'CE5B5997');
	define("BRITEVERIFY_API_KEY", 'b1506c2a-907f-44f4-b9ae-8b3b770dcd4f');
	define('USE_EMAIL_VERIFICATION_API', true);
	
			//========= Path to save csv to upload and completed csv =====//
	define("BULK_EMAIL_UPLOAD_FOLDER_PATH",BASE_PATH."uploads/email_verify/");

	define("THIRD_PARTY_CSV_FOLDER_PATH",BASE_PATH."uploads/Verify_email/");

       define("COMPLETED_CSV_PATH", BASE_PATH."uploads/own_email_csv/");

	//added on 15th feb
	$social123UsersArray = array('2482','2503','2216', '2325', '1989', '1489', '2369', '2297', '2109', '2110', '2148', '172', '868', '1390', '1974', '2012', '1986', '1763', '240','235','1581','2331','578','2424','2290','1623','2049','159','843','2479','2491','1829','2503','2529');

	$curr_date=date('Y');
	define("GET_CURRENT_YEAR_COPYRIGHT", $curr_date);
	define("TWITTER_FREE_RECORDS", 150);//set records limit fro twitter follower

	define("TOTAL_COUNT_OF_PAID_USER", 10000);//set total count for paid user
       define("USE_OWN_EMAIL_VERIFICATION", TRUE);

	//======== Default package duration =============//
	define("PACKAGE_DURATION", 365);
	define("FLIPTOP_API_KEY", '225c4b12bbd1501108d4b0d1900aa6b3');

       //============== Default Limit for Govern User=================//
	define("TOTAL_FOLLOWER_GOVERN" , 10000);
	define("TOTAL_DATA_GOVERN" , 10000);
	define("TOTAL_LEADS_GOVERN" , 10000);
?>