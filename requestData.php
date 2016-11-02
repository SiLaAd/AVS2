<?php

$filepath = "./user/"; 
$path = opendir($filepath); 

while ($file = readdir($path)){
        if($file != "." && $file != ".."){ 
            $files[] = $filepath.$file;
        }
    } 

foreach($files as $file){
    $content[] = fread(fopen($file, 'r'), filesize($file));
}

echo json_encode(array(
    'files'=> $files,
    'content'=> $content
    ));