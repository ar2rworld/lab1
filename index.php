<?php
include 'phpqrcode/qrlib.php'; 
$text = 'https://tristendvernychuk.ca/dina/' . basename($_SERVER['PHP_SELF']);//index.php 
echo $text;

$path = './'; 
$file = $path.uniqid().".png";
//echo $file;
//$ecc stores error correction capability('L') 
$ecc = 'L'; 
$pixel_Size = 10; 
$frame_Size = 10; 
// Generates QR Code and Stores it in directory given 
//QRcode::png($text, $file, $ecc, $pixel_Size, $frame_size); 
  
// Displaying the stored QR code from directory 
echo "<center><img src='".$file."'></center>"; 
?>
<html>
<body>
<h1 style="text-align: center;">Hello World, need to add some more style</h1>
<h1 style="text-align: center;">Mural example:<img src='https://www.tourismvernon.com/en/resourcesGeneral/Images/caetani-mural.jpg' alt='mural image'></img></h1>
</body>
</html>
