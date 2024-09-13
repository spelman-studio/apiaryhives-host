<?php
session_start();

    // Connect to database
    $connect = mysqli_connect('localhost', 'apiaryhi_php', 'Y*PpC4t_Y!gz2V3^g)', 'apiaryhi_db') or die("Error connecting to database");


     // connection for prepared statements
     $connection = new mysqli('localhost', 'apiaryhi_php', 'Y*PpC4t_Y!gz2V3^g)', 'apiaryhi_db');

    $departmentsArr = array(
                1 => "Human Resources",
                2 => "Marketing",
                3 => "Sales",
                4 => "Information Technology",
                5 => "Legal",
                6 => "Operations",
                7 => "Board of Directors",
                8 => "Customer Service",
                9 => "Onboarding"
                );

    $userIsAdminArr = array(
                0 => "Standard",
                1 => "Administrator"
                );

    $defaultProfilePic = "/img/apiarylogo.png";

    
    $sendgridTemplateId = "d-eacb87fad2b74d48a56218f5d4544838";
    $sendgridApiKey = "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";
    $sendgridFromEmail = "noreply@apiaryhives.org";


    function isLoggedIn(){
        global $connect;
        if(@$_SESSION['loggedIn'] != true){
            return false;
        }

        if(@$_SESSION['loggedIn'] == true && @$_SESSION['loggedIn_userId'] !== null && @$_SESSION['loggedIn_userId'] != ""){
            $userId = (int) @$_SESSION['loggedIn_userId'];
            if($userId == 0){
                return false;
            }else{
                $sql = mysqli_query($connect, "SELECT * FROM user WHERE user_id='$userId' ORDER BY user_id DESC LIMIT 1");
                if(!$sql || mysqli_num_rows($sql) != 1){
                    //query failed, or user id not found in database
                    return false;
                }else{
                    return true;
                }
            }
        }else{
            return false;
        }
    }



    function getUserDetails($userId){
        global $connect;
        global $departmentsArr;
        // By default, variables created outside of a function can't be used within a function. Used global $varName to allow them to be used inside the function

        $userId = (int) $userId;
        if(!$userId || $userId == 0){
            return false;
        }else{
             $sql = mysqli_query($connect, "SELECT * FROM user WHERE user_id='$userId' ORDER BY user_id DESC LIMIT 1");
             if(!$sql || mysqli_num_rows($sql) != 1){
                return false;
             }else{
                $row = mysqli_fetch_array($sql);
                $data['username'] = stripslashes($row['user_name']);
                $data['company_email'] = stripslashes($row['user_company_email']);
                $data['personal_email'] = stripslashes($row['user_personal_email']);
                $data['department'] = stripslashes($row['user_dep_id']);
                $data['department_name'] = $departmentsArr[$row['user_dep_id']];
                $data['first_name'] = stripslashes($row['user_firstname']);
                $data['last_name'] = stripslashes($row['user_lastname']);
                $data['isAdmin'] = stripslashes($row['user_is_admin']);
                $data['pfp'] = stripslashes($row['user_pfp']);
                $data['pronouns'] = stripslashes($row['user_pronouns']);
                $data['bio'] = stripslashes($row['user_bio']);
                $data['phone'] = stripslashes($row['user_phone']);
                $data['company_id'] = stripslashes($row['user_company_id']);
                $data['position'] = stripslashes($row['user_position']);

                return $data;
             }
        }
    }

    function getCompanyDetails($companyId){
        global $connect;
        global $departmentsArr;
        // By default, variables created outside of a function can't be used within a function. Used global $varName to allow them to be used inside the function

        $companyId = (int) $companyId;
        if(!$companyId || $companyId == 0){
            return false;
        }else{
             $sql = mysqli_query($connect, "SELECT * FROM company WHERE company_id='$companyId' ORDER BY company_id DESC LIMIT 1");
             if(!$sql || mysqli_num_rows($sql) != 1){
                return false;
             }else{
                $row = mysqli_fetch_array($sql);
                $data['name'] = stripslashes($row['company_name']);

                $industryId = stripslashes($row['company_industry_id']);
                $sql2 = mysqli_query($connect, "SELECT * FROM industry WHERE industry_id='$industryId' ORDER BY industry_id DESC LIMIT 1");
                $row2 = mysqli_fetch_array($sql2);
                $industryName = stripslashes($row2['industry_name']);
                
                $data['industry'] = $industryName;
                $data['linkedin'] = stripslashes($row['company_linkedin']);
                $data['website'] = stripslashes($row['company_website']);
                $data['address'] = stripslashes($row['company_hq_address']);
                $data['logo'] = stripslashes($row['company_logo']);

                return $data;
             }
        }
    }


    function isAdmin(){
        global $connect;


        $userId = (int) @$_SESSION['loggedIn_userId'];
        if(!$userId || $userId == 0){
            return false;
        }else{
             $sql = mysqli_query($connect, "SELECT * FROM user WHERE user_id='$userId' AND user_is_admin='1' ORDER BY user_id DESC LIMIT 1");
             if(!$sql || mysqli_num_rows($sql) != 1){
                return false;
             }else{
                return true;
             }
        }
    }
    
    function isHr(){
        global $connect;

        $userId = (int) @$_SESSION['loggedIn_userId'];
        if(!$userId || $userId == 0){
            return false;
        }else{
            $sql = mysqli_query($connect, "SELECT * FROM user WHERE user_id='$userId' AND user_dep_id ='1' ORDER BY user_id DESC LIMIT 1");
            if((!$sql || mysqli_num_rows($sql) != 1)){
                return false;
            } else {
                return true;
            }
        }
    }

    function isIt(){
        global $connect;

        $userId = (int) @$_SESSION['loggedIn_userId'];
        if(!$userId || $userId == 0){
            return false;
        }else{
            $sql = mysqli_query($connect, "SELECT * FROM user WHERE user_id='$userId' AND user_dep_id = '4' ORDER BY user_id DESC LIMIT 1");
            if((!$sql || mysqli_num_rows($sql) != 1)){
                return false;
            } else {
                return true;
            }
        }
    }

    function isOnboarding(){
        global $connect;

        $userId = (int) @$_SESSION['loggedIn_userId'];
        if(!$userId || $userId == 0){
            return false;
        }else{
            $sql = mysqli_query($connect, "SELECT * FROM user WHERE user_id='$userId' AND user_dep_id = '9' ORDER BY user_id DESC LIMIT 1");
            if((!$sql || mysqli_num_rows($sql) != 1)){
                return false;
            } else {
                return true;
            }
        }
    }


