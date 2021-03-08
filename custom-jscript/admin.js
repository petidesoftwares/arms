var courseTitle = "";
$(document).ready(function(){
    $("#selected-student-form-level1").hide();
    $("#selected-student-form-level2").hide();
    $("#selected-student-form").hide();
    hideModal();
    $("#modal").hide();
    $("#select_att_option").hide();
    $("#course-table-display-pane").hide();
    $("#att-sheet").hide();
    $("#result-batch-upload").hide();
    $("#result-form-upload").hide();
    $("#transcriptOptionalPane").hide();
})

function checkAllStudents(){
    $.post("student-list-view.php", function(data){
        $("#list-view").html(data);
        $("#list-view").css("border","solid 0.2em #708090");
    })
}

function getStudentId(a){
    $("#biodata-table").html("");
    var matno = $("#getStudent_id_"+a).html();
    var currentSession = $("#academic-session").val();
    $.post("../backend/get-students-biodata.php",{matno:matno},function(data){
        data = JSON.parse(data);
        for(var i = 0;  i < data.length; i++){
            var biodata = data[i];
            var student_matno = biodata.matno;
            var fname = biodata.firstname;
            var surname = biodata.surname;
            var othername = "";
            if(othername in biodata){
                othername = biodata.othername;
            }
            var adm_session = biodata.admission_session;
            var studentLevel;
            if(adm_session>currentSession){
                studentLevel = currentSession-adm_session;
            }else{
                studentLevel = 100;
            }
            if(verifyStudentPhoto(student_matno)==false){
                document.getElementById("student_photo").innerHTML = '<img src="../images/human.png"/>';
            }else{
                document.getElementById("student_photo").innerHTML = '<img src="'+verifyStudentPhoto(student_matno)+'"/>';
            }
            document.getElementById("biodata-table").innerHTML+='<tr><td>Mat Number:</td><td>'+student_matno+'</td></tr>'+
            '<tr><td>Surname:</td><td>'+surname+'</td></tr>'+
            '<tr><td>Firt Name:</td><td>'+fname+'</td></tr>'+
            '<tr><td>Othername:</td><td>'+othername+'</td></tr>'+
            '<tr><td>Level:</td><td>'+studentLevel+'</td></tr>';
        }
    });
}

function verifyStudentPhoto(imageName){
    var image  = new Image();
    var image_url = "../images/"+imageName+".png";
    image.src = image_url;
    if(image.width==0){
        return false;
    }else{
        return image_url;
    }
     
}

function checkSelectedStudents(){
    $("#selected-student-form").show(300);
}

function checkByLevel(){
    $("#selected-student-form-level2").hide();
    $("#selected-student-form-level1").show(300);    
}

function getSelectedStudents(){
    var level = $("#select-level").val();
    var session = $("#by-level-session").val();
    $.post("../backend/get-students-by-level.php",{level:level, session:session},function(data){
        if(data.indexOf("ERROR!")>=0){
            alert(data);
        }else{
            var output='<table><thead id = "grey-row"><th>S/N</th><th>Mat Number</th><th>Full Name</th></thead><tbody>';
            var s_n = 0;
            var data = JSON.parse(data);
            for(var i = 0; i<data.length;i++){
                var b_data = data[i];
                var matno = b_data.matno;
                var fname = b_data.firstname;
                var surname = b_data.surname;
                var othername = b_data.othername;
                s_n++;
                if(s_n%2==0){
                    output+='<tr id = "grey-row"><td>'+s_n+'</td><td id = "getStudent_id_'+s_n+'" onclick = "getStudentId('+s_n+')">'+matno+'</td><td onclick = "getStudentId('+s_n+')">'+surname+', '+fname+' '+othername+'</td></tr>';
                }else{
                    output+='<tr><td>'+s_n+'</td><td id = "getStudent_id_'+s_n+'" onclick = "getStudentId('+s_n+')">'+matno+'</td><td onclick = "getStudentId('+s_n+')">'+surname+', '+fname+' '+othername+'</td></tr>';
                }
                
            }
            output+='</tbody></table>';
            // alert(output);
            document.getElementById("list-view").innerHTML=output;
            $("#list-view").css("border","solid 0.2em #708090");
        }
    })
}

function checkByStatus(){
    $("#selected-student-form-level1").hide();
    $("#selected-student-form-level2").show(300);
}

function hideModal(){
    $("#modal").hide();
}
function hideModal_2(){
    $("#modal").hide();
    window.location.href="home.php";
}


