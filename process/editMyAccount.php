<?php
    require_once("../inc/global.php");

if(!isLoggedIn()){
    header("Location: ../login.php");
    die();
}



if(!$_POST['editMyAccount']){
    header("Location: ../settings.php");
    die();
}

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";
// die();

$id = $_SESSION['loggedIn_userId'];


$sql = mysqli_query($connect, "SELECT * FROM user WHERE user_id='$id' ORDER BY user_id DESC limit 1");
if(!$sql || mysqli_num_rows($sql) != 1){
    die("Cannot Find  User");
}

// get current profile pic from db in case we need to delete it later (if they uploaded a new one)
$row = mysqli_fetch_array($sql);
$currentPfp = $row['user_pfp'];


// die("ok");

$row = mysqli_fetch_array($sql);
$firstname = mysqli_real_escape_string($connect, strip_tags($_POST['user_firstname']));
$lastname = mysqli_real_escape_string($connect, strip_tags($_POST['user_lastname']));
$username = mysqli_real_escape_string($connect, strip_tags($_POST['user_name']));
$phone = mysqli_real_escape_string($connect, strip_tags($_POST['user_phone']));
$personalEmail = mysqli_real_escape_string($connect, strip_tags($_POST['user_personal_email']));
$pronouns = mysqli_real_escape_string($connect, strip_tags($_POST['user_pronouns']));
$bio = mysqli_real_escape_string($connect, strip_tags($_POST['bio']));
$position = mysqli_real_escape_string($connect, strip_tags($_POST['user_position']));



if($firstname == "" || $lastname == "" || $personalEmail == "" || $username == "" || $phone == "" || $position == ""){
    // make sure all fields have data
    $_SESSION['userEdit'] = "edit-user-error-missing-fields";
    header("Location: ../settings.php");
    die("Missing fields");
}


if(@$_FILES['user_pfp']['name']){
// check if user supplied a new profile pic

    if($newProfilePic = uploadImage($_FILES['user_pfp'])){

        $stmt = $connection->prepare("UPDATE user SET user_pfp='$newProfilePic' WHERE user_id='$id' ORDER BY user_id DESC LIMIT 1");
        $stmt->bind_param("is", $newProfilePic, $id);
        $stmt->execute();

        if($currentPfp != "" && $currentPfp != null){
           // new profile pic uploaded and added to db. delete current pfp
            @unlink("../uploads/$currentPfp");
        }

    }

}

$stmt = $connection->prepare("UPDATE user set user_firstname='$firstname', user_lastname='$lastname', user_name='$username',  user_personal_email='$personalEmail', user_phone='$phone', user_pronouns='$pronouns', user_bio='$bio', user_position='$position' WHERE user_id='$id' ORDER BY user_id DESC LIMIT 1");
$stmt->bind_param("is", $firstname, $lastname, $username, $personalEmail, $phone, $pronouns, $bio, $position, $id);
$stmt->execute();


if($stmt){
    $_SESSION['userEdit'] = "edit-user-success";
    header("Location: ../settings.php");
    die("success");
}else{
    $_SESSION['userEdit'] = "edit-user-error";
    header("Location: ../settings.php");
    die("db error");
}

?>
