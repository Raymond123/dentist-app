<?php
if(isset($_GET['user'])){
    include "include/headerin.php";
}else include "include/header.php";


session_start();
class mysqlfunc
{
    function mysqlCon()
    {
        $servername = "localhost";
        $username = "root";
        $password = "xMau8#e@nox?b6F?BF9dK&$?eWCa-ch8AYm";
        $dbname = "dentist_schema";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    function close($conn){
        $conn->close();
    }

    function getProcedures($conn){
        $qry = "SELECT * FROM `procedures`";
        return $conn->query($qry);
    }

    function getBranches($conn){
        $sql = "SELECT `city` FROM `branch`";
        return $conn->query($sql);
    }

    function branchInfo($conn, $branch){
        $sql = "SELECT * FROM `branch` WHERE `city` = '". $branch ."'";
        $res = $conn->query($sql);
        return $res->fetch_assoc();
    }

    function getEmployee($conn){
        $qry = "SELECT * FROM `employee`";
        return $conn->query($qry);
    }

    function getPatients($conn){
        $qry = "SELECT * FROM `patient`";
        return $conn->query($qry);
    }

    function getAppointment($conn){
        $qry = "SELECT * FROM `appointment`";
        return $conn->query($qry);
    }

    function isUser($conn, $user){
        $exist_qry = "SELECT * FROM `user` WHERE `first_name` = '" . $user . "'";
        $exist = $conn->query($exist_qry);
        $ret=false;
        if ($exist->num_rows > 0) $ret=true;
        return $ret;
    }

    function isUserPass($conn, $user){
        $pass_qry = "SELECT `password` FROM `user` WHERE `first_name` = '" . $user . "'";
        $pass = $conn->query($pass_qry);
        return $pass->fetch_assoc();
    }

    function admin($conn, $pass){
        $idqry = "SELECT `user_id` FROM `user` WHERE `password`='".$pass."'";
        $id = $conn->query($idqry);
        $uid = $id->fetch_assoc();
        $qry = "SELECT `role` FROM `employee` WHERE `user_id` = ".$uid['user_id'];
        $roles = $conn->query($qry);
        $role = $roles->fetch_assoc();
        return ($role['role'] == 'manager');
    }

    function newUser($conn, $values){
        $qry = "INSERT INTO `user`(`user_id`, `user_role`, `first_name`, `last_name`, `password`) 
            VALUES (UUID_SHORT(),'".$values[0]."','".$values[1]."','".$values[2]."','".$values[3]."');";
        return $conn->query($qry);
    }

    function newPatient($conn, $values){
        $qry = "INSERT INTO `patient`(`patient_id`, `house_number`, `street`, `city`, `province`, `first_name`, `last_name`, `gender`, `insurance`, `SSN`, `email_address`, `date_of_birth`, `phone_number`)
            VALUES 
            (3,".$values[0].",'".$values[1]."','".$values[2]."','".$values[3]."','".$values[4]."',
             '".$values[5]."','".$values[6]."','".$values[7]."','".$values[8]."',".$values[9].",
             '".$values[10]."',".$values[11].")";
        return $conn->query($qry);
    }

    function newEmployee($conn, $values){
        $qry = "INSERT INTO `employee`(`employee_id`, `branch_numb`, `house_number`, `street`, `city`, `province`, `first_name`, `last_name`, `gender`, `role`, `user_type`, `SSN`, `Salary`) 
            VALUES 
            (UUID_SHORT(),$values[0],$values[1],$values[2],$values[3],$values[4],
             $values[5],$values[6],$values[7],$values[8],$values[9],$values[10],$values[11])";
        return $conn->query($qry);
    }


}