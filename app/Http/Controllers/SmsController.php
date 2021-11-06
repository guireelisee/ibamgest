<?php

namespace App\Http\Controllers;

class SmsController extends Controller
{
    public static function sendSms($sender_id, $message, $to)
    {
        $apiKey = "b5fb79ba-a89e-44e2-93e2-5b95ce2a631e";
        $tel = "";
        $numberBegin = [0,5,6,7]; // Debut des numéros au BF
        $to = str_replace(" ", "", "$to");
        if (strlen($to) >= 8 && strlen($to) <= 13) {
            if ($to[0] === "+" && $to[1] === "2" && $to[2] === "2" && $to[3] === "6") {
                // Exemple : +22673916210
                if (in_array($to[4],$numberBegin)) {
                    $tel = $to;
                } else {
                    return [
                        'status' => '404',
                        'response' => ['message' => "Le nuuméro $to est invalide. Veuillez le modifier."]
                    ];
                }
            } elseif ($to[0] === "0" && $to[1] === "0" && $to[2] === "2" && $to[3] === "2" && $to[4] === "6") {
                // Exemple : 0022673916210
                if (in_array($to[5], $numberBegin)) {
                    $tel = $to;
                } else {
                    return [
                        'status' => '404',
                        'response' => ['message' => "Le nuuméro $to est invalide. Veuillez le modifier."]
                    ];
                }
            } else {
                // Exemple : 73916210
                if (in_array($to[0], $numberBegin)) {
                    $tel = "+226".$to;
                } else {
                    return [
                        'status' => '404',
                        'response' => ['message' => "Le nuuméro $to est invalide. Veuillez le modifier."]
                    ];
                }
            }
        } else {
            return [
                'status' => '404',
                'response' => ['message' => "Le nuuméro $to est invalide. Veuillez le modifier."]
            ];
        }

        $smsContent = [
            "from" => $sender_id,
            "to" => [$tel],
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

        return [
            'status'=>$status,
            'response'=>$response
        ];
    }


}
