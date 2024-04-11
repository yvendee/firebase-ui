<?php

// Mockup data generation function
function generateMockupData($count) {
    $data = [];

    $roles = ['Admin', 'User', 'Manager'];
    $departments = ['Sales', 'Marketing', 'Finance', 'IT'];

    for ($i = 1; $i <= $count; $i++) {
        $id = $i;
        $fullname = "User " . $i;
        $email = "user" . $i . "@example.com";
        $role = $roles[array_rand($roles)];
        $department = $departments[array_rand($departments)];

        $data[] = [
            'ID' => $id,
            'Fullname' => $fullname,
            'Email' => $email,
            'Roles' => $role,
            'Department' => $department
        ];
    }

    return $data;
}

// Generate 20 mockup data entries
$mockupData = generateMockupData(20);

// Encode the data as JSON
$jsonData = json_encode($mockupData, JSON_PRETTY_PRINT);

// Output JSON data
header('Content-Type: application/json');
echo $jsonData;

?>
