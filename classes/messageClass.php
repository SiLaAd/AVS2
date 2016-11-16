<?php

class messageClass {

    public $message = "";
    public $username = "";
    public $timestamp = "";

    function __construct($message, $username) {
        $this->username = $username;
        $this->message = $message;
    }

    function test() {
        echo $this->username;
        echo $this->message;
    }

}
