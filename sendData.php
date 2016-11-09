<?php

// Auslesen der übertragenen POST-Daten
if (isset($_POST['username'])) {
    $username = $_POST['username'];
} else {
    $username = '';
}

if (isset($_POST['password'])) {
    $password = $_POST['password'];
} else {
    $password = '';
}

if (isset($_POST['pcName'])) {
    $pcName = $_POST['pcName'];
} else {
    $pcName = 'pcName not delivered';
}

if (isset($_POST['ipAdress'])) {
    $ipAdress = $_POST['ipAdress'];
} else {
    $ipAdress = 'ipAdress not delivered';
}
if (empty($username) or empty($password)) {
    echo("User und Passwort müssen ausgefüllt sein!");
} else {
// Einbinden des Scripts zum Erstellen der Textdateien
    include('writedata.php');
    createFile($username, $ipAdress, $password);

    $data = array('username' => $username);

    echo json_encode(array(
        'username' => $username,
        'password' => $password,
        'ipAdress' => $ipAdress,
        'pcName' => $pcName,
    ));
}