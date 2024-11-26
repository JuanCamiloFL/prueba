<?php

//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR  = 'temp/';

include "qrlib.php";  

//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);

$matrixPointSize      = 4;
$errorCorrectionLevel = 'L';

if (isset($_POST['name'])) {

    $data     = (isset($_POST['name'])) ? $_POST['name'] : '';
    $filename = $PNG_TEMP_DIR.'validate_'.md5($_REQUEST['name'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    
    QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

    // Mostramos la imagen codificada en base 64 
    $imagedata = file_get_contents($filename);
    $data      = base64_encode($imagedata);

    print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
}