<?php
    require_once("../inc/global.php");

if(!isLoggedIn()){
    header("Location: ../login.php");
    die();
}

if(!$_POST['submitTicket']){
    header("Location: ../new-ticket.php");
    die();
}

$userId = $_SESSION['loggedIn_userId'];
$user = getUserDetails($userId);
$companyId = $user['company_id'];

//location (1=remote & 2=in-office)
$location = (int) mysqli_real_escape_string($connect, strip_tags(@$_POST['it_location_id']));

$officeNum = (int) mysqli_real_escape_string($connect, strip_tags(@$_POST['it_office_number']));


//description
$description = mysqli_real_escape_string($connect, strip_tags(@$_POST['it_description']));

//dates
$dateSubmitted = date("Y-m-d");

//frequency
$reoccur = mysqli_real_escape_string($connect, strip_tags(@$_POST['it_reoccurance_id']));
$persist = mysqli_real_escape_string($connect, strip_tags(@$_POST['it_persistance_id']));

if($description == "" || $location == "" || $persist == ""){
    $_SESSION['ticketResult'] = "ticket-error-missing-fields";
    header("Location: ../new-ticket.php");
    die("missing fields");
}

//insert new report into database
$stmt = $connection->prepare("INSERT INTO it (it_user_id, it_location_id, it_office_number, it_persistance_id, it_reoccurence_id, it_date_filed, it_status, it_description, it_company_id) VALUES('$userId', '$location', '$officeNum', '$persist', '$reoccur', '$dateSubmitted', '1', '$description', '$companyId')");
$int = 1;
$stmt->bind_param("is", $userId, $location, $officeNum, $persist, $reoccur, $dateSubmitted, $int, $description, $companyId);
$stmt->execute();


if($stmt){
    $_SESSION['ticketResult'] = "ticket-success";
    header("Location: ../dashboard.php");
    die("success");
}else{
    $_SESSION['ticketResult'] = "ticket-error";
    header("Location: ../new-ticket.php");
    die("db error");
}

?>
