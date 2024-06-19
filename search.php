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

// Get the search term from the AJAX request
$searchTerm = $_POST['search'];

// The main SQL query

$sql = "SELECT Employee.ssn, Employee.dob, Employee.Fname, Employee.Minit, Employee.Name, Employee.address, salariedEmp.monthly_salary FROM Employee JOIN salariedEmp ON Employee.ssn = salariedEmp.ssn WHERE Fname LIKE ?";

// Create a prepared statement
$stmt = $conn->prepare($sql); 

// Bind parameters
$likeTerm = "%" . $searchTerm . "%";
$stmt->bind_param("s", $likeTerm);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Create an array to hold the result
$rows = array();

// Fetch the result into the array
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Output the result in JSON format
echo json_encode($rows);

$conn->close();
?>