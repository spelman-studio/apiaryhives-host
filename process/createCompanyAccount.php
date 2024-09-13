<?php
    require_once("../inc/global.php");

if(isLoggedIn()){
    // user is already logged into an account, so redirect them to the dashboard
    header("Location: /../dashboard.php");
    die();
}

if(!$_POST['createCompany']){
    //user didn't click the submit button on the signup form
    header("Location: ../new-company.php");
    die('post error');
}

$name = mysqli_real_escape_string($connect, strip_tags(@$_POST['company_name']));
$industry_id = mysqli_real_escape_string($connect, strip_tags(@$_POST['company_industry_id']));
$linkedin = mysqli_real_escape_string($connect, strip_tags(@$_POST['company_linkedin']));
$website = mysqli_real_escape_string($connect, strip_tags(@$_POST['company_website']));
$address = mysqli_real_escape_string($connect, strip_tags(@$_POST['company_hq_address']));
$agree = mysqli_real_escape_string($connect, strip_tags(@$_POST['agree']));

// make the user status 1 (standard user) by default
$isAdmin = 0;

if($name == "" || $industry_id == ""){
    // make sure all fields have data
    $_SESSION['signUpResult'] = "signup-error-missing-fields";
    header("Location: ../new-company.php");
    die('missing fields');
}

if($agree != "true"){
    //Make sure to agree to terms of service
    $_SESSION['signUpResult'] = "signup-error-tos";
    header("Location: ../new-company.php");
    die('not agree');
}


if($uploadFilename = uploadImage($_FILES["company_logo"])){

    $stmt = $connection->prepare("INSERT INTO company (company_name, company_industry_id, company_linkedin, company_website, company_hq_address, company_logo) VALUES('$name', '$industry_id', '$linkedin', '$website', '$address', '$uploadFilename')");
    $stmt->bind_param("is", $name, $industry_id, $linkedin, $website, $address, $uploadFilename);
    $stmt->execute();

    if($stmt){
        $_SESSION['companyId'] = mysqli_insert_id($connect);
        $_SESSION['signUpResult'] = "signup-success";
        header("Location: ../new-employee.php");
        die('success');
    }else{
        $_SESSION['signUpResult'] = "signup-error";
        header("Location: ../new-company.php");
        die('database error');
    }

}else{
    die('Error uploading image');
}

?>
