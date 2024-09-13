<?php
require_once("inc/global.php");


if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}
$user = getUserDetails($_SESSION['loggedIn_userId']);
$companyId = $user['company_id'];
?>
<html>
    <head>
         <?php require_once("inc/head.php"); ?>
        <title>View Announcement | Apiary Hives</title>
        <script>
            $(document).ready(function(){
                $("#deleteAncBtn").click(function(){
                    if(confirm("Are you sure you wish to delete this announcement?") == true){
                       $("#deleteAncForm").submit();
                    }
                });
            });
        </script>
    </head>
    <body>
       <?php require_once("inc/navbar.php"); ?>
        <div class="anc-box">
            <h1>Announcements</h1>
            <?php

            if(isAdmin()){
            //show all announcements
            $sql = mysqli_query($connect, "SELECT * FROM announce WHERE announce_company_id = $companyId ORDER BY announce_id DESC");
            echo "<div class='font-light-weight'>Showing All Announcements</div>";
            }else{
            //show all company wide announcements, and announcements in users department
            $myUserArr = getUserDetails($_SESSION['loggedIn_userId']);
            $myDeptId = $myUserArr['department'];
            $myDeptName = $myUserArr['department_name'];
            echo "<div class='font-light-weight'>$myDeptName and Company Wide Announcements</div>";

            $sql = mysqli_query($connect, "SELECT * FROM announce WHERE announce_dept_id='0' OR announce_dept_id='$myDeptId' ORDER BY announce_id DESC");
            }



            while($row = mysqli_fetch_array($sql)){
            $ancId = $row['announce_id'];
            $ancCaption = stripslashes($row['announce_caption']);
            $ancImg = stripslashes($row['announce_img']);
            $ancDept = stripslashes($row['announce_dept_id']);
            if($ancDept == 0){
            $ancDeptName = "Company Wide";
            }else{
            $ancDeptName = getDepartmentName($ancDept);
            }

            $ancUser = stripslashes($row['announce_user_id']);

            $user = getUserDetails($ancUser);
            $pfp = $user['pfp'];
            $username = $user['username'];
            $position = $user['position'];

            if($pfp != "" && $pfp != null){
            if(file_exists("uploads/$pfp")){
            $pfp = "uploads/$pfp";
            }else{
            $pfp = $defaultProfilePic;
            }
            }else{
            $pfp = $defaultProfilePic;
            }

            if(strlen($ancCaption) > 300){
            $ancCaption = substr($ancCaption, 0, 300)."<a href='read-anc.php?id=$ancId'>... read more</a>";
            }

            $ancDate = $row['announce_createdate'];
            $ancDate = date("M d, Y", strtotime($ancDate));

            echo "
            <br>
            <div class='post-wrapper'>
                <div class='post-wrapper-inner'>";
                if ($ancImg != null && @file_exists("uploads/$ancImg")) {
                echo "
                    <div class='post-column post-preview'>
                        <div class='post-img-box'><a href='read-anc.php?id=$ancId'><img src='uploads/$ancImg' alt='announcement image' class='post-img-anc img-responsive'/></a></div>
                    </div>";
                    }
                    echo "
                    <div class='post-column post-caption-box'>
                        <div class='post-caption'><div>$ancCaption</div></div>
                        <hr class='rounded' style='border-top: 5px solid #4A3D34; border-radius: 5px; width:75%; margin:auto; display:block;'>
                        <div class='post-toggle'>
                            <div class='post-buttons'>
                                <div class='post-btns'>
                                    <a href='user-profile.php?user_id=$ancUser'><img src='$pfp' class='img-responsive post-icons post-pfp' alt='Profile Picture'/>
                                    <span class='post-username'>$username</span></a>
                                </div>
                                <div>
                                    $ancDeptName | $position $ancDate
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ";


            }
            ?>
        </div>
    </body>
</html>