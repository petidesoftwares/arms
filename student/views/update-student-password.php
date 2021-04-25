<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../student-css/student-base-style.css">
    <link rel="stylesheet" href="../student-css/banner.css">
    <link rel="stylesheet" href="../student-css/student.css">
    <script src="../student-jscripts/jquery-3.5.1.min.js"></script>
    <script src="../student-jscripts/students.js"></script>
    <title>Password Update</title>
</head>
<body>
    <div class = "row">
        <div class="col-12" id = "page-header"><img src="../images/ndu_bg_logo.png" alt="logo"> <p>NIGER DELTA UNIVERSITY <br><span>Wilberforce Island</span</p></div>
    </div>
    <!-- <div class ="col-12" id="index-bg-spacer"></div> -->
    <div class="row">
        <div class="col-12" id = "banner">
            <div class="col-12" id="login-form-pane">
                <div class = "col-3"></div>
                <fieldset class = "col-6 double-input-form"> 
                    <legend>Update Password Form</legend>
                    <input type="password" name="new_password" id="new-password" placeholder = "Enter New Password"><br>
                    <input type="password" name="confirm_password" id="confirm-password" placeholder = "Confirm Password"><br>
                    <button class = "double-input-btn" id = "update-password-btn" onclick = "studentLogin();">Login</button>
                </fieldset>
                <div class = "col-3"></div>
            </div>
        </div>
        
    </div>
</body>
</html>