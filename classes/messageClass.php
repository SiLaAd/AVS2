<?php

class messageClass {

    public $message = "";
    public $username = "";
    public $timestamp = "";

    function __construct($message, $username) {
        $this->username = $username;
        $this->message = $message;
        $this->timestamp = date("Y-m-d H:i:s");   
    }

    function test() {
        echo $this->username;
        echo $this->message;
        echo $this->timestamp;
    }

}