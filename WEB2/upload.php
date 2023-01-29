<?php
if(!array_key_exists('submit', $_POST) || $_POST['submit'] != 'upload'){
    echo 'Hibás kérés';
    include 'index.php';
    return;
}
$filesize = $_FILES['file']['size'];

if(1024*1024 < $filesize){
    echo'Túl nagy fájl!';
    include'index.php';
    return;
}

$extensions = ['png','jpg','jpeg'];
$filename = $_FILES['file']['name'];
$filenameParts = explode('.',$filename);
$fileExtension = end($filenameParts);
$fileExtension = strtolower($fileExtension);

if(!in_array($fileExtension, $extensions)){
    echo 'Hibás kiterjesztés.';
    include 'index.php';
    return;
}
$filename ='telefon.png';
$fileSource = $_FILES['file']['tmp_name'];
$destSource = './pushedpic/'.$filename;

if(!move_uploaded_file($fileSource, $destSource)){
   echo'Hiba az átmozgatás során!';
   include 'index.php';
   return;
}

echo'Sikeres feltöltés! Kész!';
include 'index.php';