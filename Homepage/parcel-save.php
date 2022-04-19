<?php
session_start();
require "./Admin/connection.php";
    
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
$errors=array();

if (isset($_POST['order-now'])) {
    $sender_name = mysqli_real_escape_string($conn, $_POST['sender_name']);
    $sender_address = mysqli_real_escape_string($conn, $_POST['sender_address']);
    $sender_contact = mysqli_real_escape_string($conn, $_POST['sender_contact']);
    $recipient_name = mysqli_real_escape_string($conn, $_POST['recipient_name']);
    $recipient_address = mysqli_real_escape_string($conn, $_POST['recipient_address']);
    $recipient_contact = mysqli_real_escape_string($conn, $_POST['recipient_contact']);
    $parcel_type = mysqli_real_escape_string($conn, $_POST['parcel_type']);
    $from_branch_id = mysqli_real_escape_string($conn, $_POST['from_branch_id']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $width = mysqli_real_escape_string($conn, $_POST['width']);
    $length = mysqli_real_escape_string($conn, $_POST['length']);
    
    if (count($errors) === 0) {
        $reference_number = rand(9999999999999, 1111111111111);
        $type=1;
        $to_branch_id="NULL";
        $price= ($weight*30)+($height*10)+200;
        $status=0;
        // $from_branch_id="2";

        $sql= "INSERT INTO parcels (reference_number,sender_name, sender_address, sender_contact, recipient_name,recipient_address, recipient_contact,parcel_type,type, from_branch_id,to_branch_id, weight, height,width,length,price,status)
                        values(	'$reference_number','$sender_name', '$sender_address', '$sender_contact','$recipient_name','$recipient_address','$recipient_contact','$parcel_type','$type', '$from_branch_id','$to_branch_id', '$weight', '$height','$width', '$length','$price','$status')";

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