<?php
session_start();
require "connection.php";
$email = "";
$name = "";
$phone = "";
$gender = "";
$address = "";
$errors = array();


if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);    
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM userinfo WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "not_verified";
        $insert_data = "INSERT INTO userinfo (name, email, phone, gender, address,  password, code, status)
                        values('$name', '$email', '$phone','$gender','$address', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($con, $insert_data);
        if ($data_check) {
            $subject = "Email Verification Code";
            $message = "Your verification code for Parcel Delivery and Tracking Management System is $code. 
            Please enter this code for verify your email address. Thanks for choosing us. ";
            $sender = "From: PDT482@gmail.com";
            if (mail($email, $subject, $message, $sender)) {
                $info = "We've sent a verification code to your email - $email. Please check your email.";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed to send the code. Please enter with valid email.";
            }
        } else {
            $errors['db-error'] = "Information can't be saved for our database problem. Sorry for the interrupt. Please try again later. ";
        }
    }
}


if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM userinfo WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE userinfo SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if ($update_res) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header('location: home.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "Invalid OTP....";
    }
}



if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM userinfo WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];
        if (password_verify($password, $fetch_pass)) {
            $_SESSION['email'] = $email;
            $status = $fetch['status'];
            if ($status == 'verified') {
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: home.php');
            } else {
                $info = "It's look like you haven't still verify your email - $email";
                $_SESSION['info'] = $info;
                header('location: user-otp.php');
            }
        } else {
            $errors['email'] = "Invalid email or Password.";
        }
    } else {
        $errors['email'] = "Invalid email address.";
    }
}



if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM userinfo WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE userinfo SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($con, $insert_code);
        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code.Please enter with this code for reset your password.";
            $sender = "From: PDT482@gmail.com";
            if (mail($email, $subject, $message, $sender)) {
                $info = "We've sent a passwrod reset otp to your email - $email. Please check your email.";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}



if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM userinfo WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password .";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "Invalid Code";
    }
}


if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Password does not matched";
    } else {
        $code = 0;
        $email = $_SESSION['email'];
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE userinfo SET code = $code, password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if ($run_query) {
            $info = "Successfully changed your password. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: password-changed.php');
        } else {
            $errors['db-error'] = "Failed to change your password.Please try again..";
        }
    }
}


if (isset($_POST['login-now'])) {
    header('Location: log-sign.php');
}

// if(isset($_POST['order-now'])){
//     $name = mysqli_real_escape_string($con, $_POST['name']);    
//     $email = mysqli_real_escape_string($con, $_POST['email']);
//     $relation = mysqli_real_escape_string($con, $_POST['relation']);
//     $r_email = mysqli_real_escape_string($con, $_POST['r_email']);
//     $phone = mysqli_real_escape_string($con, $_POST['phone']);
//     $another_phone = mysqli_real_escape_string($con, $_POST['another_phone']);
//     $street = mysqli_real_escape_string($con, $_POST['street']);
//     $area = mysqli_real_escape_string($con, $_POST['area']);    
//     $thana = mysqli_real_escape_string($con, $_POST['thana']);
//     $city = mysqli_real_escape_string($con, $_POST['city']);
//     $zipcode = mysqli_real_escape_string($con, $_POST['zipcode']);
//     $type = mysqli_real_escape_string($con, $_POST['type']);
//     $urgency = mysqli_real_escape_string($con, $_POST['urgency']);
//     $breakable = mysqli_real_escape_string($con, $_POST['breakable']);

//     $customer_id = $fetch_info['id'];


//     $status = "0";
//     $order_code = 'asdfg';
//     $insert_data = "INSERT INTO order-form('name', 'email', 'relation', 'r_email', 'phone', 'another_phone', 'street', 'area', 'thana', 'city', 'zipcode', 'type', 'urgency', 'breakable', 'status', 'customer_id', 'order_code') 
//                 VALUES ('$name','$email','$relation','$r_email','$phone','$another_phone','$street','$area','$thana','$city','$zipcode','$type','$urgency','$breakable','$status','$customer_id','$order_code')";
//     $data_check = mysqli_query($con, $insert_data);

//     if($data_check){
//         echo 'data inserted';
//         header('Location: profile.php');
//     }
//     else{
//         echo 'error';
//     }

// }
