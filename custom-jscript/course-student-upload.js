$(document).ready(function(){
    hideModal();
    $("#single-upload").css({"background-color":"#708090","color":"white"});
    $("#single-upload-form").hide();
})

function singleUpload(){
    $("#single-upload").css({"background-color":"white","color":"black","border-left":"none","border-bottom-right-radius":"0px"});
    $("#batch-upload").css({"background-color":"#708090","color":"white","border-bottom-right-radius":"5px","border-bottom-left-radius":"5px"});
    $("#form-pane").hide();
    $("#single-upload-form").show();
}
function batchUpload(){
    $("#single-upload").css({"background-color":"#708090","color":"white","border-radius":"5px"});
    $("#batch-upload").css({"background-color":"white","color":"black","border-bottom-right-radius":"5px","border-bottom-left-radius":"0px"});
    $("#form-pane").show();
    $("#single-upload-form").hide();
}
/****************** Batch upload samplel file download starts here **************/
function downLoadCourseFile(){
    window.location.href="../downloads/Course Registration.xlsx";
}

function downloadStudentUploadFile(){
    window.location.href="../downloads/Student Registration File.xlsx";
}

function downloadLecturerRregistrationFile(){
    window.location.href="../downloads/Lecturers Upload File.xlsx";
}
/**************** Ends here ********************/

/***************Single upload processing starts here *****************/

function submitStudent(){
    if($("#reg_number").val()==""){
        $("#modal").show();
        $("#validation-info").html("A valid registration or matric number cannot be empty");
    }
    else if($("#reg_number").val().length <10){
        $("#modal").show();
        $("#validation-info").html("A valid registration number or matric number must have a minimum of 10 characters");
    }
    else if($("#fname").val()==""){
        $("#modal").show();
        $("#validation-info").html("A valid first name cannot be empty");
    }
    else if($("#fname").val().length <3){
        $("#modal").show();
        $("#validation-info").html("A valid first name must have a minimum of 3 characters");
    }
    else if($("#surname").val()==""){
        $("#modal").show();
        $("#validation-info").html("A valid surname cannot be empty");
    }
    else if($("#surname").val().length <3){
        $("#modal").show();
        $("#validation-info").html("A valid surname must have a minimum of 3 characters");
    }
    else{
        var session = $("#admission_session").val();
        var matno = $("#reg_number").val();
        var fname = $("#fname").val();
        var surname = $("#surname").val();
        var level = $("#admission_level").val();
        $.post("../backend/process-single-student-upload.php", {session:session, matno: matno, fname:fname, surname:surname, level:level},function(data){
            if(data == "Student successfully registered"){
                $("#reg_number").val("");
                $("#fname").val("");
                $("#surname").val("");
                $("#admission_level").val("100");
                $("#modal").show();
                $("#validation-info").css("color","green");
                $("#validation-info").html(data);
                
            }
            else{
                $("#modal").show();
                $("#validation-info").html(data);
            }
            
        })
    }
}

function submitCourse(){
    if($("#course_code").val()==""){
        $("#modal").show();
        $("#validation-info").html("A valid course code cannot be empty");
    }
    else if($("#course_code").val().length <6){
        $("#modal").show();
        $("#validation-info").html("A valid course code must have a minimum of 4 characters");
    }
    else if($("#course_title").val()==""){
        $("#modal").show();
        $("#validation-info").html("A valid course title cannot be empty");
    }
    else if($("#course_title").val().length <6){
        $("#modal").show();
        $("#validation-info").html("A valid course title must have a minimum of 6 characters.");
    }
    else if($("#unit").val()==""){
        $("#modal").show();
        $("#validation-info").html("Units cannot be empty.");
    }
    else if($("#unit").val()==0){
        $("#modal").show();
        $("#validation-info").html("A valid unit cannot be 0.");
    }
    else if($("#min_pass_mark").val()==""){
        $("#modal").show();
        $("#validation-info").html("Minimum pass mark cannot be empty");
    }
    else if($("#min_pass_mark").val()<45){
        $("#modal").show();
        $("#validation-info").html("Minimum pass mark cannot be less than 45");
    }
    else{
        var session = $("#academic_session").val();
        var code = $("#course_code").val();
        var title = $("#course_title").val();
        var unit = $("#unit").val();
        var semester = $("input:checked").val();
        var level = $("#course_level").val();
        var option = $("#course_option").val();
        var status = $("#course_status").val();
        var min_pass_mark = $("#min_pass_mark").val();
        $.post("../backend/process-single-course-upload.php", {session:session, code: code, title:title, unit:unit, semester:semester, level:level, option:option, status:status, min_pass_mark:min_pass_mark},function(data){
            if(data == "Course successfully uploaded"){
                $("#course_code").val("");
                $("#course_title").val("");
                $("#unit").val("");
                $("#course_level").val("100");
                $("#course_status").val("Compulsory");
                $("#min_pass_mark").val("");
                $("#modal").show();
                $("#validation-info").css("color","green");
                $("#validation-info").html(data);
                
            }
            else{
                $("#modal").show();
                $("#validation-info").html(data);
            }
            
        })
    }
}
function submitLecturer(){
     if($("#l_fname").val()==""){
        $("#modal").show();
        $("#validation-info").html("A valid first name cannot be empty");
    }
    else if($("#l_fname").val().length <3){
        $("#modal").show();
        $("#validation-info").html("A valid first name must have a minimum of 3 characters");
    }
    else if($("#l_surname").val()==""){
        $("#modal").show();
        $("#validation-info").html("A valid surname cannot be empty");
    }
    else if($("#l_surname").val().length <3){
        $("#modal").show();
        $("#validation-info").html("A valid surname must have a minimum of 3 characters");
    }
    else if($("#mobile").val()==""){
        $("#modal").show();
        $("#validation-info").html("A valid mobile phone number cannot be empty");
    }
    else if($("#mobile").val().length<11){
        $("#modal").show();
        $("#validation-info").html("A valid mobile phone number must have a minimum of 11 digits");
    }
    else{
        var title = $("#title").val();
        var fname = $("#l_fname").val();
        var surname = $("#l_surname").val();
        var mobile = $("#mobile").val();
        $.post("../backend/process-single-lecturer-upload.php", {title:title, fname:fname, surname:surname, mobile:mobile},function(data){
            if(data == "Lecturer successfully uploaded"){
                $("#l_fname").val("");
                $("#l_surname").val("");
                $("#mobile").val("");
                $("#modal").show();
                $("#validation-info").css("color","green");
                $("#validation-info").html(data);
                
            }
            else{
                $("#modal").show();
                $("#validation-info").html(data);
            }
            
        })
    }
}

function hideModal(){
    $("#modal").hide();
}

/****************** Ends here ***********************/