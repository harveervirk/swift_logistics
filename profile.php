<?php
// Initialize the session
session_start();
// Include config file
require_once "config.php";
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $email=$_SESSION["email"];
    echo('<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width , initial-scale=1,shrink-to-fit=no">  
            <link rel="stylesheet" href="css/bootstrap.css">
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="css/profile.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="js/toggle-dropdown.js"></script>
            <script src="js/bootstrap.js"></script>
            <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->
        </head>
        <body>');
        include "navigation.php";         
        $sql = "SELECT c.first_name,c.last_name,c.email,c.street_Address,ca.City,ca.Province,c.Postal_Code,phone FROM customer c
        INNER JOIN customer_address ca ON c.Postal_Code=ca.Postal_Code
        WHERE c.email  = ?";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_ref);
    
    // Set parameters
    $param_ref = $email;
    
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Store result
        mysqli_stmt_store_result($stmt);
        
        // Check if email exists, if yes then verify password
        if(mysqli_stmt_num_rows($stmt) == 1){                    
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $fname, $lname,$email,$add,$city,$prov,$pcode,$phone);
            
            if(mysqli_stmt_fetch($stmt)){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $sql="Update customer SET";
                     // Check if email is empty
                     $count=0;
                    if($fname!=trim($_POST["fname"]))
                    {
                        $sql=$sql." first_name='".trim($_POST["fname"])."'";
                        $fname=trim($_POST["fname"]);
                        $count++;
                    }
                    if($lname!=trim($_POST["lname"]))
                    {
                        if($count!=0)
                        $sql=$sql.",";
                        $sql=$sql." last_name='".trim($_POST["lname"])."'";
                        $lname=trim($_POST["lname"]);
                        $count++;
                    }
                    
                    if($phone!=trim($_POST["phone"]))
                    {
                        if($count!=0)
                        $sql=$sql.",";
                        $sql=$sql." phone='".trim($_POST["phone"])."'";
                        $phone=trim($_POST["phone"]);
                        $count++;
                    }
                    if($add!=trim($_POST["add"]))
                    {
                        if($count!=0)
                        $sql=$sql.",";
        
                        $sql=$sql." street_Address='".trim($_POST["add"])."'";
                        $add=trim($_POST["add"]);
                        $count++;
                    }
                    
                    if($pcode!=trim($_POST["pcode"]))
                    {
                        if($count!=0)
                        $sql=$sql.",";
                        $sql=$sql." postal_code='".trim($_POST["pcode"])."'";
                        $pcode=trim($_POST["pcode"]);
                        $count++;
                    }
                    $sql=$sql." Where email=?";
                    if($count!=0)
                    {
                        if($stmt = mysqli_prepare($link, $sql)){
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "s", $param_ref);
                            // Set parameters
                            $param_ref = $email;
                            
                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){                    
                                    
                            } else{
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                
                            // Close statement
                            mysqli_stmt_close($stmt);
                        }
                    }
                }


                echo('
                <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
                <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">'.$fname.' '.$lname.'</span><span class="text-black-50">'.$email.'</span><span> </span></div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">Name</label><input type="text" name="fname" class="form-control" placeholder="first name" value="'.$fname.'"></div>
                                <div class="col-md-6"><label class="labels">Surname</label><input type="text" name="lname" class="form-control" value="'.$lname.'" placeholder="surname"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" name="phone" class="form-control" placeholder="enter phone number" value="'.$phone.'"></div>
                                <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" name="add" class="form-control" placeholder="enter address line 1" value="'.$add.'"></div>
                                <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text" name="city" class="form-control" placeholder="enter address line 2" value="'.$city.'"></div>
                            </div>
                            <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Province</label><input type="text" class="form-control" name="prov" placeholder="enter address line 2" value="'.$prov.'"></div>
                            <div class="col-md-6"><label class="labels">Postal Code</label><input type="text" class="form-control" name="pcode" placeholder="enter address line 2" value="'.$pcode.'"></div>
                            </div>
                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </form>
            
            
                </body>
            </html>');
              
            }
        } else{
            // email doesn't exist, display a generic error message
            $login_err = "Profile does not exist";
        }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}
}
?>
