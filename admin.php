<?php
include "mysqlfunc.php";
?>
<div class="container mt-3">
<?php
echo '<div class="h3 text-light">Welcome ' . $_GET['user'] . '! </div>';
echo '<a href="newuser.php?user='.$_GET['user'].'&admin='.$_GET['admin'].'" class="h5 text-light icon-link"> > Add new user </a>';
echo '</br></br>';
// table headers
echo '<div class="h3 text-dark">Employees </div>';
echo '<table class="table">';
echo '<thead>';
echo '<tr>';
echo '    <th scope="col">Employee-ID</th>';
echo '    <th scope="col">Branch</th>';
echo '    <th scope="col">House #</th>';
echo '    <th scope="col">Street</th>';
echo '    <th scope="col">City</th>';
echo '    <th scope="col">Province</th>';
echo '    <th scope="col">First Name</th>';
echo '    <th scope="col">Last Name</th>';
echo '    <th scope="col">Gender</th>';
echo '    <th scope="col">Role</th>';
echo '    <th scope="col">SSN</th>';
echo '    <th scope="col">Salary</th>';

echo '</tr>';
echo '</thead>';

function newEmRow($id, $branch, $house, $street, $city, $prov, $fname, $lname, $gender, $role, $ssn, $salary){
    echo '<tr>';
    echo '    <td>'.$id.'</td>';
    echo '    <td>'.$branch.'</td>';
    echo '    <td>'.$house.'</td>';
    echo '    <td>'.$street.'</td>';
    echo '    <td>'.$city.'</td>';
    echo '    <td>'.$prov.'</td>';
    echo '    <td>'.$fname.'</td>';
    echo '    <td>'.$lname.'</td>';
    echo '    <td>'.$gender.'</td>';
    echo '    <td>'.$role.'</td>';
    echo '    <td>'.$ssn.'</td>';
    echo '    <td>'.$salary.'</td>';
    echo '</tr>';
}

$sql = new mysqlfunc();
$conn = $sql->mysqlCon();
$employees = $sql->getEmployee($conn);

while($employee = $employees->fetch_assoc()){
    newEmRow($employee['employee_id'], $employee['branch_numb'],$employee['house_number'],
        $employee['street'], $employee['city'],$employee['province'], $employee['first_name'],
        $employee['last_name'],$employee['gender'],$employee['role'], $employee['SSN'], $employee['Salary']);
} // change 3
echo '</table>';


echo "<a href='new_employee.php?user=".$_GET['user']."&admin=".$_GET['admin']."' class='text-link text-dark h6'>add new employee</a>";
echo '<br>';
echo '<br>';

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

$patients = $sql->getPatients($conn);
while($patient = $patients->fetch_assoc()){
    newRow($patient['patient_id'], $patient['house_number'],$patient['street'],$patient['city'], $patient['province'],
        $patient['first_name'],$patient['last_name'], $patient['gender'],$patient['insurance'],
        $patient['SSN'], $patient['email_address'], $patient['date_of_birth'],$patient['phone_number']);
} // change 3
echo '</table>';

echo "<a href='new_patient.php?user=".$_GET['user']."&admin=".$_GET['admin']."' class='text-link text-dark h6'> add new patient </a>";
echo '<br>';
echo '<br>';

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
echo '</table>';

echo "<a href='appointment.php?user=".$_GET['user']."&admin=".$_GET['admin']."' class='text-link text-dark h6'> new appointment </a><br><br>";
?>
    <form method="post">
        <select class="" name="aid" id="aid">
            <option value=""> appointment_id </option>
            <?php
            $aids = $sql->getAppointment($conn);
            while($aid = $aids->fetch_assoc()){
                if($aid['status'] != 'finished' && $aid['status'] != 'canceled') echo "<option>". $aid['appointment_id'] ."</option>";
            }
            ?>
        </select>
        <button class="btn-dark" type="submit" name="fin" value="Finish Appointment"> finish </button>
        <button class="btn-dark" type="submit" name="can" value="Cancel Appointment"> cancel </button>
        <br>
        <select name="dentist" id="dent">
            <option value="">Dentist</option>
            <?php
            $dentists = $sql->getEmployee($conn);
            while($dentist = $dentists->fetch_assoc()){
                if($dentist['role'] == 'dentist'){
                    echo "<option>".$dentist['first_name']." ". $dentist['last_name'] ."</option>";
                }
            }
            ?>
        </select>

        <select name="room" id="rm">
            <option value=""> Room # </option>
            <?php
            for($i=1; $i<7; $i++){
                echo "<option>".$i."</option>";
            }
            ?>
        </select>
        <button class="btn-dark" type="submit" name="sub" value="Add dentist room"> add dentist and room </button>
    </form>
    <?php
    echo "<div class='h5 text-light'> ".$_GET['outcome']." </div>";

    date_default_timezone_set("America/Toronto");
    $time = date("h:i:sa");
    if(isset($_POST['fin'])) {
        if ($sql->updateAppt($conn, $_POST['aid'], explode(":",$time))) {
            header("Location:admin.php?user=".$_GET['user']."&admin=".$_GET['admin']."&outcome=success");
        }
    }

    if(isset($_POST['can'])) {
        if ($sql->cancelAppt($conn, $_POST['aid'])) {
            header("Location:admin.php?user=".$_GET['user']."&admin=".$_GET['admin']."&outcome=canceled");
        }
    }

    if(isset($_POST['sub'])) {
        if ($sql->addDentRm($conn, [$_POST['dentist'], $_POST['room']], $_POST['aid'])) {
            header("Location:admin.php?user=".$_GET['user']."&admin=".$_GET['admin']."&outcome=success");
        }
    }
    ?>
</div>

<?php
include "include/footer.php";