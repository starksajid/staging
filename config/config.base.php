<?php
	// Set PHP Configuration
	ini_set('arg_separator.output','&amp;');
	ini_set('magic_quotes_runtime',0);
	ini_set('magic_quotes_sybase',0);
	ini_set('short_open_tag', 1);

	// Start the Session
	@session_start();

	// Set Site Title
	define('TITLE','Social123');

	// Set Current Protocol
	define('PROTOCOL',(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http');

	// Set Current Host Name
	define('HOST_NAME',$_SERVER['HTTP_HOST']);

	// Set Base Path
	define('BASE_PATH','/var/www/html/');

	// Set Base URL
	//define('BASE_URL','http://social123.com/');

	// Set Absolute Path
	define('ABSOLUTE_PATH','/');

	// Set Absolute URL
	define('ABSOLUTE_URL','/');

	// Set Server Path
	define('SERVER_PATH',PROTOCOL.'://'.HOST_NAME.ABSOLUTE_PATH);

	define('BASE_URL',SERVER_PATH);
	
	// Check For Installation Directory
	if(file_exists(BASE_PATH."/install"))
	{
		@header("Location: ".ABSOLUTE_URL."install/install.php?step=finish");
		exit;
	}
?>