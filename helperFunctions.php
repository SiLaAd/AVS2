<?php

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
if (isset($_POST['flag'])) {
    $flag = $_POST['flag'];
} else {
    $flag = 'flag not delivered';
}

switch($flag) {
    case'login':
         checkPerm($username, $password, $flag);
                break;
            default:
        }





function checkPerm($username, $password, $flag) {
    $filepath = './user/';
    $hstring = '_';
    $returnVar = 0;
    if (file_exists($filepath . "$username$hstring$password.txt")) {
        switch ($flag) {
            case 'login':
                $returnVar = 1;
                break;
            default:
        }
    }
    echo json_encode(array(
        'returnVar' => $returnVar
    ));
    return $returnVar;
}
function initSema() {
        $key = 666;
        $max = 1;
        $permissions = 0666;
        $autoRelease = 1;
        return $semaphore = sem_get($key, $max, $permissions, $autoRelease);
}