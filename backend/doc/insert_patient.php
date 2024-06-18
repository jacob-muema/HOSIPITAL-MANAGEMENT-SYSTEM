<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to MySQL database (Replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hmisphp";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare data for insertion
    $pat_fname = $_POST['pat_fname'];
    $pat_lname = $_POST['pat_lname'];
    $pat_dob = $_POST['pat_dob'];
    $pat_age = $_POST['pat_age'];
    $pat_number = $_POST['pat_number'];
    $pat_addr = $_POST['pat_addr'];
    $pat_phone = $_POST['pat_phone'];
    $pat_type = $_POST['pat_type'];
    $pat_ailment = $_POST['pat_ailment'];

    // SQL query to insert data into database
    $sql = "INSERT INTO his_patients (pat_fname, pat_lname, pat_dob, pat_age, pat_number, pat_addr, pat_phone, pat_type, pat_ailment)
            VALUES ('$pat_fname', '$pat_lname', '$pat_dob', '$pat_age', '$pat_number', '$pat_addr', '$pat_phone', '$pat_type', '$pat_ailment')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
