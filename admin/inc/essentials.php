<?php
/*function adminLogin() {
    session_start();
    
    // Debugging: Check if the session variable is set
    if (isset($_SESSION['adminLogin'])) {
        echo "adminLogin is set to: " . $_SESSION['adminLogin'];
    } else {
        echo "adminLogin is not set";
    }

    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        echo "<script>
               window.location.href='index.php';
              </script>";
        exit; // Stop further script execution
    }

    // If the session variable is set correctly, continue to the dashboard
    echo "<script>
           window.location.href='dashboard.php';
          </script>";
    exit;
}*/

//frontend purpose

define('SITE_URL','http://localhost:8081/hbwebsite/');
define('ABOUT_IMG_PATH', SITE_URL.'images/about/');
define('CAROUSEL_IMG_PATH', SITE_URL.'images/carousel/');




//backend upload process needs this 
define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/images/');
define('ABOUT_FOLDER','about/');
define('CAROUSEL_FOLDER','carousel/');


function adminLogin() {
    session_start();
    
    // Check if adminLogin session is not set or not true
    if (!isset($_SESSION['adminLogin']) || $_SESSION['adminLogin'] !== true) {
        // Redirect to login page
        echo "<script>
               window.location.href='index.php';
              </script>";
        exit; // Stop further script execution
    }
}

    function redirect($url){
        echo"<script>
           window.location.href='$url';
        </script>";
        exit;
    }




   function alert($type,$msg){
        $bs_class = ($type== "success")? "alert-success": "alert-danger"; 
        echo <<<alert
        
            <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3">$msg</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        alert;
   }

   function uploadImage($image,$folder)
   {
    $valid_mime = ['image/jpg','image/png' , 'image/webp' , 'image/jpeg'];
    $img_mime = $image['type'];
    if(!in_array($img_mime,$valid_mime))
    {
        return 'inv_img'; // invalid image mime or format
    }
    else if(($image['size']/(1024*1024))>2)
    {
        return 'inv_size';

    }
    else
    {
        $ext= pathinfo($image['name'],PATHINFO_EXTENSION);
        $rname='IMG_'.random_int(11111,99999).".$ext";
        $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
        if(move_uploaded_file($image['tmp_name'],$img_path)){
            return $rname;
        }
        else{
            return 'upd_failed';
        }

    }


   }

   function deleteImage($image , $folder)
   { 
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image))
    {
        return true;
    }
    else{
        return false;
    }

   }




?>