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
                            <h4 class="mb-3">New Patient</h4>
                            <form class="needs-validation" novalidate="" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="firstName" class="form-label">First name</label>
                                        <input name="fname" type="text" class="form-control" id="firstName" placeholder="John" value="" required="">
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="lastName" class="form-label">Last name</label>
                                        <input name="lname" type="text" class="form-control" id="lastName" placeholder="Doe" value="" required="">
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="addr" class="form-label">Address</label>
                                        <input name="addr" class="form-control" id="addr" required="" placeholder="">
                                        <div class="invalid-feedback">
                                            Please select a valid address.
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label for="city" class="form-label">City</label>
                                        <input name="city" class="form-control" id="city" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Please provide a valid city.
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label for="prov" class="form-label">Province</label>
                                        <input name="prov" type="text" class="form-control" id="prov" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Please enter a valid province.
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select name="gender" class="form-select" id="gender" required="">
                                            <option value="">Choose..</option>
                                            <option>male</option>
                                            <option>female</option>
                                            <option>prefer not to specify</option>
                                        </select>
                                    </div>

                                    <div class="col-8">
                                        <label for="email" class="form-label">Email</label>
                                        <input name="email" type="text" class="form-control" id="email" placeholder="example@gmail.com" required="">
                                        <div class="invalid-feedback">
                                            Please enter a valid province.
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label for="ssn" class="form-label">SSN</label>
                                        <input name="ssn" type="text" class="form-control" id="ssn" placeholder="XXX-XX-XXXX" required="">
                                        <div class="invalid-feedback">
                                            Please enter a valid SSN.
                                        </div>
                                    </div>

                                    <div class="col-8">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input name="dob" type="date" class="form-control" id="dob" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Please enter a valid month.
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="insurance" class="form-label">Insurance #</label>
                                        <input name="insurance" type="text" class="form-control" id="insurance" placeholder="XX-XX-XX-XX-X" required="">
                                        <div class="invalid-feedback">
                                            Please enter a valid month.
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="phone" class="form-label">Phone #</label>
                                        <input name="phone" type="text" class="form-control" id="phone" placeholder="(123) 456-7890" required="">
                                        <div class="invalid-feedback">
                                            Please enter a valid month.
                                        </div>
                                    </div>

                                <hr class="my-4">

                                <button name="sub" class="w-100 btn btn-warning btn-lg" type="submit">Add Patient</button>
                                </div>
                            </form>

                            <?php
                            if(isset($_POST['sub'])){
                                $sql = new mysqlfunc();
                                $conn = $sql->mysqlCon();

                                $pass = hash("sha256", $_POST['pass']);

                                $house_num = preg_replace("/[^0-9]/", '', $_POST['addr']);
                                $street = preg_replace("/[^a-z\s]/",'', strtolower($_POST['addr']));

                                $ssn = preg_replace("/[^0-9]/", '', $_POST['ssn']);
                                $phone = preg_replace("/[^0-9]/", '', $_POST['phone']);

                                $values = [(int) $house_num, $street, strtolower($_POST['city']),
                                    strtolower($_POST['prov']),strtolower($_POST['fname']),strtolower($_POST['lname']),
                                    $_POST['gender'],$_POST['insurance'], (int) $ssn,
                                    $_POST['email'],$_POST['dob'],(int) $phone];
                                if($sql->newPatient($conn, $values)){
                                    echo "<div class='h5 text-light'> Successfully Created Patient </div>";
                                }

                                $_POST['sub'] = NULL;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </div>
    </main>

<?php
include "include/footer.php";