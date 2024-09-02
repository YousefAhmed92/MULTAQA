<?php 
include("connection.php");
// $project_id = $_SESSION['project_id']; 
// $id = $_POST['project_id'];
 $project_id=7;
if(isset($_GET['project_id'])){
    $project_id=$_GET['project_id'];
}

$run_query = "SELECT * FROM `project`JOIN `client` 
               ON `project`.`client_id` = `client`.`client_id` JOIN `category` 
               ON `project`.`cat_id` = `category`.`cat_id` WHERE `project`.`project_id` = '$project_id'";
$projects = mysqli_query($connect, $run_query);
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
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/team.project.details.css">
    <!-- FONTS LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/team.project.details.css">
</head>

<body>
    <!-- NAV BAR STARTS -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-scrolled">
        <div class="container">
            <a class="navbar-brand" href="#">MULTAQA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-4">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="#">logout</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAV BAR ENDS -->

    <!-- PAGE CONTENT STARTS -->
    <?php foreach ($projects as $row) {?> 
    <div class="main-div">

        <h1>PROJECT DETAILS</h1>

        <!-- <H2>Your team members:</H2>
        <p>
            - Tassneem Ahmed
            <br>
            - Zeina Mohamed
            <br>
            - Sama Refaat
            <br>
            - Menna Fawzy
        </p> -->

        <H2>Agency Name:</H2>
          <p><?php echo $row['client_name']; ?></p>


        <H2>Project Name:</H2>
        <p><?php echo $row['project_name']; ?></p>

        <h2>Description:</h2>
        <p><?php echo $row['descriptionP']; ?></p>

        <h2>Hours of project:</h2>
        <p><?php echo $row['hours']; ?></p>

        <!-- <form class="my-comment">

            <textarea name="comment" id="comment" placeholder="Enter Your Comment..."></textarea>

        </form>


        <button class="send">
            <span>Send</span>
        </button> -->

    </div>
    <?php } ?>
    <!-- PAGE CONTENT ENDS -->


</body>

</html>