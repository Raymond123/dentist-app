<?php
include "mysqlfunc.php";

$sql = new mysqlfunc();
$conn = $sql->mysqlCon();
?>

    <main>
        <div class="container-fluid">
            <div class="col">
                <div class="row">
                    <div class="col"></div>
                    <div class="col container mt-5 text-light p-4 rounded">
                        <div class="col">
                            <h4 class="mb-3">New Employee</h4>
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
                                        <input name="city" class="form-control" id="city" required="">
                                        <div class="invalid-feedback">
                                            Please provide a valid city.
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label for="prov" class="form-label">Province</label>
                                        <select name="prov" class="form-control" id="prov" required="">
                                            <option value="">Province</option>
                                            <option>ON</option>
                                            <option>QC</option>
                                            <option>NL</option>
                                            <option>BC</option>
                                            <option>AB</option>
                                            <option>MB</option>
                                        </select>
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
                                        <label for="branch" class="form-label">Branch</label>
                                        <select name="branch" class="form-control" id="branch">
                                            <option value="">branches</option>
                                            <?php
                                            $branches = $sql->getBranches($conn);
                                            while($branch = $branches->fetch_assoc()){
                                                echo "<option> ". $branch['city'] ." </option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please enter a valid province.
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label for="ssn" class="form-label">SSN</label>
                                        <input name="ssn" type="text" class="form-control" id="ssn" placeholder="XXX XX XXXX" required="">
                                        <div class="invalid-feedback">
                                            Please enter a valid SSN.
                                        </div>
                                    </div>

                                    <div class="col-8">
                                        <label for="salary" class="form-label">Salary</label>
                                        <input name="salary" type="text" class="form-control" id="salary" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Please enter a valid month.
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="type" class="form-label">User Type</label>
                                        <select name="type" class="form-control" id="type" required="">
                                            <option value="">..</option>
                                            <option>admin</option>
                                            <option>dentist</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please enter a valid month.
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="phone" class="form-label">Phone #</label>
                                        <input name="phone" type="text" class="form-control" id="phone" placeholder="123 456 7890" required="">
                                        <div class="invalid-feedback">
                                            Please enter a valid month.
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <button name="sub" class="w-100 btn btn-warning btn-lg" type="submit">Add Employee</button>
                                </div>
                            </form>

                            <?php
                            if(isset($_POST['sub'])){
                                $pass = $sql->isUserPass($conn, $_POST['fname']);

                                $house_num = preg_replace("/[^0-9]/", '', $_POST['addr']);
                                $street = preg_replace("/[^a-z\s]/",'', strtolower($_POST['addr']));

                                $ssn = preg_replace("/[^0-9]/", '', $_POST['ssn']);
                                $phone = preg_replace("/[^0-9]/", '', $_POST['phone']);

                                $branchNum = $sql->branchInfo($conn, $_POST['branch']);

                                // `branch_numb`, `house_number`, `street`, `city`, `province`, `gender`, `role`, `SSN`, `Salary`, `name`, `first_name`, `last_name`, `password`
                                $values = [$branchNum['branch_numb'], $house_num, $street, strtolower($_POST['city']),
                                    $_POST['prov'],$_POST['gender'],$_POST['type'],$ssn, $_POST['salary'],
                                    strtolower($_POST['fname']), strtolower($_POST['lname']), $pass['password']];
                                if($sql->newEmployee($conn, $values)){
                                    echo "<div class='h5 text-light'> Successfully Created Employee </div>";
                                }
                                foreach($values as $v){
                                    echo $v . "<br>";
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