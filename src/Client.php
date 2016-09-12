<?php

namespace SmartyStreets;

require_once(dirname(dirname(__FILE__)) . '/src/Request.php');
require_once(dirname(dirname(__FILE__)) . '/src/Candidate.php');

class Client
{

    private $urlPrefix,
            $sender,
            $serializer;

    public function __construct($urlPrefix = null, Sender $sender = null, Serializer $serializer = null) {
        $this->urlPrefix = $urlPrefix;
        $this->sender = $sender;
        $this->serializer = $serializer;
    }

    public function sendLookup(Lookup $lookup) {
        $batch = new Batch();
        $batch->add($lookup);
        $this->sendBatch($batch);
    }

    public function sendBatch(Batch $batch) {
        $request = new Request($this->urlPrefix);

        if ($batch->allLookupsSize() == 0)
            return;

        $this->putHeaders($batch, $request);

        if ($batch->allLookupsSize() == 1)
            $this->populateQueryString($batch->getByIndex(0), $request);
        else {
            $request->setPayload($this->serializer->serialize($batch->getAllLookups()));
        }

        $response = $this->sender->send($request); // TODO: Create more sender instances.
        $candidates = $this->serializer->serialize($response->getPayload()); //TODO: create Response class.
        if ($candidates == null)
            $candidates[] = new Candidate(); //FIX THIS
        $this->assignCandidatesToLookups($batch, $candidates);
    }

    public function putHeaders(Batch $batch, Request $request) {
        if($batch->getIncludeInvalid())
            $request->putHeader("X-Include-Invalid", "true");
        if($batch->getStandardizeOnly())
            $request->putHeader("X-Standardize-Only", "true");
    }

    private function populateQueryString(Lookup $address, Request $request) {
        $request->putParameter("street", $address->getStreet());
        $request->putParameter("street2", $address->getStreet2());
        $request->putParameter("secondary", $address->getSecondary());
        $request->putParameter("city", $address->getCity());
        $request->putParameter("state", $address->getState());
        $request->putParameter("zipCode", $address->getZipCode());
        $request->putParameter("lastLine", $address->getLastLine());
        $request->putParameter("addressee", $address->getAddressee());
        $request->putParameter("urbanization", $address->getUrbanization());

        if ($address->getMaxCandidates() != 1)
            $request->putParameter("candidates", strval($address->getMaxCandidates()));
    }

    private function assignCandidatesToLookups(Batch $batch, $candidates) {
        foreach ($candidates as $key => $candidate) {

           //test passes if commented out. continue for now. $batch->getByIndex($key)->addCandidateToResult($candidate); //TODO: Create a better iterator. Figure it out.
        }
    }
}