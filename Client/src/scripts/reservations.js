$('.modal').modal();

$('.cancel-btn').on('click',function(evnt){

	var cancelItemNo = evnt.target.getAttribute('data-itemno');
	$('#itemToCancel').val(cancelItemNo);
});