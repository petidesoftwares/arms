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
})

function checkAllStudents(){
    $.post("student-list-view.php", function(data){
        $("#list-view").html(data);
        $("#list-view").css("border","solid 0.2em #708090");
    })
}

function checkSelectedStudents(){
    $("#selected-student-form").show(300);
}

function checkByLevel(){
    $("#selected-student-form-level2").hide();
    $("#selected-student-form-level1").show(300);    
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
                    if( obj_2.othername==null ||  obj_2.othername==""){
                        othername = "";
                    }else{
                        othername = obj_2.othername;
                    }
                    s_n++;
                    document.getElementById("att_list_body").innerHTML+='<tr><td>'+s_n+'</td><td>'+matno+'</td><td>'+fname+' '+surname+' '+othername+'</td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>';
                }
            })
        }
    })
    
}

// function generateAttendancePdf(){
//     alert($("#course_code").val());
// }