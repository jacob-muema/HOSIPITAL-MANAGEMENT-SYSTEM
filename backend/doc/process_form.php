<?php
session_start();
include('assets/inc/config.php');

if(isset($_POST['add_patient'])) {
    // Sanitize and retrieve form data
    $pat_fname = $_POST['pat_fname'];
    $pat_lname = $_POST['pat_lname'];
    $pat_number = $_POST['pat_number'];
    $pat_phone = $_POST['pat_phone'];
    $pat_type = $_POST['pat_type'];
    $pat_addr = $_POST['pat_addr'];
    $pat_age = $_POST['pat_age'];
    $pat_dob = $_POST['pat_dob'];
    $pat_ailment = $_POST['pat_ailment'];

    // Prepare SQL query using prepared statements
    $query = "INSERT INTO his_patients (pat_fname, pat_lname, pat_number, pat_phone, pat_type, pat_addr, pat_age, pat_dob, pat_ailment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    if ($stmt === false) {
        die('MySQL prepare error: ' . $mysqli->error);
    }

    $stmt->bind_param('sssssssss', $pat_fname, $pat_lname, $pat_number, $pat_phone, $pat_type, $pat_addr, $pat_age, $pat_dob, $pat_ailment);

    // Execute the statement
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $success = "Patient Details Added";
    } else {
        $err = "Failed to add patient. Please try again.";
    }

    $stmt->close();
}

// Close database connection
$mysqli->close();
?>
