<?php
declare(strict_types=1);

class WeatherService
{
    private $weatherClient;
    private $SMSClient;
    private $weatherFactory;
    private $SMSFactory;

    /**
     * WeatherService constructor.
     * @param WeatherClient $weatherClient
     * @param WeatherFactory $weatherFactory
     * @param SMSClient $SMSClient
     * @param SMSFactory $SMSFactory
     */
    public function __construct(WeatherClient $weatherClient, WeatherFactory $weatherFactory, SMSClient $SMSClient, SMSFactory $SMSFactory)
    {
        $this->weatherClient = $weatherClient;
        $this->weatherFactory = $weatherFactory;
        $this->SMSClient = $SMSClient;
        $this->SMSFactory = $SMSFactory;
    }

    /**
     * @throws Exception
     */
    public function sendSMSWithWeatherInformationForThessaloniki(): void
    {
        $weatherAPIResponse = $this->weatherClient->callWeatherApi();

        $weather = $this->weatherFactory->getWeatherObject($weatherAPIResponse);

        $SMSAccessToken = $this->SMSClient->authenticate($this->SMSFactory->createAuthenticationToken());
        if($SMSAccessToken === null || !isset($SMSAccessToken['access_token']))
        {
            throw new Exception('Cannot be authenticated for SMS', 400);
        }

        $SMS = $this->SMSFactory->createSMS($weather->getTemperature());

        $SMSResponse = $this->SMSClient->sendSMS($SMSAccessToken['access_token'], $SMS);
        var_dump($SMSResponse);
    }
}