function validate(){
    var valid=true;
    var message;
    if($("#title").val()=="Select Title"){
        valid=false;
        message = "Please select a valid title!";
    }
    else if($("#fname").val()=="" || $("#fname").val().length<3){
        valid = false;
        message = "First name field cannot be empty and it must be 3 characters and above!";
    }
    else if($('#surname').val()=="" || $('#surname').val().length<3){
        valid = false;
        message = "Surame field cannot be empty and it must be 3 characters and above!";
    }
    else if($('#rank').val()=="Select Rank"){
        valid = false;
        message = "Please select a valid rank!";
    }
    else if($('#mobile').val()=="" || $('#mobile').val().length<11){
        valid = false;
        message = "A valid phone number must be 11 (or 14 with area code) digits!";
    }
    else if($('#email').val()=="" || $('#email').val().length<6 || $('#email').val().search("@")==-1 || $('#email').val().search(".com")==-1){
        valid = false;
        message = "A valid email must have more than 5 character, it must contain @ and end with .com !";
    }
    else if($('#password').val()=="" || $('#password').val().length<6){
        valid = false;
        message = "A valid password must be more than 6 characters";
    }
    else if($('#password').val()!=$('#c_password').val()){
        valid = false;
        message = "Password confirmation failed!";
    }
    if(valid == false){
        $("#modal").show();
        $("#validation-info").html(message);
    }
    return valid;
}

function addSecondAdminBtn(){
    $("#second_admin_form").submit(function(e){
        e.preventDefault();
        if(validate()){
            alert("validated");
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: '../backend/process-second-admin.php',
                data : new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(){
                    $('#submit').attr('disable', 'disable');
                },
                success: function(response){
                    $("#modal").show();
                    $("#validation-info").css("color","green");
                    $("#validation-info").html(response);
                    $('submit').removeAttr('disable');
                },
                error: function(e){
                    $("#modal").show();
                    $("#validation-info").css("color","red");
                    $("#validation-info").html("ERROR: "+e);
                },
                
            });
        }
    })
}

function submitSecondadmin(){
    var admin = $("#lecturer_admin").val();
    var position = $("#position").val();
    $.post("../backend/process-system-second-admin.php", {admin:admin, position:position}, function(data) {
        $("#modal").show();
        $("#validation-info").css("color","green");
        $("#validation-info").html(data);
    });
}

/*************** Attendance Script *****************/
function activateLevel(){
    $("#select-att-level").prop("disabled", false);
}
function getAttendanceCourseList() {
    var session = $("#academic-session").val();
    var semester = $("input[name='semester']:checked").val();
    var level = $("#select-att-level").val();
    if(level >= 400){
        $("#select_att_option").show(500);  
    }else{
        var option = "All";
        $.ajax({
            type:"POST",
            url:"../backend/get-attendance-courses.php",
            data:{session:session, semester:semester,level:level,option:option},
            cache: false,
            success:function(data){
                if(data.indexOf("ERROR!")>=0){
                    alert(data);
                }else{
                    var data = JSON.parse(data);
                    for(var i = 0; i<data.length; i++){
                        var obj = data[i];
                        var code = obj.code;
                        var title = obj.title;
                        var units = obj.units;

                        $("#course-table-display-pane").show();
                        if(i%2!==0){
                            document.getElementById("course-table-body").innerHTML+='<tr id="greyed"><td id = "code'+i+'" onclick = "getCode('+i+')">'+code+'</td><td id = "title'+i+'" onclick = "getCode('+i+')">'+title+'</td><td id = "units'+i+'" onclick = "getCode('+i+')">'+units+'</td</tr>';
                        }else{
                            document.getElementById("course-table-body").innerHTML+='<tr><td id = "code'+i+'" onclick = "getCode('+i+')">'+code+'</td><td id = "title'+i+'" onclick = "getCode('+i+')">'+title+'</td><td id = "units'+i+'" onclick = "getCode('+i+')">'+units+'</td</tr>';
                        }
                    }
                }
            }
        });
    }
}

function  getAttendanceWithOption() {
    var session = $("#academic-session").val();
    var semester = $("input[name='semester']:checked").val();
    var level = $("#select-att-level").val();
    var option = $("#select_att_option").val();
        $.post("../backend/get-attendance-courses.php",{session:session, semester:semester,level:level,option:option},function(data){
            if(data.indexOf("ERROR!")>=0){
                alert(data);
            }else{
                data = JSON.parse(data);
                for(var i = 0; i<data.length; i++){
                    var obj = data[i];
                    var code = obj.code;
                    var title = obj.title;
                    var units = obj.units;
                    $("#course-table-display-pane").show();
                        if(i%2!==0){
                            document.getElementById("course-table-body").innerHTML+='<tr id="greyed"><td id = "code" onclick = "getCode('+i+')">'+code+'</td><td id = "title'+i+'" onclick = "getCode('+i+')">'+title+'</td><td id = "units'+i+'" onclick = "getCode('+i+')">'+units+'</td</tr>';
                        }else{
                            document.getElementById("course-table-body").innerHTML+='<tr><td id = "code" onclick = "getCode('+i+')">'+code+'</td><td id = "title'+i+'" onclick = "getCode('+i+')">'+title+'</td><td id = "units'+i+'" onclick = "getCode('+i+')">'+units+'</td</tr>';
                        }
                }
            }
        })
}

