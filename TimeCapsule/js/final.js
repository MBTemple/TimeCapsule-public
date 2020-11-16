$(document).ready(function(){
	$("#login").click(function(e) {
			event.preventDefault(e);
			var formData = {
				'email'  		: $('input[name=email]').val(),
				'password'  		: $('input[name=password]').val(),
				'rememberMe'  		: $('input[name=rememberMe]').val()
			};
			$.ajax({
				type: 'POST',
				url: 'http://tec2.hpc.temple.edu/~tug01026/4398/Project/php/login.php',
				async: false,
				data: formData,
				dataType: 'json',
				encode: true
				}).always(function(data) {
					// log data to the console so we can see
					console.log(data);
					// here we will handle errors and validation messages
					if (parseInt(data.RegState) == 4) {
						window.location = "home.html";
					}
					$("#Message").html(data.Message);
				//	location.reload();
			});
	})
	$("#register").click(function(e) {
			event.preventDefault(e);
			var formData = {
				'email'  		: $('input[name=email]').val(),
				'first-name'  		: $('input[name=first-name]').val(),
				'last-name'  		: $('input[name=last-name]').val()
			};
			$.ajax({
				type: 'POST',
				url: 'http://tec2.hpc.temple.edu/~tug01026/4398/Project/php/register2.php',
				async: false,
				data: formData,
				dataType: 'json',
				encode: true
				}).always(function(data) {
					// log data to the console so we can see
					console.log(data);
					// here we will handle errors and validation messages
					$("#Message").html(data.Message);
				//	location.reload();
			});
	})

$("#setPassword").click(function(e) {
		event.preventDefault(e);
		var formData = {
			'password1'  		: $('input[name=Password1]').val(),
			'password2'  		: $('input[name=Password2]').val()

		};
		$.ajax({
			type: 'POST',
			url: 'http://tec2.hpc.temple.edu/~tug01026/4398/Project/php/setPassword.php',
			async: false,
			data: formData,
			dataType: 'json',
			encode: true
			}).always(function(data) {
				// log data to the console so we can see
				console.log(data);
				// here we will handle errors and validation messages

				if (parseInt(data.RegState) == 6) {
					window.location = "setPasswordForm.html";
				}
				$("#Message").html(data.Message);
			//	location.reload();
		});
})

$("#resetPassword").click(function(e) {
		event.preventDefault(e);
		var formData = {
				'email'  		: $('input[name=email]').val()
		};
		$.ajax({
			type: 'POST',
			url: 'http://tec2.hpc.temple.edu/~tug01026/4398/Project/php/resetPassword2.php',
			async: false,
			data: formData,
			dataType: 'json',
			encode: true
			}).always(function(data) {
				// log data to the console so we can see
				console.log(data);
				// here we will handle errors and validation messages
				$("#Message").html(data.Message);
			//	location.reload();
		});
})
});
