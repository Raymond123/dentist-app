<?php
include "include/header.php";


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

    function getBranches($conn){
        $sql = "SELECT `branch_numb` FROM `branch`";
        return $conn->query($sql);
    }

    function getEmployee($conn){
        $qry = "SELECT * FROM `employee`";
        return $conn->query($qry);
    }

    function getPatients($conn){
        $qry = "SELECT * FROM `patient`";
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

    function newUser($conn, $values){
        $qry = "INSERT INTO `user`(`user_id`, `user_role`, `first_name`, `last_name`, `password`) VALUES (UUID_SHORT(),'".$values[0]."','".$values[1]."','".$values[2]."','".$values[3]."');";
        return $conn->query($qry);
    }


}