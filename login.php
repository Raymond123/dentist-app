<?php
include "mysqlfunc.php";
?>

    <div class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your first name and password!</p>

                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                                    <div class="form-outline form-white mb-4">
                                        <input name="user" type="text" id="typeEmailX" class="form-control form-control-lg"/>
                                        <label class="form-label" for="typeEmailX">Email</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input name="pass" type="password" id="typePasswordX" class="form-control form-control-lg"/>
                                        <label class="form-label" for="typePasswordX">Password</label>
                                    </div>

                                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>
                                    <input name="loginBut" class="button btn btn-outline-light btn-lg px-5" type="submit" value="Login">

                                    <?php

                                    if (isset($_POST['loginBut'])) {
                                        if($_SERVER['REQUEST_METHOD'] == 'POST') {
                                            $sql = new mysqlfunc();
                                            $conn = $sql->mysqlCon();

                                            if (!($sql->isUser($conn, $_POST['user']))) {
                                                err();
                                            } else passCheck($sql, $conn);
                                        }
                                    }

                                    function passCheck($sql, $conn){
                                        // test for 'pass' ;
                                        $hp = hash('sha256', $_POST['pass']);
                                        $pass_chk = $sql->isUserPass($conn, $_POST['user']);
                                        if ($pass_chk['password'] == $hp ) {
                                            $uType = $sql->admin($conn, $hp);
                                            if($uType == '')
                                                header("Location:index.php?user=" . $_POST['user'] . "&admin=patient");
                                            else
                                                header("Location:index.php?user=" . $_POST['user'] . "&admin=".$uType);

                                        } else {
                                            err();
                                        }
                                    }

                                    function err(){
                                        // echo/print incorrect user/pass
                                        echo '<br><div class="h5 text-danger">Incorrect username/password</div>';
                                    }

                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include "include/footer.php";