function getCode(a){
    var code = $("#code"+a+"").html();
    var session = $("#academic-session").val();
    
    $("#course_code").val(code);
    $("#units").val($("#units"+a+"").html());
    $("#semester").val($("input[name='semester']:checked").val());
    $("#session").val(session);
    $("#title").val($("#title"+a+"").html());

    $("#att-sheet").show();
    $("#att_list_body").html("");
    $.post("../backend/get-enrolled-level.php",{code:code, session:session},function(data){
        
        data = JSON.parse(data);
        for(var i =0;i < data.length; i++){
            var obj = data[i];
            var level = obj.level;
            document.getElementById("att_list_body").innerHTML+='<tr><td colspan="9">'+level+'</td></tr>';
            $.post("../backend/generate-attendance-list.php",{code:code, session:session, level:level},function(data_2){
                data_2 = JSON.parse(data_2);
                var s_n = 0;
                for(var j = 0; j<data_2.length; j++){
                    var obj_2 = data_2[j];
                    var matno = obj_2.matno;
                    var fname = obj_2.firstname;
                    var surname = obj_2.surname;
                    var othername;
                    if(othername in obj_2){
                        othername = obj_2.othername;
                    }else{
                        othername = "";
                    }
                    s_n++;
                    document.getElementById("att_list_body").innerHTML+='<tr><td>'+s_n+'</td><td>'+matno+'</td><td>'+fname+' '+surname+' '+othername+'</td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>';
                }
            })
        }
    })
    
}

function getLecturerDetails(a){
    var lecturerID = $("#lectrer_detail_"+a+"").html();
    alert(lecturerID);
}
/*************** Result Upload*******************/
function getCurrentCourses(){
    var semester = $("input[name='result-semester-upload']:checked").val();
    var level = $("#upload-result-level").val();
    var session = $("#academic-session").val();
    $.post("../backend/get-enrolled-courses.php",{semester:semester, level:level, session:session}, function(data){
        if(data.indexOf("No")>=0){
            alert(data);
        }else{
            alert("yeah");
            var data = JSON.parse(data);
            for(var i = 0; i<data.length; i++){
                var obj = data[i];
                var code = obj.code;
                var title = obj.title;
                var units = obj.units
                $("#result-batch-upload").show();
                if(i%2!==0){
                    document.getElementById("course-table-body").innerHTML+='<tr id="greyed"><td id = "code'+i+'" onclick = "getResultCourseCode('+i+')">'+code+'</td><td id = "title'+i+'" onclick = "getResultCourseCode('+i+')">'+title+'</td><td id = "units'+i+'" onclick = "getResultCourseCode('+i+')">'+units+'</td><td id="get-sample-file'+i+'" onclick="downloadResultFile('+i+')">Download Resultsheet File</td></tr>';
                }else{
                    document.getElementById("course-table-body").innerHTML+='<tr><td id = "code'+i+'" onclick = "getResultCourseCode('+i+')">'+code+'</td><td id = "title'+i+'" onclick = "getResultCourseCode('+i+')">'+title+'</td><td id = "units'+i+'" onclick = "getResultCourseCode('+i+')">'+units+'</td><td id="get-sample-file'+i+'" onclick="downloadResultFile('+i+')">Download Resultsheet File</td></tr>';
                }
            }
        }
    })
}

function getReseatCourses(){
    var semester = $("input[name='result-semester-upload']:checked").val();
    var level = $("#upload-result-level").val();
    var session = $("#academic-session").val();
    $.post("../backend/get-enrolled-failed-courses.php",{semester:semester, level:level, session:session}, function(data){
        if(data.indexOf("No")>=0){
            alert(data);
        }else{
            var data = JSON.parse(data);
            for(var i = 0; i<data.length; i++){
                var obj = data[i];
                var code = obj.code;
                var title = obj.title;
                var units = obj.units
                $("#result-batch-upload").show();
                if(i%2!==0){
                    document.getElementById("course-table-body").innerHTML+='<tr id="greyed"><td id = "code'+i+'" onclick = "getResultCourseCode('+i+')">'+code+'</td><td id = "title'+i+'" onclick = "getResultCourseCode('+i+')">'+title+'</td><td id = "units'+i+'" onclick = "getResultCourseCode('+i+')">'+units+'</td><td id="get-sample-file'+i+'" onclick="downloadReseatResultFile('+i+')">Download Resultsheet File</td></tr>';
                }else{
                    document.getElementById("course-table-body").innerHTML+='<tr><td id = "code'+i+'" onclick = "getResultCourseCode('+i+')">'+code+'</td><td id = "title'+i+'" onclick = "getResultCourseCode('+i+')">'+title+'</td><td id = "units'+i+'" onclick = "getResultCourseCode('+i+')">'+units+'</td><td id="get-sample-file'+i+'" onclick="downloadReseatResultFile('+i+')">Download Resultsheet File</td></tr>';
                }
            }
        }
    })
}

