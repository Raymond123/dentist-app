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
        $sql = "SELECT * FROM `branch`";
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
        $qry = "SELECT `role` FROM `employee` WHERE `password` = '". $pass ."'";
        $roles = $conn->query($qry);
        $role = $roles->fetch_assoc();
        return $role['role'];
    }

    function newUser($conn, $values){
        $qry = "INSERT INTO `user`(`user_id`, `first_name`, `last_name`, `password`) 
            VALUES (UUID_SHORT(),'".$values[0]."','".$values[1]."','".$values[2]."');";
        return $conn->query($qry);
    }

    function newPatient($conn, $values, $bool){
        $qry = "INSERT INTO `patient`(`patient_id`, `house_number`, `street`, `city`, `province`, `first_name`, `last_name`, `gender`, `insurance`, `SSN`, `email_address`, `date_of_birth`, `phone_number`, `password`)
            VALUES 
            (UUID_SHORT(),".$values[0].",'".$values[1]."','".$values[2]."','".$values[3]."','".$values[4]."',
             '".$values[5]."','".$values[6]."','".$values[7]."',".$values[8].",'".$values[9]."',
             '".$values[10]."',".$values[11].",'".$values[12]."')";


        if($bool == 'Yes'){
            $user = "INSERT INTO `user`(`user_id`, `first_name`, `last_name`, `password`) 
            VALUES (UUID_SHORT(),'".$values[4]."','".$values[5]."','".$values[12]."')";

            return $conn->query($qry) && $conn->query($user);
        }
        return $conn->query($qry);
    }

    function newEmployee($conn, $values){
        $qry = "INSERT INTO `employee`(`employee_id`, `branch_numb`, `house_number`, `street`, `city`, `province`, `gender`, `role`, `SSN`, `Salary`, `name`, `first_name`, `last_name`, `password`) 
            VALUES 
            (UUID_SHORT(),".$values[0].",".$values[1].",'".$values[2]."','".$values[3]."','".$values[4]."',
             '".$values[5]."','".$values[6]."',".$values[7].",".$values[8].",'".$values[9]."','".$values[9]."','".$values[10]."','".$values[11]."')";

        $user = "INSERT INTO `user`(`user_id`, `first_name`, `last_name`, `password`) 
            VALUES (UUID_SHORT(),'".$values[9]."','".$values[10]."','".$values[11]."')";

        return $conn->query($qry) && $conn->query($user);
    }

    function newAppt($conn, $values, $name){
        $pidFetch = $this->getPid($conn, $name);
        $pid = $pidFetch->fetch_assoc();

        $qry = "INSERT INTO `appointment`(`appointment_id`, `patient_id`, `appt_year`, `appt_month`, `appt_day`, `start_hour`, `start_minute`, `appointment_type`, `status`) 
            VALUES 
            (UUID_SHORT(),". $pid['patient_id'] .",
            ".$values[0].",".$values[1].",".$values[2].",
             ".$values[3].",".$values[4].",'".$values[5]."',
             'coming up')";
        return $conn->query($qry);
    }

    function updateAppt($conn, $aid, $values){
        $qry = "UPDATE `appointment` SET `end_hour`=".$values[0].",`end_minute`=".$values[1].",`status`='finished' WHERE appointment_id = ".$aid.";";
        return $conn->query($qry);
    }

    function addDentRm($conn, $values, $aid){
        $qry = "UPDATE `appointment` SET `dentist`='".$values[0]."',`room_assigned`=".$values[1].",`status`='ongoing' WHERE appointment_id = ".$aid.";";
        return $conn->query($qry);
    }

    function cancelAppt($conn, $aid){
        $qry = "UPDATE `appointment` SET `status`='canceled' WHERE appointment_id = ".$aid.";";
        return $conn->query($qry);
    }

    function getRecords($conn){
        $qry = "SELECT * FROM `record`";
        return $conn->query($qry);
    }

    function getPid($conn, $name){
        $sql = "SELECT `patient_id` FROM `patient` WHERE `first_name` = '". $name ."'";
        return $conn->query($sql);
    }

    function getSSN($conn, $pid){
        $sql = "SELECT `SSN` FROM `patient` WHERE `patient_id` = ". $pid ;
        return $conn->query($sql);
    }

    //[$meds, $symptom, $appointmentId, $type, $tooth, $comment, $notes, $ssn, $_GET['pid']]
    function newRecord($conn, $values){
        $qry = "INSERT INTO `treatment`(`treatment_id`, `appointment_id`, `treatment_type`, `medication`, `symptom`, `tooth`, `comment`) 
            VALUES (UUID_SHORT(), ".$values[2].",'".$values[3]."','".$values[0]."','".$values[1]."','".$values[4]."','".$values[5]."')";

        if($conn->query($qry)) {
            $tidqry = "SELECT `treatment_id` FROM `treatment` WHERE `appointment_id` = " . $values[2];
            $getid = $conn->query($tidqry);
            $tid = $getid->fetch_assoc();
            $qry2 = "INSERT INTO `record`(`patient_id`, `treatment_id`, `notes`, `SSN`) 
            VALUES (" . $values[8] . "," . $tid['treatment_id'] . ",'" . $values[6] . "'," . $values[7] . ")";

            return $conn->query($qry2);
        }
        return false;
    }


}