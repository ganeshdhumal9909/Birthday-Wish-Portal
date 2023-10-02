<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "channelId": "",
    "channelType": "whatsapp",
    "recipient": {
        "name": "",
        "phone": ""
    },
    "whatsapp": {
        "type": "template",
        "template": {
            "templateName": "student_msg_bday",
            "bodyValues": {
                "fname": "Ganesh"
            }
        }
    }
}',
  CURLOPT_HTTPHEADER => array(
    'apiSecret: ',
    'apiKey: ',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;