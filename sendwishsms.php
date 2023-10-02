<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://server.gallabox.com/devapi/messages/whatsapp',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "channelId": "614b2eb14950f20004022c93",
    "channelType": "whatsapp",
    "recipient": {
        "name": "Ganesh Dhumal",
        "phone": "919271375024"
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
    'apiSecret: 9d9787619ace4b16be838a116e969968',
    'apiKey: 61b2e600733f200004ff85f1',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;