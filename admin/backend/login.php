<?php
session_start();
if(isset($_POST)){
    require('db_conn.php');
    if($conn){
        $email = $_POST["login_email"];
        $password = $_POST["login_password"];

        $errorResponse ="";

        $algorithm = "sha512";
        $queryLoginCredentials = mysqli_query($conn,"SELECT id, password FROM lecturer WHERE email ='".$email."' AND password ='".hash($algorithm, $password)."'");
        if(mysqli_num_rows($queryLoginCredentials)>0){
            while($id = mysqli_fetch_assoc($queryLoginCredentials)){
                $_SESSION['id'] = $id['id'];
                header('Location:../views/home.php');
            }
            
        }else{
            ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="../arms.css/base-css.css">
                    <link rel="stylesheet" href="../arms.css/arms-1.css">
                    <script src="../custom-jscript/jquery.js"></script>
                    <script src="../custom-jscript/preaccess.js"></script>
                    <title>Error</title>
                </head>
                <body>
                <div id="main-header">
                    <div class="header"> 
                        <div id="logo-pane"> 
                            <img src="../images/ndu_bg_logo.png" alt="logo" id="logo"/>
                        </div>
                            <p id="h1"> ACADEMIC RECORD MANAGMENT SYSTEM</p>
                            <p id = "h3"> MY DEPARTMENT</p>
                    </div>
                    <hr id="header-seperator"/>
                </div>
                <!-- <div class="col-2"></div> -->
                <div class="col-12" id="content-pane">
                    <?php
                        header("Refresh:5; url=../preaccess/login-view.php");
                        set_error_handler("loginError",E_USER_WARNING);
                        trigger_error("Error: User not found. invalid username or password!", E_USER_WARNING);
            
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