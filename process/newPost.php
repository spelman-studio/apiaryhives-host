<?php
    require_once("../inc/global.php");

if(!isLoggedIn()){
    header("Location: ../login.php");
    die();
}


if(!$_POST['newPost']){
    //header("Location: ../new-post.php");
    die('form going');
}

$caption = mysqli_real_escape_string($connect, strip_tags(@$_POST['post-caption']));
$dept = mysqli_real_escape_string($connect, strip_tags(@$_POST['post-department']));


$myUserId = $_SESSION['loggedIn_userId'];
$date = date("Y-m-d");

$user = getUserDetails($myUserId);
$companyId = $user['company_id'];


if($dept == ""  || $caption == ""){
    // make sure dept and caption is filled out
    $_SESSION['postResult'] = "post-error-missing-fields";
    //header("Location: ../new-post.php");
    die('missing fields');
}


if($uploadFilename = uploadImage($_FILES["post-img"])){

    $stmt = $connection->prepare("INSERT INTO main_post (main_post_img, main_post_caption, main_post_dept_id, main_post_user_id, main_post_create_date, main_post_company_id) VALUES('$uploadFilename', '$caption', '$dept', '$myUserId', '$date', '$companyId')");
    $stmt->bind_param("is", $uploadFilename, $caption, $dept, $myUserId, $date, $companyId);
    $stmt->execute();

    if($stmt){
        $_SESSION['postResult'] = "post-success";
        header("Location: ../dashboard.php");
        die();
    }else{
        $_SESSION['postResult'] = "post-error";
        header("Location: ../dashboard.php");
        die();
    }

}else{
    die("Error uploading image");
}

?>
