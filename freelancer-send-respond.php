<?php
include('connection.php');

$query = " SELECT `message` FROM agency_messages ";





// Execute the query
$result = mysqli_query($connect, $query);

// Close the database connection
mysqli_close($connect);?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSIT NAME -->
    <title>MULTAQA</title>
    <!-- WEBSITE LOGO -->
    <link rel="icon" href="img/logo.jfif">
    <!-- BOOTSTRAP LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- FONTS LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Slab:wght@100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <!-- BOOTSTRAP LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/freelance interface.css">
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
                        <a class="nav-link active" aria-current="page" href="landing.php">Landing</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="agancy.profile.php">Profile</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="allfreelancers2.php">Freelancers</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAV BAR ENDS -->

    <!-- PAGE CONTENT STARTS -->
    <div class="main">
        <h1>My Requests</h1>

        <!-- TABLE STARTS -->
        <div class="table">
            <table>
            <tr>
                    <td><h3>Message</h3></td>
                </tr>

                <!--####################################################-->
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><p><?php echo htmlspecialchars($row['message']); ?></p></td>
                </tr>
                <?php } ?>
            </table>
            <!-- TABLE ENDS -->
        </div>
    </div>
    <!-- PAGE CONTENT ENDS -->

    <!-- FOOTER STARTS -->
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
                            We’re thrilled to have you here. Whether you're a talented freelancer looking to showcase
                            your skills or a
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
                        <div
                            class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
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
                        <div
                            class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
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
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 text-center"
                        style="color: white !important;">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4 text-center">Contact</h6>
                        <div
                            class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
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
    <!-- FOOTER ENDS -->
</body>

</html>







<!-- 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MULTAQA</title>
    <link rel="icon" href="img/logo.jfif">
    <link rel="stylesheet" href="css/messagesA.css">
</head>
<body>
    <div class="main">
        <h1>Your Messages</h1>

        <div class="table">
            <table>
                <tr>
                    <td><h3>Message</h3></td>
                </tr>

                <?php while ($row = mysqli_fetch_assoc($messages_result)) { ?>
                <tr>
                    <td><p><?php echo htmlspecialchars($row['message']); ?></p></td>
                </tr>
                <?php } ?>

            </table>
        </div>
    </div>
</body>
</html> -->
