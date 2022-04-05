<?php
include "mysqlfunc.php";
?>
<div class="container px-5 py-5" id="featured-3">
        <h2 class="pb-2 border-bottom text-light">Available Procedures</h2>
        <div class="row g-4 py-5 row-cols-3">
            <?php
            function newProc($i)
            {
                echo '<div class="feature col text-light rounded">';
                echo "    <h2>Procedure ". $i . "</h2>";
                echo "   <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>";
                //echo '   <a href="#" class="icon-link text-warning"> Dentists at this branch </a>';
                echo "</div>";
            }

            for($i=0; $i<3; $i++){ // change 3 to the number of branches
                newProc($i);
            }

            ?>
        </div>
    </div>
<?php
include "include/footer.php";

