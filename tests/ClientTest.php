<?php

namespace SmartyStreets;

require_once(dirname(dirname(__FILE__)) . '/tests/mocks/RequestCapturingSender.php');
require_once(dirname(dirname(__FILE__)) . '/tests/mocks/FakeSerializer.php');
require_once(dirname(dirname(__FILE__)) . '/src/Client.php');

use \SmartyStreets\RequestCapturingSender as FakeSender;
use \SmartyStreets\FakeSerializer as Serializer;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    function testSendingSingleFreeformLookup() {
        $sender = new FakeSender();
        $serializer = new Serializer(null);
        $client = new Client("http://localhost/", $sender, $serializer);

        $client->sendLookup(new Lookup("freeform"));

        $this->assertEquals("http://localhost/?street=freeform", $sender->getRequest()->getUrl());
    }

    function testSendingFullyPopulatedLookup() {
        $sender = new FakeSender();
        $serializer = new Serializer(null);
        $client = new Client("http://localhost/", $sender, $serializer);
        $lookup = new Lookup();

        $lookup->setAddressee("0");
        $lookup->setStreet("1");
        $lookup->setSecondary("2");
        $lookup->setStreet2("3");
        $lookup->setUrbanization("4");
        $lookup->setCity("5");
        $lookup->setState("6");
        $lookup->setZipCode("7");
        $lookup->setLastLine("8");
        $lookup->setMaxCandidates(9);
        $client->sendLookup($lookup);

        $this->assertEquals("http://localhost/?street=1&street2=3&secondary=2&city=5&state=6&zipCode=7&lastLine=8&addressee=0&urbanization=4&candidates=9", $sender->getRequest()->getUrl());
    }

    function testEmptyBatchNotSend() {
        $sender = new FakeSender();
        $serializer = new Serializer(null);
        $client = new Client("/", $sender, $serializer);

        $client->sendBatch(new Batch());

        $this->assertNull($sender->getRequest());
    }

    function testSuccessfullySendsBatchOfAddressLookups() {
        $expectedPayload = unpack('C*', 'Hello, World!');
        $sender = new FakeSender();
        $serializer = new Serializer($expectedPayload);
        $client = new Client("http://localhost/", $sender, $serializer);
        $batch = new Batch();
        $batch->add(new Lookup());
        $batch->add(new Lookup());

        $client->sendBatch($batch);

        $this->assertEquals($expectedPayload, $sender->getRequest()->getPayload());
    }
}