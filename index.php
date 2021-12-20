<?php
ini_set("allow_url_fopen", 1);
$json = file_get_contents("http://www.tmy.or.th/tmymobile/webservice/linebotjsp.jsp?act=lms&_phoneNumber=1234567890");
$obj = json_decode($json);
echo $obj->access_token;
?>
