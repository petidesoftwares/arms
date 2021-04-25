<?php
    require("../backend/admin-task-function.php");
    $sessions = getSessions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../custom-css/base-customstyle.css"> -->
    <link rel="stylesheet" href="../arms.css/admin.css">
    <script src=".//custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/admin.js"></script>
    <title>Inividual Result</title>
</head>
<body>
    <div class="col-12">
        <div class="menu-bar" onclick="showMenu()">
            <div class="menu-frame">
                <div class="menu-icon-bar-1"></div>
                <div class="menu-icon-bar-2"></div>
                <div class="menu-icon-bar-3"></div>
            </div>
        </div><div class="col-10"></div>
        <div class="col-12 all-page-title" id="ind-result-page-title">INDIVIDUAL RESULT</div>

        <div class="col-3"></div>
        <div class="col-8" id="individual-result-form">
            <div class="rounded-corner-btn att-semester"><input type="radio" name="semester" id="first-semester" value="First"> <label for="first-semester">First Semester</label></div>
            <div class="rounded-corner-btn att-semester"><input type="radio" name="semester" id="second-semester" value="Second"> <label for="second-semester">Second Semester</label></div>
            <div class="att-level"><select name="seleect-att-level" id="select-student-result-level" class="rounded-corner-btn select-level-style">
                <option>Select Level</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                <option value="500">500</option>
            </select></div>
            <div class="rounded-corner-btn result_session"> 
                <select name="academic_session" id="academic_session">
                    <?php
                        $secondYear=1;
                        foreach($sessions as $session){
                            $secondYear+= $session['year'];
                            echo '<option value="'.$session['year'].'">'.$session['year'].'/'.$secondYear.'</option>';
                        }
                    ?>
                </select>
            </div>
            <button class="rounded-corner-btn gen-att" id="ind-result-btn" onclick = "getResultList()">Get Students</button>
        </div>
    </div>
    <div id ="result-list-pane"></div>
    <div id="view-result-pane"></div>
</body>
</html>