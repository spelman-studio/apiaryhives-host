<?php
    require_once("../inc/global.php");

if(!isLoggedIn()){
    header("Location: ../login.php");
    die();
}


if(!$_POST['newAnc']){
    header("Location: ../new-anc.php");
    die();
}

$caption = mysqli_real_escape_string($connect, strip_tags(@$_POST['anc-caption']));
$department = mysqli_real_escape_string($connect, strip_tags(@$_POST['anc-department']));


$myUserId = $_SESSION['loggedIn_userId'];
$date = date("Y-m-d");

$user = getUserDetails($myUserId);
$companyId = $user['company_id'];


if($caption == "" || $department == ""){
    $_SESSION['ancResult'] = "anc-error-missing-fields";
    header("Location: ../new-anc.php");
    die();
}

if(@$_FILES["anc-img"]['name'] != ""){
    if($uploadFilename = uploadImage($_FILES["anc-img"])){

        $stmt = $connection->prepare("INSERT INTO announce (announce_img, announce_caption, announce_user_id, announce_createdate, announce_dept_id, announce_company_id) VALUES('$uploadFilename','$caption', '$myUserId', '$date', '$department', '$companyId')");
        $stmt->bind_param("is", $uploadFilename, $caption, $myUserId, $date, $department, $companyId);
        $stmt->execute();
    
        if($stmt){
            $_SESSION['ancResult'] = "anc-success";
            header("Location: ../dashboard.php");
            die();
        }else{
            $_SESSION['ancResult'] = "anc-error";
            header("Location: ../new-anc.php");
            die();
        }
    
    }else{
        die("Error uploading image");
    }
} else {
    $stmt = $connection->prepare("INSERT INTO announce (announce_caption, announce_user_id, announce_createdate, announce_dept_id, announce_company_id) VALUES('$caption', '$myUserId', '$date', '$department', '$companyId')");
    $stmt->bind_param("is", $caption, $myUserId, $date, $department, $companyId);
    $stmt->execute();
    
    if($stmt){
        $_SESSION['ancResult'] = "anc-success";
        header("Location: ../dashboard.php");
        die();
    }else{
        $_SESSION['ancResult'] = "anc-error";
        header("Location: ../new-anc.php");
        die();
    }
}



?>
