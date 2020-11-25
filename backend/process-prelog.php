<?php
    if(isset($_POST)){
        echo "in here";
        require('db_conn.php');
        $conn = new DB_CONNECTION();
        $connection= $conn->createConnection();
        if($connection){
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
            $insertIntoLecturer = mysqli_query($connection, "INSERT INTO lecturer(
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
                '".mysqli_real_escape_string($connection,$mobile)."',
                '".mysqli_real_escape_string($connection,$title)."',
                '".mysqli_real_escape_string($connection,$fname)."',
                '".mysqli_real_escape_string($connection,$surname)."',
                '".mysqli_real_escape_string($connection,$rank)."',
                '".mysqli_real_escape_string($connection,$email)."',
                '".mysqli_real_escape_string($connection,$upassword)."',
                '".mysqli_real_escape_string($connection,$gender)."',
                'Available'
            )") or die(mysqli_error($connection));
            if($insertIntoLecturer){
                $queryId = mysqli_query($connection, "SELECT id FROM lecturer GROUP BY id DESC LIMIT 1")or die(mysqli_error($connection));
                if(mysqli_num_rows($queryId)>0){
                    $id = mysqli_fetch_assoc($queryId);
                    if($othername!=""){
                        $insertOthername = mysqli_query($connection, "INSERT INTO lecturer_othername(
                            lecturer_id,
                            othername
                        ) VALUES(
                            ".$id['id'].",
                            '".mysqli_real_escape_string($connection,$othername)."'
                        )")or die(mysqli_error($connection));
                    }
                    $insertIntoAdmin = mysqli_query($connection, "INSERT INTO admin(
                        lecturer_id,
                        position
                    ) VALUES(
                        ".$id['id'].",
                        '".mysqli_real_escape_string($connection,$position)."'
                    )") or die(mysqli_error($connection));
                    if($insertIntoAdmin){
                        header("Location:../preaccess/login.html");
                    }
                
                }
            }else{

                ?>
                    <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link rel="stylesheet" href="../custom-css/base-customstyle.css">
                        <link rel="stylesheet" href="../arms.css/arms-1.css">
                        <script src="../custom-jscript/jquery.js"></script>
                        <script src="../custom-jscript/preaccess.js"></script>
                            <title>Error</title>
                        </head>
                        <body>
                        <div class="col-12" id="main-header">
                            <div>
                            <div class="col-2"> <img src="../images/ndu_bg_logo.png" alt="logo" id="logo"/> </div>
                            <div class="col-9 header"> 
                                <div id="h1">ACADEMIC RECORD MANAGMENT SYSTEM</div>
                                <div id="h3">MY DEPARTMENT</div>
                            </div>
                            <hr id="header-seperator"/>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-7">
                            <?php
                                header("Refresh:5; url=index.html");
                                set_error_handler("loginError",E_USER_WARNING);
                                trigger_error("Error: A network error occoured while uploading details!", E_USER_WARNING);
                    
                            ?>
                        </div>
                        <div class="col-2"></div>
                        </body>
                        </html>
                <?php
            }
            
        }
    }
    
    function loginError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr<br>";
        die();
      }
?>