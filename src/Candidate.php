<?php

namespace SmartyStreets;


class Candidate
{
    private $inputIndex,
            $candidateIndex,
            $addressee,
            $deliveryLine1,
            $deliveryLine2,
            $lastLine,
            $deliveryPointBarcode,
            $components,
            $metadata,
            $analysis;

    // Constructors

    public function __construct($inputIndex = null) {
        $this->inputIndex = $inputIndex;
    }

    // Getters

    public function getComponents() {
        return $this->components;
    }

    public function getInputIndex() {
        return $this->inputIndex;
    }

    public function getCandidateIndex() {
        return $this->candidateIndex;
    }

    public function getAddressee() {
        return $this->addressee;
    }

    public function getDeliveryLine1() {
        return $this->deliveryLine1;
    }

    public function getDeliveryLine2() {
        return $this->deliveryLine2;
    }

    public function getLastLine() {
        return $this->lastLine;
    }

    public function getDeliveryPointBarcode() {
        return $this->deliveryPointBarcode;
    }

    public function getMetadata() {
        return $this->metadata;
    }

    public function getAnalysis() {
        return $this->analysis;
    }
}