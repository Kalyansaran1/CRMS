<?php
session_start();
error_reporting(0);

include_once('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Campus Recruitment Management System || Contact Us</title>
	
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style6.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
</head>

<body>
	<!-- banner-inner -->
	<div id="demo-1" class="page-content">
		<div class="dotts">
			<div class="header-top">
				<?php include_once('includes/header.php'); ?>
			</div>
			<div class="banner-info-w3layouts text-center"></div>
		</div>
	</div>
	<ol class="breadcrumb justify-content-left">
		<li class="breadcrumb-item">
			<a href="index.php">Home</a>
		</li>
		<li class="breadcrumb-item active">About Us</li>
	</ol>

	<!-- contact -->
	<section class="banner-bottom-wthree pt-lg-5 pt-md-3 pt-3">
		<div class="inner-sec-w3ls pt-md-5 pt-md-3 pt-3">
			<h3 class="tittle text-center mb-lg-5 mb-3">
				<span>Get More info</span> About Us</h3>
			<?php 
				$query = mysqli_query($con, "select * from tblpage where PageType='aboutus'");
				while ($row = mysqli_fetch_array($query)) {
			?>
			<div class="container">
				<div class="address row mb-5">
					<div class="col-lg-12 address-grid">
						<div class="row address-info">
							<div class="col-md-9 address-right text-left">
								<h6 class="ad-info text-uppercase mb-2"><?php echo $row['PageTitle']; ?></h6>
								<p><?php echo $row['PageDescription']; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</section>

	<?php include_once('includes/footer.php'); ?>

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/modernizr-2.6.2.min.js"></script>
	<script src="js/classie-search.js"></script>
	<script src="js/demo1-search.js"></script>

	<script>
		$(document).ready(function () {
			$(".dropdown").hover(
				function () {
					$('.dropdown-menu', this).stop(true, true).slideDown("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('.dropdown-menu', this).stop(true, true).slideUp("fast");
					$(this).toggleClass('open');
				}
			);
		});
	</script>

	<script>
		window.onload = function () {
			document.getElementById("password1").onchange = validatePassword;
			document.getElementById("password2").onchange = validatePassword;
		}

		function validatePassword() {
			var pass2 = document.getElementById("password2").value;
			var pass1 = document.getElementById("password1").value;
			if (pass1 != pass2)
				document.getElementById("password2").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("password2").setCustomValidity('');
		}
	</script>

	<script src="js/bootstrap.js"></script>
	<script src="js/move-top.js"></script>
	<script src="js/easing.js"></script>

	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 900);
			});
		});
	</script>

	<script>
		$(document).ready(function () {
			$().UItoTop({
				easingType: 'easeOutQuart'
			});
		});
	</script>
</body>
</html>

