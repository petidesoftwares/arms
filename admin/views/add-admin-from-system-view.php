<?php
    require("../backend/admin-task-function.php");
    $lecturers = getAdminMatchedStatus();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../custom-css/base-customstyle.css"> -->
    <link rel="stylesheet" href="../arms.css/admin.css">
    <script src="../custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/admin.js"></script>
    <title>Add Second Admin</title>
</head>
<body>
    <div class="col-12">
    <div class="menu-bar" onclick="showMenu()">
                <div class="menu-frame">
                    <div class="menu-icon-bar-1"></div>
                    <div class="menu-icon-bar-2"></div>
                    <div class="menu-icon-bar-3"></div>
                </div>
        </div>
        <div class="col-3"></div>
        <div class="col-5" id = "add-new-existing-lecturer-pane">
            <select name="lecturer_admin" id="lecturer_admin">
                <?php
                    foreach($lecturers as $lecturer){
                        echo '<option value="'.$lecturer["id"].'">'.$lecturer["title"].' '.$lecturer["firstname"].' '.$lecturer["surname"].' '.$lecturer["othername"].'</option>';
                    }
                ?>
            </select>
            <select name="position" id="position">
                <option value="HOD">H.O.D</option>
                <option value="EO">Exams and Record Officer</option>
            </select>
            <button id="submit_admin" onclick = "submitSecondadmin()">Submit</button>
        </div>
        <div class="col-3"></div>
    </div>
    <div class="col-12-custom" id = 'modal'>
        <!-- <input type = 'button' value = 'X' onclick = 'hideModal()' id = 'closeModal' /> -->
        <div class="col-3"></div>
        <div class="col-5" id="validation-info-board">
            <h3>Message</h3>
            <div id="validation-info"></div>
            <button id ="clear-modal" onclick = 'hideModal_2()'>OK</button>
        </div>
        <div class="col-3"></div>
    </div>
</body>
</html>