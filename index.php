<?php
include "mysqlfunc.php";

?>

<div class="px-4 py-5 mb-5 text-center bg-dark text-light">
    <h1 class="display-5 fw-bold">Welcome to Canada's Dentist Registry!</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <?php
            if(isset($_GET['user'])){
                echo '<a href="appointment.php?user='.$_GET['user'].'&admin='.$_GET['admin'].'" class="btn btn-warning btn-lg px-4 gap-3">Make Appointment</a>';
                echo '<a href="procedures.php?user='.$_GET['user'].'&admin='.$_GET['admin'].'" class="btn btn-outline-warning btn-lg px-4">Available Procedures</a>';
            }else{
                echo '<a href="login.php" class="btn btn-warning btn-lg px-4 gap-3">Login to Make Appointments</a>';
                echo '<a href="procedures.php" class="btn btn-outline-warning btn-lg px-4">Available Procedures</a>';
            }
            ?>
        </div>
    </div>
</div>

    <div class="container px-5 py-5" id="featured-3">
        <h2 class="pb-2 border-bottom text-light">Our Branches</h2>
        <div class="row g-4 py-5 row-cols-3">
            <?php
            $mysql = new mysqlfunc();
            $conn = $mysql->mysqlCon();

            function newBranch($i)
            {
                echo '<div class="feature col text-light rounded">';
                echo "    <h2>". $i . " Branch </h2>";
                echo '   <a href="branch.php?branch='.$i.'" class="icon-link text-warning"> Details </a>';
                echo "</div>";
            }

            $branches = $mysql->getBranches($conn);
            if($branches->num_rows > 0) {
                while ($branch = $branches->fetch_assoc()) {
                    newBranch($branch['city']);
                }
            }

            $mysql->close($conn);
            ?>
        </div>
    </div>

<?php

include "include/footer.php";
