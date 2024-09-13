<?php
require_once("inc/global.php");


if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}

if(!isAdmin() && !isHr()){
    header("Location: /dashboard.php");
    die();
}
$user = getUserDetails($_SESSION['loggedIn_userId']);
$companyId = $user['company_id'];
?>
<html>
    <head>
         <?php require_once("inc/head.php"); ?>
        <title>View Reports | Apiary Hives</title>
    </head>
    <body>
        <?php require_once("inc/navbar.php"); ?>
        <div class="report-box">
            <div class="report-header-box">
                <span class="report-header">View Reports</span>
                <a href='new-report.php' class='new-report-btn'>New Report</a>
            </div>  
            <?php
            switch(@$_SESSION['reportResult']){
                case "edit-report-success":
                    echo "<div class='alert alert-success'>Report has been updated!</div>";
                    unset($_SESSION['reportResult']);
                    break;
                case "edit-report-error":
                case "edit-report-error-missing-fields":
                    echo "<div class='alert alert-danger'>There was an error editing this report.</div>";
                    unset($_SESSION['reportResult']);
                    break;
            }
            ?>
            <hr />
            <?php
            $sql = mysqli_query($connect, "SELECT * FROM concerns WHERE concerns_company_id = $companyId ORDER BY concerns_id DESC");
            while($row = mysqli_fetch_array($sql)){
                $id = $row['concerns_id'];
                $submittedByUserId = stripslashes($row['concerns_user_id']);
                
                $anonId = stripslashes($row['concerns_anon_id']);
                if($anonId==0){
                    $submittedByArray = getUserDetails($submittedByUserId);
                    $submittedByFirstName = $submittedByArray['first_name'];
                    $submittedByLastName = $submittedByArray['last_name'];
                    $submittedByStr = "$submittedByFirstName $submittedByLastName";
                } else {
                    $submittedByStr = "Anonymous";
                }

                $description = stripslashes($row['concerns_description']);
                $department = stripslashes($row['concerns_dept_id']);
                $dateStarted = stripslashes($row['concerns_date_started']);
                $dateStarted = date("M d, Y", strtotime($dateStarted));
                

                $status = $row['concerns_status'];

                // add a CSS class (for the border-left), and a bootstrap badge to show green for complete, or black for in progress. makes it easy to see the status of all reports at a glance
                if($status == 2){
                    $statusColorClass = "reportComplete";
                    $statusBadge = "<span class='badge badge-pill badge-success'>Resolved</span>";
                }else{
                    $statusColorClass = "reportInProgress";
                    $statusBadge = "<span class='badge badge-pill badge-secondary'>In Progress</span>";
                }
            

                if(strlen($description) > 100){
                    $description = substr($description, 0, 200)." ... <a href='report-details.php?id=$id'>read more</a>";
                }

                $description = nl2br($description);
                echo "<div class='reportPreview $statusColorClass'>
                <h2><a href='report-details.php?id=$id'>Report: $id</a></h2>
                $description
                <hr />
                $statusBadge Submitted by $submittedByStr on $dateStarted
                </div>";
            }
            ?>
        </div>
    </body>
</html>