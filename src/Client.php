<?php

namespace SmartyStreets;


class Client
{

    private $urlPrefix,
            $sender,
            $serializer;

    public function __construct($urlPrefix = null, Sender $sender = null, $serializer = null) {
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
            $request->putHeader($batch, $request);

        if ($batch->allLookupsSize() == 1)
            $this->populateQueryString($batch[0], $request);
        else {
            $request->setPayload(serialize($batch->getAllLookups()));
        }

        $response = $this->sender->send($request); // TODO: Create sender instances.
        $candidates = unserialize(serialize($response->getPayload())); //TODO: create Response class.
        if ($candidates == null)
            $candidates = new Candidate[0];
        $this->assignCandidatesToLookups($batch, $candidates);
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

    private function assignCandidatesToLookups(Batch $batch, Candidate $candidates) {
        foreach ($candidates as $candidate) {
            $batch[$candidate->getInputIndex()]->addToResults($candidate); //TODO: Create a better iterator.
        }
    }
}