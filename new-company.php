<?php
require_once("inc/global.php");?>
<html>
    <head>
        <?php require_once("inc/head.php"); ?>
        <title>Sign Up | Apiary Hives</title>
    </head>
    <body>
        <!--Navbar-->
        <?php require_once("inc/navbarindex.php"); ?>

        <!-- Signup Errors -->

        <?php
            switch(@$_SESSION['signUpResult']){
                case "signup-error-missing-fields":
                    echo "<div class='alert alert-danger'>Error: Missing information. Please fill out all the fields.</div>";
            unset($_SESSION['signUpResult']);
                break;
                case "signup-error-password":
                    echo "<div class='alert alert-danger'>Error: Passwords do not match.</div>";
            unset($_SESSION['signUpResult']);
                break;
                case "signup-error-tos":
                    echo "<div class='alert alert-danger'>Error: You must agree to the Terms of Service before creating an account.</div>";              
            unset($_SESSION['signUpResult']);
                break;
            }

            switch (@$_SESSION['signUpResult']) {
                case "signup-success":
                    echo "<div class='alert alert-success'>Company creation success! Your company ID is $companyId</div>";
                    unset($_SESSION['signUpResult']);
                    break;
            } 
        ?>

        <!--Signup Form-->
        <h1 class="form-header">Create a Company Account!</h1>
        <p class="form-subtitle">Employees can attach this to their employee accounts! This information can be edited by any admin account.</p>
        <form class="sign-up-box" action="process/createCompanyAccount.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label>Company Name<sup class="required">*</sup></label>
                <input type="text" class="form-control" name="company_name" required/>
            </div>
            <div class="form-group col-md-6">
                <label>Company Industry<sup class="required">*</sup></label>
                <select class="form-control" name="company_industry_id" required>
                    <option value="1">Accommodation and Food Services</option>
                    <option value="2">Administration, Business Support and Waste Management Services</option>
                    <option value="3">Agriculture, Forestry, Fishing and Hunting</option>
                    <option value="4">Arts, Entertainment and Recreation</option>
                    <option value="5">Construction</option>
                    <option value="6">Educational Services</option>
                    <option value="7">Finance and Insurance</option>
                    <option value="8">Healthcare and Social Assistance</option>
                    <option value="9">Information</option>
                    <option value="10">Manufactoring</option>
                    <option value="11">Mining</option>
                    <option value="12">Professional, Scientific and Technical Services</option>
                    <option value="13">Real Estate and Rental and Leasing</option>
                    <option value="14">Retail Trade</option>
                    <option value="15">Transportation and Warehousing</option>
                    <option value="16">Utilities</option>
                    <option value="17">Wholesale Trade</option>
                    <option value="18">Advisory and Financial Services</option>
                    <option value="19">Business Franchises</option>
                    <option value="20">Consumer Goods and Services</option>
                    <option value="21">Industrial Machinery, Gas and Chemicals</option>
                    <option value="22">Life Sciences</option>
                    <option value="23">Online Retail</option>
                    <option value="24">Retail Market Reports</option>
                    <option value="25">Specialist Engineering, Infrastructure and Contractors</option>
                    <option value="26">Technology</option>
                    <option value="27">Other Services</option>
                </select>
            </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Company LinkedIn URL</label>
                    <input type="text" class="form-control" name="company_linkedin"/>
                </div>
                <br>
                <div class="form-group col-md-6">
                    <label for="user-personalemail">Company Website URL<sup class="required">*</sup></label>
                    <input type="text" class="form-control" name="company_website"/>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user-phonenumber">Company HQ Address<sup class="required">*</sup></label>
                    <input type="text" class="form-control" name="company_hq_address"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="user-logo">Upload Company Logo<sup class="required">*</sup></label>
                    <input type="file" id="user-logo" class="form-control" name="company_logo"/>
                </div>
            </div>  
            <div class="form-row">
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="true" name="agree" required/>
                            <span class="form-check-sign"> I agree to the <a href="info/terms-of-service.pdf" target="_blank">terms of service</a>...<sup class="required">*</sup></span>
                        </label>
                    </div>
                </div>
                </div>
                <input type="submit" name="createCompany" class="btn-primary" :hover id="createCompany" value="Sign Up">
        </form>
    </body>
</html>