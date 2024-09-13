<?php
require_once("inc/global.php");


if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}

?>
<html>
    <head>
         <?php require_once("inc/head.php"); ?>
        <title>Staff Roster | Apiary Hives</title>
        <style>
            .postPreview{
                padding: 4 10 4 10;
                background: #ccc;
                margin-bottom: 10px;

            }

            .postPreview h2{
                font-size: 25px !important;
            }
        </style>
    </head>
    <body>
       <?php require_once("inc/navbar.php"); ?>

        <div class="user-box">

            <?php
            switch(@$_SESSION['userEdit']){
                case "user-delete-success":
                    echo "<div class='alert alert-success'>User account has been deleted.</div>
                    ";
                    unset($_SESSION['userEdit']);
                break;

                case "user-delete-error":
                    echo "<div class='alert alert-danger'>There was an error deleting this user account.</div>
                    ";
                    unset($_SESSION['userEdit']);
                break;

                case "edit-user-success":
                    echo "<div class='alert alert-success'>User details have been updated.</div>
                    ";
                    unset($_SESSION['userEdit']);
                break;

                case "edit-user-error-missing-fields":
                case "edit-user-error":
                    echo "<div class='alert alert-danger'>There was an error editing this user. Please try again later.</div>
                    ";
                    unset($_SESSION['userEdit']);
                break;

                
            }
            ?>
            <h1>Employee Accounts</h1>
            <hr />


                <form action="users.php" method="get">
                    <div class="search-bar">
                        <input type="text" name="q" id="searchUsers" class="form-control search-bar-input" placeholder="Search Users" value="<?php echo @$_GET['q']; ?>" />
                        <input type="submit" class="search-btn" value="Search" />
                    </div>
                </form>


            <table style="border:1;" class='table'>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email Address</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Pronouns</th>
                </tr>
                <?php

                if(@$_GET['q'] != ""){
                    $searchTerm = mysqli_real_escape_string($connect, @$_GET['q']);
                    $sql = mysqli_query($connect, "SELECT * FROM user WHERE '$searchTerm' IN (user_name, user_firstname, user_lastname, user_personal_email, user_company_email, user_phone) ORDER BY user_id DESC");

                }else{
                    $sql = mysqli_query($connect, "SELECT * FROM user ORDER BY user_id DESC");
                }
                
                while($row = mysqli_fetch_array($sql)){
                    $id = $row['user_id'];
                    $firstname = stripslashes($row['user_firstname']);
                    $lastname = stripslashes($row['user_lastname']);
                    $username = stripslashes($row['user_name']);
                    $email = stripslashes($row['user_company_email']);
                    $isAdmin = stripslashes($row['user_is_admin']);
                    $departmentNum = stripslashes($row['user_dep_id']);
                    $departmentName = getDepartmentName($departmentNum);
                    $pronouns = stripslashes($row['user_pronouns']);
                    $position = stripslashes($row['user_position']);

                  

                    switch($isAdmin){
                        // switch() is similar to if/else
                        case 0:
                        $status = "Standard";
                        break;

                        case 1:
                        $status = "Administrator";
                        break;
                    }

                    echo "<tr>
                    <td><a href='user-profile.php?user_id=$id'>$firstname $lastname</a></td>
                    <td>$username</td>
                    <td>$email</td>
                    <td>$departmentName</td>
                    <td>$position</td>
                    <td>$pronouns</td>";
                }
                ?>
            </table>
        </div>
    </body>
</html>