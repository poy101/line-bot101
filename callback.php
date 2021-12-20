<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        /* Get Data From POST Http Request */
        $datas = file_get_contents('php://input');
        /* Decode Json From LINE Data Body */
        $deCode = json_decode($datas, true);
        file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
        $results = getInfo($deCode);
        /* Return HTTP Request 200 */
        http_response_code(200);

        function getInfo($deCode) {
            $replyToken = $deCode['events'][0]['replyToken'];
            $userId = $deCode['events'][0]['source']['userId'];
            $text = $deCode['events'][0]['message']['text'];
            $messages = [];
            $messages['replyToken'] = $replyToken;
            $LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
            $LINEDatas['token'] = "ie0pdSIfgS0zVzy3/KZ9OYUOxaMx0HRTCP0Ke/jIEgZsNcw78854JI6pycjTEOc0qVBfTQozAENSzTFzjlaR2BY5Ts5Pa6kgETU+7j0qe/3pg0/4Jt20fTfROffycr0CrOPdJxdYwuSD6BEm2fQF5QdB04t89/1O/w1cDnyilFU=";

            $txt = "";
            if ($text != "") {
                $text = trim($text);
                if (strpos($text, "sms") == 0) {
                    $phone_no = str_replace("sms", "", $text);
                    $txt = $phone_no;
                  /*  $xurl = "http://www.tmy.or.th/tmymobile/webservice/linebotjsp.jsp?act=lms&_phoneNumber=" . $phone_no;
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_URL, $xurl);
                    $res = curl_exec($curl);
                    curl_close($curl);
                    $jo = json_decode($res);
                    $txt = $jo->MEM_ID;*/
                    $messages['messages'][0] = getFormatTextMessage($txt);
                    $encodeJson = json_encode($messages);
                    return sentMessage($encodeJson, $LINEDatas);
                }
            }

           
        }

        function getFormatTextMessage($text) {
            $datas = [];
            $datas['type'] = 'text';
            $datas['text'] = $text;
            return $datas;
        }

        function sentMessage($encodeJson, $datas) {
            $datasReturn = [];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $datas['url'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $encodeJson,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer " . $datas['token'],
                    "cache-control: no-cache",
                    "content-type: application/json; charset=UTF-8",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                $datasReturn['result'] = 'E';
                $datasReturn['message'] = $err;
            } else {
                if ($response == "{}") {
                    $datasReturn['result'] = 'S';
                    $datasReturn['message'] = 'Success';
                } else {
                    $datasReturn['result'] = 'E';
                    $datasReturn['message'] = $response;
                }
            }

            return $datasReturn;
        }
        ?>
    </body>
</html>
