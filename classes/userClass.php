<?php

   class userClass {
        public $name = "";
        public $ip = "";

        
    function __construct($name,$ip) {
        $this->name = $name;
        $this->ip = $ip;
        
    }
    

    
    function test() {
        echo $this->name;  
    }
   }
