<?php
include('init.php');
$txt = $_GET['url'];

// ! TODO
if (!isset($_GET['url'])) {
   $txt = 'google.ca';
}

// Setting the conditionals (ECC, SIZE, ETC...)
$path = './';
$file = $path.uniqid().".jpg";

$ecc = 'L';
$pixel_Size = 10;
$frame_Size = 10;

$tempDir = "./images/";
// outputs image directly into browser, as PNG stream
//QRcode::png($txt, $file, $ecc, $pixel_Size, $frame_Size);
QRcode::png($txt, $tempDir.'007_5.png', QR_ECLEVEL_L, 20, 4);
echo '<img src="'.$tempDir.'007_5.png" />';





// This is the scheme for the URL GET requests below...
// tristendvernychuk.ca/dina/qr.php?url=...
