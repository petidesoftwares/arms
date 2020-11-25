$(document).ready(function(){
    $.post("backend/prelogin-checker.php", function(data){
        if(data == "Content present"){
            window.location.href="preaccess/login-view.php";
        }else{
            $.post("preaccess/add-first-admin.php", function(data){
                $(".pre-display-pane").html(data);
                hideModal();
            })
        }
    })
})

function hideModal(){
    $("#modal").hide();
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