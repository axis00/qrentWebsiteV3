$(document).ready(function(){
	console.log('loaded');

	$('.datepicker').datepicker();
	$('#itemReview').on('click',showReview);
	$('#reserve').on('click',showReserveForm);


	$('#cancelResBtn').on('click',function(){
		$('#reserveFormCont').fadeOut();
		$('#reviewForm').fadeOut();

	});

});

function showReview(event){
	$('#reviewForm').fadeIn();
}

function updateTextInput(val) {
          $('#textInput').html(val)
        }

function showReserveForm(event){

	console.log('howgin');

	var id = $(event.target).attr('data-resid');
	$('#reserveFormCont').fadeIn();

	$('#resid').attr('value',id);

}

// carousel js
$('.carousel.carousel-slider').carousel({
    fullWidth: true
});

$('.materialboxed').materialbox();

$('.modal').modal();