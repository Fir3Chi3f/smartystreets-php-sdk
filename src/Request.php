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
        $this->headers[] = [$name => $value];
    }

    public function putParameter($name, $value) {
        if ($name == null || $value == null || strlen($name) == 0)
            return;

        $this->parameters[] = [$name => $value];
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

        foreach ($this->parameters as $value) {
            if ($this->endsWith($url, "?")) {
                $url .= "&";
            }

            $encodedName = urlencode($value);
            $encodedValue = urlencode($this->parameters[$value]);
            $url .= $encodedName . "=" . $encodedValue;
        }

    }

    // Getters

    public function getPayload() {
        return $this->payload;
    }

    // Setters

    public function setPayload($payload) {
        $this->method = "POST";
        $this->payload = $payload;
    }

    // Helpers

    function endsWith($stringToCheck, $character) {
        // search forward starting from end minus needle length characters
        return $character === "" || (($temp = strlen($stringToCheck) - strlen($character)) >= 0 && strpos($stringToCheck, $character, $temp) !== false);
    }

}