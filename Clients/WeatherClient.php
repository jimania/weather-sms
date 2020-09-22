<?php
declare(strict_types=1);

class WeatherClient
{
    const BASE_WEATHER_URL = 'api.openweathermap.org/data/2.5/weather';
    const UNIT_TYPE = 'metric';
    const CITY_NAME = 'Thessaloniki';
    private $baseApiClient;

    /**
     * WeatherClient constructor.
     * @param BaseApiClient $baseApiClient
     */
    public function __construct(BaseApiClient $baseApiClient)
    {
        $this->baseApiClient = $baseApiClient;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function callWeatherApi(): array
    {
        return $this->baseApiClient->get(self::BASE_WEATHER_URL.'?q='.self::CITY_NAME.'&appid='.Constants::WEATHER_API_KEY.'&units='.self::UNIT_TYPE);
    }
}