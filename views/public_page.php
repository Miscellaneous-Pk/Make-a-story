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

			/*Story Board CSS here*/
			.card img {

				max-width: 100%;

			}

			.grid-item a:hover {
				text-decoration: none;
			}

			.draft-badge {

				position: absolute;
				top: 0.5em;
				right: 0.5em;

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

			small {

				pointer-events: none;

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
		
		<div class="container-fluid mainPage">

			<div id="dialog-public" class="pt-md-2 pt-0 d-flex flex-wrap align-items-stretch justify-content-center">

				<div class="col-lg-8 col-md-10 col-12 order-mdm-1 order-2 mx-0 p-0 rounded-top">

					<div class="img-block">

						<div id="overlay" class="position-absolute">

							<div class="detailBox d-flex bg-dark rounded">

								<small class="border-right px-1 rounded-left">1</small>
								<small class="border-right px-1">2</small>
								<small class="border-right px-1">3</small>
								<small class=" px-1 rounded-right">4</small>

							</div>

							<canvas data-html2canvas-ignore class="" id="myCanvas"></canvas> 

						</div>

						<div class="" id="for-printing">

							<div class="circleAndNo rounded-circle bg-info text-light" >
								<span data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."></span>
								<elem>1</elem>
							</div>

							<!--<img class="image mx-auto border border-dark rounded-top" id="blah" src="01f.%20img.jpg" alt="">-->

							<!--<img class="image mx-auto border border-dark rounded-top" id="blah" src="http://res.cloudinary.com/miscellaneous/image/upload/v1528352946/7185GrAb4uL._SL1406_.jpg" alt="">-->

							<img class="image bg-shadow mx-auto border border-dark rounded-top" id="blah" src="http://res.cloudinary.com/miscellaneous/image/upload/v1528352946/7185GrAb4uL._SL1406_.jpg" alt="">


							<div class="position-relative mx-auto detailBox-Big">

								<div class="d-flex flex-wrap justify-content-center bg-dark rounded-bottom">

									<div class="col-md-4 col-sm-6 col-12 text-left p-2">

										<span class="badge badge-light">1</span>
										<small >Quickly manage the layout, alignment, and sizing of grid columbox utilities. For more complex implementations, custom CSS may be necessary.</small>

									</div>
									<div class="col-md-4 col-sm-6 col-12 text-left p-2">

										<span class="badge badge-light">2</span>
										<small>Quickly manage the layout, alignment, and sizing of grid columns, navigation, components, and more with a full suite of responsive flexbox utilities. For more complex implementations, custom CSS may be necessary.</small>

									</div>
									<div class="col-md-4 col-sm-6 col-12 text-left p-2">

										<span class="badge badge-light">3</span>
										<small>Quickly mities. For more complex implementations, custom CSS may be necessary.</small>

									</div>
									<div class="col-md-4 col-sm-6 col-12 text-left p-2">

										<span class="badge badge-light">4</span>
										<small >Quickly manage the layout, alignment, and sizing of grid columns, navigation, components, and more with a full suite of responsive flexbox a full suite of responsive flexbox utilities. For more complex implementations, custom CSS may be necessary.</small>

									</div>
									<div class="col-md-4 col-sm-6 col-12 text-left p-2">

										<span class="badge badge-light">5</span>
										<small>Quickly manage the layout, align, custom CSS may be necessary.</small>

									</div>
									<div class="col-md-4 col-sm-6 col-12 text-left p-2">

										<span class="badge badge-light">1</span>
										<small>Quickly manage the layout, alignment, and sizing of grid columns, navigation, components, and more with a full suite of responsive flexbox utilities. For more complex implementations, custom CSS may be necessary.</small>

									</div>

								</div>

							</div>


						</div>

					</div>

				</div> 

			</div>

		</div>

		<script src="https://code.jquery.com/jquery-3.3.1.js"
				integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
				crossorigin="anonymous"></script>
		<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

		<script type="text/javascript">

			let wht = $(window).height();
			let wwt = $(window).width();

			$( document ).ready(function() {
				
				$('.image').trigger('load');

				$('[data-toggle="popover"]').popover({

					animation: true,

				});

				$('[data-toggle="tooltip"]').tooltip();

				$( "#dialog-public" ).dialog({
					resizable: false,
					height: 'auto',
					width: 'auto',
					position: { my: "center top", at: "center top", of: window },
					//					modal: true,
					autoOpen: true,
					appendTo: ".mainPage",
					show: {
						effect: "fade",
						duration: 500
					},
				})

			}) // DOCUMENT IS READY AND RECIZE

			$( window ).resize(function() {

				wht = $(window).height();
				wwt = $(window).width();

				$('.mainPage').height(wht);

				$('.image').css({'max-height': wht/1.1, 'max-width' : '100%'});

				let imgWt = $('.image').width();
				let imgHt = $('.image').height();

				$('.carry-menu').height(imgHt);

				if (wwt < 767) {

					$('.carry-menu').height('auto');

				}

				$('#overlay').css({height: imgHt, width: imgWt});

				$('.detailBox-Big').css({width: imgWt + 2});

				$('.circleAndNo').each(function(key,value) {

					if ($(this).data().percentX){

						let percent = $(this).data();

						$('.circleAndNo:eq('+key+')').css({
							left: percent.percentX * $('#myCanvas').width() + $('#overlay').position().left, 
							top: percent.percentY * $('#myCanvas').height(),
							'font-size': percent.mFontSize * $('#myCanvas').width(), 
							height: percent.mHeight * $('#myCanvas').width(), 
							width: percent.mWidth * $('#myCanvas').width()
						})

					}

				})

				$( "#dialog-public" ).dialog( "option", "position", { my: "center top", at: "center top", of: window });

			})

			$(document).on('mouseenter mouseleave','.circleAndNo', function() {

				// if own popover is being edited return 

				$(this).toggleClass('bg-dark').toggleClass('bg-light');

				if ($(this).data().editFlag) { return };

				let elem = '';
  
				if ($(this).data().comment) {

					$(this).children().popover('toggle');

					elem = `
<div rows="3" class="p-2 w-100 bg-dark rounded text-light">`+$(this).data('comment')+`</div>
<div class="px-2"><small class="text-muted notify-in-pop py-2 text-light text-left">Press to edit or delete</small></div>
`;
					$('.popover:eq(-1)').addClass('custom-dark-popover bg-dark');

					$('.popover-body:eq(-1)').html(elem);

				}

				if (oneInProgress) {

					$('.notify-in-pop').html('An edit is open')

				}


			}) // HOVER ON MARKER IN CANVAS

			function printcommand(instance) {

				this.array = [];

				this.execute = function execute(bool_textreq) {

					this.array.push(instance);
					instance.execute(bool_textreq);

				}

				this.undo = function undo(instance) {

					let command = this.array.pop();
					command.undo();

				}

			}

			let printhidendisplay = new printcommand({

				execute: function(textreq) {

					let imgWt = $('.image').width();

					let elem = $('#for-printing').clone().addClass('custom-hide bg-dark');

					$('body').append(elem);

					// Custom Hide is image cloned from printing area and placed out of visible DOMs. Image width is given the width of its original image.
					$('.custom-hide').children('.image').width(imgWt);

					if (!(textreq)) {

						$('.custom-hide').children('.detailBox-Big').remove();

					}

					$('.custom-hide').children('.detailBox').remove();

				},

				undo: function() {

					$('.custom-hide').remove();

				}

			});

			$(document).on('click','.download-pic',function(e) {

				let aTag = `<a class="aTag" style="display:none">Click Me</a>`;

				$('body').append(aTag);

				printhidendisplay.execute(false);

				let div = document.querySelector('.custom-hide');

				html2canvas(div,{

					useCORS: true,
					backgroundColor: 'null'

				}).then(function(drawnPic) { 

					let link = drawnPic.toDataURL('image/jpeg'); 

					$('.aTag:eq(0)').attr({href: link, download:'newImage'}).click();

					printhidendisplay.undo();

				});

			})

			$(document).on('click','.aTag',function(e) {

				this.click();
				this.remove();

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
			
			$('.image').on('load', function(){

				$(this).css({'max-height': wht/1.1, 'max-width' : '100%'});

				let imgWt = $(this).width();
				let imgHt = $(this).height();

				console.log(imgWt, imgHt);

				$('.carry-menu').height(imgHt);

				if (wwt < 767 || imgHt < 300) {

					$('.carry-menu').height('auto');

				}

				$('#overlay').css({height: imgHt, width: imgWt});

				$('.detailBox-Big').css({width: imgWt + 2});

				$('.detailBox').css({right: '2%',bottom: '2%'});

			});


		</script>

	</body>

</html>