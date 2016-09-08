<?php
namespace SmartyStreets;
use \SmartyStreets\SmartyException as SmartyException;


class Batch
{
    const MAX_BATCH_SIZE = 100;
    private $namedLookups = [];
    private $allLookups = [];
    private $standardizeOnly, $includeInvalid;

    public function batch() {
        $this->standardizeOnly = false;
        $this->includeInvalid = false;
        $this->namedLookups = [];
        $this->allLookups = [];
    }

    public function add(Lookup $newAddress) {
        try {
            if ($this->isFull())
                throw new \Exception('Batch size cannot exceed ' . $this::MAX_BATCH_SIZE);
        } catch (\Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $this->allLookups[] = $newAddress;

        $key = $newAddress->getInputId();
        if (!$key)
            return;

        $this->namedLookups = [$key => $newAddress];

    }

    public function resetAll() {
        $this->clear();
        $this->standardizeOnly = false;
        $this->includeInvalid = false;
    }

    public function clear() {
        $this->namedLookups = [];
        $this->allLookups = [];
    }

    // Helpers

    public function allLookupsSize() {
        return count($this->allLookups);
    }

    public function namedLookupsSize() {
        return count($this->namedLookups);
    }

    public function isFull() {
        return $this->allLookupsSize() >= $this::MAX_BATCH_SIZE;
    }

    // Getters

    public function getStandardizeOnly() {
        return $this->standardizeOnly;
    }

    public function getIncludeInvalid() {
        return $this->includeInvalid;
    }

    public function getNamedLookups() {
        return $this->namedLookups;
    }

    public function getByInputId($inputId) {
        return $this->namedLookups[$inputId];
    }

    public function getByIndex($inputIndex) {
        return $this->allLookups[$inputIndex];
    }

    public function getAllLookups() {
        return $this->allLookups;
    }

    // Setters

    public function setStandardizeOnly($newValue) {
        $this->standardizeOnly = $newValue;
    }

    public function setIncludeInvalid($newValue) {
        $this->includeValid = $newValue;
    }

}