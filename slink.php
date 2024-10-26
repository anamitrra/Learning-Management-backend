<?php
//$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
//$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
// symlink($targetFolder,$linkFolder);
// echo  'Symlink process successfully completed' .  "\n" . 'target : ' . $targetFolder .  "\n" . 'link :' . $linkFolder ;


$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
echo  'Url' .  "\n" . 'target : ' . $targetFolder .  "\n" . 'link :' . $linkFolder ;
if (symlink($targetFolder, $linkFolder)) {
    echo 'Symlink process successfully completed' . "\n";
    echo 'Target: ' . $targetFolder . "\n";
    echo 'Link: ' . $linkFolder . "\n";
} else {
    echo 'Failed to create symlink.' . "\n";
    $error = error_get_last();
    echo 'Error: ' . $error['message'];
}



?>