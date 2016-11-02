<?php
if(isset($_POST['username'])) {
   $username= $_POST['username'];
} else {
   $username= 'username not delivered';
}

if(isset($_POST['password'])) {
   $password= $_POST['password'];
} else {
   $password= 'password not delivered';
}

if(isset($_POST['pcName'])) {
   $pcName= $_POST['pcName'];
} else {
   $pcName= 'pcName not delivered';
}

if(isset($_POST['ipAdress'])) {
   $ipAdress= $_POST['ipAdress'];
} else {
   $ipAdress= 'ipAdress not delivered';
}

include('writedata.php');
createFile($username, $ipAdress);


$data = array('username'=> $username);

echo json_encode(array(
    'username'=> $username,
    'password'=> $password,
    'ipAdress'=> $ipAdress,
    'pcName'=> $pcName,
    ));
