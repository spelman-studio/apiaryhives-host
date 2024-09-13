<?php
switch(@$_SESSION['ancResult']){
    case "anc-error-missing-fields":
    case "anc-error":
        echo "<div class='alert alert-danger'>There was an error submitting your announcement. Please try again, or contact us for assistance.</div>";
        unset($_SESSION['ancResult']);
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
            <form id="post" action="process/newAnc.php" method="post" enctype="multipart/form-data">
                <ul class="post-upload-list">
                    <li class="post-upload-items">
                        <label class="post-text"> Upload photo: 
                            <input class="upload-input"  type="file" id="file-input" name="anc-img">
                        </label>
                    </li>
                    <br/>
                    <li class="post-upload-items">
                        <label class="post-text">Insert caption:<sup class="required">*</sup>
                            <textarea rows="3" class="caption-input" type="text" rows="3" name="anc-caption"></textarea>
                        </label>
                    </li>
                    <br/>
                    <li>
                        <select name="anc-department" id="dept" class="dept-input">
                            <?php
                                if(isAdmin()){
                                    echo "<option value='0'>Company Wide</option>";
                                }
                            ?>
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
                        <input class="post-btn" type="submit" name="newAnc" value="Post">
                    </li>
                </ul>
            </form>
</div>