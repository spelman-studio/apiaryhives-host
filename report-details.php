<?php
require_once("inc/global.php");


if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}
if(!isAdmin() && !isHr()){
    //header("Location: /dashboard.php");
    die("Not Admin or HR");
}


$id = (int) mysqli_real_escape_string($connect, @$_GET['id']);
if($id == 0){
    die("Invalid Report ID");
}


$sql = mysqli_query($connect, "SELECT * FROM concerns WHERE concerns_id='$id' ORDER BY concerns_id DESC limit 1");
if(!$sql || mysqli_num_rows($sql) != 1){
    die("Cannot Find  Report");
}


$row = mysqli_fetch_array($sql);
$userId = stripslashes($row['concerns_user_id']);
$description = stripslashes($row['concerns_description']);

$deptId = stripslashes($row['concerns_dept_id']);
$deptSql = mysqli_query($connect, "SELECT * FROM dept WHERE dept_id='$deptId' ORDER BY dept_id DESC limit 1");
if(!$deptSql || mysqli_num_rows($deptSql) != 1){
    $deptName = "Unknown";
}else{
    $deptRow = mysqli_fetch_array($deptSql);
    $deptName = stripslashes($deptRow['dept_name']);
}

$dateStarted = stripslashes($row['concerns_date_started']);
$dateStarted = date("M d, Y", strtotime($dateStarted));

$anonId = stripslashes($row['concerns_anon_id']);
if($anonId==0){
    $submittedByArray = getUserDetails($userId);
    $submittedByFirstName = $submittedByArray['user_firstname'];
    $submittedByLastName = $submittedByArray['user_lastname'];
} else {
    $submittedByFirstName = "Anonymous";
    $submittedByLastName = "";
}


$adminNotes = stripslashes($row['concerns_admin_notes']);
$status = $row['concerns_status'];

${"statusSelected".$status} = "selected";

//suspects list
$sql2 = mysqli_query($connect, "SELECT * FROM suspects WHERE suspects_concern_id='$id' ORDER BY suspects_id DESC");
if(!$sql2 || mysqli_num_rows($sql2) == 0){
    die("Cannot Find  Suspects for report: $id");
}

$suspectsList = "";
while($row2 = mysqli_fetch_array($sql2)){
    $suspectName = $row2['suspects_name'];
    //put all names into one string, separated by a comma and space
    $suspectsList .= "$suspectName, ";
}

// remove the last 2 characters of the string since they will be a comma and space
$suspectsList = substr($suspectsList, 0, -2);





?>
<html>
    <head>
         <?php require_once("inc/head.php"); ?>
        <title>Report Details | Apiary Hives</title>
    </head>
    <body>
        <?php require_once("inc/navbar.php"); ?>
        <div class="report-box">
            <h1>Report Details: <?php echo $id; ?></h1>
            <?php echo "Submitted by $submittedByFirstName $submittedByFirstName on $dateStarted"; ?>
            <hr />
            <form action="process/editReport.php" method="post">
                <label for="title">Report Identification Number: <?php echo $id; ?></label><br />
                <input type="hidden" name="concerns_id" value="<?php echo $id; ?>" readonly>
                <br/>
                <label for="suspects">Suspects</label><br />
                <textarea name="concerns_description" id="description" class="form-control" placeholder="Description" readonly><?php echo $suspectsList; ?></textarea>
               
                
               
                <br />
                <label for="description">Description</label><br />
                <textarea name="concerns_description" id="description" class="form-control" placeholder="Description" readonly><?php echo $description; ?></textarea>
                <br />
                <br />

                <label for="description">Department</label><br />
                <input type="text" name="department" value="<?php echo $deptName; ?>" class="form-control" readonly />
                <br />

                <label for="adminNotes">Admin/HR Notes<sup class="required">*</sup></label><br />
                <textarea name="adminNotes" id="adminNotes" class="form-control" placeholder="Description" required><?php echo $adminNotes; ?></textarea>
                <br />
                <label for="status">Status</label><br />
                <select name="status" id="status" class="form-control" required>
                        <option selected disabled>Choose Status<sup class="required">*</sup></option>
                        <option value='1' <?php echo @$statusSelected1; ?>>In Progress</option>
                        <option value='2' <?php echo @$statusSelected2; ?>>Resolved</option>
                </select>
                <input type="submit" name="editReport" class="btn btn-primary" value="Save Changes" />
            </form>
        </div>
    </body>
</html>