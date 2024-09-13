<?php
require_once("inc/global.php");


if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}

$id = $_SESSION['loggedIn_userId'];
 

$sql = mysqli_query($connect, "SELECT * FROM user WHERE user_id='$id' ORDER BY user_id DESC limit 1");
if(!$sql || mysqli_num_rows($sql) != 1){
    die("Cannot Find User");
}


$row = mysqli_fetch_array($sql);
$firstname = stripslashes($row['user_firstname']);
$lastname = stripslashes($row['user_lastname']);
$username = stripslashes($row['user_name']);
$workEmail = stripslashes($row['user_company_email']);
$phone = stripslashes($row['user_phone']);
$personalEmail = stripslashes($row['user_personal_email']);
$isAdmin = stripslashes($row['user_is_admin']);
$isAdminStr = $userIsAdminArr[$isAdmin];

$pronouns = stripslashes($row['user_pronouns']);
$bio = stripslashes($row['user_bio']);
$pfp = stripslashes($row['user_pfp']);
$departmentNum = stripslashes($row['user_dep_id']);
$department = getDepartmentName($departmentNum);
$position = stripslashes($row['user_position']);

?>
<html>
    <head>
         <?php require_once("inc/head.php"); ?>
        <title>Account Details | Apiary Hives</title>
    </head>
    <body>
       <?php require_once("inc/navbar.php"); ?>
        <div class="container">
            <h1>Account Details: <?php echo "$firstname $lastname"; ?></h1>

             <?php
            switch(@$_SESSION['userEdit']){
                case "edit-user-success":
                    echo "<div class='alert alert-success'>Your account details have been updated.</div>
                    ";
                    unset($_SESSION['userEdit']);
                break;
                case "edit-user-error":
                    echo "<div class='alert alert-danger'>Error: Unable to edit your account details.</div>
                    ";
                    unset($_SESSION['userEdit']);
                break;
                case "edit-user-error-missing-fields":
                    echo "<div class='alert alert-danger'>Error: Please fill in all required fields.</div>
                    ";
                    unset($_SESSION['userEdit']);
                break;

            }
            ?>
            <hr />
            <form action="process/editMyAccount.php" method="post" enctype="multipart/form-data">
                <!-- <input type="hidden" name="user_id" value="<?php echo $id; ?>"> -->
                <!-- Dont store User ID here - the user could edit this and change someone elses account. Instead, use PHP to get the User ID from the session variable -->

                <label for="firstName">First Name<sup class="required">*</sup></label><br />
                <input type="text" name="user_firstname" id="firstName" class="form-control" placeholder="First Name" value="<?php echo $firstname; ?>" required />
                <br />

                <label for="lastName">Last Name<sup class="required">*</sup></label><br />
                <input type="text" name="user_lastname" id="lastName" class="form-control" placeholder="Last Name" value="<?php echo $lastname; ?>" required />
                <br />

                <label for="username">Username<sup class="required">*</sup></label><br />
                <input type="text" name="user_name" id="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>" required />
                <br />

                <label for="workEmail">Work Email Address</label><br />
                <input type="text" name="user_company_email" id="workEmail" class="form-control" placeholder="Work Email Address" value="<?php echo $workEmail; ?>" readonly />
                <br />

                <label for="personalEmail">Personal Email Address<sup class="required">*</sup></label><br />
                <input type="text" name="user_personal_email" id="personalEmail" class="form-control" placeholder="Personal Email Address" value="<?php echo $personalEmail; ?>" required/>
                <br />

                <label for="phone">Phone Number<sup class="required">*</sup></label><br />
                <input type="tel" name="user_phone" id="phone" class="form-control" placeholder="Phone Number" value="<?php echo $phone; ?>" required/>
                <br />

                <label for="department">Department</label><br />
                <input type="text" name="user_department" id="department" class="form-control" placeholder="Department" value="<?php echo $department; ?>" readonly />
                <br />

                <label for="position">Position/Title<sup class="required">*</sup></label><br />
                <input type="text" name="user_position" id="position" class="form-control" placeholder="Position" value="<?php echo $position; ?>" required/>
                <br />

                <label for="pronouns">Pronouns</label><br />
                <input type="text" name="user_pronouns" id="pronouns" class="form-control" placeholder="Pronouns" value="<?php echo $pronouns; ?>"/>
                <br />

                <label for="bio">Bio</label><br />
                <textarea name="bio" id="bio" class="form-control" placeholder="Bio"><?php echo $bio; ?></textarea>
                <br />

                <label for="department">Upload New Profile Picture (optional)</label><br />
                <?php
                if($pfp != "" && $pfp != null){
                    echo "<a href='/uploads/$pfp' target='_blank'><img src='/uploads/$pfp' class='img-responsive' style='max-height: 50px' alt='User Profile Picture' /></a>";
                }
                ?>
                <input type="file" name="user_pfp" id="pfp" class="form-control" accept="image/*" />
                <br />
                
                <label for="status">Account Status</label><br />
                <input type="text" name="status" id="status" class="form-control" value="<?php echo $isAdminStr; ?>" readonly />

                <input type="submit" name="editMyAccount" class="btn btn-primary" value="Save Changes" />
            </form>
        </div>    
    </body>        
</html>