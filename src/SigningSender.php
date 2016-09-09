<?php

namespace SmartyStreets;


class SigningSender implements Sender
{

    private $signer;
    private $inner;


    public function __constructor (Credentials $signer, Sender $inner) {
        $this->signer = $signer;
        $this->inner = $inner;
    }

    public function send(Request $request) {
        $this->signer->sign($request);
        return $this->inner->send($request);
    }
}