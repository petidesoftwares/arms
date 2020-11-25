$(document).ready(function(){
    $.post("dashboard.php",function(data){
        $("#display-pane").html(data);
        $("#dashboard-item-pane-alter").hide();
        $("#menu-list").hide();
    })
    $("#selected-student-form-level1").hide();
    checkTotalAdmin();
});

function hideMenu(){
    $("#menu-list").hide(500);
    $(".menu-frame").show();
    $("#dashboard-item-pane-alter").hide();
    $("#dashboard-item-pane").show();
}

function showMenu(){
    $("#menu-list").show(500);
    $(".menu-frame").hide();
    $("#dashboard-item-pane-alter").show();
    $("#dashboard-item-pane").hide();
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

function viewAttendance(){
    $.post("view-attendance.php",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function uploadResult(){
    $.post("result-upload.php",function(data){
        $("#display-pane").html(data);
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
    $.post("backend/check-total-admin.php",function(data){
        if(data==0 || data==1){
            $("#add-second-admin").show();
        }else{
            $("#add-second-admin").hide();
        }
        
    });
}
function addSecondAdmin(){
    $.post("add-second-admin.php",function(data){
        $("#display-pane").html(data);
    });
}

function updateSession(){
    
}