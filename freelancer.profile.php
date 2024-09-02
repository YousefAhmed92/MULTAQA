<?php
include ("connection.php");

$freelancer_id = $_SESSION['freelancer_id'];
// $freelancer_id = 16;

$selectprice="SELECT * FROM freelancer JOIN subcategory ON freelancer.subcategory_id=subcategory.subcategory_id
WHERE freelancer_id='$freelancer_id'";
$runselectprice=mysqli_query($connect,$selectprice);
$price="111";
$data=mysqli_fetch_assoc($runselectprice);
if($data['sub_name']=='fashion graphic designer' AND $data['graduate']=='graduate'){
    $price=30;
}elseif($data['sub_name']=='fashion graphic designer' AND $data['graduate']=='undergraduate'){
    $price=22;
}elseif($data['sub_name']=='content creator' AND $data['graduate']=='graduate'){
    $price=66;
}elseif($data['sub_name']=='content creator' AND $data['graduate']=='undergraduate'){
    $price=55;
}elseif($data['sub_name']=='market research analyst' AND $data['graduate']=='graduate'){
    $price=24;
}elseif($data['sub_name']=='market research analyst' AND $data['graduate']=='undergraduate'){
    $price=22;
}elseif($data['sub_name']=='voice over' AND $data['graduate']=='graduate'){
    $price=42;
}elseif($data['sub_name']=='voice over' AND $data['graduate']=='undergraduate'){
    $price=33;
}elseif($data['sub_name']=='voice actor' AND $data['graduate']=='graduate'){
    $price=12;
}elseif($data['sub_name']=='voice actor' AND $data['graduate']=='undergraduate'){
    $price=8.80;
}elseif($data['sub_name']=='financial analyst' AND $data['graduate']=='graduate'){
    $price=78;
}elseif($data['sub_name']=='financial analyst' AND $data['graduate']=='undergraduate'){
    $price=66;
}elseif($data['sub_name']=='business intellegence analyst' AND $data['graduate']=='graduate'){
    $price=84;
}elseif($data['sub_name']=='business intelligence analyst' AND $data['graduate']=='undergraduate'){
    $price=71.50;
}elseif($data['sub_name']=='backend developer' AND $data['graduate']=='graduate'){
    $price=96;
}elseif($data['sub_name']=='backend developer' AND $data['graduate']=='undergraduate'){
    $price=82.50;
}elseif($data['sub_name']=='frontend developer' AND $data['graduate']=='graduate'){
    $price=18;
}elseif($data['sub_name']=='frontend developer' AND $data['graduate']=='undergraduate'){
    $price=11;
}

// echo $price;
$finalprice="";

if($data['year of xp']== '0' OR $data['year of xp']== '2' OR $data['year of xp']== '3' AND $data['graduate']=='graduate'){
    $finalprice= $price;

}elseif($data['graduate']=='undergraduate'){
    $finalprice= $price;

}elseif($data['year of xp']== '4' OR $data['year of xp']== '5' OR $data['year of xp']=='6' AND $data['graduate']=='graduate'){
    $finalprice= $price*2;

}elseif($data['year of xp']== '7' OR $data['year of xp']== '8' OR $data['year of xp']== '9' AND $data['graduate']=='graduate'){
    $finalprice= $price*4;


}else{
    $finalprice= $price + ($price*4*1/3);
    
}

$selectCount="SELECT * FROM `project member` WHERE `member_id`='$freelancer_id' AND `project member`.`status`='done'" ;
$run=mysqli_query($connect,$selectCount);
    
    $num_rows=mysqli_num_rows($run);



$s="SELECT SUM(hours) as total FROM `project` JOIN `project member` ON `project`.`project_id`=`project member`.`project_id` WHERE 
`project member`.`status`='done' AND `member_id`='$freelancer_id'";

$runs=mysqli_query($connect,$s);
 
