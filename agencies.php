<?php
include('connection.php');
// $client_id=$_SESSION['client_id'];
// $client_id = 1 ;
// $select= "SELECT *FROM `client` WHERE  `client_id` = $client_id ";
// $run_select= mysqli_query($connect,$select);
// $fetch=mysqli_fetch_assoc($run_select);
$join="SELECT * FROM `client`";
// --  JOIN 
// -- `project` ON `project`.`client_id` = `client`.`client_id` 
// -- WHERE `client`.`client_id`=$client_id 

$run_join = mysqli_query($connect, $join);
// $project_name=$fetch['project_name'];
// $name=$fetch['client_name'];


if(isset($_POST['search'])){
    $text=$_POST['text'];
    $select_search="SELECT * FROM `client` WHERE (`client_name` LIKE '%$text%') 
    or (`country` LIKE '%$text%') ";
    $run_select_search= mysqli_query($connect,$select_search);
} else { $run_join = mysqli_query($connect, $join);
}

    



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSITE NAME -->
    <title>MULTAQA - Agencies </title>
    <!-- WEBSITE LOGO -->
    <link rel="icon" href="img/logo.jfif" />
    <!-- FONT AWESOME LINK -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- FONTS LINK -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@800&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
     <!-- FONT AWESOME LINK -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
     <!-- BOOTSTRAP LINK -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- FONTS LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/agencies pagee.css">
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
                <form class="d-flex" role="search" method="post">
                    <input class="form-control me-2" type="search" name="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- NAV BAR ENDS -->


    <!-- PAGE TITLE STARTS -->
    <div class="title">
        <h1>AGENCIES</h1>
    </div>
    <!-- PAGE TITLE ENDS -->

    <!-- FILTER STARTS -->
    <!-- <div class="filter">
        <button class="filterbtn">
            Select Category
        </button>
        <ul>
            <li><a href=""></a>category</li>
            <li><a href=""></a>category</li>
            <li><a href=""></a>category</li>
            <li><a href=""></a>category</li>
            <li><a href=""></a>category</li>
        </ul>
        <button class="Submit" href=""> Submit Category </button>
    </div> -->
    <!-- FILTER ENDS -->

<?php if(isset($_POST['search'])){ ?>
    <div class="main">

        <!-- CARDS CONTAINER STARTS -->
        <div class="main-container">
            <!-- <div class ="part_one" > 

           </div> -->

            <!-- CARDS START -->
            <?php   foreach($run_select_search as $row) { ?>
                <div class="card">
                    
                <!-- <div class="content"> -->
                    <p class="info"> Company Name: <?php echo $row['client_name'];?> </p>
                    <p class="info"> Country: <?php echo $row['country'];?> </p>
                    <a class="anchor" href="companyprojects3.php?id=<?php echo $row ['client_id']?>">Company Projects</a>
                    <a class="anchor" href="viewagencyprofile.php?id=<?php echo $data ['client_id']?>">View Profile</a>
                <!-- </div> -->
            </div>
            <?php } ?>

        </div>
        </div>

        <?php }else{ ?>


    <div class="main">

        <!-- CARDS CONTAINER STARTS -->
        <div class="main-container">
            <!-- <div class ="part_one" > 

           </div> -->

            <!-- CARDS START -->
            <?php   foreach($run_join as $data) { ?>
            <div class="card">
           
                <!-- <div class="content"> -->
                    <p class="info"> Company Name: <?php echo $data['client_name'];?> </p>
                    <p class="info"> Country: <?php echo $data['country'];?> </p>
             <a class="anchor" href="companyprojects3.php?id=<?php echo $data ['client_id']?>">Company Projects</a>
             <a class="anchor" href="viewagencyprofile.php?id=<?php echo $data ['client_id']?>">View Profile</a>
                    <!-- <a class="anchor" href=""> View Profile </a> -->
                <!-- </div> -->
            </div>
            <?php } ?>
            <?php } ?>
            

            <!-- <div class="card">
                <div class="content">
                    <p class="info"> Company Name: Company company </p>
                    <a class="anchor" href=""> Company Projects </a>
                    <a class="anchor" href=""> View Profile </a>
                </div>
            </div> -->

            <!-- CARDS ENDS -->

        </div>
        <!-- CARDS CONTAINER ENDS -->

        <!-- FOOTER STARTS -->
        <!-- FOOTER ENDS -->
</div>
</body>

</html>