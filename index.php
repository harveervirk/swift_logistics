<?php
// Initialize the session
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width , initial-scale=1,shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/toggle-dropdown.js"></script>
        <script src="https://unpkg.com/scrollreveal"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.css">
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->
    </head>
    <body>
        <?php include "navigation.php"; ?>


          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="images/del6.png" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                  <p class="animated flipInX">Welcome to Swift Delivery</p>
                  <h1 class="animated rollIn delay-1s">Fast, Secure</h1><h1 class="animated rollIn delay-1s">& Reliable</h1>
                  <a class="btn btn-lg btn-danger mt-5 animated infinite bounce delay-1s" href="trackOrder.php">Track your Delivery</a>
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/del5.png" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                  <p class="animated flipInX">Welcome to Swift Delivery</p>
                  <h1 class="animated rollIn delay-1s">Fast, Secure</h1><h1 class="animated rollIn delay-1s">& Reliable</h1>
                  <a class="btn btn-lg btn-danger mt-5 animated infinite bounce delay-1s" href="trackOrder.php">Track your Delivery</a>
                </div>              
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/del3.PNG" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                  <p class="animated flipInX">Welcome to Swift Delivery</p>
                  <h1 class="animated rollIn delay-1s">Fast, Secure</h1><h1 class="animated rollIn delay-1s">& Reliable</h1>
                  <a class="btn btn-lg btn-danger mt-5 animated infinite bounce delay-1s" href="trackOrder.php">Track your Delivery</a>
                </div>              
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>


          <div class="container">
            <div class="row">
              <div class="col-sm">
                <h2>Our Company</h2>
                <h1>About Swift Logistics</h1>
                Committed to our customers in our values and leadership
                We’re passionate about our customers, our employees and the communities we serve. Learn about the values, vision and leadership behaviours that make us the no. 1 parcel delivery company in Canada.
                Our values
                We are driven by innovation in the marketplace, excellence in customer service, and integrity and respect in our actions.
              </div>
              <div class="col-sm">
                <img src="images/About.png" class="img-fluid" alt="About">
              </div>
            </div>
          </div>

          <section id="features">
            <div class="container px-4 gap100">
              <div class="row">
                <div class="col-md-4 left">
                  <div class="p-5 bg-white" style="border:2px solid white;opacity:0.7;border-radius: 20px"><img src="images/door.png" class="img-fluid" alt="About">
                    <h3>Door to Door</h3>
                    <p>Swift Logistics is a modern and fast growing company which offers exellent shipping services. </p>
                  </div>
                </div>
                <div class="col-md-4 animated top">
                  <div class="p-5 bg-white"  style="border:2px solid white;opacity:0.7;border-radius: 20px"><img src="images/door.png" class="img-fluid" alt="About">
                    <h3>Safety and Security</h3>
                    <p>Swift Logistics guarantees full safety and security of the orders placed for shipping.</p>
                  </div>
                </div>
                <div class="col-md-4 animated right">
                  <div class="p-5 bg-white" style="border:2px solid white;opacity:0.7;border-radius: 20px"><img src="images/door.png" class="img-fluid" alt="About">
                    <h3>Fast and Reliable</h3>
                    <p>Our promise to customers is to provide fast and reliable delivery services at affordable rates.</p>
                  </div>
                </div>
              </div>
            </div>
          </section>


          <!-- Footer -->
        <footer class="bg-dark text-center text-white">
          <!-- Grid container -->
          <div class="container p-4">
            <!-- Section: Social media -->
            <section class="mb-4">
              <!-- Facebook -->
              <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-facebook-f"></i
              ></a>

              <!-- Twitter -->
              <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-twitter"></i
              ></a>

              <!-- Google -->
              <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-google"></i
              ></a>

              <!-- Instagram -->
              <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-instagram"></i
              ></a>

              <!-- Linkedin -->
              <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-linkedin-in"></i
              ></a>

              <!-- Github -->
              <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-github"></i
              ></a>
            </section>
            <!-- Section: Social media -->

            <!-- Section: Form -->
            <section class="">
              <form action="">
                <!--Grid row-->
                <div class="row d-flex justify-content-center">
                  <!--Grid column-->
                  <div class="col-auto">
                    <p class="pt-2">
                      <strong>Sign up for our newsletter</strong>
                    </p>
                  </div>
                  <!--Grid column-->

                  <!--Grid column-->
                  <div class="col-md-5 col-12">
                    <!-- Email input -->
                    <div class="form-outline form-white mb-4">
                      <input type="email" id="form5Example21" class="form-control" />
                      <label class="form-label" for="form5Example21">Email address</label>
                    </div>
                  </div>
                  <!--Grid column-->

                  <!--Grid column-->
                  <div class="col-auto">
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-outline-light mb-4">
                      Subscribe
                    </button>
                  </div>
                  <!--Grid column-->
                </div>
                <!--Grid row-->
              </form>
            </section>
            <!-- Section: Form -->

            <!-- Section: Text -->
            <section class="mb-4">
              <p>
              Choose the right shipping option for you and get started today. Shipping with Swift Logistics is quick and easy.
              </p>
            </section>
            <!-- Section: Text -->

            <!-- Section: Links -->
            <section class="">
              <!--Grid row-->
              <div class="row">
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                  <h5 class="text-uppercase">Customer Service</h5>

                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#!" class="text-white">Help and Support Centre</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">Get Started with Swift</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">Change Delivery</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">Claims Support</a>
                    </li>
                  </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                  <h5 class="text-uppercase">This Site</h5>

                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#!" class="text-white">Tracking</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">Shipping</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">Services</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">My Profile</a>
                    </li>
                  </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                  <h5 class="text-uppercase">Company Info</h5>

                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#!" class="text-white">About Swift Logistics</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">Media Relations</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">Investor Relations</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">Careers</a>
                    </li>
                  </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                  <h5 class="text-uppercase">Connect With Us</h5>

                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#!" class="text-white">Instagram</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">Twitter</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">Facebook</a>
                    </li>
                    <li>
                      <a href="#!" class="text-white">Gmail</a>
                    </li>
                  </ul>
                </div>
                <!--Grid column-->
              </div>
              <!--Grid row-->
            </section>
            <!-- Section: Links -->
          </div>
          <!-- Grid container -->

          <!-- Copyright -->
          <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-white" href="https://SwiftLogistics.com/">SwiftLogistics.com</a>
          </div>
          <!-- Copyright -->
        </footer>
<!-- Footer -->
          <script>
            window.sr=ScrollReveal();
            sr.reveal('.left',{
              duration:2000,
              origin:'left',
              distance:'200px'
            });
            sr.reveal('.top',{
              duration:2000,
              origin:'top',
              distance:'200px'
            });
            sr.reveal('.right',{
              duration:2000,
              origin:'right',
              distance:'200px'
            });
          </script>

    </body>
</html>
