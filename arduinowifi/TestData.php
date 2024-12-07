<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "koi_farm1";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

if (isset($_POST["tds"]) && isset($_POST["temperature"]) && isset($_POST["ph"])) {
    $tds = trim($_POST["tds"]);
    $temp = trim($_POST["temperature"]);
    $ph = trim($_POST["ph"]);

    // Validate inputs
    if (!is_numeric($tds) || !is_numeric($temp) || !is_numeric($ph)) {
        die("Invalid input data");
    }

    // Use prepared statements
    $stmt = $conn->prepare("INSERT INTO sensor (tds, temperature, ph) VALUES (?, ?, ?)");
    $stmt->bind_param("ddd", $tds, $temp, $ph); // Bind as double (float) types

    if ($stmt->execute()) {
        echo "\nNew record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Required data not provided.";
}

$conn->close();
