<?php
    set_include_path(get_include_path().PATH_SEPARATOR."/path/to/dompdf");
    require_once("../dompdf/autoload.inc.php");
    ob_start();
    if(isset($_POST)){
        require("../backend/admin-task-function.php");
        $matno = $_POST['t_matno'];
        $session = $_POST['transcript_session'];
        $level = $_POST['transcript-level'];
        $screenWidth = $_POST['sreen-width'];
        $transcriptData = getTranscriptOnRequest($matno, $session, $level);
        $transcript = json_decode($transcriptData, false);
        $headerData = $transcript->header;
        $sessionArray = $transcript->sessionArray;
        $resultSummary = $transcript->resultSummary;
        $transcriptBody = $transcript->transcriptBody;
        
        $superScripts = array("ST","ND","RD","TH","TH");
        $yearsArray = array("ONE", "TWO", "THREE", "FOUR","FIVE");

        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../arms.css/transcript-on-request.css">
            <title>Requested Transcript</title>
        </head>
        <body>
            <div class = "page-header">
                <h1>NIGER DELTA UNIVERSITY</h1>
                <p>Wilberforce Island, Bayelsa State</p>
            </div>
            <div class="content">
                <div id ="addressing-pane">
                    <p>AMASSOMA OFFICE; <br>Niger Delta University,<br> Wilberforce Island <br> Amassoma, Bayelsa State,<br>Tel: 089.490899.490900.</p>
                    <span>Our Ref:<span class = "underline_italice">NDU/ACD/ER/T/I/105</span></span><br>
                    <span id="address-date">Date: <span class = "underline_italice">'.date("M,d,Y").'</span></span><br>
                    <span>Your Ref:<span id="your-ref">.................................</span></span>
                </div>
                <div class="body">
                    <h3>TRANSCRIPT</h3>
                    <table>
                        <tr><td rowspan="4" id ="main-transcript-address">AMASSOMA OFFICE;<br> Niger Delta University, Wilberforce Island  Amassoma, Bayelsa State, Tel: 089.490899.490900. '. date("M,d,Y").'</td>
                        <td rowspan="2">'.$headerData[1].'</td><td>FACULTY</td><td>YEAR OF ADMISSION</td><td id="header-last-col">DEGREE(S) CONFERRED</td></tr>
                        <tr><td>ENGINEERING</td><td>'.$headerData[2].'</td><td>B.Eng.<br> ELECTTRICAL/<br>ELECTRONICS<br> ENGINEERING</td></tr>
                        <tr><td>REG. NUMBER</td><td>DEPARTMENT</td><td>YEAR OF GRADUATION</td><td>CLASS OF DEGREE</td></tr>
                        <tr><td>'.$headerData[0].'</td><td>ELECTRIC/ELECTRONICS</td><td>NIL</td><td>'.$headerData[3].'</td></tr>
                    </table>
                    <div>
                        <h3>RESULT SUMMARY</h3>
                        <table>
                            <thead>
                            <tr><th rowspan="2">ACADEMIC SESSION</th><th rowspan="2">YEAR OF STUDY</th><th colspan="2">FIRST SEMESTER</th><th colspan="2">SECOND SEMESTER</th></tr>
                            <tr><th>G.P.A</th><th>C.G.P.A</th><th>G.P.A</th><th>C.G.P.A</th></tr>
                            </thead>
                            <tbody>';
                                    $y_o_study = 0;
                                    $summaryBody = "";
                                    for ($i=0; $i < count($sessionArray); $i++) { 
                                        $y_o_study++;
                                        $summaryBody.='<tr><td>'.$sessionArray[$i].'</td><td>'.$y_o_study.'<sup>'.$superScripts[$i].'</sup></td>';
                                        for ($j=0; $j < count($resultSummary[$i]); $j++) { 
                                            $summaryBody.='<td>'.$resultSummary[$i][$j].'</td>';
                                        }
                                        $summaryBody.='</tr>';
                                    }
                                    $html.= $summaryBody;
                            $html.='</tbody>
                        </table>
                    </div>
                    <div>';
                        $addedString ="";
                            for ($i=0; $i < count($sessionArray); $i++) { 
                                $addedString.= '<h3>YEAR '.$yearsArray[$i].' </h3>';
                                $addedString.= '<h5> FIRST SEMESTER '.$sessionArray[$i].'</h5>';
                                $s_n = 0;
                                $resultTable = '<table> 
                                                    <thead>
                                                       <tr>
                                                            <th>S/N</th>
                                                            <th>COURSE CODE</th>
                                                            <th>COURSE TITLE</th>
                                                            <th>CREDIT UNIT</th>
                                                            <th>LETER GRADE</th>
                                                            <th>GRADE POINT</th>
                                                        </tr>
                                                    </thead> 
                                                    <tbody>';
                                $f_s_Array = $transcriptBody[$i][0];
                                for ($j=0; $j < count($f_s_Array); $j++) { 
                                    $s_n++;
                                    $resultTable.='<tr><td>'.$s_n.'</td>';
                                    for ($k=0; $k < count($f_s_Array[$j]); $k++) { 
                                    $resultTable.='<td>'.$f_s_Array[$j][$k].'</td>';
                                    }
                                    $resultTable.='</tr>';
                                }
                                $resultTable.='</tbody></table>';
                                $addedString.=$resultTable;
                                
                                $addedString.='<h3>YEAR '.$yearsArray[$i].' </h3>';
                                $addedString.='<h5> SECOND SEMESTER '.$sessionArray[$i].'</h5>';
                                $s_n = 0;
                                $addedString.= '<table>
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>COURSE CODE</th>
                                                            <th>COURSE TITLE</th>
                                                            <th>CREDIT UNIT</th>
                                                            <th>LETER GRADE</th>
                                                            <th>GRADE POINT</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
                                $f_s_Array = $transcriptBody[$i][1];
                                for ($j=0; $j < count($f_s_Array); $j++) { 
                                    $s_n++;
                                    $addedString.='<tr><td>'.$s_n.'</td>';
                                    for ($k=0; $k < count($f_s_Array[$j]); $k++) { 
                                        $addedString.='<td>'.$f_s_Array[$j][$k].'</td>';
                                    }
                                    $addedString.='</tr>';
                                }
                                $addedString.='</tbody></table>';
                                // echo $resultTable;
                            }
                            $html.=$addedString;
                    $html.='</div>
                    <div>
                        <p id ="cert-officer">CERTIFIED BY:
                            <br><span>EXAMS & RECORD OFFICER <br>FOR REGISTRAR</span>
                        </p>
                        <div>
                            <table>
                                <thead>
                                    <tr><th>%SCORE</th> <th>LETTER GRADE</th> <th>GRADE POINT</th></tr>
                                </thead>
                                <tbody>
                                    <tr><td>70 - 100</td><td>A</td><td>5</td></tr>
                                    <tr><td>60 - 69</td> <td>B</td> <td>4</td> </tr>
                                    <tr><td>50 - 59</td> <td>C</td> <td>3</td> </tr>
                                    <tr><td>45 - 49</td> <td>D</td> <td>2</td> </tr>
                                    <tr><td>40 - 44</td> <td>E</td> <td>1</td> </tr>
                                    <tr><td>0 - 39</td><td>F</td><td>0</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div id = "class-of-degree-list">
                            <table>
                                <thead>
                                    <tr><th>GRADE</th><th>CLASS OF DEGREE</th></tr>
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
                    </div>
                    <div id = "abbr-key">
                        <P>G.P.A = GRADE POINT AVERAGE</P>
                        <P>C.G.P.A = CUMMULATIVE GRADE POINT AVERAGE</P>
                        <P>PASS MARK = 40%</P>
                    </div>
                </div>
            </div>
        </body>
        </html>';
    }
    use Dompdf\Dompdf;
    $dompdf=new Dompdf();
    //$html = file_get_contents("dompdfhtml.php");

    $dompdf->load_html($html);
    $canvas = $dompdf->get_canvas();
    $canvas->page_text(272,770,"Page: {PAGE_NUM} of {PAGE_COUNT}",
                    "",12,array(0,0,0));
    $dompdf->render();
    if($screenWidth<=600){
        $output=$dompdf->output();
        file_put_contents("C:/Users/Dell/Documents/".$level."/".$session." General Result.pdf",$output);
    }else {
        $dompdf->stream("".$level."/".$session." General Result.pdf", array("Attachment"=>false));
    }
    exit(0);
?>