<?php
declare(strict_types=1);

class Weather
{
    protected $temperature;

    /**
     * @param float $temperature
     */
    function setTemperature(float $temperature) : void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return float|null
     */
    function getTemperature() : ?float
    {
        return $this->temperature;
    }
}
