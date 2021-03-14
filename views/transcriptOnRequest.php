<?php
    if(isset($_POST)){
        require("../backend/admin-task-function.php");
        $matno = $_POST['t_matno'];
        $session = $_POST['transcript_session'];
        $level = $_POST['transcript-level'];
        $transcriptData = getTranscriptOnRequest($matno, $session, $level);
        $transcript = json_decode($transcriptData, false);
        $headerData = $transcript->header;
        $headerData[0];
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
            <tr><td><?php echo $headerData[0];?></td><td>ELECTRIC/ELECTRONICS</td><td>NIL</td><td><?php $headerData[3];?></td></tr>
        </table>
    </div>
</body>
</html>