function getDepartmentName($deptId){
    global $connect;

    $sql = mysqli_query($connect, "SELECT * FROM dept WHERE dept_id='$deptId' ORDER BY dept_id DESC LIMIT 1");
    if(!$sql || mysqli_num_rows($sql) != 1){
        return "Unknown Department";
    }else{
        $row = mysqli_fetch_array($sql);
        return stripslashes($row['dept_name']);
    }
}


function uploadImage($fileArr){

    /*
        Since image uploading will be done on various areas of the site, and there's a lot of code that goes into it, we made this a function to easily use throughout the side. This way, the code only needs to be written once

        Use like this:
        if($uploadFilename = uploadImage($_FILES['img'])){
            // success
        }else{
            // error
        }

    */


// IMPORTANT - your uploading script must be within /process/ for this to work
$target_dir = "../uploads/";

$target_file = $target_dir . basename($fileArr["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


/*
 renames the file with a unique name
 uniqid() creates a random string based on the current time
 adding rand() at the end add more random numbers, and makes it harder for someone to randomly guess a file name
 the combination of these two makes it almost impossible for this name to already exist
 this also eliminates any issues if the original filename had spaces or special characters
 */
$new_target_filename = uniqid().rand(10000, 99999).".$imageFileType";
$new_target_file = $target_dir.$new_target_filename;


// Ensures the file is actually an image
  if(!exif_imagetype($fileArr["tmp_name"])) {
   return false;
  }



// Make sure file has an image file extension
$allowedImageFiletypes = array("jpg", "jpeg", "png", "webp", "bmp", "gif");

if(!in_array($imageFileType, $allowedImageFiletypes)){
  return false;
}


// resizes the image to make it have a max width/height of 1200px
// this saves server space, and makes the page load faster
$size = getimagesize($fileArr["tmp_name"]);
$ratio = $size[0]/$size[1]; // width/height
$maxSide = 1200;
if($ratio > 1){
    $width = $maxSide;
    $height = $maxSide / $ratio;
}else{
    $width = $maxSide * $ratio;
    $height = $maxSide;
}



$src = imagecreatefromstring(file_get_contents($fileArr["tmp_name"]));
$dst = imagecreatetruecolor($width,$height);
imagealphablending( $dst, false );
imagesavealpha( $dst, true );
imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
imagedestroy($src);
imagepng($dst,$new_target_file); // adjust format as needed
imagedestroy($dst);

return $new_target_filename;
}

function randomString($length){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for($i = 0; $i < $length; $i++){
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>