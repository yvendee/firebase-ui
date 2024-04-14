<?php

// Array to hold JSON objects
$jsonArray = array();

// Generate 20 JSON objects
for ($i = 0; $i < 20; $i++) {
    $folderName = 'Folder_' . ($i + 1);
    $jsonObject = array(
        'type' => 'folder',
        'name' => $folderName,
        'path' => '/path/to/' . $folderName
    );
    array_push($jsonArray, $jsonObject);
}

// Convert array to JSON format
$jsonString = json_encode($jsonArray, JSON_PRETTY_PRINT);

// Output JSON string
echo $jsonString;

?>
