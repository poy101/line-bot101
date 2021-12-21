<?php
ob_start();
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
$lineID = "Ue7e6b540a37932bb1958e52e573f600b";
$mss = "";
if (isset($_REQUEST["lineID"]) && $_REQUEST["lineID"] != "") {
    $lineID = $_REQUEST["lineID"];

if (isset($_REQUEST["mss"]) && $_REQUEST["mss"] != "") {
    $mss = $_REQUEST["mss"];

$strAccessToken = "ie0pdSIfgS0zVzy3/KZ9OYUOxaMx0HRTCP0Ke/jIEgZsNcw78854JI6pycjTEOc0qVBfTQozAENSzTFzjlaR2BY5Ts5Pa6kgETU+7j0qe/3pg0/4Jt20fTfROffycr0CrOPdJxdYwuSD6BEm2fQF5QdB04t89/1O/w1cDnyilFU=";

$strUrl = "https://api.line.me/v2/bot/message/push";

$arrHeader = array();
$arrHeader[] = "Content-Type: application/json; charset=UTF-8";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";

$arrPostData = array();
$arrPostData['to'] = $lineID;
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = $mss;


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);
}}
?>




