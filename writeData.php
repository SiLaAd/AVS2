<?php

/*
 * Erstellt eine Textdatei mit dem Inhalt des Parameters $username
 * In die Textdatei wird der Inhalt des Parameters $ipAdress geschrieben und gespeichert
 */

function createFile($username, $ipAdress, $password) {
    $filepath = './user/';
    $hstring = "_";
    if (file_exists($filepath . "$username$hstring$password.txt")) {
        echo("Benutzer schon vorhanden.");
    } elseif  (glob($filepath.$username.'*.txt')){
          echo("Benutzer ist schon vorhanden.");
    }else
        {
        $datei = fopen($filepath . "$username$hstring$password.txt", "w");
        fwrite($datei, "$ipAdress");
        fclose($datei);
    }
}
