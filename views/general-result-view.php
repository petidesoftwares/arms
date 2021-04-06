<?php
    //Receive inputs
    if(isset($_POST)){
        require("../backend/admin-task-function.php");
        $semester = $_POST['semester'];
        $session = $_POST['session'];
        $level  = $_POST['level'];
        $resultArray = generateResultAppendix($session, $level, $semester);
        $resultArray = json_decode($resultArray, false);
        $allCourse = $resultArray->allRegisteredCourses;
        $newCourses = $resultArray->newCourses;
        $levelCheck = $resultArray->levelCheck;
        if($levelCheck=="others"){
            $repeatedCourses = $resultArray->repeatedCourses;
        }
        $resultBody = $resultArray->resultArray;
        $secondYear = 1;
        $secondYear+=$session;        
    }
    // require("../backend/admin-task-function.php");
    // generateResultAppendix($session, $level, $semester_in);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../arms.css/admin.css"> -->
    <title>Document</title>
</head>
<body>
    <div>
        <div id = "gen-result-header-pane">
            <h3><?php echo strtoupper($semester);?> SEMESTER EXAMINATION RESULT APPENDIX (SHEET)</h3>
            <h3>5-POINT SYSTEM</h3>
            <h5 id="gen-result-header-faculty">FACULTY: ENGINEERING</h5>
            <h5 id="gen-result-header-sesssion">SESSION:<?php echo $session."/".$secondYear; ?></h5><br>
            <h5 id="gen-result-header-dept">DEPARTMENT: ELECTRICAL/ELECTRONICS ENGINEERING</h5>
            <h5 id="gen-result-header-program">PROGRAM/YEAR: B.ENG. ELECTRICAL/ELECTRONICS ENGINEERING/<?php echo $level;?> LEVEL (REGULAR)</h5>
        </div>
        <div class = "gen-tables" id="result-sheet">
            <table>
                <thead>
                    <tr>
                        <th rowspan="4" class="no-transform">S/N</th> <th rowspan="4" class="no-transform">Mtric No.</th> <th rowspan="4" class="no-transform">Name</th><th colspan="<?php echo count($allCourse); ?>" class="no-transform">Registered Courses</th><th rowspan="4"><div class="adjust-alignment">Total Units</div></th><th rowspan="4"><div class="adjust-alignment">Total Grade<br> Point</div></th><th rowspan="4"><div class="adjust-alignment">GPA</div></th><th rowspan="4"><div class="adjust-alignment">Cum. Units</div></th><th rowspan="4"><div class="adjust-alignment">Cum. Grade<br> Point</div></th><th rowspan="4"><div class="adjust-alignment">CGPA</div></th><th colspan="2" class="no-transform">Failed/CarryOver<br> Courses</th><th rowspan="4" class="transform-text">Remarks</th>
                    </tr>
                    <tr>
                        <?php
                            if($levelCheck=="others"){
                                echo '<th colspan="'.count($newCourses[0]).'">New Courses</th><th colspan="'.count($repeatedCourses[0]).'">Repeated Courses</th><th rowspan="3">First Semester</th><th rowspan="3">Second Semester</th>';
                            }else{
                                echo '<th colspan="'.count($newCourses[0]).'">New Courses</th><th rowspan="3" class="no-transform">First Semester</th><th rowspan="3" class="no-transform">Second Semester</th>';
                            }
                        ?>
                    </tr>
                    <tr>
                        <?php
                            for ($c_index=0; $c_index <count($newCourses[0]) ; $c_index++) { 
                                echo "<th>".$newCourses[0][$c_index]."</th>";
                            }
                            if($levelCheck=="others"){
                                for ($c_index_2=0; $c_index_2 <count($repeatedCourses[0]) ; $c_index_2++) { 
                                    echo "<th>".$repeatedCourses[0][$c_index_2]."</th>";
                                }
                            }
                        ?>
                    </tr>
                    <tr>
                        <?php
                            for ($u_index=0; $u_index <count($newCourses[1]) ; $u_index++) { 
                                echo "<th>".$newCourses[1][$u_index]."</th>";
                            }
                            if($levelCheck=="others"){
                                for ($u_index_2=0; $u_index_2 <count($repeatedCourses[1]) ; $u_index_2++) { 
                                    echo "<th>".$repeatedCourses[1][$u_index_2]."</th>";
                                }
                            }
                        ?>
                    </tr>
                </thead>
                <tbody id = "result-table-body">
                    <?php
                    $rows="";
                    $s_n = 0;
                    for ($i=0; $i < count($resultBody); $i++) { 
                        $s_n++;
                        $rows.='<tr><td>'.$s_n.'</td><td>'.$resultBody[$i][0].'</td><td></td>';
                        for ($j=1; $j < count($resultBody[$i]); $j++) { 
                            $rows.='<td>'.$resultBody[$i][$j].'</td>';
                        }
                        $rows.='</tr>';
                    }
                    echo $rows;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>