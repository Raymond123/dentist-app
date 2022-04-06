<?php
include "mysqlfunc.php";

?>
<div class="container mt-4">
    <div class="text-light h3">
        <?php
        echo $_GET['branch'] . " Branch";
        ?>
        <table class="table text-light">
            <thead>
                <tr>
                    <th scope="col">Manager</th>
                    <th scope="col">Receptionist Num</th>
                </tr>
            </thead>

            <tr>
                <?php
                function newRow($d1, $d2){
                    echo "<td>".$d1."</td>";
                    echo "<td>".$d2."</td>";
                }

                $sql = new mysqlfunc();
                $conn = $sql->mysqlCon();

                $branch = $sql->branchInfo($conn, $_GET['branch']);
                newRow($branch['branch_manager'],$branch['receptionist_num']);

                ?>
            </tr>
        </table>
    </div>
</div>
<?php
include "include/footer.php";