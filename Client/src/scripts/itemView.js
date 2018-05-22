$(document).ready(function(){

	$('.datepicker').datepicker({
	    selectMonths: true,
	    selectYears: 50,
	    format: 'yyyy-mm-dd' 
	});
	$('#itemReview').on('click',showReview);
	$('#reserve').on('click',showReserveForm);


	$('#cancelResBtn').on('click',function(){
		$('#reserveFormCont').fadeOut();
		$('#reviewForm').fadeOut();

	});

	$('#reviewForm').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			host: 'www.qrent.com',
			url: 'rateItem.php',
			data: $('#reviewForm').serialize(),
			success: function(data){
				console.log(data);
				if(data == 'success'){
					successfulReview();
				}
			}
		});
	});

});

function successfulReview(){
	M.toast({html: 'Review has been submitted!'});
}

function showReview(event){
	$('#reviewForm').fadeIn();
}

function updateTextInput(val) {
  	$('#ratingText').html(val)
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

