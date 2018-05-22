$('.return-btn').on('click',function(evnt){

	var returnItemNo = evnt.target.getAttribute('data-itemno');
	$('#itemToReturnNumber').val(returnItemNo);

});

$('.modal').modal();

function updateTextInput(val) {
  	$('#ratingText').html(val)
}