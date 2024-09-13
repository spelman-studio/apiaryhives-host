<?php
require_once("inc/global.php");


if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}

$id = (int) mysqli_real_escape_string($connect, @$_GET['id']);
if($id == 0){
    die("Invalid User ID");
}

//only admin and onboarding can change these settings
if(!isAdmin() && !isOnboarding()){
    header("Location: /dashboard.php");
    die();
}
 

$sql = mysqli_query($connect, "SELECT * FROM user WHERE user_id='$id' ORDER BY user_id DESC limit 1");
if(!$sql || mysqli_num_rows($sql) != 1){
    die("Cannot Find  User");
}


$row = mysqli_fetch_array($sql);
$firstname = stripslashes($row['user_firstname']);
$lastname = stripslashes($row['user_lastname']);
$username = stripslashes($row['user_name']);
$workEmail = stripslashes($row['user_company_email']);
$phone = stripslashes($row['user_phone']);
$personalEmail = stripslashes($row['user_personal_email']);
$isAdmin = stripslashes($row['user_is_admin']);
$pronouns = stripslashes($row['user_pronouns']);
$bio = stripslashes($row['user_bio']);
$pfp = stripslashes($row['user_pfp']);
$departmentNum = stripslashes($row['user_dep_id']);
$department = getDepartmentName($departmentNum);
$position = stripslashes($row['user_position']);



${"statusSelected".$isAdmin} = "selected";
// makes a dynamic variable for use on the acc status dropdown
// it makes a variable called $statusSelected, with the status ID appended to the end

?>
<html>
    <head>
         <?php require_once("inc/head.php"); ?>
        <title>Account Details | Apiary Hives</title>
    </head>
    <body>
       <?php require_once("inc/navbar.php"); ?>
        <div class="container">
            <h1>Employee Account Details: <?php echo "$firstname $lastname"; ?></h1>
            <hr />
            <form action="process/editUser.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $id; ?>">

                <label for="user_firstname">First Name<sup class="required">*</sup></label><br />
                <input type="text" name="user_firstname" id="user_firstname" class="form-control" placeholder="Full Name" value="<?php echo $firstname; ?>" required />
                <br />

                <label for="user_lastname">Last Name<sup class="required">*</sup></label><br />
                <input type="text" name="user_lastname" id="user_lastname" class="form-control" placeholder="Full Name" value="<?php echo $lastname; ?>" required />
                <br />

                <label for="username">Username<sup class="required">*</sup></label><br />
                <input type="text" name="user_name" id="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>" required />
                <br />

                <label for="workEmail">Work Email Address<sup class="required">*</sup></label><br />
                <input type="text" name="user_company_email" id="workEmail" class="form-control" placeholder="Work Email Address" value="<?php echo $workEmail; ?>" required />
                <br />

                <label for="personalEmail">Personal Email Address<sup class="required">*</sup></label><br />
                <input type="text" name="user_personal_email" id="personalEmail" class="form-control" placeholder="Personal Email Address" value="<?php echo $personalEmail; ?>" required/>
                <br />

                <label for="phone">Phone Number<sup class="required">*</sup></label><br />
                <input type="tel" name="user_phone" id="phone" class="form-control" placeholder="Phone Number" value="<?php echo $phone; ?>" required/>
                <br />

                <label for="department">Department<sup class="required">*</sup></label><br />
                <select name="department" id="department" class="form-control">
                    <?php
                    $sql2 = mysqli_query($connect, "SELECT * FROM dept ORDER BY dept_name ASC");
                    while($row2 = mysqli_fetch_array($sql2)){
                        $deptId = $row2['dept_id'];
                        $deptName = stripslashes($row2['dept_name']);
                        if($deptId == $departmentNum){
                            $deptSelected = "selected";
                        }else{
                            $deptSelected = "";
                        }

                        echo "<option value='$deptId' $deptSelected>$deptName</option>";

                    }
                    ?>
                </select>
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

                <label for="department">Profile Picture</label><br />
                 <?php
                if($pfp != "" && $pfp != null){
                    echo "<a href='/uploads/$pfp' target='_blank'><img src='/uploads/$pfp' class='img-responsive' style='max-height: 50px' alt='User Profile Picture' /></a>";
                }
                ?>
                <input type="file" name="user_pfp" id="pfp" class="form-control" accept="image/*" />
                <br />

                <label for="user_is_admin">Account Type<sup class="required">*</sup></label><br />
                <select name="user_is_admin" id="user_is_admin" class="form-control" required>
                        <option selected disabled>Choose Status</option>
                        <option value='0' <?php echo @$statusSelected0; ?>>Standard</option>
                        <option value='1' <?php echo @$statusSelected1; ?>>Administrator</option>
                </select>

                <input type="submit" name="editUser" class="btn btn-primary" value="Save Changes" />
            </form>

            <?php
            if(@$_SESSION['loggedIn_userId'] != $id ){
                //only show this form if this is not your own account. you cannot delete your own account
            ?>
            
            <form style="display: none" id="deleteUserForm" action="process/deleteUser.php" method="post">
                <input type="hidden" name="userId" value="<?php echo $id; ?>">
            </form>
            <a href="#" class="btn btn-danger" id="deleteUserBtn">Delete Account</a>

            <script>
                $(document).ready(function(){
                    $("#deleteUserBtn").click(function(){
                        if(confirm("Are you sure you wish to delete this user?") == true){
                        $("#deleteUserForm").submit();
                        }
                    });
                });
            </script>
            <?php } ?>
   </div>
    </body>
</html>