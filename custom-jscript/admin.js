$(document).ready(function(){
    $("#selected-student-form-level1").hide();
    $("#selected-student-form-level2").hide();
    $("#selected-student-form").hide();
    hideModal();
    $("#modal").hide();
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