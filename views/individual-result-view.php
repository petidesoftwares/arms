<?php
    if(isset($_POST)){
        require("../backend/admin-task-function.php");
        $matno = $_POST['matno'];
        $semester = $_POST['semester'];
        $session = $_POST['session'];
        $level  = $_POST['level'];
        $encodedResult = individualStudentResult($matno, $session, $level, $semester);
        $resultData = json_decode($encodedResult, false);
        $headerData = $resultData->headerData;
        $resultArray = $resultData->resultArray;
        $totalUnits = $resultData->totalUnits;
        $totalGradePoint = $resultData->totalGradePoint;
        $gpa = $resultData->gpa;
        $cumm_units = $resultData->cumm_units;
        $cumm_gp = $resultData->cumm_gp;
        $cgpa = $resultData->cgpa;
        $fSemesterFailedCourses = $resultData->fSemesterFailedCourses;
        $sSemesterFailedCourses = $resultData->sSemesterFailedCourses;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <div>
            <span>NAME: <?php for ($i=1; $i < count($headerData); $i++) { 
                echo $headerData[$i] ." ";
            } echo "<br>"?></span>
            <span>MAT. NUMBER: <?php echo $headerData[0];?></span>
        </div>
        <table id="individual-result-table">
            <thead>
                <th>S/N<sup id="s-n-underline">o</sup></th>
                <th>COURSE CODE</th>
                <th>COURSE TITLE</th>
                <th>UNIT</th>
                <th>SCORE</th>
                <th>GRADE</th>
                <th>GRADE POINT</th>
                <th>REMARK</th>
            </thead>
            <tbody>
                <?php
                $s_n =0;
                for($i = 0; $i<count($resultArray); $i++){
                    $s_n++;
                    $t_rows='<tr><td>'.$s_n.'</td>';
                    for ($j=0; $j <count($resultArray[$i]) ; $j++) { 
                        $t_rows.='<td>'.$resultArray[$i][$j].'</td>';
                    }
                    $t_rows.='</tr>';
                    echo $t_rows;
                }
                ?>
            </tbody>
        </table>
    </div>
    <div id ="individual-cumm-result-data">
        <table>
            <tr><td>TOTAL GRADE POINT</td><td><?php echo $totalGradePoint; ?></td></tr>
            <tr><td>TOTAL REGISTERED UNITS</td><td><?php echo $totalUnits ?></td></tr>
            <tr><td>G.P.A</td><td><?php echo $gpa; ?></td></tr>
            <tr><td>CUMMULATIVE GRADE POINT</td><td><?php echo $cumm_gp; ?></td></tr>
            <tr><td>CUMMULATIVE UNIT</td><td><?php echo $cumm_units; ?></td></tr>
            <tr><td>C.G.P.A</td><td><?php echo $cgpa; ?></td></tr>
            <tr><td>TOTAL UNITS PASSED</td><td></td></tr>
        </table>
    </div>
    <div>
        <form action="../backend/individual-result-PDF.php" method="post" target="_blank">
            <input type="hidden" name="matno" value="<?php echo $matno?>" id="ind-student-matno">
            <input type="hidden" name="semester" value="<?php echo $semester?>" id="ind-student-semester">
            <input type="hidden" name="session" value="<?php echo $session?>" id="ind-student-session">
            <input type="hidden" name="level" value="<?php echo $level?>" id="ind-student-level">
            <input type="submit" name="ind-pdf-result" value="Generate PDF" id="individual-result-pdf-btn">
        </form>
    </div>
</body>
</html>