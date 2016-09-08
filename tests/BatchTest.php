<?php
require_once(dirname(dirname(__FILE__)) . '/src/batch.php');

use \SmartyStreets\Batch as Batch;
use \SmartyStreets\Lookup as Lookup;


class BatchTest extends \PHPUnit_Framework_TestCase
{
    function testGetsLookupByInputId() {
        $batch = new Batch();
        $lookup = new Lookup();
        $lookup->setInputId("hasInputId");
        $batch->add($lookup);
        $this->assertEquals($lookup, $batch->getByInputId("hasInputId"));
    }

    function testGetsLookupByIndex() {
        $batch = new Batch();
        $lookup = new Lookup();
        $batch->add($lookup);
        $this->assertEquals($lookup, $batch->getByIndex(0));
    }

    function testReturnsCorrectSize() {
        $batch = new Batch();
        $batch->add(new Lookup());
        $batch->add(new Lookup());
        $batch->add(new Lookup());
        $this->assertEquals(3, $batch->allLookupsSize());
    }

    // Can't get expected Exceptions to be found and thrown
    function testAddingALookupWhenBatchIsFullThrowsException() {
        $batch = new Batch();
        for ($i = 0; $i < $batch::MAX_BATCH_SIZE + 1; $i++)
            $batch->add(new Lookup());
        $this->setExpectedException('Exception');
    }

    function testResetMethodResetsHeadersAndLookups() {
        $batch = new Batch();
        $batch->setStandardizeOnly(true);
        $batch->setIncludeInvalid(true);
        $batch->add(new Lookup());
        $batch->resetAll();
        $this->assertEquals(0, $batch->allLookupsSize());
        $this->assertEquals(0, $batch->namedLookupsSize());
        $this->assertFalse($batch->getIncludeInvalid());
        $this->assertFalse($batch->getStandardizeOnly());
    }
}
