<?php
// Initialize the session
session_start();
 

 
// Include config file
require_once "config.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/card.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/trackOrder.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css";/>

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
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-horizontal">
        <div class="form-group row d-flex justify-content-between px-3 top" style="margin-top:4rem;  \>
                <div class="col-sm-12">
                <input type="text" class="form-control" name="inputOrderTrackingID" id="inputOrderTrackingID" value="" placeholder="# put your Shipment id here">
            </div>
        </div>
        <div class="form-group row d-flex text-sm-center px-3 pt-0 mx-auto top">
            <div class="col-sm-12">
                <button type="submit" id="shopGetOrderStatusID" class="btn btn-success">Get status</button>
            </div>
        </div>
    </div>
  </form>



<?php
$order_no = "";
$order_Err="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["inputOrderTrackingID"]))){
        $order_Err = "Please enter order number";
    } else{
        $order_no = trim($_POST["inputOrderTrackingID"]);
    }
    
    // Validate credentials
    if(empty($order_Err)){
        // Prepare a select statement
        $sql = "SELECT s.first_name,s.last_name,s.Ref_ID,s.Order_ID,c.Street_Address,ca.City,ca.Province,c.Postal_Code,s.Street_Address,sa.City,sa.Province,s.Postal_Code,c.First_Name,c.Last_Name FROM shipment s 
                INNER JOIN `order` o ON s.Order_ID=o.Order_ID  
                INNER JOIN customer c ON c.Email=o.Email
                INNER JOIN customer_address ca ON c.Postal_Code=ca.Postal_Code
                INNER JOIN shipment_address sa ON s.Postal_Code=sa.Postal_Code
                WHERE Ref_ID  = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_ref);
            
            // Set parameters
            $param_ref = $order_no;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt,$fn,$ln, $ref, $oid,$add,$city,$prov,$pcode,$sadd,$scity,$sprov,$spcode,$fname,$lname);
                    if(mysqli_stmt_fetch($stmt)){
                      echo('
                      <div class="container" style="margin-top:0rem;">
                        <div class="card" style="margin-top:0rem;" >

                          <div class="row d-flex justify-content-between px-3 top">
                          
                            <div class="d-flex flex-column">
                                  <h5 class="font-weight-bold" >
                                    Sender\'s Address
                                  </h5>
                                <span style="text-transform:uppercase;">'.$fname.' '.$lname.'</span>
                                <span style="text-transform:uppercase;">'.$add.'</span>
                                <span style="text-transform:uppercase;">'.$city.' ,'.$prov.'</span>
                                <span style="text-transform:uppercase;">'.$pcode.'</span>
                            </div>

                            <div class="d-flex flex-column text-sm-right">
                                  <h5 class="font-weight-bold" >
                                    Receiver\'s Address
                                  </h5>
                                <span style="text-transform:uppercase;">'.$fn.' '.$ln.'</span>
                                <span style="text-transform:uppercase;">'.$sadd.'</span>
                                <span style="text-transform:uppercase;">'.$scity.' ,'.$sprov.'</span>
                                <span style="text-transform:uppercase;">'.$spcode.'</span>
                            </div>
                          </div>
                          
                          <div class="row d-flex justify-content-between px-3 top">
                          <div class="d-flex">
                            <h5>
                              ORDER# <span class="text-primary font-weight-bold">'.$oid.'</span>
                            </h5>
                          </div>

                          <div class="d-flex flex-column text-sm-right">
                            <p>
                              USPS <span class="font-weight-bold">'.$ref.'</span>
                            </p>
                          </div>
                        </div>');

                        $columns = ["Stage_Id","Status","Date","Location_id"];
                        $sql="Select s.ref_id,Stage_Id,Location_id,Status,Date FROM shipment s INNER JOIN DeliveryStatus k ON s.ref_id = k.ref_id WHERE s.ref_id=? order by ref_id,stage_id ";
                            
                            if($stmt = mysqli_prepare($link, $sql)){
                                // Bind variables to the prepared statement as parameters
                                mysqli_stmt_bind_param($stmt, "s", $param_ref);
                                
                                // Set parameters
                                $param_ref = $order_no;
                                
                                // Attempt to execute the prepared statement
                                if(mysqli_stmt_execute($stmt)){
                                    // Store result
                                    //mysqli_stmt_store_result($stmt);
                                    $result=mysqli_stmt_get_result($stmt);
                                    if(mysqli_num_rows($result)>0){
                                      echo(' <div class="col-12" style="padding: 0rem 8rem;">
                                      <div class="panel panel-default">
                                        <!-- <div class="panel-heading">Employee</div> -->
                                        <div class="panel-body">
                                          <table class="table table-condensed table-striped">
                                  
                                            <tbody>
                                              <tr
                                                data-toggle="collapse"
                                                data-target="#demo1"
                                                class="accordion-toggle"
                                              >
                                                <td>
                                                  <button class="btn btn-default btn-xs">
                                                    <span class="fa fa-chevron-circle-down" aria-hidden="true">   Click to view Order Details</span>
                                                  </button>
                                                  
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                              </tr>
                                  
                                              <tr>
                                                <td colspan="12" class="hiddenRow">
                                                  <div class="accordian-body collapse" id="demo1">
                                                    <table class="table table-striped">
                                                      <thead>
                                                        <tr class="info">
                                                          <th>Stage</th>
                                                          <th>Status</th>
                                                          <th>Time</th>
                                                          <th>Location</th>
                                                          <th></th>
                                                          <th></th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                      <tr
                                                        data-toggle="collapse"
                                                        class="accordion-toggle"
                                                        data-target="#demo10"
                                                      >');
                                      while($data=mysqli_fetch_assoc($result)) {

                                                    foreach($columns as $col){
                                                      echo('
                                                      <td>'.$data[$col].'</td>');   
                                                    }          
                                                    
                                                    echo('<td></td>
                                                    <td></td>
                                                    </tr>');
                                       }
                                       echo('</tbody>
                                       </table>
                                     </div>
                                   </div>
                                 </div>');
                                    }
                                    else{
                                    // email doesn't exist, display a generic error message
                                    $columns_Err = "Employees do not exist";
                                    }
                                } 
                                else{
                                    echo "Oops! Something went wrong. Please try again later.";
                                }
                            }
                        
                    }
                } else{
                    // email doesn't exist, display a generic error message
                    $login_err = "Shipment or Order ID does not exist";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>



  </body>
</html>
