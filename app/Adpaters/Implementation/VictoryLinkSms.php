<?php


namespace App\Adpaters\Implementation;


use App\Adpaters\ISMSGateway;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class VictoryLinkSms implements ISMSGateway
{
    public $client;

    public function __construct()
    {
        if (!$this->client) {
            $this->client = new Client();
        }
    }

    /**
     * SET YOUR CLIENT TO MOVE FORWARD TO SEND A NEW SMS.
     *
     * @param Client $client
     *
     * @return $this
     */
    private function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    public function sendSms($phone, $message, $language = 'en')
    {
        $params = [
            'UserName' => config('sms.VICTORY_LINK.USERNAME'),
            'Password' => config('sms.VICTORY_LINK.PASSWORD'),
            'SMSText' => $message,
            'SMSLang' => $language == 'ar' ? 'A' : 'E',
            'SMSSender' => config('sms.VICTORY_LINK.SMS_SENDER'),
            'SMSReceiver' => $phone,
        ];

        try {
            $smsURL = "https://smsvas.vlserv.com/KannelSending/service.asmx/SendSMS";

            $response = $this->client->post($smsURL, ['form_params' => $params ]);
            $content = $response->getBody();

            $xml = (array) simplexml_load_string($content);

            if ($xml[0] == '0') {
                return true;
            } else {

                info("VictoryLink error status!");  // log
                return false;
            }
        }
        catch (\Exception $e) {
            info("VictoryLink has been trying to send sms to $phone but operation failed !");
            return false;
        }

    }


}
