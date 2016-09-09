<?php

namespace SmartyStreets;


interface Sender
{
    public function send(Request $request);

}