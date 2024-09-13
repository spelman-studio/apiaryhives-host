<?php
    require_once("../inc/global.php");

if(!isLoggedIn()){
    header("Location: ../login.php");
    die();
}


if(!$_POST['addComment']){
    //header("Location: ../dashboard.php");
    die("error");
}

// echo "<pre>";
// print_r($_POST);

// // die();
$forType = mysqli_real_escape_string($connect, strip_tags(@$_POST['for-type']));
$forId = mysqli_real_escape_string($connect, strip_tags(@$_POST['for-id']));
$commentText = mysqli_real_escape_string($connect, strip_tags(@$_POST['addCommentText']));
$reaction = mysqli_real_escape_string($connect, strip_tags(@$_POST['addCommentReaction']));

 


$myUserId = $_SESSION['loggedIn_userId'];
$date = date("Y-m-d");




if($forType == "" || $forId == "" || $commentText == "" || $reaction == ""){
    // $_SESSION['postResult'] = "post-error-missing-fields";
    // header("Location: ../dashboard.php");
    die("missing info");
}


switch($forType){
    case "main-post":
     $redirect = "../read-post.php?id=$forId";
    break;

    default:
        die("Invalid Comment Type");
    break;
}




    $sql = mysqli_query($connect, "INSERT INTO comments (comment_for_type, comment_for_id, comment_reaction, comment_text, comment_date, comment_user) VALUES('$forType', '$forId', '$reaction', '$commentText', '$date', '$myUserId')") or die(mysqli_error($connect));

    if($sql){
        $_SESSION['postResult'] = "comment-post-success";
        header("Location: $redirect");
        die();
    }else{
        $_SESSION['postResult'] = "comment-post-error";
        header("Location: $redirect");
        die();
    }










?>
