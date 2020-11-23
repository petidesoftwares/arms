$(document).ready(function(){
    $.post("dashboard.html",function(data){
        $("#display-pane").html(data);
        $("#dashboard-item-pane-alter").hide();
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
    $.post("dashboard.html",function(data){
        $("#display-pane").html(data);
        $("#dashboard-item-pane-alter").hide();
        hideMenu();
    });
}

function uploadCourseView(){
    $.post("upload-courses.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function registerStudents(){
    $.post("register-students.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewStudents(){
    $.post("view-students.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewAttendance(){
    $.post("view-attendance.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function uploadResult(){
    $.post("result-upload.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewGeneralResult(){
    $.post("general-result.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function viewIndividualResult(){
    $.post("individual-result.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function registerLecturers(){
    $.post("register-lecturers.html",function(data){
        $("#display-pane").html(data);
        hideMenu();
    });
}

function updateSession(){
    
}