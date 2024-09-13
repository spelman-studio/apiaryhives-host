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


$sql = mysqli_query($connect, "SELECT * FROM main_post WHERE main_post_id='$id' ORDER BY main_post_id DESC LIMIT 1");
if(!$sql || mysqli_num_rows($sql) != 1){
    die("Cannot Find Post");
}

$row = mysqli_fetch_array($sql);
$postCaption = stripslashes($row['main_post_caption']);
$postImg = stripslashes($row['main_post_img']);
$postDept = stripslashes($row['main_post_dept_id']);
$postUser = stripslashes($row['main_post_user_id']);

$user = getUserDetails($postUser);
$pfp = $user['pfp'];
$username = $user['username'];

if($pfp != "" && $pfp != null){
    if(file_exists("uploads/$pfp")){
        $pfp = "uploads/$pfp";
    }else{
        $pfp = $defaultProfilePic;
    }
}else{
    $pfp = $defaultProfilePic;
}
?>
<html>
    <head>
         <?php require_once("inc/head.php"); ?>
        <title>View Post | Apiary Hives</title>
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

       <!-- Comment Result Alerts -->
       <?php
            switch(@$_SESSION['postResult']){
                case "comment-post-success":
                    echo "<div class='alert alert-success'>Comment has been posted!</div>";
                    unset($_SESSION['postResult']);
                break;

                 case "comment-post-error":
                    echo "<div class='alert alert-danger'>There was an error posting your comment. Please try again later.</div>";
                    unset($_SESSION['postResult']);
                break;
            }  
        ?>

       <!-- Post Display -->
        <div class="container">
        <div class="post-wrapper">
            <div class="post-wrapper-inner">
            <div class="post-column post-preview">
                <div>
                    <img src="<?php echo $pfp ?>" class="img-responsive post-icons post-pfp" alt="Profile Picture"/>
                    <span class="post-username"><?php echo $username ?></span>
                </div>
                <div><img src="uploads/<?php echo $postImg ?>" alt="Post Image" class="post-img img-responsive"/></div>
                <div class="post-caption"><?php echo $postCaption ?></div>
            </div>
            <div class="post-column">
                <div class="post-toggle">
                    <div class="post-buttons">
                        <div class="post-btns">
                        <div class="comment-box">
                            <form action="process/addComment.php" method="post">
                                <input type="hidden" name="for-type" value="main-post" />
                                <input type="hidden" name="for-id" value="<?php echo $id; ?>" />

                                <label for="addCommentText">Add Comment</label>
                                <textarea name="addCommentText" id="addCommentText" class="form-control" placeholder="Add a comment" required></textarea>

                            <script>
                                function liked() {
                                    var element = document.getElementById("like");
                                    element.classList.toggle("liked");
                                }

                                function disliked() {
                                    var element = document.getElementById("dislike");
                                    element.classList.toggle("disliked");
                                }
                            </script>

                                <button onClick="liked()" name="addCommentReaction" id="addCommentReaction" class="form-control post-btns like-button" value="L">
                                    <img src="img/like-icon.png" class="post-icons" alt="like button"></img>
                                </button>
                                <button onClick="disliked()" name="addCommentReaction" id="addCommentReaction" class="form-control post-btns dislike-button" value="D">
                                    <img src="img/dislike-icon.png" class="post-icons" alt="dislike button"></img>
                                </button>

                                <input type="submit" name="addComment" value="Save Comment" class="comment-btn"/>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <?php
                    $sql2 = mysqli_query($connect, "SELECT * FROM comments WHERE comment_for_type='main-post' AND comment_for_id='$id' ORDER BY comment_id DESC");
                    $numComments = mysqli_num_rows($sql2);
                    switch($numComments){
                    case 0:
                    echo "<b>No Comments Yet</b>";
                    break;

                    case 1:
                    echo "<b>1 Comment</b>";
                    break;

                    default:
                    echo "<b>$numComments Comments</b>";
                    break;
                    }


                    while($row2 = mysqli_fetch_array($sql2)){
                    $commentId = $row2['comment_id'];
                    $commentUser = $row2['comment_user'];
                    $commentText = $row2['comment_text'];
                    $commentReaction = $row2['comment_reaction'];

                    $commentUserArr = getUserDetails($commentUser);
                    $commentUserName = $commentUserArr['first_name']." ".$commentUserArr['last_name'];
                    $commentUserPfp = $commentUserArr['pfp'];
                    if($commentUserPfp != "" && $commentUserPfp != null){
                        if(file_exists("uploads/$commentUserPfp")){
                            $commentUserPfp = "uploads/$commentUserPfp";
                        }else{
                            $commentUserPfp = $defaultProfilePic;
                        }
                    }else{
                        $commentUserPfp = $defaultProfilePic;
                    }
                    

                    if($commentReaction == "L"){
                        $commentReaction = "Liked";
                    }else{
                        $commentReaction = "Disliked";
                    }

                    $commentDate = $row2['comment_date'];
                    $commentDate = date("M d, Y", strtotime($commentDate));

                    echo "<div style='border-bottom: 1px solid #ccc; overflow: hidden; margin-bottom: 5px'>
                    <img src='$commentUserPfp' class='img-responsive' style='max-width: 50px; margin: 10px; float: left' alt='Profile Pic' />
                    $commentText<br />
                    $commentReaction by <a href='/user-profile.php?id=$commentUser'>$commentUserName</a> on $commentDate
                    </div>";
                    }

                    ?>
                </div>
            </div>
            </div>
        </div>
       
       <br /><br />
       <a href='dashboard.php' class='btn btn-primary'>Return to Dashboard</a>
        <?php if(isAdmin() || $_SESSION['loggedIn_userId'] == $postUser){ ?>
            <a href='#' id='deletePostBtn'><img src="img/delete-button.png" class="delete-post-btn" alt="delete button"></a>
            <form style="display: none" id="deletePostForm" action="process/deletePost.php" method="post">
                <input type="hidden" name="main_post_id" value="<?php echo $id; ?>" />
            </form>
        <?php } ?> 
      </div>
    </body>
</html>