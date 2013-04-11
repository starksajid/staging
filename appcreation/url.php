<html>
<head>
	<title>URL</title>
	<style type="text/css">
		.url_div {width: 80%; border: 1px solid #000; padding: 10px; margin: 20px}
		input {width: 350px}
	</style>
</head>
<body>
	<?php
		if($_POST)
		{
	?>
			<div class="url_div">
				<?php
					$url = "https://www.social123.com/appcreation/appcreation.php?app_id=".$_POST['api_id']."&api_key=".$_POST['api_key']."&api_seceret=".$_POST['api_secret'];
				?>
				<a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a>
			</div>
	<?php		
		}
	?>

	<form name="ss" action="" method="post">
		<table align="center" cellspacing="10">
			<tr>
				<td><label>API ID</label></td>
				<td><input type="text" name="api_id" /></td>
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
				<td><input type="submit" name="submit" value="Create URL" style="width:auto" /></td>
			</tr>
		</table>
	</form>
</body>
</html>