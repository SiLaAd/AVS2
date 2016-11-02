<?php

$dir = './user/';
$files = scandir($dir);

echo json_encode(array(
    'files'=> $files
    ));


?>