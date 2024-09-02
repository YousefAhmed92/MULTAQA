<?php
include "connection.php";
// $client_id=1;

if(isset($_GET['id'])){
    $client_id=$_GET['id'];
}

$freelancer_id=$_SESSION['freelancer_id'];


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
    <!-- FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/viewagencyprofile.css">
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
                        <a class="nav-link active" aria-current="page" href="#">Landing</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
                <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>
    <!-- NAV BAR ENDS -->

    <!-- PAGE CONTENT STARTS -->
    <div class="main-div">

        <h1>AGENCY PROFILE </h1>
        <?php foreach ($run_select as $data) { ?>
        <p>Name: <?php echo  $data['client_name'] ?> </p>
        <p>Drive Link: <?php echo  $data['drive'] ?> </p>
        <p>Business Description: <?php echo  $data['business_descroption']?></p>
        <p>country: <?php echo  $data['country'] ?></p>
        <?php } ?>
        <!-- <button class="cssbuttons-io">
            <span>  <a href="freelancer-send-request.php" class="view">View My Requests</a></span>
             
        </button> -->
            
        <!-- <button class="cssbuttons-io">
            <span>Messages</span>
        </button> -->

        <!-- <div class="buttons">

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
        </div> -->


        <!-- <button class="cssbuttons-io1">
            <span><a href="EditClient.php" class="view">update profile</a></span>
        </button> -->


        <!-- <button class="cssbuttons-io">
            <span><a href="freelancer-send-request.php" class="view">View my projects</a></span>
        </button> -->



    

    </div>

    
    <!-- PAGE CONTENT ENDS  -->

    <!-- FOOTER STARTS -->
    <!-- FOOTER ENDS -->
</body>

</html>