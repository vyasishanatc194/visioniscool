<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Twilio\Rest\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function BaldeMail($blade,$data,$email,$name,$subject){
        if(\config('constant.mailEnable')){
            \Mail::send($blade, $data, function($message) use ($email,$name,$subject) {
                $message->to($email, $name)->subject($subject);
                $message->from(\config('constant.fromMail'),\config('constant.fromName'));
            });
        }
        
    }

    
    public function templateMail($templateId,$data,$email,$name,$subject){
        if(\config('constant.mailEnable')){
            $curl = curl_init();
            $dataArray = [
                'personalizations' => 
                    [
                        [ 
                            'to' => [
                                [
                                    'email' => $email,
                                    'name' => $name,
                                ]
                            ],
                            'dynamic_template_data' => $data,
                        ]        
                    ],
                'from' => 
                [
                    'email' => \config('constant.fromMail'),
                    'name' => \config('constant.fromName'),
                ],
                'reply_to' => 
                [
                   'email' => \config('constant.fromMail'),
                    'name' => \config('constant.fromName'),
                ],
                'template_id' => $templateId,
            ];
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($dataArray),
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer ".env('SEND_GRID'),
                    "content-type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }
        }
        
    }

    public function sendMessage($message, $recipients)
    {
        if(\config('constant.smsEnable')){
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_NUMBER");
            $client = new Client($account_sid, $auth_token);
            try{
                $client->messages->create($recipients, 
                    ['from' => $twilio_number, 'body' => $message] );
                return true;
            }catch(error $e){
                return false;
            }
        }
    }
}
