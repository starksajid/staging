<html>
<head>
	<title>App create</title>
	<style type="text/css">
		.url_div {width: 80%; border: 1px solid #000; padding: 10px; margin: 20px}
		input {width: 350px}
	</style>
</head>
<body>
<?php

include('../config/config.php');

ini_set("display_errors","1");

	//echo 'hi';

	include_once(CLASS_DIR_PATH."util/ConnectionPool.php");
	$conn = ConnectionPool::getInstance();
	//echo "<pre>"; print_r($_POST);exit;
	if($_POST['api_key'] != '')
	{
		$app_name = $_POST['api_name'];
		$app_id = $_POST['api_key'];
		$app_secret = $_POST['api_secret'];
		$date = date("Y-m-d H:i:s");
	
		$sql = "INSERT INTO s123_applications(site_api_id,application_id,application_name,application_secret, created_date) VALUES ('2', '".trim($app_id)."', '".trim($app_name)."', '".trim($app_secret)."', '".$date."')";

 		$conn->db_query($sql);

 		$id = mysql_insert_id();
 		if($id > 0)
 		{?>
 			<div class="url_div">
				<?php
					$url = "https://www.social123.com/appcreation/appcreation.php?app_id=".$id."&api_key=".$_POST['api_key']."&api_seceret=".$_POST['api_secret'];
				?>
				<a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a>
			</div>
 		<?php }
 		//exit;
	}
	else {
	?>

	<form name="ss" action="" method="post">
		<table align="center" cellspacing="10">
			<tr>
				<td><label>API Name</label></td>
				<td><input type="text" name="api_name" /></td>
			</tr>

			<tr>
				<td><label>API KEY</label></td>
				<td><input type="text" name="api_key" /></td>
			</tr>

			<tr>
				<td><label>API SECRET</label></td>
				<td><input type="text" name="api_secret" /></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Create APP" style="width:auto" /></td>
			</tr>
		</table>
	</form>

	<?php } ?>
</body>
</html>