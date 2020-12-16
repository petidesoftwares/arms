<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $title =$_POST['title'];
            $fname =$_POST['fname'];
            $surname =$_POST['surname'];
            $othername =$_POST['othername'];
            $gender =$_POST['gender'];
            $rank =$_POST['rank'];
            $mobile =$_POST['mobile'];
            $email =$_POST['email'];
            $position =$_POST['position'];
            $password =$_POST['password'];

            $algorithm = "sha512";
            $upassword = hash($algorithm,$password);
            $insertIntoLecturer = mysqli_query($conn, "INSERT INTO lecturer(
                mobile_phone,
                title,
                firstname,
                surname,
                rank, 
                email,
                password,
                gender, 
                status
            ) VALUES(
                '".mysqli_real_escape_string($conn,$mobile)."',
                '".mysqli_real_escape_string($conn,$title)."',
                '".mysqli_real_escape_string($conn,$fname)."',
                '".mysqli_real_escape_string($conn,$surname)."',
                '".mysqli_real_escape_string($conn,$rank)."',
                '".mysqli_real_escape_string($conn,$email)."',
                '".mysqli_real_escape_string($conn,$upassword)."',
                '".mysqli_real_escape_string($conn,$gender)."',
                'Available'
            )") or die(mysqli_error($conn));
            if($insertIntoLecturer){
                $queryId = mysqli_query($conn, "SELECT id FROM lecturer GROUP BY id DESC LIMIT 1")or die(mysqli_error($conn));
                if(mysqli_num_rows($queryId)>0){
                    $id = mysqli_fetch_assoc($queryId);
                    if($othername!=""){
                        $insertOthername = mysqli_query($conn, "INSERT INTO lecturer_othername(
                            lecturer_id,
                            othername
                        ) VALUES(
                            ".$id['id'].",
                            '".mysqli_real_escape_string($conn,$othername)."'
                        )")or die(mysqli_error($conn));
                    }
                    $insertIntoAdmin = mysqli_query($conn, "INSERT INTO admin(
                        lecturer_id,
                        position
                    ) VALUES(
                        ".$id['id'].",
                        '".mysqli_real_escape_string($conn,$position)."'
                    )") or die(mysqli_error($conn));
                    if($insertIntoAdmin){
                        echo "Second Admin successfully registered";
                    }
                
                }
            }else{
               
                echo "Error: A network error occoured while uploading details!";      
            }
            
        }
    }
    
    function loginError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr<br>";
        die();
      }
?>