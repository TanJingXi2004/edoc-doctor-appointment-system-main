<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" href="img/icons/favicon.ico" type="image/ico" sizes="16x16">
	<title>Welcome to CLINIC MMU</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Lato|Poppins&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	<style>
		html {
			scroll-behavior: smooth;
		}

		h2,
		h3,
		h4,
		h5,
		h6 {
			font-weight: 700;
		}

		body {
			font-family: 'Lato', sans-serif;
		}

		.navbar {
			padding-top: 2rem;
		}

		.navbar .nav-item {
			margin: 0 .75rem 0;
		}

		.navbar-brand a {
			box-shadow: 0px 25px 10px -15px rgba(0, 0, 0, 0.08);
		}

		.nav-dropdown {
			border-radius: 10px;
			border: 0;
			padding: 0 1.2rem;
			background: linear-gradient(to right, #8914fe 0%, #8063f5 100%);
			box-shadow: 0px 25px 10px -10px rgba(0, 0, 0, 0.08);
		}

		.nav-dropdown a.dropdown-link {
			color: #f5f5f5 !important;
		}

		.btn-primary {
			color: #fff;
			background: linear-gradient(to right, #8914fe 0%, #8063f5 100%) !important;
			border-color: #6F42C2 !important;
		}

		.btn-primary:hover {
			color: #fff;
			background-color: #906BD4 !important;
			border-color: #906BD4 !important;
			-webkit-box-shadow: none;
			box-shadow: none;
		}

		.btn-primary:focus {
			box-shadow: 0 0 0 0.2rem rgba(111, 66, 194, .5) !important;
		}

		.jumbotron {
			padding: 20% 0;
			background: url('./img/health-heart-icon.jpg');
            background-repeat: no-repeat;
			background-position: 80% 10%;
		}

		.jumbotron-title {
			font-size: 3rem;
			text-transform: capitalize;
		}

		section {
			padding: 3rem 0 6rem;
		}

		.section-title {
			margin-bottom: 6rem;
		}

		section img {
			margin-bottom: 2rem;
		}

		.feature-section {
			background: url('./img/getty_patient_care.jpg');
			background-position: 0% 100%;
			background-size: 600px;
			background-repeat: no-repeat;
		}

		.feature-section .card {
			border-radius: 10px;
			box-shadow: 0px 25px 10px -15px rgba(0, 0, 0, 0.08);
			transition: .4s;
		}

		.feature-section .card:hover {
			transform: scale(1.1);
			box-shadow: 0px 25px 10px -15px rgba(0, 0, 0, 0.08);
		}

		.footer {
			width: 100%;
			height: auto;
			color: #333;
			bottom: 0px;
			left: 0px;
			padding: 45px 0 40px;
		}

		.footer a {
			color: #333;
		}

		.footer a:hover {
			color: purple;
			text-decoration: none;
		}

		.footer ul li {
			margin: .8rem 0;
		}

		.upper-footer {
			border-bottom: #f8f8f9;
			width: 100%;
		}

		.bottom-footer {
			margin-top: 10px;
		}

		.footer ul {
			list-style-type: none;
		}

		.footer ul li {
			margin-left: -40px;
		}

		.footer-link {
			text-align: right;
		}

		.bottom-footer-link {
			margin: 0 5px;
		}

		.top-button {
			position: absolute;
			right: 30px;
		}

		.top-scroll {
			padding: 10px 16px;
			background-color: #f2f2f2;
			border-radius: 5px;
			font-size: 20px;
			transition: .3s;
		}

		.top-scroll:hover {
			background-color: #dfdddd;
		}

		img.banner {
			width: 380px !important;
			height: 450px !important;
		}


		/*
FOR ANIMATION
*/

		.slideanim {
			visibility: hidden;
		}

		.slide {
			/* The name of the animation */
			animation-name: slide;
			-webkit-animation-name: slide;
			/* The duration of the animation */
			animation-duration: 1s;
			-webkit-animation-duration: 1s;
			/* Make the element visible */
			visibility: visible;
		}

		/* Go from 0% to 100% opacity (see-through) and specify the percentage from when to slide in the element along the Y-axis */
		@keyframes slide {
			0% {
				opacity: 0;
				transform: translateY(70%);
			}

			100% {
				opacity: 1;
				transform: translateY(0%);
			}
		}

		@-webkit-keyframes slide {
			0% {
				opacity: 0;
				-webkit-transform: translateY(70%);
			}

			100% {
				opacity: 1;
				-webkit-transform: translateY(0%);
			}
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<nav class="navbar navbar-expand-lg navbar-light">
			<div class="container">
				<a class="navbar-brand" href="#">Clinic <b>MMU</b></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="#about">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#feature">Features</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#support">Support</a>
						</li>
						<li class="nav-item dropdown nav-dropdown">
							<a class="nav-link dropdown-toggle dropdown-link" href="#" id="navbarDropdownMenuLink"
								role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Log In/Sign Up
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="login.php">Admin</a>
								<a class="dropdown-item" href="login.php">Doctor</a>
                                <a class="dropdown-item" href="login.php">Patient</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h2 class="jumbotron-title">Your health is our piority</h2>
				<p> Always here to provide caring support whenever and wherever you need it.</p>
			</div>
		</div>

		<section class="about-section text-center" id="about">
			<h2 class="section-title">About</h2>
			<div class="container">
				<div class="row slideanim">
					<div class="col-6 col-md-4">
						<div class="image">
							<img src="https://img.icons8.com/dusk/128/000000/counselor.png" alt="" title="">
						</div>
						<div class="desc">
							<h4 class="mb-3">Easiest way around</h4>
							<p class="paragraph">
								Quickly book appointments and find the right doctor 
								— all in one place. We make your healthcare 
								journey easier from the very first click.
							</p>
						</div>
					</div>
					<div class="col-6 col-md-4">
						<div class="image">
							<img src="img/clinic-letter.png" alt="" title="">
						</div>
						<div class="desc">
							<h4 class="mb-3">Anywhere, anytime</h4>
							<p class="paragraph">
								Book appointments and find 
								doctors at your convenience 
								— 24/7, from any device.
							</p>
						</div>
					</div>
					<div class="col-6 col-md-4">
						<div class="image">
							<img src="https://img.icons8.com/dusk/128/000000/heart-with-pulse.png" alt="" title="">
						</div>
						<div class="desc">
							<h4 class="mb-3">Track Your Health</h4>
							<p class="paragraph">
								Keep a close eye on your health journey 
								with simple tools that let you book appointments 
								and find trusted doctors whenever you need.
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="feature-section text-center" id="feature">
			<h2 class="section-title">Feature</h2>
			<div class="container">
				<div class="row slideanim">
					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<img src="https://img.icons8.com/officexs/80/000000/triangular-bandage.png">
								<h5 class="card-title">Administrator</h5>
								<p class="card-text">Organizing care, empowering health — Administrator at your service.
								</p>
								<a href="admin/index.php" class="btn btn-primary">Admin</a>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<img src="https://img.icons8.com/officexs/80/000000/medical-doctor.png">
								<h5 class="card-title">Doctor</h5>
								<p class="card-text">Trusted doctors, committed to your health and healing.
								</p>
								<a href="doctor/index.php" class="btn btn-primary">Doctor</a>
							</div>
						</div>
					</div>
                    <div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<img src="img/patient.png">
								<h5 class="card-title">Patient</h5>
								<p class="card-text">Every patient matters—your health, our priority.
								</p>
								<a href="patient/index.php" class="btn btn-primary">Patient</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="text-center" id="Feedback">
			<h2 class="section-title">Feedback</h2>
			<div id="carouselContent" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner text-center" role="listbox">
					<div class="carousel-item active">
						<div class="avatar"><img
								src="https://img.icons8.com/color/48/000000/circled-user-male-skin-type-7.png"></div>
						<p>Top of the line medical technology without having to wait too long</p>
						<div class="quote">
							<p><strong>- Chris Fox</strong><br>Patient</p>
						</div>
					</div>
					<div class="carousel-item">
						<div class="avatar"><img
								src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png"></div>
						<p>No one is better than Doctor Loh</p>
						<div class="quote">
							<p><strong>- Rebecca Flex</strong><br>Patient</p>
						</div>
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselContent" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselContent" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</section>

	</div>

	<footer class="footer">
		<div class="upper-footer">
			<div class="container">
				<div class="row">
					<div class="col-3">
						<a class="navbar-brand" href="#">Clinic MMU</a>
					</div>
					<div class="col-3">
						<h5>Product</h4>
							<ul>
								<li class=""><a href="#">About</a></li>
								<li class=""><a href="#">Features</a></li>
								<li class=""><a href="#">Career</a></li>
								<li class=""><a href="#">Help Center</a></li>
							</ul>
					</div>
					<div class="col-3">
						<h5>Support</h5>
						<ul>
							<li class=""><a href="#">Help Center</a></li>
							<li class=""><a href="#">FAQ</a></li>
							<li class=""><a href="#">Security</a></li>
							<li class=""><a href="#">Blog</a></li>
						</ul>
					</div>
					<div class="col-3">
						<a class="mr-3" href=""><i class="fab fa-facebook-f"></i></a>
						<a class="mr-3" href=""><i class="fab fa-twitter"></i></a>
						<a class="mr-3" href=""><i class="fab fa-google"></i></a>
						<ul>
							<li class=""><a href="#">clinicmmu@gmail.com</a></li>
							<li class=""><a href="#">(60)123456789</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom-footer">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<p>&copy;
							<script type="text/javascript">
								document.write(new Date().getFullYear());
							</script> Clinic MMU Sdn Bhd
						</p>
					</div>
					<div class="col-6 footer-link">
						<a class="bottom-footer-link" href="#">Privacy</a>&middot;
						<a class="bottom-footer-link" href="#">Accessibility</a>&middot;
						<a class="bottom-footer-link" href="#">Terms</a>
					</div>
					<div class="top-button"><a href="#top" class="top-scroll"><i class="fas fa-angle-up"></i></a></div>
				</div>
			</div>
		</div>
	</footer>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>
	<script>
		$(window).scroll(function () {
			$(".slideanim").each(function () {
				var pos = $(this).offset().top;

				var winTop = $(window).scrollTop();
				if (pos < winTop + 600) {
					$(this).addClass("slide");
				}
			});
		});
	</script>
</body>

</html>