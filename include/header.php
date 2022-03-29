<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="bg-secondary">

<!-- As a heading -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="#">Group 1 - Dentist Registry</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse float-right" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link text-light" href="../update.php">Update</a>
                <a class="nav-link text-light" href="../insert.php">Insert</a>
                <a class="nav-link text-light" href="../delete.php">Delete</a>
                <a class="nav-link text-light" href="../index.php">About</a>
            </div>
        </div>
    </div>
</nav>

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