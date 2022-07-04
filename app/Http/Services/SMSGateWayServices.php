<?php

namespace App\Http\Services;

use App\Adpaters\Implementation\VictoryLinkSms;

class SMSGateWayServices
{
    public static function getServiceAdapter($country)
    {

        $countrySupport = [
            "egypt" => new VictoryLinkSms(),
            "saudia" => new VictoryLinkSms(),
        ];

        if(!isset($countrySupport[$country])){
            return new \Exception("no sms adapter valid for this country", 508);
        }

        return $countrySupport[$country];

    }


}
