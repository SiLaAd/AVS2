<?php

function createFile($username, $ipAdress){
    $filepath = './user/';
    
    if (file_exists ($filepath."$username.txt")){
        echo("Benutzer schon vorhanden.");
    }else{
        $datei = fopen($filepath."$username.txt","w");
        fwrite($datei, "$ipAdress");
        fclose($datei);
    }
}
//test