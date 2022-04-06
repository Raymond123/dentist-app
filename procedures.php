<?php
include "mysqlfunc.php";
?>
<div class="container px-5 py-5" id="featured-3">
        <h2 class="pb-2 border-bottom text-light">Available Procedures</h2>
        <div class="row g-4 py-5 row-cols-3">
            <?php
            function newProc($i, $l)
            {
                echo '<div class="feature col text-light rounded">';
                echo "   <h2> ". $i . "</h2>";
                echo "   <p>$l</p>";
                //echo '   <a href="#" class="icon-link text-warning"> Dentists at this branch </a>';
                echo "</div>";
            }

            $sql = new mysqlfunc();
            $conn = $sql->mysqlCon();

            $procs = $sql->getProcedures($conn);
            while($proc = $procs->fetch_assoc()){ // change 3 to the number of branches
                newProc($proc['title'], $proc['description']);
            }

            ?>
        </div>
    </div>
<?php
echo "<div class='text-light text-center'>Dental procedure information is from https://www.yourdentistryguide.com/procedures/ </div>";
include "include/footer.php";

