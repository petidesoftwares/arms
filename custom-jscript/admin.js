$(document).ready(function(){
    $("#selected-student-form-level1").hide();
    $("#selected-student-form-level2").hide();
    $("#selected-student-form").hide();
    
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