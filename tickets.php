<?php
require_once("inc/global.php");


if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}

if(!isAdmin() && !isIt()){
    header("Location: /dashboard.php");
    die();
}

$user = getUserDetails($_SESSION['loggedIn_userId']);
$companyId = $user['company_id'];

?>
<html>
    <head>
         <?php require_once("inc/head.php"); ?>
        <title>View Tickets | Apiary Hives</title>
    </head>
    <body>
        <?php require_once("inc/navbar.php"); ?>
        <div class="report-box">
            <h1>View Tickets</h1>
            <a href='/new-ticket.php' class='new-report-btn'>New Ticket</a>
            <?php
            switch(@$_SESSION['reportResult']){
                case "edit-ticket-success":
                    echo "<div class='alert alert-success'>Ticket has been updated!</div>";
                    unset($_SESSION['ticketResult']);
                    break;
                case "edit-ticket-error":
                case "edit-ticket-error-missing-fields":
                    echo "<div class='alert alert-danger'>There was an error editing this ticket.</div>";
                    unset($_SESSION['reportResult']);
                    break;
            }
            ?>
            <hr />
            <?php
            $sql = mysqli_query($connect, "SELECT * FROM it WHERE it_company_id = $companyId ORDER BY it_id DESC");
            while($row = mysqli_fetch_array($sql)){
                $id = $row['it_id'];
                $userId = stripslashes($row['it_user_id']);
                $submittedByArray = getUserDetails($userId);
                    $submittedByFirstName = $submittedByArray['first_name'];
                    $submittedByLastName = $submittedByArray['last_name'];

                $persistId = stripslashes($row['it_persistance_id']);
                $sqlPersist = mysqli_query($connect, "SELECT * FROM persistance WHERE persistance_id='$persistId' ORDER BY persistance_id DESC LIMIT 1");
                    $rowPersist = mysqli_fetch_array($sqlPersist);
                    $persistName = $rowPersist['persistance_description'];


                $reoccurId = stripslashes($row['it_reoccurence_id']);
                $sqlReoccur = mysqli_query($connect, "SELECT * FROM reoccurrence WHERE reoccurrence_id='$reoccurId' ORDER BY reoccurrence_id DESC LIMIT 1") or die(mysqli_error($connect));
                    $reoccurRow = mysqli_fetch_array($sqlReoccur);
                    $reoccurName = $reoccurRow['reoccurrence_description'];

                $description = stripslashes($row['it_description']);


                $locationId = stripslashes($row['it_location_id']);
                $sqlLocation = mysqli_query($connect, "SELECT * FROM location WHERE location_id='$locationId' ORDER BY location_id DESC LIMIT 1");
                    $rowLocation = mysqli_fetch_array($sqlLocation);
                    $locationName = $rowLocation['location_description'];


                $officeNum = stripslashes($row['it_office_number']);
                if($officeNum != null && $officeNum != 0){
                    $officeNum = "(#$officeNum)";
                }else{
                    $officeNum = "";
                }

                $dateFiled = $row['it_date_filed'];
                $dateFiled = date("M d, Y", strtotime($dateFiled));
                
                $status = $row['it_status'];

                // add a CSS class (for the border-left), and a bootstrap badge to show green for complete, or black for in progress. makes it easy to see the status of all reports at a glance
                if($status == 2){
                    $statusColorClass = "reportComplete";
                    $statusBadge = "<span class='badge badge-pill badge-success'>Resolved</span>";
                }else{
                    $statusColorClass = "reportInProgress";
                    $statusBadge = "<span class='badge badge-pill badge-dark'>In Progress</span>";
                }
            

                if(strlen($description) > 100){
                    $description = substr($description, 0, 200)." ... <a href='ticket-details.php?id=$id'>read more</a>";
                }

                $description = nl2br($description);
                echo "<div class='reportPreview $statusColorClass'>
                <h2><a href='ticket-details.php?id=$id'>Ticket: $id</a></h2>
                $description
                <hr />
                $statusBadge Submitted by $submittedByFirstName $submittedByLastName on $dateFiled
                <br/>
                <b>Location:</b> $locationName $officeNum. 
                <b>Issue persistance:</b> $persistName.
                <b>Reoccurance Level:</b> $reoccurName.
                </div>";
            }
            ?>
        </div>
    </body>
</html>