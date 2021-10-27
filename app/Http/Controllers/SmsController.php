<?php

namespace App\Http\Controllers;

class SmsController extends Controller
{
    public static function sendSms($sender_id,$message, $to)
    {

        $apiKey = "b5fb79ba-a89e-44e2-93e2-5b95ce2a631e";
        $from = "$sender_id";

        $smsContent = [
            "from" => $from,
            "to" => ["+226.$to"],
            "text" => $message
        ];
        $jsonContent = json_encode($smsContent);


        $ch = curl_init("https://www.aqilas.com/api/v1/sms");
        $header = array(
            'Content-Type: application/json',
            "X-AUTH-TOKEN: $apiKey"
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonContent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $json_response = curl_exec($ch);

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $response = json_decode($json_response, true);
        curl_close($ch);

        return $status;
        // if ($status == 201 or $status == 200) {
        //     echo ("Message envoyé avec succès {$response['bulk_id']}");
        // } else die("Error: {$response['message']} ");


    }
}
