<?php
require_once("../inc/global.php");

$firstName = strip_tags(@$_POST['user_firstname']);
$lastName = strip_tags(@$_POST['user_lastname']);
$workEmail = strip_tags(@$_POST['user_company_email']);
$personalEmail = strip_tags(@$_POST['user_personal_email']);
$phone = strip_tags(@$_POST['user_phone']);
$department =  (int) strip_tags(@$_POST['user_dep_id']);
$username = strip_tags(@$_POST['user_name']);
$password = strip_tags(@$_POST['user_password']);
$passwordConfirm = strip_tags(@$_POST['user_confirm_password']);
$companyId = (int) strip_tags(@$_POST['user_company_id']);
$position = strip_tags(@$_POST['user_position']);

// make the user status 1 (standard user) by default unless on Board of Directors
if($department == 7){
    $isAdmin = 1;
} else {
    $isAdmin = 0;
}

if($firstName == "" || $lastName == "" || $workEmail == "" || $personalEmail == "" || $phone == "" || $department == "" || $username == "" || $password == "" || $passwordConfirm == "" || $companyId == "" || $position == ""){
    // make sure all fields have data
    $_SESSION['createEResult'] = "signup-error-missing-fields";
    header("Location: ../new-employee.php");
    die('Missing fields');
}

if($password != $passwordConfirm){
    // make sure password and confirm password match
    $_SESSION['createEResult'] = "signup-error-password";
    header("Location: ../new-employee.php");
    die('Error Password');
}

// use mysqli_real_escape_string() here since this query isnt a prepared statement
$workEmail = mysqli_real_escape_string($connect, $workEmail);
$sql = mysqli_query($connect, "SELECT * FROM user WHERE user_company_email='$workEmail' ORDER BY user_id DESC limit 1");
if(mysqli_num_rows($sql)>0){
    $_SESSION['createEResult'] = "signup-error-duplicate-email";
    header("Location: ../new-employee.php");
    die('Duplicate email');
}

// hash the password to store in the database
$password = password_hash($password, PASSWORD_DEFAULT);



// use prepared statement here for better security since its a public facing page

$stmt = $connection->prepare("INSERT INTO user (user_name, user_company_email, user_personal_email, user_phone, user_password, user_dep_id, user_firstname, user_lastname, user_is_admin, user_company_id, user_position) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssissiis", $username, $workEmail, $personalEmail, $phone, $password, $department, $firstName, $lastName, $isAdmin, $companyId, $position);
$stmt->execute();

if($stmt){
    $_SESSION['createEResult'] = "signup-success";
    header("Location: ../login.php");
    die('Signup Success');
}else{
    $_SESSION['createEResult'] = "signup-error";
    header("Location: ../new-employee.php");
    die('DB Error');
}

?>
