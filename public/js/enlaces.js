$(document).ready(function() {

	//PANEL DE CONTROL
	$("#itemHome").click(function(e){
		e.preventDefault();
		var route = "/panel";
		$(".content-wrapper").load(route);
	});
	
	//INMUEBLES
	$("#itemProperties").click(function(e){
		e.preventDefault();
		var route = "/properties";
		$(".content-wrapper").load(route);
	});
});