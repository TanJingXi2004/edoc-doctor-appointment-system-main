<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../img/icons/favicon.ico" type="image/ico" sizes="16x16">      
    <title>Schedule</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }

</style>
</head>
<body>
    <?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
            exit(); // Good practice to exit after header
        }
    }else{
        header("location: ../login.php");
        exit(); // Good practice to exit after header
    }
    
    include("../connection.php");
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@edoc.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu "><div><p class="menu-text">Doctors</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule menu-active menu-icon-schedule-active">
                        <a href="schedule.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="schedule.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Schedule Manager</p>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                                date_default_timezone_set('Asia/Kolkata');
                                $today = date('Y-m-d');
                                echo $today;
                                $list110 = $database->query("select * from schedule;");
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" >
                        <div style="display: flex;margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">Schedule a Session</div>
                        <a href="?action=add-session&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('../img/icons/add.svg');">Add a Session</button> <!-- Removed closing </font> tag -->
                        </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Sessions (<?php echo $list110->num_rows; ?>)</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
                        <tr>
                           <td width="10%"></td> 
                        <td width="5%" style="text-align: center;">Date:</td>
                        <td width="30%">
                        <form action="" method="post">
                            <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">
                        </td>
                        <td width="5%" style="text-align: center;">Doctor:</td>
                        <td width="30%">
                        <select name="docid" id="" class="box filter-container-items" style="width:90% ;height: 37px;margin: 0;" >
                            <option value="" disabled selected hidden>Choose Doctor Name from the list</option>
                            <?php 
                                $list11 = $database->query("select * from doctor order by docname asc;");
                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $sn=$row00["docname"];
                                    $id00=$row00["docid"];
                                    echo "<option value='".htmlentities($id00)."'>".htmlentities($sn)."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td width="12%">
                        <input type="submit" name="filter" value=" Filter" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>
                    </tr>
                            </table>
                        </center>
                    </td>
                </tr>
                <?php
                    $sqlmain= "select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid";
                    if($_POST && isset($_POST["filter"])){
                        $sqlpt1="";
                        if(!empty($_POST["sheduledate"])){
                            $sheduledate = $database->real_escape_string($_POST["sheduledate"]);
                            $sqlpt1=" schedule.scheduledate='$sheduledate' ";
                        }
                        $sqlpt2="";
                        if(!empty($_POST["docid"])){
                            $docid = $database->real_escape_string($_POST["docid"]);
                            $sqlpt2=" doctor.docid='$docid' "; // Use quotes for docid if it's treated as string, or ensure it's int
                        }
                        $sqllist=array($sqlpt1,$sqlpt2);
                        $sqlkeywords=array(" where "," and ");
                        $key2=0;
                        $conditions = [];
                        foreach($sqllist as $key){
                            if(!empty($key)){
                                $conditions[] = $key;
                            }
                        }
                        if (!empty($conditions)) {
                            $sqlmain .= " WHERE " . implode(" AND ", $conditions);
                        }
                         $sqlmain .= " order by schedule.scheduledate desc";
                    }else{
                        $sqlmain .= " order by schedule.scheduledate desc";
                    }
                ?>
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">Session Title</th>
                                <th class="table-headin">Doctor</th>
                                <th class="table-headin">Scheduled Date & Time</th>
                                <th class="table-headin">Max Bookings</th>
                                <th class="table-headin" style="text-align:center;">Events</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $result= $database->query($sqlmain);
                            if($result->num_rows==0){
                                echo '<tr>
                                <td colspan="5">
                                <br><br><br><br>
                                <center>
                                <img src="../img/notfound.svg" width="25%">
                                <br>
                                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldn\'t find anything related to your keywords!</p>
                                <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Sessions  </button>
                                </a>
                                </center>
                                <br><br><br><br>
                                </td>
                                </tr>';
                            } else {
                                while($row=$result->fetch_assoc()){ // Use while loop for clarity
                                    $scheduleid=$row["scheduleid"];
                                    $title=$row["title"];
                                    $docname=$row["docname"];
                                    $scheduledate=$row["scheduledate"];
                                    $scheduletime=$row["scheduletime"];
                                    $nop=$row["nop"];
                                    echo '<tr>
                                        <td>  '. htmlentities(substr($title,0,30)) .'</td>
                                        <td>'. htmlentities(substr($docname,0,20)) .'</td>
                                        <td style="text-align:center;">'. htmlentities(substr($scheduledate,0,10)).' '.htmlentities(substr($scheduletime,0,5)) .'</td>
                                        <td style="text-align:center;">'. htmlentities($nop) .'</td>
                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                            <a href="?action=view&id='.urlencode($scheduleid).'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                               
                                            <a href="?action=edit&id='.urlencode($scheduleid).'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Edit</font></button></a>
                                               
                                            <a href="?action=drop&id='.urlencode($scheduleid).'&name='.urlencode($title).'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Remove</font></button></a>
                                        </div>
                                        </td>
                                    </tr>';
                                }
                            }
                        ?>
                        </tbody>
                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
            </table>
        </div>
    </div>

    <?php
    if(isset($_GET["action"])){
        $id = isset($_GET["id"]) ? $database->real_escape_string($_GET["id"]) : '';
        $action = $_GET["action"];

        if($action=='add-session'){
            // ... (add session popup code from previous response, ensure options are htmlentities encoded)
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="schedule.php">×</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Session.</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <form action="add-session.php" method="POST" class="add-new-form">
                                    <label for="title" class="form-label">Session Title : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="title" class="input-text" placeholder="Name of this Session" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="docid" class="form-label">Select Doctor: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="docid" class="box" required >
                                    <option value="" disabled selected hidden>Choose Doctor Name from the list</option>';
                                        $list_doc = $database->query("select * from doctor order by docname asc;");
                                        while($row_doc = $list_doc->fetch_assoc()){
                                            echo "<option value='".htmlentities($row_doc["docid"])."'>".htmlentities($row_doc["docname"])."</option>";
                                        }
                        echo     '</select><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nop" class="form-label">Number of Patients/Appointment Numbers : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="number" name="nop" class="input-text" min="0"  placeholder="Max appointments" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="date" class="form-label">Session Date: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="date" name="date" class="input-text" min="'.date('Y-m-d').'" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="time" class="form-label">Schedule Time: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="time" name="time" class="input-text" placeholder="Time" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >     
                                    <input type="submit" value="Place this Session" class="login-btn btn-primary btn" name="shedulesubmit">
                                </td>
                            </tr>
                           </form>
                           </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>';
        } elseif($action=='session-added'){
            $titleget = isset($_GET["title"]) ? urldecode($_GET["title"]) : "Session";
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                <center>
                <br><br>
                    <h2>Session Placed.</h2>
                    <a class="close" href="schedule.php">×</a>
                    <div class="content">'.htmlentities(substr($titleget,0,40)).' was scheduled.<br><br></div>
                    <div style="display: flex;justify-content: center;">
                    <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">  OK  </font></button></a>
                    </div>
                </center>
                </div>
            </div>';
        } elseif($action=='drop'){
            $nameget = isset($_GET["name"]) ? urldecode($_GET["name"]) : "this session";
             echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="schedule.php">×</a>
                    <div class="content">You want to delete this record<br>('.htmlentities(substr($nameget,0,40)).').</div>
                    <div style="display: flex;justify-content: center;">
                    <a href="delete-session.php?id='.urlencode($id).'" class="non-style-link"><button  class="btn-primary btn" style="margin:10px;padding:10px;"><font class="tn-in-text"> Yes </font></button></a>   
                    <a href="schedule.php" class="non-style-link"><button  class="btn-primary-soft btn"  style="margin:10px;padding:10px;"><font class="tn-in-text">  No  </font></button></a>
                    </div>
                </center>
                </div>
            </div>';
        } elseif($action=='view'){
            // ... (view session popup code from previous response, ensure data is htmlentities encoded)
            $sqlmain_view = "SELECT schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, schedule.scheduletime, schedule.nop 
                       FROM schedule 
                       INNER JOIN doctor ON schedule.docid=doctor.docid  
                       WHERE schedule.scheduleid='$id'";
            $result_view = $database->query($sqlmain_view);
            if ($result_view && $result_view->num_rows > 0) {
                $row_view = $result_view->fetch_assoc();
                // ... (assign variables $docname, $title, etc.)
                $docname = $row_view["docname"];
                $title = $row_view["title"];
                $scheduledate = $row_view["scheduledate"];
                $scheduletime = $row_view["scheduletime"];
                $nop = $row_view['nop'];

                $sql_appointments = "SELECT appointment.*, patient.pname, patient.ptel 
                                   FROM appointment 
                                   INNER JOIN patient ON patient.pid=appointment.pid 
                                   WHERE appointment.scheduleid='$id' ORDER BY appointment.apponum ASC";
                $result_appointments = $database->query($sql_appointments);
            
                echo '
                <div id="popup1" class="overlay">
                        <div class="popup" style="width: 70%;">
                        <center>
                            <h2></h2>
                            <a class="close" href="schedule.php">×</a>
                            <div class="abc scroll" style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr><td><p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br></td></tr>
                                <tr><td class="label-td" colspan="2"><label class="form-label">Session Title: </label></td></tr>
                                <tr><td class="label-td" colspan="2">'.htmlentities($title).'<br><br></td></tr>
                                <tr><td class="label-td" colspan="2"><label class="form-label">Doctor: </label></td></tr>
                                <tr><td class="label-td" colspan="2">'.htmlentities($docname).'<br><br></td></tr>
                                <tr><td class="label-td" colspan="2"><label class="form-label">Scheduled Date: </label></td></tr>
                                <tr><td class="label-td" colspan="2">'.htmlentities($scheduledate).'<br><br></td></tr>
                                <tr><td class="label-td" colspan="2"><label class="form-label">Scheduled Time: </label></td></tr>
                                <tr><td class="label-td" colspan="2">'.htmlentities($scheduletime).'<br><br></td></tr>
                                <tr><td class="label-td" colspan="2"><label class="form-label"><b>Registered Patients:</b> ('.($result_appointments ? $result_appointments->num_rows : 0)."/".$nop.')</label><br><br></td></tr>
                                <tr><td colspan="4"><center><div class="abc scroll"><table width="100%" class="sub-table scrolldown" border="0"><thead>
                                     <tr><th class="table-headin">Patient ID</th><th class="table-headin">Patient Name</th><th class="table-headin">App. No.</th><th class="table-headin">Telephone</th></tr>
                                     </thead><tbody>';
                if ($result_appointments && $result_appointments->num_rows == 0) {
                    echo '<tr><td colspan="4"><br><center><img src="../img/notfound.svg" width="20%"><p>No patients registered yet.</p></center><br></td></tr>';
                } else if ($result_appointments) {
                    while ($row_app = $result_appointments->fetch_assoc()) {
                        echo '<tr style="text-align:center;">
                                 <td>'.htmlentities($row_app["pid"]).'</td>
                                 <td style="font-weight:600;padding:15px">'.htmlentities($row_app["pname"]).'</td>
                                 <td style="font-size:20px;font-weight:500;">'.htmlentities($row_app["apponum"]).'</td>
                                 <td>'.htmlentities($row_app["ptel"]).'</td></tr>';
                    }
                }
                echo '</tbody></table></div></center></td></tr></table></div></center><br><br></div></div>';
            } else {
                 // Session not found
                 echo '<div id="popup1" class="overlay"><div class="popup"><center><br><h2>Error</h2><a class="close" href="schedule.php">×</a><div class="content">Session details not found.</div><br></center></div></div>';
            }

        } elseif($action=='edit'){
            // ... (edit session popup code from previous response, ensure data and options are htmlentities encoded)
            // Fetch current session details
            $sql_edit = "SELECT * FROM schedule WHERE scheduleid='$id'";
            $result_edit = $database->query($sql_edit);
            if($result_edit && $result_edit->num_rows == 1){
                $session_data = $result_edit->fetch_assoc();
                // ... (assign $edit_title, $edit_docid, etc.)
                 $edit_title = $session_data['title'];
                $edit_docid = $session_data['docid'];
                $edit_nop = $session_data['nop'];
                $edit_date = $session_data['scheduledate'];
                $edit_time = $session_data['scheduletime'];

                echo '
                <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="schedule.php">×</a>
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr><td><p style="padding:0;margin:0;text-align:left;font-size:25px;font-weight:500;">Edit Session Details.</p><br></td></tr>
                        <form action="edit-session.php" method="POST" class="add-new-form">
                            <input type="hidden" name="scheduleid" value="'.htmlentities($id).'">
                            <tr><td class="label-td" colspan="2"><label for="title" class="form-label">Session Title :</label></td></tr>
                            <tr><td class="label-td" colspan="2"><input type="text" name="title" class="input-text" value="'.htmlentities($edit_title).'" required><br></td></tr>
                            <tr><td class="label-td" colspan="2"><label for="docid" class="form-label">Select Doctor: </label></td></tr>
                            <tr><td class="label-td" colspan="2">
                                <select name="docid" class="box" required>';
                                $list_doctors_edit = $database->query("select * from doctor order by docname asc;");
                                while($row_doc_edit = $list_doctors_edit->fetch_assoc()){
                                    $selected = ($row_doc_edit["docid"] == $edit_docid) ? "selected" : "";
                                    echo "<option value='".htmlentities($row_doc_edit["docid"])."' ".$selected.">".htmlentities($row_doc_edit["docname"])."</option>";
                                }
                echo        '</select><br><br></td></tr>
                            <tr><td class="label-td" colspan="2"><label for="nop" class="form-label">Max Appointments :</label></td></tr>
                            <tr><td class="label-td" colspan="2"><input type="number" name="nop" class="input-text" min="0" value="'.htmlentities($edit_nop).'" required><br></td></tr>
                            <tr><td class="label-td" colspan="2"><label for="date" class="form-label">Session Date: </label></td></tr>
                            <tr><td class="label-td" colspan="2"><input type="date" name="date" class="input-text" min="'.date('Y-m-d').'" value="'.htmlentities($edit_date).'" required><br></td></tr>
                            <tr><td class="label-td" colspan="2"><label for="time" class="form-label">Schedule Time: </label></td></tr>
                            <tr><td class="label-td" colspan="2"><input type="time" name="time" class="input-text" value="'.htmlentities($edit_time).'" required><br></td></tr>
                            <tr><td colspan="2">
                                <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >     
                                <input type="submit" value="Update Session" class="login-btn btn-primary btn" name="editschedulesubmit">
                            </td></tr>
                        </form>
                        </table></div></div></center><br><br></div></div>';
            } else {
                // Error: session not found
                 echo '<div id="popup1" class="overlay"><div class="popup"><center><br><h2>Error</h2><a class="close" href="schedule.php">×</a><div class="content">Session not found for editing.</div><br></center></div></div>';
            }
        } elseif($action=='session-updated'){
            $titleget = isset($_GET["title"]) ? urldecode($_GET["title"]) : "Session";
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                <center>
                <br><br>
                    <h2>Session Updated.</h2>
                    <a class="close" href="schedule.php">×</a>
                    <div class="content">'.htmlentities(substr($titleget,0,40)).' was successfully updated.<br><br></div>
                    <div style="display: flex;justify-content: center;">
                    <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn" style="margin:10px;padding:10px;"><font class="tn-in-text">  OK  </font></button></a>
                    </div>
                </center>
                </div>
            </div>';
        } elseif ($action == 'schedule-conflict' || $action == 'schedule-conflict-edit') {
            $doctor_name = isset($_GET["doctor"]) ? urldecode($_GET["doctor"]) : "The selected doctor";
            $conflict_date = isset($_GET["date"]) ? $_GET["date"] : "the selected date";
            $conflict_time = isset($_GET["time"]) ? $_GET["time"] : "the selected time";
            $try_again_link = ($action == 'schedule-conflict-edit' && !empty($id)) 
                               ? "schedule.php?action=edit&id=".urlencode($id)."&error=conflict" 
                               : "schedule.php?action=add-session&id=none&error=0";
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                <center>
                <br><br>
                    <h2 style="color:red;">Schedule Conflict!</h2>
                    <a class="close" href="schedule.php">×</a>
                    <div class="content">
                    '. htmlentities($doctor_name) .' already has a session scheduled on <br><b>'. htmlentities($conflict_date) .'</b> at <b>'. htmlentities($conflict_time) .'</b>.<br><br>
                    Please choose a different time or date.
                    </div>
                    <div style="display: flex;justify-content: center;">
                    <a href="'.$try_again_link.'" class="non-style-link"><button  class="btn-primary-soft btn" style="margin:10px;padding:10px;"><font class="tn-in-text">  Try Again  </font></button></a>
                    <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn" style="margin:10px;padding:10px;"><font class="tn-in-text">  OK  </font></button></a>
                    </div>
                </center>
            </div>
            </div>';
        }
    }
    ?>
</body>
</html>