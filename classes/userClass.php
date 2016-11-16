<?php

   class userClass {
        public $name = "";
        public $ip = "";

        
    function __construct($name) {
        $this->name = $name;
    }
    
    function test() {
        echo $this->name;  
    }
   }
