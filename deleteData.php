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
if (($_POST['flag'])==1) {
    deleteFile($username,$password);
} else {
    deleteAllFiles($username, $password);
}



/*
 * Die Textdatei mit dem Namen $username_$passwort wird gelöscht
 * Damit wird der Nutzer vom Repositoryserver entfernt
 */

function deleteFile($username) {

    $filepath = "./user/";
    $hstring = "_";
    $path = opendir($filepath);
    
 
    
    while ($file = readdir($path)) {
        if ($file != "." && $file != "..") {
                
        
            if(strtok($file, '_')==$username){
            
            unlink($filepath . $file);
        }
        
            }
    
    
    }
    
            }

/*
 * Löscht allt Textdateien aus dem User-Verzeichnis
 * Damit werden alle Nutzer vom Repositoryserver entfernt
 */

function deleteAllFiles($username, $password) {
    $filepath = "./user/";
    $hstring = "_";
    $path = opendir($filepath);
    if (file_exists($filepath . "$username$hstring$password.txt")) {
        while ($file = readdir($path)) {
        if ($file != "." && $file != "..") {
            unlink($filepath . $file);
        }
    }

    echo ("Alle Nutzer wurden gelöscht.");
    closedir($path);
    
    } else {
        echo ("Fehler beim Löschen. Sie sind nicht berechtigt.");
    }
    
}
