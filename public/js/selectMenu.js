$(document).ready(function() {
	
	$('ul.sidebar-menu li a.item').click(function(e) {
		e.preventDefault();
		e.stopPropagation;
		$(this).closest('ul').find('.active').removeClass('active');
		$(this).parent().addClass('active');
	});

});