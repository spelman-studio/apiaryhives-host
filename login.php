<?php
require_once("inc/global.php");

if(@$_POST['user_company_email']){
    @session_destroy();
    session_start();

    $email = mysqli_real_escape_string($connect, htmlentities(@$_POST['user_company_email']));
    $password = mysqli_real_escape_string($connect, htmlentities(@$_POST['user_password']));
    if($email == "" || $password == ""){
        $_SESSION['loginResult'] = "error-empty-fields";
        header("Location: login.php");
        die('Missing fields');
    }

    $sql = @mysqli_query($connect, "SELECT * FROM user WHERE user_company_email='$email' ORDER BY user_id DESC LIMIT 1") or die("DB ERROR");
    
    $nr = @mysqli_num_rows($sql);

    if($nr == 1){
        $row = mysqli_fetch_array($sql);
        if(password_verify($password,$row['user_password'])){
            $_SESSION['loggedIn'] = true;
            $_SESSION['loggedIn_userId'] = $row['user_id'];
            header("Location: dashboard.php");
            die('logged in');
        } else {
            $_SESSION['loginResult'] = "error-password";
            header("Location: login.php");
            die('error password');
        }
    }else{
        $_SESSION['loginResult'] = "error-password";
            header("Location: login.php");
            die('couldn\'t find user');
    }  
}
?>

<html>
    <head>
        <?php require_once("inc/head.php"); ?>
        <title>Login | Apiary Hives</title>
    </head>
    <body>
        <!--Navbar-->
        <?php require_once("inc/navbarindex.php"); ?>
        <div class="container">
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
                case "forgot-pass-success":
                echo "<div class='alert alert-success'>Success! Please check your email for a password reset link.</div>";
            unset($_SESSION['loginResult']);
                break;
                case "forgot-pass-error":
                echo "<div class='alert alert-danger'>There was an error sending you a password reset link. Please try again, or contact us for assistance.</div>";
            unset($_SESSION['loginResult']);
                break;
                case "reset-pass-success":
                echo "<div class='alert alert-success'>Your password has been reset! Login below.</div>";
            unset($_SESSION['loginResult']);
                break;
                case "reset-pass-error":
                echo "<div class='alert alert-danger'>There was an error resetting your password. Please try again later.</div>";
            unset($_SESSION['loginResult']);
                break;

            }   
            ?>
            <!--Login Form-->
            <div class="login-box">
                <h1 class="form-header">Employee Login</h1>
                <form action="/login.php" method="post">
                    <div class="form-group">
                        <label for="user_company_email">Email address</label>
                        <input type="email" class="form-control" placeholder="Enter email" name="user_company_email" id="user_company_email"/>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="user_password">Password</label>
                        <input type="password" class="form-control" placeholder="Password" id="user_password" name="user_password"/>
                    </div>
                    <br></br>
                    <div id="createAccount" class="create-account-link create-account-link:hover" style="text-align: center;">
                        <a href='../new-employee.php'>Don't have an account? Create one...</a>
                        <hr>
                        <a href='../forgot-password.php'>Reset Password</a>
                    </div>
                    <input type="submit" name="submitLogin" class="btn btn-primary" value="Login" :hover/>
                </form>
            </div>
        </div>
    </body>
</html>