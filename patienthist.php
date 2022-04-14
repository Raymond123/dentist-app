<?php
include "mysqlfunc.php";
$sql = new mysqlfunc();
$conn = $sql->mysqlCon();
?>
    <div class="container mt-3">
        <?php
        echo '<div class="h3 text-light">Welcome ' . $_GET['user'] . '! </div>';

        echo '<div class="h3 text-dark">Records </div>';
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '    <th scope="col">Patient ID</th>';
        echo '    <th scope="col">Treatment ID</th>';
        echo '    <th scope="col">Notes</th>';
        echo '    <th scope="col">SSN</th>';
        echo '</tr>';
        echo '</thead>';

        $recs = $sql->getRecords($conn);

        function newRec($pid, $tid, $note, $ssn){
            echo "<td>".$pid."</td>";
            echo "<td>".$tid."</td>";
            echo "<td>".$note."</td>";
            echo "<td>".$ssn."</td>";
        }

        while($rec = $recs->fetch_assoc()){
            newRec($rec['patient_id'], $rec['treatment_id'], $rec['notes'], $rec['SSN']);
        }

        function newRow($id, $house, $street, $city, $prov, $fname, $lname, $gender, $insurance, $ssn, $email, $dob, $phone){
            echo '<tr>';
            echo '    <td>'.$id.'</td>';
            echo '    <td>'.$house.'</td>';
            echo '    <td>'.$street.'</td>';
            echo '    <td>'.$city.'</td>';
            echo '    <td>'.$prov.'</td>';
            echo '    <td>'.$fname.'</td>';
            echo '    <td>'.$lname.'</td>';
            echo '    <td>'.$gender.'</td>';
            echo '    <td>'.$insurance.'</td>';
            echo '    <td>'.$ssn.'</td>';
            echo '    <td>'.$email.'</td>';
            echo '    <td>'.$dob.'</td>';
            echo '    <td>'.$phone.'</td>';
            echo '</tr>';
        }

        echo "</table>";

        echo "<br>";
        echo "<br>";

        echo "<table>";
        echo '<div class="h3 text-dark">Appointments </div>';
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '    <th scope="col">Appointment ID</th>';
        echo '    <th scope="col">Patient ID</th>';
        echo '    <th scope="col">Dentist</th>';
        echo '    <th scope="col">Year</th>';
        echo '    <th scope="col">Month</th>';
        echo '    <th scope="col">Day</th>';
        echo '    <th scope="col">Start Hour</th>';
        echo '    <th scope="col">Start Minute</th>';
        echo '    <th scope="col">End Hour</th>';
        echo '    <th scope="col">End Minute</th>';
        echo '    <th scope="col">Type</th>';
        echo '    <th scope="col">Status</th>';
        echo '    <th scope="col">Assigned Room</th>';
        echo '</tr>';
        echo '</thead>';

        $appointments = $sql->getAppointment($conn);

        $pid = $sql->getPid($conn, $_GET['user']);
        $pid_fetch = $pid->fetch_assoc();

        while($apt = $appointments->fetch_assoc()) {
            if ($apt['patient_id'] == $pid_fetch['patient_id']) {
                newRow($apt['appointment_id'], $apt['patient_id'], $apt['dentist'], $apt['appt_year'],
                    $apt['appt_month'], $apt['appt_day'], $apt['start_hour'], $apt['start_minute'],
                    $apt['end_hour'], $apt['end_minute'], $apt['appointmnet_type'], $apt['status'], $apt['room_assigned']);
            }
        }

        echo "</table>" ;
        ?>
    </div>

<?php
include "include/footer.php";