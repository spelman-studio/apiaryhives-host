<?php
require_once("inc/global.php");
require_once("inc/vendor/autoload.php");
use SendGrid\Mail\From;
use SendGrid\Mail\To;
use SendGrid\Mail\Mail;

$id = (int) mysqli_real_escape_string($connect, @$_GET['id']);
$key = mysqli_real_escape_string($connect, @$_GET['key']);

if($id == 0 || $key == "" || strlen($key) != 150){
    die("Invalid Request");
}



$sql = @mysqli_query($connect, "SELECT * FROM user WHERE user_id='$id' AND user_password_reset_key='$key' ORDER BY user_id DESC LIMIT 1") or die("DB ERROR");
    $nr = @mysqli_num_rows($sql);
    if(!$sql || mysqli_num_rows($sql) != 1){
        die("Cannot Find Request");
    }

    $row = mysqli_fetch_array($sql);
    $email = $row['user_company_email'];
    $userName = stripslashes($row['user_firstname']." ".$row['user_lastname']);

// die("ok");


if(@$_POST['user_password']){
    @session_destroy();
    session_start();
    $password1 = mysqli_real_escape_string($connect, htmlentities(@$_POST['user_password']));
    $passwordConfirm = mysqli_real_escape_string($connect, htmlentities(@$_POST['user_password_confirm']));

    if($password1 == "" || $passwordConfirm == ""){
        // make sure both password and confirm pass have a value
        $_SESSION['loginResult'] = "reset-pass-error-requirements";
        header("Location: reset-password.php?id=$id&key=$key");
        die("Missing Fields");
    }

    if($password1 != $passwordConfirm){
        // make sure pass and confirm pass match
        $_SESSION['loginResult'] = "reset-pass-error-requirements";
        header("Location: reset-password.php?id=$id&key=$key");
        die("Passwords Must Match");
    }

    if(strlen($password1) < 8){
        // make sure pass is at least 8 characters
        $_SESSION['loginResult'] = "reset-pass-error-requirements";
        header("Location: reset-password.php?id=$id&key=$key");
        die("Passwords Must Match");
    }

    $passHash = password_hash($password1, PASSWORD_DEFAULT);

    $sql2 = mysqli_query($connect, "UPDATE user SET user_password='$passHash', user_password_reset_key=null WHERE user_id='$id' ORDER BY user_id DESC LIMIT 1");
    if($sql2){

        // pass reset success - send email to user

        $loginUrl = "https://".$_SERVER['HTTP_HOST']."/login.php";

        $bodyText = "Hello $userName,<br /><br />
        This email is to confirm that your password has been successfully reset!";

        $sgFrom = new From($sendgridFromEmail, "Apiary Hives");
        $sgTo = [
            new To($email, $userName,
                [
                    'SUBJECT' => "Password Reset Confirmation",
                    'BODY_TEXT' => $bodyText,
                    'BUTTON_URL' => $loginUrl,
                    'BUTTON_TEXT' => "Login",

                ]
            )
        ];

        $sgEmail = new Mail($sgFrom, $sgTo);

        $sgEmail->setTemplateId($sendgridTemplateId);
        $sendgrid = new \SendGrid($sendgridApiKey);
        $sendgrid->send($sgEmail);


        $_SESSION['loginResult'] = "reset-pass-success";
        header("Location: login.php");
        die("Pass reset success");
    }else{
        $_SESSION['loginResult'] = "reset-pass-error";
        header("Location: login.php");
        die("Pass reset error");
    }

    
   
}
?>
<html>
    <head>
        <?php require_once("inc/head.php"); ?>
        <title>Reset Password | Apiary Hives</title>
    </head>
    <body>
        <!--Navbar-->
        <?php require_once("inc/navbar.php"); ?>
        <div class="container">
            <h1>Reset Password</h1>
            Please enter a new password. Your new password should be at least 8 characters, and contain letters, numbers, and symbols.
            <!--PHP Login Error Popups-->
            <?php
            switch(@$_SESSION['loginResult']){
                case "reset-pass-error-requirements":
                    echo "<div class='alert alert-danger'>There was an error resetting your password. Please ensure password and confirm password match, and are at least 8 characters.</div>";
                    unset($_SESSION['loginResult']);
                break;
            }
            ?>
            <!--Login Form-->
            <form action="/reset-password.php?id=<?php echo $id; ?>&key=<?php echo $key; ?>" method="post">
                <div class="form-group">
                    <label for="user_password">New Password</label>
                    <input type="password" class="form-control" placeholder="New Password" id="user_password" name="user_password" minlength="8" required />
                </div>
                <br /><br />

                 <div class="form-group">
                    <label for="user_password_confirm">Confirm New Password</label>
                    <input type="password" class="form-control" placeholder="Confirm New Password" id="user_password_confirm" name="user_password_confirm" minlength="8" required />
                </div>
              
                <br></br>

                <input type="submit" name="submitLogin" class="btn btn-primary" value="Save New Password" />
            </form>
        </div>
    </body>
</html>