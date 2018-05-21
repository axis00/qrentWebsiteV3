function userNotFound(){
	alert("user not found");
}

function successfulLogin(){
	window.history.back();
}

function wrongPassword(){
	alert("wrong Password");
}

function rejectedUser(){
	alert("This accounted was rejected");
}

function pendingUser(){
	alert("This is a pending account");
}

function genericError(){
	alert("Something went wrong, we are gathering our monkeys to solve the issue");
}


$(document).ready(function(){

	$('#login-form').submit(function(e){

		e.preventDefault();
		$.ajax({
			type: 'POST',
			host: 'www.qrent.com',
			url: '/util/login.php',
			data: $('#login-form').serialize(),
			success: function(data){
				console.log(data);
				if(data == 'success'){
					successfulLogin();
				}else if(data == 'not found'){
					userNotFound();
				}else if(data == 'wrong password'){
					wrongPassword();
				}else if(data == 'rejected'){
					rejectedUser();
				}else if(data == 'pending'){
					pendingUser();
				}else{
					genericError();
				}
			}
		});
	});

});