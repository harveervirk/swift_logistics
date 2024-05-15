<?php

// Initialize the session
session_start();
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$email = $phone = $fname = $lname= $password = "";
$add1 = $add2 = $city = $province= $pcode ="";
$email_err = $password_err = $fname_err = $lname_err = "";
$add_err = $city_err = $province_err = $pcode_err ="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate first name
    if(empty(trim($_POST["fname"]))){
        $fname_err = "Please enter your firstname";
    } 
    else{
        $fname = trim($_POST["fname"]);
    }

    // Validate last name
    if(empty(trim($_POST["lname"]))){
        $lname_err = "Please enter your lastname";
    } 
    else{
        $lname = trim($_POST["lname"]);
    }

    // Validate phone number
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your phone number";
    } 
    elseif(!preg_match('/^\(\d{3}\)\s\d{3}-\d{4}$/',trim($_POST["phone"]))){ //(999) 999-9999
        $phone_err = "Please use a valid phone number";
        $phone = trim($_POST["phone"]);
    }
    else{
        $phone = trim($_POST["phone"]);
        echo("Setting phone value to". $phone);
    }
 
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email";
    } elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', trim($_POST["email"]))){
        $email_err = "Please use a valid email";
        $email = trim($_POST["email"]);
    } else{
        // Prepare a select statement
        $sql = "SELECT email FROM customer WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                    $email = trim($_POST["email"]);
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate address1
    if(empty(trim($_POST["add1"]))){
        $add1_err = "Please enter your Address Line1";     
    }else{
        $add1 = trim($_POST["add1"]);
    }

    //Validate address2
    if(empty(trim($_POST["add2"]))){  
    }else{
        $add2 = trim($_POST["add2"]);
    }

    // Validate City
    if(empty(trim($_POST["city"]))){
        $city_err = "Please enter your city.";     
    }else{
        $city = trim($_POST["city"]);
    }

    //Validate Province
    if(empty(trim($_POST["prov"]))){  
    }
    else{
        $province = trim($_POST["prov"]);
    }

    // Validate Postal Code
    if(empty(trim($_POST["pcode"]))){
        $pcode_err = "Please enter your postal code.";     
    } 
    elseif((!preg_match('/^[A-Za-z]\d[A-Za-z][-]\d[A-Za-z]\d$/ ', trim($_POST["pcode"]))) ){
        $pcode_err = "Please enter a valid postal code.";  
        $pcode = trim($_POST["pcode"]);
    }else{
        $pcode = trim($_POST["pcode"]);
    }
    
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($phone_err) && empty($fname_err) && empty($lname_err) && empty($add1_err) && empty($city_err) && empty($pcode_err) ){
        
        //Check if the postal code already exists
        // Prepare a select statement
        $sql = "SELECT postal_code FROM customer_address WHERE postal_code = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_pcode);
            
            // Set parameters
            $param_pcode = $pcode;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    // The data for postal code is already saved
                } 
                // Else we need to insert the data for postal code
                else
                {
                    // Close statement
                    mysqli_stmt_close($stmt);
                    // Prepare an insert statement
                    $sql = "INSERT INTO customer_address (postal_code, city, province, country) VALUES (?, ?, ?, ?)";
                    if($stmt = mysqli_prepare($link, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ssss", $param_pcode, $param_city, $param_province, $param_country);
                        
                        // Set parameters
                        $param_pcode = $pcode;
                        $param_city=$city;
                        $param_province=$province;
                        $param_country="CA";
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            //Successfully saved the new postal code
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            
        }

        // Prepare an insert statement
        $sql = "INSERT INTO customer (email, first_name, last_name, password, phone, street_address, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_email, $param_fname, $param_lname, $param_password, $param_phone,$param_address,$param_pcode);
            
            // Set parameters
            $param_email = $email;
            $param_fname=$fname;
            $param_lname=$lname;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_phone=$phone;
            echo($phone. "hello");
            $param_address=$add1." ".$add2;
            $param_pcode=$pcode;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width , initial-scale=1,shrink-to-fit=no">

    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="js/masking.js"></script>
    <script src="js/toggle-dropdown.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->
</head>

<body>       
    <?php include "navigation.php"; ?> 
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <section class="h-100 h-custom gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <h3 class="fw-normal mb-5" style="color: #e6802c;">General Infomation</h3>
                            
                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <input type="text" id="fname" name="fname" required
                                                        class="form-control form-control-lg <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>"/>
                                                    <label class="form-label" for="fname">First</label>
                                                    <span class="invalid-feedback"><?php echo $fname_err; ?></span>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <input type="text" id="lname" name="lname" required
                                                        class="form-control form-control-lg <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lname; ?>"/>
                                                    <label class="form-label" for="lname">Last name</label>
                                                    <span class="invalid-feedback"><?php echo $lname_err; ?></span>
                                                </div>

                                            </div>
                                        </div>

                                        
                                        <div class="mb-4 pb-2">
                                            <div class="form-outline form-white">
                                                <input type="text" id="phone" name="phone" required class="form-control form-control-lg <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>"  />
                                                <label class="form-label" for="phone">Phone Number</label>
                                                <span class="invalid-feedback"><?php echo $phone_err; ?></span>
                                            </div>
                                        </div>


                                        <div class="mb-4 pb-2">
                                            <div class="form-outline form-white">
                                                <input type="text" id="email" name="email" required class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" />
                                                <label class="form-label" for="email">Your Email</label>
                                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                            </div>
                                        </div>

                                        
                                        <div class="mb-4 pb-2">
                                            <div class="form-outline form-white">
                                                <input type="password" id="password" name="password" required class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" />
                                                <label class="form-label" for="password">Your Password</label>
                                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 bg-indigo text-white">
                                    <div class="p-5">
                                        <h3 class="fw-normal mb-5">Contact Details</h3>

                                        <div class="mb-4 pb-2">
                                            <div class="form-outline form-white">
                                                <input type="text" id="add1" name="add1" required class="form-control form-control-lg <?php echo (!empty($add1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $add1; ?>" />
                                                <label class="form-label" for="add1">Addres Line 1</label>
                                                <span class="invalid-feedback"><?php echo $add1_err; ?></span>
                                            </div>
                                        </div>

                                        <div class="mb-4 pb-2">
                                            <div class="form-outline form-white">
                                                <input type="text" id="add2" name="add2" class="form-control form-control-lg" value="<?php echo $add2; ?>" />
                                                <label class="form-label" for="add2">Addres Line 2</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-7 mb-4 pb-2">
                                                <div class="form-outline form-white">
                                                    <input type="text" id="city" name="city" required class="form-control form-control-lg <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>" />
                                                    <label class="form-label" for="city">City</label>
                                                    <span class="invalid-feedback"><?php echo $city_err; ?></span>
                                                </div>
                                            </div>

                                            <div class="col-md-5 mb-4 pb-2">
                                                <div class="form-outline form-white">
                                                    <select id="prov" name="prov" required class="form-control form-control-lg">
                                                        <option disabled <?php if(empty($province)) echo "selected"?> value>Select value</option>
                                                        <option <?php if($province == "BC") echo "selected"?> value="BC">BC</option>
                                                        <option <?php if($province == "AB") echo "selected"?> value="AB">AB</option>
                                                        <option <?php if($province == "NB") echo "selected"?> value="NB">NB</option>
                                                        <option <?php if($province == "NL") echo "selected"?> value="NL">NL</option>
                                                        <option <?php if($province == "NT") echo "selected"?> value="NT">NT</option>
                                                        <option <?php if($province == "NS") echo "selected"?> value="NS">NS</option>
                                                        <option <?php if($province == "NU") echo "selected"?> value="NU">NU</option>
                                                        <option <?php if($province == "ON") echo "selected"?> value="ON">ON</option>
                                                        <option <?php if($province == "PE") echo "selected"?> value="PE">PE</option>
                                                        <option <?php if($province == "QC") echo "selected"?> value="QC">QC</option>
                                                        <option <?php if($province == "SK") echo "selected"?> value="SK">SK</option>
                                                        <option <?php if($province == "YT") echo "selected"?> value="YT">YT</option>
                                                    </select>
                                                    <label class="form-label" for="prov">Province</label>
                                                </div>
                                            </div>

                                            <div class="col-md-5 mb-4 pb-2">
                                                <div class="form-outline form-white">
                                                    <input type="text" id="pcode" name="pcode" required
                                                        class="form-control form-control-lg <?php echo (!empty($pcode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pcode; ?>" />
                                                    <label class="form-label" for="pcode">Postal Code</label>
                                                    <span class="invalid-feedback"><?php echo $pcode_err; ?></span>
                                                </div>
                                            </div>

                                        </div>



                                        <button type="submit" class="btn btn-light btn-lg"
                                            data-mdb-ripple-color="dark">Register</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

</body>

</html>