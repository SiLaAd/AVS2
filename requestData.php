<?php

$filepath = "./user/"; 
$path = opendir($filepath); 

while ($file = readdir($path)){
        if($file != "." && $file != ".."){ 
            $fileextensions = array(".", "txt");
            $fileWoEx[] = str_replace($fileextensions, "", $file);
            $files[] = $file;
        }
    } 

foreach($files as $file){
    $content[] = fread(fopen($filepath.$file, 'r'), filesize($filepath.$file));
}

echo json_encode(array(
    'files'=> $fileWoEx,
    'content'=> $content
    ));