<?php
session_start(); // MUST BE AT THE VERY TOP

// Check if user is logged in and is a patient
if(!isset($_SESSION["user"]) || empty($_SESSION["user"]) || $_SESSION['usertype']!='p'){
    // If not, do NOT destroy the session if it exists, just redirect to login
    header("location: ../login.php");
    exit();
}

include("../connection.php");
$useremail = $_SESSION["user"]; // User is a valid patient

if(isset($_GET["id"])){
    $appoid_to_delete = $_GET["id"];

    // Get the logged-in patient's ID
    $stmt_pid = $database->prepare("SELECT pid FROM patient WHERE pemail = ?");
    $stmt_pid->bind_param("s", $useremail);
    $stmt_pid->execute();
    $pid_result = $stmt_pid->get_result();
    if($pid_result->num_rows > 0){
        $patient_data = $pid_result->fetch_assoc();
        $current_pid = $patient_data['pid'];
    } else {
        // Should not happen if session is valid, but good to check
        header("location: appointment.php?action=cancel-failed&error_msg=" . urlencode("User not found."));
        exit();
    }
    $stmt_pid->close();

    // Verify that the appointment to be deleted belongs to the logged-in patient
    $stmt_check = $database->prepare("SELECT pid FROM appointment WHERE appoid = ?");
    $stmt_check->bind_param("i", $appoid_to_delete);
    $stmt_check->execute();
    $check_result = $stmt_check->get_result();

    if($check_result->num_rows > 0){
        $appointment_owner = $check_result->fetch_assoc();
        if($appointment_owner['pid'] == $current_pid){
            // Authorized to delete
            $stmt_delete = $database->prepare("DELETE FROM appointment WHERE appoid = ?");
            $stmt_delete->bind_param("i", $appoid_to_delete);
            if($stmt_delete->execute()){
                // Successfully deleted
                header("location: appointment.php?action=booking-cancelled");
                exit();
            }else{
                // Deletion failed
                header("location: appointment.php?action=cancel-failed&error_msg=" . urlencode("Database error during deletion."));
                exit();
            }
            $stmt_delete->close();
        } else {
            // Unauthorized attempt
            header("location: appointment.php?action=cancel-failed&error_msg=" . urlencode("Unauthorized to cancel this booking."));
            exit();
        }
    } else {
        // Appointment not found
        header("location: appointment.php?action=cancel-failed&error_msg=" . urlencode("Booking not found."));
        exit();
    }
    $stmt_check->close();

} else {
    // No ID provided
    header("location: appointment.php?action=cancel-failed&error_msg=" . urlencode("Invalid request."));
    exit();
}
?>