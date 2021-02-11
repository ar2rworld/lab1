
<?php
include('init.php');
$txt         = $_GET['u'] ?? 'https://www.google.ca/search&q=error+message';
$pixel_size  = $_GET['p'] ?? 15;	// General QR-Code size
$frame_size  = $_GET['f'] ?? 4;		// Buffer around the image of whitespace

// Setting the conditionals (ECC, SIZE, ETC...)
$file        = $path.uniqid().".jpg";	// Assign unique ID to each query for filename
$ecc         = 'QR_ECLEVEL_L';		// QR code Error Correction strength. Higher = more resilient but larger
$tempDir     = "./images/";		// Image storage location

// Outputs image directly into browser, as PNG stream
QRcode::png($txt, $tempDir.$file, $ecc, $pixel_size, $frame_size);

// Redirect to the newly created file
header('Location: '.$tempDir.$file);

exit;

// SCHEMA
// tristendvernychuk.ca/dina/{filename}.php? u=google.ca & p=15 & f=2

?>
