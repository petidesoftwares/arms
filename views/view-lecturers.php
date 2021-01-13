<?php
    require("../backend/admin-task-function.php");
    $lecturers = getAllLecturers();
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
                <th>TITLE</th>
                <th>FULL NAME</th>
                <th>RANK</th>
            </thead>
            <tbody>
                <?php
                    $s_n = 0;
                    foreach($lecturers as $lecturer){
                        $s_n++;
                        if(array_key_exists("othername",$lecturer)){
                            if($s_n%2 ==0){
                                echo '<tr id = "grey-row"><td>'.$s_n.'</td><td>'.$lecturer['title'].'</td><td>'.$lecturer['surname'].', '.$lecturer['firstname'].' '.$lecturer['othername'].'</td><td>'.$lecturer['rank'].'</td></tr>';
                            }else{
                                echo '<tr><td>'.$s_n.'</td><td>'.$lecturer['title'].'</td><td>'.$lecturer['surname'].', '.$lecturer['firstname'].' '.$lecturer['othername'].'</td><td>'.$lecturer['rank'].'</td></tr>';
                            }
                        }else{
                            if($s_n%2 ==0){
                                echo '<tr id = "grey-row"><td>'.$s_n.'</td><td>'.$lecturer['title'].'</td><td>'.$lecturer['surname'].', '.$lecturer['firstname'].'</td><td>'.$lecturer['rank'].'</td></tr>';
                            }else{
                                echo '<tr><td>'.$s_n.'</td><td>'.$lecturer['title'].'</td><td>'.$lecturer['surname'].', '.$lecturer['firstname'].'</td><td>'.$lecturer['rank'].'</td></tr>';
                            }
                        }
                        
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>