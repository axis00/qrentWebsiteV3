$(document).ready(function(){

	$('.datepicker').datepicker({
	    selectMonths: true,
	    selectYears: 15,
	    format: 'yyyy-mm-dd' 
	});
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

	$('#reserveFormCont').fadeIn();
}

// carousel js
$('.carousel.carousel-slider').carousel({
    fullWidth: true
});

$('.materialboxed').materialbox();

$('.modal').modal();

