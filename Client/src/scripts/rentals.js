$('.return-btn').on('click',function(evnt){

	var returnResId = evnt.target.getAttribute('data-resid');
	var returnItemNo = evnt.target.getAttribute('data-itemno');
	$('#resNumber').val(returnResId);
	$('#itemNumber').val(returnItemNo);

});

$('.modal').modal();

function updateTextInput(val) {
  	$('#ratingText').html(val);
}

$('#returnForm').on('submit',function(e){

	e.preventDefault();

	var rentId = 'rent-' + $('#resNumber').val();
	console.log($('#returnForm').serialize());

	$.ajax({
		type: 'POST',
		host: 'www.qrent.com',
		url: '/util/return.php',
		data: $('#returnForm').serialize(),
		success: function(data){

			if(data == 'success'){
				$('#' + rentId).fadeOut();
			}else{
				M.toast({html: 'There was an error returning your rental'});
			}
		}
	});

});