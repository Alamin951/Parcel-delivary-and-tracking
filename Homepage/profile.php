<?php require_once "controllerUserData.php"; ?>
<?php require_once "fetch.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fetch_info['fullName'] ?> | Profile</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="css/profile.css">

</head>

<body>
    
    <header>
        <div class="user">
            <img src="image/profile.png" alt="">
            <h3 class="name"><?php echo $fetch_info['firstname']?> </h3>
            <p class="post"></p>
    </div>

    <nav class="navbar">
        <ul>
            <li><a href="home.php">home</a></li>
            <li><a href="#">Edit profile</a></li>
            <li><a href="#details">Details</a></li>
            <li><a href="#contact">Employes</a></li>
            <li><a href="logout-user.php">Log out</a></li>
        </ul>
    </nav>

</header>

<!-- about section  -->

<section class="about" id="about">

<h1 class="heading"> <span>about</span> me </h1>

<div class="row">

    <div class="info">
        
        <h3> <span> name : </span> <?php echo $fetch_info['firstname']?> </h3>
        <!-- <h3> <span> age : </span> -- </h3> -->
        <h3> <span> Email : </span> <?php echo $fetch_info['email']?> </h3>
        <!-- <h3> <span> post : </span> Admin </h3> -->
        <h3> <span> Phone Number : </span>0<?php echo $fetch_info['phone']?> </h3>
        <h3> <span> Address : </span> <?php echo $fetch_info['address']?></h3>
        <h3> <span> Birthday : </span><?php echo $fetch_info['birthdate']?>  </h3>
        <h3> <span> Gender : </span><?php echo $fetch_info['gender']?>  </h3>

    </div>
</div>


</section>



<!-- details section starts  -->

<section class="details" id="details">

<h1 class="heading"> Our <span>System</span> </h1>

<div class="box-container">

    <div class="box">
        <i class="fas fa-envelope"></i>
        <h3>Current order</h3>
        <p>Currenly order things will be shown here</p>
    </div>

    <div class="box">
        <i class="fas fa-envelope"></i>
        <h3>On Delivery</h3>
        <p>On delivery order things details will be shown here</p>
    </div>

    <div class="box">
        <i class="fas fa-envelope"></i>>
        <h3>Collection</h3>
        <p>On Collection order things details will be shown here</p>
    </div>

    <div class="box">
        <i class="fas fa-envelope"></i>
        <h3>Reports</h3>
        <p>pros and cons</p>
    </div>

</div>

</section>






<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="script.js"></script>


</body>
</html>