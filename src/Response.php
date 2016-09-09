<?php

namespace SmartyStreets;


class Response
{
    private $statusCode,
            $payload;

    // Getters

    public function getStatusCode() {
        return $this->statusCode;
    }

    public function getPayload() {
        return $this->payload;
    }

    // Setters

    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
    }

    public function setPayload($payload) {
        $this->payload = $payload;
    }
}