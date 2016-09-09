<?php

namespace SmartyStreets;

require_once(dirname(dirname(dirname((__FILE__)))) . '/src/Sender.php');
require_once(dirname(dirname(dirname((__FILE__)))) . '/src/Response.php');

class RequestCapturingSender implements Sender
{
    private $request;

    function send(Request $request) {
        $this->request = $request;
        return new Response(200, unpack('C*', '[]'));
    }

    public function getRequest() {
        return $this->request;
    }

}