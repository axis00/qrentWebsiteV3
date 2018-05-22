$(document).ready(function(){

	$('.confirmReturn').click(function(e){

		var itemNo = e.target.getAttribute('data-itemno');
		var rentId = e.target.getAttribute('data-rentid');

		var sel = "#rent-"+rentId;

		$.ajax({
			type: 'POST',
			url: '/confirmReturn',
			data: 'itemno='+itemNo+"&rentId="+rentId,
			success: function(data){
				if(data=='success'){
					$(sel).fadeOut();
				}else{
					M.toast({html: 'There was an error processing your request'});
				}
			}
		});

	});


	$('.loanBtn').click(function(e){

		var itemNo = e.target.getAttribute('data-itemno');
		var rentId = e.target.getAttribute('data-rentid');

		var sel = "#loanNotif-"+rentId;

		$.ajax({
			type: 'POST',
			url: '/loan',
			data: 'itemno='+itemNo+"&rentId="+rentId,
			success: function(data){
				if(data=='success'){
					$(sel).fadeOut();
				}else{
					M.toast({html: 'There was an error processing your request'});
				}
			}
		});

	});


});