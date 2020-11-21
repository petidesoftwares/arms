$(document).ready(function(){
    $.post("views/dashboard.html",function(data){
        $("#display-pane").html(data);
        $("#menu-list").hide();
    })
    $("#selected-student-form-level1").hide();
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
    $.post("views/dashboard.html",function(data){
        $("#display-pane").html(data);
        $("#dashboard-item-pane-alter").hide();
        hideMenu();
    });
}

function uploadCourseView(){
    $.post("views/upload-courses.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function registerStudents(){
    $.post("views/register-students.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewStudents(){
    $.post("views/view-students.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewAttendance(){
    $.post("views/view-attendance.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function uploadResult(){
    $.post("views/result-upload.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewGeneralResult(){
    $.post("views/general-result.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewIndividualResult(){
    $.post("views/individual-result.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function updateSession(){
    
}