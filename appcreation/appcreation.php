<?php
@session_start();

include('../config/config.php');

ini_set("display_errors","1");

if($_SESSION['app_id'] == "")
	$_SESSION['app_id'] = $_GET['app_id'];

if($_SESSION['api_key'] == "")
 	$_SESSION['api_key'] = $_GET['api_key'];

if($_SESSION['api_seceret'] == "")
 	$_SESSION['api_seceret'] = $_GET['api_seceret'];


$app_id = $_SESSION['app_id'];

$api_key = $_SESSION['api_key'];
$api_seceret = $_SESSION['api_seceret'];


include_once(CLASS_DIR_PATH."util/ConnectionPool.php");
$conn = ConnectionPool::getInstance();

if(isset($_POST['submit']))
{
	$update_sql = "UPDATE s123_application_users SET email='".$_POST["email"]."' WHERE user_id='".$_POST["userid"]."'";
	echo "<br />Update sql: ".$update_sql;
	$conn->db_query($update_sql);
	die();
}

if(isset($_REQUEST['oauth_token']))
{
	require_once(MODULES_DIR_PATH."api/linkedin/s123_api_linkedin.php");
	//echo "<pre>GET"; print_r($_GET); 

	//echo "<br/><pre>REQUEST"; print_r($_REQUEST);
	$linkedinObj = new s123_api_linkedin($api_key,$api_seceret,'http://social123.com/appcreation/appcreation.php');
//	echo "<pre>Printing linkedinObj"; print_r($linkedinObj); //die;
	$auth_token = $linkedinObj->getToken(serialize($_REQUEST['oauth_token']),$_REQUEST['oauth_verifier'],$_SESSION['requestToken']);
	$_SESSION['li_auth_token'] = $auth_token;
	$xml_response = $linkedinObj->getuserProfile($auth_token);

	print_r($xml_response);

	//echo "<pre>Printing $_REQUEST"; print_r($_REQUEST); die;

	$user_info = $xml_response['first-name'].' ' .$xml_response['last-name'];
	//$auth_token = mysql_escape_string(serialize($_REQUEST['oauth_token']));
	$oauth_verifier = mysql_escape_string($_REQUEST['oauth_verifier']);
	$oauth_request = mysql_escape_string($_SESSION['requestToken']);


	echo 'oauth token   '.$auth_token.'   oauth secret  '.$oauth_request.' display_name '.$user_info;

	$date = date("Y-m-d H:i:s");

	$sql = "INSERT INTO s123_application_users(app_id, oauth_token, oauth_secret, created_date) VALUES('".$app_id."', '".trim($auth_token)."', '".trim($oauth_request)."', '".$date."')";

	echo "<br />sql: ".$sql;
	$conn->db_query($sql);
	//exit;
}else{

$config['base_url']             =   'http://social123.com/includes/modules/api/linkedin/auth.php';
$config['callback_url']         =   'http://social123.com/appcreation/appcreation.php';
$config['linkedin_access']      =   $api_key;
$config['linkedin_secret']      =   $api_seceret;
include_once MODULES_DIR_PATH."api/linkedin/linkedin.php";
# First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback     
$linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['callback_url'] );     
//$linkedin->debug = true;
# Now we retrieve a request token. It will be set as $linkedin->request_token
$linkedin->getRequestToken();
$_SESSION['requestToken'] = serialize($linkedin->request_token);
echo $linkedin->generateAuthorizeUrl;

?>
<script type="text/javascript">

window.location = "<?php echo $linkedin->generateAuthorizeUrl();?>"

</script>

<?php
}

$id = $conn->db_last_insert_id();
if($id > 0)
{
	unset($_SESSION['app_id']);
	unset($_SESSION['api_key']);
	unset($_SESSION['api_seceret']);
?>
<form method="post">
	<input type="text" name="email" style="width:200px;" class="email">
	<input type="hidden" name="userid" value="<?php echo $id; ?>" />
	<input type="submit" name="submit" value="submit" />
</form>
<?php
}
?>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.email').focus();
});
</script>