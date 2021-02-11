
<?php

include('init.php');			// include headers & basic library imports
$txt         = $_GET['url'] ?? 'https://www.google.ca/search&q=error+message';
$pixel_size  = $_GET['ps']  ??  15;	// General QR-Code size
$frame_size  = $_GET['fs']  ??  4;	// Buffer around the image of whitespace
$format      = $_GET['fo']  ?? 'jpg';	/* Can be jpg, png, svg according to the library 
					   Some logic will be required to make this work however...
					   Especially SVG which is not a format, but a string
                                           Jpg was choosen for how small it is (>= 500 bytes each)  */

// Setting the conditionals (ECC, SIZE, ETC...)
$file        = $path.uniqid().".".$format;	// Assign unique ID to each query for filename
$ecc         = 'QR_ECLEVEL_L';			// QR code Error Correction strength. Higher = more resilient but larger
$tempDir     = "./images/";			// Image storage location

// Outputs image directly into browser, as PNG stream
QRcode::png($txt, $tempDir.$file, $ecc, $pixel_size, $frame_size);

// Redirect to the newly created file
header('Location: '.$tempDir.$file);

exit;

// SCHEMA
// tristendvernychuk.ca/dina/{filename}.php? url=google.ca & ps=15 & fs=2 & fo=png

?>
