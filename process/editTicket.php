<?php
    require_once("../inc/global.php");

if(!isLoggedIn()){
    header("Location: ../login.php");
    die();
}

if(!isAdmin() && !isIt()){
    header("Location: /dashboard.php");
    die("You must be an administrator or member of Information Technology to view this page.");
}

if(!$_POST['editTicket']){
    header("Location: ../tickets.php");
    die();
}

$id = (int) mysqli_real_escape_string($connect, strip_tags(@$_POST['it_id']));


if($id == 0){
    die("Invalid Report ID");
}


$sql = mysqli_query($connect, "SELECT * FROM it WHERE it_id='$id' ORDER BY it_id DESC limit 1");
if(!$sql || mysqli_num_rows($sql) != 1){
    die("Cannot Find Ticket");
}


$itNotes = mysqli_real_escape_string($connect, strip_tags(@$_POST['it_notes']));
$status = (int) mysqli_real_escape_string($connect, strip_tags(@$_POST['status']));



if($itNotes == "" || $status == 0){
    // make sure all fields have data
    $_SESSION['ticketResult'] = "edit-ticket-error-missing-fields";
    header("Location: ../ticket-details.php?id=$id");
    die();
}

$stmt = $connection->prepare("UPDATE it set it_notes='$itNotes', it_status='$status' WHERE it_id='$id' ORDER BY it_id DESC LIMIT 1");
$stmt->bind_param("is", $itNotes, $status, $id);
$stmt->execute();




if($stmt){
    $_SESSION['ticketResult'] = "edit-ticket-success";
    header("Location: ../tickets.php");
    die();
}else{
    $_SESSION['ticketResult'] = "edit-ticket-error";
    header("Location: ../tickets.php");
    die();
}

?>
