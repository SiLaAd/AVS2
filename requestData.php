<?php
include './classes/userClass.php';
include './classes/messageClass.php';
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
            $fileextensions = array(".", "txt");
            $file2 = strtok($file, '_');
            $userCon = new userClass($file2[1]);
            $userCon->test();
            $fileWoEx[] = str_replace($fileextensions, "", $file2);
            $files[] = $file;
        }
    }

    //Liest für jede Datei den Inhalt der Datei und speichert diesen in einem Array
    foreach ($files as $file) {
        $content[] = fread(fopen($filepath . $file, 'r'), filesize($filepath . $file));
    }

    //Rückgabe des Dateinamen und des Inhalts
    echo json_encode(array(
        'files' => $fileWoEx,
        'content' => $content
    ));
}

function requestChatData($chatRaum) {

    $filepath = "./chatRooms/$chatRaum/";
    $i = 0;
    $lines = array();
    $fp = fopen($filepath . "$chatRaum.txt", 'r');
   
//    while (!feof($fp)) {
//        $line = fgets($fp);
//        $line = trim($line);
//        $lines[] = $line;
//        $messageClass = new messageClass($line, $username);
//    }
    
    $_content = file($filepath."$chatRaum.txt");
    $lineCount = count($_content);
    

    $max10Line=0;
    if($lineCount>20){
    $max10Line=$lineCount-20;
    }
    echo($lineCount);
    echo($max10Line);
    while($max10Line < $lineCount-1){
        $lines = file($filepath."$chatRaum.txt");
        $tempUser = $lines[$max10Line];
        $tempMessage = $lines[$max10Line+1];
        $max10Line++;
        $max10Line++;
        //echo($tempUser);
        echo($tempMessage);
        $messageClass = new messageClass($tempMessage, $tempUser);
        json_encode($messageClass);
        //echo($messageClass->message);
            }

    
    fclose($fp);
}