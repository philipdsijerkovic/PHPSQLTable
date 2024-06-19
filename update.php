<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csc471";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Variables to hold the data from the form
$ssn = $_POST['ssn'];
$dob = $_POST['dob'];
$fname = $_POST['fname'];
$minit = $_POST['minit'];
$name = $_POST['name'];
$address = $_POST['address'];
$monthly_salary = $_POST['monthly_salary'];
// The SQL query to update the record
$sql = "UPDATE Employee JOIN salariedEmp ON Employee.ssn = salariedEmp.ssn SET dob='$dob', Fname='$fname', Minit='$minit', Name='$name', address='$address', monthly_salary='$monthly_salary' WHERE Employee.ssn='$ssn'";

if ($conn->query($sql) === TRUE) {
    echo "Record added";
} else {
    echo "Error updating this record: " . $conn->error;
}

$conn->close();
?>