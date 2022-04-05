<?php
include "mysqlfunc.php";
?>
<div class="container mt-3">
<?php
echo '<div class="h3 text-light">Welcome ' . $_GET['user'] . '! </div>';
?>
<a href="newuser.php" class="h5 text-light icon-link"> > Add new user </a>
<?php
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
echo '    <th scope="col">User-Type</th>';
echo '    <th scope="col">SSN</th>';
echo '    <th scope="col">Salary</th>';

echo '</tr>';
echo '</thead>';

function newEmRow($id, $branch, $house, $street, $city, $prov, $fname, $lname, $gender, $role, $user, $ssn, $salary){
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
    echo '    <td>'.$user.'</td>';
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
        $employee['last_name'],$employee['gender'],$employee['role'], $employee['user_type'],
        $employee['SSN'], $employee['Salary']);
} // change 3
echo '</table>';


echo "<a href='' class='text-link text-dark h6'>add new employee</a>";
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
function newPatRow($id, $house, $street, $city, $prov, $fname, $lname, $gender, $insurance, $ssn, $email, $dob, $phone){
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
    newPatRow($patient['patient_id'], $patient['house_number'],$patient['street'],$patient['city'], $patient['province'],
        $patient['first_name'],$patient['last_name'], $patient['gender'],$patient['insurance'],
        $patient['SSN'], $patient['email_address'], $patient['date_of_birth'],$patient['phone_number']);
} // change 3
echo '</table>';

echo "<a href='' class='text-link text-dark h6'> add new patient </a>";
echo '<br>';
echo '<br>';

echo '<div class="h3 text-dark">Appointments </div>';
echo '<table class="table">';
echo '<thead>';
echo '<tr>';
echo '    <th scope="col">appointment</th>';
echo '    <th scope="col">Company</th>';
echo '    <th scope="col">Company</th>';
echo '</tr>';
echo '</thead>';
function newAptRow($i1, $i2, $i3, $i4){
    echo '<tr>';
    echo '    <td>'.$i1.'</td>';
    echo '    <td>'.$i2.'</td>';
    echo '    <td>'.$i3.'</td>';
    echo '    <td>'.$i3.'</td>';
    echo '</tr>';
}

for($i=0;$i<3;$i++){
    newAptRow("he", "ll","oo", "um");
} // change 3
echo '</table>';
?>
</div>

<?php
include "include/footer.php";