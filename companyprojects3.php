<?php
// include("connection.php");

// // Initialize IDs
// $freelancer_id = 16; // This can be dynamically assigned

// if (isset($_GET['id'])) {
//     $client_id = $_GET['id'];
// $join= "SELECT * FROM project JOIN client ON client.client_id = project.client_id WHERE project.client_id='$client_id' ";
// $run_join = mysqli_query($connect, $join);}
// if (isset($_POST['submit'])) {
//     // Ensure project_id is set
//     if (isset($_POST['project_id'])) {
//         $project_id = $_POST['project_id'];

//         // Insert Query
//         $insert = "INSERT INTO request from freelancer (status, from, to, project_id) VALUES ('pending', '$freelancer_id', '$client_id', '$project_id')";
//         $run_insert = mysqli_query($connect, $insert);
// }}
include("connection.php");

// Initialize variables
// $freelancer_id = 16; // This can be dynamically assigned

$freelancer_id = $_SESSION['freelancer_id'];

$run_join = null; // Initialize to null

if (isset($_GET['id'])) {
    $client_id = intval($_GET['id']); // Sanitize input to prevent SQL injection

    // Join Query
    $join = "SELECT * FROM project JOIN client ON client.client_id = project.client_id WHERE project.client_id=$client_id";
    $run_join = mysqli_query($connect, $join);

    // Check if the query was successful
    if (!$run_join) {
        die("Query failed: " . mysqli_error($connect));
    }
}

if (isset($_POST['submit'])) {
    if (isset($_POST['project_id'])) {
        $project_id = intval($_POST['project_id']); // Sanitize input to prevent SQL injection

        // Check if freelancer_id exists
        $check_freelancer = "SELECT COUNT(*) AS count FROM freelancer WHERE freelancer_id = $freelancer_id";
        $result = mysqli_query($connect, $check_freelancer);
        $row = mysqli_fetch_assoc($result);

        if ($row['count'] == 0) {
            die("Error: Freelancer ID does not exist.");
        }

        // Insert Query
        $insert = "INSERT INTO request from freelancer (status, from, to, project_id) VALUES ('pending', '$freelancer_id', '$client_id', '$project_id')";
        $run_insert = mysqli_query($connect, $insert);

        // Check if the insert was successful
        if ($run_insert) {
            echo "<script>alert('Request sent successfully!');</script>";
        }
        else{
            die("Insert failed: " . mysqli_error($connect));

        }
    }
}

if(isset($_POST['search'])){
    $text=$_POST['text'];
    $select_search="SELECT * FROM project JOIN client ON client.client_id = project.client_id WHERE project.client_id=$client_id
     AND (project_name LIKE '%$text%') 
    or (descriptionP LIKE '%$text%') 
    or (hours LIKE '%$text%') ";
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
   <link rel="stylesheet" href="css/company.projects.css">
    <style>
    .container-compny-project{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    align-content: center;
    margin-top:30px;

}
    </style>
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
                        <a class="nav-link active" aria-current="page" href="landiing.php">Landing</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="freelancer.profile.php">Profile</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="agencies.php">Agencies</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="post">
                    <input class="form-control me-2" type="search" name="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" name="search" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
       <!-- NAV BAR ENDS -->

       <div id="notification" style="display:none; padding: 10px; background-color: #4CAF50; color: white; position: fixed; top: 10px; right: 10px; z-index: 1000;">
    Request sent successfully!
</div>



    <!-- PAGE CONTENT STARTS -->
     <!-- <div class="TOP"> -->


<?php if(isset($_POST['search'])){ ?>

    <div class="card-container">
        <?php while ($row = mysqli_fetch_assoc($run_select_search)) { ?>
       <div class="main-div">
    
        <h1>Company Projects</h1>

        <!-- <H2>Project Name:</H2> -->
        <h2>Project Name: <p> <?php echo htmlspecialchars($row['project_name']); ?></p> </h2>

        <!-- <h2>Description:</h2> -->
        <h2>Description: <p> <?php echo htmlspecialchars($row['descriptionP']); ?></p> </h2>

        <!-- <h2>Hours of project:</h2> -->
        <h2>Hours of project: <p> <?php echo htmlspecialchars($row['hours']); ?></p> </h2>

        <br>
        
        <form method="post">

        <button class="cssbuttons-io" type="submit" name="submit">
            <span>Request</span>
        </button>
        <input type="hidden" name="freelancer_id" value="<?php echo htmlspecialchars($freelancer_id); ?>">
                <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($row['project_id']); ?>">
            </form>
            <!-- php -->
      </div>
     <!-- </div> -->

        <?php } ?>
    </div>


    <?php }else{ ?>
    
    <div class="card-container">
          <?php while ($data = mysqli_fetch_assoc($run_join)) { ?>
        <div class="main-div">
    
        <h1>Company Projects</h1>

        <!-- <H2>Project Name:</H2> -->
        <h2>Project Name: <p> <?php echo htmlspecialchars($data['project_name']); ?></p> </h2>

        <!--  <h2>Description:</h2> -->
        <h2>Description: <p> <?php echo htmlspecialchars($data['descriptionP']); ?></p> </h2>

        <!-- <h2>Hours of project:</h2> -->
        <h2>Hours of project: <p> <?php echo htmlspecialchars($data['hours']); ?></p> </h2>

        <br>
        
        <form method="post">

        <button class="cssbuttons-io" type="submit" name="submit">
            <span>Request</span>
        </button>
        <input type="hidden" name="freelancer_id" value="<?php echo htmlspecialchars($freelancer_id); ?>">
                <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($data['project_id']); ?>">
            </form>
            <!-- php -->
    </div>
        <!-- </div> -->

        <?php } ?>
  </div>
   <?php } ?>

        
       
    

    
    <!-- PAGE CONTENT ENDS -->

</body>

</html>