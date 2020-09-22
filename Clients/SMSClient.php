<?php
declare(strict_types=1);

class SMSClient
{
    private $baseApiClient;
    const BASE_SMS_AUTHENTICATION_URL = 'https://auth.routee.net/oauth/token';
    const BASE_SEND_SMS_URL = 'https://connect.routee.net/sms';

    /**
     * SMSClient constructor.
     * @param BaseApiClient $baseApiClient
     */
    public function __construct(BaseApiClient $baseApiClient)
    {
        $this->baseApiClient = $baseApiClient;
    }

    /**
     * @param string $compositeToken
     * @return array
     * @throws Exception
     */
    public function authenticate(string $compositeToken): array
    {
        return  $this->baseApiClient->post(self::BASE_SMS_AUTHENTICATION_URL.'?grant_type=client_credentials',
            [
                'Authorization: Basic '.$compositeToken,
                'Content-Type: application/x-www-form-urlencoded'
            ]
        );
    }

    /**
     * @param string $SMSAccessToken
     * @param SMS $SMS
     * @return array
     * @throws Exception
     */
    public function sendSMS(string $SMSAccessToken, SMS $SMS): array
    {
        return  $this->baseApiClient->post(self::BASE_SEND_SMS_URL,
            [
                'Authorization: Bearer '.$SMSAccessToken,
                'Content-Type: application/json'
            ],
            ['body'=> $SMS->getMessage(), 'to' => $SMS->getRecipient(), 'from' => $SMS->getSender()]
        );
    }
}