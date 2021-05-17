<?php
    if(isset($_POST)){
        $details = $_POST['details'];
        $newDetails = json_decode($details, false);

        require('db_conn.php');
        if($conn){
            if($newDetails->othername = "" || $newDetails->othername == null){
                $updateDetails = mysqli_query($conn, "UPDATE lecturer SET title ='".$newDetails->title."', surname ='".$newDetails->surname."', firstname ='".$newDetails->firstname."', rank ='".$newDetails->rank."', mobile_phone ='".$newDetails->mobile."' WHERE id =".$newDetails->id."") or die(mysqli_error($conn));
                if($updateDetails){
                    echo "success";
                }else {
                    echo "failed";
                }
            }else {
                $updateDetails = mysqli_query($conn, "UPDATE lecturer SET title ='".$newDetails->title."', surname ='".$newDetails->surname."', firstname ='".$newDetails->firstname."', rank ='".$newDetails->rank."', mobile_phone ='".$newDetails->mobile."' WHERE id =".$newDetails->id."") or die(mysqli_error($conn));
                $updateOthername = mysqli_query($conn, "UPDATE lecturer_othername SET othername ='".$newDetails->othername."' WHERE lecturer_id =".$newDetails->id."") or die(mysqli_error($conn));
                if($updateDetails ==true && $updateOthername == true){
                    echo "success";
                }else {
                    echo "failed";
                }
            }
        }
    }
?>