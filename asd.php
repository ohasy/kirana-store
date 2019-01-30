<?php

function createZip($folder_path):string {

    $zip_name = uniqid(rand()).'.zip';


$zip = new ZipArchive();

// Get real path for our folder
$rootPath = realpath('libs');

// Initialize archive object
$zip = new ZipArchive();
$zip->open('file.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

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
        echo("filepath".$filePath);
        $relativePath = substr($filePath, strlen($rootPath) + 1);
        echo("relativePath".$relativePath);
        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
        
    }
}

// Zip archive will be created only after closing object
$zip->close();

return $zip_name;
}
createZip("heu");
?>