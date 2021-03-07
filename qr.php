<?php

include('init.php');                        // Include headers & basic library imports
$txt         = $_GET['url']  ?? 'www.downtownvernon.com';
$pixel_size  = $_GET['ps']   ??  15;        // General QR-Code size
$frame_size  = $_GET['fs']   ??  2;         // Buffer around the image of whitespace
$format      = $_GET['fo']   ?? 'jpg';      /* Can be jpg, png, svg according to the library
                                               Some logic will be required to make this work however...
                                               Especially SVG which is not a format, but a string
                                               Jpg was choosen for how small it is (<= 500 bytes each) and for compatibility */
$imageWidth  = $_GET['iw']   ??  250;       // SVG only, in PX
$saveToFile  = $_GET['save'] ??  true;      // SVG only, whether to output stream or save to the filename function

//---------------------------------------------------------------------------------------------------------------------------------

$file = "qr_".md5($url.$pixel_size.$frame_size).".";
if (in_array($format, array("jpg", "jpeg", "png", "svg", "txt"))) {
    $file = $file.$format;                  // Assign unique ID filename IF nothing is specified
} else {
    $file = $file."jpg";                    // Save as JPEG if the format is malformed
}                                           // In SVG if a filename is set saveToFile would be ignored

$ecc         = 'QR_ECLEVEL_L';              // QR code Error Correction strength. Higher = more resilient but larger
$tempDir     = "./images/";                 // Image storage location

if (scandir($folder).in_array($file)) {     // Check file hash against already generated images
    header('Location: '.$tempDir.$file);
} else {
    switch($format) {
        case "png":
            QRcode::png($txt, $tempDir.$file, $ecc, $pixel_size, $frame_size);
            header('Location: '.$tempDir.$file);
            break;
        case "svg":                         // Takes funkier parameters to get this working...alot of ways it can go wrong
            $svgCode = QRcode::svg($svg, $tempDir.$file, $saveToFile, $ecc, $imageWidth);
            echo $svgCode;
            break;
        case "jpg":
        case "jpeg":                        // Using the PNG function to save as JPG works I guess? A bit redundant
            QRcode::png($txt, $tempDir.$file, $ecc, $pixel_size, $frame_size);
            header('Location: '.$tempDir.$file);
            break;
        case "text":
            QRcode::text($txt);             // No parameters required for raw output
            break;
        default:
            QRcode::png($txt, $tempDir.$file, $ecc, $pixel_size, $frame_size);
            header('Location: '.$tempDir.$file);
            break;
    }
}
?>
