<?php
$conn = new mysqli("localhost", "root", "", "koi_farm1");
$pond_id = 7; // Sesuaikan dengan pond_id yang relevan

$query = "SELECT relay_condition FROM ponds WHERE id = $pond_id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

echo $row['relay_condition'];
?>
