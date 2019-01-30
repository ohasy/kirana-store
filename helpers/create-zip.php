<?php

function createZip($folder_path):array {

    $zip_name = uniqid(rand()).'.zip';
    $zip_path = 'uploads/'.$zip_name;

$zip = new ZipArchive();

// Get real path for our folder
$rootPath = realpath($folder_path);

// Initialize archive object
$zip = new ZipArchive();
$zip->open($zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
       
        $relativePath = substr($filePath, strlen($rootPath) + 1);
      
        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
        
    }
}

// Zip archive will be created only after closing object
$zip->close();

return array('zip_name'=>$zip_name,'zip_path'=>$zip_path);
}
?>