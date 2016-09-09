<?php

namespace SmartyStreets;

require_once(dirname(dirname(dirname((__FILE__)))) . '/src/Serializer.php');

class FakeSerializer implements Serializer
{
    private $bytes;

    function __construct($bytes = null) {
        $this->bytes = $bytes;
    }

    function serialize(array $obj) {
        return $this->bytes;
    }

    function deserialize($payload, $type) {
        return null;
    }
}