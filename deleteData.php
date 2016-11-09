<?php

// auslesen des zu löschenden Users aus den POST-Daten
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

// Aufruf der Funktion zum Löschen des betreffenden Users
deleteFile($username, $password);

/*
 * Die Textdatei mit dem Namen $username_$passwort wird gelöscht
 * Damit wird der Nutzer vom Repositoryserver entfernt
 */

function deleteFile($username, $password) {

    $filepath = "./user/";
    $hstring = "_";
    if (file_exists($filepath . "$username$hstring$password.txt")) {
        deleteAllFiles();
    } else {
        echo ("Fehler beim Löschen. Sie sind nicht berechtigt.");
    }
}

/*
 * Löscht allt Textdateien aus dem User-Verzeichnis
 * Damit werden alle Nutzer vom Repositoryserver entfernt
 */

function deleteAllFiles() {
    $filepath = "./user/";
    $path = opendir($filepath);

    while ($file = readdir($path)) {
        if ($file != "." && $file != "..") {
            unlink($filepath . $file);
        }
    }

    echo ("Alle Nutzer wurden gelöscht.");
    closedir($path);
}
