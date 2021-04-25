<?php
session_start();
$file= $_FILES['image-selector']['name'];
/**Rename file */
$fileExt = explode("/",$_FILES['image-selector']['type']);
$newName = $_SESSION['customer_id'].".".$fileExt[1];
/**Change file extension */
$formatedName = replace_extension($newName, "png");

$location = "u-profile-images/".$formatedName;
$previewLocation = "u-profile-image-preview/".$formatedName;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
$imageFileTypePreview = pathinfo($previewLocation,PATHINFO_EXTENSION);

$valid_extensions = array("jpg","jpeg","png");
/* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   $uploadOk = 0;
}

if($uploadOk == 0){
   echo 0;
}else{
   /* Upload file */
   if(move_uploaded_file($_FILES['image-selector']['tmp_name'],$location)){
      /*****Updated by PetideSystem 02/07/2020****************/
      include "conn.php";
      $savePhotoQuery = "UPDATE customer SET customer_profile_pic ='".$Location."' WHERE customer_id =".$_SESSION['customer_id'];
      $execSavePhotoQuery = mysqli_query($conn, $savePhotoQuery);
      if($execSavePhotoQuery ==true){
         if( copy($location,$previewLocation)){
            echo $previewLocation;
         }
      }else{
         echo 'Profile  Photo Upload Error!'. mysqli_error();
      }
      /**************************************************/             
   }else{
      echo 0;
   }
}

function replace_extension($filename, $new_extension) {
    $info = pathinfo($filename);
    return $info['filename'] . '.' . $new_extension;
}
?>