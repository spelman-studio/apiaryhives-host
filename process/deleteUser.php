<?php
    require_once("../inc/global.php");

if(!isLoggedIn()){
    header("Location: ../login.php");
    die();
}

if(!isAdmin()){
    //header("Location: /login.php");
    die("You must be an administrator to view this page.");
}

if(!$_POST['user_id']){
    header("Location: ../users.php");
    die();
}

$id = (int) mysqli_real_escape_string($connect, @$_POST['user_id']);




if($id == 0 ){
    // make sure Post ID is supplied
    $_SESSION['userEdit'] = "post-delete-error";
    header("Location: ../users.php");
    die();
}


$sql = mysqli_query($connect, "DELETE FROM user WHERE user_id='$id' ORDER BY user_id DESC LIMIT 1");

if($sql){
    $_SESSION['userEdit'] = "user-delete-success";
    header("Location: ../users.php");
    die();
}else{
    $_SESSION['userEdit'] = "user-delete-error";
    header("Location: ../users.php");
    die();
}

?>