if ($runs->num_rows > 0) {
    $row = $runs->fetch_assoc();
    $total_hours = $row['total'];
} else {
    $total_hours = 0;
    echo "0 hours";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $feedback = isset($_POST['feedback']) ? $_POST['feedback'] : '';
    $rating = isset($_POST['star-radio']) ? $_POST['star-radio'] : null;
    $client_id = 1; // Example client_id

    if ($feedback) {
        if ($rating !== null) {
            // Insert rating and feedback
            $stmt = $connect->prepare("INSERT INTO rating (rating, feedback, freelancer_id, client_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isii", $rating, $feedback, $freelancer_id, $client_id);
        } else {
            // Insert feedback without rating
            $stmt = $connect->prepare("INSERT INTO rating (rating, feedback, freelancer_id, client_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssi", $feedback, $freelancer_id, $client_id);
        }

        if ($stmt->execute()) {
            $message = "Feedback submitted successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("location:landing.php");
    exit();
}

// Rating and feedback
// if (isset($_POST['rating']) && isset($_POST['feedback'])) {
//     $feedback = $_POST['feedback'];
//     $rating = $_POST['rating'];
//     $client_id = 1;

//     $stmt = $connect->prepare("INSERT INTO rating (rating, feedback, freelancer_id, client_id) VALUES (?, ?, ?, ?)");
//     $stmt->bind_param("isii", $rating, $feedback, $freelancer_id, $client_id);

//     if ($stmt->execute()) {
//         $message = "Rating submitted successfully!";
//     } else {
//         $message = "Error: " . $stmt->error;
//     }
//     $stmt->close();
// }

// Handle form submission for adding projects
if (isset($_POST['add_project'])) {
    $sample_name = $_POST['sample_name'];
    $descriptionsample = $_POST['description'];

    $insert_project_sql = "INSERT INTO sample (sample_name, description, freelancer_id)
                              VALUES ('$sample_name', '$descriptionsample', $freelancer_id)";

    if (mysqli_query($connect, $insert_project_sql)) {
        $message = "Project added successfully!";
    } else {
        $message = "Error: " . mysqli_error($connect);
    }
}

// Handle form submission for adding LinkedIn links
if (isset($_POST['add_link'])) {
    $link = $_POST['link'];

    $insert_link_sql = "INSERT INTO link (link, freelancer_id)
                            VALUES ('$link', $freelancer_id)";

    if (mysqli_query($connect, $insert_link_sql)) {
        $message = "Link added successfully!";
    } else {
        $message = "Error: " . mysqli_error($connect);
    }
}


// Fetch freelancer details
$sql = "SELECT * FROM freelancer LEFT JOIN sample ON sample.freelancer_id=freelancer.freelancer_id 
LEFT JOIN link ON link.freelancer_id=freelancer.freelancer_id  WHERE freelancer.freelancer_id = '$freelancer_id'";
$run_sql = mysqli_query($connect, $sql);

if (mysqli_num_rows($run_sql) > 0) {
    $row = mysqli_fetch_assoc($run_sql);
    $freelancer_name = $row['freelancer_name'];
    $email = $row['email'];
    $available = $row['available hours per day'];
    $graduate = $row['graduate'];
    // $description = $row['description'];
    $skills = $row['skills'];
    $price_per_hour = $row['price/hour'];
    $years_of_xp = $row['year of xp'];
    $image= $row['image'];
    $link= $row['link'];
    $view= $row['count_view'];



} else {
    echo "No freelancer found with the given user ID.";
    exit;
}

$rating_sql = "SELECT * FROM rating WHERE freelancer_id = $freelancer_id";
$run_rating_sql = mysqli_query($connect, $rating_sql);

$projects_sql = "SELECT * FROM sample WHERE freelancer_id = $freelancer_id";
$run_projects_sql = mysqli_query($connect, $projects_sql);

$links_sql = "SELECT * FROM link WHERE freelancer_id = $freelancer_id";
$run_links_sql = mysqli_query($connect, $links_sql);

$disfinal = "SELECT * FROM `freelancer` WHERE `freelancer_id` = '$freelancer_id'";
$run_final = mysqli_query($connect, $disfinal);
$fetch=mysqli_fetch_assoc($run_final);
$finaldistrial=$fetch['description'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
<head>
   
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSITEW NAME -->
    <title>MULTAQA</title>
    <!-- WEBSITE LOGO -->
    <link rel="icon" href="img/logo.jfif" />
     <!-- FONT AWESOME LINK -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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
    <link rel="stylesheet" href="css/freelancer.profile.Css">

    <!-- <style>
        .cssbuttons-io a {
            display: inline;
            margin-left: 10%;
            width: 20%;
            position: relative;
            font-family: none;
            font-weight: 500;
            font-size: 18px;
            letter-spacing: 0.05em;
            border-radius: 0.8em;
            cursor: pointer;
            border: none;
            background: linear-gradient(to right, #040D12, #5C8374);
            color: var(--color-4);
            overflow: hidden;
            box-shadow: 0 0 20px #101514,
                0 0 1px var(--color-3), 0 0 5px var(--color-2),
                0 0 5px var(--color-3), 0 0 8px var(--color-3);
        }

        .cssbuttons-io a span {
            position: relative;
            z-index: 10;
            transition: color 0.4s;
            display: inline-flex;
            align-items: center;
            padding: 0.8em 1.2em 0.8em 1.05em;
            color: var(--color-4) !important;
        }

        span {
            color: var(--color-4) !important;
        }

        .cssbuttons-io a::before,
        .cssbuttons-io a::after {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .cssbuttons-io a::before {
            content: "";
            background: var(--color-1);
            width: 120%;
            left: -10%;
            transform: skew(30deg);
            transition: transform 0.4s cubic-bezier(0.3, 1, 0.8, 1);
        }

        .cssbuttons-io a:hover::before {
            transform: translate3d(100%, 0, 0);
        }

        .cssbuttons-io a:active {
            transform: scale(0.95);
        }
    </style> -->



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




    <div class="div-container">
        <div class="main-div">

            <h1>FREELANCER PROFILE</h1>

            <!-- CARD STARTS -->
            <div class="sec">
                <!-- <h3>Name:</h3> -->
                <p class="data">Name: <?php echo $freelancer_name; ?></p>
            </div>
            <br>
            <div class="img-div">
                <?php if(empty($image)){ ?>
                <img class="img-pro2" src="img/profile.png"alt="Freelancer Image">
            <?php } else { ?>
                <img class="img-pro2" src="img/<?php echo htmlspecialchars($image); ?>"alt="Freelancer Image">
                <?php } ?>
            </div>
            <div class="sec">
                <!-- <h3>E-mailL:</h3> -->
                <p class="data">E-mailL: <?php echo $email; ?></p>
            </div>
            <br>


            <div class="sec">
            <p class="data">Profile Views: <?php echo $view; ?></p>

            </div>
            <br>


            <div class="sec">
                <!-- <h3>Years Of Experience:</h3> -->
                <P class="data">Years Of Experience:   <?php echo $years_of_xp; ?></P>
            </div>

<br>
            <div class="sec">
                <!-- <h3>Available Hours/Day:</h3> -->
                <P class="data">Available Hours/Day:  <?php echo $available; ?></P>
            </div>

<br>
            <div class="sec">
                <!-- <h3>Grad/Undergrad:</h3> -->
                <P class="data">Grad/Undergrad:  <?php echo $graduate; ?></P>
            </div>

<br>
            <!-- <div class="sec">
                <div class="diff">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5" class="star">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4" class="star">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3" class="star">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2" class="star">&#9733;</label>
                </div>

            </div> -->



            <div class="sec">
                <!-- <h3>Price:</h3> -->
                <p class="data"><?php echo $finalprice; ?>  (According to Years of Experience/Education/Subcategory)
                    <br><?php echo $price_per_hour; ?>   (indicated by freelancer)
                </p>
            </div>
<br>

            <div class="sec">
              
                <P class="data">Description:  <?php echo $finaldistrial; ?></P>
            </div>
<br>

            <div class="sec">
                <!-- <h3>Skills: </h3> -->
                <p class="data"> Skills:  <?php echo $skills; ?>
                </P>
            </div>
<br>

            <div class="sec">
                <!-- <h3>Number Of Projects:</h3> -->
                <P class="data">Number Of Projects:  <?php echo $num_rows; ?> Projects</P>
            </div>
<br>

            <div class="sec">
                <!-- <h3>Hours Of projects:</h3> -->
                <P class="data">Hours Of projects: <?php echo $total_hours; ?></P>
            </div>
<br>
            <div class="sec">
                <!-- <h3>Links:</h3> -->
                <P class="data">Links:  <?php echo $link; ?></P>
            </div>
<br>
            <div class="sec">
                <!-- <h3>Samples:</h3> -->
                <div class="addcomm" id="attach">
                    <p class="data">Samples:
                    <!-- <i class="fa-solid fa-paperclip"></i> -->
                    <!-- <input type="file"> -->
                    <a class="data1" href="sampleview2.php?freelancer_id=<?php echo $freelancer_id?>">View Samples</a>

                     <a href="form.php" class="data1">Add Samples</a>
                     </p>
                </div>
            </div>
<br>
            <div class="sec">
                <!-- <h3>Done Projects:</h3> -->
                <p class="data">Done Projects: 
                <a class="data1" href="doneprojects.php?freelancer_id=<?php echo $freelancer_id?>">My Done Projects</a>
</p>
            </div>


            <p class="line">___________________________________________</p>

            <H2> COMMENTS </H2>



            <div class="comment-section"> 

                <<?php
                if (mysqli_num_rows($run_rating_sql) > 0) {
                    while ($rating_row = mysqli_fetch_assoc($run_rating_sql)) {
                        $feedback = $rating_row['feedback'];
                        $rating = $rating_row['rating'];
                
                        ?>
                            <br>
                            <div class="ratings">
                            <p><strong>Feedback:</strong> <?php echo $feedback; ?></p>
                                <p><strong>Rating:</strong> <?php echo $rating; ?>/5</p>
                              
                            </div>
                            <hr>
                            <?php
                    }
                } else {
                    echo "<p>No ratings available for this freelancer.</p>";
                }
                ?>
            </div>

            <!-- <form class="my-comment" method="post" action="">
            <textarea name="feedback" id="comment" placeholder="Enter Your Comment..."></textarea>

            <button class="send" type="submit">
                <span>Send</span>
            </button>
        </form> -->

            <!-- <form class="my-comment" method="post" action="">

            <div class="rating">
<h3>RATING:</h3>

<input type="radio" id="star-1" name="star-radio" value="5">
  <label for="star-1">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" ><path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
  </label>
  <input type="radio" id="star-2" name="star-radio" value="4">
  <label for="star-2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
  </label>
  <input type="radio" id="star-3" name="star-radio" value="3">
  <label for="star-3">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
  </label>
  <input type="radio" id="star-4" name="star-radio" value="2">
  <label for="star-4">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
  </label>
  <input type="radio" id="star-5" name="star-radio" value="1">
  <label for="star-5">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
  </label>
</div>
                

                <textarea name="feedback" id="comment" placeholder="Enter Your Comment..."></textarea>
                <button class="send"  type="submit">
                    <span>Send</span>
                </button>
            </form>

            <br><br><br><br> -->


            <!-- <button class="cssbuttons-io">
            <a href=""><span>Edit Profile</span></a>
        </button>

        <button class="cssbuttons-io">
            <a href=""><span>View Requests</span></a>
        </button>

        <button class="cssbuttons-io">
            <a href=""><span>View Projects</span></a>
        </button> -->
<div class="btn1">


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
    </div> -->

             <button class="cssbuttons-io">
                <a href="EditFreelancer.php"><span>Edit Info</span></a>
            </button>

            <button class="cssbuttons-io">
            <a href="client-send-request.php"><span>View Request</span></a>
                
            </button>

            <button class="cssbuttons-io">
            <a href="view my projects2.php"><span>View Projects</span></a>
                
            </button> 

            <button class="cssbuttons-io">
            <a href="client-send-respond.php"><span>View Messages</span></a>
            </button> 
</div>
            <form method="post"class="btn2" >
            <button class="anchor" name="logout" action="">
                <span class="">Logout</span>
            </button> 
        </form>
    
    <!-- </button> -->
    

</body>

</html>
