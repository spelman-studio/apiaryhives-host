<?php
switch(@$_SESSION['postResult']){
    case "post-error-missing-fields":
    case "post-error":
        echo "<div class='alert alert-danger'>There was an error submitting your post. Please try again, or contact us for assistance.</div>";
        unset($_SESSION['postResult']);
        break;
}

?>
<script>
    function closeTogglePopupPost() {
        document.getElementById('post-creator-main').style.display="none";
    }
</script>

<div id="close-icon" onclick="closeTogglePopupPost()"></div>
<div class="post-box">
            <form id="post" action="process/newPost.php" method="post" enctype="multipart/form-data">
                <ul class="post-upload-list">
                    <li class="post-upload-items">
                        <label class="post-text"> Upload photo: <sup class="required">*</sup>
                            <input class="upload-input" type="file" id="file-input" name="post-img">
                        </label>
                    </li>
                    <br/>
                    <li class="post-upload-items">
                        <label class="post-text">Insert caption: <sup class="required">*</sup>
                            <textarea rows="3" class="caption-input" type="text" rows="3" name="post-caption"></textarea>
                        </label>
                    </li>
                    <br/> 
                    <li>
                        <select name="post-department" id="dept" class="dept-input">
                            <option value="1">Human Resources</option>
                            <option value="2">Marketing</option>
                            <option value="3">Sales</option>
                            <option value="4">Information Technology</option>
                            <option value="5">Legal</option>
                            <option value="6">Operations</option>
                            <option value="7">Board of Directors</option>
                            <option value="8">Customer Service</option>
                            <option value="9">Onboarding</option>
                        </select>
                        <sup class="required">*</sup>
                    </li>
                    <li>
                        <input class="post-btn" type="submit" name="newPost" value="Post">
                    </li>
                </ul>
            </form>
</div>