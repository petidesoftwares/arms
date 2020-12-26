
<?php
     require("../backend/admin-task-function.php");
     $students = getAllStudents();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/admin.js"></script>
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
                        echo '<tr id = "grey-row"><td>'.$s_n.'</td><td id = "getStudent_id_'.$s_n.'" onclick = "getStudentId('.$s_n.')">'.$student['matno'].'</td><td onclick = "getStudentId('.$s_n.')">'.$student['surname'].', '.$student['firstname'].' '.$student['othername'].'</td onclick = "getStudentId('.$s_n.')"></tr>';
                    }else{
                        echo '<tr><td>'.$s_n.'</td><td id = "getStudent_id_'.$s_n.'" onclick = "getStudentId('.$s_n.')">'.$student['matno'].'</td><td onclick = "getStudentId('.$s_n.')">'.$student['surname'].', '.$student['firstname'].' '.$student['othername'].'</td onclick = "getStudentId('.$s_n.')"></tr>';
                    }   
                }
            ?>
        </tbody>
    </table>
</body>
</html>