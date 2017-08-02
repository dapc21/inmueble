$(function() {
    $.ajaxSetup({
		error: function( jqXHR, textStatus, errorThrown ) {
			
			if (jqXHR.status === 0 || jqXHR.readyState === 0) {
				return;
			}

			if(jqXHR.status === 400)
			{
			   window.location.replace('/');
			   console.log('Bad Request. [400]');
			}
			else if(jqXHR.status === 401)
			{
			   window.location.replace('/');
			}
			else if (jqXHR.status === 404)
			{
			   console.log('Requested page not found. [404]');
			   $(".content-wrapper").load("/error/404");
			}
			else if (jqXHR.status === 500)
			{
			   console.log('Internal Server Error [500].');
			}
			else if (textStatus === 'parsererror')
			{
			   console.log('Requested JSON parse failed.');
			}
			else if (textStatus === 'timeout')
			{
			   console.log('Time out error.');
			}
			else if (textStatus === 'abort')
			{
			   console.log('Ajax request aborted.');
			}
			else
			{
			   console.log('Uncaught Error.\n' + jqXHR.responseText);
			}
		},
        fail: function( jqXHR, textStatus, errorThrown ) {
			
			if (jqXHR.status === 0 || jqXHR.readyState === 0) {
				return;
			}

			if(jqXHR.status === 400)
			{
			   window.location.replace('/');
			   console.log('Bad Request. [400]');
			}
			else if(jqXHR.status === 401)
			{
			   window.location.replace('/');
			}
			else if (jqXHR.status === 404)
			{
			   console.log('Requested page not found. [404]');
			   $(".content-wrapper").load("/error/404");
			}
			else if (jqXHR.status === 500)
			{
			   console.log('Internal Server Error [500].');
			}
			else if (textStatus === 'parsererror')
			{
			   console.log('Requested JSON parse failed.');
			}
			else if (textStatus === 'timeout')
			{
			   console.log('Time out error.');
			}
			else if (textStatus === 'abort')
			{
			   console.log('Ajax request aborted.');
			}
			else
			{
			   console.log('Uncaught Error.\n' + jqXHR.responseText);
			}
        }

    });
});