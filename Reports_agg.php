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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css";
 />
 

    <!-- <link rel="stylesheet" href="css/card.css" /> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/masking.js" defer></script>
    <script src="js/toggle-dropdown.js"></script>
    <script src="js/ship.js" defer></script>
    <script src="js/card.js"></script>
    <title>Shipment</title>
  </head>
  <body>
    <?php include "navigation.php"; ?>

  <div class="container" style="margin-top:4rem;">
                        <div class="card" style="margin-top:0rem;" >

                          <div class="row d-flex justify-content-between px-3 top">
                          
                            <div class="d-flex flex-column">
                                  <h5 class="font-weight-bold" >
                                    Reports
                                  </h5>
                            </div>
                          </div>
                          

                        <div class="col-12" style="padding: 0rem 8rem;">
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
                                                    <span class="fa fa-chevron-circle-down" aria-hidden="true">   Avg. Order price by Province (Aggregation)</span>
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
                                                          <th>Province</th>
                                                          <th>Average</th>
                                                          <th></th>
                                                          <th></th>
                                                          <th></th>
                                                          <th></th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                      <tr
                                                        data-toggle="collapse"
                                                        class="accordion-toggle"
                                                        data-target="#demo10"
                                                      >

                                                      <?php
                                                      $columns=["Province","Average"];
                                                      $sql="SELECT ca.Province,AVG(p.Amount) As Average FROM `order` o
                                                      INNER JOIN payment p
                                                      ON o.Payment_ID=p.Payment_ID
                                                      INNER JOIN	customer c
                                                      ON c.Email=o.Email
                                                      INNER JOIN customer_address ca
                                                      ON ca.Postal_Code=c.Postal_Code
                                                      GROUP BY ca.Province";
        
                                                      if($stmt = mysqli_prepare($link, $sql)){
                                                          
                                                          // Attempt to execute the prepared statement
                                                          if(mysqli_stmt_execute($stmt)){
                                                              // Store result
                                                              //mysqli_stmt_store_result($stmt);
                                                              $result=mysqli_stmt_get_result($stmt);
                                                              if(mysqli_num_rows($result)>0){
                                                                while($data=mysqli_fetch_assoc($result)) {
                                                                  foreach($columns as $col){
                                                                    echo('
                                                                    <td>'.$data[$col].'</td>');   
                                                                  }    
                                                                  echo('<td></td>
                                                                  <td></td><td></td><td></td>
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
                                                          // Close statement
                                                          mysqli_stmt_close($stmt);
                                                      } ?>
                                                    </tr>
                                       
                                       </tbody>
                                       </table>
                                     </div>
                                   </div>
                                 </div>





                                 <!-- 2nd Report -->
                                 <div class="col-12" style="padding: 0rem 8rem;">
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
                                                    <span class="fa fa-chevron-circle-down" aria-hidden="true">   Orders with Amount greater than province's avg. order amount (Nested query)</span>
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
                                                          <th>Order_id</th>
                                                          <th>Amount</th>
                                                          <th>Province</th>
                                                          <th></th>
                                                          <th></th>
                                                          <th></th>
                                                          <th></th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                      <tr
                                                        data-toggle="collapse"
                                                        class="accordion-toggle"
                                                        data-target="#demo10"
                                                      >

                                                      <?php
                                                      $columns=["order_id","Amount","Province"];
                                                      $sql="SELECT  order_id,p.Amount,ca.Province from `order` o
                                                      INNER JOIN customer c
                                                      ON c.Email=o.Email
                                                      INNER JOIN customer_address ca
                                                      ON ca.Postal_Code=c.Postal_Code
                                                      INNER JOIN payment p
                                                      ON o.Payment_ID=p.Payment_ID
                                                      INNER JOIN
                                                      (SELECT ca.Province,AVG(p.Amount) As Average FROM `order` o
                                                      INNER JOIN payment p
                                                      ON o.Payment_ID=p.Payment_ID
                                                      INNER JOIN	customer c
                                                      ON c.Email=o.Email
                                                      INNER JOIN customer_address ca
                                                      ON ca.Postal_Code=c.Postal_Code
                                                      GROUP BY ca.Province) nested
                                                      ON ca.Province=nested.province
                                                      where p.Amount > average";
        
                                                      if($stmt = mysqli_prepare($link, $sql)){
                                                          
                                                          // Attempt to execute the prepared statement
                                                          if(mysqli_stmt_execute($stmt)){
                                                              // Store result
                                                              //mysqli_stmt_store_result($stmt);
                                                              $result=mysqli_stmt_get_result($stmt);
                                                              if(mysqli_num_rows($result)>0){
                                                                while($data=mysqli_fetch_assoc($result)) {
                                                                  foreach($columns as $col){
                                                                    echo('
                                                                    <td>'.$data[$col].'</td>');   
                                                                  }    
                                                                  echo('<td></td>
                                                                  <td></td><td></td><td></td>
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
                                                          // Close statement
                                                          mysqli_stmt_close($stmt);
                                                      } ?>
                                                    </tr>
                                       
                                       </tbody>
                                       </table>
                                     </div>
                                   </div>
                                 </div>
<br/>
<br/>
                                 <div class="row d-flex justify-content-center mt-100">
                                    <div class="flex-row d-flex ">
                                        <h5>Division Queries</h5>
                                    </div>
                                </div>
                                 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="row d-flex justify-content-center mt-1">
                                        <div class="col-6 d-flex flex-column">
                                            Get all:<select class="form-control" name="Table" id="Table" style="width:auto;">
                                                        <option value="" selected="selected">Table</option>
                                                      </select>

                                            with:<select class="form-control" name="column" id="column">
                                                    <option value="" selected="selected" disabled required>Column</option>
                                                  </select>
                                        </div>
                                      </div>
                                        


                                      <div class="row d-flex justify-content-center mt-3">
                                        <div class="col-6 d-flex flex-column">
                                            <button type="submit" id="submit" class="btn btn-success">Get Shipments</button>
                                        </div>
                                      </div>
                                </form>


                                <?php
                                if($_SERVER["REQUEST_METHOD"] == "POST"){
                                  if(isset($_POST["Table"]) && isset($_POST["column"])){
                                    $columns_Err = "";
                                    // Validate credentials
                                    if(empty($columns_Err)){
                                      if($_POST["Table"]=="Customers")
                                      {
                                        $columns = ["first_name","last_name","phone"];
                                        $sql="Select first_name,last_name,phone FROM CUSTOMER c";
                                      }
                                        if($_POST["column"]=="No Orders")
                                        $sql=$sql." WHERE NOT EXISTS (Select o.email from `Order` o Where o.email=c.email)";
                                        else
                                        $sql=$sql." WHERE EXISTS (Select o.email,Order_ID from `Order` o WHERE  o.email=c.email AND NOT EXISTS 
(Select type FROM shipment s where type='Regular' AND o.order_id=s.order_id ))";
                                        
                                        if($stmt = mysqli_prepare($link, $sql)){
                                            // Bind variables to the prepared statement as parameters
                                            // mysqli_stmt_bind_param($stmt, "s", $param_ref);
                                            
                                            // Set parameters
                                            // $param_ref = $_POST["value"];
                                            
                                            // Attempt to execute the prepared statement
                                            if(mysqli_stmt_execute($stmt)){
                                                // Store result
                                                //mysqli_stmt_store_result($stmt);
                                                $result=mysqli_stmt_get_result($stmt);
                                                if(mysqli_num_rows($result)>0){
                                                  echo('<div class="container rounded mt-5 bg-white p-md-5" style="font-family: \'Poppins\', sans-serif;">
                                                  <div class="h2 font-weight-bold">Shipments</div>
                                                  <div class="table-responsive">
                                                      <table class="table">
                                                          <thead>
                                                              <tr>');
                                                              foreach($columns as $col){
                                                                echo('<th scope="col">'.$col.'</th>');   
                                                              }                                  
                                                              echo('</tr>
                                                          </thead>');
                                                  while($data=mysqli_fetch_assoc($result)) {
                                                    echo('
                                                            <tbody>
                                                                <tr class="bg-blue">');
                                                                foreach($columns as $col){
                                                                  echo('
                                                                  <td ">'.$data[$col].'</td>');   
                                                                }     
                                                                echo('</tr>
                                                                <tr id="spacing-row">
                                                                    <td></td><td></td><td></td>
                                                                </tr>
                                                            </tbody>');
                                                   }
                                                   echo('</table>
                                                   </div>
                                               </div>');
                                                }
                                                else{
                                                // email doesn't exist, display a generic error message
                                                $columns_Err = "Employees do not exist";
                                                echo("There are no such customers");
                                                }
                                            } 
                                            else{
                                                echo "Oops! Something went wrong. Please try again later.";
                                            }
                                            // Close statement
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    // Close connection
                                    mysqli_close($link);
                                  }
                                  else{
                                    echo "Please fill all the Division Queries fields for results";
                                  }
                                  
  }
                              
                                ?>
    <script>
var TableObject = {
  "Customers": {
    "No Orders": [],
    "only Express Shipping": []
  }
}
window.onload = function() {
  var TableSel = document.getElementById("Table");
  var columnSel = document.getElementById("column");
  for (var x in TableObject) {
    TableSel.options[TableSel.options.length] = new Option(x, x);
  }
  TableSel.onchange = function() {
    //empty operators- and columns- dropdowns
    columnSel.length = 1;
    //display correct values
    for (var y in TableObject[this.value]) {
      columnSel.options[columnSel.options.length] = new Option(y, y);
    }
  }
}
</script>
</body>
</html>


  </body>
</html>
