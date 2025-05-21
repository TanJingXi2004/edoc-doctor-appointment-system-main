<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_POST){
        //import database
        include("../connection.php");
        $title=$_POST["title"];
        $docid=$_POST["docid"];
        $nop=$_POST["nop"];
        $date=$_POST["date"];
        $time=$_POST["time"];

        // Check for existing schedule for the same doctor at the same date and time
        $check_sql = "SELECT * FROM schedule WHERE docid=$docid AND scheduledate='$date' AND scheduletime='$time'";
        $check_result = $database->query($check_sql);

        if($check_result->num_rows > 0){
            // Conflict found
            $doctor_name_query = $database->query("SELECT docname FROM doctor WHERE docid=$docid");
            $doctor_row = $doctor_name_query->fetch_assoc();
            $docname = $doctor_row['docname'];
            header("location: schedule.php?action=schedule-conflict&doctor=".urlencode($docname)."&date=$date&time=$time");
        } else {
            // No conflict, proceed with insertion
            $sql="insert into schedule (docid,title,scheduledate,scheduletime,nop) values ($docid,'$title','$date','$time',$nop);";
            $result= $database->query($sql);
            header("location: schedule.php?action=session-added&title=".urlencode($title));
        }
        
    }


?>