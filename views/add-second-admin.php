<?php
    require("../backend/admin-task-function.php");
    $titles = getTitles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../custom-css/base-customstyle.css">
    <link rel="stylesheet" href="../arms.css/arms-1.css">
    <title>Add Admin</title>
</head>
<body>
    <div class="col-12" id="prelog-form-pane">
        <form action="../backend/process-prelog.php" method="post" id="prelog-form" onsubmit="return validate()">
            <span>REGISTER FIRST ADMIN</span><br>
            <label for="title">Title:</label><select name="title" id="title">
                <option>Select Title</option>
                <?php
                foreach($titles as $title){
                    echo '<option value="'.$title['title'].'">'.$title['title'].'';
                }
                ?>
            </select><br>
            <input type="text" name="fname" id="fname" placeholder="Enter first name">
            <input type="text" name="surname" id="surname" placeholder="Enter surname">
            <input type="text" name="othername" id="othername" placeholder="Enter other name"><br>
            <label>Gender:</label> 
            <input type="radio" name="gender" value="Male" id="male" checked> <label for="male">Male</label>
            <input type="radio" name="gender" value="Female" id="female"> <label for="female"></label>Female</label><br>
            <label for="title">Rank:</label><select name="rank" id="rank">
                <option>Select Rank</option>
                <option value="Professor">Professor</option>
                <option value="Reader">Reader</option>
                <option value="Senior Lecturer">Senior Lecturer</option>
                <option value="Lecturer l">Lecturer l</option>
                <option value="Lecturer ll">Lecturer ll</option>
                <option value="Assistant Lecturer">Assistant Lecturer</option>
            </select><br>
            <input type="tel" name="moble" id="mobile" placeholder="Enter phone number">
            <input type="email" name="email" id="email" placeholder="Enter email address"><br>
            <label>Position:</label> 
            <input type="radio" name="position" value="EO" id="eo" checked> <label for="eo">Exam Officer</label>
            <input type="radio" name="position" value="HOD" id="hod"> <label for="hod"></label>Head Of Department</label><br>
            <input type="password" name="password" id="password" placeholder="Enter Password">
            <input type="password" name="c_password" id="c_password" placeholder="Confirm Password"><br>
            <input type="submit" value="Submit" id="submit">
        </form>
        
    </div>

    <div class="col-12-custom" id = 'modal'>
        <!-- <input type = 'button' value = 'X' onclick = 'hideModal()' id = 'closeModal' /> -->
        <div class="col-3"></div>
        <div class="col-5" id="validation-info-board">
            <h3>Error Message</h3>
            <div id="validation-info"></div>
            <button id ="clear-modal" onclick = 'hideModal()'>OK</button>
        </div>
        <div class="col-3"></div>
    </div>
    
</body>
</html>