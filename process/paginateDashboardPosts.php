<?php
    require("../inc/global.php");

    if(!isLoggedIn()){
        header("Location: /login.php");
        die('');
    }

    $lastId = (int) mysqli_real_escape_string($connect, strip_tags(@$_GET['last_id']));
    
    $deptfeed = (int) mysqli_real_escape_string($connect, strip_tags(@$_GET['dept']));

    if($deptfeed == 0){
        $sql = mysqli_query($connect, "SELECT * FROM main_post WHERE main_post_id < $lastId AND main_post_company_id = $companyId ORDER BY main_post_id DESC LIMIT 9");
    } else {
        $sql = mysqli_query($connect, "SELECT * FROM main_post WHERE main_post_dept_id = '$deptfeed' AND main_post_id < $lastId AND main_post_company_id = $companyId ORDER BY main_post_id DESC LIMIT 9");
    } 

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

        if(strlen($postCaption) > 300){
            // if the post is more than 100 characters, only show the first 100, and add a "... read more" link to the end. This helps the page look cleaner if the post is really long
            $postCaption = substr($postCaption, 0, 300)." ... <a href='read-post.php?id=$postId' class='small font-weight-light'>read more</a>";
        }

        $postCaption = nl2br($postCaption);
        // make new lines into a <br /> tag

        echo "
        <br>
        <div class='post-wrapper' id='$postId'>
            <div class='post-wrapper-inner'>
            <div class='post-column post-preview'>
                <div class='post-img-box'>
                    <a href='user-profile.php?user_id=$postUser'><img src='$pfp' class='img-responsive post-icons post-pfp' alt='Profile Picture'/>
                    <span class='post-username'>$username</span>
                    <a href='read-post.php?id=$postId'><img src='uploads/$postImg' alt='Post Image' class='post-img img-responsive'/></a>
                </div>
            </div>
            <div class='post-column post-caption-box'>
                <div class='post-caption'><div>$postCaption</div></div>
                <div class='post-toggle'>
                    <div class='post-buttons'>
                        <div class='post-btns'>
                            <span class='post-username'>$department</span></a>
                        </div>
                        <a href='read-post.php?id=$postId'>
                            <button class='post-btns like-button'><img src='img/like-icon.png' class='post-icons' alt='Like Button'></button>
                            <button class='post-btns dislike-button'><img src='img/dislike-icon.png' class='post-icons' alt='Dislike Button'></button>
                            <button class='post-btns comment-button'><img src='img/comment-icon-circle.png' class='post-icons' alt='Comment Button'></button>
                        </a>
                    </div>
                </div>
            </div>
            </div>
        </div>
        ";
    }
?>