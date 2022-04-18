<?php require_once "fetch.php"; ?>

<<?php
include './Admin/connection.php';
    $name = mysqli_real_escape_string($conn, $_REQUEST['name']);    
    $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
    $relation = mysqli_real_escape_string($conn, $_REQUEST['relation']);
    $r_email = mysqli_real_escape_string($conn, $_REQUEST['r_email']);
    $phone = mysqli_real_escape_string($conn, $_REQUEST['phone']);
    $another_phone = mysqli_real_escape_string($conn, $_REQUEST['another_phone']);
    $street = mysqli_real_escape_string($conn, $_REQUEST['street']);
    $area = mysqli_real_escape_string($conn, $_REQUEST['area']);    
    $thana = mysqli_real_escape_string($conn, $_REQUEST['thana']);
    $city = mysqli_real_escape_string($conn, $_REQUEST['city']);
    $zipcode = mysqli_real_escape_string($conn, $_REQUEST['zipcode']);
    $type = mysqli_real_escape_string($conn, $_REQUEST['type']);
    $urgency = mysqli_real_escape_string($conn, $_REQUEST['urgency']);
    $breakable = mysqli_real_escape_string($conn, $_REQUEST['breakable']);

    $customer_id = $fetch_info['id'];


    $status = "0";
    $order_code = 'asdfg';
    $sql = "INSERT INTO order-form(name,email,relation,r_email,phone,another_phone,street,area,thana,city,customer_id,order_code)
                VALUES ('$name','$email','$relation','$r_email','$phone','$another_phone','$street','$area','$thana','$city',$customer_id,'$order_code');";
    
    $data_check = mysqli_query($conn, $sql);

    if($data_check){
        echo 'data inserted';
        header('Location: home.php');
    }
    else{
        echo 'error';
    }


?>