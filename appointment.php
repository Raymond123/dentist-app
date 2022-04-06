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
                    <div class="col-12">
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

                    <div class="col-6">
                        <label for="etime" class="form-label">End Time</label>
                        <div class="input-group has-validation">
                            <input name="etime" type="time" class="form-control" id="etime" placeholder="" required="">
                            <div class="invalid-feedback">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Procedure</label>
                        <select name="proc" class="form-control" id="email" required="">
                            <option value="">Procedure</option>
                            <option>Dental Fillings</option>
                            <option>Bonding</option>
                            <option>Orthodontics</option>
                            <option>Root Canals</option>
                            <option>Dental Crowns</option>
                            <option>Dental Bridges</option>
                            <option>Dentures</option>
                            <option>Oral and Maxillofacial Procedures</option>
                            <option>Periodontal Treatment</option>
                            <option>Laser Procedures</option>
                        </select>
                    </div>

                </div>
                <hr class="my-4">

                <button class="w-100 btn btn-warning btn-lg" type="submit">Finalize Appointment</button>
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