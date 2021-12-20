<?php 
session_start();
    $response = file_get_contents("https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json");
    $response = json_decode($response, true);
$res = round($response[$_SESSION['select1']]['rate'] * $_SESSION['sum']/$response[$_SESSION['select2']]['rate'],4);
$_SESSION['res'] = $res;
header("location:/profile.php");
?>