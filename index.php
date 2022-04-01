<?php
include "include/header.php";

$conn = mysqlCon();

?>

<div class="px-4 py-5 mb-5 text-center bg-dark text-light">
    <h1 class="display-5 fw-bold">Welcome to our Ottawa Dentist Registry!</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="appointment.php" class="btn btn-warning btn-lg px-4 gap-3">Make Appointment</a>
            <a href="#" class="btn btn-outline-warning btn-lg px-4">Available Procedures</a>
        </div>
    </div>
</div>

    <div class="container px-5 py-5" id="featured-3">
        <h2 class="pb-2 border-bottom text-light">Our Branches</h2>
        <div class="row g-4 py-5 row-cols-3">
            <?php
            function newBranch($i)
            {
                echo '<div class="feature col text-light rounded">';
                echo "    <h2>Branch ". $i . "</h2>";
                echo "   <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>";
                echo '   <a href="#" class="icon-link text-warning"> Dentists at this branch </a>';
                echo "</div>";
            }

            for($i=0; $i<3; $i++){ // change 3 to the number of branches
                newBranch($i);
            }

            ?>
        </div>
    </div>

<?php

include "include/footer.php";
