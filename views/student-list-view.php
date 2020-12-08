
<?php
     require("../backend/admin-task-function.php");
     $students = getAllStudents();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentList</title>
</head>
<body>
    <table>
        <thead id = "grey-row">
            <th>S/N</th>
            <th>Mat. Number</th>
            <th>Student Full Name</th>
        </thead>
        <tbody>
            <?php
                $s_n = 0;
                foreach($students as $student){
                    $s_n++;
                    if($s_n%2==0){
                        echo '<tr id = "grey-row"><td>'.$s_n.'</td><td><button id = "getStudent_id" onclick = "getStudentId()">'.$student['matno'].'</button></td><td>'.$student['surname'].', '.$student['firstname'].' '.$student['othername'].'</td></tr>';
                    }else{
                        echo '<tr><td>'.$s_n.'</td><td><button id = "getStudent_id" onclick = "getStudentId()">'.$student['matno'].'</button></td><td>'.$student['surname'].', '.$student['firstname'].' '.$student['othername'].'</td></tr>';
                    }   
                }
            ?>
        </tbody>
    </table>
</body>
</html>