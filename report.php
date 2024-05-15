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
                <h5>Get Data(Selection)</h5>
            </div>
        </div>


          <div class="row d-flex justify-content-center mt-1">
            <div class="col-6 d-flex flex-column">
                Get From:<select class="form-control" name="Table" id="Table" style="width:auto;">
                            <option value="" selected="selected">Table</option>
                          </select>

                Where:<select class="form-control" name="column" id="column">
                        <option value="" selected="selected" disabled required>Column</option>
                      </select>
                is:<select class="form-control" name="operator" id="operator">
                    <option value="" selected="selected">Operator</option>
                  </select>
                <input class="form-control mt-2" type="text" name="value"></input>
            </div>
          </div>
            


          <div class="row d-flex justify-content-center mt-3">
            <div class="col-6 d-flex flex-column">
                <button type="submit" id="submit" class="btn btn-success">Get Shipments</button>
            </div>
          </div>
    </form>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="row d-flex justify-content-center mt-100">
          <div class="flex-row d-flex ">
              <h5>Get Data(Join)</h5>
          </div>
      </div>


        <div class="row d-flex justify-content-center mt-1">
          <div class="col-6 d-flex flex-column">
              Get:<select class="form-control" name="Tablej" id="Tablej" style="width:auto;">
                          <option value="" selected="selected">Table</option>
                        </select>

              with their:<select class="form-control" name="columnj" id="columnj">
                      <option value="" selected="selected" disabled required>Column</option>
                    </select>
          </div>
        </div>
          


        <div class="row d-flex justify-content-center mt-3">
          <div class="col-6 d-flex flex-column">
              <button type="submit" id="submit" class="btn btn-success">Get Data</button>
          </div>
        </div>
  </form>
<?php


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


 
    if(isset($_POST["Table"]) && isset($_POST["column"]) && $_POST["operator"] && $_POST["value"] ){
      $columns = ["Ref_ID","Height","Width","Weight","Length","Order_ID"];
      $columns_Err = "";
    // Validate credentials
    if(empty($columns_Err)){
        $sql="Select * FROM ".$_POST["Table"]." Where ".$_POST["column"].$_POST["operator"]."?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_ref);
            
            // Set parameters
            $param_ref = $_POST["value"];
            
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
                                  <td class="pt-3">'.$data[$col].'</td>');   
                                }          echo('
                                    <td class="pt-3"><span class="fa fa-check pl-3"></span></td>
                                    <td class="pt-3"><span class="fa fa-ellipsis-v btn"></span></td>');
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
  else{
    echo "Please fill all the Get Data(Selection) fields for results<br/>";
  }
  if(isset($_POST["Tablej"]) && isset($_POST["columnj"])){
    $columns_Err = "";
    // Validate credentials
    if(empty($columns_Err)){
      if($_POST["Tablej"]=="Shipment")
      {
        $columns = ["Ref_ID","Stage_Id","Status"];
        $sql="Select Stage_Id,s.Ref_ID,Status ";
      }
      else if($_POST["Tablej"]=="Employee")
      {
        $columns = ["first_name","last_name","Address"];
        $sql="Select first_name,last_name,Address ";
      }
      else if($_POST["Tablej"]=="DeliveryPersonnel")
      {
        $columns = ["first_name","last_name","phone"];
        $sql="Select first_name,last_name,phone ";
      }

        $sql=$sql."FROM ".$_POST["Tablej"]." s";
        if($_POST["columnj"]=="different delivery stages")
        $sql=$sql." INNER JOIN DeliveryStatus k ON s.ref_id = k.ref_id order by ref_id,stage_id";
        else if($_POST["columnj"]=="working address location")
        $sql=$sql." INNER JOIN Location k ON s.location_id = k.location_id";
        else if($_POST["columnj"]=="Phone numbers")
        $sql=$sql." INNER JOIN employee k ON s.emp_id = k.emp_id";

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
                  <div class="h2 font-weight-bold"></div>
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
                                }          echo('
                                    <td class="pt-3"><span class="fa fa-check pl-3"></span></td>
                                    <td class="pt-3"><span class="fa fa-ellipsis-v btn"></span></td>');
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
  else{
    echo "Please fill all the Get Data(Join) fields for results";
  }


}
?>


<script>
var TableObject = {
  "Shipment": {
    "Type": ["="],
    "Height": ["=", ">", "<"],
    "Width": ["=", ">", "<"]    
  }
}
var JoinObject = {
  "Shipment": {
    "different delivery stages": []  
  },
  "Employee": {
    "working address location": [] 
  },
  "DeliveryPersonnel": {
    "Phone numbers": [] 
  },
}
window.onload = function() {
  var TableSel = document.getElementById("Table");
  var columnSel = document.getElementById("column");
  var operatorSel = document.getElementById("operator");
  for (var x in TableObject) {
    TableSel.options[TableSel.options.length] = new Option(x, x);
  }
  TableSel.onchange = function() {
    //empty operators- and columns- dropdowns
    operatorSel.length = 1;
    columnSel.length = 1;
    //display correct values
    for (var y in TableObject[this.value]) {
      columnSel.options[columnSel.options.length] = new Option(y, y);
    }
  }
  columnSel.onchange = function() {
    //empty operators dropdown
    operatorSel.length = 1;
    //display correct values
    var z = TableObject[TableSel.value][this.value];
    for (var i = 0; i < z.length; i++) {
      operatorSel.options[operatorSel.options.length] = new Option(z[i], z[i]);
    }
  }
}

var TableSelj = document.getElementById("Tablej");
  var columnSelj = document.getElementById("columnj");
  var operatorSelj = document.getElementById("operator");
  for (var x in JoinObject) {
    TableSelj.options[TableSelj.options.length] = new Option(x, x);
  }
  TableSelj.onchange = function() {
    //empty operators- and columns- dropdowns
    operatorSelj.length = 1;
    columnSelj.length = 1;
    //display correct values
    for (var y in JoinObject[this.value]) {
      columnSelj.options[columnSelj.options.length] = new Option(y, y);
    }
  }

</script>
</body>
</html>

