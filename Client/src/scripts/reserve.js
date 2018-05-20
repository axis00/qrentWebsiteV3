$(document).ready(function(){
	console.log('loaded');

	$('.datepicker').datepicker();
	$('#itemReview').on('click',showReview);
	$('#reserve').on('click',showReserveForm);

	$("#reserve").click(function() {
    	$('html, body').animate({
        	scrollTop: $("#reserveFormCont").offset().top
    }, 		2000);
});

		$("#itemReview").click(function() {
    	$('html, body').animate({
        	scrollTop: $("#reviewForm").offset().top
    }, 		2000);
});

	$('#cancelResBtn').on('click',function(){
		$('#reserveFormCont').fadeOut();

	});

});

function showReview(event){
	$('#reviewForm').fadeIn();
}

function updateTextInput(val) {
          document.getElementById('textInput').value=val; 
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