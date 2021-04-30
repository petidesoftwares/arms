$(document).ready(function(){
    $("#modal").hide();
})

function closeModal(){
    $("#modal").hide();
}
function studentLogin(){
    var message = "";
    var flag = true;
    var username = $("#mat-num").val();
    var password = $("#student-login-password").val();

    if(username.length!=10){
        message = "Error! Matric number must be 10 characters.";
        flag = false;
    }else if(password.length = ""){
        message = "Error! password cannot be empty.";
        flag = false;
    }else if(password.length = null){
        message = "Error! password cannot be null.";
        flag = false;
    }else if(password.length < 6){
        message = "Error! password cannot be less than 6 characters.";
        flag = false;
    }else{
        flag = true;
    }

    if(flag == false){
        $("#modal").show();
        $("#modal-content").html(message);
    }else{
        $.post("backend/student-login.php",{username:username, password:password}, function(data){
           if(data == true){
               window.location.href="views/update-student-password.php";
           }else if(data == false){
                window.location.href="views/Home.php";
           }else{
                $("#modal").show();
                $("#modal-content").html(data);
           }
            
        })
    }
}

function UpdateStudentPassword(){
    var newPassword = $("#new-password").val();
    var confirmPassword = $("#confirm-password").val();
    var message ="";
    var flag = true;
    if(newPassword.length<6){
        message = "Error! Password must not be less than 6 characters.";
        flag = false;
    }else if(newPassword.length == 0){
        message = "Error! Password field cannot be empty.";
        flag = false;
    }else if(confirmPassword.length == 0){
        message = "Error! Confirm Password field cannot be empty.";
        flag = false;
    }else if(confirmPassword != newPassword){
        message = "Error! Password mismatch.";
        flag = false;
    }else{
        flag = true;
    }
    if(flag == false){
        $("#modal").show();
        $("#modal-content").html(message);
    }
    else{
        $.post("../backend/update-password.php",{newPassword:newPassword, confirmPassword:confirmPassword},function(data, status){
            if(data == "success"){
                window.location.href="../index.php";
            }else{
                $("#modal").show();
            $("#modal-content").html(data);
            }
        })
    }
}