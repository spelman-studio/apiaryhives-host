<?php
    require_once("../inc/global.php");

if(!isLoggedIn()){
    header("Location: ../login.php");
    die();
}

if(!$_POST['newReport']){
    header("Location: ../new-report.php");
    die("error 1");
}

//user reporting
$userId = $_SESSION['loggedIn_userId'];
$user = getUserDetails($userId);
$companyId = $user['company_id'];

//department
$deptId = mysqli_real_escape_string($connect, strip_tags(@$_POST['report_department']));

//suspects
// HTML name for this is suspects[], so it's an array. later, use PHP foreach() to loop through array, and insert a new row into suspects for each person
$suspects = $_POST['suspect'];


$description = mysqli_real_escape_string($connect, strip_tags(@$_POST['concerns_description']));
$dateStarted = mysqli_real_escape_string($connect, strip_tags(@$_POST['concerns_date_started']));
$dateSubmitted = date("Y-m-d");


if($description == "" || $deptId == ""){
    $_SESSION['reportResult'] = "report-error-missing-fields";
    header("Location: ../new-report.php");
    die("missing");
}

$anonId = mysqli_real_escape_string($connect, @$_POST['isAnon']);

if($anonId==1){
    $userId = 0;
}

//insert new report into database

$stmt = $connection->prepare("INSERT INTO concerns (concerns_user_id, concerns_anon_id, concerns_date_started, concerns_dept_id, concerns_date_submitted, concerns_status, concerns_description, concerns_company_id) VALUES('$userId', '$anonId', '$dateStarted', '$deptId', '$dateSubmitted', '1', '$description', '$companyId')");
$int = 1;
$stmt->bind_param("is", $userId, $anonId, $dateStarted, $deptId, $dateSubmitted, $int, $description, $companyId);
$stmt->execute();


if($stmt){

    // get ID of concern that was just inserted
    $concernId = mysqli_insert_id($connection);

    foreach($suspects as $suspectName){
        if($suspectName != ""){

            //since we couldnt use mysqli_real_escape_string() on $_POST['suspect'] because it's an array, we're doing it for each item inside the array
            $suspectName = mysqli_real_escape_string($connect, $suspectName);

            $stmt2 = $connection->prepare("INSERT INTO suspects (suspects_concern_id, suspects_name) VALUES('$concernId', '$suspectName')");
            $stmt2->bind_param("is", $concernId, $suspectName);
            $stmt2->execute();

        }
    }
    
    $_SESSION['reportResult'] = "report-success";
    header("Location: ../dashboard.php");
    die("success");
}else{
    $_SESSION['reportResult'] = "report-error";
    header("Location: ../new-report.php");
    die("sql error");
}

?>
