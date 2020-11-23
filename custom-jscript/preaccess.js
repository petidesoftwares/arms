$(document).ready(function(){
    $.post("preaccess/add-first-admin.html", function(data){
        $(".pre-display-pane").html(data);
    })
})