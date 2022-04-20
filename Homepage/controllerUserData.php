<?php
session_start();
require "./Admin/connection.php";
$email = "";
$firstname = "";
$phone = "";
$gender = "";
$birthdate="";
$address = "";
$type ="";
$msg = "";
$errors = array();


if (isset($_POST['signup'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);

    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];    
        $folder = "userProfile/". $filename;

    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $email_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "not_verified";
        $insert_data = "INSERT INTO users (firstname, email, phone, gender,birthdate, address,filename,  password, code, status,type)
                        values('$firstname', '$email', '$phone','$gender','$birthdate','$address','$filename', '$encpass', '$code', '$status', '$type')";
                        

        $data_check = mysqli_query($conn, $insert_data);
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }

        if ($data_check) {
            $subject = "Email Verification Code";
            $message = "Dear $firstname, Your verification code for Parcel Delivery and Tracking Management System is $code. 
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

?>

<?php


if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM users WHERE code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE users SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($conn, $update_otp);
        if ($update_res) {
            $_SESSION['firstname'] = $firstname;
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
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $check_email);
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
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $run_sql = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($conn, $insert_code);
        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "Dear $firstname, Your password reset code is $code.Please enter with this code for reset your password.";
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
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM users WHERE code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
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
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Password does not matched";
    } else {
        $code = 0;
        $email = $_SESSION['email'];
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($conn, $update_pass);
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



?>

<?php

$sender_name="";
$sender_address="";
$sender_contact="";
$recipient_name="";
$recipient_address="";
$recipient_contact="";
$parcel_type="";
$from_branch_id="";
$weight="";
$height="";
$width="";
$length="";
$users_id="";
$errors=array();

if (isset($_POST['order-now'])) {
    $sender_name = mysqli_real_escape_string($conn, $_POST['sender_name']);
    $sender_address = mysqli_real_escape_string($conn, $_POST['sender_address']);
    $sender_contact = mysqli_real_escape_string($conn, $_POST['sender_contact']);
    $recipient_name = mysqli_real_escape_string($conn, $_POST['recipient_name']);
    $recipient_address = mysqli_real_escape_string($conn, $_POST['recipient_address']);
    $recipient_contact = mysqli_real_escape_string($conn, $_POST['recipient_contact']);
    $parcel_type = mysqli_real_escape_string($conn, $_POST['parcel_type']);
    $to_branch_id= mysqli_real_escape_string($conn, $_POST['to_branch_id']);
    $from_branch_id = mysqli_real_escape_string($conn, $_POST['from_branch_id']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $width = mysqli_real_escape_string($conn, $_POST['width']);
    $length = mysqli_real_escape_string($conn, $_POST['length']);
    $users_id = mysqli_real_escape_string($conn, $_POST['users_id']);

    
    if (count($errors) === 0) {
        $reference_number = rand(9999999999999, 1111111111111);
        $type=1;
        $price= $weight*40;
        $status=0;
        // $from_branch_id="2";

        $sql= "INSERT INTO parcels (users_id,reference_number,sender_name, sender_address, sender_contact, recipient_name,recipient_address, recipient_contact,parcel_type,type, from_branch_id,to_branch_id, weight, height,width,length,price,status)
                        values(	'$users_id','$reference_number','$sender_name', '$sender_address', '$sender_contact','$recipient_name','$recipient_address','$recipient_contact','$parcel_type','$type', '$from_branch_id','$to_branch_id', '$weight', '$height','$width', '$length','$price','$status')";

        $data = mysqli_query($conn, $sql);

        if($data){
            echo "Success";
            header('location: p_payment.php');
            
        }
        else{
            echo "error";
        }
    }
}

?>