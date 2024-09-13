<?php
require_once("inc/global.php");?>
<html>
    <head>
        <?php require_once("inc/head.php"); ?>
        <title>Create Employee | Apiary Hives</title>
    </head>
    <body>
        <!--Navbar-->
        <?php require_once("inc/navbarindex.php"); ?>
<div class="container">
        <!-- Signup Errors -->
        <?php
            switch(@$_SESSION['createEResult']){
                case "signup-error-missing-fields":
                    echo "<div class='alert alert-danger'>Error: Missing information. Please fill out all the fields.</div>";
                    unset($_SESSION['createEResult']);
                break;

                case "signup-error-password":
                    echo "<div class='alert alert-danger'>Error: Passwords do not match.</div>";
                    unset($_SESSION['createEResult']);
                break;

                case "signup-error-duplicate-email":
                    echo "<div class='alert alert-danger'>Error: That company email is already registered. If this is your account, you can <a href='login.php'>Login Here</a></div>";
                    unset($_SESSION['createEResult']);
                break;
            }
        ?>

        <!--Signup Form-->
        <h1 class="form-header">Create an employee account!</h1>
        <form class="sign-up-box" action="process/createEmployeeAccount.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="user-firstname">First Name<sup class="required">*</sup></label>
                <input type="text" class="form-control" id="user-firstname" name="user_firstname" required />
                </div>
                <div class="form-group col-md-6">
                <label for="user-lastname">Last Name<sup class="required">*</sup></label>
                <input type="text" class="form-control" id="user-lastname" name="user_lastname" required />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user-workemail">Company Email Address<sup class="required">*</sup></label>
                    <input type="email" class="form-control" id="user-workemail" name="user_company_email" required />
                </div>
                <br>
                <div class="form-group col-md-6">
                    <label for="user-personalemail">Personal Email Address</label>
                    <input type="email" class="form-control" id="user-personalemail" name="user_personal_email" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user-phonenumber">Phone Number</label>
                    <input type="text" class="form-control" id="user-phonenumber" name="user_phone"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="company-id">Company Id<sup class="required">*</sup></label>
                    <input type="number" class="form-control" id="company-id" name="user_company_id" required />
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="user-department">Department<sup class="required">*</sup></label>
                <select class="form-control" name="user_dep_id" id="user-department" required>
                    <option value="1">Human Resources</option>
                    <option value="2">Marketing</option>
                    <option value="3">Sales</option>
                    <option value="4">Information Technology</option>
                    <option value="5">Legal</option>
                    <option value="6">Operations</option>
                    <option value="7">Board of Directors</option>
                    <option value="8">Customer Service</option>
                    <option value="9">Onboarding</option>
                </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="user-position">Position/Title<sup class="required">*</sup></label>
                    <input type="text" class="form-control" id="user-position" name="user_position" required />
                </div>
            </div>
            <br>
            <div class="form-row">
                <label for="user-username">Username<sup class="required">*</sup></label>
                <input type="text" class="form-control" id="user-username" name="user_name" required />
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user-password">Password<sup class="required">*</sup></label>
                    <input type="password" class="form-control" id="user-password" name="user_password" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="user-confirmpassword">Confirm Password<sup class="required">*</sup></label>
                    <input type="password" class="form-control" id="user-confirmpassword" name="user_confirm_password" required />
                </div>
            </div>
            <div style="text-align: center;">
                <a href='/new-company.php'>Don't have a company? Create one...</a>
            </div>
            <div class="form-row">
                <button type="submit" class="btn btn-primary" :hover id="createAccount">Create Account</button>
            </div>
        </form>
</div>
        <!--Footer-->
        <?php require_once("inc/footer.php"); ?>
    </body>
</html>