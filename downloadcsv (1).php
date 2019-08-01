<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();



$list = array (
    $_SESSION['agency_names'], 
    $_SESSION['all_address']
);

$fp = fopen('scrapper.csv', 'w');

for ($i = 0; $i < count($list['0']); $i++) {
    $temp = array($list['0'][$i], $list['1'][$i]);
    fputcsv($fp, $temp);
}

fclose($fp);

$file = 'scrapper.csv';

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    $_SESSION['download_message'] = 'csv downloaded';
    // header('Location : index.php');
    exit;
}
?>