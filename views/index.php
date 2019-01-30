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
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


		<style type="text/css">


			/* width */
			::-webkit-scrollbar {
				width: 1px;
				height: 0px;
			}

			/* Track */
			::-webkit-scrollbar-track {
				background: #f1f1f1; 
			}

			/* Handle */
			::-webkit-scrollbar-thumb {
				background: #888; 
			}

			/* Handle on hover */
			::-webkit-scrollbar-thumb:hover {
				background: #555; 
			}

			.canvas-btn {

				cursor: pointer;
				position: relative;
				font-size: 80%;


			}

			bg-transparent {
				background-color: transparent;
			}

			canvas {
				position: absolute;
				z-index: 2;
				cursor: copy;


				/*				pointer-events: none;*/
			}

			.img-block {
				background: transparent;

			}

			.bg-shadow {

				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

			}

			.circleAndNo {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%,-50%);
				z-index: 2;
				font-size: 80%;
				font-weight: bold;
				height: 1.7rem;
				width: 1.7rem;
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
				cursor: pointer;
			}

			.circleAndNo elem {

				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%,-50%);

			}

			.circleAndNo span {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%,-50%);
				height: 180%;
			}

			.fa-paint-brush {
				pointer-events: none;
			}

			textarea {
				resize: none;
			}

			.custom-dark-popover .arrow::after {
				bottom: 1px;
				border-top-color: #343a40;
			}

			.detailBox {
				position: absolute;
				z-index: 0;
				display: block;
			}

			.detailBox-text {

				position: relative;
				max-width: 100%;
				white-space: nowrap;
				overflow: hidden;

			}

			.span-No {
				min-width: 8.5%;
			}

			.detailBox-Big {

				top: 100%;
				left: 0%;
				/*				display: none;*/
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

			}

			.deletecircleAndNo {

				cursor: pointer;

			}

			.setting-btn {

				position: relative;

			}

			.settings-btn span {

				position: absolute;
				left: 50%;
				top: 50%;
				transform: translate(-50%,-50%);
				height: 1.5rem;

			}

			.box {

				height: 3rem;
				width: 4rem;
				position: relative;
				cursor: pointer;

			}

			.rtbt-subBox {

				right: 0px;
				bottom: 0px;

			}

			.ltbt-subBox {

				left: 0px;
				bottom: 0px;

			}

			.lttp-subBox {

				top: 0px;
				left: 0px;

			}

			.rttp-subBox {

				top: 0px;
				right: 0px;

			}

			.bgbt-subBox {

				bottom: 0px;

			}

			.custom-popover-header::before {
				width: 0rem !important; 
			}

			.settings-btn {
				position: relative;
				cursor: pointer;
				font-size: 80%;
			}

			#overlay {

				left: 50%;
				transform: translate(-50%,0);
				z-index: 3;

			}

			.image {

				display: block;
				width: auto;
				height: auto;

			}

			.custom-hide {
				position: absolute !important;
				top: -9999px !important;
				left: -9999px !important;
			}

			.overflow-hidden {
				overflow: hidden;
			}

			.ui-dialog-titlebar {
				display: none;
			}

			.logout-btn {
				cursor: pointer;
			}

			.check-label label {
				height: 0px;
			}

			.custom-control-input:checked~.custom-control-label::before{

				background-color: #18a2b9 !important;

			}

			.back-btn {
				
				cursor: pointer;
				
			}

			.modal-spinner {

				position: fixed;
				width: 100%;
				height: 100%;
				/*				background-color:rgba(0,0,0,0.4);*/

			}

			.spinner {

				position: fixed;
				z-index: 1000;
				top: 50%;
				left: 50%;
				width: 4rem;
				height: 4rem;
				border-radius: 50%;
				border: 0.2rem solid transparent !important;
				border-top: 0.1rem solid #ffc107 !important;
				border-right: 0.1rem solid #ffc107 !important;
				border-bottom: 0.1rem solid #ffc107 !important;
				margin-top: -2rem; 
				margin-left: -2rem;
				pointer-events: none;
				animation: spin 2s linear infinite;

			}

			@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}

			.upload-btn-wrapper {

				cursor: pointer;
				/*				pointer-events: none;*/

			}

			.upload-btn-wrapper input[type=file]{

				position: absolute;
				top: -1000px;

			}

			.upload-textarea-wrapper .heading {

				z-index: 2;
				pointer-events: none;

			}

			.upload-btn-text {

				font-size: 200%;

			}

			.upload-textarea-wrapper textarea {

				font-size: 200%;
				z-index: 1;

			}

			.ok-btn {

				cursor: pointer;

			}

			.ok-btn-box {

				position: absolute;
				bottom: 0px;
				right: 0px;
				display: none;
				opacity: 0;
				z-index: 3;

			}

			.ok-btn-file {

				bottom: 0px;
				right: 0px;

			}

			.ok-btn-box label {

				height: 0px;

			}

			.ok-btn-box .error-span {

				display: none;

			}

			#upload-error {

				display: none;

			}

			.preview-image-box {

				display: none;
				opacity: 0;

			}


		</style>

		<title>Get the region to show</title>
	</head>

	<body class="bg-info text-light">

		<div class="btn-container dialog">

			<div class="d-flex flex-column h-100">

				<div class="p-2 flex-fill d-flex align-items-center justify-content-center">

					<div class="mx-2 signUp btn btn-light">Sign Up for 5 Dollars</div>

				</div>

			</div>

		</div> 

		<div class="container-fluid mainPage">

			<div id="dialog-signin" class="container dialog d-flex align-items-center justify-content-center">

				<div class="col-lg-4 col-md-6 col-sm-8 col-12 bg-dark rounded p-3 text-light bg-shadow">

					<form role="form" id="sign-in" novalidate action="http://localhost/themepic/login.php" method="post">

						<div class="form-group"> 

							<div class="d-flex justify-content-between align-items-center">
								<label for="in-email">Email address</label>
								<small class="text-warning pl-2 text-right"><label for="in-email" generated="true" class="error"></label></small>
							</div>

							<input name="in-email" class="form-control" id="in-email" aria-describedby="emailHelp" placeholder="Enter email">

						</div>

						<div class="form-group">

							<div class="d-flex justify-content-between align-items-center">
								<label for="in-pass">Password</label>
								<small class="text-warning pl-2 text-right"><label for="in-pass" generated="true" class="error"></label></small>
							</div>

							<input name="in-pass" type="password" class="form-control" id="in-pass" placeholder="Password">



						</div>

						<p class=""><small class="text-warning text-right form-error"></small></p>

						<div class="d-flex buttons w-100">

							<button type="button" id="log-in" class="btn btn-info">Log In</button>
							<button type="button" class="signUp btn btn-outline-light mx-1">Sign Up</button>
							<span class="flex-fill text-center d-flex align-items-center justify-content-center">

								<small>
									<span class="forgot-pass back-btn"><strong>Reset password</strong></span>
								</small>

							</span>

						</div>

					</form>

				</div>

			</div>

			<div id="dialog-signup" class="container dialog d-flex align-items-center justify-content-center">

				<div class="col-lg-4 col-md-6 col-sm-8 col-12 bg-dark rounded p-3 text-light bg-shadow">

					<form id="sign-up" method="post" action="http://localhost/themepic/signup.php" novalidate>

						<div class="form-group">

							<div class="d-flex justify-content-between align-items-center">

								<label for="user-name">Name</label>

								<small class="text-warning pl-2 text-right"><label for="user-name" generated="true" class="error"></label></small>

							</div>

							<input name="user-name" type="text" class="form-control" id="user-name" aria-describedby="emailHelp" placeholder="Enter your last name">

							<small class="text-muted">I need to store pics with your name. This name will be visible to people you share your edits with.</small>

						</div> 

						<div class="form-group">

							<div class="d-flex justify-content-between align-items-center">
								<label for="user-email">Email address</label>
								<small class="text-warning pl-2 text-right"><label for="user-email" generated="true" class="error"></label></small>
							</div>

							<input name="user-email" class="form-control" id="user-email" aria-describedby="emailHelp" placeholder="Enter email" >

							<small class="text-muted">You will get notifications only. No newsletters.</small>

						</div>

						<div class="form-group">

							<div class="d-flex justify-content-between align-items-center">
								<label for="user-pass">Password</label>
								<small class="text-warning pl-2 text-right"><label for="user-pass" generated="true" class="error"></label></small>
							</div>

							<input name="user-pass" type="password" class="form-control" id="user-pass" placeholder="Password">

							<small class="text-muted">Create an easy password. Np :)</small>

						</div>

						<div class="form-group">

							<div class="d-flex justify-content-between align-items-center">

								<div class="custom-control custom-checkbox">
									<input name="agreeTerms" type="checkbox" class="custom-control-input" id="agreeTerms" checked>
									<span class="custom-control-indicator"></span>
									<label class="custom-control-label" for="agreeTerms">I agree to terms and policy</label>
								</div>

								<small class="text-warning pl-2 text-right check-label"><label for="agreeTerms" generated="true" class="error"></label></small>

							</div>

						</div>

						<button type="submit" class="btn btn-info">Submit</button>
						
						<button type="button" class="signIn btn btn-outline-light">Login</button>

					</form>
                
                </div>

			</div>
			
			<div id="dialog-forgot-pass" class="container dialog d-flex align-items-center justify-content-center">

				<div class="col-lg-4 col-md-6 col-sm-8 col-12 bg-dark rounded p-3 text-light bg-shadow">

					<form role="form" id="forgot-email-form" novalidate action="" method="">

						<div class="form-group mb-0"> 

							<div class="d-flex justify-content-between align-items-center">
								<label for="fogot-email-name">Email address</label>
								<small class="text-warning pl-2 text-right"><label for="forgot-email-name" generated="true" class="error"></label></small>
							</div>

							<input name="forgot-email-name" class="form-control" id="forgot-email-name" aria-describedby="emailHelp" placeholder="Enter email">

							<small class="">Enter your email address you signed up with. If you used facebook / twitter login, enter your email you use to log in to your accounts.</small>

						</div>

						<div class="d-flex mt-2"><small class="text-warning text-right form-error"></small></div>

						<div class="d-flex mt-3 buttons w-100">

							<button type="button" id="send-email" class="btn btn-info">Send reset email</button>

							<span class="flex-fill text-center d-flex align-items-center justify-content-center">

								<small>
									<span class="signIn back-btn"><strong>Log In</strong></span> 
									or 
									<span class="signUp back-btn"><strong>Sign Up</strong></span>
								</small>

							</span>

						</div>

						<div class="d-flex text-center mt-3"><small class="text-info form-success"></small></div>

					</form>

				</div>

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
			
			let wht = $(window).height(); 
			let wwt = $(window).width(); 
			
