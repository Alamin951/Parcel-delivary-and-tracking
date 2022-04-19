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
	

