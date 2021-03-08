<?php

// Allow error messages to show by default - here for easier toggling
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

// Include scripts manually since apache pretends it doesn't exist otherwise
	require('/usr/share/phpqrcode/qrlib.php');
// TEXT / SVG Generation Libraries
//	require('/usr/share/phpqrcode/qrmask.php');
//	require('/usr/share/phpqrcode/qrspec.php');

// General headers sent with responses, CloudFlare mostly takes care of them
	header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', FALSE);
	header('Pragma: no-cache');

?>
