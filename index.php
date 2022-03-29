<?php
include "include/header.php";
include "include/footer.php";

$servername = "localhost";
$username = "root";
$password = "xMau8#e@nox?b6F?BF9dK&$?eWCa-ch8AYm";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//code code code

$conn->close();