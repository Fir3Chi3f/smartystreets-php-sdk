<?php

namespace SmartyStreets;


class Request
{
    private $headers,
            $parameters,
            $urlPrefix,
            $method,
            $payload;

    public function __construct($urlPrefix = null) {
        $this->method = "GET";
        $this->headers = [];
        $this->parameters = [];
        $this->urlPrefix = $urlPrefix;
    }

    public function putHeader($name, $value) {
        $this->headers[$name] = $value;
    }

    public function putParameter($name, $value) {
        if ($name == null || $value == null || strlen($name) == 0)
            return;

        $this->parameters[$name] = $value;
    }

    public function urlEncode($value) {
        try {
           return urlencode($value);
        } catch (\Exception $e) {
            return "";
        }
    }

    public function getUrl() {
        $url = $this->urlPrefix;

        if (!strpos($url, "?"))
            $url .= "?";

        foreach ($this->parameters as $key => $value) {
            if (!$this->endsWith($url, "?")) {
                $url .= "&";
            }

            $encodedName = $this->urlEncode($key);
            $encodedValue = $this->urlEncode($value);
            $url .= $encodedName . "=" . $encodedValue;
        }
        return $url;

    }

    // Getters

    public function getPayload() {
        return $this->payload;
    }

    public function getHeaders() {
        return $this->headers;
    }

    // Setters

    public function setPayload($payload) {
        $this->method = "POST";
        $this->payload = $payload;
    }

    // Helpers

    function endsWith($stringToCheck, $character) {
        return $character === "" || (($temp = strlen($stringToCheck) - strlen($character)) >= 0 && strpos($stringToCheck, $character, $temp) !== false);
    }

}