<?php

require "vendor/autoload.php";

$access_token = "ie0pdSIfgS0zVzy3/KZ9OYUOxaMx0HRTCP0Ke/jIEgZsNcw78854JI6pycjTEOc0qVBfTQozAENSzTFzjlaR2BY5Ts5Pa6kgETU+7j0qe/3pg0/4Jt20fTfROffycr0CrOPdJxdYwuSD6BEm2fQF5QdB04t89/1O/w1cDnyilFU=";

$channelSecret = "e7a09eaacdb59269a4a63533b2d77a3b";

$pushID = "Ue7e6b540a37932bb1958e52e573f600b";

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

?>





