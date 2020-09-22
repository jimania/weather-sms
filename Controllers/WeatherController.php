<?php
declare(strict_types=1);

class WeatherController
{
    private $weatherService;

    /**
     * WeatherController constructor.
     * @param WeatherService $weatherService
     */
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * @throws Exception
     */
    public function sendSMSWithWeatherInformationForThessaloniki(): void
    {
        $this->weatherService->sendSMSWithWeatherInformationForThessaloniki();
    }
}
