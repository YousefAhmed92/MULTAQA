<?php
include('connection.php');

// Retrieve project details for the logged-in freelancer
// $freelancer_id = 16 ; // Assume freelancer ID is stored in session
$freelancer_id = $_SESSION['freelancer_id'];


// Query to get project details where the freelancer is a member
$query = "SELECT * FROM `project member` JOIN `project` ON `project member`.`project_id` = `project`.`project_id`
JOIN `category` ON `project`.`cat_id`=`category`.`cat_id`
            WHERE `project member`.`member_id` = '$freelancer_id' AND `project member`.`status`='to do'"; 

$result = mysqli_query($connect, $query);

// Close the database connection
mysqli_close($connect);
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
    <link rel="stylesheet" href="css/view my project2.css">
 
       
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
                        <a class="nav-link" href="client-send-request.php">my requests</a>
                    </li>
                    
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="freelancer.profile.php">my profile</a>
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
            <h2>Project Name:<td><p><?php echo htmlspecialchars($row['project_name']); ?></p></td></h2>
            <br>
        
            <h2>Description: <td><p><?php echo htmlspecialchars($row['descriptionP']); ?></p></td></h2>
                
                <br>
                <h2>project category: <td><p><?php echo htmlspecialchars($row['cat_name']); ?></p></td></h2>
                <a href="team.project.details.php?project_id=<?php echo $row['project_id']?>"><span class="read">Read More </span></a>
                <!-- <div class="input-container">
                <label for="file" class="input-label"> Upload File:
                </label>
                <input type="file" id="file" class="input file-input">
                </div> -->
            </div>
            <?php } ?>

            <!-- <div class="card">
            <h2>Project Name</h2>
            <p>cars website</p>
                <br>

                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>

                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div> -->
            <!-- <div class="card">
                <h2>Freelancer Name</h2>
                <p>ziad sherif</p>
                <br>
                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <h2>Project Name</h2>
                <p>cars website</p>
                <br>
                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div>
            <div class="card">
                <h2>Freelancer Name</h2>
                <p>ziad sherif</p>
                <br>
                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <h2>Project Name</h2>
                <p>cars website</p>
                <br>
                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div>
            <div class="card">
                <h2>Freelancer Name</h2>
                <p>ziad sherif</p>
                <br>
                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <h2>Project Name</h2>
                <p>cars website</p>
                <br>
                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div>
            <div class="card">
                <h2>Freelancer Name</h2>
                <p>ziad sherif</p>
                <br>
                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <h2>Project Name</h2>
                <p>cars website</p>
                <br>
                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div>
            <div class="card">
                <h2>Freelancer Name</h2>
                <p>ziad sherif</p>
                <br>
                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <h2>Project Name</h2>
                <p>cars website</p>
                <br>
                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div> -->
        </div>
    </div>
</body>

</html>
