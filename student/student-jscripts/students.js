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
        $.post("../admin/backend/student-login.php",{username:username, password:password}, function(data){
            alert(data);
            
        })
    }
}