<?php
require_once(dirname(dirname(__FILE__)) . '/src/lookup.php');
use \lookup\Lookup as Lookup;

class superMarketTest extends PHPUnit_Framework_TestCase {

    function testBatchKnowsWhenItsFullAndEmpty() {
        $lookup = new Lookup();

    }
}