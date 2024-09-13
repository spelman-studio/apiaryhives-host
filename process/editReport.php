<?php
    require_once("../inc/global.php");

if(!isLoggedIn()){
    header("Location: ../login.php");
    die();
}

if(!isAdmin() && !isHr()){
    //header("Location: /dashboard.php");
    die("You must be an administrator or member of Human Resources to view this page.");
}

if(!$_POST['editReport']){
    header("Location: ../reports.php");
    die();
}



$id = (int) mysqli_real_escape_string($connect, strip_tags(@$_POST['concerns_id']));


if($id == 0){
    die("Invalid Report ID");
}


$sql = mysqli_query($connect, "SELECT * FROM concerns WHERE concerns_id='$id' ORDER BY concerns_id DESC limit 1");
if(!$sql || mysqli_num_rows($sql) != 1){
    die("Cannot Find Report");
}



$adminNotes = mysqli_real_escape_string($connect, strip_tags(@$_POST['adminNotes']));
$status = (int) mysqli_real_escape_string($connect, strip_tags(@$_POST['status']));



if($adminNotes == "" || $status == 0){
    // make sure all fields have data
    $_SESSION['postResult'] = "edit-report-error-missing-fields";
    header("Location: ../report-details.php?id=$id");
    die("error missing");
}

$stmt = $connection->prepare("UPDATE concerns set concerns_admin_notes='$adminNotes', concerns_status='$status' WHERE concerns_id='$id' ORDER BY concerns_id DESC LIMIT 1");
$stmt->bind_param("is", $adminNotes, $status, $id);
$stmt->execute();


if($stmt){
    $_SESSION['reportResult'] = "edit-report-success";
    header("Location: ../reports.php");
    die();
}else{
    $_SESSION['reportResult'] = "edit-report-error";
    header("Location: ../reports.php");
    die();
}

?>
