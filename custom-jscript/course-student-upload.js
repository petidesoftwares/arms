$(document).ready(function(){
    $("#single-upload").css({"background-color":"#708090","color":"white"});
    $("#single-upload-form").hide();
})

function singleUpload(){
    $("#single-upload").css({"background-color":"white","color":"black","border-left":"none","border-bottom-right-radius":"0px"});
    $("#batch-upload").css({"background-color":"#708090","color":"white","border-bottom-right-radius":"5px","border-bottom-left-radius":"5px"});
    $("#form-pane").hide();
    $("#single-upload-form").show();
}
function batchUpload(){
    $("#single-upload").css({"background-color":"#708090","color":"white","border-radius":"5px"});
    $("#batch-upload").css({"background-color":"white","color":"black","border-bottom-right-radius":"5px","border-bottom-left-radius":"0px"});
    $("#form-pane").show();
    $("#single-upload-form").hide();
}