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
    <title>Sessions</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .disabled-btn {
            background-color: #ccc !important; /* Lighter grey */
            color: #666 !important; /* Darker grey text */
            cursor: not-allowed !important;
            border: 1px solid #bbb !important;
        }
</style>
</head>
<body>
    <?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    include("../connection.php");
    $sqlmain_patient = "select * from patient where pemail=?";
    $stmt_patient = $database->prepare($sqlmain_patient);
    $stmt_patient->bind_param("s",$useremail);
    $stmt_patient->execute();
    $result_patient = $stmt_patient->get_result();
    $userfetch=$result_patient->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];
    
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $today = date('Y-m-d');

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
                                 <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                 <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
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
                    <td class="menu-btn menu-icon-home " >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Home</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu"><div><p class="menu-text">All Doctors</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                        <a href="schedule.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Scheduled Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Bookings</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <?php
                // Ensure 'nop' is selected if it's not part of '*' from schedule.
                // Assuming 'nop' is a column in the 'schedule' table.
                $sqlmain= "select schedule.*, doctor.docname from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today'  order by schedule.scheduledate asc";
                $insertkey="";
                $q='';
                $searchtype="All";
                
                if($_POST){
                    if(!empty($_POST["search"])){
                        $keyword=$_POST["search"];
                        // Make sure to select schedule.nop here as well
                        $sqlmain= "select schedule.*, doctor.docname from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today' and (doctor.docname LIKE ? or schedule.title LIKE ? or schedule.scheduledate LIKE ?) order by schedule.scheduledate asc";
                        
                        $searchTerm = "%".$keyword."%";
                        // Prepare statement for search to prevent SQL injection
                        $stmt_search = $database->prepare($sqlmain);
                        $stmt_search->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
                        $stmt_search->execute();
                        $result = $stmt_search->get_result();

                        $insertkey=$keyword;
                        $searchtype="Search Result : ";
                        $q='"';
                    } else {
                        $result= $database->query($sqlmain);
                    }
                } else {
                    $result= $database->query($sqlmain);
                }
        ?>
                  
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="schedule.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td >
                        <form action="" method="post" class="header-search">
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name, Title or Date (YYYY-MM-DD)" list="doctors" value="<?php  echo $insertkey ?>">  
                            
                            <?php
                                echo '<datalist id="doctors">';
                                $list11 = $database->query("select DISTINCT docname from  doctor;");
                                $list12 = $database->query("select DISTINCT title from  schedule GROUP BY title;");
                                
                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["docname"];
                                    echo "<option value='$d'></option>"; // Simpler option tag
                                }
                                for ($y=0;$y<$list12->num_rows;$y++){
                                    $row00=$list12->fetch_assoc();
                                    $d=$row00["title"];
                                    echo "<option value='$d'></option>"; // Simpler option tag
                                }
                                echo ' </datalist>';
                            ?>
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        </form>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php echo $today; ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $searchtype." Sessions"." (Available: <span id='available_sessions_count'>0</span>)"; ?> </p>
                        <p class="heading-main12" style="margin-left: 45px;font-size:22px;color:rgb(49, 49, 49)"><?php echo $q.$insertkey.$q ; ?> </p>
                    </td>
                </tr>
                
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                        <tbody id="session-table-body">
                        
                            <?php
                                $displayed_sessions_count = 0;
                                if($result->num_rows==0){
                                    // This part handles if the initial SQL query itself returns 0 rows (e.g., search found nothing)
                                    echo '<tr>
                                    <td colspan="3"> <!-- Adjusted colspan as we display 3 items per row -->
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldn\'t find anything related to your keywords !</p>
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Sessions  </button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                } else {
                                    $session_cards_html = ""; // To store HTML for session cards
                                    $items_in_current_row = 0;

                                    while($row = $result->fetch_assoc()){
                                        $scheduleid = $row["scheduleid"];
                                        $title = $row["title"];
                                        $docname = $row["docname"];
                                        $scheduledate = $row["scheduledate"];
                                        $scheduletime = $row["scheduletime"];
                                        $nop = $row["nop"]; // Max number of patients for this session

                                        // 1. Check if NOP is finished
                                        $stmt_app_count = $database->prepare("SELECT COUNT(*) as count FROM appointment WHERE scheduleid=?");
                                        $stmt_app_count->bind_param("i", $scheduleid);
                                        $stmt_app_count->execute();
                                        $app_count_result = $stmt_app_count->get_result()->fetch_assoc();
                                        $current_bookings = $app_count_result['count'];
                                        $stmt_app_count->close();

                                        if ($current_bookings >= $nop) {
                                            continue; // Skip this session, it's full
                                        }

                                        // 2. Check if this patient has already booked this session
                                        $stmt_check_booking = $database->prepare("SELECT * FROM appointment WHERE scheduleid=? AND pid=?");
                                        $stmt_check_booking->bind_param("ii", $scheduleid, $userid);
                                        $stmt_check_booking->execute();
                                        $check_booking_result = $stmt_check_booking->get_result();
                                        $already_booked = ($check_booking_result->num_rows > 0);
                                        $stmt_check_booking->close();

                                        $displayed_sessions_count++; // Increment for available sessions

                                        if ($items_in_current_row == 0) {
                                            $session_cards_html .= "<tr>";
                                        }
                                        
                                        $button_html = "";
                                        if ($already_booked) {
                                            $button_html = '<button class="login-btn btn-primary-soft btn disabled-btn" style="padding-top:11px;padding-bottom:11px;width:100%" disabled><font class="tn-in-text">Booked</font></button>';
                                        } else {
                                            $button_html = '<a href="booking.php?id='.$scheduleid.'" ><button  class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Book Now</font></button></a>';
                                        }

                                        $session_cards_html .= '
                                        <td style="width: 25%;">
                                            <div class="dashboard-items search-items">
                                                <div style="width:100%">
                                                    <div class="h1-search">'.substr($title,0,21).'</div><br>
                                                    <div class="h3-search">'.substr($docname,0,30).'</div>
                                                    <div class="h4-search">
                                                        '.$scheduledate.'<br>Starts: <b>@'.substr($scheduletime,0,5).'</b> (24h)
                                                        <br>Capacity: '.$current_bookings.'/'.$nop.'
                                                    </div>
                                                    <br>
                                                    '.$button_html.'
                                                </div>
                                            </div>
                                        </td>';
                                        
                                        $items_in_current_row++;
                                        if ($items_in_current_row == 3) {
                                            $session_cards_html .= "</tr>";
                                            $items_in_current_row = 0;
                                        }
                                    }
                                    // If there are pending items for the last row (not a multiple of 3)
                                    if ($items_in_current_row > 0 && $items_in_current_row < 3) {
                                         // Add empty TDs to fill the row
                                        for ($i = $items_in_current_row; $i < 3; $i++) {
                                            $session_cards_html .= "<td></td>"; 
                                        }
                                        $session_cards_html .= "</tr>";
                                    }
                                    
                                    echo $session_cards_html; // Output all collected session cards

                                    // If after filtering, no sessions are available to display
                                    if ($displayed_sessions_count == 0 && $result->num_rows > 0) {
                                        echo '<tr>
                                        <td colspan="3"> <!-- Adjusted colspan -->
                                        <br><br><br><br>
                                        <center>
                                        <img src="../img/notfound.svg" width="25%">
                                        <br>
                                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">No sessions currently available based on your criteria or capacity.</p>
                                        <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Sessions  </button>
                                        </a>
                                        </center>
                                        <br><br><br><br>
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
    <script>
        // Update the displayed sessions count
        document.getElementById('available_sessions_count').innerText = <?php echo $displayed_sessions_count; ?>;
    </script>
</body>
</html>