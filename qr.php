<?php

include('init.php');                            // Include headers & basic library imports
$txt         = $_GET['url']  ?? 'www.downtownvernon.com';
$pixel_size  = $_GET['ps']   ??  15;            // General QR-Code size
$frame_size  = $_GET['fs']   ??  2;             // Buffer around the image of whitespace
$format      = $_GET['fo']   ?? 'jpg';          /* Can be jpg, png, svg according to the library
                                                   Some logic will be required to make this work however...
                                                   Especially SVG which is not a format, but a string
                                                   Jpg was choosen for how small it is (<= 500 bytes each) and for compatibility */
$imageWidth  = $_GET['iw']   ??  250;           // SVG only, in PX
$saveToFile  = $_GET['save'] ??  true;          // SVG only, whether to output stream or save to the filename function

//---------------------------------------------------------------------------------------------------------------------------------

$fileName = "qr_".md5($txt.$pixel_size.$frame_size).".";
if (in_array($format, array("jpg", "jpeg", "png", "txt"))) {
    $fileName = $fileName.$format;              // Assign unique ID filename IF nothing is specified
} else {
    $fileName = $fileName."jpg";                // Save as JPEG if the format is malformed
}                                               // In SVG if a filename is set saveToFile would be ignored

$ecc         = 'QR_ECLEVEL_L';                  // QR code Error Correction strength. Higher = more resilient but larger
$tempDir     = "./images/";                     // Image storage location

if (in_array($fileName, scandir($tempDir))) {   // PRE-Generation -> Check if object w/ MD5 hash already exists on disk, re-direct
    header('Location: '.$tempDir.$fileName);
} else {
    switch($format) {
        case "png":
            QRcode::png($txt, $tempDir.$fileName, $ecc, $pixel_size, $frame_size);
            header('Location: '.$tempDir.$fileName);
            break;
//        case "svg":                             // Takes funkier parameters to get this working...alot of ways it can go wrong
//            $svgCode = QRcode::svg($svg, $tempDir.$fileName, $saveToFile, $ecc, $imageWidth);
//            // echo $svgCode;
//            header('Location: '.$tempDir.$fileName);
//            break;
        case "jpg":
        case "jpeg":                            // Using the PNG function to save as JPG works I guess? A bit redundant
            QRcode::png($txt, $tempDir.$fileName, $ecc, $pixel_size, $frame_size);
            header('Location: '.$tempDir.$fileName);
            break;
        case "txt":
            QRcode::text($txt, $tempDir.$fileName);   // No parameters required for raw output, but directory is for SAVING output
    	    header('Location: '.$tempDir.$fileName);
            break;
        default:
            QRcode::png($txt, $tempDir.$fileName, $ecc, $pixel_size, $frame_size);
            header('Location: '.$tempDir.$fileName);
            break;
    }
}
?>
