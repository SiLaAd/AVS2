<?php
if(isset($_POST['username'])) {
   $username= $_POST['username'];
} else {
   $username= 'username not delivered';
}

deleteFile($username);


function deleteFile($username){
    
    $filepath = "./user/";
    
    if (file_exists ($filepath."$username.txt")){
		if(unlink($filepath."$username.txt")){
			echo ("Benutzer $username wurde erfolgreich gelöscht.");
		} else {
			echo ("Fehler beim Löschen von $username.");
		};
		
	} else {
		echo("Benutzer existiert nicht.");
    }
}

?>