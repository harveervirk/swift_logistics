<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
}
else{
  header("location: login.php");
  exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email =$_SESSION["email"];
// Add the code for creating a payment
$date = date ('Y-m-d');
$orderid="";
$ref_id;
//For online orders there will be one shipment per order
$qty=1;
$pcode2= $province2= $city2= $add1=$add2= "";
$weight=$height=$width=$length=$price=$type="";
$paymentid;

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
        $name=$_POST["name2"];
        $pcode2=$_POST["pcode2"];
        $province2=$_POST["prov2"];
        $city2=$_POST["city2"];
        $add1=$_POST["add12"];
        $add2=$_POST["add22"];
        $weight=$_POST["weight"];
        $height=$_POST["height"];
        $width=$_POST["width"];
        $length=$_POST["length"];
        $price=$_POST["shipping"]=="Standard"?400:500;
        $type=$_POST["shipping"];
        
        $shipping_address=false;
        // Setting the defaults
        $country="CA";
        $empid=1;

        $sql = "INSERT INTO Payment(payment_id, Amount, Type) VALUES (?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql))
        { 
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $paymentid,$param_amt,$param_type);
            
            // Set parameters
            $paymentid=uniqid("PID",true);
            $param_amt=$price;
            $param_type="Visa";
            if(mysqli_stmt_execute($stmt))
            {

              $sql = "INSERT INTO `Order`(order_id, email, payment_id, qty,order_date) VALUES (?, ?, ?, ?,?)";
              if($stmt = mysqli_prepare($link, $sql))
              {
                  // Bind variables to the prepared statement as parameters
                  mysqli_stmt_bind_param($stmt, "sssss", $param_id,$param_email,$param_paymentid,$param_qty,$param_date);
                  
                  // Set parameters
                  $param_email = $email;
                  $param_paymentid=$paymentid;
                  $param_qty=$qty;
                  $param_date=$date;
                  $orderid=uniqid("OID",true);
                  $param_id=$orderid;
                  
                  // Attempt to execute the prepared statement
                  if(mysqli_stmt_execute($stmt))
                  {
                    // Close statement
                    mysqli_stmt_close($stmt);

                    $sql = "SELECT postal_code FROM shipment_address WHERE postal_code = ?";       
                        
                    if($stmt = mysqli_prepare($link, $sql))
                    {
                      // Bind variables to the prepared statement as parameters
                      mysqli_stmt_bind_param($stmt, "s", $param_pcode2);
                        
                      // Set parameters
                      $param_pcode2=$pcode2;
                        
                      // Attempt to execute the prepared statement
                      if(mysqli_stmt_execute($stmt))
                      {
                        // Close statement
                        mysqli_stmt_store_result($stmt);
                        if(mysqli_stmt_num_rows($stmt) == 1)
                        {
                          // The data for postal code is already saved
                          $shipping_address=true;
                        } 
                        else
                        {
                          // Close statement
                          mysqli_stmt_close($stmt);
                          // Prepare an insert statement
                          $sql = "INSERT INTO shipment_address (postal_code, city, province, country) VALUES (?, ?, ?, ?)";
                          if($stmt = mysqli_prepare($link, $sql))
                          {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ssss", $param_pcode2, $param_city2, $param_province2, $param_country2);
                            
                            // Set parameters
                            $param_pcode2 = $pcode2;
                            $param_city2=$city2;
                            $param_province2=$province2;
                            $param_country2=$country;
                              
                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt))
                            {
                                //Successfully saved the new postal code
                                $shipping_address=true;
                            } 
                            else
                            {
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                            // Close statement
                            mysqli_stmt_close($stmt);
                          }
                        }

                        if($shipping_address==true)
                        {
                          $sql = "INSERT INTO shipment(first_name,ref_id, order_id, emp_id, weight,length,width,height,price,type,street_address,postal_code) VALUES (?, ?, ?, ?,?,?, ?, ?, ?,?,?,?)";

                          
                          if($stmt = mysqli_prepare($link, $sql))
                          {
                              // Bind variables to the prepared statement as parameters
                              mysqli_stmt_bind_param($stmt, "ssssssssssss",$param_n, $param_refid,$param_orderId,$param_empId,$param_weight,$param_length,$param_width,$param_height,$param_price,$param_type,$param_add,$param_pcode2);
                              
                              // Set parameters
                              $param_n=$name;
                              $param_orderId = $orderid;
                              $param_empId=$empid;
                              $param_weight=$weight;
                              $param_length=$length;
                              $param_width=$width;
                              $param_height=$height;
                              $param_price=$price;
                              $param_type=$type;
                              $param_add=$add1." ".$add2;
                              $param_pcode2=$pcode2;
                              $ref_id=uniqid("SID",true);
                              $param_refid=$ref_id;
                              $param_orderId=$orderid;
                              
                              // Attempt to execute the prepared statement
                              if(mysqli_stmt_execute($stmt))
                              {
                              // Close statement
                              mysqli_stmt_close($stmt); 
                              } 
                              else
                              {
                                  echo "Oops! Something went wrong with inserting shipments. Please try again later.";
                              }
                           }
                        }
                      } 
                      else
                      {
                        echo "Oops! Something went wrong with selecting shipment_Address. Please try again later.";
                      }
                    }        
                  } 
                  else
                  {
                      echo "Oops! Something went wrong with inserting orders. Please try again later.";
                  }
              }
            }
            else
            {
              echo "Oops! Something went wrong with inserting payments. Please try again later.";
            }
        }    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/card.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/ship.css" />
    
    <!-- <link rel="stylesheet" href="css/card.css" /> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/masking.js" defer></script>
    <script src="js/ship.js" defer></script>
    <script src="js/card.js"></script>
    <title>Shipment</title>
  </head>
  <body>
    <?php include "navigation.php"; ?>

    <?php 
    if(!isset($ref_id))
    {
      echo('<div class="container">
      <div class="progress">
        <div
          class="progress-bar progress-bar-striped active"
          role="progressbar" style="background-color: rgb(52, 125, 241);"
          aria-valuemin="0"
          aria-valuemax="100"
        ></div>
      </div>

      <form id="regiration_form" novalidate action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">');
      include "Multi Step Shipment/step1.php";
      include "Multi Step Shipment/step2.php";
      include "Multi Step Shipment/step3.php";
      include "Multi Step Shipment/step4.php";
      echo('</form>
      </div>');
    }
    else
    {
       echo('<h1 style="margin:3rem;"> Your shipment id is '.$ref_id.'. Please keep this number for tracking</h1>.');
    }
      
    ?>
  </body>
</html>
