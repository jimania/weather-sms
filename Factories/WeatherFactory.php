<?php
declare(strict_types=1);

class WeatherFactory
{
    /**
     * @param array $weatherAPIResponse
     * @return Weather
     * @throws Exception
     */
    public function getWeatherObject(array $weatherAPIResponse): Weather
    {
        $weather = new Weather();
        //Weather API response validation with exception
        if(!isset($weatherAPIResponse['main']) || !isset($weatherAPIResponse['main']['temp']))
            throw new Exception("Invalid API response", 500);

        $weather->setTemperature((float) $weatherAPIResponse['main']['temp']);
        return $weather;
    }
}