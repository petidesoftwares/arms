$(document).ready(function(){
    $("#selected-student-form-level1").hide();
    $("#selected-student-form-level2").hide();
    $("#selected-student-form").hide();
    
})

function checkAllStudents(){

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