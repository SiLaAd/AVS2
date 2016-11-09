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
$hstring = "_";
//prüfen ob der Benutzer berechtigt ist die Daten abzurufen (User vorhanden?)
if (file_exists($filepath . "$username$hstring$password.txt")) {
    requestData();
} else {
    echo ("Fehler beim Abrufen der Daten. Sie sind nicht berechtigt.");
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
