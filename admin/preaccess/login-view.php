<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arms.css/base-css.css">
    <link rel="stylesheet" href="../arms.css/arms-1.css">
    <!-- <link rel="stylesheet" href="../custom-css/login.css"> -->
    <title>Admin Login</title>
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
    <div class="col-12 col-m-12" id="content-pane">
        <!-- <div class="col-2 col-m-2"></div> -->
        <div class="col-7 col-m-7" id="login-form-pane">
            <form action="../backend/login.php" method="post">
                <input type="email" name="login_email" id="login_email" placeholder="Enter email address">
                <input type="password" name="login_password" id="login_password" placeholder="Enter password">
                <input type="submit" name="submit" id="submit" value="Login">
            </form>
        </div>
        <div class="col-2 col-m-2"></div>
    </div>
</body>
</html>