//			console.log($('.back-btn'));
			
			$( document ).ready(function() {

				$('.btn-container').height(wht);

				$( "#dialog-signup" ).dialog({
					resizable: false,
					height: 'auto',
					width: 'auto',
					position: { my: "center", at: "center", of: window },
					modal: true,
					autoOpen: false,
					appendTo: ".mainPage",
					show: {
						effect: "fade",
						duration: 500
					}
				});

				$( "#dialog-signin" ).dialog({
					resizable: false,
					height: 'auto',
					width: 'auto',
					position: { my: "center", at: "center", of: window },
					modal: true,
					autoOpen: false,
					appendTo: ".mainPage",
					show: {
						effect: "fade",
						duration: 500
					}
				});

				$( "#dialog-forgot-pass" ).dialog({
					resizable: false,
					height: 'auto',
					width: 'auto',
					position: { my: "center", at: "center", of: window },
					modal: true,
					autoOpen: false,
					appendTo: ".mainPage",
					show: {
						effect: "fade",
						duration: 500
					}
				});

			});
			
			$( window ).resize(function() {
				
				wht = $(window).height();
				wwt = $(window).width();

				$('.mainPage').height(wht);

				$( "#dialog-signup" ).dialog( "option", "position", { my: "center", at: "center", of: window });

				$( "#dialog-signin" ).dialog( "option", "position", { my: "center", at: "center", of: window });

				$( "#dialog-forgot-pass" ).dialog( "option", "position", { my: "center", at: "center", of: window });

			})

			$('.back-btn').on('mouseenter mouseleave',function() {
				
				$(this).toggleClass('text-info',50);

			})

			$('.signUp').click(function () {

				$('.btn-container').hide();

				$( "#dialog-signin" ).dialog('close');

				$( "#dialog-forgot-pass" ).dialog('close');

				$( "#dialog-signup" ).dialog('open');

			})

			$('.signIn').click(function () {

				$('.btn-container').hide();

				$( "#dialog-signup" ).dialog('close');

				$( "#dialog-forgot-pass" ).dialog('close');

				$( "#dialog-signin" ).dialog('open');

			})

			$('.forgot-pass').click(function () {

				$( "#dialog-signin" ).dialog('close');

				$( "#dialog-signin" ).dialog('close');

				$( "#dialog-forgot-pass" ).dialog('open');

			})

			let spinner = {

				start: function() {

					let elem = `<div class="modal-spinner"><i class="spinner"></i></div>`;

					$('body').append(elem);

				},

				end: function() {

					$('.modal-spinner').remove();

				}

			}

			$('#sign-up').submit(function(e) {

				e.preventDefault();

				if (!($("#sign-up").valid())) {

					return;

				}

				this.submit();

			});

			$('#log-in').click(function(e) {

				if (!($("#sign-in").valid())) {

					return;

				}

				$.ajax({
					method: "POST",
					url: 'http://localhost/themepic/verifyemailnpass.php',
					async: false,
					data: {

						'in-email': $('#in-email').val(),
						'in-pass': $('#in-pass').val()

					},
					success: function( msg ) {

						let myObj = JSON.parse(msg);

						console.log(myObj);

						if (myObj.success == false) {

							$('.form-error').html(`<i class="fas fa-exclamation-circle"></i> ` + myObj.error);
							return;

						}

						$("#sign-in").submit()

					}
				})



			});

			$('#send-email').click(function(e) {

				if (!($("#forgot-email-form").valid())) {

					console.log('not valid');

					return;

				}

				$.ajax({
					method: "POST",
					url: 'http://localhost/themepic/sendemail.php',
					data: {

						'forgot-email-name': $('#forgot-email-name').val(), 

					},
					success: function( msg ) {

						console.log(msg);

						let myObj = JSON.parse(msg);

						if (myObj.success == false) {

							$('#forgot-email-form').find('.form-error').html(`<i class="fas fa-exclamation-circle"></i> ` + myObj.error);
							return;

						}

						$('#forgot-email-form').find('.form-success').html(`You received an email to reset the password. Please check your inbox.`);

					}
				})



			});

			$("#sign-in").validate({

				rules: {
					'in-email' : {
						required: true,
						minlength: 5,
						email: true
					},
					'in-pass' : {
						required: true,
						minlength: 5,
					}

				},
				messages: {
					'in-email' : {
						required: `<i class="fas fa-exclamation-circle"></i>`+" Fill in the blank",
						email: `<i class="fas fa-exclamation-circle"></i>`+" email address is invalid",
						minlength: `<i class="fas fa-exclamation-circle"></i>`+" atleast 5 characters",
					},
					'in-pass' : {
						required: `<i class="fas fa-exclamation-circle"></i>`+" Fill in the blank",
						minlength: `<i class="fas fa-exclamation-circle"></i>`+" atleast 5 characters"
					}
				},

			});

			$("#sign-up").validate({

				rules: {
					'user-name' : {
						required: true,
						lettersonly: true,
						minlength: 2
					},
					'user-email' : {
						required: true,
						minlength: 5,
						email: true,
						remote: {
							url: "http://localhost/themepic/checkemailexists.php",
							type: "post",
							data: {  
								'user-email': function() {
									return $("#user-email").val();
								}
							}
						}
					},
					'user-pass' : {
						required: true,
						minlength: 5
					},
					agreeTerms: {
						required: true
					}

				},
				messages: {
					'user-name': {
						required: `<i class="fas fa-exclamation-circle"></i>`+" Please write your name",
						lettersonly: `<i class="fas fa-exclamation-circle"></i>`+" a name can not have symbols and numbers",
						minlength: `<i class="fas fa-exclamation-circle"></i>`+" atleast 2 characters"
					},
					'user-email' : {
						required: `<i class="fas fa-exclamation-circle"></i>`+" Fill in the blank",
						email: `<i class="fas fa-exclamation-circle"></i>`+" email address is invalid",
						minlength: `<i class="fas fa-exclamation-circle"></i>`+" atleast 5 characters",
						remote: `<i class="fas fa-exclamation-circle"></i>`+" This email is already registered"
					},
					'user-pass' : {
						required: `<i class="fas fa-exclamation-circle"></i>`+" Fill in the blank",
						minlength: `<i class="fas fa-exclamation-circle"></i>`+" atleast 5 characters",
					},
					agreeTerms: {
						required: `<i class="fas fa-exclamation-circle"></i>`
					}
				},

			});

			$("#forgot-email-form").validate({

				rules: {
					'forgot-email-name' : {
						required: true,
						email: true,
						minlength: 5
					}

				},
				messages: {
					'forgot-email-name' : {
						required: `<i class="fas fa-exclamation-circle"></i>`+" Fill in the blank",
						email: `<i class="fas fa-exclamation-circle"></i>`+" email address is invalid",
						minlength: `<i class="fas fa-exclamation-circle"></i>`+" atleast 5 characters"
					}
				},

			});

		</script>

	</body>

</html>