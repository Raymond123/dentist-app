<?php
include "../mysqlfunc.php"
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="bg-secondary">

<!-- As a heading -->
<header class="p-3 bg-dark text-white">
    <div class="container-fluid mx-auto">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <?php
            echo '<a href="../dentist/index.php?user='.$_GET['user'].'&admin='.$_GET['admin'].'" class="d-flex align-items-center  text-left text-white text-decoration-none h3">'
               ?>
                Databases Project - Group 1
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto justify-content-center mb-md-0">
            </ul>

            <div class="text-end">
                <?php
                if($_GET['admin'] == 'true')
                    echo '<a href="../dentist/admin.php?user='.$_GET['user'].'&admin='.$_GET['admin'].'" type="button" class="text-link text-warning me-2">'.$_GET['user'].' account</a>';

                if($_GET['admin'] == 'false')
                    echo '<a href="../dentist/index.php?user='.$_GET['user'].'&admin='.$_GET['admin'].'" type="button" class="text-link text-warning me-2">'.$_GET['user'].' account</a>';

                ?>
            </div>
        </div>
    </div>
</header>