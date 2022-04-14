<?php
include "mysqlfunc.php";
?>
    <div class="container mt-3">
        <?php
        echo '<div class="h3 text-light">Welcome ' . $_GET['user'] . '! </div>';
        echo '</br></br>';
        // table headers
        echo '<div class="h3 text-dark">Patients </div>';
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '    <th scope="col">Patient-ID</th>';
        echo '    <th scope="col">House #</th>';
        echo '    <th scope="col">Street</th>';
        echo '    <th scope="col">City</th>';
        echo '    <th scope="col">Province</th>';
        echo '    <th scope="col">First Name</th>';
        echo '    <th scope="col">Last Name</th>';
        echo '    <th scope="col">Gender</th>';
        echo '    <th scope="col">Insurance</th>';
        echo '    <th scope="col">SSN</th>';
        echo '    <th scope="col">Email</th>';
        echo '    <th scope="col">Date of Birth</th>';
        echo '    <th scope="col">Phone #</th>';
        echo '</tr>';
        echo '</thead>';
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

        $sql = new mysqlfunc();
        $conn = $sql->mysqlCon();
        $employees = $sql->getPatients($conn);

        while($patient = $employees->fetch_assoc()){
            newRow($patient['patient_id'], $patient['house_number'],$patient['street'],$patient['city'], $patient['province'],
                $patient['first_name'],$patient['last_name'], $patient['gender'],$patient['insurance'],
                $patient['SSN'], $patient['email_address'], $patient['date_of_birth'],$patient['phone_number']);
        } // change 3
        echo '</table>';

        echo '<br>';
        echo '<br>';

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

        $appointments = $sql->getRecords($conn);

        function newRec($pid, $tid, $note, $ssn){
            echo "<td>".$pid."</td>";
            echo "<td>".$tid."</td>";
            echo "<td>".$note."</td>";
            echo "<td>".$ssn."</td>";
        }

        while($rec = $appointments->fetch_assoc()){
            newRec($rec['patient_id'], $rec['treatment_id'], $rec['notes'], $rec['SSN']);
        }

        echo "</table>";

        echo '<br>';
        echo '<br>';

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


        while($apt = $appointments->fetch_assoc()){
            newRow($apt['appointment_id'], $apt['patient_id'], $apt['dentist'], $apt['appt_year'],
                $apt['appt_month'], $apt['appt_day'], $apt['start_hour'], $apt['start_minute'],
                $apt['end_hour'], $apt['end_minute'], $apt['appointmnet_type'], $apt['status'], $apt['room_assigned']);
        }

        echo "</table>" ;
        ?>
    </div>

<?php
include "include/footer.php";