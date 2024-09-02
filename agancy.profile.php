<?php
include "connection.php";
// $client_id=1;

$client_id=$_SESSION['client_id'];


$select="SELECT * FROM client WHERE client_id=$client_id ";

$run_select=mysqli_query($connect,$select);

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("location:landing.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSITE NAME -->
    <title>MULTAQA</title>
    <!-- WEBSITE LOGO -->
    <link rel="icon" href="img/logo.jfif" />
    <!-- BOOTSTRAP LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
     <!-- BOOTSTRAP LINK -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <!-- FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/agancy.profil.css">
</head>

<body>
    <!-- NAV BAR STARTS -->
    <nav id="NAV" class="navbar navbar-expand-lg navbar-dark fixed-top navbar-scrolled">
        <div class="container">
        <img src="img/image.png" alt="">
            <a class="navbar-brand" href="#">MULTAQA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-4">
                        <a class="nav-link active" aria-current="page" href="landing.php">Home</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="viewmyprojects3.php">My projects</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="freelancer-send-request.php">My requests</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="freelancer-send-respond.php">My Messages</a>
                    </li>
            </div>
        </div>
    </nav>
    <!-- NAV BAR ENDS -->

    <!-- PAGE CONTENT STARTS -->
   <div class="content">
      <div class="main-div">

        <h1>AGENCY PROFILE </h1>
        <?php foreach ($run_select as $data) { ?>
        <p>Name: <?php echo  $data['client_name'] ?> </p>
        <p>Email: <?php echo  $data['email'] ?> </p>
        <p>Drive: <?php echo  $data['drive'] ?> </p>
        <p>contact Info: <?php echo  $data['phone_no'] ?></p>
        <p>Business Description: <?php echo  $data['business_descroption']?></p>
        <p>country: <?php echo  $data['country'] ?></p>
        <?php } ?>
        <!-- <button class="cssbuttons-io">
            <span>  <a href="freelancer-send-request.php" class="view">View My Requests</a></span>
             
        </button> -->
            
        <!-- <button class="cssbuttons-io">
            <span>Messages</span>
        </button> -->

        <div class="buttons">

        <button class="cssbuttons-io">
            <a href="teamproject.php"><span>Creat team project</span></a>
        </button>

        
        <button class="cssbuttons-io">
            <a href="ind_project.php"><span>Creat individual project</span></a>
        </button>

        <button class="cssbuttons-io">
            <span><a href="EditClient.php" class="view">Update Profile</a></span>
        </button>
            <div class="form">
        <form action="" method="POST">
        <button class="cssbuttons-io-logout" name="logout">
            <span>Logout</span>
        </button>
        </form>
            </div>
        </div>


        <!-- <button class="cssbuttons-io1">
            <span><a href="EditClient.php" class="view">update profile</a></span>
        </button> -->


        <!-- <button class="cssbuttons-io">
            <span><a href="freelancer-send-request.php" class="view">View my projects</a></span>
        </button> -->



    

      </div>

   </div> 
    <!-- PAGE CONTENT ENDS  -->

    <!-- FOOTER STARTS -->

    <!-- start footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted" style=" width: 100%;  background-color: black !important;
box-shadow: 0 3px 10px rgba(0, 0, 0, 0.047)  !important;
left: 13.79%; bottom: -70%;">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <!-- Left -->
      <!-- <div class="me-5 d-none d-lg-block" style="color: white !important;">
                    <span>Get connected with us on social networks:</span>
                </div> -->
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-facebook-f" style="color: white !important" ;></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter" style="color: white !important;"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google" style="color: white !important;"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram" style="color: white !important;"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin" style="color: white !important;"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-github" style="color: white !important;"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase text-center fw-bold mb-4" style="color: #5C8374 !important;">
              <i class="fas fa-gem me-3" style="color:black !important;"></i>MULTAQA
            </h6>
            <p class="text-center" style="color: white;">
              We’re thrilled to have you here. Whether you're a talented freelancer looking to showcase your skills or a
              client seeking the perfect expert for your next project, you’ve come to the right place.


            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4" style="color: white !important;">
            <!-- Links -->
            <h6 class="text-uppercase text-center fw-bold mb-4"style="color: #5C8374!important;">
              Navigation LINKS
            </h6>
            <div class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
              <p>
                <a href="#!" class="text-reset" style="color: white!important">Home </a>
              </p>
              <p>
                <a href="#!" class="text-reset" style="color: white!important">About</a>
              </p>
              <p>
                <a href="#!" class="text-reset" style="color: white!important">Services</a>
              </p>
              <p>
                <a href="#!" class="text-reset" style="color: white!important">Portfolio</a>
              </p>
            </div>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4" style="color: white !important;">
            <!-- Links -->
            <h6 class="text-center `text-uppercase fw-bold mb-4"style="color: #5C8374!important;">
              Legal Information
            </h6>
            <div class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
              <p>
                <a href="#!" class="text-reset"style="color: white!important">Privacy Policy</a>
              </p>
              <p>
                <a href="#!" class="text-reset"style="color: white!important">Terms of service</a>
              </p>
              <p>
                <a href="#!" class="text-reset"style="color: white!important">Cookie Policy</a>
              </p>

            </div>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 text-center" style="color: white !important;">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 text-center"style="color: #5C8374!important;">Contact</h6>
            <div class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
              <p class="p1"><i class="fas fa-home me-3"style="color: white!important"></i> Egypt</p>
              <p class="p1">
                <i class="fas fa-envelope me-3"style="color: white!important"></i>
                MULTAQA@gmail.com
              </p>
              <p class="p1"><i class="fas fa-phone me-3"style="color: white!important"></i> + 01 234 567 88</p>
              <p class="p1"><i class="fas fa-print me-3"style="color: white!important"></i> + 01 234 567 89</p>
           

            </div>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="color: white !important;">

    </div>
    <!-- Copyright -->
  </footer>

  <!-- end footer -->


</body>

</html>