
<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM userinfo WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: log-sign.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $fetch_info['name'] ?> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style1.css">

	<link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="css/footer.css">


</head>
<body>
    
    <div class="hero">
		<nav>
			<h2 class="logo"> My<span>Parcel</span></h2>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#about">About Us</a></li>
				<li><a href="#service">Services</a></li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="#contact">Contact</a></li>
                <li><a class="navbar-brand" href="#">PDT</a>
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button></li>
			</ul>
			
		</nav>

		<div class="content" id="Service">
			<h4>Welcome,<span><?php echo $fetch_info['name']; ?></span> to our</h4>
			<h1>Parcel delivery <span> & Tracking</span></h1>
			<h3>your reliable parcel service.</h3>
			<div class="newslatter">
				<form>
					<input type="text" name="text" id="search" placeholder="type here">
					<input type="submit" name="submit" value="Search">
				</form>
			</div>
		</div>
	</div>

	
	<section class="about" id="about">
		<div class="main">
			<img src="images/mainimg.jpg">
			<div class="about-text">
				<h2>About <span>Us</span></h2>
				<p>We probide the best parcel delivery servises around the country. we have truustworthy reputation for being punctual and Active. Try to solve any issues instantly.</p>
				<button type="button">Welcome</button>
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
	<?php include 'footer.html'; ?>
    
</body>
</html>

