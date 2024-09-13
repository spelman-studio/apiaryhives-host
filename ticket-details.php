<?php
require_once("inc/global.php");


if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}

if(!isAdmin() && !isIt()){
    header("Location: /dashboard.php");
    die();
}


$id = (int) mysqli_real_escape_string($connect, @$_GET['id']);
if($id == 0){
    die("Invalid Report ID");
}


$sql = mysqli_query($connect, "SELECT * FROM it WHERE it_id='$id' ORDER BY it_id DESC limit 1");
if(!$sql || mysqli_num_rows($sql) != 1){
    die("Cannot Find  Report");
}


$row = mysqli_fetch_array($sql);
$userId = stripslashes($row['it_user_id']);
$submittedByArray = getUserDetails($userId);
                    $submittedByFirstName = $submittedByArray['first_name'];
                    $submittedByLastName = $submittedByArray['last_name'];

                $persistId = stripslashes($row['it_persistance_id']);
                $sqlPersist = mysqli_query($connect, "SELECT * FROM persistance WHERE persistance_id='$persistId' ORDER BY persistance_id DESC LIMIT 1");
                    $rowPersist = mysqli_fetch_array($sqlPersist);
                    $persistName = $rowPersist['persistance_description'];


                $reoccurId = stripslashes($row['it_reoccurance_id']);
                $sqlReoccur = mysqli_query($connect, "SELECT * FROM reoccurrence WHERE reoccurrence_id='$reoccurId' ORDER BY reoccurrence_id DESC LIMIT 1") or die(mysqli_error($connect));
                    $reoccurRow = mysqli_fetch_array($sqlReoccur);
                    $reoccurName = $reoccurRow['reoccurrence_description'];

                $description = stripslashes($row['it_description']);


                $locationId = stripslashes($row['it_location_id']);
                $sqlLocation = mysqli_query($connect, "SELECT * FROM location WHERE location_id='$locationId' ORDER BY location_id DESC LIMIT 1");
                    $rowLocation = mysqli_fetch_array($sqlLocation);
                    $locationName = $rowLocation['location_description'];


                $officeNum = stripslashes($row['it_office_number']);
                if($officeNum != null && $officeNum != 0){
                    $officeNum = "(#$officeNum)";
                }else{
                    $officeNum = "";
                }

                $dateFiled = $row['it_date_filed'];
                $dateFiled = date("M d, Y", strtotime($dateFiled));
                
                $status = $row['it_status'];

$itNotes = stripslashes($row['it_notes']);

${"statusSelected".$status} = "selected";
// makes a dynamic variable for use on the acc status dropdown
// it makes a variable called $statusSelected, with the status ID appended to the end

?>
<html>
    <head>
         <?php require_once("inc/head.php"); ?>
        <title>Ticket Details | Apiary Hives</title>
    </head>
    <body>
        <?php require_once("inc/navbar.php"); ?>
        <div class="report-box">
            <h1>Ticket Details: <?php echo $id; ?></h1>
            <?php echo "Submitted by $submittedByFirstName $submittedByLastName on $dateFiled"; ?>
            <hr />
            <form action="process/editTicket.php" method="post">
                <input type="hidden" name="it_id" value="<?php echo $id; ?>" readonly />

                <label for="suspects">Location</label><br />
                <input type="text" name="it_location_id"class="form-control" placeholder="Location" value="<?php echo $locationName; ?>" readonly />
                <br />

                <label for="it_office_number">Office Number</label><br />
                <input type="text" name="it_office_number" id="office_num" class="form-control" placeholder="Office Number" value="<?php echo $officeNum; ?>" readonly />
                <br />

                <label for="it_description">Description</label><br />
                <textarea name="it_description" id="description" class="form-control" placeholder="Description" readonly><?php echo $description; ?></textarea>
                <br />

                <label for="it_persistance_id">Persistance</label><br />
                <input type="text" name="it_persistance_id" id="persistance" class="form-control" placeholder="Persistance" value="<?php echo $persistName; ?>" readonly>
                <br />

                <label for="it_reoccurance_id">Reoccurance</label><br />
                <input type="text" name="it_reoccurance_id" id="reoccurance" class="form-control" placeholder="Reoccurance"  value="<?php echo $reoccurName; ?>" readonly>
                <br />

                <label for="notes">IT Notes<sup class="required">*</sup></label><br />
                <textarea name="it_notes" id="notes" class="form-control" placeholder="IT Notes" required><?php echo $itNotes; ?></textarea>
                <br />

                <label for="status">Status<sup class="required">*</sup></label><br />
                <select name="status" id="status" class="form-control" required>
                        <option selected disabled>Choose Status</option>
                        <option value='1' <?php echo @$statusSelected1; ?>>In Progress</option>
                        <option value='2' <?php echo @$statusSelected2; ?>>Resolved</option>
                </select>
                <input type="submit" name="editTicket" class="btn btn-primary" value="Save Changes" />
            </form>
        </div>
    </body>
</html>