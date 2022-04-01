<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="bg-secondary">

<!-- As a heading -->
<header class="p-3 bg-dark text-white">
    <div class="container-fluid mx-auto">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="../dentist/index.php" class="d-flex align-items-center  text-left text-white text-decoration-none h3">
                Databases Project - Group 1
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto justify-content-center mb-md-0">
            </ul>

            <div class="text-end">
                <a href="../dentist/login.php" type="button" class="btn btn-warning me-2">Login</a>
            </div>
        </div>
    </div>
</header>

<?php

function mysqlCon()
{
    $servername = "localhost";
    $username = "root";
    $password = "xMau8#e@nox?b6F?BF9dK&$?eWCa-ch8AYm";

// Create connection
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function close($conn){
    $conn->close();
}