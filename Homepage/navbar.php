<?php require_once "controllerUserData.php"; ?>
<?php require_once "fetch.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $fetch_info['firstname'] ?> | Home</title>

	<link rel="stylesheet" type="text/css" href="css/style1.css">
	<style>
		
.hero{
	height: 15vh;
	min-height: 100px;
	width: 100%;
	background: linear-gradient(to right, #9c27b0, #8ecdff);
	position: relative;
	overflow: hidden;
}
nav{
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding-top: 10px;
	padding-left: 8%;
	padding-right: 8%;
	position: sticky;
}
.logo{
	color: white;
	font-size: 35px;
	letter-spacing: 1px;
	cursor: pointer;
}
span{
	color: #f9004d;
}
nav ul li{
	list-style-type: none;
	display: inline-block;
	padding: 10px  25px;
}
nav ul li a{
	color: white;
	text-decoration: none;
	font-weight: bold;
	text-transform: capitalize;
}
nav ul li a:hover{
	color: #f9004d;
	transition: .4s;
}
	</style>

</head>
<body>
	
	
	<div class="hero">
		<nav class="navigationbar">
			<h2 class="logo"> My<span>Parcel</span></h2>
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="parcels.php">Parcels</a></li>
				<li><a href="parcel-form.php">Place Parcel</a></li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="./Admin/asset.php">Trace Parcel</a></li>
                <li><a href="logout-user.php">Logout</a></li>
			</ul>
			
		</nav>

	</div>
	

