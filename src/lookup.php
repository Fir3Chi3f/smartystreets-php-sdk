<?php

namespace SmartyStreets;

require(dirname(dirname(__FILE__)) . '/vendor/autoload.php');


class Lookup
{
    private $result = [],
            $inputId,
            $street,
            $street2,
            $secondary,
            $city,
            $state,
            $zipCode,
            $lastLine,
            $addressee,
            $urbanization,
            $maxCandidates;

    // Constructors

    public function __constructor($freeformAddress) {
        $this->maxCandidates = 1;
        $this->result = [];
        $this->street = $freeformAddress;
    }

    // Getters

    public function getResult() {
        return $this->result;
    }

    public function getInputId() {
        return $this->inputId;
    }


    // Setters

    public function setInputId($inputId) {
        $this->inputId = $inputId;
        return $this;
    }

}