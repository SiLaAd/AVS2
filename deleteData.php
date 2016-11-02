<?php
if(isset($_POST['username'])) {
   $username= $_POST['username'];
} else {
   $username= '';
}

deleteFile($username);


function deleteFile($username){
    
    $filepath = "./user/";
    
    if (file_exists ($filepath."$username.txt")){
		if(unlink($filepath."$username.txt")){
                    echo ("Benutzer $username wurde erfolgreich gelöscht.");
		} elseif(empty($username)) {
                    deleteAllFiles();
		} else {
                    echo ("Fehler beim Löschen von $username.");
                }
		
	} else {
		echo("Benutzer existiert nicht.");
    }
}

function deleteAllFiles() {
    $filepath = "./user/"; 
    $path = opendir($filepath); 
  
    while ($file = readdir ($path)){
        if($file != "." && $file != ".."){ 
            ($path.$file);
        } 
    } 
    
    echo ("Alle Nutzer wurden gelöscht.");
    closedir($path);  
}

?>