<?php
include "connection.php";

// $client_id=$_SESSION['client_id'];
// $freelancer_id=$_SESSION['freelancer_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- WEBSITE ICON -->
  <link rel="icon" href="img/logo.jfif">
  <!-- WEBSITE TITLE -->
  <title>MULTAQA</title>
  <!-- FONTS LINK -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Reem+Kufi:wght@400..700&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Gupter:wght@400;500;700&family=Indie+Flower&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Rubik+Scribble&family=Sacramento&display=swap"
    rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&family=Reem+Kufi:wght@400..700&display=swap"
    rel="stylesheet">
  <!-- BOOTSTRAP LINK -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <!-- CSS LINK -->
  <link rel="stylesheet" href="Css/landing.css">
</head>

<body>
  <!-- NAV BAR STARTS -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-scrolled">
    <div class="container">
      <img src="Img/image.png" alt="">
      <a class="navbar-brand" href="#">
        MULTAQA
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php if (!empty($_SESSION['client_id'])) { ?>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item mx-4">
            <a class="nav-link active" aria-current="page" href="landing.php">Home</a>
          </li>
          <!-- <li class="nav-item mx-4">
            <a class="nav-link" href="#">Login</a>
          </li> -->
          <li class="nav-item mx-4">
            <a class="nav-link" href="agancy.profile.php"> Profile</a>
          </li>
          <li class="nav-item mx-4">
            <a class="nav-link" href="allfreelancers2.php">Freelancers </a>
          </li>
        </ul>
      </div>
      <?php } elseif(!empty($_SESSION['freelancer_id'])) { ?>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item mx-4">
            <a class="nav-link active" aria-current="page" href="landing.php">Home</a>
          </li>
          <!-- <li class="nav-item mx-4">
            <a class="nav-link" href="#">Login</a>
          </li> -->
          <li class="nav-item mx-4">
            <a class="nav-link" href="freelancer.profile.php"> Profile</a>
          </li>
          <li class="nav-item mx-4">
            <a class="nav-link" href="agencies.php">Agencies</a>
          </li>
        </ul>
      </div>
      <?php }else {  ?>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item mx-4">
            <a class="nav-link active" aria-current="page" href="landing.php">Home</a>
          </li>
          <!-- <li class="nav-item mx-4">
            <a class="nav-link" href="#">Login</a>
          </li> -->
          <li class="nav-item mx-4">
            <a class="nav-link" href="logF.php"> login as a freelancer</a>
          </li>
          <li class="nav-item mx-4">
            <a class="nav-link" href="loginA.php">login as agency </a>
          </li>
        </ul>
      </div> 
      <?php }?>
    </div>
  </nav>
  <!-- NAV BAR ENDS -->

  <!-- CONTENT STARTS -->

  <!-- SECTION 1 -->
  <div class="videoo">
    <video class="backvideo" autoplay loop muted plays-inline>
      <source src="Videos/New Project4 - Made with Clipchamp.mp44.mp4">
    </video>
    <div class="section1">
      <div class="logo">
        <H1>MULTAQA</H1>
      </div>
      <div class="anchor">
        <button> <a href="signupA.php">Hire a Freelancer</a></button>
        <button><a href="signupF.php">Earn Money Freelancing</a></button>
      </div>
    </div>
    <div class="shopnow">
    </div>
    <!-- SECTION 2 -->
    <div class="section2">
      <div class="text-box">
        <!-- <h1>MULTAQA</h1> -->

        <!-- /* From Uiverse.io by satyamchaudharydev */  -->
        <button class="button" data-text="Awesome">
          <span class="actual-text">&nbsp;MULTAQA&nbsp;</span>
          <span aria-hidden="true" class="hover-text">&nbsp;MULTAQA&nbsp;</span>
        </button>

        <h3>IS A PLATFORM THAT CONNECTS FREELANCERS WITH AGENCIES, ALLOWING FREELANCERS TO FIND WORK AND AGENCIES TO
          HIRE TOP TALENT , FOSTERING COLLABORATION AND GROWTH.</h3>
      </div>
    </div>
    <div class="shopnow">
    </div>
    <!-- END SECTION 2 -->
    <!-- SECTION 3 -->
    <div class="section3">
      <div class="parent">
        <!-- first-card -->
        <div class="card">

          <img src="Img/middle east.jpeg" alt="">

          <h4> AGENCIES</h4>

          <p> Gulf and Middle Eastern companies are leaders in innovation, always seeking top talent to drive growth.
            Here, you’ll find great opportunities for collaboration, supported by skilled Egyptian freelancers who
            deliver high-quality results.</p>

        </div>
        <!-- END first-card -->
        <!-- SECOND CARD -->
        <div class="card">

          <img src="./Img/egypt.jpeg" alt="">

          <h4>FREELANCERS</h4>

          <p>Egyptian freelancers are a dynamic and skilled group, excelling in fields like graphic design, software
            development, digital marketing, and content creation. Known for their adaptability and innovative solutions,
            they cater to regional.</p>

        </div>
        <!-- END SECOND CARD -->
        <!-- THIRD-card -->
        <!-- <div class="card">

          <img src="Img/download (1).png" alt="">

          <h4>Fiverr</h4>

          <p>Fiverr is a platform where freelancers offer "gigs" starting at $5 (hence the name). It caters to a variety
            of services such as graphic design, digital marketing, writing, and video editing. Freelancers set their
            prices and offer packages</p>

        </div> -->
        <!-- END THIRD CARD -->
      </div>
    </div>
    <div class="shopnow">
    </div>
    <!-- END SECTION 3 -->

    <!-- START SECTION 4 -->
    <div class="section4">
      <!-- /* From Uiverse.io by Smit-Prajapati */  -->
      <div class="mycard">

        <div class="about-container">
          <div class="twocards">
            <div class="about-card">
              <h4>Our Vision</h4>
              <p> To be Egypt’s central hub for igniting innovation throughout the Middle East. <span
                  class="maya">.           .</span></p>

            </div>
            <div class="about-card">
              <h4> Business Idea</h4>
              <p> Project focuses on marketing and development as we need to put the Egyptian freelancer instead of
                foreign freelancers. </p>
            </div>
          </div>
          <!-- Empower Egyptian freelancers and Middle Eastern businesses to connect through an innovative platform built on trust and high quality. -->
          <div class="twocards">
            <div class="about-card">
              <h4>Our Mission</h4>
              <p> Empower Egyptian freelancers and Middle Eastern businesses to connect through an innovative platform
                built on trust and high quality.</p>
            </div>
            <div class="about-card">
              <h4> Key Factors </h4>
              <p> The key factors driving freelance growth are ongoing digital transformation, entrepreneurial culture,
                economic diversification, and acceptance of remote work.</p>

            </div>
          </div>




        </div>

        <div class="logo-div">
          <img src="./Img/1.png" alt="logo">
        </div>
        <div class="border"></div>

        <span class="bottom-text">MULTAQA</span>
      </div>
    </div>

    <!-- END SECTION 4 -->
  </div>
  <!-- CONTENT ENDS -->
  <!-- start footer -->
  <footer class="text-center text-lg-start bg-body-tertiary text-muted" style=" width: 100%;  background-color: transparent !important;
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
            <h6 class="text-uppercase text-center fw-bold mb-4">
              Navigation Links
            </h6>
            <div class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
              <p>
                <a href="#!" class="text-reset">Home</a>
              </p>
              <p>
                <a href="#!" class="text-reset">About</a>
              </p>
              <p>
                <a href="#!" class="text-reset">Services</a>
              </p>
              <p>
                <a href="#!" class="text-reset">Portfolio</a>
              </p>
            </div>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4" style="color: white !important;">
            <!-- Links -->
            <h6 class="text-center `text-uppercase fw-bold mb-4">
              Legal Information
            </h6>
            <div class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
              <p>
                <a href="#!" class="text-reset">Privacy Policy</a>
              </p>
              <p>
                <a href="#!" class="text-reset">Terms of service</a>
              </p>
              <p>
                <a href="#!" class="text-reset">Cookie Policy</a>
              </p>

            </div>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 text-center" style="color: white !important;">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 text-center">Contact</h6>
            <div class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
              <p><i class="fas fa-home me-3"></i> Egypt</p>
              <p>
                <i class="fas fa-envelope me-3"></i>
                MULTAQA@gmail.com
              </p>
              <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
              <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>

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

  </div>
</body>

</html>