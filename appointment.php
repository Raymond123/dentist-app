<?php
include "mysqlfunc.php";

?>

<main>
    <div class="container-fluid">
        <div class="col">
            <div class="row">
                <div class="col"></div>
                <div class="col container mt-5 text-light p-4 rounded">
        <div class="col">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" novalidate="" method="post">
                <div class="row">
                    <div class="col-6">
                        <label for="date" class="form-label">Date</label>
                        <input name="date" type="date" class="form-control" id="date" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="stime" class="form-label">Start Time</label>
                        <input name="stime" type="time" class="form-control" id="stime" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Procedure</label>
                        <select name="proc" class="form-control" id="email" required="">
                            <option value="">Procedure</option>
                            <?php
                            $sql = new mysqlfunc();
                            $conn = $sql->mysqlCon();

                            $proc = $sql->getProcedures($conn);
                            while($pr = $proc->fetch_assoc()){
                                echo "<option>". $pr['title'] ."</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <hr class="my-4">

                <button name="sub" class="w-100 btn btn-warning btn-lg" type="submit">Finalize Appointment</button>

                <?php
                if(isset($_POST['sub'])) {
                    $date = explode("-", $_POST['date']);
                    $stime = explode(":", $_POST['stime']);
                    $values = [$date[0], $date[1], $date[2], $stime[0], $stime[1], $_POST['proc']];

                    $sql = new mysqlfunc();
                    $conn = $sql->mysqlCon();

                    if($sql->newAppt($conn, $values)){
                        echo "<div class='h5 text-light'> Successfully Created Appointment </div>";
                    }
                }
                ?>
            </form>
        </div>
    </div>
                <div class="col"></div>
            </div>
        </div>
    </div>
</main>

<?php
include "include/footer.php";