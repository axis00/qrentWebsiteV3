$(document).ready(function(){

	$('.reserveBtn').on('click',showReserveForm);
	$('#cancelResBtn').on('click',function(){
		$('#reserveFormCont').fadeOut();

	});

});

function showReserveForm(event){

	console.log('howgin');

	var id = $(event.target).attr('data-resid');
	$('#reserveFormCont').fadeIn();

	$('#resid').attr('value',id);

}