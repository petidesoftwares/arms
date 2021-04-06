<?php
    require("../backend/admin-task-function.php");
    $sessions = getTranscriptSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arms.css/admin.css">
    <link rel="stylesheet" href="../arms.css/transcript-main.css">
    <script src=".//custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/admin.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="col-12">
        <div class="menu-bar" onclick="showMenu()">
            <div class="menu-frame">
                <div class="menu-icon-bar-1"></div>
                <div class="menu-icon-bar-2"></div>
                <div class="menu-icon-bar-3"></div>
            </div>
        </div>
        <div id="transcript-form-pane">
            <fieldset>
                <legend>Transcript Option</legend>
                <button id="grad-student">Graduated Student</button> <button id="on-request" onclick = "showOptionalTranscriptPane()">On Request</button>
            </fieldset>
            <div id="transcriptOptionalPane">
                <form action="../backend/transcriptOnRequest.php" method="post" target="_blank">
                    <input type="text" name="t_matno" id="transcript-search-box" placeholder ="Enter Matric Number"> 
                    <select name="transcript_session" id="transcript-session">
                        <?php
                            $secondYear=1;
                            for($i = 1; $i < count($sessions); $i++){
                                $secondYear+= $session[$i];
                                echo '<option value="'.$session[$i].'">'.$session[$i].'/'.$secondYear.'</option>';
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
            <button id="getTranscriptBtn" onclick ="getTranscript()">Generate Transcript</button></div>
        </div>  
        <div id="transcript-response-pane"></div>  
    </div>
</body>
</html>