<?php
include('connection.php');

$query = "SELECT cat_id, cat_name FROM category";
$result = mysqli_query($connect, $query);

// Enable error reporting for debugging
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

    if (isset($_POST['submit'])) {
        $project_name = $_POST['projectName'];
        $project_description = $_POST['descriptionP'] ;
        $hours = $_POST['hours'];
        $cat_id = $_POST['cat_id'] ;
        $client_id= $_SESSION['client_id'];
        $status = "to do";
        echo 44 ;

        

        // $insert = "INSERT INTO `project` 
        //            VALUES 
        //            (NULL,'$project_name', '$project_description', '$hours', 'individual' , '$cat_id', '$client_id', '$status')";

        $insert = "INSERT INTO `project` (`project_id`, `project_name`, `descriptionP`, `hours`, `type`, `cat_id`, `client_id`, `status`) 
           VALUES (NULL, '$project_name', '$project_description', '$hours', 'individual', '$cat_id', '$client_id', '$status')";

        $run_insert = mysqli_query($connect, $insert);
        echo 4 ;

        if ($run_insert) {
            echo "Project created successfully";
        } else {
            echo "Error creating project: " . mysqli_error($connect);
            echo "<br>SQL Query: " . $insert;
        }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MULTAQA</title>
    <link rel="icon" href="">
    <!-- link font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Slab:wght@100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- CSS LINK -->
    <!-- <link rel="stylesheet" href="css/navbar.css"> -->
    <link rel="stylesheet" href="css/create_team_project.css">
  
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




    <div class="main">
        <div class="title">
            <h1>INDIVIDUAL PROJECT  </h1>
        </div>

        <div class="body">
            <div class="img">
            <img src="./img/ind-project.png" alt="Team img">
            </div>

            <div class="form">
                <div class="formdetails">
                    <form method="POST">
                        <label for="projectName">Project Name</label>
                        <input type="text" name="projectName" id="projectName" placeholder="Enter Project Name" required>
                        <br>
                        <label for="projectDescription">Project Description</label>
                        <textarea name="descriptionP" id="projectDescription" placeholder="Describe Project" required></textarea>
                        <br><br>
                        <label for="hours">Hours Needed</label>
                        <input type="number" id="hours" name="hours" placeholder="Enter the hours needed" required>
                       
                        <br><br>
                        <label for="categories">Needed Category</label>
                        <select name="cat_id" id="categories" required>
                    <?php
                    // Loop through the fetched categories and display them as options
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No categories available</option>";
                    }
                    ?>
                </select>
                        <br>
                        <button class="cssbuttons-io" type="submit" name="submit">
                            <span>CREATE</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

  <!-- end footer -->

</body>
</html>
