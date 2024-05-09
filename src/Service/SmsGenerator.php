<?php
namespace App\Service;

use Twilio\Rest\Client;



class SmsGenerator
{
    
    public function SendSms(string $number, string $name, string $text)
    {
        
    
        //$accountSid = $_ENV['TWILIO_ACCOUNT_SID_O'];
        //$authToken = $_ENV['TWILIO_AUTH_TOKEN_O'];
        //$fromNumber = $_ENV['TWILIO_FROM_NUMBER_O'];
        
        $toNumber = $number; // Le numéro de la personne qui reçoit le message
        $message = ''.$name.' Amine Ben Jebli'.' '.$text.''; //Contruction du sms

    
        //Client Twilio pour la création et l'envoie du sms
        $client = new Client($accountSid, $authToken);

        $client->messages->create(
            $toNumber,
            [
            'from' => $fromNumber,
                'body' => $message,
            ]
        );


    }
}