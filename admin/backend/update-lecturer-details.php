<?php
    if(isset($_POST)){
        $details = $_POST['details'];
        $newDetails = json_decode($details, false);
        require('db_conn.php');
        if($conn){
            $flag = "";
            if($newDetails->othername ==""){
                $updateDetails = mysqli_query($conn, "UPDATE lecturer SET title ='".$newDetails->title."', surname ='".$newDetails->surname."', firstname ='".$newDetails->firstname."', rank ='".$newDetails->rank."', mobile_phone ='".$newDetails->mobile."' WHERE id =".$newDetails->id."") or die(mysqli_error($conn));
                if($updateDetails){
                    echo "success";
                }else {
                    echo "failed";
                }
            }else {
                $verifyOthername = mysqli_query($conn, "SELECT othername FROM lecturer_othername WHERE lecturer_id =".$newDetails->id."") or die(mysqli_error($conn));
                if(mysqli_num_rows($verifyOthername)>0){
                    $updateDetails = mysqli_query($conn, "UPDATE lecturer SET title ='".$newDetails->title."', surname ='".$newDetails->surname."', firstname ='".$newDetails->firstname."', rank ='".$newDetails->rank."', mobile_phone ='".$newDetails->mobile."' WHERE id =".$newDetails->id."") or die(mysqli_error($conn));
                    $updateOthername = mysqli_query($conn, "UPDATE lecturer_othername SET othername ='".$newDetails->othername."' WHERE lecturer_id =".$newDetails->id."") or die(mysqli_error($conn));
                    if($updateOthername && $updateDetails ==true){
                        $flag ="success";
                    }
                    else{
                        $flag = "failed";
                    }
                }else{
                    $insertOthername = mysqli_query($conn, "INSERT INTO lecturer_othername(lecturer_id, othername) VALUES(".$newDetails->id.", '".mysqli_real_escape_string($conn,$newDetails->othername)."')")or die(mysqli_error($conn));
                    if($insertOthername){
                        $flag ="success";
                    }
                    else {
                        $flag = "failed";
                    }
                }
                echo $flag;
            }
        }
    }
?>