<?php
declare(strict_types=1);

class SMSFactory
{
    /**
     * @return string
     */
    public function createAuthenticationToken(): string
    {
        return base64_encode(Constants::SMS_APPLICATION_ID.':'.Constants::SMS_APPLICATION_SECRET);
    }


    /**
     * @param float $weatherTemperature
     * @return SMS
     * This function generates all the SMS model properties and sends it back to the service
     */
    public function createSMS(float $weatherTemperature): SMS
    {
        $SMS = new SMS();
        //checking the temperature and forming the final message, assuming float is acceptable for the temperature and = 20.00 goes to Less than.
        $SMSMessage = $weatherTemperature>=20 ? 'Temperature more than 20C. ': 'Temperature less than 20C. ' ;
        $SMSMessage.= $weatherTemperature.'C';

        $SMS->setMessage($SMSMessage);
        $SMS->setRecipient('+306948872100');
        $SMS->setSender('Dimitrios');

        return $SMS;
    }
}