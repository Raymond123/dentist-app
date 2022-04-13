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
                            <h4 class="mb-3">New User</h4>
                            <form class="needs-validation" novalidate="" method="post">
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="firstName" class="form-label">First name</label>
                                        <input name="fname" type="text" class="form-control" id="firstName" placeholder="John" value="" required="">
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <label for="lastName" class="form-label">Last name</label>
                                        <input name="lname" type="text" class="form-control" id="lastName" placeholder="Doe" value="" required="">
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="country" class="form-label">Role</label>
                                        <select name="role" class="form-select" id="country" required="">
                                            <option value="">Choose...</option>
                                            <option>admin</option>
                                            <option>dentist</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="form-label">Password<span class="text-muted">(Optional)</span></label>
                                        <input name="pass" type="password" class="form-control" id="email" placeholder="Password">
                                        <div class="invalid-feedback">
                                            Please enter a valid password.
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <button name="sub" class="w-100 btn btn-warning btn-lg" type="submit">Add User</button>
                            </form>

                            <?php
                            if(isset($_POST['sub'])){
                                $sql = new mysqlfunc();
                                $conn = $sql->mysqlCon();

                                $pass = hash("sha256", $_POST['pass']);
                                $values = [strtolower($_POST['fname']), strtolower($_POST['lname']), $pass];
                                if($sql->newUser($conn, $values)){
                                    echo "<div class='h5 text-light'> Successfully Created New User </div>";
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