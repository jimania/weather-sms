<?php
declare(strict_types=1);

class WeatherProvider
{
    private $weatherController;

    /**
     * WeatherProvider constructor.
     */
    public function __construct()
    {
        $baseAPIClient = new BaseApiClient();
        $weatherClient = new WeatherClient($baseAPIClient);
        $weatherFactory = new WeatherFactory();
        $SMSClient = new SMSClient($baseAPIClient);
        $SMSFactory = new SMSFactory();
        $weatherService = new WeatherService($weatherClient, $weatherFactory, $SMSClient, $SMSFactory);
        $this->weatherController = new WeatherController($weatherService);
    }

    /**
     * @throws Exception
     */
    public function sendSMSWithWeatherInformationForThessaloniki(): void
    {
        try{
            $this->weatherController->sendSMSWithWeatherInformationForThessaloniki();
        } catch(Exception $e) {

            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}