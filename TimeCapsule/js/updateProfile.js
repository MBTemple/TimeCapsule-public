$(document).ready(function () {
	// Unconditional execution
	$.ajax({
		type: 'GET',
		url: 'http://tec2.hpc.temple.edu/~tug01026/4398/Project/php/updateProfile.php',
		async: true,
		dataType: 'json',
		encode: true
		}).always(function(data) {
			// log data to the console so we can see
			console.log(data);
			// here we will handle errors and validation messages
			// Check if data.RegState is not negative do the following
			//alert("turn first-name["+data.FirstName+"]");
			$("#age").val(data.Age);
			$("#country").val(data.Country);
			$("#first-name").val(data.FirstName);
			$("#last-name").val(data.LastName);
			$("#about-me").val(data.AboutMe);
			$("#email").val(data.Email);
			// Otherwise $(#Message).html(data.Message);
		//	location.reload();
	});
	$("#saveProfile").click(function (e) {
		event.preventDefault(e);
		var formData = {
			'aboutMe'  		: $('input[id=about-me]').val(),
			'first-name'  	: $('input[id=first-name]').val(),
			'last-name'  	: $('input[id=last-name]').val(),
			'country' 		: $('input[id=country]').val(),
			'age'			: $('input[id=age]').val()
		};
		//alert("AboutMe=["+formData.aboutMe+"]");
		$.ajax({
			type: 'POST',
			url: 'http://tec2.hpc.temple.edu/~tug01026/4398/Project/php/profile.php',
			async: true,
			data: formData,
			dataType: 'json',
			encode: true
			}).always(function(data) {
				// log data to the console so we can see
				console.log(data);
				// here we will handle errors and validation messages
				$("#Message").html(data.Message+" "+data.Rdatetime);
			//	location.reload();
		});
	})
})
