<?php

session_start();

if(isset($_SESSION["user"])){
    if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
        header("location: ../login.php");
        exit();
    }
}else{
    header("location: ../login.php");
    exit();
}

if($_POST && isset($_POST["editschedulesubmit"])){
    include("../connection.php");

    // Sanitize inputs
    $scheduleid = $database->real_escape_string($_POST["scheduleid"]);
    $title = $database->real_escape_string($_POST["title"]);
    $docid = $database->real_escape_string($_POST["docid"]);
    $nop = $database->real_escape_string($_POST["nop"]);
    $date = $database->real_escape_string($_POST["date"]);
    $time = $database->real_escape_string($_POST["time"]);

    // Basic validation (can be more comprehensive)
    if(empty($title) || empty($docid) || !is_numeric($nop) || $nop < 0 || empty($date) || empty($time) || empty($scheduleid)){
        header("location: schedule.php?action=edit&id=".$scheduleid."&error=1"); 
        exit();
    }

    // Check for schedule conflicts with OTHER sessions
    $sql_check_conflict = "SELECT * FROM schedule 
                           WHERE docid='$docid' AND scheduledate='$date' AND scheduletime='$time' AND scheduleid != '$scheduleid'";
    $result_check_conflict = $database->query($sql_check_conflict);

    if($result_check_conflict && $result_check_conflict->num_rows > 0){
        // Conflict detected
        $conflict_doctor_name_query = $database->query("SELECT docname FROM doctor WHERE docid='$docid'");
        $conflict_doctor_name = "The selected doctor"; // Default
        if ($conflict_doctor_name_query && $conflict_doctor_name_query->num_rows > 0) {
            $doc_row = $conflict_doctor_name_query->fetch_assoc();
            $conflict_doctor_name = $doc_row['docname'];
        }
        header("location: schedule.php?action=schedule-conflict-edit&id=".$scheduleid."&doctor=".urlencode($conflict_doctor_name)."&date=".$date."&time=".$time);
        exit();
    }

    // No conflict or updating non-conflicting fields, proceed with update
    $sql = "UPDATE schedule SET 
                title='$title', 
                docid='$docid', 
                nop='$nop', 
                scheduledate='$date', 
                scheduletime='$time' 
            WHERE scheduleid='$scheduleid'";
    
    if($database->query($sql) === TRUE){
        header("location: schedule.php?action=session-updated&title=".urlencode($title));
        exit();
    } else {
        // Handle database error
        // For debugging: error_log("Error updating schedule: " . $database->error);
        header("location: schedule.php?action=edit&id=".$scheduleid."&error=dberror"); 
        exit();
    }

    $database->close();
} else {
    // If not a POST request or submit button not set, redirect
    header("location: schedule.php");
    exit();
}

?>