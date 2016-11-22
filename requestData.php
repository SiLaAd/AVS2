<?php

include './classes/userClass.php';
include './classes/messageClass.php';
ini_set('unserialize_callback_func', 'callback');

//Auslesen der übertragenen POST-Daten
if (isset($_POST['username'])) {
    $username = $_POST['username'];
} else {
    $username = 'username not delivered';
}

if (isset($_POST['password'])) {
    $password = $_POST['password'];
} else {
    $password = 'password not delivered';
}
if (isset($_POST['flag'])) {
    $flag = $_POST['flag'];
} else {
    $flag = 'flag not delivered';
}

if (isset($_POST['chatRaum'])) {
    $chatRaum = $_POST['chatRaum'];
} else {
    $chatRaum = 'chatRaum not delivered';
}


switch ($flag) {
    case'chatData':
        requestChatData($chatRaum);
        break;
    case'requestData':
        $filepath = "./user/";
        $hstring = "_";
//prüfen ob der Benutzer berechtigt ist die Daten abzurufen (User vorhanden?)
        if (file_exists($filepath . "$username$hstring$password.txt")) {
            requestData();
        } else {
            echo ("Fehler beim Abrufen der Daten. Sie sind nicht berechtigt.");
        }
    default:
}



/*
 * Liest das "user" Verzeichnis und gibt die Dateinamen und deren Inhalt zurück
 */

function requestData() {
    $filepath = "./user/";
    $path = opendir($filepath);

    while ($file = readdir($path)) {
        if ($file != "." && $file != "..") {
            $tempString = fread(fopen($filepath . $file, 'r'), filesize($filepath . $file));
            $fileWoEx[] = unserialize($tempString);

        }
    }

    //Rückgabe des Dateinamen und des Inhalts
    echo json_encode(array(
        'files' => $fileWoEx
    ));
}

function requestChatData($chatRaum) {
    $filepath = "./chatRooms/$chatRaum/";
    $lines = array();
    $fp = fopen($filepath . "$chatRaum.txt", 'r');
    $i=0;

    $content = file($filepath . "$chatRaum.txt");
    //$anzahl = count($_content);
    
    foreach ($content as $mess){
    $ob=unserialize($mess);
    $messageArray[] = $ob;
 
    }
    
//    foreach ($messageArray as $mess){
//    echo($mess ->message."\n");
//    
//    }

   
    echo json_encode(array(
        'messages' =>$messageArray
            ));
//    $lineCount = count($_content);
//
//
//    $max10Line = 0;
//    if ($lineCount > 20) {
//        $max10Line = $lineCount - 20;
//    }
//
//    while ($max10Line < $lineCount - 1) {
//        $lines = file($filepath . "$chatRaum.txt");
//        $tempUser = $lines[$max10Line];
//        $tempMessage = $lines[$max10Line + 1];
//        $max10Line++;
//        $max10Line++;
//        $messageClass = new messageClass($tempMessage, $tempUser);
//        $messageArray[$i]=$messageClass->message;
//        $i++;
//    }
//    
//    echo json_encode($messageArray[$i-1]);
//    fclose($fp);
}

function testArray($array){
    $arrayCount = count($array);
    $j=0;
    $json = "";
    
    while($j<$arrayCount){
        $json = json_encode($array[$j]);
        $j++;
        echo str($json);
    }

    
 //callbalck für unserialize   
 function callback($classname){
        require_once $classname.".php";
    }
    
}