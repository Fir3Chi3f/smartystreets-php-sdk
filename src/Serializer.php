<?php

namespace SmartyStreets;


interface Serializer
{
    function serialize(array $obj);

    function deserialize($payload, $type);
}