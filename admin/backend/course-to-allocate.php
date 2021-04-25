<?php
    if(isset($_POST)){
        require("../backend/admin-task-function.php");
        $level = $_POST['level'];
        $semester = $_POST['semester'];
        $course_to_allocate = getCoursesToAllocate($semester, $level);
        $formatedNames = getFormatedLecturerNames();
        $s_n = 0;
        $table_lent=0;
        $output = "";
        foreach($course_to_allocate as $course){
            $s_n++;
            $table_lent++;
            $output.='<tr><td>'.$s_n.'</td><td id="code_'.$s_n.'">'.$course['code'].'</td><td>'.$course['title'].'</td><td><select id = "course_lecturer_'.$s_n.'">';
            foreach($formatedNames as $name){
                if($name['gender']=="Male"){
                    if(array_key_exists("othername", $name)){
                        if($name['othername']=="" || $name['othername']==null){
                            $output.='<option value="'.$name['id'].'">'.$name['title'].' '.substr($name['firstname'],0 , 1).' '.$name['surname'].'</option>';
                        }else{
                            $output.='<option value="'.$name['id'].'">'.$name['title'].' '.substr($name['firstname'], 0, 1).'. '.substr($name['othername'], 0, 1).'. '.$name['surname'].'</option>';
                        }                                                                                    
                    }else{
                        $output.='<option value="'.$name['id'].'">'.$name['title'].' '.substr($name['firstname'],0 , 1).' '.$name['surname'].'</option>';
                    }
                }else{
                    if(array_key_exists("othername", $name)){ 
                        if($name['othername']=="" || $name['othername']==null){
                            $output.='<option value="'.$name['id'].'">'.$name['title'].' '.$name['firstname'].' '.$name['surname'].'</option>';
                        }else{
                            $output.='<option value="'.$name['id'].'">'.$name['title'].' '.$name['firstname'].'. '.substr($name['othername'],0,1).'. '.$name['surname'].'</option>';
                        }                                                   
                    }else{
                        $output.='<option value="'.$name['id'].'">'.$name['title'].' '.$name['firstname'].' '.$name['surname'].'</option>';
                    }
                }
            }
            $output.='</select></td></tr>';
        }
        $output.='<tr hidden><td><input type="number" name="col-size" id ="col-size" value ="'.$table_lent.'"></td><td></td><td></td></tr>';
        echo $output;
    }
?>