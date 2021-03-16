<?php
    if(isset($_POST)){
        require("../backend/admin-task-function.php");
        $matno = $_POST['t_matno'];
        $session = $_POST['transcript_session'];
        $level = $_POST['transcript-level'];
        $transcriptData = getTranscriptOnRequest($matno, $session, $level);
        $transcript = json_decode($transcriptData, false);
        $headerData = $transcript->header;
        $sessionArray = $transcript->sessionArray;
        $resultSummary = $transcript->resultSummary;
        $transcriptBody = $transcript->transcriptBody;
        
        $superScripts = array("ST","ND","RD","TH","TH");
        $yearsArray = array("ONE", "TWO", "THREE", "FOUR","FIVE");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requested Transcript</title>
</head>
<body>
    <div class = "page-header">
        <h1>NIGER DELTA UNIVERSITY</h1>
    </div>
    <div class="content">
        <h3>TRANSCRIPT</h3>
        <table>
            <tr><td rowspan="4">AMASSOMA OFFICE; Niger Delta University, Wilberforce Island Amassoma, Bayelsa State,Tel: 089.490899.490900. Date:Aug, 05,2019</td>
            <td rowspan="2"><?php echo $headerData[1]; ?></td><td>FACULTY</td><td>YEAR OF ADMISSION</td><td>DEGREE(S) CONFERRED</td></tr>
            <tr><td>ENGINEERING</td><td><?php echo $headerData[2];?></td><td>B.Eng. ELECTTRICAL/ELECTRONICS ENGINEERING</td></tr>
            <tr><td>REG. NUMBER</td><td>DEPARTMENT</td><td>YEAR OF GRADUATION</td><td>CLASS OF DEGREE</td></tr>
            <tr><td><?php echo $headerData[0];?></td><td>ELECTRIC/ELECTRONICS</td><td>NIL</td><td><?php echo $headerData[3];?></td></tr>
        </table>
        <div>
            <h3>RESULT SUMMARY</h3>
            <table>
                <thead>
                <tr><th rowspan="2">ACADEMIC SESSION</th><th rowspan="2">YEAR OF STUDY</th><th colspan="2">FIRST SEMESTER</th><th colspan="2">SECOND SEMESTER</th></tr>
                <tr><th>G.P.A</th><th>C.G.P.A</th><th>G.P.A</th><th>C.G.P.A</th></tr>
                </thead>
                <tbody>
                    <?php
                        $y_o_study = 0;
                        $summaryBody = "";
                        for ($i=0; $i < count($sessionArray); $i++) { 
                            $y_o_study++;
                            $summaryBody.='<tr><td>'.$sessionArray[$i].'</td><td>'.$y_o_study.'<sup>'.$superScripts[$i].'</sup></td>';
                            for ($j=0; $j < count($resultSummary); $j++) { 
                                $summaryBody.='<td>'.$resultSummary[$j][0].'</td><td>'.$resultSummary[$j][0].'</td>';
                            }
                            $summaryBody.='</tr>';
                        }
                        echo $summaryBody;
                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <?php
                for ($i=0; $i < count($sessionArray); $i++) { 
                    echo '<h3>YEAR '.$yearsArray[$i].' </h3>';
                    echo '<h5> FIRST SEMESTER '.$sessionArray[$i].'</h5>';
                    $s_n = 0;
                    $resultTable = '<table><thead><th>S/N</th><th>COURSE CODE</th><th>COURSE TITLE</th><th>CREDIT UNIT</th><th>LETER GRADE</th><th>GRADE POINT</th></thead><tbody>';
                    $f_s_Array = $transcriptBody[$i][0];
                    for ($j=0; $j < count($f_s_Array); $j++) { 
                        $s_n++;
                        $resultTable.='<tr><td>'.$s_n.'</td>';
                        for ($k=0; $k < count($f_s_Array[$j]); $k++) { 
                        $resultTable.='<td>'.$f_s_Array[$j][$k].'</td>';
                        }
                        $resultTable.='<tr>';
                    }
                    $resultTable.='<tbody></table>';
                    echo $resultTable;
                    
                    echo '<h3>YEAR '.$yearsArray[$i].' </h3>';
                    echo '<h5> SECOND SEMESTER '.$sessionArray[$i].'</h5>';
                    $s_n = 0;
                    $resultTable = '<table><thead><th>S/N</th><th>COURSE CODE</th><th>COURSE TITLE</th><th>CREDIT UNIT</th><th>LETER GRADE</th><th>GRADE POINT</th></thead><tbody>';
                    $f_s_Array = $transcriptBody[$i][1];
                    for ($j=0; $j < count($f_s_Array); $j++) { 
                        $s_n++;
                        $resultTable.='<tr><td>'.$s_n.'</td>';
                        for ($k=0; $k < count($f_s_Array[$j]); $k++) { 
                        $resultTable.='<td>'.$f_s_Array[$j][$k].'</td>';
                        }
                        $resultTable.='<tr>';
                    }
                    $resultTable.='<tbody></table>';
                    echo $resultTable;
                }
            ?>
        </div>
        <div>
            <p>CERTIFIED BY:</p>
            <table>
                <thead>
                    <th>%SCORE</th><th>LETTER GRADE</th><th>GRADE POINT</th>
                </thead>
                <tbody>
                    <tr><td>70 - 100</td><td>A</td><td>5</td></tr>
                    <tr><td>60 - 69</td><td>B</td><td>4</td></tr>
                    <tr><td>50 - 59</td><td>C</td><td>3</td></tr>
                    <tr><td>45 - 49</td><td>D</td><td>2</td></tr>
                    <tr><td>40 - 44</td><td>E</td><td>1</td></tr>
                    <tr><td>0 - 39</td><td>F</td><td>0</td></tr>
                </tbody>
            </table>

            <table>
                <thead>
                    <th>GRADE</th><th>CLASS OF DEGREE</th>
                </thead>
                <tbody>
                    <tr><td>1.0</td><td>FIRST CLASS UPPER DIVISION</td></tr>
                    <tr><td>2.1</td><td>SECOND CLASS UPPER DIVISION</td></tr>
                    <tr><td>2.2</td><td>SECOND CLASS LOWER DIVISION</td></tr>
                    <tr><td>3.0</td><td>THIRD CLASS</td></tr>
                    <tr><td>4.0</td><td>PASS</td></tr>
                    <tr><td>5.0</td><td>CERTIFICATE OF ATTENDANCE</td></tr>
                </tbody>
            </table>
        </div>
        <div>
            <P>G.P.A = GRADE POINT AVERAGE</P>
            <P>C.G.P.A = CUMMULATIVE GRADE POINT AVERAGE</P>
            <P>PASS MARK = 40%</P>
        </div>
    </div>
</body>
</html>