<?php

class Curl
{
    /**
     * @var string
     */
    private $address;

    /**
     * @var resource
     */
    private $curl;

    /**
     * Curl constructor.
     * @param string $address
     */
    public function __construct(string $address)
    {
        if (!function_exists('curl_init')) {
            die('CURL is not enabled');
        }

        $this->address = $address;
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @param string $action
     * @param array $params
     * @return string
     */
    public function get(string $action, array $params = []): string
    {
        $this->setUrl($action, $params);

        return curl_exec($this->curl);
    }

    public function post(string $action, array $data, array $params = []): string
    {
        $this->setUrl($action, $params);

        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));

        return curl_exec($this->curl);
    }

    /**
     * @param string $action
     * @param array $params
     */
    private function setUrl(string $action, array $params = []): void
    {
        $url = rtrim($this->address, " \t\n\r\0\x0B/") . '/' . trim($action, " \t\n\r\0\x0B/");
        $getParams = [];
        foreach ($params as $key => $value) {
            $getParams[] = sprintf('%s=%s', $key, urlencode($value));
        }

        $separator = stripos($url, '?') ? '&' : '?';
        if ($getParams) {
            $url .= $separator . implode('&', $getParams);
        }

        curl_setopt($this->curl, CURLOPT_URL, $url);
    }
}