<?php




?>

<?php

session_start();

?>

<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<!--		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">-->

		<style type="text/css">

			.bg-shadow {

				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

			}

			.back-btn {
				cursor: pointer;
			}

		</style>

		<title>Get the region to show</title>
	</head>

	<body class="bg-info text-light">

		<div class="container btn-container dialog d-flex align-items-center justify-content-center">

			<div class="col-lg-4 col-md-6 col-sm-8 col-12 bg-dark rounded p-3 text-light bg-shadow">

				<form role="form" id="reset_password" novalidate action="http://localhost/themepic/login.php" method="post">

					<div class="form-group"> 

						<div class="d-flex justify-content-between align-items-center">
							<label for="in-email">Email address</label>
							<small class="text-warning pl-2 text-right"><label for="in-email" generated="true" class="error"></label></small>
						</div>

						<input type="" name="in-email" class="form-control" id="in-email" aria-describedby="emailHelp" placeholder="Enter email" value="<?php 

													  if (isset($_GET["e"])) {
														  echo $_GET["e"];
													  }


											  ?>">

					</div>

					<div class="form-group">

						<div class="d-flex justify-content-between align-items-center">
							<label for="in-pass">Password</label>
							<small class="text-warning pl-2 text-right"><label for="in-pass" generated="true" class="error"></label></small>
						</div>

						<input name="in-pass" type="password" class="form-control" id="in-pass" placeholder="Password" value="pakistani">

					</div>

					<div class="form-group">

						<div class="d-flex justify-content-between align-items-center">
							<label for="in-pass-confirm">Confirm Password</label>
							<small class="text-warning pl-2 text-right"><label for="in-pass-confirm" generated="true" class="error"></label></small>
						</div>

						<input name="in-pass-confirm" type="password" class="form-control" id="in-pass-confirm" placeholder="Password" value="pakistani">

					</div>

					<input id="hash" name="hash" type="text" value="<?php 

																	if (isset($_GET["q"])) {
																		echo $_GET["q"];
																	}


																	?>" class="d-none"> 

					<p class=""><small class="text-warning text-right form-error"></small></p>

					<div class="d-flex buttons w-100">

						<button type="button" id="submit-btn" class="btn btn-info">Submit</button>
						<a href="index.php" class="btn btn-outline-light mx-1">Cancel</a>

					</div>

					<div class="d-flex text-center mt-3"><small class="form-success"></small></div>

				</form>

			</div>

		</div>

		<script src="https://code.jquery.com/jquery-3.3.1.js"
				integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
				crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>

		<script type="text/javascript">

			$(document).on('mouseenter mouseleave','.back-btn',function() {

				$(this).toggleClass('text-info text-light');

			})

			$(document).on('click','.back-btn',function() {

				$("#reset_password").submit();

			})

			$( document ).ready(function() {

				let wht = $(window).height();

				$('.btn-container').height(wht);

			}) // DOCUMENT IS READY AND RECIZE

			$( window ).resize(function() {

				let wht = $(window).height();
				let wwt = $(window).width();

				$('.btn-container').height(wht);

			})


			$('#submit-btn').click(function() {

				if (!($("#reset_password").valid())) {

					return;

				}

				$.ajax({
					method: "POST",
					url: 'http://localhost/themepic/reset_at_server.php',
					async: false,
					data: {

						'in-email': $('#in-email').val(), 
						'in-pass': $('#in-pass').val(), 
						'in-pass-confirm': $('#in-pass-confirm').val(), 
						'hash': $('#hash').val(), 

					},
					success: function( msg ) {

						console.log(msg);

						let myObj = JSON.parse(msg);

						if (myObj.success == false) {

							$('#reset_password').find('.form-error').html(`<i class="fas fa-exclamation-circle"></i> ` + myObj.error);
							return;

						}

						$('#reset_password').find('.form-success').html(myObj.status + ` <span class="signIn back-btn text-info"><strong> Click here</strong></span> to start browsing.`);

					}
				})

			});

			$("#reset_password").validate({

				rules: {
					'in-email' : {
						required: true,
						email: true,
						minlength: 5
					},
					'in-pass' : {
						required: true,
						minlength: 5
					},
					'in-pass-confirm' : {
						required: true,
						equalTo : "#in-pass"
					}
				},
				messages: {
					'in-pass' : {
						required: `<i class="fas fa-exclamation-circle"></i>`+" Fill in the blank",
						minlength: `<i class="fas fa-exclamation-circle"></i>`+" atleast 5 characters"
					},
					'in-pass-confirm' : {
						required: `<i class="fas fa-exclamation-circle"></i>`+" Fill in the blank",
						equalTo: `<i class="fas fa-exclamation-circle"></i>`+" password didn't match"
					}
				},

			});



		</script>

	</body>

</html>
