<?php

// Auslesen der übertragenen POST-Daten
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
    $flag = 'chatRaum not delivered';
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
            $file2=strtok($file, '_');
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
    
    
    function requestChatData($chatRaum){
        
    $filepath = "./chatRooms/$chatRaum/";
    $jsonMessage = "";
    $i=1;
    $lines=array();
    $fp=fopen($filepath . "$chatRaum.txt", 'r');
    while (!feof($fp))
    {
    $line=fgets($fp);

    //process line however you like
    $line=trim($line);

    //add to array
    $lines[]=$line;
    
}
fclose($fp);
var_dump($lines[13]);
    //$filearray = fread(fopen($filepath . "$chatRaum.txt","r+"),filesize($filepath . "$chatRaum.txt"));
//    $handle = fopen($filepath . "$chatRaum.txt","r+");
//            if ($handle) {
//    while (($line = fgets($handle)) !== false) {
//        $array[] = $line[$i];
//        $i++;
//        
//    }
//    foreach ($array as $key => $val) {
//        var_dump($val);
//    }
//    fclose($handle);
//} else {
    // error opening the file.
} 
    //$lastfifteenlines = array_slice($filearray,-11,11);
        //$file[] = 
        //for ($i = max(0, count($lastfifteenlines)); $i < count($lastfifteenlines); $i++) {
//        foreach ($filearray as $lf){
//            $jsonMessage = $jsonMessage . $lf;
//        }
        

        
       // }
        
