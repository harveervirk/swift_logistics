<nav class="navbar navbar-expand-lg fixed-top">
            <a class="navbar-brand" href="index.php"><img
                src="images/swi.svg"
                class="me-2"
                height="30"
                alt="Swift Logo"
                loading="lazy"
              />Swift Logistics</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <!-- Avatar -->
                <?php
                  // Check if the user is already logged in, if yes then redirect him to welcome page
                  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                      echo('
                      <li class="nav-item">
                        <a class="nav-link" href="ship.php">Shipment</a>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle d-flex align-items-center"  href="#" id="navbarDropdownMenuLink"
                            role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img(31).webp" class="rounded-circle"
                              height="22" alt="Avatar" loading="lazy" />
                          </a>
                          <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                              <a class="dropdown-item" href="profile.php">My profile</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="trackOrder.php">Track Order</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="logout.php">Logout</a>
                            </li>
                          </ul>
                      </li>');
                  }
                  else if(isset($_SESSION["employeeloggedin"]) && $_SESSION["employeeloggedin"] === true){
                    if(isset($_SESSION["mamager"]) && $_SESSION["mamager"]===1)
                    {
                      echo('
                      <li class="nav-item">
                        <a class="nav-link" href="employee.php">Employees</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="delete.php">Remove_Order</a>
                      </li>');
                    }
                    echo('
                    <li class="nav-item">
                      <a class="nav-link" href="report.php">Get_Data</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="reports_agg.php">Reports</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center"  href="#" id="navbarDropdownMenuLink"
                          role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle"
                            height="22" alt="Avatar" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                          <li>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                          </li>
                        </ul>
                    </li>');
                }
                  else{
                    echo('
                    <li class="nav-item">
                      <a class="nav-link" href="trackOrder.php">Track</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="signUp.php">Sign Up</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="login_employee.php">Admin</a>
                    </li>');
                  }
                  ?>
                
                </ul>
              </li>
              </ul>
            </div>
</nav>
