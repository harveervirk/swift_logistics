<?php
// Initialize the session
session_start();
 

 
// Include config file
require_once "config.php";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/employee.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/toggle-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script src="js/multiselect.js"></script>
    <title>Employee</title>
  </head>
  <body>
    
  <?php include "navigation.php"; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="row d-flex justify-content-center mt-100">
          <div class="flex-row d-flex ">
              <h5>Remove orders with id (Deletion with cascading)</h5>
          </div>
      </div>


        <div class="row d-flex justify-content-center mt-1">
          <div class="col-6 d-flex flex-column">
              Delete the order with id:<input type="text" class="form-control" name="Tablej" id="Tablej" style="width:auto;">
          </div>
        </div>
          
        <div class="row d-flex justify-content-center mt-3">
          <div class="col-6 d-flex flex-column">
              <button type="submit" id="submit" class="btn btn-success">Remove Order</button>
          </div>
        </div>
  </form>
<?php


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(isset($_POST["Tablej"])){

    // Prepare a select statement
    $sql = "SELECT * FROM `order` WHERE order_id = ?";
        
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_ref);
        
        // Set parameters
        $param_ref = $_POST["Tablej"];
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){

                $sql="DELETE FROM `Order` Where order_id=? ";

                if($stmt = mysqli_prepare($link, $sql))
                {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_ref);
                    
                    // Set parameters
                    $param_ref = $_POST["Tablej"];
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt))
                    {
                        echo ('<div class="row d-flex justify-content-center mt-100">
                        <div class="flex-row d-flex ">
                            <h5>Order '. $param_ref.' has been deleted</h5>
                        </div>
                    </div>');
                    }
                    else
                    {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                }   
            } 
            else{
                echo ('<div class="row d-flex justify-content-center mt-100">
                <div class="flex-row d-flex ">
                    <h5>Order '. $param_ref.' does not exist</h5>
                </div>
            </div>');
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

