<?php
include('Autoload.php');

//here instead of triggering the script with cron, look at readme.md we can do a while(true) with sleep(600) seconds
try{
    //initialize the application
    $provider = new WeatherProvider();
    $provider->sendSMSWithWeatherInformationForThessaloniki();
} catch(Exception $e) {
    //Handle the exceptions and log the exception in the log file: error_log.txt
    file_put_contents('error_log.txt', $e->getMessage()."\n".$e->getTraceAsString()."\n", FILE_APPEND);
    echo "We cannot process your request right now, try again later";
}
