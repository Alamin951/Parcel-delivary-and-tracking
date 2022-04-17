<?php require_once "controllerUserData.php"; ?>
<?php require_once "fetch.php"; ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Parcel order</title>
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    


    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
      html, body {
      min-height: 100%;
      }
      body, div, input, select, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      }
      form { 
        max-width: 60%;
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      }
      h1 {
      margin: 0;
      font-weight: 400;
      }
      h3 {
      margin: 12px 0;
      color: #8ebf42;
      }
      .main-block {
      display: flex;
      justify-content: center;
      align-items: center;
      background: #fff;
      }
      form {
      width: 100%;
      padding: 20px;
      }
      fieldset {
      border: none;
      border-top: 1px solid #8ebf42;
      }
      .reciver-details, .package-details {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .reciver-details >div, .package-details >div >div {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      }
      .reciver-details >div, .package-details >div, input, label {
      width: 100%;
      }
      .package-details strong{
        padding-left: 5px;
      }
      label {
      padding: 0 5px;
      text-align: right;
      vertical-align: middle;
      }
      input {
      padding: 5px;
      vertical-align: middle;
      }
      .checkbox {
      margin-bottom: 10px;
      }
      select, .children, .gender, .bdate-block {
      width: calc(100% + 26px);
      padding: 5px 0;
      }
      select {
      background: transparent;
      }
      .gender input {
      width: auto;
      } 
      .gender label {
      padding: 0 5px 0 0;
      } 
      .checkbox input, .children input {
      width: auto;
      margin: -2px 10px 0 0;
      }
      .checkbox a {
      color: #8ebf42;
      }
      .checkbox a:hover {
      color: #82b534;
      }
      .checkbox span{
        color: #8ebf42;
      }
      button {
      width: 20%;
      padding: 10px 0;
      margin: 10px auto;
      border-radius: 10px; 
      border: none;
      background: #8ebf42; 
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      position: relative;
      margin-left: 40%;
      margin-right: 40%;
      }
      button:hover {
      background: #82b534;
      }
      @media (min-width: 568px) {
      .reciver-details >div, .package-details >div {
      width: 50%;
      }
      label {
      width: 40%;
      }
      input {
      width: 60%;
      }
      select, .children, .gender, .bdate-block {
      width: calc(60% + 16px);
      }
      }
    </style>
  </head>
  <body>
    <?php
      include 'navbar.html';
    ?>


    <div class="main-block">
    <form action="parcel-form.php" method="POST">
      <h1>Prcel order</h1>
      <fieldset>
        <legend>
          <h3>Reciver Details</h3>
        </legend>
        <div  class="reciver-details">
          <div><label>Name*</label><input type="text" name="name" required></div>
          <div><label>Email*</label><input type="email" name="email" required></div>
          <div><label>Relation</label><input type="text" name="relation"></div>
          <div><label>Repeat email*</label><input type="email" name="r_email" required></div>
          <div><label>Phone*</label><input type="text" name="phone" required></div>
          <div><label>Another Phone</label><input type="text" name="another_phone" required></div>
          <div><label>Street*</label><input type="text" name="street" required></div>
          <div><label>Area*</label><input type="text" name="area" required></div>
          <div><label>Thana*</label><input type="text" name="thana" required></div>
          <div><label>City*</label><input type="text" name="city" required></div>
          <div><label>Zip code</label><input type="number" name="zipcode"></div>
        </div>
      </fieldset>
      <fieldset>
        <legend>
          <h3>Other Details</h3>
        </legend>
        <div  class="package-details">
          <div>
           
            <div>
              <label>Parcel type*</label>  
              <select name="type" required>
                <option disabled selected>Please choose</option>
                <option value="Document">Document</option>
                <option value="Money">Money</option>
                <option value="Accessories">Accessories</option>
                <option value="Food">Food</option>
                <option value="Electronics">Electronics</option>
              </select>
            </div>
            <div><label>Weight</label><input type="number" name="weight"> <strong>g</strong>  </div>
          </div>
          <div>
            <div>
              <label>Urgency*</label>              
              <select name="urgency">
                <option disabled selected> Please state the urgency</option>
                <option value="Normal">Normal</option>
                <option value="Urgent">Urgent</option>
                <option value="Extremly Important">Extremly Important</option>
              </select>
            </div>
            <div>
              <label>Breakable?*</label>
              <select name="breakable">
                <option disabled selected> Please state the urgency</option>
                <option value="1">yes</option>
                <option value="0">No</option>
              </select>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>
          <h3>Terms and Mailing</h3>
        </legend>
        <div  class="terms-mailing">
          <div class="checkbox">
            <input type="checkbox" name="checkbox"><span>I accept the <a href="">Privacy Policy for this website.</a></span>
          </div>
          <div class="checkbox">
            <input type="checkbox" name="checkbox"><span>I want to send this personallzed parcel by your site</span>
          </div>
      </fieldset>
      <a href="p_payment.php"><button type="submit" name="order-now">Submit</button></a>
    </form>
    </div>
    <?php include 'footer.html'; ?> 
  </body>
</html>

<?php
include 'connection.php';
if(isset($_POST['order-now'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);    
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $relation = mysqli_real_escape_string($con, $_POST['relation']);
    $r_email = mysqli_real_escape_string($con, $_POST['r_email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $another_phone = mysqli_real_escape_string($con, $_POST['another_phone']);
    $street = mysqli_real_escape_string($con, $_POST['street']);
    $area = mysqli_real_escape_string($con, $_POST['area']);    
    $thana = mysqli_real_escape_string($con, $_POST['thana']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $zipcode = mysqli_real_escape_string($con, $_POST['zipcode']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $urgency = mysqli_real_escape_string($con, $_POST['urgency']);
    $breakable = mysqli_real_escape_string($con, $_POST['breakable']);

    $customer_id = $fetch_info['id'];


    $status = "0";
    $order_code = 'asdfg';
    $insert_data = "INSERT INTO order-form
                VALUES ('$name','$email','$relation','$r_email','$phone','$another_phone','$street','$area','$thana','$city','$zipcode','$type','$urgency','$breakable','$status','$customer_id','$order_code')";
    $data_check = mysqli_query($con, $insert_data);

    if($data_check){
        echo 'data inserted';
        header('Location: p_payment.php');
    }
    else{
        echo 'error';
    }

}
?>