function downloadResultFile(a){
    var code = $("#code"+a+"").html();
    var session = $("#academic-session").val();
    $.post("../backend/get-result-sheet.php",{code:code, session:session}, function(data){
        window.location.href="../downloads/"+data;
    })
}

function downloadReseatResultFile(a){
    var code = $("#code"+a+"").html();
    var session = $("#academic-session").val();
    $.post("../backend/get-reseat-result-sheet.php",{code:code, session:session}, function(data){
        window.location.href="../downloads/"+data;
    })
}

function getResultCourseCode(a){
    var code = $("#code"+a+"").html();
    $("#course-code").val(code);
}

function resultBatchUpload(){
    $("#resultUploadForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: '../backend/process-batch-result.php',
            data : new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(){
                $('#submit').attr('disable', 'disable');
            },
            success:function(response) {
                $("#modal").show();
                    $("#validation-info").css("color","green");
                    $("#validation-info").html(response);
                    $('submit').removeAttr('disable');
            }
        })
    })
}

/*********Course Allocation****************/
function getCourseByLevel(){
    var level =  $("#level").val();
    var semester =  $("#semester").val();
    if(semester !=""){
        getCourseToAllocate(semester, level);
    }
}

function getCourseBySemester(){
    var semester =  $("#semester").val();
    var level =  $("#level").val();
    if(level !=0){
        getCourseToAllocate(semester, level);
    }
}
function getCourseToAllocate(semester, level){
$.post("../backend/course-to-allocate.php", {level:level, semester:semester}, function(data){
    $("#course-allocation-tbody").html(data);
})
}

function submitCourseAllocation(){
    var size = $("#col-size").val();
    size++; 
    var parentArray = [];
    for(var i=1; i<(size);i++){
        var currentSession = $("#current_session").val();
        var courseLect = $("#course_lecturer_"+i+"").val();
        var code = $("#code_"+i+"").html();
        var courseAllocation ={
            "session" : currentSession,
            "code":code,
            "courseLecturer":courseLect
        };
        parentArray[i-1]=courseAllocation;
    }
    
    $.post("../backend/process-course-allocation.php",{parentArray:JSON.stringify(parentArray)}, function(data){
        alert(data)
    })
}
function getGeneralResult(){
    var semester = $("input[name = 'semester']:checked").val();
    var level = $("#seleect-genresult-level").val();
    var session = $("#academic_session").val();
    $.post("../views/general-result-view.php",{semester:semester, level:level, session:session}, function(data){
        $("#view-result-pane").html(data);
        // alert(data);
    })
}
function getStudentResult(a){
    var semester = $("input[name = 'semester']:checked").val();
    var level = $("#select-student-result-level").val();
    var session = $("#academic_session").val();
    var matno = $("#"+a+"").html();
    $.post("../views/individual-result-view.php",{matno:matno, semester:semester, level:level, session:session}, function(data){
        $("#view-result-pane").html(data);
        // alert(data);
    })
}

function getResultList(){
    var semester = $("input[name = 'semester']:checked").val();
    var level = $("#select-student-result-level").val();
    var session = $("#academic_session").val();
    $.post("../backend/get-student-result-list.php",{semester:semester, level:level, session:session}, function(data){
        var data = JSON.parse(data);
        var listTable ='<table><thead><th>MATRIC NO.</th><th>FIRST NAME</th><th>SURNAME</th></thead><tbody>';
        for(var i =0; i<data.length; i++){
            var resultList = data[i];
            var matno = resultList.matno;
            var fname = resultList.firstname;
            var surname = resultList.surname;
            listTable+='<tr onclick = "getStudentResult('+i+')"><td id="'+i+'">'+matno+'</td><td>'+fname+'</td><td>'+surname+'</td></tr>';
        }
        listTable+='</tbody></table>';
        $("#result-list-pane").html(listTable);
        // alert(data);
    })
}
//Transcript

function showOptionalTranscriptPane(){
    $("#transcriptOptionalPane").show(500);
}

function getTranscript(){
    var matno = $("#transcript-search-box").val();
    var session = $("#transcript-session").val();
    $.post("../backend/verify-transcript-student.php",{ matno:matno}, function(data){
        if(data == "Student found"){
            $("#submit-transcript-request")[0].click(function(){
            });
        }else{
            $("#transcript-response-pane").html("Student not found");
        }
    })
    
}
