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

// Get the SSN from the form
$ssn = $_POST['ssn'];

// Prepare the SQL statement to delete from salariedemp table
$sql1 = "DELETE FROM salariedEmp WHERE ssn = ?";

// Create a prepared statement
$stmt1 = $conn->prepare($sql1);

// Bind parameters
$stmt1->bind_param("s", $ssn);

// Execute the statement
if ($stmt1->execute()) {
    // Prepare the SQL statement to delete from Employee table
    $sql2 = "DELETE FROM Employee WHERE ssn = ?";

    // Create a prepared statement
    $stmt2 = $conn->prepare($sql2);

    // Bind parameters
    $stmt2->bind_param("s", $ssn);

    // Execute the statement
    if ($stmt2->execute()) {
        echo "Record deleted";
    } else {
        echo "Error deleting: " . $conn->error;
    }
} else {
    echo "Error deleting: " . $conn->error;
}

$conn->close();
?>