$(document).ready(function(){
    $.post("dashboard.php",function(data){
        $("#display-pane").html(data);
        $("#menu-list").hide();
        checkTotalAdmin();
    })
    $("#selected-student-form-level1").hide();
});

function hideMenu(){
    $("#menu-list").hide(500);
    $(".menu-frame").show();
    $("#dashboard-item-pane").show();
}

function showMenu(){
    $("#menu-list").show(500);
    $(".menu-frame").hide();
    $("#dashboard-item-pane").show();
    checkTotalAdmin();
}

function showDashboard(){
    $.post("dashboard.php",function(data){
        $("#display-pane").html(data);
        $("#dashboard-item-pane-alter").hide();
        hideMenu();
    });
}

function uploadCourseView(){
    $.post("upload-courses.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function registerStudents(){
    $.post("register-students.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewStudents(){
    $.post("view-students.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewLecturers(){
    $.post("view-lecturers.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewCourses(){
    $.post("view-courses.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewActiveStudents(){
    $.post("view-active-students.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewSuspendedStudents(){
    $.post("view-deffered-students.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewAttendance(){
    $.post("view-attendance.php",function(data){
        $("#display-pane").html(data);
        $("#select_att_option").hide();
        $("#course-table-display-pane").hide();
        $("#att-sheet").hide();
        hideMenu();
    });
}

function uploadResult(){
    $.post("result-upload.php",function(data){
        $("#display-pane").html(data);
        $("#result-batch-upload").hide();
        $("#result-form-upload").hide();
        hideMenu();
    });
}

function viewGeneralResult(){
    $.post("general-result.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewIndividualResult(){
    $.post("individual-result.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function registerLecturers(){
    $.post("register-lecturers.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function checkTotalAdmin(){
    $.post("../backend/check-total-admin.php",function(data){
        if(data==0 || data==1){
            $("#add-second-admin").show();
        }else{
            $("#add-second-admin").hide();
        }
        
    });
}
function addSecondAdmin(){
    var type = $("#second_admin").val();
    if( type == "fresh_lecturer"){
        $.post("add-second-admin.php",function(data){
            $("#display-pane").html(data);
            hideMenu();
        });
    }else if(type == "existing_lecturer"){
        $.post("add-admin-from-system-view.php",function(data){
            $("#display-pane").html(data);
            hideMenu();
        });
    }
}

function courseAllocation(){
    $.post("course-allocation.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function updateSession(){
    
}
function LoadTranscriptView(){
    $.post("transcript-main-view.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function logout(){
    $.post("../backend/logout.php", function(data){
        if(data=="Session destroyed"){
            window.location.href = "../preaccess/login-view.php";
        }
    })
}