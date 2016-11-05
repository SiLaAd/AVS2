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

$filepath = "./user/";
if (file_exists($filepath . "$username$password.txt")) {
    requestData();
} else {
    echo ("Fehler beim Abrufen der Daten. Sie sind nicht berechtigt.");
}

function requestData() {
    $filepath = "./user/";
    $path = opendir($filepath);

    while ($file = readdir($path)) {
        if ($file != "." && $file != "..") {
            $fileextensions = array(".", "txt");
            $fileWoEx[] = str_replace($fileextensions, "", $file);
            $files[] = $file;
        }
    }

    foreach ($files as $file) {
        $content[] = fread(fopen($filepath . $file, 'r'), filesize($filepath . $file));
    }

    echo json_encode(array(
        'files' => $fileWoEx,
        'content' => $content
    ));
}
