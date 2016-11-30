<?php
include './classes/userClass.php';
include './classes/messageClass.php';
include './helperFunctions.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
} else {
    $username = 'username not delivered';
}

if (isset($_POST['textMessage'])) {
    $textMessage = $_POST['textMessage'];
} else {
    $textMessage = 'Nachricht not delivered';
}
if (isset($_POST['chatRaum'])) {
    $chatRaum = $_POST['chatRaum'];
} else {
    $chatRaum = 'chatraum not delivered';
}
if (isset($_POST['flag'])) {
    $flag = $_POST['flag'];
} else {
    $flag = 'flag not delivered';
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
} else {
    $password = '';
}


if ($_SERVER['REMOTE_ADDR']=='::1') {
    $ipAdress =  getHostByName(getHostName());
} else {
    $ipAdress = $_SERVER['REMOTE_ADDR'];
}
if (isset($_POST['pcName'])) {
    $pcName = $_POST['pcName'];
} else {
    $pcName = '';
}

switch ($flag) {
    case'sendMessage':
        writeChatData($username, $textMessage, $chatRaum);
        break;
    case 'addUser':
        createFile($username, $ipAdress, $password,$pcName);
        break;        
    default:
}

function createFile($username, $ipAdress, $password,$pcName) {
    $filepath = './user/';
    $hstring = "_";
    if (file_exists($filepath . "$username$hstring$password.txt")) {
        echo("Benutzer schon vorhanden.");
    } elseif (glob($filepath . $username . '*.txt')) {
        echo("Benutzer ist schon vorhanden.");
    } else {
        
        
        $datei = fopen($filepath . "$username$hstring$password.txt", "w");
        $user = new userClass ($username,$ipAdress);
        fwrite($datei,serialize($user));
        //fwrite($datei, "$ipAdress");
        fclose($datei);
    }
    
    echo json_encode(array(
        'username' => $username,
        'password' => $password,
        'ipAdress' => $ipAdress,
        'pcName' => $pcName,
    ));
    
    
}

function writeChatData($username, $nachricht, $chatRaum) {
    $semaphore = initSema();
    while (!$semaphore) {
            echo "Failed on sem_get().\n";
        }
    sem_acquire($semaphore);
    $message = new messageClass($nachricht,$username); 
    $filepath = "./chatRooms/$chatRaum/";
    
    $datei = fopen($filepath . "$chatRaum.txt", "a+");   // Datei öffnen
    fwrite($datei, serialize($message)."\r\n");   // Daten schreiben, Zeilenumbruch
    fclose($datei);   
    sem_release($semaphore);
}
