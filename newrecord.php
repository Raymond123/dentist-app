<?php
include "mysqlfunc.php";
$sql = new mysqlfunc();
$conn = $sql->mysqlCon();
?>

    <main>
        <div class="container-fluid">
            <div class="col">
                <br>
                <?php
                echo '<a href="dentisthist.php?user='.$_GET['user'].'&admin='.$_GET['admin'].'" class="btn btn-dark">Return</a>';
                ?>
                <div class="row">
                    <div class="col"></div>
                    <div class="col container mt-5 text-light p-4 rounded">
                        <div class="col">
                            <h4 class="mb-3">Billing address</h4>
                            <form class="needs-validation" novalidate="" method="post">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="med" class="form-label">Medication</label>
                                        <input name="meds" type="text" id="med" class="form-control" placeholder="Meds">
                                    </div>
                                    <div class="col-6">
                                        <label for="symp" class="form-label">Symptom</label>
                                        <input name="symptom" type="text" id="symp" class="form-control" placeholder="Sore Tooth">
                                    </div>
                                    <div class="col-6">
                                        <label for="tth" class="form-label">Tooth</label>
                                        <input name="tooth" type="text" id="tth" class="form-control" placeholder="Molars">
                                    </div>

                                    <div class="col-12">
                                        <label for="cmt" class="form-label">Comment</label>
                                        <input name="comment" type="text" id="cmt" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-12">
                                        <label for="notes" class="form-label">Additional Notes</label>
                                        <textarea name="notes" rows="5" class="form-control" id="notes"></textarea>
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>

                                </div>
                                <hr class="my-4">

                                <button name="sb" class="w-100 btn btn-warning btn-lg" type="submit">Create Record</button>

                                <?php
                                if(isset($_POST['sb'])) {
                                    $meds = $_POST['meds'];
                                    $symptom = $_POST['symptom'];
                                    $appointmentId = $_GET['aid'];
                                    $type = $_GET['type'];
                                    $tooth = $_POST['tooth'];
                                    $comment = $_POST['comment'];
                                    $notes = $_POST['notes'];
                                    $ssnfetch = $sql->getSSN($conn, $_GET['pid']);
                                    $ssn = $ssnfetch->fetch_assoc();
                                    $values = [$meds, $symptom, $appointmentId, $type, $tooth, $comment, $notes, $ssn['SSN'], $_GET['pid']];

                                    if($sql->newRecord($conn, $values)){
                                        echo "<div class='h5 text-light'> Successfully Created Record</div>";
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