<?php
require_once("inc/global.php");


if(!isLoggedIn()){
    header("Location: /login.php");
    die();
}

$id = (int) mysqli_real_escape_string($connect, @$_GET['id']);
if($id == 0){
    die("Invalid Post ID");
}


$sql = mysqli_query($connect, "SELECT * FROM announce WHERE announce_id='$id' ORDER BY announce_id DESC LIMIT 1");
if(!$sql || mysqli_num_rows($sql) != 1){
    die("Cannot Find Post");
}

$row = mysqli_fetch_array($sql);
$ancCaption = stripslashes($row['announce_caption']);
$ancImg = stripslashes($row['announce_img']);
$ancDept = stripslashes($row['announce_dept_id']);
$ancUser = stripslashes($row['announce_user_id']);
$myUserId = (int) @$_SESSION['loggedIn_userId'];

// check if this user already viewed this announcement. if not, add a new row to db to show they viewed it
$sql2 = mysqli_query($connect, "SELECT * FROM announce_views WHERE announce_id='$id' AND announce_view_user='$myUserId'");
if(mysqli_num_rows($sql2) == 0){
    mysqli_query($connect, "INSERT INTO announce_views (announce_id, announce_view_user) VALUES('$id', '$myUserId')");
}


//get number of views
$sql3 = mysqli_query($connect, "SELECT * FROM announce_views WHERE announce_id='$id'");
$numViews = mysqli_num_rows($sql3);
if($numViews == 1){
    $numViewsStr = "Viewed by 1 person";
}else{
    $numViewsStr = "Viewed by $numViews people";
}

?>
<html>
    <head>
        <?php require_once("inc/head.php"); ?>
        <title>View Announcement | Apiary Hives</title>
        <script>
            $(document).ready(function(){
                $("#deletePostBtn").click(function(){
                    if(confirm("Are you sure you wish to delete this post?") == true){
                       $("#deletePostForm").submit();
                    }
                });
            });
        </script>
    </head>
    <body>
       <?php require_once("inc/navbar.php"); ?>

       <!-- Announcement View -->
       <div class="container">
        <div class="post-wrapper">
            <?php
                if ($ancImg != "" && $ancImg != null) {
                    echo "
                    <div class='post-column postPreview'>
                        <div><img src='uploads/$ancImg' alt='Post Image' class='post-img img-responsive'/></div>
                    </div>
                    ";
                }   
            ?>
            <div class="post-column">
                <div class="post-caption"><?php echo $ancCaption; ?></div>
            </div>
        </div>
        <div class="post-column">
                <?php
                //get num of views
                if($ancUser == $myUserId){
                    echo "<div>$numViewsStr</div>";
                }?>
                <ul>
                    <?php
                    //get users who viewed
                    $sql4 = mysqli_query($connect, "SELECT * FROM announce_views WHERE announce_id='$id'");
                    while($row4 = mysqli_fetch_array($sql4)){
                        $user = getUserDetails(stripslashes($row4['announce_view_user']));
                        $username = $user['username'];
                        echo "<li>$username</li>";
                    }
                    ?>
                </ul>
            </div>
       <br /><br />
       <a href='dashboard.php' class='btn btn-primary'>Return to Dashboard</a>
        <?php if(isAdmin() || $_SESSION['loggedIn_userId']==$ancUser){ ?>
            <a href='#' id='deletePostBtn' class='btn btn-danger'>Delete Announcement</a>
            <form style="display: none" id="deletePostForm" action="process/deleteAnc.php" method="post">
                <input type="hidden" name="main_post_id" value="<?php echo $id; ?>" />
            </form> 
        <?php } ?>
   </div>
    </body>
</html>