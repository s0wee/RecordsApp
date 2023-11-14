<?php
include_once("../../db.php");
require ('vendor/autoload.php');

$faker = Faker\Factory::create('en_PH');

$database = new Database();
$connection = $database->getConnection();

$data = array();

// generate 15 records
for($i=1; $i<=15; $i++){
    array_push($data, $faker->unique()->province);
}
print_r($data);

$sql = "INSERT INTO province(name) VALUES (:name)";
$stmt = $connection->prepare($sql);


foreach ($data as $row) {
    $stmt->bindParam(':name', $row);
    $stmt->execute();
}

// Set the Philippine timezone
date_default_timezone_set("Asia/Manila");

// Function to generate random dates within a specific date range
function randomDate($start, $end) {
    $startTimestamp = strtotime($start);
    $endTimestamp = strtotime($end);
    $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
    return date("Y-m-d H:i:s", $randomTimestamp);
}

// Populate the Office table with fake data
for ($i = 1; $i <= 50; $i++) {
    $name = "Office " . $i;
    $contactnum = "Contact " . $i;
    $email = "office$i@example.com";
    $city = "City " . $i;
    $country = "Philippines";
    $postal = "1000" . str_pad($i, 2, "0", STR_PAD_LEFT);
    
    $sql = "INSERT INTO Office (name, contactnum, email, city, country, postal) VALUES ('$name', '$contactnum', '$email', '$city', '$country', '$postal')";
    $conn->query($sql);
}

// Populate the Employee table with fake data
for ($i = 1; $i <= 200; $i++) {
    $lastname = "Lastname " . $i;
    $firstname = "Firstname " . $i;
    $office_id = rand(1, 50);
    $address = "Address " . $i;
    
    $sql = "INSERT INTO Employee (lastname, firstname, office_id, address) VALUES ('$lastname', '$firstname', $office_id, '$address')";
    $conn->query($sql);
}

// Populate the Transaction table with fake data
for ($i = 1; $i <= 500; $i++) {
    $employee_id = rand(1, 200);
    $office_id = rand(1, 50);
    $datelog = randomDate("2022-01-01", "2023-01-01"); // Adjust the date range as needed
    $action = "Action " . $i;
    $remarks = "Remarks " . $i;
    $documentcode = "DOC" . str_pad($i, 3, "0", STR_PAD_LEFT);
    $sql = "INSERT INTO Transaction (employee_id, office_id, datelog, action, remarks, documentcode) VALUES ($employee_id, $office_id, '$datelog', '$action', '$remarks', '$documentcode')";
    $conn->query($sql);
}

?>