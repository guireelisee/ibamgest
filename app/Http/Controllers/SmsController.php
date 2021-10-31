<?php

namespace App\Http\Controllers;

class SmsController extends Controller
{
    public static function sendSms($sender_id, $message, $to, $indicatif=null)
    {

        $apiKey = "b5fb79ba-a89e-44e2-93e2-5b95ce2a631e";

        if ($indicatif === null) {
            $smsContent = [
                "from" => $sender_id,
                "to" => ["+226.$to"],
                "text" => $message
            ];
        } else {
            $smsContent = [
                "from" => $sender_id,
                "to" => ["$to"],
                "text" => $message
            ];
        }
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

        return [
            'status'=>$status,
            'response'=>$response
        ];
    }


}
