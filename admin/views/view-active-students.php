<?php
    require("../backend/admin-task-function.php");
    $current_sessions = getCurrentSession();
    $currentSession;
    foreach($current_sessions as $session){
        $currentSession = $session['year'];
    }
    $activeStudents =  viewActiveStudents($currentSession);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arms.css/admin.css">
    <title>Document</title>
</head>
<body>
    <div class="menu-bar" onclick="showMenu()">
        <div class="menu-frame">
            <div class="menu-icon-bar-1"></div>
            <div class="menu-icon-bar-2"></div>
            <div class="menu-icon-bar-3"></div>
        </div>
    </div>
    <div>
        <table>
            <thead id = "grey-row">
                <th>S/N</th>
                <th>Mat. Number</th>
                <th>Student Full Name</th>
            </thead>
            <tbody>
                <?php
                    $s_n = 0;
                    foreach($activeStudents as $activeStudent){
                        $s_n++;
                        if($s_n%2==0){
                            echo '<tr id = "grey-row"><td>'.$s_n.'</td><td>'.$activeStudent['matno'].'</td><td>'.$activeStudent['surname'].', '.$activeStudent['firstname'].'</td></tr>';
                        }else{
                            echo '<tr><td>'.$s_n.'</td><td>'.$activeStudent['matno'].'</td><td>'.$activeStudent['surname'].', '.$activeStudent['firstname'].'</td></tr>';
                        }   
                    }

                ?>
            </tbody>
        </table>
    </div>
</body>
</html>