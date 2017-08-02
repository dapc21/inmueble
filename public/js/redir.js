$(document).ready(function() {
    //HOME (404 enlace)
    $("#home404").click(function(e){
        e.preventDefault();
        var route = "/panel";
        $(".content-wrapper").load(route);
    });
});
