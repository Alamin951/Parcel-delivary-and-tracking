
<?php require_once "controllerUserData.php"; ?>
<?php require_once "fetch.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $fetch_info['firstname'] ?> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
	  nav #icon{
			color: white;
			font-size: 30px;
			line-height: 80px;
			float: right;
			margin-right: 40px;
			cursor: pointer;
			display: none;
		}
	  @media (max-width: 700px){
			label.logo{
				font-size: 32px;
				padding-left: 60px;
			}
			nav ul{
				margin-right: 20px;
			}
			nav a{
				font-size: 17px;
			}
		}
		@media (max-width: 700px){
			nav #icon{
				display: block;
			}
			nav ul{
				position: fixed;
				width: 100%;
				height: 120vh;
				background: #2f3640 ;
				top: 100px;
				left: -100%;
				text-align: center;
				transition: all .5s;
			}
			nav li{
				display: block;
				margin: 50px 0;
				line-height: 30px;
				list-style-type: none;

				
			}
			
			nav ul.show{
				left: 0;
			}
		}
  </style>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script>
		$(document).ready(function(){
			$('#icon').click(function(){
				$('ul').toggleClass('show');
			});
		});
	</script>


</head>
<body>
    
    <div class="hero">
		<nav>
			<h2 class="logo"> My<span>Parcel</span></h2>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="parcels.php">Parcels</a></li>
				<li><a href="parcel-form.php">Place Parcel</a></li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="./Admin/asset.php">Trace Parcel</a></li>
                <li><button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button></li>
			</ul>
			<label id="icon">
				<i class="fas fa-bars"></i>
			</label>
			
		</nav>

		<div class="content" id="Service">
			<h4>Welcome,<span><?php echo $fetch_info['firstname']; ?></span> to our</h4>
			<h1>Parcel delivery <span> & Tracking</span></h1>
			<h3>your reliable parcel service.</h3>
			
		</div>
	</div>

	
	<section class="about" id="about">
		<div class="main">
			<img src="image/mainimg.jpg">
			<div class="about-text">
				<h2>About <span>Us</span></h2>
				<p>We probide the best parcel delivery servises around the country. we have truustworthy reputation for being punctual and Active. Try to solve any issues instantly.</p>
				<button type="button"> <a class="button" href="#"> Welcome</a></button>
			</div>
		</div>
	</section>

	
	<div class="contact" id="contact">
		<div class="title">
			<h2>Contact us</h2>
		</div>

		<div class="box">
			<div class="card">
				<i class="fas fa-bars"></i>
				<h5>Websites</h5>
				<div class="pra">
					<p>We have a enrich website you can contact us through this. you can also check the poogress and tracking through it.</p>

					<p style="text-align: center;">
						<a class="button" href="#">Read More</a>
					</p>
				</div>
			</div>

			<div class="card">
				<i class="fas fa-envelope"></i>
				<h5>Mail</h5>
				<div class="pra">
					<p>You can contact through mail. our mail address <a href="">parcel.me@gmail.com</a></p>

					<p style="text-align: center;">
						<a class="button" href="#">Read More</a>
					</p>
				</div>
			</div>

			<div class="card">
				<i class="far fa-bell"></i>
				<h5>Address & Phone</h5>
				<div class="pra">
					<p>Wou can contact through Phone or office location.</p>

					<p style="text-align: center;">
						<a class="button" href="#">Read More</a>
					</p>
				</div>
			</div>
			
		</div>
	</div>

	<!-- footer -->
	<?php include 'footer.php'; ?>
    
</body>
</html>

