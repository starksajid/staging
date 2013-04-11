<?php
	/**
	 * class.php
	 *
	 * Description	: A Class Config File
	 *
	 * Developed By : Suresh Shinde
	 *
	 * Developed On : 07 June, 2010
	 *
	 * Liscence 	: GPL
	 *
	 * Created On 	: 23/12/2010 10:14:57
	 *
	 * Created By 	: Deepali
	 *
	 */

	/**
	 * DB Connectivity
	 */
	include_once(CLASS_DIR_PATH."util/ConnectionPool.php");

	foreach ($AddClass as $ClassName)
	{
		switch($ClassName)
		{
		    case 'reuse':
				include_once(FUNCTION_DIR_PATH."reuseFunction.php");
		        $re= new reuseFunction();
				break; 
		
			case 's123_customer_api_accounts':
				require_once(CLASS_DIR_PATH."s123_customer_api_accounts/S123CustomerApiAccountsManager.php");
				$s123_customer_api_accounts_manager		= 	new S123CustomerApiAccountsManager();
				$s123_customer_api_accounts				=	new S123CustomerApiAccounts();
				break;
			
			case 's123_subscribe_email':
				require_once(CLASS_DIR_PATH."s123_subscribe_email/S123SubscribeEmailManager.php");
				$s123_subscribe_email_manager	= 	new S123SubscribeEmailManager();
				$s123_subscribe_email		=	new S123SubscribeEmail();
				break;

			case 's123_customer':
				require_once(CLASS_DIR_PATH."s123_customer/S123CustomerManager.php");
				$s123_customer_manager	= 	new S123CustomerManager();
				$s123_customer		=	new S123Customer();
				break;
				
			case 's123_countrylist':			//this will create the object for countrylist table to use the list in country drop down
				require_once(CLASS_DIR_PATH."s123_countrylist/S123CountrylistManager.php");
				$s123_countrylist_manager	= 	new S123CountrylistManager();
				$s123_countrylist		=	new S123Countrylist();
				break;	
			
			case 's123_social_points':
				require_once(CLASS_DIR_PATH."s123_social_points/S123SocialPointsManager.php");
				$s123_social_points_manager	= 	new S123SocialPointsManager();
				$s123_social_points		=	new S123SocialPoints();
				break;
		
			
			case 's123_socialpoints_fbuser':
				require_once(CLASS_DIR_PATH."s123_socialpoints_fbuser/S123SocialpointsFbuserManager.php");
				$s123_socialpoints_fbuser_manager	= 	new S123SocialpointsFbuserManager();
				$s123_socialpoints_fbuser		=	new S123SocialpointsFbuser();
				break;		
	
			case 's123_socialpoints_liuser':
				require_once(CLASS_DIR_PATH."s123_socialpoints_liuser/S123SocialpointsLiuserManager.php");
				$s123_socialpoints_liuser_manager	= 	new S123SocialpointsLiuserManager();
				$s123_socialpoints_liuser		=	new S123SocialpointsLiuser();
				break;
	
			case 's123_socialpoints_twuser':
				require_once(CLASS_DIR_PATH."s123_socialpoints_twuser/S123SocialpointsTwuserManager.php");
				$s123_socialpoints_twuser_manager	= 	new S123SocialpointsTwuserManager();
				$s123_socialpoints_twuser		=	new S123SocialpointsTwuser();
				break;
	
			case 's123_social_profile_list':
				require_once(CLASS_DIR_PATH."s123_social_profile_list/S123SocialProfileListManager.php");
				$s123_social_profile_list_manager	= 	new S123SocialProfileListManager();
				$s123_social_profile_list		=	new S123SocialProfileList();
				break;
			case 's123_customer_payments':
				require_once(CLASS_DIR_PATH."s123_customer_payments/S123CustomerPaymentsManager.php");
				$s123_customer_payments_manager	= 	new S123CustomerPaymentsManager();
				$s123_customer_payments		=	new S123CustomerPayments();
				break;
				
					require_once(CLASS_DIR_PATH."s123_socialprofile_customer_actions/S123SocialprofileCustomerActionsManager.php");
				$s123_socialprofile_customer_actions_manager	= 	new S123SocialprofileCustomerActionsManager();
				$s123_socialprofile_customer_actions		=	new S123SocialprofileCustomerActions();
				break;		

		case 's123_social_profile':
				require_once(CLASS_DIR_PATH."s123_social_profile/S123SocialProfileManager.php");
				$s123_social_profile_manager	= 	new S123SocialProfileManager();
				$s123_social_profile		=	new S123SocialProfile();
				break;
				
		case 's123_socialprofile_master_actions':
				require_once(CLASS_DIR_PATH."s123_socialprofile_master_actions/S123SocialprofileMasterActionsManager.php");
				$s123_socialprofile_master_actions_manager	= 	new S123SocialprofileMasterActionsManager();
				$s123_socialprofile_master_actions		=	new S123SocialprofileMasterActions();
				break;		
		case 's123_socialprofile_customer_actions':
				require_once(CLASS_DIR_PATH."s123_socialprofile_customer_actions/S123SocialprofileCustomerActionsManager.php");
				$s123_socialprofile_customer_actions_manager	= 	new S123SocialprofileCustomerActionsManager();
				$s123_socialprofile_customer_actions		=	new S123SocialprofileCustomerActions();
				break;	
		case 's123_socialprofile_social_attributes':
				require_once(CLASS_DIR_PATH."s123_socialprofile_social_attributes/S123SocialprofileSocialAttributesManager.php");
				$s123_socialprofile_social_attributes_manager	= 	new S123SocialprofileSocialAttributesManager();
				$s123_socialprofile_social_attributes		=	new S123SocialprofileSocialAttributes();
				break;	
		case 's123_socialprofile_users_social_attributes':
				require_once(CLASS_DIR_PATH."s123_socialprofile_users_social_attributes/S123SocialprofileUsersSocialAttributesManager.php");
				$s123_socialprofile_users_social_attributes_manager	= 	new S123SocialprofileUsersSocialAttributesManager();
				$s123_socialprofile_users_social_attributes		=	new S123SocialprofileUsersSocialAttributes();
				break;		

		case 's123_socialprofile_content_mentions_pts':
				require_once(CLASS_DIR_PATH."s123_socialprofile_content_mentions_pts/S123SocialprofileContentMentionsPtsManager.php");
				$s123_socialprofile_content_mentions_pts_manager	= 	new S123SocialprofileContentMentionsPtsManager();
				$s123_socialprofile_content_mentions_pts		=	new S123SocialprofileContentMentionsPts();
				break;
				
		case 's123_socialprofile_customer_actions_pts':
				require_once(CLASS_DIR_PATH."s123_socialprofile_customer_actions_pts/S123SocialprofileCustomerActionsPtsManager.php");
				$s123_socialprofile_customer_actions_pts_manager	= 	new S123SocialprofileCustomerActionsPtsManager();
				$s123_socialprofile_customer_actions_pts		=	new S123SocialprofileCustomerActionsPts();
				break;
				
		case 's123_socialprofile_content_mentions':
				require_once(CLASS_DIR_PATH."s123_socialprofile_content_mentions/S123SocialprofileContentMentionsManager.php");
				$s123_socialprofile_content_mentions_manager	= 	new S123SocialprofileContentMentionsManager();
				$s123_socialprofile_content_mentions		=	new S123SocialprofileContentMentions();
				break;		

		case 's123_social_profile_process':
				require_once(CLASS_DIR_PATH."s123_social_profile_process/S123SocialProfileProcessManager.php");
				$s123_social_profile_process_manager	= 	new S123SocialProfileProcessManager();
				$s123_social_profile_process		=	new S123SocialProfileProcess();
				break;

		case 's123_applications':
				require_once(CLASS_DIR_PATH."s123_applications/S123ApplicationsManager.php");
				$s123_applications_manager	= 	new S123ApplicationsManager();
				$s123_applications		=	new S123Applications();
				break;

		case 's123_application_users':
				require_once(CLASS_DIR_PATH."s123_application_users/S123ApplicationUsersManager.php");
				$s123_application_users_manager	= 	new S123ApplicationUsersManager();
				$s123_application_users		=	new S123ApplicationUsers();
				break;

		case 's123_app_response_log':
				require_once(CLASS_DIR_PATH."s123_app_response_log/S123AppResponseLogManager.php");
				$s123_app_response_log_manager	= 	new S123AppResponseLogManager();
				$s123_app_response_log		=	new S123AppResponseLog();
				break;
		
		case 's123_pdf_contacts':
				require_once(CLASS_DIR_PATH."s123_pdf_contacts/S123PdfContactsManager.php");
				$s123_pdf_contacts_manager	= 	new S123PdfContactsManager();
				$s123_pdf_contacts		=	new S123PdfContacts();
				break;
				
		case 's123_social_profile_list_headers':
				require_once(CLASS_DIR_PATH."s123_social_profile_list_headers/S123SocialProfileListHeadersManager.php");
				$s123_social_profile_list_headers_manager	= 	new S123SocialProfileListHeadersManager();
				$s123_social_profile_list_headers		=	new S123SocialProfileListHeaders();
				break;
				
		case 's123_social_profile_list_headers_data':
				require_once(CLASS_DIR_PATH."s123_social_profile_list_headers_data/S123SocialProfileListHeadersDataManager.php");
				$s123_social_profile_list_headers_data_manager	= 	new S123SocialProfileListHeadersDataManager();
				$s123_social_profile_list_headers_data		=	new S123SocialProfileListHeadersData();
				break;
				
		case 's123_reports_favorites':
				require_once(CLASS_DIR_PATH."s123_reports_favorites/S123ReportsFavoritesManager.php");
				$s123_reports_favorites_manager	= 	new S123ReportsFavoritesManager();
				$s123_reports_favorites		=	new S123ReportsFavorites();
				break;
				
		case 's123_reports_favorites_fields':
				require_once(CLASS_DIR_PATH."s123_reports_favorites_fields/S123ReportsFavoritesFieldsManager.php");
				$s123_reports_favorites_fields_manager	= 	new S123ReportsFavoritesFieldsManager();
				$s123_reports_favorites_fields		=	new S123ReportsFavoritesFields();
				break;
		
		case 's123_reports_favorites_fbuser':
				require_once(CLASS_DIR_PATH."s123_reports_favorites_fbuser/S123ReportsFavoritesFbuserManager.php");
				$s123_reports_favorites_fbuser_manager	= 	new S123ReportsFavoritesFbuserManager();
				$s123_reports_favorites_fbuser		=	new S123ReportsFavoritesFbuser();
				break;
	
		case 's123_app_response_log_leads':
				require_once(CLASS_DIR_PATH."s123_app_response_log_leads/S123AppResponseLogLeadsManager.php");
				$s123_app_response_log_leads_manager	= 	new S123AppResponseLogLeadsManager();
				$s123_app_response_log_leads		=	new S123AppResponseLogLeads();
				break;
		
		case 's123_reports_favorites_liuser':
				require_once(CLASS_DIR_PATH."s123_reports_favorites_liuser/S123ReportsFavoritesLiuserManager.php");
				$s123_reports_favorites_liuser_manager	= 	new S123ReportsFavoritesLiuserManager();
				$s123_reports_favorites_liuser		=	new S123ReportsFavoritesLiuser();
				break;
		
		case 's123_reports_favorites_twuser':
				require_once(CLASS_DIR_PATH."s123_reports_favorites_twuser/S123ReportsFavoritesTwuserManager.php");
				$s123_reports_favorites_twuser_manager	= 	new S123ReportsFavoritesTwuserManager();
				$s123_reports_favorites_twuser		=	new S123ReportsFavoritesTwuser();
				break;
		
		case 's123_social_leads_process':
				require_once(CLASS_DIR_PATH."s123_social_leads_process/S123SocialLeadsProcessManager.php");
				$s123_social_leads_process_manager	= 	new S123SocialLeadsProcessManager();
				$s123_social_leads_process		=	new S123SocialLeadsProcess();
				break;
		
		case 's123_social_leads':
				require_once(CLASS_DIR_PATH."s123_social_leads/S123SocialLeadsManager.php");
				$s123_social_leads_manager	= 	new S123SocialLeadsManager();
				$s123_social_leads		=	new S123SocialLeads();
				break;
				
		case 's123_social_leads_customer_actions_pts':
				require_once(CLASS_DIR_PATH."s123_social_leads_customer_actions_pts/S123SocialLeadsCustomerActionsPtsManager.php");
				$s123_social_leads_customer_actions_pts_manager	= 	new S123SocialLeadsCustomerActionsPtsManager();
				$s123_social_leads_customer_actions_pts		=	new S123SocialLeadsCustomerActionsPts();
				break;
				
		case 's123_social_leads_content_mentions_pts':
				require_once(CLASS_DIR_PATH."s123_social_leads_content_mentions_pts/S123SocialLeadsContentMentionsPtsManager.php");
				$s123_social_leads_content_mentions_pts_manager	= 	new S123SocialLeadsContentMentionsPtsManager();
				$s123_social_leads_content_mentions_pts		=	new S123SocialLeadsContentMentionsPts();
				break;
				
		case 's123_twitter_names':
				require_once(CLASS_DIR_PATH."s123_twitter_names/S123TwitterNamesManager.php");
				$s123_twitter_names_manager	= 	new S123TwitterNamesManager();
				$s123_twitter_names		=	new S123TwitterNames();
				break;
		
		case 's123_twitter_followers':
				require_once(CLASS_DIR_PATH."s123_twitter_followers/S123TwitterFollowersManager.php");
				$s123_twitter_followers_manager	= 	new S123TwitterFollowersManager();
				$s123_twitter_followers		=	new S123TwitterFollowers();
				break;
				
		case 's123_email_append_log':
				require_once(CLASS_DIR_PATH."s123_email_append_log/S123EmailAppendLogManager.php");
				$s123_email_append_log_manager	= 	new S123EmailAppendLogManager();
				$s123_email_append_log		=	new S123EmailAppendLog();
				break;
				
		case 's123_restapi_usage':
                require_once(CLASS_DIR_PATH."s123_restapi_usage/S123RestapiUsageManager.php");
                $s123_restapi_usage_manager    =     new S123RestapiUsageManager();
                $s123_restapi_usage        =    new S123RestapiUsage();
                break;
				
		case 's123_twitter_names_subprocess':
				require_once(CLASS_DIR_PATH."s123_twitter_names_subprocess/S123TwitterNamesSubprocessManager.php");
				$s123_twitter_names_subprocess_manager	= 	new S123TwitterNamesSubprocessManager();
				$s123_twitter_names_subprocess		=	new S123TwitterNamesSubprocess();
				break;	

		case 's123_twitter_names_emailprocess':
				require_once(CLASS_DIR_PATH."s123_twitter_names_subprocess/S123TwitterNamesSubprocessManager.php");
				$s123_twitter_names_emailprocess_manager	= 	new S123TwitterNamesSubprocessManager();
				$s123_twitter_names_emailprocess		=	new S123TwitterNamesSubprocess();
				break;	
				
		case 's123_social_profile_subprocess':
				require_once(CLASS_DIR_PATH."s123_social_profile_subprocess/S123SocialProfileSubprocessManager.php");
				$s123_social_profile_subprocess_manager	= 	new S123SocialProfileSubprocessManager();
				$s123_social_profile_subprocess		=	new S123SocialProfileSubprocess();
				break;	

		case 's123_group_users_registration':
				require_once(CLASS_DIR_PATH."s123_group_users_registration/S123GroupUsersRegistrationManager.php");
				$s123_group_users_registration_manager	= 	new S123GroupUsersRegistrationManager();
				$s123_group_users_registration		    =	new S123GroupUsersRegistration();
				break;

		case 's123_group_users_credit_card_info':
				require_once(CLASS_DIR_PATH."s123_group_users_credit_card_info/S123GroupUsersCreditCardInfoManager.php");
				$s123_group_users_credit_card_info_manager	= 	new S123GroupUsersCreditCardInfoManager();
				$s123_group_users_credit_card_info		    =	new S123GroupUsersCreditCardInfo();
				break;

		case 's123_customer_packages':
				require_once(CLASS_DIR_PATH."s123_customer_packages/S123CustomerPackagesManager.php");
				$s123_customer_packages_manager	= 	new S123CustomerPackagesManager();
				$s123_customer_packages			=	new S123CustomerPackages();
				break;

		case 's123_site_payment':		// this will create object for site_payment table.
				require_once(CLASS_DIR_PATH."s123_site_payment/S123SitePaymentManager.php");
				$s123_site_payment_manager	= 	new S123SitePaymentManager();
				$s123_site_payment		=	new S123SitePayment();
				break;

		case 's123_site_package':
				require_once(CLASS_DIR_PATH."s123_site_package/S123SitePackageManager.php");
				$s123_site_package_manager	= 	new S123SitePackageManager();
				$s123_site_package		    =	new S123SitePackage();
				break;			
				
		case 's123_socialprofile_demographic':
				require_once(CLASS_DIR_PATH."s123_socialprofile_demographic/S123SocialprofileDemographicManager.php");
				$s123_socialprofile_demographic_manager	= 	new S123SocialprofileDemographicManager();
				$s123_socialprofile_demographic		=	new S123SocialprofileDemographic();
				break;

		case 's123_delete_keyword':
				require_once(CLASS_DIR_PATH."s123_delete_keyword/S123DeleteKeywordManager.php");
				$s123_delete_keyword_manager	= 	new S123DeleteKeywordManager();
				$s123_delete_keyword		=	new S123DeleteKeyword();
				break;

		case 's123_block_email':
				require_once(CLASS_DIR_PATH."s123_block_email/S123BlockEmailManager.php");
				$s123_block_email_manager	= 	new S123BlockEmailManager();
				$s123_block_email		=	new S123BlockEmail();
				break;

		case 's123_socialfollower_customer_actions_pts':
				require_once(CLASS_DIR_PATH."s123_socialfollower_customer_actions_pts/S123SocialfollowerCustomerActionsPtsManager.php");
				$s123_socialfollower_customer_actions_pts_manager	= 	new S123SocialfollowerCustomerActionsPtsManager();
				$s123_socialfollower_customer_actions_pts		=	new S123SocialfollowerCustomerActionsPts();
				break;
		}
	}
?>