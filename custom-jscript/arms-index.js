$(document).ready(function(){
    $.post("views/dashboard.html",function(data){
        $("#display-pane").html(data);
        $("#menu-list").hide();
    })
});

function hideMenu(){
    $("#menu-list").hide(500);
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
    })
}