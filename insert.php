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

$ssn = $_POST['ssn'];
$dob = $_POST['dob'];
$fname = $_POST['fname'];
$minit = $_POST['minit'];
$name = $_POST['name'];
$address = $_POST['address'];
$monthly_salary = $_POST['monthly_salary'];
// The main  SQL queries to insert into the tables
$sql = "INSERT INTO Employee (ssn, dob, Fname, Minit, Name, address) VALUES ('$ssn', '$dob', '$fname', '$minit', '$name', '$address')";
$sql .= ";INSERT INTO salariedEmp (ssn, monthly_salary) VALUES ('$ssn', '$monthly_salary')"; // appended to the first query

if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>