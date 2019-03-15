<?php

function sendSms($phone, $message) {
    $phone  =  str_replace(' ', '', $phone); // clear spaces in phone number

    $fields = [
        "apikey" => env('SMS_API_KEY'),
        "mensaje" => $message,
        "numcelular" => $phone,
        "numregion" => "52"
    ];
    $options = [
        CURLOPT_URL => "https://app.smsmasivos.com.mx/components/api/api.envio.sms.php",
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_POSTFIELDS => $fields
    ];
    curl_setopt_array($ch = curl_init(), $options);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response);
}
