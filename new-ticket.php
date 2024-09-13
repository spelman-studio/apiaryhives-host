<?php
require_once("inc/global.php");



if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}

$user = getUserDetails($_SESSION['loggedIn_userId']);

switch(@$_SESSION['ticketResult']){
    case "ticket-error-missing-fields":
    case "ticket-error":
        echo "<div class='alert alert-danger'>There was an error submitting your ticket. Please try again, or contact us for assistance.</div>";
        unset($_SESSION['ticketResult']);
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

        <div class="ticket-box">
                <h1>New IT Ticket</h1>
                <!--Report Form-->
                <form className="sign-up-box" action="process/newTicket.php" method="post">
                
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label for="it_location_id">Location<sup class="required">*</sup></label>
                        <select name="it_location_id" id="location" class="form-control" required>
                            <option value="1">Remote</option>
                            <option value="2">In-Office</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="it_office_number">Office Number (If In-Office)</label>
                        <input type="text" id="it_office_number" name="it_office_number" class="form-control" placeholder="Office Number (If In-Office)" />
                    </div>

                    <div class="form-group">
                    <label for="it_persistance_id">Have you reported this issue before?<sup class="required">*</sup></label>
                    <select name="it_persistance_id" id="persist" class="form-control" required>
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="it_reoccurance_id">If so, when was the last time this issue was resolved?<sup class="required">*</sup></label>
                    <select name="it_reoccurance_id" id="reoccur" class="form-control" required>
                        <option value="1">Yesterday</option>
                        <option value="2">Last Week</option>
                        <option value="3">Last Month</option>
                        <option value="4">Last 3 Months</option>
                        <option value="5">Last 6-12 Months</option>
                        <option value="6">Never</option>
                    </select>
                </div>


                    <div class="form-group">
                        <label for="it_description">Description<sup class="required">*</sup></label>
                        <textarea class="form-control" id="it_description" rows="3" type="text" name="it_description" placeholder="Description" required></textarea>
                    </div>
                    
                <input type="submit" name="submitTicket" class="btn btn-primary" :hover value="Submit" />
                </form> 
        </div>
    </body>
</html>