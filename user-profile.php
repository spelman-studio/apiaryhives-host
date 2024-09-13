<?php
require_once("inc/global.php");


if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}


$id = (int) mysqli_real_escape_string($connect, @$_GET['user_id']);
if($id == 0){
    die("Invalid User ID");
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

if($pronouns != "" && $pronouns != null){
    $pronouns = "($pronouns)";
} else {
    $pronouns = "";
}

if($pfp != "" && $pfp != null){
    if(file_exists("uploads/$pfp")){
        $pfp = "uploads/$pfp";
    }else{
        $pfp = $defaultProfilePic;
    }
}else{
    $pfp = $defaultProfilePic;
}

${"statusSelected".$isAdmin} = "selected";
// makes a dynamic variable for use on the acc status dropdown
// it makes a variable called $statusSelected, with the status ID appended to the end

?>

<html>
    <head>
        <?php require_once("inc/head.php"); ?>
        <title>Profile | Apiary Hives</title>
    </head>
    <body>
        <!--Navbar-->
        <?php require_once("inc/navbar.php"); ?>
        
        
        <div class="profile-box">
            <div>
                <?php
                echo "
                    <div>
                        <img src='$pfp' class='img-responsive profile-pfp' alt='Profile Picture' style='float:left;'/>
                        <span>
                            <div class='profile-username'>$username <span class='profile-pronouns'>$pronouns</span>
                            ";
                            if($id == $_SESSION['loggedIn_userId']){
                                //user id matches logged in user id, display link to edit profile
                                echo "<a href='settings.php'><img src='img/edit-button.png' alt='Edit Profile' class='profile-edit-btn'></a>";
                            }
                            echo "
                            </div>
                            <div class='profile-pronouns'>$position</div>
                        </span>
                    </div>
                    <hr class='rounded' style='border-top: 5px solid #4A3D34; border-radius: 5px; width:75%'>
                    <p class='profile-bio'>$bio</p>
                    ";
                ?>
                <?php
                    echo "";
                ?>
            </div>

            <div class="profile-contact">
                <?php
                    echo "
                        <ul>
                            <li><h2>Contact Info</h2></li>
                            <li><b>Name:</b> $firstname $lastname</li>
                            <li><b>Department:</b> $department</li>
                            <li><b>Company Email:</b> $workEmail</li>
                            <li><b>Personal Email:</b> $personalEmail</li>
                            <li><b>Phone Number:</b> $phone</li>
                        </ul>
                    ";
                ?>
            </div>
        </div>

        <br>
        <div class="profile-dashboard-box"> 
            <div class="profile-post-box">
                <?php
                $sql = mysqli_query($connect, "SELECT * FROM main_post WHERE main_post_user_id = $id ORDER BY main_post_id");
                while($row = mysqli_fetch_array($sql)){
                    $postId = $row['main_post_id'];
                    $postCaption = stripslashes($row['main_post_caption']);
                    $postImg = stripslashes($row['main_post_img']);
                    $postDept = stripslashes($row['main_post_dept_id']);
                    $postUser = stripslashes($row['main_post_user_id']);
                    
                    $user = getUserDetails($postUser);
                    $pfp = $user['pfp'];
                    $username = $user['username'];
                    $department = $departmentsArr[$postDept];

                    if($pfp != "" && $pfp != null){
                        if(file_exists("uploads/$pfp")){
                            $pfp = "uploads/$pfp";
                        }else{
                            $pfp = $defaultProfilePic;
                        }
                    }else{
                        $pfp = $defaultProfilePic;
                    }

                    if(strlen($postCaption) > 10){
                        // if the post is more than 10 characters, only show the first 100, and add a "... read more" link to the end. This helps the page look cleaner if the post is really long
                        $postCaption = substr($postCaption, 0, 10)." ... <a href='read-post.php?id=$postId'>read more</a>";
                    }

                    $postCaption = nl2br($postCaption);
                    // make new lines into a <br /> tag
                    
                    echo "
                    <div class='col-lg-4' style='height:250px; width:250px !important;'>
                        <a href='read-post.php?id=$postId'>
                        <figure class='caption-3 mb-0 shadow-sm p-3 bg-white' id='$postId'>
                            <a href='user-profile.php?user_id=$postUser'>
                                <img src='uploads/$postImg' alt='Post Image' class='w-100' style='height: 100%; width:auto; object-fit: cover;'>
                                <figcaption class='px-5 py-3 bg-white shadow-sm'>
                                    <p class='mb-0 text-small font-italic text-muted'>$postCaption</p>
                                </figcaption>
                            </a>
                        </figure>
                        </a>
                    </div>
                    ";
                }
                ?>
            </div>  
        </div>

        <button onclick="topFunction()" id="top-btn" title="Go to top">&#8593;</button>

        <script>
            // Get the button
            let mybutton = document.getElementById("top-btn");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
                location.reload();
            }
        </script>

        <!-- Announcement Sidebar -->
        <nav id="sidebar-right" class="sidebar">
            <ul class="list-unstyled components">
                <div class="sidebar-header">Company Announcements</div>
                <?php
                $sql = mysqli_query($connect, "SELECT * FROM announce WHERE announce_dept_id = '0' ORDER BY announce_id DESC LIMIT 5");
                if (mysqli_num_rows($sql) > 0) {
                    while($row = mysqli_fetch_array($sql)){
                        $ancId = $row['announce_id'];
                        $ancCaption = stripslashes($row['announce_caption']);
                        $ancImg = stripslashes($row['announce_img']);
                        $ancDept = stripslashes($row['announce_dept_id']);
                        $ancUser = stripslashes($row['announce_user_id']);

                        if(strlen($ancCaption) > 100){
                            // if the post is more than 100 characters, only show the first 100, and add a "... read more" link to the end. This helps the page look cleaner if the post is really long
                            $ancCaption = substr($ancCaption, 0, 94)." ... <span class='small font-weight-light'>read more</span>";
                        }

                        $ancCaption = nl2br($ancCaption);
                        // make new lines into a <br /> tag

                        echo "<li><a href='read-anc.php?id=$ancId'>$ancCaption</a></li>";
                    }
                } else {
                    echo "<li><a>No announcements made!</a></li>";
                }
                ?>
                <br>
                <div class="sidebar-header"><?php echo $department;?> Announcements</div>
                <?php
                $sql = mysqli_query($connect, "SELECT * FROM announce WHERE announce_dept_id = $departmentNum ORDER BY announce_id DESC LIMIT 5");
                if(mysqli_num_rows($sql)>0){
                    while($row = mysqli_fetch_array($sql)){
                        $ancId = $row['announce_id'];
                        $ancCaption = stripslashes($row['announce_caption']);
                        $ancImg = stripslashes($row['announce_img']);
                        $ancDept = stripslashes($row['announce_dept_id']);
                        $ancUser = stripslashes($row['announce_user_id']);

                        if(strlen($ancCaption) > 100){
                            // if the post is more than 100 characters, only show the first 100, and add a "... read more" link to the end. This helps the page look cleaner if the post is really long
                            $ancCaption = substr($ancCaption, 0, 94)." ... <span class='small font-weight-light'>read more</span>";
                        }

                        $ancCaption = nl2br($ancCaption);
                        // make new lines into a <br /> tag

                        echo "<li><a href='read-anc.php?id=$ancId'>$ancCaption</a></li>";
                    }
                } else {
                    echo "<li><a>No announcements made!</a></li>";
                }
                ?>
            </ul>
        </nav>
    </body>
</html>