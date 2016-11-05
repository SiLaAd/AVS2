<?php

/*
 * Erstellt eine Textdatei mit dem Inhalt des Parameters $username
 * In die Textdatei wird der Inhalt des Parameters $ipAdress geschrieben und gespeichert
 */

function createFile($username, $ipAdress, $password) {
    $filepath = './user/';

    if (file_exists($filepath . "$username$password.txt")) {
        echo("Benutzer schon vorhanden.");
    } else {
        $datei = fopen($filepath . "$username$password.txt", "w");
        fwrite($datei, "$ipAdress");
        fclose($datei);
    }
}
