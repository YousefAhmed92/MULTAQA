<?php
include('connection.php');
if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
} else {
    die("Client ID not found. Please log in again.");
}
$query = "SELECT * FROM `project` 
          JOIN `category` ON `project`.`cat_id` = `category`.`cat_id`
          WHERE `project`.`client_id` = '$client_id'";

$result = mysqli_query($connect, $query);

if (isset($_POST['delete_project'])) {
    $project_id = $_POST['project_id'];

    // Delete query
    $deleteQuery = "DELETE FROM `project` WHERE `project_id` = '$project_id'";

    if (mysqli_query($connect, $deleteQuery)) {
        echo "<script>alert('Project deleted successfully.'); window.location.href='viewmyprojects3.php';</script>";
    } else {
        echo "Error deleting project: " . mysqli_error($connect);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSITEW NAME -->
    <title>MULTAQA</title>
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
    <link rel="stylesheet" href="css/view my projects.css">
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
                        <a class="nav-link" href="viewmyprojects3.php">My projects</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="freelancer-send-request.php">My requests</a>
                    </li>
                    
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="agancy.profile.php">Profile</a>
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
    <div class="main">
        <div class="title">
            <h1>MY PROJECTS</h1>
        </div>

        <div class="body">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <div class="card">
        
            <h2>Project Name: <p><?php echo htmlspecialchars($row['project_name']); ?></p></h2>
            <!-- <br> -->
        
            <h2>Description: <p><?php echo htmlspecialchars($row['descriptionP']); ?></p></h2>
                
                <!-- <br> -->
                <h2>Project Category: <p><?php echo htmlspecialchars($row['cat_name']); ?></p></h2>

                <h2>Project Type:  <p><?php echo htmlspecialchars($row['type']); ?></p></h2>

                <h2>Project Hours: <p><?php echo htmlspecialchars($row['hours']); ?></p></h2>

                
            
        
                <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                    <input type="hidden" name="project_id" value="<?php echo $row['project_id']; ?>">
                    <button type="submit" name="delete_project" class="dlt">Delete</button>
                </form>
            </div>
            <?php } ?>
        </div>
    </div>
<style>
    .dlt{
        background-color: darkred;
        width: 150px;
    }
</style>

</body>

</html>
