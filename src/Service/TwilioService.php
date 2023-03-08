<?php

namespace App\Service;

use Twilio\Rest\Client;

class TwilioService
{
    private $twilioClient;
    private $twilioPhoneNumber;

    public function __construct(string $twilioAccountSid, string $twilioAuthToken, string $twilioPhoneNumber)
    {
        $this->twilioClient = new Client($twilioAccountSid, $twilioAuthToken);
        $this->twilioPhoneNumber = $twilioPhoneNumber;
    }

    public function sendSms(string $recipientPhoneNumber, string $message)
    {
        $this->twilioClient->messages->create(
            $recipientPhoneNumber,
            array(
                'from' => $this->twilioPhoneNumber,
                'body' => $message
            )
        );
    }
}