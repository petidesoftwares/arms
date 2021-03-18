<?php
    require("../backend/admin-task-function.php");
    $sessions = getSessions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src=".//custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/admin.js"></script>
    <title>Document</title>
</head>
<body>
    <div>
        <fieldset>
            <legend>Transcript Option</legend>
            <button>Graduated Student</button> <button onclick = "showOptionalTranscriptPane()">On Request</button>
        </fieldset>
        <div id="transcriptOptionalPane">
            <form action="../backend/transcriptOnRequest.php" method="post" target="_blank">
                <input type="search" name="t_matno" id="transcript-search-box" placeholder ="Enter Matric Number"> 
                <select name="transcript_session" id="transcript-session">
                    <?php
                        $secondYear=1;
                        foreach($sessions as $session){
                            $secondYear+= $session['year'];
                            echo '<option value="'.$session['year'].'">'.$session['year'].'/'.$secondYear.'</option>';
                        }
                    ?>
                </select>
                <select name="transcript-level" id="transcript-level">
                    <option>Select Level</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="400">400</option>
                </select>
                <input type="submit" value="Submit" id="submit-transcript-request">
            </form>
        <button onclick ="getTranscript()">Generate Transcript</button></div>
    </div>  
    <div id="transcript-response-pane"></div>  
</body>
</html>