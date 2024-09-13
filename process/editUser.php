<?php
    require_once("../inc/global.php");

if(!isLoggedIn()){
    header("Location: ../login.php");
    die();
}

//only admin and onboarding can change these settings
if(!isAdmin() && !isOnboarding()){
    die("Not allowed");
}

if(!$_POST['editUser']){
    header("Location: ../user-profile.php");
    die();
}


$id = (int) mysqli_real_escape_string($connect, strip_tags(@$_POST['user_id']));
if($id == 0){
    die("Invalid User ID");
}


$sql = mysqli_query($connect, "SELECT * FROM user WHERE user_id='$id' ORDER BY user_id DESC limit 1");
if(!$sql || mysqli_num_rows($sql) != 1){
    die("Cannot Find  User");
}
// get current profile pic from db in case we need to delete it later (if they uploaded a new one)
$row = mysqli_fetch_array($sql);
$currentPfp = $row['user_pfp'];


// die("ok");

$row = mysqli_fetch_array($sql);
$firstname = mysqli_real_escape_string($connect, strip_tags(@$_POST['user_firstname']));
$lastname = mysqli_real_escape_string($connect, strip_tags(@$_POST['user_lastname']));
$username = mysqli_real_escape_string($connect, strip_tags(@$_POST['user_name']));
$workEmail = mysqli_real_escape_string($connect, strip_tags(@$_POST['user_company_email']));
$phone = mysqli_real_escape_string($connect, strip_tags(@$_POST['user_phone']));
$personalEmail = mysqli_real_escape_string($connect, strip_tags(@$_POST['user_personal_email']));
$isAdmin = mysqli_real_escape_string($connect, strip_tags(@$_POST['user_is_admin']));
$pronouns = mysqli_real_escape_string($connect, strip_tags(@$_POST['user_pronouns']));
$bio = mysqli_real_escape_string($connect, strip_tags(@$_POST['bio']));
$departmentNum = mysqli_real_escape_string($connect, strip_tags(@$_POST['department']));
$position = mysqli_real_escape_string($connect, strip_tags(@$_POST['user_position']));



if($firstname == "" || $lastname == "" || $personalEmail == "" || $username == "" || $workEmail == "" || $departmentNum == "" 
|| $phone == "" || $isAdmin == "" || $position == ""){
    // make sure all fields have data
    $_SESSION['userEdit'] = "edit-user-error-missing-fields";
   // header("Location: ../department.php");
    die("Missing fields");
}

if(@$_FILES['user_pfp']['name']){
// check if user supplied a new profile pic

    if($newProfilePic = uploadImage($_FILES['user_pfp'])){
         //die("new pic - $newProfilePic");
        $stmt = $connection->prepare("UPDATE user SET user_pfp='$newProfilePic' WHERE user_id='$id' ORDER BY user_id DESC LIMIT 1");
        $stmt->bind_param("is", $newProfilePic, $id);
        $stmt->execute();
        
        if($currentPfp != "" && $currentPfp != null){
           // new profile pic uploaded and added to db. delete current pfp
            @unlink("../uploads/$currentPfp");
        }

    }else{
        die("Failed to upload profile pic");
    }

}

$stmt = $connection->prepare("UPDATE user set user_firstname='$firstname', user_lastname='$lastname', user_name='$username', user_company_email='$workEmail', user_personal_email='$personalEmail', user_phone='$phone',  user_dep_id='$departmentNum', user_pronouns='$pronouns', user_is_admin='$isAdmin', user_bio='$bio', user_position='$position' WHERE user_id='$id' ORDER BY user_id DESC LIMIT 1");
$stmt->bind_param("is", $firstname, $lastname, $username, $workEmail, $personalEmail, $phone, $departmentNum, $pronouns, $isAdmin, $bio, $position, $id);
$stmt->execute();


if($stmt){
    $_SESSION['userEdit'] = "edit-user-success";
    if(isAdmin()){
        header("Location: ../users.php");
    } else {
        header("Location: ../users.php");
    }
    die();
}else{
    $_SESSION['userEdit'] = "edit-user-error";
    if(isAdmin()){
        header("Location: ../users.php");
    } else {
        header("Location: ../users.php");
    }
    die();
}

?>
