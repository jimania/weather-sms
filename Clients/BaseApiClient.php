<?php
declare(strict_types=1);

class BaseApiClient
{
    const GET = 'GET';
    const POST = 'POST';
    const CURL_HTTP_VERSION = 'CURL_HTTP_VERSION_1_1';
    const CURLOPT_RETURNTRANSFER = true;
    const CURLOPT_ENCODING = "";
    const CURLOPT_MAXREDIRS = 10;
    const CURLOPT_TIMEOUT = 0;
    const CURLOPT_FOLLOWLOCATION = true;

    private $default_settings;

    /**
     * BaseApiClient constructor.
     */
    public function __construct()
    {
        $this->default_settings = [
            CURLOPT_RETURNTRANSFER => self::CURLOPT_RETURNTRANSFER,
            CURLOPT_ENCODING => self::CURLOPT_ENCODING,
            CURLOPT_MAXREDIRS => self::CURLOPT_MAXREDIRS,
            CURLOPT_TIMEOUT => self::CURLOPT_TIMEOUT,
            CURLOPT_FOLLOWLOCATION => self::CURLOPT_FOLLOWLOCATION,
            CURLOPT_HTTP_VERSION => self::CURL_HTTP_VERSION,
        ];
    }


    /**
     * @param string $url
     * @param array|null $headers
     * @return array
     * @throws Exception
     */
    public function get(string $url, array $headers = null): array
    {
        $curl = curl_init();

        $settings = $this->default_settings;
        $settings[CURLOPT_URL] = $url;
        $settings[CURLOPT_CUSTOMREQUEST] = self::GET;

        if($headers !== null)
            $settings[CURLOPT_HTTPHEADER] = $headers;

        curl_setopt_array($curl, $settings);
        $result = curl_exec($curl);

        $curlError = curl_error($curl);
        curl_close($curl);

        if(!$result)
           throw new Exception($curlError);

        $decodedResult = json_decode($result, true);
        if($decodedResult === null)
            throw new Exception('Invalid Response from internal API call', 400);

        return $decodedResult;
    }

    /**
     * @param string $url
     * @param array|null $headers
     * @param array|null $data_parameters
     * @return array
     * @throws Exception
     */
    public function post(string $url, array $headers = null, array $data_parameters = null): array
    {
        $curl = curl_init();

        $settings = $this->default_settings;
        $settings[CURLOPT_URL] = $url;
        $settings[CURLOPT_CUSTOMREQUEST] = self::POST;

        if($headers !== null)
            $settings[CURLOPT_HTTPHEADER] = $headers;
        if($data_parameters !== null)
            $settings[CURLOPT_POSTFIELDS] = json_encode($data_parameters);

        curl_setopt_array($curl, $settings);
        $result = curl_exec($curl);

        $curlError = curl_error($curl);
        curl_close($curl);

        if(!$result)
            throw new Exception($curlError);

        $decodedResult = json_decode($result, true);
        if($decodedResult === null)
            throw new Exception('Invalid Response from internal API call', 400);

        return $decodedResult;
    }
}