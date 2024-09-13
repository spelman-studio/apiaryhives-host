<?php
require_once("inc/global.php");



if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}

$user = getUserDetails($_SESSION['loggedIn_userId']);

switch(@$_SESSION['reportResult']){
    case "report-error-missing-fields":
    case "report-error":
        echo "<div class='alert alert-danger'>There was an error submitting your report. Please try again, or contact us for assistance.</div>";
        unset($_SESSION['reportResult']);
            break;
}
?>

<html>
    <head>
        <?php require_once("inc/head.php"); ?>
        <title>Report an Incident | Apiary Hives</title>
    </head>
    <body>
        <!--Navbar-->
        <?php require_once("inc/navbar.php"); ?>

        <div class="report-box">
            <h1>New Report</h1>
            <!--Report Form-->
            <form className="sign-up-box" action="process/newReport.php" method="post">
                <div class="form-row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check-anon" value="1" name="isAnon"/>
                        <label class="form-check-label">Submit Report Anonymously</label> 
                    </div>
                </div>
                <div class="form-group">
                </div>
                <div class="form-group">
                    <label for="report_department">Department<sup class="required">*</sup></label>
                    <select name="report_department" id="dept">
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
                <div class="form-group">
                    <div class="form-row">
                        <label for="suspects">Employee(s) causing problem(s)<sup class='required'>*</sup></label>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Full Name (1)" name="suspect[]" required />
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Full Name (2)" name="suspect[]"/>
                        </div>
                    </div> 
                    <br/>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Full Name (3)" name="suspect[]"/>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Full Name (4)" name="suspect[]"/>
                        </div>
                    </div>
                    <br/>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Full Name (5)" name="suspect[]"/>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Full Name (6)" name="suspect[]"/>
                        </div>
                    </div>
                    <br/>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Full Name (7)" name="suspect[]"/>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Full Name (8)" name="suspect[]"/>
                        </div>
                    </div> 
                </div>
                <div class="form-group">
                    <label for="report-description">Date Started<sup class="required">*</sup></label>
                    <input type="date" class="form-control" name="concerns_date_started" required />
                </div>
                <div class="form-group">
                    <label for="report-description">Description<sup class="required">*</sup></label>
                    <textarea class="form-control" id="report-description" rows="3" type="text" name="concerns_description" placeholder="Description of report" required></textarea>
                </div>
                <input type="submit" name="newReport" class="btn btn-primary" :hover value="Submit" />
            </form>
        </div>
    </body>
</html>