<?php
include "include/header.php";

$conn = mysqlCon();

?>

<div class="px-4 py-5 my-5 text-center bg-dark text-light">
    <h1 class="display-5 fw-bold">Welcome to our Ottawa Dentist Registry!</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Make Appointment</button>
            <button type="button" class="btn btn-outline-secondary btn-lg px-4">Available Procedures</button>
        </div>
    </div>
</div>

<?php

include "include/footer.php";
