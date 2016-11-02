<?php
// auslesen des zu löschenden Users aus den POST-Daten
if(isset($_POST['username'])) {
   $username= $_POST['username'];
} else {
   $username= '';
}

// Aufruf der Funktion zum Löschen des betreffenden Users
deleteFile($username);

/*
 * Die Textdatei mit dem Namen $username wird gelöscht
 * Damit wird der Nutzer vom Repositoryserver entfernt
 * Wenn $username leer ist, wird die Funktion deleteAllFiles(); aufgerufen
 */
function deleteFile($username){
    
    $filepath = "./user/";
    
    if (file_exists ($filepath."$username.txt")){
        if(unlink($filepath."$username.txt")){
            echo ("Benutzer $username wurde erfolgreich gelöscht.");
        } else {
            echo ("Fehler beim Löschen von $username.");
        }	
    } else {
	deleteAllFiles();
    }
}

/*
 * Löscht allt Textdateien aus dem User-Verzeichnis
 * Damit werden alle Nutzer vom Repositoryserver entfernt
 */
function deleteAllFiles() {
    $filepath = "./user/"; 
    $path = opendir($filepath); 
    
    while ($file = readdir($path)){
        if($file != "." && $file != ".."){ 
            unlink($filepath.$file);
        }
    } 
    
    echo ("Alle Nutzer wurden gelöscht.");
    closedir($path);  
}
