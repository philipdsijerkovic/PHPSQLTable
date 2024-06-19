<!DOCTYPE html>
<html>
<head>
    <title>CSC 471</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <!-- This project was done with XAMPP, I have not tested it out with other DBMS -->
<h1>Project Part 5</h1>
<!-- This project uses the relationship between Employee and salariedEmp tables -->
    <div>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary">
              <input type="radio" name="options" id="option1" autocomplete="off"> Search
            </label>
            <form id="search-input" style="display: none;" method="post" action="search.php">
                <input type="text" id="search-field" name="search" placeholder="Enter first name">
                <button type="submit" id="submit-button">Submit</button>
            </form>
            <label class="btn btn-secondary">
              <input type="radio" name="options" id="option2" autocomplete="off"> Insert
            </label>
            <form id="insert-form" style="display: none;" method="post" action="insert.php">
                <input type="text" id="ssn" name="ssn" placeholder="SSN" maxlength="9" pattern="\d{9}">
                <input type="text" id="dob" name="dob" placeholder="DOB">
                <input type="text" id="fname" name="fname" placeholder="First Name">
                <input type="text" id="minit" name="minit" placeholder="Minitial">
                <input type="text" id="name" name="name" placeholder="Last Name">
                <input type="text" id="address" name="address" placeholder="Address">
                <input type="text" id="monthly_salary" name="monthly_salary" placeholder="Monthly Salary">
                <button type="submit" id="insert-button" class="btn btn-secondary">Submit</button>
            </form>
            <label class="btn btn-secondary">
              <input type="radio" name="options" id="option3" autocomplete="off"> Delete
            </label>
            <form id="delete-form" style="display: none;" method="post" action="delete.php">
                <input type="text" id="delete-ssn" name="ssn" placeholder="SSN to delete" maxlength="9" pattern="\d{9}">
                <button type="submit" id="delete-button" class="btn btn-secondary">Delete</button>
            </form>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="option4" autocomplete="off"> Update
            </label>
            <form id="update-form" style="display: none;" method="post" action="update.php">
            <input type="text" id="update-ssn" name="ssn" placeholder="SSN to update" maxlength="9" pattern="\d{9}">
                <input type="text" id="update-dob" name="dob" placeholder="New DOB">
                <input type="text" id="update-fname" name="fname" placeholder="New First Name">
                <input type="text" id="update-minit" name="minit" placeholder="New Minitial">
                <input type="text" id="update-name" name="name" placeholder="New Last Name">
                <input type="text" id="update-address" name="address" placeholder="New Address">
                <input type="text" id="update-monthly_salary" name="monthly_salary" placeholder="New Monthly Salary">
                <button type="submit" id="update-button" class="btn btn-secondary">Update</button>
            </form>
        </div>
    </div>
    <!-- To close the inputs please click the menu button and they will collapse -->
    <!-- Active Buttons & scripts-->
    <script>
        $(document).ready(function(){
            $(".btn").click(function(){
                $(".btn").removeClass("active");
                $(this).addClass("active");
            });
            $("#option1").click(function(){
                $("#search-input").toggle();
            });
            $("#option2").click(function(){
                $("#insert-form").toggle();
            });
            $("#option3").click(function(){
                $("#delete-form").toggle();
            });
            $("#option4").click(function(){
                $("#update-form").toggle();
            });
            $("#insert-form").submit(function(e){
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        alert(data); // show response from the PHP script.
                        location.reload();
                    }
                });
            });
            $("#update-form").submit(function(e){
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        alert(data); // show response from the PHP script.
                        location.reload();
                    }
                });
            });
            $("#search-input").submit(function(e){
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        // Clear the table
                        $("tr.table-row").remove();

                        // Parse the JSON data
                        var rows = JSON.parse(data);

                        // Add each row to the table
                        $.each(rows, function(i, row){
                            var tr = $("<tr class='table-row'>");
                            tr.append("<td>" + row["ssn"] + "</td>");
                            tr.append("<td>" + row["dob"] + "</td>");
                            tr.append("<td>" + row["Fname"] + "</td>");
                            tr.append("<td>" + row["Minit"] + "</td>");
                            tr.append("<td>" + row["Name"] + "</td>");
                            tr.append("<td>" + row["address"] + "</td>");
                            tr.append("<td>" + row["monthly_salary"] + "</td>");
                            $("table").append(tr);
                        });
                    }
                });
            });
        });
        $("#delete-form").submit(function(e){
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var ssnToDelete = $("#delete-ssn").val(); // Get the SSN of the record to delete

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            alert(data); // show response from the PHP script.

            // Remove the row from the table
            $("tr.table-row").each(function() {
                var ssn = $(this).find("td:first").text(); // Get the SSN from the first column of the row
                if (ssn === ssnToDelete) {
                    $(this).remove(); // Remove the row
                }
            });
        }
    });
});
    </script>
    <table>
        <tr>
            <th>SSN</th>
            <th>DOB</th>
            <th>First Name</th>
            <th>Minitial</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Monthly salary</th>
        </tr>
        <?php
        // Database credentials
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

        // Query to get data from the table
        $sql = "SELECT * FROM Employee JOIN salariedEmp ON Employee.ssn = salariedEmp.ssn";
        $result = $conn->query($sql);
        
        if ($result === false) {
            // The SQL query failed. Output the error message.
            echo "Error: " . $conn->error;
        } else {
            // The SQL query succeeded. Output the data.
            while($row = $result->fetch_assoc()) {
                echo "<tr class='table-row'>"; 
                echo "<td>" . $row["ssn"] . "</td>";
                echo "<td>" . $row["dob"] . "</td>";
                echo "<td>" . $row["Fname"] . "</td>";
                echo "<td>" . $row["Minit"] . "</td>";
                echo "<td>" . $row["Name"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["monthly_salary"] . "</td>";
                echo "</tr>";
            }
        }
        
        $conn->close();
        ?>
    </table>      
</body>
</html>
<!-- ssn checking is done by the application, putting it in the database would be more taxing on runtime. -->


