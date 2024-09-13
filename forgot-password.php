<?php
require_once("inc/global.php");
require("inc/sendgrid/sendgrid-php.php");
use SendGrid\Mail\From;
use SendGrid\Mail\To;
use SendGrid\Mail\Mail;



if(@$_POST['user_company_email']){
    @session_destroy();
    session_start();
    $email = mysqli_real_escape_string($connect, htmlentities(@$_POST['user_company_email']));

    if($email == ""){
        $_SESSION['loginResult'] = "error-empty-fields";
        header("Location: forgot-password.php");
        die();
    }

    $sql = @mysqli_query($connect, "SELECT * FROM user WHERE user_company_email='$email' ORDER BY user_id DESC LIMIT 1") or die("DB ERROR");
    $nr = @mysqli_num_rows($sql);
    if($nr == 1){
        $row = mysqli_fetch_array($sql);
        $userId = $row['user_id'];
        $userName = stripslashes($row['user_firstname']." ".$row['user_lastname']);
        
        /* generate a random key to add security
            this ensures that someone cant guess the url by going to /reset-password.php?id=123
            instead, the url will look like /reset-password.php?id=123&key=xxxxxxxx

        */
        $passResetKey = randomString(150);
        $passResetLink = "https://".$_SERVER['HTTP_HOST']."/reset-password.php?id=$userId&key=$passResetKey";

        $bodyText = "Hello $userName,<br /><br />
        You have requested to reset your password on Apiary. If this was you, please use the following link to reset your password. If this wasn't you, you can ignore this message.";


        // add key to database
        mysqli_query($connect, "UPDATE user SET user_password_reset_key='$passResetKey' WHERE user_id='$userId' ORDER BY user_id DESC LIMIT 1");


        // send email to user using Sendgrid API

        $sgFrom = new From($sendgridFromEmail , "Apiary Hives");
        $sgTo = [
            new To($email, $userName,
                [
                    'SUBJECT' => "Reset Your Password",
                    'BODY_TEXT' => $bodyText,
                    'BUTTON_URL' => $passResetLink,
                    'BUTTON_TEXT' => "Reset Password",

                ]
            )
        ];

        $sgEmail = new Mail($sgFrom, $sgTo);

        $sgEmail->setTemplateId($sendgridTemplateId);
        $sendgrid = new \SendGrid($sendgridApiKey);

        if($sendgrid->send($sgEmail)){
            $_SESSION['loginResult'] = "forgot-pass-success";
            header("Location: login.php");
            die("Success!");
        }else{
            $_SESSION['loginResult'] = "forgot-pass-error";
            header("Location: login.php");
            die("Error sending password reset email");
        }
            

        
    }else{
        $_SESSION['loginResult'] = "error-password";
        header("Location: login.php");
        die();
    }  
}
?>
<html>
    <head>
        <?php require_once("inc/head.php"); ?>
        <title>Forgot Password | Apiary Hives</title>
    </head>
    <body>
        <!--Navbar-->
        <?php require_once("inc/navbar.php"); ?>
        <div class="container">
            <h1>Forgot Password</h1>
            If you forgot your password, please enter your <b>company</b> email address below. If your email exists in our system, you will receive a password reset link. Please be sure to check your spam folder.
            <!--PHP Login Error Popups-->
            <?php
            switch(@$_SESSION['loginResult']){
                case "error-password":
                 echo "<div class='alert alert-danger'>Error: Invalid password.</div>";
                 unset($_SESSION['loginResult']);
                break;
            
                case "error-empty-fields":
                    echo "<div class='alert alert-danger'>Error: Missing information. Please fill out all the fields.</div>";
                    unset($_SESSION['loginResult']);
                break;
            }
            ?>
            <!--Login Form-->
            <form action="/forgot-password.php" method="post">
                <div class="form-group">
                    <label for="user_company_email">Email address</label>
                    <input type="email" class="form-control" placeholder="Enter email" id="user_company_email" name="user_company_email"/>
                </div>
              
                <br></br>

                <input type="submit" name="submitLogin" class="btn btn-primary" value="Next" />
            </form>

            <!--Footer-->
            <?php require_once("inc/footer.php"); ?>
        </div>
    </body>
</html>