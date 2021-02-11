<?php

// error handling
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    include('/usr/share/phpqrcode/qrlib.php');

    // text output
    $codeContents = 'https://tristendvernychuk.ca/dina/';

    // generating
    $text = QRcode::text($codeContents);
    $raw = join("<br/>", $text);

    $raw = strtr($raw, array(
        '0' => '<span style="color:white">&#9608;&#9608;</span>',
        '1' => '&#9608;&#9608;'
    ));

    // displaying

    echo '<tt style="font-size:7px">'.$raw.'</tt>';
