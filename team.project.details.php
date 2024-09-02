<?php 
include("connection.php");
// $project_id = $_SESSION['project_id']; 
// $id = $_POST['project_id'];
$freelancer_id = $_SESSION['freelancer_id'];

// function countproject($connect){

//     if(isset($_POST['incrview'])){
//         $freelancer_id = $_POST['view'];
//         $_SESSION['id']=$freelancer_id;
//         $SelectVcount = "SELECT count_view FROM freelancer WHERE freelancer_id= $freelancer_id ";
//         $ExecVcount = mysqli_query($connect, $SelectVcount);
//         $data = mysqli_fetch_assoc($ExecVcount);
//         $currValue = $data['count_view'];
//         $updatedValue = $currValue + 1;
//         $UpdateVCount = "update freelancer set count_view= $updatedValue WHERE freelancer_id= $freelancer_id";
//         $ExecUpdate = mysqli_query($connect,$UpdateVCount);
//         header("Location: viewfreelancerprofile.php?viewprofile=$freelancer_id");
//     }
// }
 
 $type="";

if(isset($_GET['project_id'])){
    $project_id=$_GET['project_id'];
    // new
    $team="SELECT * FROM `freelancer` JOIN `project member` ON `freelancer`.`freelancer_id`=`project member`.`member_id`
     JOIN `project` ON `project`.`project_id`=`project member`.`project_id` JOIN `client` 
               ON `project`.`client_id` = `client`.`client_id` JOIN `category` 
               ON `project`.`cat_id` = `category`.`cat_id` WHERE `project`.`project_id` = '$project_id'";

$runteam=mysqli_query($connect,$team);

$fetch=mysqli_fetch_assoc($runteam);
$type=$fetch['type'];
$project=$fetch['project_name'];
$agency=$fetch['client_name'];
$des=$fetch['descriptionP'];
$hours=$fetch['hours'];

}

$run_query = "SELECT * FROM `project`JOIN `client` 
               ON `project`.`client_id` = `client`.`client_id` JOIN `category` 
               ON `project`.`cat_id` = `category`.`cat_id` WHERE `project`.`project_id` = '$project_id'";
$projects = mysqli_query($connect, $run_query);

// $team="SELECT * FROM `project member` JOIN `project` ON `project`.`project_id`=`project member`.`project_id` JOIN `client` 
//                ON `project`.`client_id` = `client`.`client_id` JOIN `category` 
//                ON `project`.`cat_id` = `category`.`cat_id` WHERE `project`.`project_id` = '$project_id'";

// $runteam=mysqli_query($connect,$team);    

if(isset($_POST['done'])){
    $up="UPDATE `project member` SET `status`='done' WHERE `project_id`='$project_id'";
    $runup=mysqli_query($connect,$up);
// $selectCount="SELECT * FROM `project member` where `member_id`=$freelancer_id && `status`='done' ";
// $run=mysqli_query($connect,$selectCount);
//     if ($run) {
//         echo 279;
//     }else{
//         echo 'help';
//     }
//     $num_rows=mysqli_num_rows($run);
    // $fetch = mysqli_fetch_assoc($Execcount);
    // $currValue = $fetch['project_id'];
    // $_SESSION['countproject']=$num_rows;


    header("location:doneprojects.php");

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
   <link rel="stylesheet" href="css/team.project.detail.Css">
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
                        <a class="nav-link" href="freelancer.profile.php">Profile</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="agencies.php">Agencies</a>
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

    

    
        
        <div class="main-container">
    <div class="main-div">
    <?php if($type=='team'){?>

    <h1>Project Details</h1>
    
    
        <H2>Team members:</H2>
    <?php foreach ($runteam as $data) {?>



        <H2><p class="team"><?php echo $data['freelancer_name']; ?></p></H2>

    <?php } ?>


        <H2>Agency Name: <p><?php echo $agency ?></p> </H2>


        <H2>Project Name: <p><?php echo $project ?></p> </H2>

        <h2>Description: <p><?php echo $des ?></p> </h2>

        <h2>Hours of project: <p><?php echo $hours ?></p></h2>

        <form method="post">
            <button class="done-btn" name="done">
                <span>Done</span>
            </button>
        </form>

    </div>
    </div>
    

    <!-- <div class="main-container">
    <div class="main-div"> -->

    <?php }else{ ?>


    <h1>Project Details</h1>


        <H2>Agency Name: <p><?php echo $agency ?></p> </H2>


        <H2>Project Name: <p><?php echo $project ?></p> </H2>

        <h2>Description: <p><?php echo $des ?></p> </h2>

        <h2>Hours of project: <p><?php echo $hours ?></p></h2>

        <form method="post">
        <button class="done-btn" name="done">
                            <span>Done</span>
                        </button>
                        </form>

    

<?php } ?>
<!-- </div>
    </div> -->
    
    <!-- PAGE CONTENT ENDS -->


</body>

</html>