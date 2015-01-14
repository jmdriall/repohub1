$(document).ready(function(){
	$('#myTab a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});
	$( "#accordion" ).accordion();
	$( "#accordion2" ).accordion();
});
