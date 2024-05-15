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
    <link rel="stylesheet" href="css/employee.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css";/>
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
            <div class="col-6 d-flex flex-column">
                <h5>Select values from employees</h5>
                <select id="choices-multiple-remove-button" name="columns[]" placeholder="Select upto 5 columns" multiple>
                    <option value="first_name">First Name</option>
                    <option value="last_name">Last Name</option>
                    <option value="job_title">Job Title</option>
                    <option value="Email">Email</option>
                    <option value="Phone">Phone</option>
                    <option value="is_active">Is Active</option>
                </select>
                <button type="submit" id="employees" class="btn btn-success">Get Employees</button>
            </div>
        </div>
    </form>

<?php
$columns = "";
$columns_Err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty($_POST["columns"])){
        $columns_Err = "Please select your values";
    } else{
        $columns = $_POST["columns"];
    }
    
    // Validate credentials
    if(empty($columns_Err)){
        $sql="Select emp_id";
        
        foreach($columns as $col)
        {
            $sql=$sql.' ,'.$col;
        }
        $sql=$sql." from employee";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                //mysqli_stmt_store_result($stmt);
                $result=mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result)>0){
                  echo('<div class="container rounded mt-5 bg-white p-md-5" style="font-family: \'Poppins\', sans-serif;">
                  <div class="h2 font-weight-bold">Employees</div>
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
                                  <td class="pt-3">'.$data[$col].'</td>');   
                                }          
                                    
                                echo('</tr>
                                <tr id="spacing-row">
                                    <td></td>
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
?>

  