<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "koi_farm1";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

echo "Database connection is OK";

$sql = "INSERT INTO sensor (suhu, ph, tds) VALUES (12, 23, 32)";

if (mysqli_query($conn, $sql)) {
    echo "\nNew record created successfully";
    # code...
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
