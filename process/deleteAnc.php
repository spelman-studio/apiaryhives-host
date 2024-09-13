<?php
    require_once("../inc/global.php");

if(!isLoggedIn()){
    header("Location: ../login.php");
    die();
}


if(!$_POST['main_post_id']){
    header("Location: ../dashboard.php");
    die();
}

$id = (int) mysqli_real_escape_string($connect, @$_POST['main_post_id']);




if($id == 0 ){
    // make sure Post ID is supplied
    $_SESSION['ancResult'] = "post-delete-error";
    header("Location: ../dashboard.php");
    die();
}


$sql = mysqli_query($connect, "DELETE FROM announce WHERE announce_id='$id' ORDER BY announce_id DESC LIMIT 1");

if($sql){
    $_SESSION['ancResult'] = "post-delete-success";
    header("Location: ../dashboard.php");
    die();
}else{
    $_SESSION['ancResult'] = "post-delete-error";
    header("Location: ../dashboard.php");
    die();
}

?>
