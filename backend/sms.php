<?php
    //Send an SMS using Gatewayapi.com
    //Send an SMS using Gatewayapi.com
$url = "https://gatewayapi.com/rest/mtsms";
$api_token = "X4oHvltERfq1gRP5DckUk3JZQ6xzRUCKzlWQF8IsNgFyZwys7VkrCcCHhwu9SHFR";

//Set SMS recipients and content
$recipients = [23469077572];
$json = [
    'sender' => 'PetideSystems.com',
    'message' => 'Hello. Petide, Your first SMS is ready',
    'recipients' => [],
];
foreach ($recipients as $msisdn) {
    $json['recipients'][] = ['msisdn' => $msisdn];
}

//Make and execute the http request
//Using the built-in 'curl' library
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
curl_setopt($ch,CURLOPT_USERPWD, $api_token.":");
curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($json));
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
print($result);
$json = json_decode($result);
print_r($json->ids);
?>