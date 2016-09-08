<?php
/**
 * Created by PhpStorm.
 * User: dustin
 * Date: 9/8/16
 * Time: 5:11 PM
 */

namespace SmartyStreets;


interface Sender
{
    public function send(Request $request);

}