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

    public function __construct($freeformAddress = null) {
        $this->maxCandidates = 1;
        $this->result = [];
        $this->street = $freeformAddress;
    }

    public function addCandidateToResult($newCandidate) {
        $this->result[] = $newCandidate;
    }

    // Getters

    public function getResult() {
        return $this->result;
    }

    public function getInputId() {
        return $this->inputId;
    }

    public function getStreet() {
        return $this->street;
    }

    public function getStreet2() {
        return $this->street2;
    }

    public function getSecondary() {
        return $this->secondary;
    }

    public function getCity() {
        return $this->city;
    }

    public function getState() {
        return $this->state;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function getLastLine() {
        return $this->lastLine;
    }

    public function getAddressee() {
        return $this->addressee;
    }

    public function getUrbanization() {
        return $this->urbanization;
    }

    public function getMaxCandidates() {
        return $this->maxCandidates;
    }

    // Setters

    public function setInputId($inputId) {
        $this->inputId = $inputId;
        return $this;
    }

    public function setResult(array $result) {
        $this->result = $result;
    }

    public function setStreet($street) {
        $this->street = $street;
    }

    public function setStreet2($street2) {
        $this->street2 = $street2;
    }

    public function setSecondary($secondary) {
        $this->secondary = $secondary;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    public function setLastLine($lastLine) {
        $this->lastLine = $lastLine;
    }

    public function setAddressee($addressee) {
        $this->addressee = $addressee;
    }

    public function setUrbanization($urbanization) {
        $this->urbanization = $urbanization;
    }

    public function setMaxCandidates($maxCandidates) {
        $this->maxCandidates = $maxCandidates;
    }

}