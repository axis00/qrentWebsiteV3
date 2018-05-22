$('.modal').modal();

$('.cancel-btn').on('click',function(evnt){
	var cancelResNo = evnt.target.getAttribute('data-resID');
	$('#itemToCancel').val(cancelResNo);
});

$('#cancelForm').on('submit',function(e){
	e.preventDefault();

	var resid = 'res-' + $('#itemToCancel').val();

	$.ajax({
		type: 'POST',
		host: 'www.qrent.com',
		url: '/util/cancel.php',
		data: $('#cancelForm').serialize(),
		success: function(data){
			console.log(data);
			if(data == 'success'){
				$('#' + resid).fadeOut();
			}else{
				M.toast({html: 'There was an error canceling your reservation'});
			}
		}
	});

});