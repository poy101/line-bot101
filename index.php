<?php
$curl= curl_init();
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($curl, CURLOPT_URL, "http://www.tmy.or.th/tmymobile/webservice/linebotjsp.jsp?act=lms&_phoneNumber=1234567890");
 $res = curl_exec($curl);
 curl_close($curl);
 $jo = json_decode($res);
/*ini_set("allow_url_fopen", 1);
$json = file_get_contents("http://www.tmy.or.th/tmymobile/webservice/linebotjsp.jsp?act=lms&_phoneNumber=1234567890");*/
//$obj = json_decode($json);
echo $jo->MEM_ID;
?>
